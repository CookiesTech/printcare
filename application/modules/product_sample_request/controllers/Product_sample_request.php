<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Product_sample_request extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Product_sample_request_model'
        ));
        $this->load->helper(array(
            'form'
        ));
        $this->load->library("Pdf");
        $session_data       = $this->session->userdata( SESSION_LOGIN . 'logged_in' );
        $data['username']   = $session_data['username'];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        if (empty($data['permission'])) {
            redirect('home');
        }
        $data['designation']         = $this->Common_model->getDropdownList('designation');
        $data['user']            = $this->Common_model->getDropdownList('user');
        if($this->uri->segment(2) == 'get_delivery_challan_list' || $this->uri->segment(2) == 'add_dc'){
			$data['title'] = 'Supplier Delivery Challan';
		}elseif($this->uri->segment(2) == 'get_proforma_invoice_list' || $this->uri->segment(2) == 'add_proforma_invoice' || $this->uri->segment(2) == 'edit_proforma_invoice'){
			$data['title'] = 'Proforma Invoice';
        }elseif($this->uri->segment(2) == 'get_customer_delivery_challan_list'){
            $data['title'] = 'Customer Delivery Challan';
		}else{
			$data['title'] = 'Product Sample Request';
		}
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
	
	function index(){
		$this->getlist();
	}
    function getlist()
    {
        $this->hasPermission('product_sample_request_view');
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
            $sort = 'product_sample_request_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
        
        // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $data['page']             = $page; 
        
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
        
        // $start                       = (($page - 1) * RPP);
        // $data['start']               = $start;
        // $data['sort']                = $sort;
        // $data['order']               = $order;
        $table['tbl_main']           = 'product_sample_request';
        //$table['tbl_mobile']         = 'product_sample_request_contact_numbers';
        //$table['tbl_email']          = 'product_sample_request_email_ids';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data,'product_sample_request_id');
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data,'product_sample_request_id');
		
		
		$data['tablefields1']      = $this->Common_model->getTableFields('product_sample_request');
        //$data['tablefields2']      = $this->Common_model->getTableFields('product_sample_request_contact_numbers');
        //$data['tablefields3']      = $this->Common_model->getTableFields('product_sample_request_email_ids');
        $data['tablefields']       = array_merge($data['tablefields1']);
        		  
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'product_sample_request/getlist/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
		$data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        $this->load->view('common/menu');
        $this->load->view('product_sample_request/product_sample_request_list_view', $data);
        $this->load->view('common/footer');
    }
    
    function getForm()
    {
        $data['category']             = $this->Master_model->getCategoryList('business_category');
       
        $data['designation']          = $this->Common_model->getDropdownList('designation');
     
        //$data['contact_number_block'] = $this->parser->parse('common/product_sample_request_contact_number_block', $data, true);
        //$data['contact_email_block']  = $this->parser->parse('common/product_sample_request_contact_email_block', $data, true);
        
        $data['action'] = site_url('product_sample_request/add');
        $this->load->view('common/menu');
        $this->load->view('product_sample_request/product_sample_request_form_view', $data);
        $this->load->view('common/footer');
    }
    function add()
    {
        $this->hasPermission('product_sample_request_add');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			//$sof_data['ref_company_id'] = $data['ref_company_id'];
			$sof_data['ref_supplier_id'] = $data['ref_supplier_id'];
			$res_code = $this->Product_sample_request_model->get_sof_code($sof_data);
			$data['product_sample_request_no'] = $res_code['product_sample_request_no'];
			$data['product_sample_request_code'] = $res_code['product_sample_request_code'];			
			$data['ref_product_request_status_id'] = 1;
			
			//debug($data); exit;
			
			$res = $this->Common_model->addRecord('product_sample_request', $data);
			
			$res_SOF_file = $this->generate_sample_order_request_pdf($res,$data);
			$u_data['product_sample_request_file'] = $res_SOF_file;
			$this->Common_model->updateRecord('product_sample_request',$u_data,$res);
				
			//~ echo $res;
			//~ exit;
			if($res){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('product_sample_request_add',$res); // Record User Activity
                $_SESSION['success_msg'] = ' Product Sample Request successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('product_sample_request');           
        } else {
            $this->getForm();
        }
    }
    
    
    function view()
    {
        $this->hasPermission('product_sample_request_view');
        $id                      = $this->uri->segment(3);
        $data['product_sample_request']         = $this->Common_model->getDetails('product_sample_request', 'product_sample_request_id', $id);
        $data['product_sample_request_numbers']  = $this->Common_model->getDetails('product_sample_request_contact_numbers', 'ref_product_sample_request_id', $id);
        $data['product_sample_request_emails']  = $this->Common_model->getDetails('product_sample_request_email_ids', 'ref_product_sample_request_id', $id);
        $this->load->view('common/menu');
        $this->load->view('product_sample_request/product_sample_request_details_view', $data);
        $this->load->view('common/footer');
    }
    
     
    function edit()
    {
        $this->hasPermission('product_sample_request_edit');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id  = $this->uri->segment(3);
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			$redirect_to = $data['redirect_to'];
            unset($data['redirect_to']);
            //debug($data); exit;			
			$res = $this->Common_model->updateRecord('product_sample_request', $data, $id);
			
			$res_SOF_file = $this->generate_sample_order_request_pdf($res,$data);
			$u_data['product_sample_request_file'] = $res_SOF_file;
			$this->Common_model->updateRecord('product_sample_request',$u_data,$res);
			
             
			if($res){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('product_sample_request_edit', $res); // Record User Activity
                $_SESSION['success_msg'] = 'Product Sample Request successfully updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
            redirect('product_sample_request');
        } else {
            $id                           = $this->uri->segment(3);
            $data['sample_request']              = $this->Common_model->getDetails('product_sample_request', 'product_sample_request_id', $id);
            
            $data['product_sample_request_particulars']              = $this->Common_model->getDetails('product_sample_request_particulars', 'ref_product_sample_request_id', $id);
			
            $data['action'] = site_url('product_sample_request/edit/'.$id);
            $this->load->view('common/menu');
            $this->load->view('product_sample_request/product_sample_request_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    function delete()
    {        
        $this->hasPermission('product_sample_request_delete');
        // Begin Transaction
		$this->Common_model->TxnBegin();
		$delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('product_sample_request', 'product_sample_request_id', $id);
                $this->Common_model->removeRecord('product_request_document', 'ref_product_sample_request_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('product_sample_request_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Product_sample_request successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}   
        redirect('product_sample_request/getlist/1');
    }
    
     function delete_delivery_challan()
    {        
        $this->hasPermission('delivery_challan_delete');
        // Begin Transaction
		$this->Common_model->TxnBegin();
		$delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('delivery_challan', 'delivery_challan_id', $id);
                $this->Common_model->removeRecord('delivery_challan_particulars', 'ref_delivery_challan_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('delivery_challan_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Delivery Challan successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}   
        redirect('product_sample_request/get_delivery_challan_list');
    }
     function delete_proforma_invoice()
    {        
        //$this->hasPermission('proforma_invoice_delete');
        // Begin Transaction
		$this->Common_model->TxnBegin();
		$delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('proforma_invoice', 'proforma_invoice_id', $id);
                $this->Common_model->removeRecord('proforma_invoice_particulars', 'ref_proforma_invoice_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('proforma_invoice_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Proforma Invoice successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}   
        redirect('product_sample_request/get_proforma_invoice_list');
    }
    
    
    
    
    function update_inward()
    {
        $this->hasPermission('product_sample_request_add');
        $id                           = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			//~ echo '<pre>';
			//~ print_r($data);
			//~ echo '</pre>';
			//~ exit;
			if(isset($data['tbl_product_sample_request_particulars']) && !empty($data['tbl_product_sample_request_particulars'])){
				foreach($data['tbl_product_sample_request_particulars'] as $key => $val){
					$res = $this->Common_model->updateRecord('product_sample_request_particulars',$val,$key);
				}
			}
			$u_data['inward_status'] = 1;
			$this->Common_model->updateRecord('product_sample_request',$u_data,$id);
			if($res){
				$this->Common_model->TxnCommit();
                $_SESSION['success_msg'] = ' Product Inward successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('product_sample_request');           
        } else {
            $data['action'] = site_url('product_sample_request/update_inward/'.$id);
            $data['sample_request'] = $this->Common_model->getDetails('product_sample_request','product_sample_request_id',$id);
            $data['product_sample_request_particulars'] = $this->Common_model->getDetails('product_sample_request_particulars','ref_product_sample_request_id',$id);

            $this->load->view('common/menu');
            $this->load->view('product_sample_request/product_inward_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    
    function get_product_sample_request_brokerage_history_list()
    {
        $this->hasPermission('product_sample_request_view');
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
            $sort = 'product_sample_request_brokerage_history_id';
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
        $table['tbl_main']         = 'product_sample_request_brokerage_history';
        $data['mainlist_count']    = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']          = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        $data['tablefields']       = $this->Common_model->getTableFields('product_sample_request_brokerage_history');
        $data['operations']        = $this->Common_model->getFilterOperation();
        $data['init_listing_page'] = 'product_sample_request/get_product_sample_request_brokerage_history_list/';
        $data['listing_page']      = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $this->load->view('common/menu');
        $this->load->view('product_sample_request/product_sample_request_brokerage_history_list_view', $data);
        $this->load->view('common/footer');
    }
    
    
     function get_delivery_challan_list()
    {
        $this->hasPermission('delivery_challan_view');
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
            $sort = 'delivery_challan_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
        
        // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $data['page']             = $page; 
        
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
        $table['tbl_main']           = 'delivery_challan';
        
       // debug($filter_data); //exit;
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data);
		
		$data['tablefields']      = $this->Common_model->getTableFields('delivery_challan');        
        		  
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'product_sample_request/get_delivery_challan_list/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
		$data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
		
        $this->load->view('common/menu');
        $this->load->view('product_sample_request/delivery_challan_list_view', $data);
        $this->load->view('common/footer');
    }
    
    


     function get_customer_delivery_challan_list()
    {
        $this->hasPermission('delivery_challan_view');
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
            $sort = 'delivery_challan_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
        
        // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $data['page']             = $page; 
        
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
        $table['tbl_main']           = 'delivery_challan';
        $filter_data['customer_dc'] = 1;

        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        
        $data['tablefields']      = $this->Common_model->getTableFields('delivery_challan');        
                  
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'product_sample_request/get_delivery_challan_list/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        
        $this->load->view('common/menu');
        $this->load->view('product_sample_request/customer_delivery_challan_list_view', $data);
        $this->load->view('common/footer');
    }

    function get_proforma_invoice_list()
    {
        $this->hasPermission('proforma_invoice_view');
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
            $sort = 'proforma_invoice_date';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
        
        // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $data['page']             = $page; 
        
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
        $table['tbl_main']           = 'proforma_invoice';
        
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data);
		
		$data['tablefields']      = $this->Common_model->getTableFields('proforma_invoice');       
        		  
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'product_sample_request/get_proforma_invoice_list/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
		$data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
		
        $this->load->view('common/menu');
        $this->load->view('product_sample_request/proforma_invoice_list_view', $data);
        $this->load->view('common/footer');
    }
    
    function add_proforma_invoice()
	{
	    $this->hasPermission('proforma_invoice_add');
	    if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = $this->input->post();

	       //debug($data); exit;
            $pi_code_data['ref_supplier_id'] = $data['ref_supplier_id']; 
			$res_code = $this->Product_sample_request_model->get_pi_code($pi_code_data);
			
			$data['proforma_invoice_no'] = $res_code['proforma_invoice_no'];
			$data['proforma_invoice_code'] = $res_code['proforma_invoice_code'];
			if(isset($data['client_email']) && !empty($data['client_email'])){			
				$data['client_email'] = implode(',', $data['client_email']);
			}
			$email_message = $data['email_message'];
			unset($data['email_message']);
			
			
			$proforma_invoice_particulars = $data['tbl_purchase_order_particulars'];
			unset($data['tbl_purchase_order_particulars']);
			
			if (isset($_FILES['company_proforma_file']['name']) && !empty($_FILES['company_proforma_file']['name'])) {
				$data['company_proforma_file'] = 1;
				$data['company_proforma_file'] = $this->Common_model->upload_file($_FILES['company_proforma_file']['name'],$_FILES['company_proforma_file']['tmp_name'],'company_proforma');
			}else{
				$data['company_proforma_file'] = 0;
			}
			
			//debug($proforma_invoice_particulars); exit;  
	    //~ echo '<pre>';
            //~ print_r($data);
            //~ echo '</pre>';
            //~ exit;
            
	$res = $this->Common_model->addRecord('proforma_invoice', $data);			
			
	if(isset($proforma_invoice_particulars) && !empty($proforma_invoice_particulars)){
	    foreach($proforma_invoice_particulars as $val){			
					//if(!empty($val['qty'])){	
						$po_p_data = $val;
						$po_p_data['ref_proforma_invoice_id'] = $res;			
						$this->Common_model->addRecord('proforma_invoice_particulars', $po_p_data);
				//}
		    }
	    }
				
    $pi['proforma_invoice_file'] = $this->generate_proforma_invoice_pdf($res,$data);	
					//exit;
			$res1 = $this->Common_model->updateRecord('proforma_invoice',$pi,$res);
		
			$attach_docs = FCPATH.$pi['proforma_invoice_file'];
			$email_subject  = "Proforma Invoice - #".$pdf_data['pi_details'][0]->proforma_invoice_code."";
			$to_address                 = array();
            $email_additional           = array();
            if(isset($data['client_email'])){
                $to_address[] = $data['client_email'];
            }
	    
            if(!empty($data['email_additional'])){
                $email_additional = explode(',', $data['email_additional']);
                $to_address       = array_merge($to_address, $email_additional);
            }
	    
            $mail_data                          = array();
            $mail_data['from_address']          = FROM_ADDRESS;
            $mail_data['to_address']            = implode(',', $to_address);
            $mail_data['subject']               = $email_subject;
            $mail_data['message']			    = $email_message;
            $mail_data['name']                  = $res_sample[0]->supplier_name;
            $mail_data['attachment']            = $attach_docs;
            $mail_data['template_path']         = 'template/email/proforma_invoice.php';
            
            if(!empty($to_address)){
				$res2 = $this->Common_model->sendEmail($mail_data);
			}
			
           // $res2 = $this->Common_model->sendEmail($mail_data);
			
			if($res1){
				if($res2){
					$pi_data['mail_status'] = 1;
					$this->Common_model->updateRecord('proforma_invoice', $pi_data,$res);
					$_SESSION['success_msg'] = 'Proforma Invoice sent Successfully ...';
				}else{
					$_SESSION['success_msg'] = 'Proforma Invoice Created Successfully ...';
				}
            }else{
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
			redirect('product_sample_request/get_proforma_invoice_list');
		}else {
			$data['action'] = site_url('product_sample_request/add_proforma_invoice');
			$this->load->view('common/menu');
			$this->load->view('product_sample_request/proforma_invoice_form_view', $data);
			$this->load->view('common/footer');
		}
	}
	
	function edit_proforma_invoice()
	{
	    $this->hasPermission('proforma_invoice_add');
	    $id = $this->uri->segment(3);
	    if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = $this->input->post();
            			
			if(isset($data['client_email']) && !empty($data['client_email'])){			
				$data['client_email'] = implode(',', $data['client_email']);
			}
			
			if(!isset($data['display_discount_to_customer'])){			
				$data['display_discount_to_customer'] = 0;
			}
			
			$email_message = $data['email_message'];
			unset($data['email_message']);
			
			$proforma_invoice_particulars = $data['tbl_purchase_order_particulars'];
			unset($data['tbl_purchase_order_particulars']);
			//   debug($proforma_invoice_particulars); exit;
			
			if (isset($_FILES['company_proforma_file']['name']) && !empty($_FILES['company_proforma_file']['name'])) {
				$data['company_proforma_file'] = 1;
				$data['company_proforma_file'] = $this->Common_model->upload_file($_FILES['company_proforma_file']['name'],$_FILES['company_proforma_file']['tmp_name'],'company_proforma');
			}else{
				$data['company_proforma_file'] = 0;
			}
			
			$res = $this->Common_model->updateRecord('proforma_invoice', $data,$id);			
			
			if(isset($proforma_invoice_particulars) && !empty($proforma_invoice_particulars)){
				$this->Common_model->deleteRecord('proforma_invoice_particulars','ref_proforma_invoice_id',$id);
				foreach($proforma_invoice_particulars as $val){				
					//if(!empty($val['qty']) && $val['qty']){	
						$po_p_data = $val;
						$po_p_data['ref_proforma_invoice_id'] = $res;			
						$this->Common_model->addRecord('proforma_invoice_particulars', $po_p_data);
					//}
				}
			}
				
			$pi['proforma_invoice_file'] = $this->generate_proforma_invoice_pdf($res,$data);	
			
			$res1 = $this->Common_model->updateRecord('proforma_invoice',$pi,$res);
		
			$attach_docs = FCPATH.$pi['proforma_invoice_file'];
			
			
			$email_subject  = "Proforma Invoice - #".$pdf_data['pi_details'][0]->proforma_invoice_code."";
			$to_address                 = array();
            $email_additional           = array();
            if(isset($data['client_email'])){
                $to_address[] = $data['client_email'];
            }
	    
            if(!empty($data['email_additional'])){
                $email_additional = explode(',', $data['email_additional']);
                $to_address       = array_merge($to_address, $email_additional);
            }
	    
            $mail_data                          = array();
            $mail_data['from_address']          = FROM_ADDRESS;
            $mail_data['to_address']            = implode(',', $to_address);
            $mail_data['subject']               = $email_subject;
            $mail_data['message']			    = $email_message;
            $mail_data['name']                  = $res_sample[0]->supplier_name;
            $mail_data['attachment']            = $attach_docs;
            $mail_data['template_path']         = 'template/email/proforma_invoice.php';
            
            if(!empty($to_address)){
				$res2 = $this->Common_model->sendEmail($mail_data);
			}
						
			if($res1){
				if($res2){
					$pi_data['mail_status'] = 1;
					$this->Common_model->updateRecord('proforma_invoice', $pi_data,$res);
					$_SESSION['success_msg'] = 'Proforma Invoice updated and Mail sent Successfully ...';
				}else{
					$_SESSION['success_msg'] = 'Proforma Invoice updated but Mail not send ...';
				}
            }else{
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
			redirect('product_sample_request/get_proforma_invoice_list');
		}else {
			$data['action'] = site_url('product_sample_request/edit_proforma_invoice/'.$id);
			$data['proforma_invoice'] =  $this->Common_model->getDetails('proforma_invoice','proforma_invoice_id',$id); 
			$data['proforma_invoice_particulars'] =  $this->Common_model->getDetails('proforma_invoice_particulars','ref_proforma_invoice_id',$id); 
			
			$this->load->view('common/menu');
			$this->load->view('product_sample_request/proforma_invoice_form_view', $data);
			$this->load->view('common/footer');
		}
	}
	
	
	function generate_proforma_invoice_pdf($id,$data=''){
		$pdf_data['pi_details'] = $this->Common_model->getDetails('proforma_invoice','proforma_invoice_id',$id);			
		$pdf_data['proforma_invoice_particulars'] = $this->Common_model->getDetails('proforma_invoice_particulars','ref_proforma_invoice_id',$id);
		$pdf_data['supplier'] = $this->Common_model->getDetails('supplier','supplier_id',$pdf_data['pi_details'][0]->ref_supplier_id);
		$pdf_data['company'] = $this->Common_model->getDetails('company','company_id',$pdf_data['supplier'][0]->ref_company_id);
		$pdf_data['client'] = $this->Common_model->getDetails('client','client_id',$pdf_data['pi_details'][0]->ref_client_id);

		$html = $this->parser->parse('template/pdf/proforma_invoice_tmp', $pdf_data);
		$header_html = $this->parser->parse('template/pdf/pdf_header',$pdf_data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$pdf_data);
		$fname = 'uploads/proforma_invoice/' . str_replace('/','_',$pdf_data['pi_details'][0]->proforma_invoice_code) .'_'.time(). '.pdf';
		$file_name = FCPATH.$fname;			
		
		$this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','F');
		//exit;
		
		return $fname;
	}
    
   
   function sample_request()
    {
        $id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = $this->input->post();
            
            $res_sample = $this->Common_model->getDetails('product_sample_request','product_sample_request_id', $id);
            
            if(empty($res_sample[0]->product_sample_request_file)){
				// Update PDF file
				$res_SOF_file = $this->generate_sample_order_request_pdf($id,$data);
				
				$u_data['product_sample_request_file'] = $res_SOF_file;
				$this->Common_model->updateRecord('product_sample_request',$u_data,$id);
			}else{
				$res_SOF_file = $res_sample[0]->product_sample_request_file;
			}
            if (!empty($_FILES['product_doc']['name'][0])) {
                $this->db->query('DELETE FROM product_request_document WHERE ref_product_sample_request_id = "' . $id . '"');
                $cpt = count($_FILES['product_doc']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    if (!empty($_FILES['product_doc']['name'][$i])) {
                        $ext                                    = $this->Common_model->getExtension($_FILES['product_doc']['name'][$i]);
                        $src_file                               = $data['product_doc_title'][$i] . '.' . $ext;
                        $file_path = $this->Common_model->upload_file($src_file, $_FILES['product_doc']['tmp_name'][$i], 'product_docs');
                        $ext                                    = $this->Common_model->getExtension($file_path);
                        $pcd_data['product_request_document_name'] = $data['product_doc_title'][$i];
                        if (empty($data['product_doc_title'][$i])) {
                            $pcd_data['product_request_document_file'] = $file_path;
                        } else {
                            $pcd_data['product_request_document_file'] = $file_path;
                        }
                        $pcd_data['ref_product_sample_request_id'] = $id;
                        $res = $this->Common_model->addRecord('product_request_document', $pcd_data);
                    }
                }
            }
	    
            //~ $res_product_request_docs    = $this->Common_model->getDetails('product_request_document', 'ref_product_sample_request_id', $id);
	    //~ 
             $attach_product_request_docs = array();
            //~ if (isset($res_product_request_docs) && !empty($res_product_request_docs)) {
                //~ foreach ($res_product_request_docs as $key => $val) {
					//~ $attach_product_request_docs[] = FCPATH . $val->product_request_document_file;
                //~ }
            //~ }
            
            $attach_product_request_docs[] = FCPATH.$res_SOF_file;
            $to_address                 = array();
            $email_additional           = array();
            if (isset($data['supplier_email'])) {
                $to_address[] = $data['supplier_email'];
            }
            if (!empty($data['email_additional'])) {
                $email_additional = explode(',', $data['email_additional']);
                $to_address       = array_merge($to_address, $email_additional);
            }
            $mail_data                          = array();
            $mail_data['from_address']          = FROM_ADDRESS;
            $mail_data['to_address']            = implode(',', $to_address);
            $mail_data['subject']               = $data['email_subject'];
            $mail_data['message']               = str_replace('&#10;', 'br>', $data['email_message']);
            $mail_data['name']                  = $res_sample[0]->supplier_name;
            $mail_data['attachment']            = $attach_product_request_docs;
            $mail_data['template_path']         = 'template/email/product_document.php';
            //~ echo '<pre>';
            //~ print_r($mail_data);
            //~ echo '</pre>';
            //~ exit;
            $res = $this->Common_model->sendEmail($mail_data);
            
            if ($res) {
				$pc_data['mail_status'] = 1;
				$this->Common_model->updateRecord('product_sample_request', $pc_data,$res_sample[0]->product_sample_request_id);
                $_SESSION['success_msg'] = 'Product Request mail successfully sent ...';
            } else {
                $_SESSION['error_msg'] = 'Mail not send...Please try again...';
            }
            redirect('product_sample_request/getlist');
        } else {
			$data['sample_request_id'] = $this->uri->segment(3);
            $res_sample                               = $this->Common_model->getDetails('product_sample_request', 'product_sample_request_id', $id);
            $data['sample']                           = $res_sample;
            
			$data['supplier_contact_numbers'] = $this->Common_model->getDetails('supplier_contact_numbers', 'ref_supplier_id', $res_sample[0]->ref_supplier_id);
            $data['supplier_email_ids']       = $this->Common_model->getDetails('supplier_email_ids', 'ref_supplier_id', $res_sample[0]->ref_supplier_id);
            $data['subject']                          = '';
            $data['message']                          = '';
            if (isset($res_sample) && !empty($res_sample)){
                $data['subject'] = 'Product Request - #' . $res_sample[0]->product_sample_request_code . ' ';
                $email_message         = 'Hi ' . $res_sample[0]->supplier_name . ',&#10;Please find the attached policy copy for claim' . '&#10;';
                $sms_message           = '&#10;Thanks&#10;Arjun Ravindar';
                $data['email_message'] = $email_message . $sms_message;
            }
            $data['action'] = site_url('product_sample_request/sample_request/'.$id);
            $this->load->view('common/menu');
            $this->load->view('product_sample_request/sample_request_supplier_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    
    
    function generate_sample_order_request_pdf($id,$data=''){
		$data['product_sample_request'] = $this->Common_model->getDetails('product_sample_request','product_sample_request_id',$id);
		
		$data['product_sample_request_particulars'] = $this->Common_model->getDetails('product_sample_request_particulars','ref_product_sample_request_id',$id);
		
		$data['supplier'] = $this->Common_model->getDetails('supplier','supplier_id',$data['product_sample_request'][0]->ref_supplier_id);
		$data['company'] = $this->Common_model->getDetails('company','company_id',$data['supplier'][0]->ref_company_id);
		
		$data['client'] = $this->Common_model->getDetails('client','client_id',$data['product_sample_request'][0]->ref_client_id);
		$data['special_instruction'] = $data['product_sample_request_details'];            
		$this->load->library('parser');
		$html = $this->parser->parse('template/pdf/POF_tmp_new', $data);
		
		$header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
		$f_name = 'uploads/product_sample_request/' . str_replace('/','_',$data['product_sample_request'][0]->product_sample_request_code).'_'. time(). '.pdf';
		$file_name = FCPATH.$f_name;
		$this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','F');
		
		return $f_name;
	}
	
	
	function generate_dc()
    {
        $id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = $this->input->post();
            
           
            
            $res_product_sample_request = $this->Common_model->getDetails('product_sample_request','product_sample_request_id',$id);
            //$sof_data['ref_supplier_id'] = $res_product_sample_request[0]->ref_supplier_id;
			//$res_code = $this->Product_sample_request_model->get_dc_code($sof_data);
			
			$dc_data['delivery_challan_code'] = $data['delivery_challan_code'];
			//$dc_data['delivery_challan_no'] = $res_code['delivery_challan_no'];
			//$dc_data['delivery_challan_code'] = $res_code['delivery_challan_code'];
			$dc_data['ref_product_sample_request_id'] = $id;
			$dc_data['delivery_challan_date'] = $data['delivery_challan_date'];
			$dc_data['ref_product_sample_request_id'] = $res_product_sample_request[0]->product_sample_request_id;
			$dc_data['ref_despatch_mode_id'] = $res_product_sample_request[0]->ref_despatch_mode_id;
			$dc_data['ref_delivery_point_id'] = $res_product_sample_request[0]->ref_delivery_point_id;
			$dc_data['ref_client_id'] = $res_product_sample_request[0]->ref_client_id;
			$dc_data['ref_supplier_id'] = $res_product_sample_request[0]->ref_supplier_id;
			$dc_data['delivery_challan_details'] = $data['delivery_challan_details'];

            // Customer DC details
            $dc_data['customer_delivery_challan_date'] = $data['customer_delivery_challan_date'];
            $dc_data['customer_delivery_challan_code'] = $data['customer_delivery_challan_code'];
            $dc_data['customer_despatch_mode_id'] = $data['customer_despatch_mode_id'];
            $dc_data['customer_delivery_point_id'] = $data['customer_delivery_point_id'];
            if(isset($data['customer_delivery_challan_date']) && !empty($data['customer_delivery_challan_date'])){
                $dc_data['customer_delivery_challan'] = 1;
            }

			$dc_data['tbl_delivery_challan_particulars'] = $data['tbl_delivery_challan_particulars'];


             //debug($dc_data); exit;
            
			$dc_id = $this->Common_model->addRecord('delivery_challan',$dc_data);
			//exit;
            $res_dc_file = $this->generate_dc_pdf($dc_id,$data);
			$u_data['delivery_challan_file'] = $res_dc_file;
			$this->Common_model->updateRecord('delivery_challan',$u_data,$dc_id);
			
            // Generate customer DC And update
            if(isset($data['customer_delivery_challan_date']) && !empty($data['customer_delivery_challan_date'])){
                $res_customer_dc_file = $this->generate_dc_pdf($dc_id,$data,1);
                $up_data['customer_delivery_challan_file'] = $res_customer_dc_file;
                $this->Common_model->updateRecord('delivery_challan',$up_data,$dc_id);
            }

            //exit;

            $attach_product_request_docs = array();
            
            $res_sample = $this->Common_model->getDetails('product_sample_request','product_sample_request_id', $id);
            $attach_product_request_docs[] = FCPATH.$res_dc_file;
            $to_address                 = array();
            $email_additional           = array();
            if (isset($data['supplier_email'])) {
                $to_address[] = $data['supplier_email'];
            }
            if (!empty($data['email_additional'])) {
                $email_additional = explode(',', $data['email_additional']);
                $to_address       = array_merge($to_address, $email_additional);
            }
	    
            $mail_data                          = array();
            $mail_data['from_address']          = FROM_ADDRESS;
            $mail_data['to_address']            = implode(',', $to_address);
            $mail_data['subject']               = $data['email_subject'];
            $mail_data['message'] 				= str_replace('&#10;', '<br>', $data['email_message']);
            $mail_data['name']                  = $res_sample[0]->supplier_name;
            $mail_data['attachment']            = $attach_product_request_docs;
            $mail_data['template_path']         = 'template/email/product_document.php';
            
            //$res = $this->Common_model->sendEmail($mail_data);
            
            if ($dc_id) {
				$pc_data['delivery_challan_status'] = 1;
				$pc_data['ref_product_request_status_id'] = 4;
				$this->Common_model->updateRecord('product_sample_request', $pc_data,$res_sample[0]->product_sample_request_id);

                // Update delivered Product qty
                if(isset($data['tbl_delivery_challan_particulars']) && !empty($data['tbl_delivery_challan_particulars'])){
                    foreach ( $data['tbl_delivery_challan_particulars'] as $key => $value) {                   
                        $this->Product_sample_request_model->updateQty($this->uri->segment(3),$value['ref_product_id'],$value['qty']);
                    }
                }

                $_SESSION['success_msg'] = 'DC Successfully generated...';
            } else {
                $_SESSION['error_msg'] = 'Error...Please try again...';
            }
            redirect('product_sample_request/getlist');
        } else {
			$data['sample_request_id'] = $this->uri->segment(3);
            $res_sample                               = $this->Common_model->getDetails('product_sample_request', 'product_sample_request_id', $id);
            $data['sample']                           = $res_sample;
			$data['supplier_contact_numbers'] = $this->Common_model->getDetails('supplier_contact_numbers', 'ref_supplier_id', $res_sample[0]->ref_supplier_id);
            $data['client_email_ids']       = $this->Common_model->getDetails('client_email_ids', 'ref_client_id', $res_sample[0]->ref_client_id);
            $data['subject']                          = '';
            $data['message']                          = '';
            if (isset($res_sample) && !empty($res_sample)){
                $data['subject'] = $res_sample[0]->supplier_name . '-Product Request ( #' . $res_sample[0]->supplier_name . ' )';
                $email_message         = 'Please find the attached policy copy for claim' . '&#10;';
                $sms_message           = '&#10;Thanks&#10;STS Marketing';
                $data['email_message'] = $email_message . $sms_message;
            }
            
            $data['sample_request'] = $this->Common_model->getDetails('product_sample_request','product_sample_request_id',$id);
            $data['product_sample_request_particulars'] = $this->Common_model->getDetails('product_sample_request_particulars','ref_product_sample_request_id',$id);
            
            $this->load->view('common/menu');
            $this->load->view('product_sample_request/delivery_challan_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    
    function generate_dc_pdf($id,$data='',$customer_dc=0){
		$data['dc_details'] = $this->Common_model->getDetails('delivery_challan','delivery_challan_id',$id);
		
		$psr_id = $data['dc_details'][0]->ref_product_sample_request_id;
		
		$data['product_sample_request'] = $this->Common_model->getDetails('product_sample_request','product_sample_request_id',$psr_id);
		
		$data['product'] = $this->Common_model->getDetails('delivery_challan_particulars','ref_delivery_challan_id',$id);
		
		//~ echo '<pre>';
		//~ print_r($data['product']);
		//~ echo '</pre>';
		//~ exit;
		
		$data['supplier'] = $this->Common_model->getDetails('supplier','supplier_id',$data['product_sample_request'][0]->ref_supplier_id);
		
		$data['company'] = $this->Common_model->getDetails('company','company_id',$data['supplier'][0]->ref_company_id);
		
		$data['product_sample_request_code'] = $data['product_sample_request'][0]->product_sample_request_code;
		
		$data['client'] = $this->Common_model->getDetails('client','client_id',$data['product_sample_request'][0]->ref_client_id);
		
		$data['special_instruction'] = $data['delivery_challan_details'];           
		$data['customer_dc'] = $customer_dc;
        //echo '<br>';
        if($customer_dc){
            $delivery_challan_code = $data['dc_details'][0]->customer_delivery_challan_code;
        }else{
            $delivery_challan_code = 'S_'.$data['dc_details'][0]->delivery_challan_code;   
        }
        
		$this->load->library('parser');
        $html = $this->parser->parse('template/pdf/delivery_challan_tmp', $data);    
		$header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $fname = 'uploads/delivery_challan/' . str_replace('/','_',$delivery_challan_code).'_'.time() . '.pdf';  
        			
		$file_name = FCPATH.$fname;
		$this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','F');
		
		return $fname;
	}

	function add_dc()
	{
	    $this->hasPermission('delivery_challan_add');
	    if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = $this->input->post();
            $dc_code_data['ref_supplier_id'] = $data['ref_supplier_id']; 
			$res_code = $this->Product_sample_request_model->get_dc_code($dc_code_data);
			
			$data['delivery_challan_no'] = $res_code['delivery_challan_no'];
			$data['delivery_challan_code'] = $res_code['delivery_challan_code'];			
			if(isset($data['supplier_email']) && !empty($data['supplier_email'])){
				$data['supplier_email'] = implode(',', $data['supplier_email']);
			}
			$email_message = $data['email_message'];
			unset($data['email_message']);
			$data['tbl_delivery_challan_particulars'] = $data['tbl_product_sample_request_particulars'];
			unset($data['tbl_product_sample_request_particulars']);
			//~ echo '<pre>';
            //~ print_r($data);
            //~ echo '</pre>';
            //~ exit;
            
			$res = $this->Common_model->addRecord('delivery_challan', $data);
			
			$data['dc_id'] = $res;
			$pdf_data['dc_details'] = $this->Common_model->getDetails('delivery_challan','delivery_challan_id',$res);			
			$pdf_data['product'] = $this->Common_model->getDetails('delivery_challan_particulars','ref_delivery_challan_id',$res);
			$pdf_data['supplier'] = $this->Common_model->getDetails('supplier','supplier_id',$pdf_data['dc_details'][0]->ref_supplier_id);
			$pdf_data['company'] = $this->Common_model->getDetails('company','company_id',$pdf_data['supplier'][0]->ref_company_id);
			$pdf_data['client'] = $this->Common_model->getDetails('client','client_id',$pdf_data['dc_details'][0]->ref_client_id);

		
			$this->load->library('parser');
			$html = $this->parser->parse('template/pdf/delivery_challan_tmp', $pdf_data);
			$header_html = $this->parser->parse('template/pdf/pdf_header',$data);
			$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
			$fname = 'uploads/delivery_challan/' . str_replace('/','_',$data['delivery_challan_code']) . '.pdf';
			$file_name = FCPATH.$fname;			
			$dc['delivery_challan_file'] = $fname;						
			$res1 = $this->Common_model->updateRecord('delivery_challan',$dc,$res);
			$this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','F');
			
			$attach_docs = $file_name;
			$email_subject  = "Delivery Challan - #".$pdf_data['dc_details'][0]->delivery_challan_code."";
			$to_address                 = array();
            $email_additional           = array();
            
            if(isset($data['supplier_email']) && !empty($data['supplier_email'])){
                $to_address[] = $data['supplier_email'];
            }
	    
            if(!empty($data['email_additional'])){
                $email_additional = explode(',', $data['email_additional']);
                $to_address       = array_merge($to_address, $email_additional);
            }
			if(isset($to_address) && !empty($to_address)){
				$mail_data                          = array();
				$mail_data['from_address']          = FROM_ADDRESS;
				$mail_data['to_address']            = implode(',', $to_address);
				$mail_data['subject']               = $email_subject;
				$mail_data['message']			    = $email_message;
				$mail_data['name']                  = $res_sample[0]->supplier_name;
				$mail_data['attachment']            = $attach_docs;
				$mail_data['template_path']         = 'template/email/delivery_challan.php';
				
				$res2 = $this->Common_model->sendEmail($mail_data);
			}
	   
			if($res && $res2){				
				$this->Common_model->addUserActivity('dc_add',$res); // Record User Activity
                $_SESSION['success_msg'] = 'Delivery Challan Create and successfully sent...';
            }elseif($res){
				$_SESSION['success_msg'] = 'Delivery Challan Created successfully but mail not send...';
            }else{                
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
			redirect('product_sample_request/get_delivery_challan_list');
		}else {
			$this->load->view('common/menu');
			$this->load->view('product_sample_request/dc_form_view', $data);
			$this->load->view('common/footer');
		}
	}
	 function export_delivery_challan_excel()
   {
       $this->hasPermission('product_sample_request_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'delivery_challan_id';
        $data['order'] = 'ASC';
        $table['tbl_main'] = 'delivery_challan';

        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'delivery_challan_id');

		
        foreach ($mainlist as $key => $val) {
            $export_list[] = array(				
				$val->delivery_challan_code,
				$this->Common_model->getDateFormat($val->delivery_challan_date),
				$val->client_name,
				$val->supplier_name,   
				$val->despatch_mode_name,
				$val->delivery_point_name,
				//~ $val->email_subject, 
				//~ $val->supplier_email, 
				//~ $val->email_additional, 
				$val->delivery_challan_details			
            );
        }
    
        $export        = array();
        $export_column = array(
			'Delivery Challan No',
			'Delivery Challan Date',
			'Client Name',
			'Supplier Name', 		        
			
			'Despatch Mode Name',
			'Delivery Point Name',
			//~ 'Email Subject', 
			//~ 'Supplier Email', 
			//~ 'Email Additional', 
			'Delivery Challan Details'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row){
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Delivery_Challan_List_' . date('d-m-Y_H:i:s'));
   }

    function export_customer_delivery_challan_excel($customer_dc=0)
   {
       $this->hasPermission('product_sample_request_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'delivery_challan_id';
        $data['order'] = 'ASC';
        $table['tbl_main'] = 'delivery_challan';
        $filter_data['customer_dc'] = 1;
        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'delivery_challan_id');
        
        foreach ($mainlist as $key => $val) {    
            $despatch_mode_name = '';
            $delivery_point_name = '';
            $res_despatch_mode = $this->Common_model->getDetails('despatch_mode','despatch_mode_id',$val->customer_despatch_mode_id);
            if(isset($res_despatch_mode) && !empty($res_despatch_mode)){
            $despatch_mode_name = $res_despatch_mode[0]->despatch_mode_name;   
            }

            $res_delivery_point = $this->Common_model->getDetails('delivery_point','delivery_point_id',$val->customer_delivery_point_id);
            if(isset($res_delivery_point) && !empty($res_delivery_point)){
            $delivery_point_name = $res_delivery_point[0]->delivery_point_name;   
            }

            $export_list[] = array(             
                $val->customer_delivery_challan_code,
                $this->Common_model->getDateFormat($val->customer_delivery_challan_date),
                $val->client_name,
                $val->supplier_name,   
                $despatch_mode_name,
                $delivery_point_name,
                //~ $val->email_subject, 
                //~ $val->supplier_email, 
                //~ $val->email_additional, 
                $val->delivery_challan_details          
            );
        }
    
        $export        = array();
        $export_column = array(
             
            'Delivery Challan No',
            'Delivery Challan Date',
            'Client Name',
            'Supplier Name',                
            
            'Despatch Mode Name',
            'Delivery Point Name',
            //~ 'Email Subject', 
            //~ 'Supplier Email', 
            //~ 'Email Additional', 
            'Delivery Challan Details'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row){
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Delivery_Challan_List_' . date('d-m-Y_H:i:s'));

   }


    function export_proforma_invoice_excel()
   {
         //$this->hasPermission('product_proforma_invoice_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'proforma_invoice_id';
        $data['order'] = 'ASC';
        $table['tbl_main'] = 'proforma_invoice';

        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'proforma_invoice_id');


        foreach ($mainlist as $key => $val) {

	    if($val->mail_status){
			$mail_status = "Yes";
	    }else{
			$mail_status = "-";
	    }
	    $export_list[] = array(
			
			$val->proforma_invoice_code,
			$this->Common_model->getDateFormat($val->proforma_invoice_date),
			$val->client_name,
			$val->supplier_name,
			$val->client_email,
			$val->email_additional, 
			$val->email_subject, 
			$val->proforma_invoice_details,
			$val->proforma_invoice_reference,
			$val->proforma_invoice_status_name,
			$mail_status		
            );
        }
    
        $export        = array();
        $export_column = array(
			'Proforma Invoice No',
			
			'Proforma Invoice Date',
			'Client Name',	
			'Supplier Name',
			'Client Email',
			'Email Additional',	 
			'Email Subject', 	
			'Proforma Invoice Details',
			'Proforma Invoice Reference',
			'Proforma Invoice Status',
			'Mail Status'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row){
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Proforma_Invoice_List_' . date('d-m-Y_H:i:s'));

   }


    function export_proforma_invoice_pdf()
    {
	//$this->hasPermission('product_sample_request_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'proforma_invoice_id';
        $data['order']    = 'ASC';
        $table['tbl_main']  = 'proforma_invoice';
        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'proforma_invoice_id');

	
        $data['title'] = 'Proforma Invoice List';
        
       // Row Header
        $data['row_header'] = array();
	
        $data['row_header'][] = array(
			'name'		=> 'S No',
			'width'		=> '6%',
			'align'		=> 'center'
        );
        $data['row_header'][] = array(
			'name'		=> 'Pro.Inv No',
			'width'		=> '12%',
			'align'		=> 'left'
        );
        $data['row_header'][] = array(
			'name'		=> 'Date',
			'width'		=> '10%',
			'align'		=> 'left'
        );

         $data['row_header'][] = array(
			'name'		=> 'Client',
			'width'		=> '31%',
			'align'		=> 'left'
        );

        $data['row_header'][] = array(
			'name'		=> 'Supplier',
			'width'		=> '29%',
			'align'		=> 'left'
        );

	 $data['row_header'][] = array(
			'name'		=> 'Reference',
			'width'		=> '13%',
			'align'		=> 'left'
        );
        // Row Data
        $data['row_data'] = array();
        if(isset($mainlist) && !empty($mainlist)){
			$i = 1;
	    foreach($mainlist as $key => $val){
				$pi_date = $this->Common_model->getDateFormat($val->proforma_invoice_date);
	    
				 $data['row_data'][] = array(
					$i,
					$val->proforma_invoice_code,
					$pi_date,
					$val->client_name,
					$val->supplier_name,
					$val->proforma_invoice_reference
				);
			  $i++;
			}
				
		}
       

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
		$header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $file_name = 'product_sample_request_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');

    }
    
    function export_delivery_challan_pdf()
    {
	$this->hasPermission('product_sample_request_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'delivery_challan_id';
        $data['order']    = 'ASC';
        $table['tbl_main']  = 'delivery_challan';
        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'delivery_challan_id');

	
        $data['title'] = 'Supplier Delivery Challan List';
        
       // Row Header
        $data['row_header'] = array();
	
        $data['row_header'][] = array(
			'name'		=> 'S No',
			'width'		=> '6%',
			'align'		=> 'center'
        );
        $data['row_header'][] = array(
			'name'		=> 'DC No',
			'width'		=> '10%',
			'align'		=> 'left'
        );
        $data['row_header'][] = array(
			'name'		=> 'Dc Date',
			'width'		=> '10%',
			'align'		=> 'left'
        );
        

         $data['row_header'][] = array(
			'name'		=> 'Client',
			'width'		=> '26%',
			'align'		=> 'left'
        );

        $data['row_header'][] = array(
			'name'		=> 'Supplier',
			'width'		=> '26%',
			'align'		=> 'left'
        );

        
        $data['row_header'][] = array(
			'name'		=> 'Despatch',
			'width'		=> '10%',
			'align'		=> 'left'
        );
        
        $data['row_header'][] = array(
			'name'		=> 'Delivey To',
			'width'		=> '12%',
			'align'		=> 'left'
        );
               
        // Row Data
        $data['row_data'] = array();
        if(isset($mainlist) && !empty($mainlist)){
			$i = 1;
	    foreach($mainlist as $key => $val){
			$dc_date = $this->Common_model->getDateFormat($val->delivery_challan_date);
	    
				 $data['row_data'][] = array(
					$i,
					$val->delivery_challan_code,
					$dc_date,
					$val->client_name,
					$val->supplier_name,
					$val->despatch_mode_name,
					$val->delivery_point_name
				);
			  $i++;
			}
				
		}
       

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
		$header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $file_name = 'product_sample_request_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');

    }

    function export_customer_delivery_challan_pdf()
    {
    $this->hasPermission('product_sample_request_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'delivery_challan_id';
        $data['order']    = 'ASC';
        $table['tbl_main']  = 'delivery_challan';
        $filter_data['customer_dc'] = 1;
        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'delivery_challan_id');

    
        $data['title'] = 'Customer Delivery Challan List';
        
       // Row Header
        $data['row_header'] = array();
    
        $data['row_header'][] = array(
            'name'      => 'S No',
            'width'     => '6%',
            'align'     => 'center'
        );
        $data['row_header'][] = array(
            'name'      => 'DC No',
            'width'     => '10%',
            'align'     => 'left'
        );
        $data['row_header'][] = array(
            'name'      => 'Dc Date',
            'width'     => '10%',
            'align'     => 'left'
        );
        

         $data['row_header'][] = array(
            'name'      => 'Client',
            'width'     => '26%',
            'align'     => 'left'
        );

        $data['row_header'][] = array(
            'name'      => 'Supplier',
            'width'     => '26%',
            'align'     => 'left'
        );

        
        $data['row_header'][] = array(
            'name'      => 'Despatch',
            'width'     => '10%',
            'align'     => 'left'
        );
        
        $data['row_header'][] = array(
            'name'      => 'Delivey To',
            'width'     => '12%',
            'align'     => 'left'
        );
               
        // Row Data
        $data['row_data'] = array();
        if(isset($mainlist) && !empty($mainlist)){
            $i = 1;
        foreach($mainlist as $key => $val){
            $despatch_mode_name = '';
            $delivery_point_name = '';
            $res_despatch_mode = $this->Common_model->getDetails('despatch_mode','despatch_mode_id',$val->customer_despatch_mode_id);
            if(isset($res_despatch_mode) && !empty($res_despatch_mode)){
            $despatch_mode_name = $res_despatch_mode[0]->despatch_mode_name;   
            }

            $res_delivery_point = $this->Common_model->getDetails('delivery_point','delivery_point_id',$val->customer_delivery_point_id);
            if(isset($res_delivery_point) && !empty($res_delivery_point)){
            $delivery_point_name = $res_delivery_point[0]->delivery_point_name;   
            }

            $dc_date = $this->Common_model->getDateFormat($val->customer_delivery_challan_date);
        
                 $data['row_data'][] = array(
                    $i,
                    $val->customer_delivery_challan_code,
                    $dc_date,
                    $val->client_name,
                    $val->supplier_name,
                    $despatch_mode_name,
                    $delivery_point_name
                );
              $i++;
            }
                
        }
       

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
        $header_html = $this->parser->parse('template/pdf/pdf_header',$data);
        $footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $file_name = 'product_sample_request_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');

    }

    
    function export_product_sample_request_excel()
    {
        $this->hasPermission('product_sample_request_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'product_sample_request_id';
        $data['order'] = 'ASC';
        $table['tbl_main'] = 'product_sample_request';

        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'product_sample_request_id');

	
        foreach ($mainlist as $key => $val) {
	    
            $export_list[] = array(
				$val->product_sample_request_code,
				$this->Common_model->getDateFormat($val->product_sample_request_date),
				$val->client_name,
				$val->supplier_name,
				$val->delivery_point_name,
				$this->Common_model->getDateFormat($val->dispatch_date),
				$this->Common_model->getDateFormat($val->delivered_date),
				$this->Common_model->getDateFormat($val->installation_date),
				$this->Common_model->getDateFormat($val->reminder_date),
				$val->client_feedback,
				$val->product_request_status_name,
				$val->product_sample_request_details
				
            );
        }
    
        $export        = array();
        $export_column = array(
			'Product Sample Request Code',
			'Product Sample Request Date',
			'Client Name',
			'Supplier Name',
			'Delivery Point Name',
			'Dispatch Date',
			'Delivered Date',
			'Installation Date',
			'Reminder Date',
			'Client Feedback',
			'Product Request Status Name',
			'Product Sample Request Details'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row){
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Product_Sample_request_List_' . date('d-m-Y_H:i:s'));
    }
	
	public function export_product_sample_request_pdf()
    {
       $this->hasPermission('product_sample_request_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'product_sample_request_id';
        $data['order']    = 'ASC';
        $table['tbl_main']  = 'product_sample_request';
        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'product_sample_request_id');

        $data['title'] = 'Product Sample Request List';
        
       // Row Header
        $data['row_header'] = array();
	
        $data['row_header'][] = array(
			'name'		=> 'S No',
			'width'		=> '6%',
			'align'		=> 'center'
        );

        $data['row_header'][] = array(
			'name'		=> 'SOF No',
			'width'		=> '17%',
			'align'		=> 'left'
        );
         $data['row_header'][] = array(
            'name'      => 'Date',
            'width'     => '8%',
            'align'     => 'left'
        );
        $data['row_header'][] = array(
			'name'		=> 'Client Name',
			'width'		=> '31%',
			'align'		=> 'left'
        );
        

         $data['row_header'][] = array(
			'name'		=> 'Supplier',
			'width'		=> '33%',
			'align'		=> 'left'
        );

       

        //~ $data['row_header'][] = array(
			//~ 'name'		=> 'Reminder',
			//~ 'width'		=> '8%',
			//~ 'align'		=> 'left'
        //~ );
               
        // Row Data
        $data['row_data'] = array();
        if(isset($mainlist) && !empty($mainlist)){
			$i = 1;
	    foreach($mainlist as $key => $val){
				$req_date = $this->Common_model->getDateFormat($val->product_sample_request_date);
				$ins_date = $this->Common_model->getDateFormat($val->installation_date);
				$remin_date = $this->Common_model->getDateFormat($val->reminder_date);
                $product_sample_request_date = $this->Common_model->getDateFormat($val->product_sample_request_date);
						
				$data['row_data'][] = array(
					$i,
					$val->product_sample_request_code,
                    $product_sample_request_date,
					$val->client_name,
					$val->supplier_name,
					//$req_date,
					//$ins_date,
					
				);
			  $i++;
			}
				
		}
       

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
		$header_html = $this->parser->parse('template/pdf/pdf_header',$data);
		$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $file_name = 'product_sample_request_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');
        
    }
    
}
?>
