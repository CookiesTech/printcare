<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Policy extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Policy_model',
            'Client/Client_model',
            'Dashboard/Dashboard_model'
        ));
        $this->load->helper(array(
            'form'
        ));
        $this->load->library("Pdf");
        $session_data       = $this->session->userdata(SESSION_LOGIN . 'logged_in');
        $data['username']   = $session_data['username'];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        $data['user_group'] = $this->session->userdata(SESSION_LOGIN . 'user_group');
       
        if (empty($data['permission'])) {
            redirect('home');
        }
        $data['designation'] = $this->Common_model->getDropdownList('designation');
        $data['user']        = $this->Common_model->getDropdownList('user');
        $data['title']       = 'Policy';
        
        //$this->Common_model->Google_drive_action();
		
        $this->load->view('common/header', $data);
    }
    function hasPermission($page)
    {
		
        $res_permission = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        if ($res_permission && !empty($res_permission)) {
            if (!in_array($page, $res_permission)) {
                redirect('access_denied', 'refresh');
            }
        } else {
            redirect('home');
        }
    }
    function index()
    {
        $this->getlist();
    }
    function getlist()
    {
		//~ echo '<pre>ss';
		//~ print_r($this->client);
		//~ echo '</pre>';
		//~ exit;
        $this->hasPermission('policy_view');
        $filter_data = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter_data = $this->input->post();
            $reset_data  = $this->input->post('reset');
            if (isset($reset_data)) {
                $this->session->unset_userdata('filter_data');
                $filter_data = '';
            } else {
                $this->session->set_userdata('filter_data', $filter_data);
            }
        } else {
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
        }
        $data['filter_data'] = $filter_data;
        $segment_3           = $this->uri->segment(3);
        $segment_4           = $this->uri->segment(4);
        $segment_5           = $this->uri->segment(5);
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data         = '';
            $data['filter_data'] = '';
        }
        if (isset($segment_3)) {
            $page = $segment_3;
        } else {
            $page = '1';
        }
        if (isset($segment_4)) {
            $sort = $segment_4;
        } else {
            $sort = 'policy_sort_order';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'ASC';
        }
        $data['page']      = $page;
        $filter_query_data = array();
        $data['limit']     = '';
        if (isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])) {
            $start                      = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit']              = '?limit=' . $_REQUEST['limit'];
        } else {
            $start = (($page - 1) * RPP);
        }
        $data['start']              = $start;
        $filter_query_data['start'] = $start;
        $filter_query_data['sort']  = $sort;
        $filter_query_data['order'] = $order;
        $table['tbl_main']          = 'policy';
        $table['tbl_motor_vehicle_policy']         = 'motor_vehicle_policy';
       // $data['mainlist_count']     = $this->Common_model->getListCount($table, $filter_data, 'policy_id');
        $data['mainlist']           = $this->Common_model->getList($table, $filter_query_data, $filter_data, 'policy_id');
        $data['tablefields1']       = $this->Common_model->getTableFields('policy');
        $data['tablefields2']       = $this->Common_model->getTableFields('motor_vehicle_policy');
        $data['tablefields']        = array_merge($data['tablefields1'],$data['tablefields2']);
        $data['operations']         = $this->Common_model->getFilterOperation();
        $data['init_listing_page']  = 'policy/getlist/';
        $data['listing_page']       = $data['init_listing_page'] . $page . '/';
        $data['filter_block']       = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        $this->load->view('common/menu');
        $this->load->view('policy/policy_list_view', $data);
        $this->load->view('common/footer');
    }
    function getForm()
    {
        $data['client_list_auto_comp'] = $this->Client_model->getClientList();
        $data['action']                = site_url('policy/add');
        $this->load->view('common/menu');
        $this->load->view('policy/policy_form_view', $data);
        $this->load->view('common/footer');
    }
    function add()
    {
        $this->hasPermission('policy_add');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data                    = $this->input->post();
                        
			//~ echo '<pre>';
			//~ print_r($data);
			//~ echo '</pre>';
			//~ exit;
			
            // Calculate Policy Brokerage
            $where                   = 'ref_insurance_agency_id = ' . $data['ref_insurance_agency_id'] . ' AND ref_policy_category_id = ' . $data['ref_policy_category_id'] . ' AND policy_brokerage_from_date <= "' . date('Y-m-d') . '"';
            $order_by                = 'policy_brokerage_from_date DESC ';
            $limit                   = '0,1';
            $res_policy_brokerage    = $this->Common_model->getRecords('policy_brokerage', $where, '', $order_by, $limit);
            $policy_brokerage_amount = 0;
            if (isset($res_policy_brokerage) && !empty($res_policy_brokerage)) {
                $policy_brokerage_amount = ($data['policy_premium'] * $res_policy_brokerage[0]->policy_brokerage_percentage) / 100;
            }
            
            // Calculate Agent Broker age
            if (isset($data['ref_agent_id']) && $data['ref_agent_id']) {
                $where                      = 'ref_agent_id = ' . $data['ref_agent_id'] . ' AND ref_insurance_agency_id = ' . $data['ref_insurance_agency_id'] . ' AND ref_policy_category_id = ' . $data['ref_policy_category_id'] . ' AND policy_brokerage_from_date <= "' . date('Y-m-d') . '"';
                $order_by                   = 'policy_brokerage_from_date DESC ';
                $limit                      = '0,1';
                $res_agent_policy_brokerage = $this->Common_model->getRecords('agent_brokerage', $where, '', $order_by, $limit);
                $agent_brokerage_amount     = 0;
                if (isset($res_agent_policy_brokerage) && !empty($res_agent_policy_brokerage)) {
                    $agent_brokerage_amount = ($data['policy_premium'] * $res_agent_policy_brokerage[0]->policy_brokerage_percentage) / 100;
                }
            }
            
            // if Motor Policy
            $mv_data = array();
            if ($data['ref_policy_category_id'] == 1) {
                $mv_data = $data['mv_policy'];
            }
            unset($data['mv_policy']);
            $premium_amount                     = $data['policy_premium'] + $data['policy_tp_amount'];
	    	    
            $data['policy_category_st_sd'] = ($premium_amount * GST_PERCENTAGE ) / 100;
       	   
            $res                                = $this->Common_model->addRecord('policy', $data);
			
			$policy_tp_amount = $data['policy_tp_amount'];
			// Get additional brokerage values from Custom Brokerage
			$policy_brokerage = $this->Common_model->getDetails('policy_brokerage','ref_policy_category_id',$data['ref_policy_category_id']);
			$policy_brokerage_custom_field = $this->Common_model->getDetails('policy_brokerage_custom_field','ref_policy_brokerage_id',$policy_brokerage[0]->policy_brokerage_id);
			$policy_brokerage_custom_total = 0;
			if(isset($policy_brokerage_custom_field) && !empty($policy_brokerage_custom_field)){
				foreach($policy_brokerage_custom_field as $value){
					$custom_total = ($policy_tp_amount) * ($value->policy_custom_brokerage_value)/100;
					$policy_brokerage_custom_total = $custom_total + $policy_brokerage_custom_total ;
				}
			}
			$total_brokerage_amount = $policy_brokerage_custom_total + $policy_brokerage_amount;
			$pb_data                            = array();
			$pb_data['ref_policy_id']           = $res;
			$pb_data['policy_brokerage_amount'] = $total_brokerage_amount;
		
			$res_1                              = $this->Common_model->addRecord('policy_brokerage_history', $pb_data);
			$cv_data['ref_policy_brokerage_history_id'] = $res_1 ;
			$brokerage_custom_total = 0;
			if(isset($policy_brokerage_custom_field) && !empty($policy_brokerage_custom_field)){
				foreach($policy_brokerage_custom_field as $val){
					$cv_data['ref_policy_id'] = $res;
					$cv_data['ref_policy_custom_brokerage_id'] = $val->policy_custom_brokerage_id;
					$cv_data['policy_custom_brokerage_value'] = $val->policy_custom_brokerage_value;
					$cv_data['policy_custom_brokerage_amount'] = ($policy_tp_amount) * ($val->policy_custom_brokerage_value)/100;	    
					$res_2                            = $this->Common_model->addRecord('policy_brokerage_custom_value', $cv_data);
			   
				} 
			}
		    
            if (isset($data['ref_agent_id']) && $data['ref_agent_id']) {
                $ab_data                           = array();
                $ab_data['ref_policy_id']          = $res;
                $ab_data['ref_agent_id']           = $data['ref_agent_id'];
                $ab_data['agent_brokerage_amount'] = $agent_brokerage_amount;
                $res_2                             = $this->Common_model->addRecord('agent_brokerage_history', $ab_data);
            }
            if (isset($mv_data) && !empty($mv_data)) {
                $mv_data['ref_policy_id'] = $res;
                if (isset($_FILES['motor_vehicle_rc']['name']) && !empty($_FILES['motor_vehicle_rc']['name'])) {
                    $mv_data['motor_vehicle_rc'] = $this->Common_model->upload_file($_FILES['motor_vehicle_rc']['name'], $_FILES['motor_vehicle_rc']['tmp_name'], 'rc');
                }
                $this->Common_model->addRecord('motor_vehicle_policy', $mv_data);
            }
            if ($res) {
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('policy_add', $res);
                
                if(isset($data['prev_policy_id'])){
					$u_data['policy_renewal_status'] = 1;
					$this->Common_model->updateRecord('policy',$u_data,$data['prev_policy_id']);
				}
			
                $_SESSION['success_msg'] = 'Policy successfully added ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            redirect('policy');
        } else {
            $this->getForm();
        }
    }
    
    function view()
    {
        $this->hasPermission('policy_view');
        $id                     = $this->uri->segment(3);
        $data['policy']         = $this->Common_model->getDetails('policy', 'policy_id', $id);
        $data['policy_numbers'] = $this->Common_model->getDetails('policy_contact_numbers', 'ref_policy_id', $id);
        $data['policy_emails']  = $this->Common_model->getDetails('policy_email_ids', 'ref_policy_id', $id);
        $this->load->view('common/menu');
        $this->load->view('policy/policy_details_view', $data);
        $this->load->view('common/footer');
    }
    function edit()
    {
        $this->hasPermission('policy_edit');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id = $this->uri->segment(3);
            $this->Common_model->TxnBegin();
            $data    = $this->input->post();
            
            $where                   = 'ref_insurance_agency_id = ' . $data['ref_insurance_agency_id'] . ' AND ref_policy_category_id = ' . $data['ref_policy_category_id'] . ' AND policy_brokerage_from_date <= "' . date('Y-m-d') . '"';
            $order_by                = 'policy_brokerage_from_date DESC ';
            $limit                   = '0,1';
            $res_policy_brokerage    = $this->Common_model->getRecords('policy_brokerage', $where, '', $order_by, $limit);
            $policy_brokerage_amount = 0;
            if (isset($res_policy_brokerage) && !empty($res_policy_brokerage)) {
                $policy_brokerage_amount = ($data['policy_premium'] * $res_policy_brokerage[0]->policy_brokerage_percentage) / 100;
            }
            if (isset($data['ref_agent_id']) && $data['ref_agent_id']) {
                $where                      = 'ref_agent_id = ' . $data['ref_agent_id'] . ' AND ref_insurance_agency_id = ' . $data['ref_insurance_agency_id'] . ' AND ref_policy_category_id = ' . $data['ref_policy_category_id'] . ' AND policy_brokerage_from_date <= "' . date('Y-m-d') . '"';
                $order_by                   = 'policy_brokerage_from_date DESC ';
                $limit                      = '0,1';
                $res_agent_policy_brokerage = $this->Common_model->getRecords('agent_brokerage', $where, '', $order_by, $limit);
                $agent_brokerage_amount     = 0;
                if (isset($res_agent_policy_brokerage) && !empty($res_agent_policy_brokerage)) {
                    $agent_brokerage_amount = ($data['policy_premium'] * $res_agent_policy_brokerage[0]->policy_brokerage_percentage) / 100;
                }
            }
            
            $mv_data = array();
            if ($data['ref_policy_category_id'] == 1) {
                $mv_data = $data['mv_policy'];
            }
            unset($data['mv_policy']);
			$premium_amount                     = $data['policy_premium'] + $data['policy_tp_amount'];
	    
            $data['policy_category_st_sd'] = ($premium_amount * GST_PERCENTAGE ) / 100;
            
            $res = $this->Common_model->updateRecord('policy', $data, $id);
			
			$policy_tp_amount = $data['policy_tp_amount'];
			$this->Common_model->removeRecord('policy_brokerage_history','ref_policy_id',$res);
			
			$policy_brokerage = $this->Common_model->getDetails('policy_brokerage','ref_policy_category_id',$data['ref_policy_category_id']);
			
			$policy_brokerage_custom_field = $this->Common_model->getDetails('policy_brokerage_custom_field','ref_policy_brokerage_id',$policy_brokerage[0]->policy_brokerage_id);
			$policy_brokerage_custom_total = 0;
			if(isset($policy_brokerage_custom_field) && !empty($policy_brokerage_custom_field)){
				foreach($policy_brokerage_custom_field as $value){
					$custom_total = ($policy_tp_amount) * ($value->policy_custom_brokerage_value)/100;
					$policy_brokerage_custom_total = $custom_total + $policy_brokerage_custom_total;
				}
			}
			$total_brokerage_amount = $policy_brokerage_custom_total + $policy_brokerage_amount;
			$pb_data                            = array();
			$pb_data['ref_policy_id']           = $res;
			$pb_data['policy_brokerage_amount'] = $total_brokerage_amount;
		
			$res_1                              = $this->Common_model->addRecord('policy_brokerage_history', $pb_data);
			$this->Common_model->removeRecord('policy_brokerage_custom_value','ref_policy_id',$res);
			
			$cv_data['ref_policy_brokerage_history_id'] = $res_1 ;
			$brokerage_custom_total = 0;
			if(isset($policy_brokerage_custom_field) && !empty($policy_brokerage_custom_field)){
				foreach($policy_brokerage_custom_field as $val){
					$cv_data['ref_policy_id'] = $res;
					$cv_data['ref_policy_custom_brokerage_id'] = $val->policy_custom_brokerage_id;
					$cv_data['policy_custom_brokerage_value'] = $val->policy_custom_brokerage_value;
					$cv_data['policy_custom_brokerage_amount'] = ($policy_tp_amount) * ($val->policy_custom_brokerage_value)/100;	    
					$res_2                            = $this->Common_model->addRecord('policy_brokerage_custom_value', $cv_data);
				} 
			}
			
			 if (isset($data['ref_agent_id']) && $data['ref_agent_id']) {
				$ab_data                           = array();
				$ab_data['ref_policy_id']          = $res;
				$ab_data['ref_agent_id']           = $data['ref_agent_id'];
				$ab_data['agent_brokerage_amount'] = $agent_brokerage_amount;
				$res_2                             = $this->Common_model->addRecord('agent_brokerage_history', $ab_data);
			}
            
            if (isset($mv_data) && !empty($mv_data)) {
                $this->Common_model->removeRecord('motor_vehicle_policy', 'ref_policy_id', $id);
                $mv_data['ref_policy_id'] = $id;
                if (isset($_FILES['motor_vehicle_rc']['name']) && !empty($_FILES['motor_vehicle_rc']['name'])) {
                    $mv_data['motor_vehicle_rc'] = $this->Common_model->upload_file($_FILES['motor_vehicle_rc']['name'], $_FILES['motor_vehicle_rc']['tmp_name'], 'rc');
                }
                $this->Common_model->addRecord('motor_vehicle_policy', $mv_data);
            }
            $redirect_to = $data['redirect_to'];
            unset($data['redirect_to']);
            if ($res) {
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('policy_edit', $res);
                $_SESSION['success_msg'] = 'Policy successfully updated ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            redirect('policy');
        } else {
            $id                            = $this->uri->segment(3);
            $data['policy']                = $this->Common_model->getDetails('policy', 'policy_id', $id);
            $data['mv_policy']             = $this->Common_model->getDetails('motor_vehicle_policy', 'ref_policy_id', $id);
            $data['client_list_auto_comp'] = $this->Client_model->getClientList();
            $data['category_renewal_years'] = $this->Common_model->getDetails('policy_category', 'policy_category_id', $data['policy'][0]->ref_policy_category_id);
             
            $data['action']                = site_url('policy/edit/' . $id);
            $this->load->view('common/menu');
            $this->load->view('policy/policy_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    function policy_renewal()
    {
        $this->hasPermission('policy_renewal_add');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id = $this->uri->segment(3);
            $this->Common_model->TxnBegin();
            $data    = $this->input->post();
            $mv_data = array();
            if ($data['ref_policy_category_id'] == 2) {
                $mv_data = $data['mv_policy'];
            }
            unset($data['mv_policy']);
            $data['prev_policy_id'] = $id;
            $res                    = $this->Common_model->addRecord('policy', $data);
            if (isset($mv_data) && !empty($mv_data)) {
                $this->Common_model->removeRecord('motor_vehicle_policy', 'ref_policy_id', $id);
                $mv_data['ref_policy_id'] = $id;
                if (isset($_FILES['motor_vehicle_rc']['name']) && !empty($_FILES['motor_vehicle_rc']['name'])) {
                    $mv_data['motor_vehicle_rc'] = $this->Common_model->upload_file($_FILES['motor_vehicle_rc']['name'], $_FILES['motor_vehicle_rc']['tmp_name'], 'rc');
                }
                $this->Common_model->addRecord('motor_vehicle_policy', $mv_data);
            }
            $redirect_to = $data['redirect_to'];
            unset($data['redirect_to']);
            if ($res) {
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('policy_add', $res);
                $_SESSION['success_msg'] = 'Policy successfully added ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            redirect('policy');
        } else {
            $id                            = $this->uri->segment(3);
            $data['policy']                = $this->Common_model->getDetails('policy', 'policy_id', $id);
            $data['mv_policy']             = $this->Common_model->getDetails('motor_vehicle_policy', 'ref_policy_id', $id);
            $data['client_list_auto_comp'] = $this->Client_model->getClientList();
            $data['category_renewal_years'] = $this->Common_model->getDetails('policy_category', 'policy_category_id', $data['policy'][0]->ref_policy_category_id);
            $data['action']                = site_url('policy/add');
            $this->load->view('common/menu');
            $this->load->view('policy/policy_renewal_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    function upload_policy_pdf()
    {
        $this->hasPermission('policy_edit');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id = $this->input->post('policy_id');
            if (isset($_FILES['policy_pdf']) && !empty($_FILES['policy_pdf'])) {
                $policy_pdf                     = $this->Common_model->upload_file($_FILES['policy_pdf']['name'], $_FILES['policy_pdf']['tmp_name'], 'policy');
               
                $gd_data['file_name'] = $_FILES['policy_pdf']['name']; 
                $gd_data['file_path'] = $policy_pdf; 
                $gd_data['policy_id'] = $id; 
                $res_google_drive_file = $this->Common_model->Google_drive_action('upload_policy_file',$gd_data);
                
                $update_data                    = array();
                $update_data['google_drive_file_id'] = $res_google_drive_file['id'];
                $update_data['google_drive_file_link'] = $res_google_drive_file['alternateLink'];
                $update_data['google_drive_file_download_link'] = $res_google_drive_file['downloadUrl'];
                $this->db->where('policy_id', $id);
                $this->db->update('policy', $update_data);
                $afftectedRows = $this->db->affected_rows();
            }
            if ($afftectedRows) {
				unlink(FCPATH.$policy_pdf);				
                $_SESSION['success_msg'] = 'Policy PDF Successfully updated...';
            } else {
                $_SESSION['error_msg'] = 'Error...Please try again...';
            }
            redirect($this->agent->referrer());
        }
    }
    
    function upload_motor_vehicle_rc_file()
    {
        $this->hasPermission('policy_edit');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id = $this->input->post('ref_policy_id');
            if (isset($_FILES['motor_vehicle_rc']) && !empty($_FILES['motor_vehicle_rc'])) {
				$gd_data['motor_vehicle_rc'] = $this->Common_model->upload_file($_FILES['motor_vehicle_rc']['name'], $_FILES['motor_vehicle_rc']['tmp_name'], 'rc');
				$gd_data['ref_policy_id'] = $id;	   
				$this->db->where('ref_policy_id', $id);
				$this->db->update('motor_vehicle_policy', $gd_data);
				$afftectedRows = $this->db->affected_rows();
            }
            if ($afftectedRows) {
				unlink(FCPATH.$policy_pdf);				
                $_SESSION['success_msg'] = 'Motor Rc File Successfully updated...';
            } else {
                $_SESSION['error_msg'] = 'Error...Please try again...';
            }
            redirect($this->agent->referrer());
        }
    }
    	
	function downloadFile1( $file) {	
		
		$downloadUrl = $file['downloadUrl'];
		if ($downloadUrl) {
			$request = new Google_HttpRequest($downloadUrl, 'GET', null, null);
			$httpRequest = Google_Client::$io->authenticatedRequest($request);
			if ($httpRequest->getResponseHttpCode() == 200) {
				return $httpRequest->getResponseBody();
			} else {
			// An error occurred.
			return null;
			}
		} else {
			// The file doesn't have any content stored on Drive.
			return null;
		}
	}

	function manage_sharing($file_folder_Id){		
		
	}
    function delete()
    {
        $this->hasPermission('policy_delete');
        $this->Common_model->TxnBegin();
        $delete_id = $this->input->post('checkbox');
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('policy', 'policy_id', $id);
            }
        }
        if ($res) {
            $this->Common_model->TxnCommit();
            $this->Common_model->addUserActivity('policy_delete', $res);
            $_SESSION['success_msg'] = 'Policy successfully deleted ...';
        } else {
            $this->Common_model->TxnRollBack();
            $_SESSION['error_msg'] = 'Error occurred please try again...';
        }
        redirect('policy/getlist/1');
    }
    function delete_policy_claim()
    {
        $this->hasPermission('policy_delete');
        $this->Common_model->TxnBegin();
        $delete_id = $this->input->post('checkbox');

        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('policy_claim', 'policy_claim_id', $id);
            }
        }
        if ($res) {
            $this->Common_model->TxnCommit();
            $this->Common_model->addUserActivity('policy_claim_delete', $res);
            $_SESSION['success_msg'] = 'Policy Claim successfully deleted ...';
        } else {
            $this->Common_model->TxnRollBack();
            $_SESSION['error_msg'] = 'Error occurred please try again...';
        }
        redirect('policy/get_policy_claim_list');
    }
    
    
    function get_policy_brokerage_history_list()
    {
        $this->hasPermission('policy_view');
        $filter_data = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter_data = $this->input->post();
            $reset_data  = $this->input->post('reset');
            if (isset($reset_data)) {
                $this->session->unset_userdata('filter_data');
                $filter_data = '';
            } else {
                $this->session->set_userdata('filter_data', $filter_data);
            }
        } else {
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
        }
        $data['filter_data'] = $filter_data;
        $segment_3           = $this->uri->segment(3);
        $segment_4           = $this->uri->segment(4);
        $segment_5           = $this->uri->segment(5);
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data         = '';
            $data['filter_data'] = '';
        }
        if (isset($segment_3)) {
            $page = $segment_3;
        } else {
            $page = '1';
        }
        if (isset($segment_4)) {
            $sort = $segment_4;
        } else {
            $sort = 'policy_brokerage_history_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
        $data['page']      = $page;
        $filter_query_data = array();
        $data['limit']     = '';
        if (isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])) {
            $start                      = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit']              = '?limit=' . $_REQUEST['limit'];
        } else {
            $start = (($page - 1) * RPP);
        }
        $data['start']              = $start;
        $filter_query_data['start'] = $start;
        $filter_query_data['sort']  = $sort;
        $filter_query_data['order'] = $order;
        $table                      = array();
        $table['tbl_main']          = 'policy_brokerage_history';
        $data['mainlist_count']     = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']           = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        $data['tablefields']        = $this->Common_model->getTableFields('policy_brokerage_history');
        $data['operations']         = $this->Common_model->getFilterOperation();
        $data['init_listing_page']  = 'policy/get_policy_brokerage_history_list/';
        $data['listing_page']       = $data['init_listing_page'] . $page . '/';
        $data['filter_block']       = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        $this->load->view('common/menu');
        $this->load->view('policy/policy_brokerage_history_list_view', $data);
        $this->load->view('common/footer');
    }
    function exportPolicy()
    {
        $this->hasPermission('policy_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data              = array();
        $data['sort']      = 'policy_id';
        $data['order']     = 'ASC';
        $table['tbl_main'] = 'policy';
        $mainlist          = $this->Common_model->getList($table, $data, $filter_data, 'policy_id');
        $i                 = 1;
        
        $policy_premium_tot = 0;
        $premium_tot = 0;
        $st_sd_tot = 0;
        $brokerage_tot = 0;
        $tp_tot = 0;
        foreach ($mainlist as $key => $val) {
            $premium              = round($val->policy_premium + $val->policy_category_st_sd + $val->policy_tp_amount);
            $brokarage_percentage = $this->Common_model->getDetails('policy_brokerage', 'ref_policy_category_id', $val->ref_policy_category_id);
            if (isset($brokarage_percentage) && !empty($brokarage_percentage)) {
                $bro_per = $brokarage_percentage[0]->policy_brokerage_percentage;
            }
            $brokarage_amount = $this->Common_model->getDetails('policy_brokerage_history', 'ref_policy_id', $val->policy_id);
            if (isset($brokarage_amount) && !empty($brokarage_amount)) {
                $bro_amount = $brokarage_amount[0]->policy_brokerage_amount;
            }
            
            if($val->imported_policy){
				$bro_per = $val->policy_brokerage_percentage;
				$bro_amount = $val->policy_brokerage_amount;
			}
            $effect_date   = $this->Common_model->getDateFormat($val->policy_effect_date);
            $expiry_date   = $this->Common_model->getDateFormat($val->policy_expiry_date);
            $motor_details = $this->Common_model->getDetails('motor_vehicle_policy', 'ref_policy_id', $val->policy_id);
            
            $policy_premium_tot += $val->policy_premium;
            $premium_tot += $premium;
			$st_sd_tot += round($val->policy_category_st_sd);
			$brokerage_tot += $bro_amount;
			$tp_tot += $val->policy_tp_amount;
            
            $export_list[] = array(
                $val->policy_sort_order,
                $val->client_name,
                $val->insurance_agency_name,
                $val->policy_category_name,
                $val->policy_premium,
                round($val->policy_category_st_sd),
                $premium,
                $bro_per,
                $bro_amount,
                $val->policy_tp_amount,
                $val->policy_name,
                $effect_date,
                $expiry_date,
                $motor_details[0]->vehicle_type_name,
                $motor_details[0]->motor_vehicle_registration_no,
                $motor_details[0]->motor_vehicle_chasis_no,
                $motor_details[0]->motor_vehicle_engine_no,
                $motor_details[0]->motor_vehicle_make,
                $motor_details[0]->motor_vehicle_model,
                $motor_details[0]->motor_vehicle_seats,
                $motor_details[0]->motor_vehicle_gross_weight
            );
            $i++;
        }
        $export        = array();
        $export_column = array(
			'S.No',
            'Insured',
            'Insurer',
            'Class of Business',
            'Premium',
            'ST/SD',
            'Total Premium',
            '%of Brokarage',
            'Brokarage Amount',
            'TP Amount',
            'Policy Number',
            'Period of Insurance From',
            'Period of Insurance To',
            'Vehicle Type',
            'Registration No',
            'Chasis No',
            'Engine No',
            'Make',
            'Model',
            'No of Seats',
            'Gross Weight'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        $export[] = array('','','',$policy_premium_tot,$st_sd_tot,$premium_tot,'',$brokerage_tot,$tp_tot,'','','','','','','','','','');
        $this->Common_model->generateExcel($export, 'Policy_List_' . date('d-m-Y_H:i:s'));
    }
    public function exportPolicyPdf()
    {
        $this->hasPermission('policy_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data                 = array();
        $data['sort']         = 'policy_id';
        $data['order']        = 'ASC';
        $table['tbl_main']    = 'policy';
        $mainlist             = $this->Common_model->getList($table, $data, $filter_data, 'policy_id');
        $data['title']        = 'Policy List';
        $data['row_header']   = array();
        $data['row_header'][] = array(
            'name' => 'S No',
            'width' => '5%',
            'align' => 'center'
        );
        $data['row_header'][] = array(
            'name' => 'Insured',
            'width' => '20%',
            'align' => 'left'
        );
        $data['row_header'][] = array(
            'name' => 'Insurer',
            'width' => '10%',
            'align' => 'left'
        );
        $data['row_header'][] = array(
            'name' => 'Class of Business',
            'width' => '18%',
            'align' => 'left'
        );
        $data['row_header'][] = array(
            'name' => 'Tot Prem',
            'width' => '8%',
            'align' => 'right'
        );
        $data['row_header'][] = array(
            'name' => 'Policy Number',
            'width' => '8%',
            'align' => 'left'
        );
        $data['row_header'][] = array(
            'name' => 'Effect From',
            'width' => '10%',
            'align' => 'left'
        );
        $data['row_header'][] = array(
            'name' => 'Expiry On',
            'width' => '10%',
            'align' => 'left'
        );
        $data['row_data']     = array();
        if (isset($mainlist) && !empty($mainlist)) {
            $i = 1;
            foreach ($mainlist as $key => $val) {
                $address            = array();
                $premium            = $val->policy_premium + $val->policy_category_st_sd + $val->policy_tp_amount;
                $effect_date        = $this->Common_model->getDateFormat($val->policy_effect_date);
                $expiry_date        = $this->Common_model->getDateFormat($val->policy_expiry_date);
                $data['row_data'][] = array(
                    $i,
                    $val->client_name,
                    $val->insurance_agency_name,
                    $val->policy_category_name,
                    $premium,
                    $val->policy_name,
                    $effect_date,
                    $expiry_date
                );
                $i++;
            }
        }
        $this->load->library('parser');
        $html        = $this->parser->parse('template/pdf/list_tmp', $data);
        $header_html = $this->parser->parse('template/pdf/pdf_header', $data);
        $footer_html = $this->parser->parse('template/pdf/pdf_footer', $data);
        $file_name   = 'Policy_List_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html, $footer_html, $html, $file_name, 'P', 'I');
    }
    function policy_claim()
    {
        $id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = $this->input->post();
           
            //~ echo '<pre>';
            //~ print_r($data);
            //~ echo '</pre>';
            //~ exit;
            $res_policy = $this->Common_model->getDetails('policy', 'policy_id', $id);
            
            if (!empty($_FILES['policy_doc']['name'][0])) {
                $this->db->query('DELETE FROM policy_claim_document WHERE ref_policy_id = "' . $id . '"');
                $cpt = count($_FILES['policy_doc']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    if (!empty($_FILES['policy_doc']['name'][$i])) {
                        $ext                                    = $this->Common_model->getExtension($_FILES['policy_doc']['name'][$i]);
                        $src_file                               = $data['policy_doc_title'][$i] . '.' . $ext;
                        $file_path                              = $this->Common_model->upload_file($src_file, $_FILES['policy_doc']['tmp_name'][$i], 'claim_docs');
                        $ext                                    = $this->Common_model->getExtension($file_path);
                        $pcd_data['policy_claim_document_name'] = $data['policy_doc_title'][$i];
                        if (empty($data['policy_doc_title'][$i])) {
                            $pcd_data['policy_claim_document_file'] = $file_path;
                        } else {
                            $pcd_data['policy_claim_document_file'] = $file_path;
                        }
                        $pcd_data['ref_policy_id'] = $id;
                        $res                       = $this->Common_model->addRecord('policy_claim_document', $pcd_data);
                    }
                }
            }
            // Get Additionall docs like FIR copy,Insurance,etc
            $res_policy_claim_docs    = $this->Common_model->getDetails('policy_claim_document', 'ref_policy_id', $id);
            $attach_policy_claim_docs = array();
            if (isset($res_policy_claim_docs) && !empty($res_policy_claim_docs)) {
                foreach ($res_policy_claim_docs as $key => $val) {
                    $attach_policy_claim_docs[] = FCPATH . $val->policy_claim_document_file;
                }
            }
            $res_policy                 = $this->Common_model->getDetails('policy', 'policy_id', $id);
            
			$gd_data['file_download_link'] = $res_policy[0]->google_drive_file_download_link; 
			$res_gd_file_content = $this->Common_model->Google_drive_action('copy_policy_file',$gd_data);
            
			$tmp_policy_file_name = FCPATH."uploads/temp_policy/".$res_policy[0]->policy_name."_".strtoupper(str_replace(' ','_',$res_policy[0]->client_name)).".pdf";
			$fp = fopen($tmp_policy_file_name,"wb");
			fwrite($fp,$res_gd_file_content);
			fclose($fp);		
			$attach_policy_claim_docs[] = $tmp_policy_file_name;
			
            $to_address                 = array();
            $email_additional           = array();
            if (isset($data['insurance_agency_email'])) {
                $to_address = $data['insurance_agency_email'];
            }
            if (!empty($data['email_additional'])) {
                $email_additional = explode(',', $data['email_additional']);
                $to_address       = array_merge($to_address, $email_additional);
            }
            $mail_data                          = array();
            $mail_data['from_address']          = FROM_ADDRESS;
            $mail_data['to_address']            = implode(',', $to_address);
            $mail_data['subject']               = $res_policy[0]->client_name . ' - Claim Intimation ( #' . $res_policy[0]->policy_name . ' )';
            $mail_data['message']               = str_replace('&#10;', 'br>', $data['email_message']);
            $mail_data['name']                  = $res_policy[0]->insurance_agency_name;
            $mail_data['attachment']            = $attach_policy_claim_docs;
            $mail_data['template_path']         = 'template/email/policy_claim.php';
            $res                                = $this->Common_model->sendEmail($mail_data);
           
            // Send SMST to client
            $to_mobile = array();
			$mobile_additional = array();
			if(isset($data['client_mobile'])){
				$to_mobile = $data['client_mobile'];
			}
				
			$mobile_additional = trim($data['mobile_additional']);	
			if(!empty($mobile_additional)){
				$mobile_additional = explode(',',$data['mobile_additional']);
				$to_mobile = array_merge($to_mobile,$mobile_additional);
			}
			$mobile = implode(',',$to_mobile);
			
			$sms_template_content = $data['sms_message'];
			$message = preg_replace( "/\r|\n/", "***", $sms_template_content );
			$message = $this->html2ascii($message);
			$message = str_replace( "\n", "", $message );
			$message = str_replace( "%0a", "***", $message );
			$message = str_replace( "******", "***", $message );			
			$res_sms = $this->Common_model->smssend( $mobile,$message);			
			if (strpos($res_sms, 'alert') !== false){ 
				$_SESSION['success_msg'] .= 'SMS successfully sent to client...';
			}else{
				$_SESSION['error_msg'] .= 'SMS not send...';
			}
			
			$pc_data['client_sms_status'] = $res_sms;
            $pc_data['ref_policy_id']           = $id;
            $pc_data['ref_client_id']           = $res_policy[0]->ref_client_id;
            $pc_data['ref_insurance_agency_id'] = $res_policy[0]->ref_insurance_agency_id;
            $pc_data['ref_policy_category_id']  = $res_policy[0]->ref_policy_category_id;
            $pc_data['accident_location']       = $data['accident_location'];
            $pc_data['accident_date_time']      = $data['accident_date_time'];
            $pc_data['cause_of_loss']           = $data['cause_of_loss'];
            $pc_data['estimate']                = $data['estimate'];
            $pc_data['insurance_agency_email']  = implode(',', $to_address);;
            $pc_data['mail_status']             = $res;
            $this->Common_model->addRecord('policy_claim', $pc_data);
            if ($res) {
				unlink($tmp_policy_file_name);
                $_SESSION['success_msg'] .= 'Policy Claim mail successfully sent ...';
            } else {
                $_SESSION['error_msg'] .= 'Mail not send...Please try again...';
            }            
            redirect('policy/get_policy_claim_list');
        } else {
            $res_policy                               = $this->Common_model->getDetails('policy', 'policy_id', $id);
            $data['policy']                           = $res_policy;
            $data['insurance_agency_contact_numbers'] = $this->Common_model->getDetails('insurance_agency_contact_numbers', 'ref_insurance_agency_id', $res_policy[0]->ref_insurance_agency_id);
            $data['insurance_agency_email_ids']       = $this->Common_model->getDetails('insurance_agency_email_ids', 'ref_insurance_agency_id', $res_policy[0]->ref_insurance_agency_id);
            $data['subject']                          = '';
            $data['message']                          = '';
            if (isset($res_policy) && !empty($res_policy)) {
                $data['subject']       = $res_policy[0]->client_name . ' - Claim Intimation ( #' . $res_policy[0]->policy_name . ' )';
                $email_message         = 'Hi ' . $res_policy[0]->insurance_agency_name . ',&#10;Please find the attached policy copy for claim' . '&#10;';
                $sms_message           = '&#10;Thanks&#10;Arjun Ravindar';
                $data['email_message'] = $email_message . $sms_message;
            }
            
            //$where = 'ref_insurance_branch_id = "'.$data['policy'][0]->ref_insurance_branch_id.'"';
            
           // $data['policy_claim_email_template'] = $this->Common_model->getRecords('policy_claim_email_template',$where);
           
            $data['client_numbers']  = $this->Common_model->getDetails('client_contact_numbers', 'ref_client_id', $res_policy[0]->ref_client_id);
            
            //$where = 'ref_insurance_branch_id = "'.$data['policy'][0]->ref_insurance_branch_id.'"';
            
            $res_client_claim_sms_template = $this->Common_model->getRecords('client_policy_claim_sms_template','client_policy_claim_sms_template_id','1');
            
		$sms_template_content = $res_client_claim_sms_template[0]->client_policy_claim_sms_template_content;
		       
        //echo $transport_qty;
        if (isset($res_client_claim_sms_template) && !empty($res_client_claim_sms_template)) {     
			$sms_template_content = str_replace('{client_name}', '<b>' . $res_policy[0]->client_name . '</b>', $sms_template_content);
			
			$sms_template_content = str_replace('{policy_category_name}', '<b>' . $res_policy[0]->policy_category_name . '</b>', $sms_template_content);
			
			$sms_template_content = str_replace('{policy_product_name}', '<b>' . $res_policy[0]->policy_product_name . '</b>', $sms_template_content);
			
			$sms_template_content = str_replace('{policy_name}', '<b>' . $res_policy[0]->policy_name . '</b>', $sms_template_content);
           
            $sms_template_content = nl2br($sms_template_content);
            $sms_template_content = str_replace('{', '{<b>', $sms_template_content);
            $sms_template_content = str_replace('}', '</b>}', $sms_template_content);
            $data['sms_template_content'] = $sms_template_content;
        } else {
			$data['sms_template_content'] = 'Template not available...';
        }
        
            $this->load->view('common/menu');
            $this->load->view('policy/policy_claim_notification_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    
    function html2ascii($s){
		 // convert links
		 $s = preg_replace('/<a\s+.*?href="?([^\" >]*)"?[^>]*>(.*?)<\/a>/i','$2 ($1)',$s);
		 // convert p, br and hr tags
		 $s = preg_replace('@<(b|h)r[^>]*>@i',"%0a",$s); 
		 // decode any entities
		 $s = strtr($s,array_flip(get_html_translation_table(HTML_ENTITIES)));
		 // strip any remaining HTML tags
		 $s = strip_tags($s);
		 // return the string
		 return $s;
	}
	
    function get_policy_claim_list()
    {
        $this->hasPermission('policy_view');
        $filter_data = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter_data = $this->input->post();
            $reset_data  = $this->input->post('reset');
            if (isset($reset_data)) {
                $this->session->unset_userdata('filter_data');
                $filter_data = '';
            } else {
                $this->session->set_userdata('filter_data', $filter_data);
            }
        } else {
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
        }
        $data['filter_data'] = $filter_data;
        $segment_3           = $this->uri->segment(3);
        $segment_4           = $this->uri->segment(4);
        $segment_5           = $this->uri->segment(5);
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data         = '';
            $data['filter_data'] = '';
        }
        if (isset($segment_3)) {
            $page = $segment_3;
        } else {
            $page = '1';
        }
        if (isset($segment_4)) {
            $sort = $segment_4;
        } else {
            $sort = 'policy_claim_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
        $data['page']      = $page;
        $filter_query_data = array();
        $data['limit']     = '';
        if (isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])) {
            $start                      = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit']              = '?limit=' . $_REQUEST['limit'];
        } else {
            $start = (($page - 1) * RPP);
        }
        $data['start']              = $start;
        $filter_query_data['start'] = $start;
        $filter_query_data['sort']  = $sort;
        $filter_query_data['order'] = $order;
        $table['tbl_main']          = 'policy_claim';
        $data['mainlist_count']     = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']           = $this->Common_model->getList($table, $filter_query_data, $filter_data, 'policy_id');
        $data['tablefields']        = $this->Common_model->getTableFields('policy_claim');
        $data['operations']         = $this->Common_model->getFilterOperation();
        $data['init_listing_page']  = 'policy/get_policy_claim_list/';
        $data['listing_page']       = $data['init_listing_page'] . $page . '/';
        $data['filter_block']       = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
	
        $this->load->view('common/menu');
        $this->load->view('policy/policy_claim_list_view', $data);
        $this->load->view('common/footer');
    }
    function export_policy_claim_excel()
    {
        $this->hasPermission('policy_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data              = array();
        $data['sort']      = 'policy_claim_id';
        $data['order']     = 'ASC';
        $table['tbl_main'] = 'policy_claim';
        $mainlist          = $this->Common_model->getList($table, $data, $filter_data);
        $i                 = 1;
        foreach ($mainlist as $key => $val) {
            $export_list[] = array(
                $val->client_name,
                $val->insurance_agency_name,
                $val->policy_category_name,
                $val->policy_name,
                $val->accident_location,
                $this->Common_model->getDateTimeFormat($val->accident_date_time),
                $val->cause_of_loss,
                $val->estimate,
                $this->Common_model->getDateFormat($val->settled_date),
                $val->settled_amount,
                $val->remarks_serveyor,
                $val->third_party_adminstrator
            );
            $i++;
        }
        $export        = array();
        $export_column = array(           
            'Client Name',
            'Insurer',
            'Class of Business',
            'Policy Number',
            'Date of Accident',
            'Location of Accident',
            'Cause of Loss',
            'Estimate',
            'Settled Date',
            'Settled Amount',
            'Remarks Serveyor',
            'TPA'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export, 'Policy_claim_report_list_' . date('d-m-Y_H:i:s'));
    }
    function get_policy_product()
    {
        $result = $this->Common_model->getDetails('policy_product', 'ref_policy_category_id', $_REQUEST['id']);
        $json   = array();
        if (!empty($result)) {
            foreach ($result as $val) {
                $json[] = array(
                    'id' => $val->policy_product_id,
                    'name' => $val->policy_product_name
                );
            }
        }
        echo json_encode($json);
        exit;
    }
    function get_policy_plan()
    {
        $result = $this->Common_model->getDetails('policy_plan', 'ref_policy_product_id', $_REQUEST['id']);
        $json   = array();
        if (!empty($result)) {
            foreach ($result as $val) {
                $json[] = array(
                    'id' => $val->policy_plan_id,
                    'name' => $val->policy_plan_name
                );
            }
        }
        echo json_encode($json);
        exit;
    }
    function get_renewal_years_from_category()
    {
        if (isset($_REQUEST['category_id'])) {
            $res_years = $this->Common_model->getDetails('policy_category', 'policy_category_id', $_REQUEST['category_id']);
            $res       = $res_years[0]->policy_renewal_period;
            echo json_encode($res);
            exit;
        }
    }
    
    function import_policy(){
	 if($this->input->server('REQUEST_METHOD') == 'POST') {
		$data         = $this->input->post();
		$tot_ins = 0;
		$duplicate = 0;
		$duplicate_policy = array();
            $data['file'] = $_FILES['policy_file'];
            if (isset($_FILES['policy_file'])) {
                $file                         = $_FILES['policy_file']['tmp_name'];
                $handle                       = fopen($file, "r");
                
                $c                            = 0;
                $i                            = 0;
                $_SESSION['inserted_rows']    = 0;
                $_SESSION['notinserted_rows'] = 0;
                $_SESSION['not_inserted']     = array();
                $_SESSION['duplication']      = array();
                
                $this->db->query("TRUNCATE TABLE policy");
                $this->db->query("TRUNCATE TABLE client");
                $this->db->query("TRUNCATE TABLE policy_brokerage_history");
                $this->db->query("TRUNCATE TABLE motor_vehicle_policy");
                $this->db->query("TRUNCATE TABLE company");
                
                while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
					if($i > 0){	
					//~ echo '<pre>';
					//~ print_r($filesop);
					//~ echo '</pre>';	
					//~ exit;			
					$m_data = array();
					$client = trim($filesop[0]);
					$m_data['policy_name'] = str_replace("'",'',trim($filesop[10]));
					$m_data['ref_insurance_agency_id'] = $filesop[1];
					$m_data['ref_insurance_branch_id'] = $filesop[2];
					$m_data['ref_policy_category_id'] = $filesop[3];
					$m_data['ref_policy_product_id'] = $filesop[15];
					$m_data['policy_date'] = date('Y-m-d',strtotime(trim(str_replace('/','-',$filesop[11]))));
					$m_data['policy_effect_date'] = date('Y-m-d',strtotime(trim(str_replace('/','-',$filesop[11]))));
					$m_data['policy_expiry_date'] = date('Y-m-d',strtotime(trim(str_replace('/','-',$filesop[12]))));
					$m_data['policy_premium'] = str_replace(",",'',$filesop[4]);
					$m_data['policy_category_st_sd'] = str_replace(",",'',$filesop[5]);
					$m_data['policy_brokerage_percentage'] = str_replace('%','',$filesop[7]);
					$m_data['policy_brokerage_amount'] = str_replace(",",'',$filesop[8]);
					$m_data['policy_tp_amount'] = str_replace(",",'',$filesop[9]);
					$m_data['imported_policy'] = 1;
					$company = str_replace("'",'',trim($filesop[13]));
					$vehicle_no = '';
					if($filesop[3] == 1){
						$vehicle_no = $filesop[14];
					}			
					$m_data['ref_company_id'] = 0;		
						if(!empty($client)){	
							//$res_policy = $this->Common_model->getDetails('policy','policy_name',$m_data['policy_name']);
								//if(empty($res_policy)){					
								if(!empty($company)){
									$res_company = $this->Common_model->getDetails('company','company_name',$company);
									if(empty($res_company)){
										$cp_data['company_name'] = $company;
										
										$m_data['ref_company_id'] = $this->Common_model->addRecord('company',$cp_data);
									}else{
										$m_data['ref_company_id'] = $res_company[0]->company_id;
									}
								}
								
								
								$res_client = $this->Common_model->getDetails('client','client_name',trim($client));
								if(empty($res_client)){
									$c_data['client_name'] = $client;
									$c_data['ref_company_id'] = $m_data['ref_company_id'];
									$c_data['ref_salutation_id'] = 7;
									$c_data['ref_data_source_id'] = 7;
									$c_data['ref_client_type_id'] = 2;
									$c_data['ref_district_id'] = 533;
									$c_data['ref_state_id'] = 1503;
									$c_data['ref_country_id'] = 99;
									$c_data['client_data_collection_date_and_time'] = date('Y-m-d H:i:s');
									$m_data['ref_client_id'] = $this->Common_model->addRecord('client',$c_data);
								}else{
									$m_data['ref_client_id'] = $res_client[0]->client_id;
								}
								
								//~ echo '<pre>';
							//~ print_r($m_data);
							//~ echo '</pre>';	
							//~ exit;
							
								$res = $this->Common_model->addRecord('policy',$m_data);
								if($res){
									$tot_ins++;
									if(!empty($vehicle_no)){
										$v_data['ref_policy_id'] = $res;
										$v_data['motor_vehicle_registration_no'] = $vehicle_no;
										$this->Common_model->addRecord('motor_vehicle_policy',$v_data);
									}
									
									// Import Policy Brokerage
									$pb_data['ref_policy_id'] = $res;
									$pb_data['policy_brokerage_amount'] = $filesop[8];
									$pb_data['policy_brokerage_perc'] = str_replace('%','',$filesop[7]);[8];
									$this->Common_model->addRecord('policy_brokerage_history',$pb_data);
								}
							//~ }else{
								//~ $duplicate++;
								//~ $duplicate_policy[] = $m_data['policy_name'];
							//~ }
						}
					
					
					
                }
                 $i++;
			}
            }
				//~ echo '<pre>';
				//~ print_r($duplicate_policy);
				//~ echo '</pre>';
			if(isset($duplicate_policy) && !empty($duplicate_policy)){		
				$duplicate_policy_list = implode('<br>',$duplicate_policy);
			}
			
            $_SESSION['success_msg'] = 'Policy successfully Imported ( '.$tot_ins.' Records )...Duplicates ( '.$duplicate.' Records )<br>Duplicate Policy Nos List<br>'.$duplicate_policy_list;
            
            redirect('policy');
		  }else{
			$this->load->view('common/menu');
			$this->load->view('policy/import_policy_form_view', $data);
			$this->load->view('common/footer');
	    }
    }
    
    function policy_category_summary(){
		$filter_data = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter_data = $this->input->post();
            $reset_data  = $this->input->post('reset');
            if (isset($reset_data)) {
                $this->session->unset_userdata('filter_data');
                $filter_data = '';
            } else {
                $this->session->set_userdata('filter_data', $filter_data);
            }
        } else {
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
        }
        $data['filter_data'] = $filter_data;
        
		if(isset($filter_data) && !empty($filter_data)){
			$data['mainlist'] = $this->Policy_model->policy_category_summary($filter_data);
		}
		$data['action'] = site_url('policy/policy_category_summary');
		$this->load->view('common/menu');
		$this->load->view('policy/policy_category_summary_view', $data);
		$this->load->view('common/footer');
	}
	
	
	
	function export_policy_category_summary_excel(){
		$filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
		$mainlist = $this->Policy_model->policy_category_summary($filter_data);
		$i = 1;
		$tot_count = 0;
		$tot_premium = 0;
		if(isset($mainlist) && !empty($mainlist)){
			foreach($mainlist as $key => $val){
				$tot_count += $val->count;
				$tot_premium += $val->total;
				$export_list[] = array(
					$val->policy_product_name,
					$val->policy_category_name,
					$val->count,
					$val->total
				);
			$i++;	
			}
		}
		$export        = array();
        $export_column = array(
            'Product',
            'Category',
            'Total Count',
            'Total Premium'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        $export[] = array(
			'',
			'',
			$tot_count,
			$tot_premium
        );
        $this->Common_model->generateExcel($export, 'Policy_Category_Summary_' . date('d-m-Y_H:i:s'));
	}
	
	public function export_policy_category_summary_pdf()
    {
        $this->hasPermission('policy_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        
        $mainlist = $this->Policy_model->policy_category_summary($filter_data);
		$i = 1;
		$tot_count = 0;
		$tot_premium = 0;
		if(isset($mainlist) && !empty($mainlist)){
			foreach($mainlist as $key => $val){
				$tot_count += $val->count;
				$tot_premium += $val->total;
				$data['row_data'][] = array(
					$i,
					$val->policy_product_name,
					$val->policy_category_name,
					$val->count,
					number_format($val->total)
				);
			$i++;	
			}
		}
		
		$data['row_data'][] = array(
			'',
			'',
			'',
			'<B>'.$tot_count.'</B>',
			'<B>'.number_format($tot_premium).'</B>'
		);
        $data['title']        = 'Policy Summary';
        $data['row_header']   = array();
        $data['row_header'][] = array(
            'name' => 'S No',
            'width' => '5%',
            'align' => 'center'
        );
        $data['row_header'][] = array(
            'name' => 'Class of Business',
            'width' => '30%',
            'align' => 'left'
        );
        $data['row_header'][] = array(
            'name' => 'Category',
            'width' => '20%',
            'align' => 'left'
        );
        $data['row_header'][] = array(
            'name' => 'Tot Policy',
            'width' => '10%',
            'align' => 'center'
        );
        $data['row_header'][] = array(
            'name' => 'Tot Prem',
            'width' => '10%',
            'align' => 'right'
        );
       
              
        $this->load->library('parser');
        $html        = $this->parser->parse('template/pdf/list_tmp', $data);
        $header_html = $this->parser->parse('template/pdf/pdf_header', $data);
        $footer_html = $this->parser->parse('template/pdf/pdf_footer', $data);
        $file_name   = 'Policy_Summary_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html, $footer_html, $html, $file_name, 'P', 'I');
    }
    
    
    function map_google_drive_file(){
		$res = $this->Common_model->getDetails('mytable','delete_status','0');
		
		if(isset($res) && !empty($res)){
			foreach($res as $key => $val){
				$gd_data['fileId'] = $val->id;
				
				$res_file = $this->Common_model->Google_drive_action('get_file',$gd_data);
				echo '<pre>';
				print_r($gd_data);
				echo '</pre>';
			}
		}			
	}
	
	function send_reminder_sms()
    {
        //$this->hasPermission('policy_delete');
        $type = $this->uri->segment(3);
        $this->Common_model->TxnBegin();
        $data = $this->input->post();
        $policy_id = $data['checkbox'];
		//~ echo '<pre>';
		//~ print_r($data);
		//~ echo '</pre>';
		//~ exit;	
		//~ echo $_SERVER['HTTP_REFERER'];
		//~ exit;
		$sms_sent_list = array();
		$sms_not_send_list = array();
		$mobile_empty_list = array();
		if(isset($data['sms_message']) && !empty($data['sms_message'])){	
			if (!empty($policy_id)) {
				foreach ($policy_id as $key => $id) {
					$res_policy = $this->Common_model->getDetails('policy','policy_id',$id);
					
					$res_mobile = $this->Client_model->get_client_contact_number($res_policy[0]->ref_client_id);
					
					$sms_template_content = '';
					$sms_template_content = $data['sms_message'];
					
					if (!empty($res_policy[0]->client_name)) {
						$sms_template_content = str_replace('{client_name}', '' . $res_policy[0]->client_name . '', $sms_template_content);
					}
					if (!empty($res_policy[0]->policy_category_name)) {
						$sms_template_content = str_replace('{policy_category_name}', '' . $res_policy[0]->policy_category_name . '', $sms_template_content);
					}
					if (!empty($res_policy[0]->policy_product_name)) {
						$sms_template_content = str_replace('{policy_product_name}', '' . $res_policy[0]->policy_product_name . '', $sms_template_content);
					}
					if (!empty($res_policy[0]->policy_name)) {
						$sms_template_content = str_replace('{policy_name}', '' . $res_policy[0]->policy_name . '', $sms_template_content);
					}
					if (!empty($res_policy[0]->policy_expiry_date)) {
						$sms_template_content = str_replace('{policy_expiry_date}', '' . $this->Common_model->getDateFormat($res_policy[0]->policy_expiry_date) . '', $sms_template_content);
					}
					$message = preg_replace( "/\r|\n/", "***", $sms_template_content );
					$message = $this->html2ascii($message);
					$message = str_replace( "\n", "", $message );
					$message = str_replace( "%0a", "***", $message );
					$message = str_replace( "******", "***", $message );			
					
					if(!empty($res_mobile)){
						$res = $this->Common_model->smssend($res_mobile, $message);
						if (strpos($res, 'alert') !== false) {
							$sms_sent_list[] = $res_policy[0]->client_name.' - '.$res_policy[0]->policy_name;
							$u_data['sms_reminder_'.$type] = 1; 
							$this->Common_model->updateRecord('policy',$u_data,$res_policy[0]->policy_id);
						}else{
							$sms_not_send_list[] = $res_policy[0]->client_name.' - '.$res_policy[0]->policy_name;	
						}						
					}else{
						$mobile_empty_list[] = $res_policy[0]->client_name.' - '.$res_policy[0]->policy_name;
					}
				}
			}
		}else{
			$_SESSION['error_msg'] = 'Renewal Reminder Template not available...';
		}
		
		
		if(!empty($sms_sent_list)){
			$_SESSION['success_msg'] = 'Policy renewal reminder successfully sent to following clients ...<br>'.implode('<br>',$sms_sent_list);
		} 
		if(!empty($sms_not_send_list)){
			$_SESSION['error_msg'] .= 'Error on sending SMS for following clients ...<br>'.implode('<br>',$sms_not_send_list);
		}
		if(!empty($mobile_empty_list)){
			$_SESSION['error_msg'] .= '<br>Mobile not available for following clients ...<br>'.implode('<br>',$mobile_empty_list);
		}
		
		//exit;
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
}
?>
