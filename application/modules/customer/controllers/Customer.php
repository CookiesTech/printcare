<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Customer_model'
        ));
        $this->load->helper(array(
            'form'
        ));
       // $this->load->library("Pdf");
        $session_data       = $this->session->userdata( SESSION_LOGIN . 'logged_in' );
        $data['username']   = $session_data['username'];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        if (empty($data['permission'])) {
            redirect('login');
        }
        
		
			$data['title'] = 'Customer';
		
		      
        $this->load->view('common/header', $data);
       // echo $this->output->enable_profiler(TRUE); 
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
	
	function index(){
		$this->getlist();
	}
    function getlist()
    {
        $this->hasPermission('customer_view');
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
        //$data      = array();
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
        // If not pagination page remove filter data from session
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
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
            $sort = 'customer_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
        
         $data['page']             = $page; // No used for Redirect to same page after delete action in page 2, page 3,etc...
        
        $filter_query_data      = array();
        $data['limit'] = '';
        if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit'] = '?limit='.$_REQUEST['limit'];
        }else{
            $start                     = (($page - 1) * RPP);
        }
        
        $data['start']             = $start; // Generate SNO in result table based on page number
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;
        $branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
        if($branch_id>0)
        {
            $where=" customer.ref_branch_id=".$branch_id." ";
        }
        else
        {
            $where=" 1 ";
        } 
        $table['tbl_main']           = 'customer';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data,'customer_id',$where);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data,'customer_id',$where);
       
        $data['tablefields']      = $this->Common_model->getTableFields('customer');
   
        
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'customer/getlist/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        $this->load->view('common/menu');
        $this->load->view('customer/customer_list_view', $data);
        $this->load->view('common/footer');
    }
    function calls()
    {
        $this->hasPermission('customer_view');
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
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
        // If not pagination page remove filter data from session
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
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
            $sort = 'customer_call_date_and_time';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
         $data['page']             = $page; // No used for Redirect to same page after delete action in page 2, page 3,etc...
        
        $filter_query_data      = array();
        $data['limit'] = '';
        if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit'] = '?limit='.$_REQUEST['limit'];
        }else{
            $start                     = (($page - 1) * RPP);
        }
        
        $data['start']             = $start; // Generate SNO in result table based on page number
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;
        
        $table                     = array();
        $table['tbl_main']         = 'customer_calls';
        $data['mainlist_count']    = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']          = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        $data['callfeedback']      = $this->Common_model->getDropdownList('customer_call_feedback');
        $data['callnotconnect']    = $this->Common_model->getDropdownList('customer_call_not_connected');
        $data['tablefields']       = $this->Common_model->getTableFields('customer_calls');
        $data['operations']        = $this->Common_model->getFilterOperation();
        //$data[ 'mainlist' ] = $this->Customer_model->getClientCallList();
        $data['init_listing_page'] = 'customer/calls/';
        $data['listing_page']      = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $this->load->view('common/menu');
        $this->load->view('customer/customer_call_list_view', $data);
        $this->load->view('common/footer');
    }
    function callview_old()
    {
        $this->hasPermission('customer_view');
        $id                     = $this->uri->segment(3);
        $data['mainlist']       = $this->Common_model->getDetails('customer_calls', 'ref_customer_id', $id, 'customer_call_date_and_time', 'DESC');
        $data['id']             = $id;
        $data['callfeedback']   = $this->Common_model->getDropdownList('customer_call_feedback');
        $data['callnotconnect'] = $this->Common_model->getDropdownList('customer_call_not_connected');
        $this->load->view('common/menu');
        $this->load->view('customer/customer_call_details_view', $data);
        $this->load->view('common/footer');
    }
    
    function callview()
    {
        $this->hasPermission('customer_view');
        $id                     = $this->uri->segment(3);
        $data['customer_call']       = $this->Common_model->getDetails('customer_calls', 'customer_call_id', $id);
        $this->load->view('common/menu');
        $this->load->view('customer/customer_call_details_view', $data);
        $this->load->view('common/footer');
    }
    function appointments()
    {
        $this->hasPermission('customer_view');
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
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
        // If not pagination page remove filter data from session
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
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
            $sort = 'appointment_process_date';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
       $data['page']             = $page; // No used for Redirect to same page after delete action in page 2, page 3,etc...
        
        $filter_query_data      = array();
        $data['limit'] = '';
        if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit'] = '?limit='.$_REQUEST['limit'];
        }else{
            $start                     = (($page - 1) * RPP);
        }
        
        $data['start']             = $start; // Generate SNO in result table based on page number
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;
        $table['tbl_main']           = 'customer_appointments';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        $data['tablefields']         = $this->Common_model->getTableFields('customer_appointments');
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['appointmentfeedback'] = $this->Common_model->getDropdownList('appointment_feedback');
        $data['user']            = $this->Common_model->getDropdownList('user');
        $data['init_listing_page']   = 'customer/appointments/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $this->load->view('common/menu');
        $this->load->view('customer/customer_appointment_list_view', $data);
        $this->load->view('common/footer');
    }

    function import_customer_outstanding(){
	 if($this->input->server('REQUEST_METHOD') == 'POST') {
		//~ $main_data = $this->input->post();
			//~ $path = $_FILES['customer_file']['tmp_name'];;
			//~ $data = new Spreadsheet_Excel_Reader($path);
			//~ $tot_dup = 0;
			//~ $tot_ins = 0;
			//~ $start = 5; // lines to skip
			//~ //if(!empty($main_data['sharetrading_date'])){
				//~ for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
				//~ {	
					//~ if(count($data->sheets[$i][cells])>0) // checking sheet not empty
					//~ {
			//~ for($j=$start;$j<=count($data->sheets[$i][cells]);$j++) // loop used to get each row of the sheet
						//~ { 
		    //~ if($data->sheets[$i][cells][$j][1] !=''){
			//~ $customer_data['date'] = $data->sheets[$i][cells][$j][1];
			//~ $customer_data['ref_no'] = $data->sheets[$i][cells][$j][2];
			//~ $customer_data['op_amt'] = $data->sheets[$i][cells][$j][4];
			//~ $customer_data['pen_amt'] = $data->sheets[$i][cells][$j][5];
			//~ $customer_data['due_days'] = $data->sheets[$i][cells][$j][6];
			//~ echo "<pre>";
			//~ print_r($customer_data);
			//~ 
			//~ 
		    //~ }}
		   //~ 
//~ 
		    //~ }}
			//exit;
		$data         = $this->input->post();
		//$ref_user_id = $_POST['ref_user_id'];
		$this->db->query('DELETE FROM customer_outstanding WHERE ref_employee_id = "'.$data['ref_employee_id'].'" AND ref_company_id = "'.$data['ref_company_id'].'"');
		//$this->Common_model->deleteRecord('','ref_employee_id',$data['ref_employee_id']);
		$tot_ins = 0;
            $data['file'] = $_FILES['customer_file'];
            if (isset($_FILES['customer_file'])) {
                $file                         = $_FILES['customer_file']['tmp_name'];
                $handle                       = fopen($file, "r");
                
                $c                            = 0;
                $i                            = 0;
                $_SESSION['inserted_rows']    = 0;
                $_SESSION['notinserted_rows'] = 0;
                $_SESSION['not_inserted']     = array();
                $_SESSION['duplication']      = array();
                while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {										
                    if ($i > 3) {                                           
						if ($filesop[2] != ''){
							$rc_id       = trim($filesop[2]);
							$res_profile = $this->Customer_model->get_customer_id($rc_id);
							$_SESSION['customer_id'] = $res_profile[0]->customer_id;
							$_SESSION['ref_supplier_id'] = $res_profile[0]->ref_supplier_id;
						}
					
					 if($filesop[0] != '' && $_SESSION['customer_id'] != ''){
						$customer_data['ref_customer_id'] = $_SESSION['customer_id'];						
						$customer_data['date'] = date('Y-m-d',strtotime(str_replace("/","-",$filesop[0])));
						$customer_data['reference_no'] = $filesop[1];
						$customer_data['opening_amount'] = trim($filesop[3]);
						$customer_data['pending_amount'] = trim($filesop[4]);
						$customer_data['overdue_by_days'] = $filesop[5];
						$customer_data['ref_employee_id'] = $data['ref_employee_id'];
						$customer_data['ref_company_id'] = $data['ref_company_id'];
						
						echo $res = $this->Common_model->addRecord('customer_outstanding',$customer_data);
					    $tot_ins++;
						}
					}
                    $i++;
                }
            }
            			
            $_SESSION['success_msg'] = 'Cusotomer Outstanding successfully Imported ( '.$tot_ins.' Records )...';
            
            redirect('customer/import_customer_outstanding');
		  }else{
			$data['user'] = $this->Common_model->getDetails('user','ref_user_group_id','4','full_name','ASC'); 
			$this->load->view('common/menu');
			$this->load->view('customer/import_customer_outstanding_form_view', $data);
			$this->load->view('common/footer');
	    }
    }

    function get_customer_outstanding_list(){
		$this->hasPermission('customer_view');
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
        //$data      = array();
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
        // If not pagination page remove filter data from session
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
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
            $sort = 'customer_outstanding_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
        
         $data['page']             = $page; // No used for Redirect to same page after delete action in page 2, page 3,etc...
        
        $filter_query_data      = array();
        $data['limit'] = '';
        if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit'] = '?limit='.$_REQUEST['limit'];
        }else{
            $start                     = (($page - 1) * RPP);
        }
        
        $data['start']             = $start; // Generate SNO in result table based on page number
       
        $table['tbl_main']           = 'customer_outstanding';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data);
      
        $data['tablefields']      = $this->Common_model->getTableFields('customer_outstanding');        
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'customer/get_customer_outstanding_list/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
		$data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        $this->load->view('common/menu');
        $this->load->view('customer/customer_outstanding_list_view', $data);
        $this->load->view('common/footer');

    }
    
     function visits()
    {
        $this->hasPermission('customervisit_view');
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
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
        // If not pagination page remove filter data from session
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
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
            $sort = 'customer_visit_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
       $data['page']             = $page; // No used for Redirect to same page after delete action in page 2, page 3,etc...
        
        $filter_query_data      = array();
        $data['limit'] = '';
        if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit'] = '?limit='.$_REQUEST['limit'];
        }else{
            $start                     = (($page - 1) * RPP);
        }
        
        $data['start']             = $start; // Generate SNO in result table based on page number
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;
        $table['tbl_main']           = 'customer_visit';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        $data['tablefields']         = $this->Common_model->getTableFields('customer_visit');
        $data['operations']          = $this->Common_model->getFilterOperation();
        
        $data['init_listing_page']   = 'customer/visits/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $this->load->view('common/menu');
        $this->load->view('customer/customer_visit_list_view', $data);
        $this->load->view('common/footer');
    }
    
    function edit_visit()
    {
        $this->hasPermission('customervisit_edit');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id  = $this->uri->segment(3);
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			
			if(!isset($data['customer_visit_reminder'])){
				$data['customer_visit_reminder'] = 0 ;
				$data['customer_visit_reminder_date'] = $data['customer_visit_reminder_date'] ;
			}
			//~ echo '<pre>';
			//~ print_r($data);
			//~ echo '</pre>';
			//~ exit;
			$redirect_to = $data['redirect_to'];
            unset($data['redirect_to']);
            
            $res_id_1 = $this->Common_model->updateRecord('customer_visit', $data, $id);

			
			if($res_id_1){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('customer_visit_edit', $res_id_1); // Record User Activity
                $_SESSION['success_msg'] = 'Client Visit successfully updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
            redirect($redirect_to);
        } else {
            $id                           = $this->uri->segment(3);
            $data['customer_visit']         = $this->Common_model->getDetails('customer_visit', 'customer_visit_id', $id);
                                
            $this->load->view('common/menu');
            $this->load->view('customer/customer_visit_edit_view', $data);
            $this->load->view('common/footer');
        }
    }
    
    function getForm()
    {
        $data['action'] = site_url('customer/add');
        $this->load->view('common/menu');
         
        $this->load->view('customer/customer_form_view', $data);
        $this->load->view('common/footer');
    }
    function add()
    {
        $this->hasPermission('customer_add');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			// if(isset($_FILES['customer_gst_file']['name']) && !empty($_FILES['customer_gst_file']['name'])){
			// 	$data['customer_gst_file'] = $this->Common_model->upload_file($_FILES['customer_gst_file']['name'],$_FILES['customer_gst_file']['tmp_name'],'gst');
			// }
						
			$res_id_1 = $this->Common_model->addRecord('customer', $data);
			
		           
	    if($res_id_1){
			    $this->Common_model->TxnCommit();
			    $this->Common_model->addUserActivity('customer_add',$res_id_1); // Record User Activity
	    $_SESSION['success_msg'] = 'Customer successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('customer');           
        } else {
            $this->getForm();
        }
    }
    
    function view()
    {
        $this->hasPermission('customer_view');
        $id                      = $this->uri->segment(3);
        $data['customers'] = $this->Common_model->getDetails('customer', 'customer_id', $id);
        $data['customer_numbers'] = $this->Common_model->getDetails('customer_contact_numbers', 'ref_customer_id', $id);
        $data['customers_emails'] = $this->Common_model->getDetails('customer_email_ids', 'ref_customer_id', $id);
        $data['customers_calls']= $this->Common_model->getDetails('customer_calls', 'ref_customer_id', $id,'customer_call_date_and_time','DESC');
        $data['customers_apps']= $this->Common_model->getDetails('customer_appointments', 'ref_customer_id', $id,'appointment_process_date','DESC');
        $data['customer_remark'] = $this->Common_model->getDetails('customer_remark', 'ref_customer_id', $id);
        $data['customer_visit'] = $this->Common_model->getDetails('customer_visit', 'ref_customer_id', $id,'customer_visit_date','DESC');
		
        $this->load->view('common/menu');
        $this->load->view('customer/customer_details_view', $data);
        $this->load->view('common/footer');
    }
    
    function getKeywordChartdata()
    {
        $data = array();
        $chart_data = array();
       
       $days_count = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($_REQUEST['filter'])),date('Y',strtotime($_REQUEST['filter'])));
         
       
        if ( !empty( $_REQUEST['filter'] )) {
            $customer_calls_chart = array();
            $res_keyword        = $this->Common_model->getDetails( 'seo_keyword','ref_customer_id',$_REQUEST['customer'],'seo_keyword_id','ASC' );
            if ( isset( $res_keyword ) && !empty( $res_keyword ) ) {
                foreach ( $res_keyword as $key => $val ) {
                    $months     = array();
                    $jsonmonths = array();
                    for ( $i = 1; $i <= $days_count; $i++ ) {
						$filter_month = date($i.'-m-Y',strtotime($_REQUEST['filter']));
						$filter_date = date('Y-m-'.$i,strtotime($_REQUEST['filter']));
                        $jsonmonths[]                                  = date( "d-M", strtotime(date($filter_month)) );
                        $mon                                           = date( "Y-m-d", strtotime( date($filter_date) ));
                        $res_count                                     = $this->Seo_keyword_model->getKPByKeyword( $mon, $val->seo_keyword_id);
                        $customer_calls_chart[$val->seo_keyword_id][] = (int) $res_count[0]->seo_keyword_position;
                    }
                    $customer_calls_chart[$val->seo_keyword_id] =  $customer_calls_chart[$val->seo_keyword_id] ;
                    $chart_data[] = array(
						'name'	=> $val->seo_keyword,
						'data'	=> $customer_calls_chart[$val->seo_keyword_id]
                    );
                }
            }
            $months             = $jsonmonths ;
            $month_data = array(
				 'name' => 'month',
                 'data' => $months
            );
            $data = array(
				'label'			=> $month_data,
				'chart_data'	=> $chart_data
            );
             
			
        }        
        echo json_encode($data);
        exit;
    }
    
     function viewAppointment()
    {
        $this->hasPermission('customer_view');
        $id                      = $this->uri->segment(3);
        $data['appointment']         = $this->Common_model->getDetails('customer_appointments', 'customer_appointment_id', $id);
        
        $this->load->view('common/menu');
        $this->load->view('customer/customer_appointment_details_view', $data);
        $this->load->view('common/footer');
    }
    
    function edit()
    {
        $this->hasPermission('customer_edit');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id  = $this->uri->segment(3);
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
            //debug($data); exit;			
			if(isset($_FILES['customer_gst_file']['name']) && !empty($_FILES['customer_gst_file']['name'])){
				$data['customer_gst_file'] = $this->Common_model->upload_file($_FILES['customer_gst_file']['name'],$_FILES['customer_gst_file']['tmp_name'],'customer_gst');
			}
			
            $res_id_1 = $this->Common_model->updateRecord('customer', $data, $id);			          
			
			if($res_id_1){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('customer_edit', $res_id_1); // Record User Activity
                $_SESSION['success_msg'] = 'Customer successfully updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
            redirect('customer');
        } else {
            $id                           = $this->uri->segment(3);
            $data['customer']              = $this->Common_model->getDetails('customer', 'customer_id', $id);
            $data['action'] = site_url('customer/edit/'.$id);
            $this->load->view('common/menu');
            $this->load->view('customer/customer_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    function delete()
    {        
        $this->hasPermission('customer_delete');
        // Begin Transaction
		$this->Common_model->TxnBegin();
		$delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('customer', 'customer_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('customer_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Client successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}   
        redirect('customer/getlist/1');
    }
    
    function delete_visit()
    {        
        $this->hasPermission('customer_delete');
        // Begin Transaction
		$this->Common_model->TxnBegin();
		$delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('customer_visit', 'customer_visit_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('customer_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Client successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}   
        redirect('customer/visits');
    }
    
    function appointmentdelete()
    {
        $this->hasPermission('customer_delete');
        // Begin Transaction
		$this->Common_model->TxnBegin();
        $delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
               $res = $this->Common_model->removeRecord('customer_appointments', 'customer_appointment_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('customer_appoinment_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Client Appointment successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}  
		
        redirect('customer/appointments');
    }
    function calldelete()
    {
        $this->hasPermission('customer_delete');
         // Begin Transaction
		$this->Common_model->TxnBegin();
        $delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('customer_calls', 'customer_call_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('customer_call_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Client Call successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		} 
		
        redirect('customer/calls');
    }
    
    function exportKeywordPositionReport()
    {
      
        $this->hasPermission('customer_view');
        $id = $this->uri->segment( 3 );
        
        $mainlist   = $this->Common_model->getDetails('seo_keyword_report', 'ref_customer_id', $id,'seo_keyword_report_date','DESC');
         
        
         foreach ($mainlist as $key => $val) {
           $result[$val->ref_seo_keyword_id][$this->Common_model->getDateFormat($val->seo_keyword_report_date)] = array(
				'keyword' => $val->seo_keyword,
				'position' => $val->seo_keyword_position
            );
        }
        
        foreach ($result as $key => $value) {			
           foreach($value as $k => $v){
			   $date[$k] = $k;
			   $keyword[$key] = $v['keyword'];
			   $res[$v['keyword']][$k] = $value[$k];
		   }
        }
        
       foreach($res as $rkey => $rval){
		  $export_list[$rkey][0]= $rkey;
		  foreach($rval as $k => $v){
			   $export_list[$rkey][] = $v['position'];
		  }
	   }
	   
	   
	   
       $export        = array();
       $export[0][0] = 'Client';
       $export[0][1] = $mainlist[0]->customer_name;
       $export[1][0] = 'Keywords';
       
       foreach($date as $v){
		   $export[1][] = $v;
	   }
	   
       foreach ($export_list as $export_row) {
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Keyword_Position_Report_' . date('d-m-Y_H:i:s'));
       
    }
    
    function export_customer_excel()
    {
        $this->hasPermission('customer_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'customer_id';
        $data['order'] = 'ASC';
        $table['tbl_main']           = 'customer';
        $table['tbl_mobile']         = 'customer_contact_numbers';
        $table['tbl_email']          = 'customer_email_ids';
        $mainlist      = $this->Common_model->getList($table, $data, $filter_data,'customer_id');
	   
        foreach ($mainlist as $key => $val) {
            $export_list[] = array(
                $val->customer_name,
                $val->address,
                $val->district_name,
                $val->pincode,
                $val->state_name,
                $val->country_name,             
                $val->mobile,             
                $val->email,             
                $val->customer_description,
                $val->customer_gst_no,
                getDateFormat($val->added_date)
            );    
        }
        $export        = array();
        $export_column = array(
            'Customer Name',
            'Address',
            'District',
            'Pincode',
            'State',            
            'Country',
            'Mobile',
            'Email',
            'Description',
            'GST No',
            'Registered Date'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Customer_List_' . date('d-m-Y_H:i:s'));
        
       
    }


     public function export_customer_pdf()
    {
       $this->hasPermission('customer_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'customer_id';
        $data['order']    = 'ASC';
        $table['tbl_main']  = 'customer';
        $table['tbl_mobile']         = 'customer_contact_numbers';
        $table['tbl_email']          = 'customer_email_ids';
        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'customer_id');
        
        $data['title'] = 'Client List';
        
       // Row Header
        $data['row_header'] = array();
        $data['row_header'][] = array(
			'name'		=> 'S No',
			'width'		=> '6%',
			'align'		=> 'center'
        );
        
        $data['row_header'][] = array(
			'name'		=> 'Client Name',
			'width'		=> '30%',
			'align'		=> 'left'
        );
        
        
         $data['row_header'][] = array(
			'name'		=> 'District',
			'width'		=> '10%',
			'align'		=> 'left'
        );
        
        
        $data['row_header'][] = array(
			'name'		=> 'Mobile',
			'width'		=> '9%',
			'align'		=> 'left'
        );
        
        $data['row_header'][] = array(
			'name'		=> 'Email',
			'width'		=> '17%',
			'align'		=> 'left'
        );
         $data['row_header'][] = array(
			'name'		=> 'Markt.Emp',
			'width'		=> '15%',
			'align'		=> 'left'
        );       
        // Row Data
        $data['row_data'] = array();
        if(isset($mainlist) && !empty($mainlist)){
			$i = 1;
	    foreach($mainlist as $key => $val){
			$address = array();
			$contact_number = $this->Common_model->getDetails('customer_contact_numbers','ref_customer_id',$val->customer_id);
			$contact_email = $this->Common_model->getDetails('customer_email_ids','ref_customer_id',$val->customer_id);
			$address_final = implode('<br>',$address);
				
				 $data['row_data'][] = array(
					$i,
					$val->customer_name,
					
					$val->district_name,
					$contact_number[0]->contact_number,
					$contact_email[0]->email_id,
					$val->full_name,
				);
			  $i++;
			}
		}
       
        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
	$header_html = $this->parser->parse('template/pdf/pdf_header',$data);
	$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $file_name = 'customer_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');
        
    }
    
    function export_customer_visit_excel()
    {
        $this->hasPermission('customervisit_excel');
        
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'customer_visit_id';
        $data['order'] = 'ASC';
        $table['tbl_main']           = 'customer_visit';
        $mainlist      = $this->Common_model->getList($table, $data, $filter_data);
   
        foreach ($mainlist as $key => $val) {
			$reminder = '';
			if($val->customer_call_reminder){
				$reminder = 'Yes';
			}
            $export_list[] = array(
                $this->Common_model->getDateFormat($val->customer_visit_date),
                $val->customer_name,
               
                $val->customer_visit_comments,
                $this->Common_model->getDateFormat($val->customer_visit_date)
            );
        }
        
        
        $export        = array();
        $export_column = array(
            'Visit Date',
            'Client Name',            
            'Comments',
            'Reminder Date'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $export_row) {
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Customer_Visit_List_' . date('d-m-Y_H:i:s'));
        
    }
    
    function exportCalls()
    {
        $this->hasPermission('customercall_excel');
        $customer_id = $this->uri->segment(3);
        if (!empty($customer_id)) {
            $mainlist = $this->Common_model->getDetails('customer_calls', 'ref_customer_id', $customer_id, 'customer_call_date_and_time', 'DESC');
        } else {
            $filter_data         = '';
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
            $data          = array();
            $data['sort']  = 'ref_customer_id';
            $data['order'] = 'ASC';
            $table['tbl_main']  = 'customer_calls';
            $mainlist      = $this->Common_model->getList($table, $data, $filter_data);
        }
        foreach ($mainlist as $key => $val) {
			$reminder = '';
			if($val->customer_call_reminder){
				$reminder = 'Yes';
			}
            $export_list[] = array(
                $val->customer_call_id,
                $val->customer_name,
                $this->Common_model->getDateTimeFormat($val->customer_call_date_and_time),
                $val->customer_call_duration,
                 $val->customer_call_purpose_name,
                $val->customer_call_not_connected_name,
                $val->customer_call_feedback_name,
                $val->customer_call_comments,
                $reminder,
                $this->Common_model->getDateFormat($val->customer_call_reminder_date)
            );
        }
        
        
        $export        = array();
        $export_column = array(
            'Client Call Id',
            'Client Name',
            'Call Date & Time',
            'Call Duration',
            'Call Purpose',
            'Call Connected Status',
            'Feedback',
            'Comments',
            'Call Reminder',
            'Reminder Date'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $export_row) {
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Customer_Call_List_' . date('d-m-Y_H:i:s'));
        
    }
    function exportAppointments()
    {
        $this->hasPermission('customerapp_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'appointment_process_date';
        $data['order'] = 'DESC';
        $table['tbl_main'] = 'customer_appointments';
        $mainlist      = $this->Common_model->getList($table, $data, $filter_data);
        foreach ($mainlist as $key => $val) {
            $confirm = '';
            if($val->appointment_to_confirm){
				$confirm = 'Yes';
			}
            $export_list[] = array(
				$val->customer_appointment_id,
				$val->customer_name,
				$this->Common_model->getDateTimeFormat($val->appointment_process_date),
				$this->Common_model->getDateTimeFormat($val->appointment_visit_date),
				$val->appointment_address,
				$val->appointment_landmark,
				$confirm,
				$this->Common_model->getDateTimeFormat($val->appointment_to_confirm_date),

				$val->user_name,
				$val->appointment_feedback_name,
				$val->appointment_comments
            );
        }
        $export        = array();
        $export_column = array(
            'Client Appointment Id',
            'Client Name',
            'Process Date & Time',
            'Vist Date ',
            'Address',
            'Landmark',
            'Confirm',
            'Confirm Date',
            'Employee',
            'Feedback',
            'Comments'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $export_row) {
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Customer_Appointment_List_' . date('d-m-Y_H:i:s'));
       
    }
    
    
    public function export_customer_visit_pdf()
    {
		$this->hasPermission('customervisit_pdf');	
              
		$filter_data         = '';
		$session_filter_data = $this->session->userdata('filter_data');
		if (isset($session_filter_data)) {
			$filter_data = $session_filter_data;
		} else {
			$filter_data = '';
		}
		$data             = array();
		$data['sort']     = 'customer_visit_id';
		$data['order']    = 'DESC';
		$table['tbl_main']  = 'customer_visit';
		$mainlist = $this->Common_model->getList($table, $data, $filter_data);
		
		$data['title'] = 'Client Visit List';
            
		// Row Header
		$data['row_header'] = array();
		$data['row_header'][] = array(
			'name'		=> 'S.No',
			'width'		=> '5%',
			'align'		=> 'center'
		);
		
		$data['row_header'][] = array(
			'name'		=> 'Name',
			'width'		=> '20%',
			'align'		=> 'left'
		);
		
		 $data['row_header'][] = array(
			'name'		=> 'Visit Date',
			'width'		=> '12%',
			'align'		=> 'left'
		);

		$data['row_header'][] = array(
			'name'		=> 'Comments',
			'width'		=> '55%',
			'align'		=> 'left'
		);
		
		$data['row_header'][] = array(
			'name'		=> 'Reminder on',
			'width'		=> '13%',
			'align'		=> 'left'
		);
		
			   
		// Row Data
		$data['row_data'] = array();
		if(isset($mainlist) && !empty($mainlist)){
			$i = 1;
			foreach($mainlist as $key => $val){
				 $data['row_data'][] = array(
					$i,
					$val->customer_name,
					$this->Common_model->getDateFormat($val->customer_visit_date),
					$val->customer_visit_comments,
					$this->Common_model->getDateFormat($val->customer_visit_reminder_date)
				);
			$i++;
			}
				
		}
       
        $this->load->library('parser');
        $header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
        $file_name = 'customer_visit_list_' . date('Y-m-d _ H:i:s') . '.pdf'; 
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');
       
    }
    
    public function exportCallPdf()
    {
		$this->hasPermission('customercall_pdf');	
        $customer_id = $this->uri->segment(3);
        if (!empty($customer_id)) {
            $data['mainlist'] = $this->Common_model->getDetails('customer_calls', 'ref_customer_id', $customer_id, 'customer_call_date_and_time', 'DESC');
        } else {
            $filter_data         = '';
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
            $data             = array();
            $data['sort']     = 'ref_customer_id';
            $data['order']    = 'ASC';
            $table['tbl_main']  = 'customer_calls';
            $mainlist = $this->Common_model->getList($table, $data, $filter_data);
            
            $data['title'] = 'Client Call List';
            
            // Row Header
			$data['row_header'] = array();
			$data['row_header'][] = array(
				'name'		=> 'S.No',
				'width'		=> '5%',
				'align'		=> 'center'
			);
			
			$data['row_header'][] = array(
				'name'		=> 'Name',
				'width'		=> '15%',
				'align'		=> 'left'
			);
			
			 $data['row_header'][] = array(
				'name'		=> 'Call Date',
				'width'		=> '15%',
				'align'		=> 'left'
			);
			
			 $data['row_header'][] = array(
				'name'		=> 'Number',
				'width'		=> '10%',
				'align'		=> 'left'
			);
			
			 $data['row_header'][] = array(
				'name'		=> 'Duration',
				'width'		=> '8%',
				'align'		=> 'left'
			);
			
			$data['row_header'][] = array(
				'name'		=> 'CallPurpose',
				'width'		=> '10%',
				'align'		=> 'left'
			);
			
			//~ $data['row_header'][] = array(
				//~ 'name'		=> 'Not-Connect',
				//~ 'width'		=> '10%',
				//~ 'align'		=> 'left'
			//~ );
			$data['row_header'][] = array(
				'name'		=> 'Feed Back',
				'width'		=> '12%',
				'align'		=> 'left'
			);
			$data['row_header'][] = array(
				'name'		=> 'Reminder',
				'width'		=> '10%',
				'align'		=> 'left'
			);
			
				   
			// Row Data
			$data['row_data'] = array();
			if(isset($mainlist) && !empty($mainlist)){
				$i = 1;
				foreach($mainlist as $key => $val){
					 $data['row_data'][] = array(
						$i,
						$val->customer_name,
						$this->Common_model->getDateTimeFormat($val->customer_call_date_and_time),
						$val->contact_number,
						$val->customer_call_duration,
						$val->customer_call_purpose_name,
						//$val->customer_call_not_connected_name,
						$val->customer_call_feedback_name,
						$this->Common_model->getDateFormat($val->customer_call_reminder_date)
					);
				}
				$i++;	
			}
        }
        $this->load->library('parser');
        $header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
        $file_name = 'customer_call_list_' . date('Y-m-d _ H:i:s') . '.pdf'; 
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');
       
    }
    public function exportAppointmentsPdf()
    {   
		$this->hasPermission('customerapp_pdf');     
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'appointment_process_date';
        $data['order']    = 'DESC';
        $table['tbl_main']  = 'customer_appointments';
        $mainlist = $this->Common_model->getList($table, $data, $filter_data);
        
        $data['title'] = 'Client Appointments List';
        // Row Header
		$data['row_header'] = array();
		$data['row_header'][] = array(
			'name'		=> 'S.No',
			'width'		=> '5%',
			'align'		=> 'center'
		);
		
		$data['row_header'][] = array(
			'name'		=> 'Name',
			'width'		=> '15%',
			'align'		=> 'left'
		);
		
		 $data['row_header'][] = array(
			'name'		=> 'Process Date',
			'width'		=> '12%',
			'align'		=> 'left'
		);
		
		 $data['row_header'][] = array(
			'name'		=> 'Visit Date',
			'width'		=> '12%',
			'align'		=> 'left'
		);
		
		 $data['row_header'][] = array(
			'name'		=> 'Address',
			'width'		=> '10%',
			'align'		=> 'left'
		);
		
		$data['row_header'][] = array(
			'name'		=> 'Landmark',
			'width'		=> '10%',
			'align'		=> 'left'
		);
		
		$data['row_header'][] = array(
			'name'		=> 'Conf Date',
			'width'		=> '10%',
			'align'		=> 'left'
		);
		$data['row_header'][] = array(
			'name'		=> 'Feed Back',
			'width'		=> '10%',
			'align'		=> 'left'
		);
		$data['row_header'][] = array(
			'name'		=> 'Comments',
			'width'		=> '10%',
			'align'		=> 'left'
		);
		
		$data['row_header'][] = array(
			'name'		=> 'Employee',
			'width'		=> '9%',
			'align'		=> 'left'
		);
		
			   
		// Row Data
		$data['row_data'] = array();
		if(isset($mainlist) && !empty($mainlist)){
			$i = 1;
			foreach($mainlist as $key => $val){
				 $data['row_data'][] = array(
					$i,
					$val->customer_name,
					$this->Common_model->getDateTimeFormat($val->appointment_process_date),
					$this->Common_model->getDateTimeFormat($val->appointment_visit_date),
					$val->appointment_address,
					$val->appointment_landmark,
					$this->Common_model->getDateFormat($val->appointment_to_confirm_date),
					$val->appointment_feedback_name,
					$val->appointment_comments,
					$val->user_name
					
				);
			}
			$i++;	
		}
			
        $this->load->library('parser');
        $header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
        
        $file_name = 'customer_appointments_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        //$this->Common_model->exportPdf($html,$file_name,'L');
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');
    }
    public function exportClientDetailsPdf()
    {
        $id                     = $this->uri->segment(3);
        $data['customers']        = $this->Common_model->getDetails('customer', 'customer_id', $id);
        $data['customer_numbers'] = $this->Common_model->getDetails('customer_contact_numbers', 'ref_customer_id', $id);
        $data['customers_emails'] = $this->Common_model->getDetails('customer_email_ids', 'ref_customer_id', $id);
        $data['customers_calls']  = $this->Common_model->getDetails('customer_calls', 'ref_customer_id', $id);
        $data['customers_apps']   = $this->Common_model->getDetails('customer_appointments', 'ref_customer_id', $id);
       
        $this->load->library('parser');
        $header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $html = $this->parser->parse('template/pdf/customer_details_tmp', $data);
        $file_name = 'customer_details_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');
        
    }
    
    function getClientCallsChartdata()
    {
        $data = array();
        if ( !empty( $_REQUEST['filter'] ) ) {
            $jsonmonths      = array();
            $customer_calls_chart = array();
            $id = $_REQUEST['customer'];
            $current_date = date('m-Y',strtotime($_REQUEST['filter']));
            $res_date        = $this->Customer_model->getCallsDate($id,$current_date);
		  if ( isset( $res_date ) && !empty( $res_date ) ) {
			foreach ( $res_date as $key => $val ) {
				
					$jsonmonths[]   = $this->Common_model->getDateTimeFormat($val->customer_call_date_and_time);
					$mon            = $val->customer_call_date_and_time;
					$res_count                                     = $this->Customer_model->getClientCallsByDate( $mon,$val->ref_customer_id,$current_date);
					
					if (strpos($res_count[0]->duration, 'min') !== false) {
						$str_time = str_replace(' min','',$res_count[0]->duration);
						sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
						$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
						$dur = $time_seconds;
					}else{
						$dur = str_replace(' sec','',$res_count[0]->duration);
					}
				$customer_calls_chart[] = (int) $dur;
			}
		}
		$month      = array_reverse( $jsonmonths );
		$chart_data = array_reverse( $customer_calls_chart );
		$data       = array(
			 array(
				'name' => 'month',
				'data' => $month 
			),
			array(
				 'name' => 'Calls Duration Details',
				'data' => $chart_data 
			) 
		);
        
        }
        echo json_encode( $data );
        exit;
    }
    
    function import_customer(){
	 	$data         = $this->input->post();
		$ref_user_id = $_POST['ref_user_id'];
	
		$tot_ins = 0;
                $file                         = FCPATH.'customer.csv';
               // exit;
                $handle                       = fopen($file, "r");
                
                $c                            = 0;
                $i                            = 0;
                $_SESSION['inserted_rows']    = 0;
                $_SESSION['notinserted_rows'] = 0;
                $_SESSION['not_inserted']     = array();
                $_SESSION['duplication']      = array();
                while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
					$ref_supplier_id = $filesop[4];	
					$ref_product_quality_id = 0;	
					$ref_product_quality_size_id = 0;	
					$ref_district_id = 0;	
					//~ echo '<pre>';
					//~ print_r($filesop);
					//~ echo '</pre>';	
					$where = 'district.district_name = "'.trim(" ","",$filesop[5]).'"';
					
					$res_district = $this->Common_model->getRecords('district',$where);
					if(isset($res_district) && !empty($res_district)){
						$ref_district_id = $res_district[0]->res_district_id;	
					}
					
					//~ echo $where = 'product_quality_size.product_quality_size_name1 = "'.str_replace(" ","",$filesop[3]).'" AND product_quality_size.ref_supplier_id = "'.$filesop[4].'"';
					//~ echo '<br>';
					//~ $res_size = $this->Common_model->getRecords('product_quality_size',$where);
					//~ if(isset($res_size) && !empty($res_size)){
						//~ $ref_product_quality_size_id = $res_size[0]->product_quality_size_id;	
					//~ }						
             					
					$product_data['customer_name'] = trim(" ",'',$filesop[0]);
					$product_data['ref_business_category_id'] = $filesop[1];
					$product_data['customer_address_line1'] = trim($filesop[2]);
					$product_data['customer_address_line2'] = trim($filesop[3]);
					$product_data['customer_address_line3'] = trim($filesop[4]);					
					$product_data['ref_district_id'] = $ref_district_id;
					$product_data['customer_pincode'] = trim($filesop[6]);
					$product_data['ref_state_id'] = trim($filesop[7]);
					$product_data['customer_gst_no'] = trim($filesop[8]);
					$product_data['customer_pan_no'] = trim($filesop[9]);
					//~ echo '<pre>';
					//~ print_r($product_data);
					//~ echo '</pre>';	
					
					echo $res = $this->Common_model->addRecord('product',$product_data);
					$tot_ins++;
						
                }
            //}
                       
            			
            $_SESSION['success_msg'] = 'Cusotomer Outstanding successfully Imported ( '.$tot_ins.' Records )...';
           exit;
            
          //  redirect('customer/import_customer_outstanding');
		  //~ }else{
			//~ $data['user'] = $this->Common_model->getDetails('user','ref_user_group_id','4','full_name','ASC'); 
			//~ $this->load->view('common/menu');
			//~ $this->load->view('customer/import_customer_outstanding_form_view', $data);
			//~ $this->load->view('common/footer');
	    //~ }
    }
    
    function get_customer_summary(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			
			$data['customer'] = $this->Common_model->getDetails('customer','customer_id',$data['ref_customer_id']);
			
			$data['proforma_invoice'] = $this->Common_model->getDetails('proforma_invoice','ref_customer_id',$data['ref_customer_id'],'added_date','DESC');
			
			$data['product_sample_request'] = $this->Common_model->getDetails('product_sample_request','ref_customer_id',$data['ref_customer_id'],'added_date','DESC');
			
			$data['customer_visit'] = $this->Common_model->getDetails('customer_visit','ref_customer_id',$data['ref_customer_id'],'customer_visit_date','DESC');
			
			$data['complaint'] = $this->Common_model->getDetails('complaint','ref_customer_id',$data['ref_customer_id'],'added_date','DESC');

			$data['import_outstanding'] = $this->Common_model->getDetails('customer_outstanding','ref_customer_id',$data['ref_customer_id']);

			$data['customer_pending_invoice_list'] = $this->Customer_model->get_pending_purchase_order($data['ref_customer_id']);
    
			//~ echo '<pre>';
			//~ print_r($data['customer_pending_invoice_list']);
			//~ echo '</pre>';
			//~ exit; 
			
			$this->load->view('common/menu');
			$this->load->view('customer/customer_details_summary_view', $data);
			$this->load->view('common/footer');
        
		}
	}
	
    function add_customer_visit(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
		
			$res = $this->Customer_model->addRecord('customer_visit', $data);
			if($res){
			    $this->Common_model->TxnCommit();
				$_SESSION['success_msg'] = 'Client Visit successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('customer/add_customer_visit');           
		}else{
			$this->load->view('common/menu');
			$this->load->view('customer/customer_visit_form_view', $data);
			$this->load->view('common/footer');
		}
	}
    
    
}
?>
