<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Sales_return extends CI_Controller
{
	
	
	
    function __construct()
    {
        parent::__construct();
         $this->load->model(array(
            'Sales_return_model'
        ));
        $session_data       = $this->session->userdata( SESSION_LOGIN . 'logged_in' );
        $data['username']   = $session_data['username'];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        if (empty($data['permission'])) {
            redirect('home');
        }
      //  $data['designation']         = $this->Common_model->getDropdownList('designation');
       // $data['user']            = $this->Common_model->getDropdownList('user');
		$data['title'] = 'Sales Return';
       // $this->output->enable_profiler(TRUE);
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
        //$this->hasPermission('invoice_view');
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
            $sort = 'invoice_return_id';
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
        
        $data['start']            		 = $start;
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;   
        $branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
        if($branch_id>0)
        {
            $where=" invoice_return.ref_branch_id=".$branch_id." ";
        }
        else
        {
            $where=" 1 ";
        }  
        $table['tbl_main']           = 'invoice_return';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data,'invoice_return_id', $where);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data,'invoice_return_id', $where);		
		$data['tablefields']      = $this->Common_model->getTableFields('invoice_return');		
		$data['operations']          = $this->Common_model->getFilterOperation();
		$data['init_listing_page']   = 'invoice/getlist/';
		$data['listing_page']        = $data['init_listing_page'] . $page . '/';
		$data['filter_block']      = $this->parser->parse('common/filter', $data, true);
		$data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        $this->load->view('common/menu');
        $this->load->view('sales_return/invoice_list_view', $data);
        $this->load->view('common/footer');
    }
    
   
    function add()
    {
        $this->hasPermission('invoice_add');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data = $this->input->post();
            //debug($data); exit;
			$branch_id = $data['ref_branch_id'];
            $res_code = $this->Invoice_model->get_invoice_code($branch_id);
            $data['invoice_no'] = $res_code['invoice_no'];
            $data['invoice_name'] = $res_code['invoice_code'];
            $po_particulars = $data['tbl_invoice_particulars'];
            $ref_customer_order_id = $data['ref_customer_order_id'];
            $data['invoice_payment_status'] = 1;
            unset($data['tbl_invoice_particulars']);
            unset($data['ref_invoice_id']);
            unset($data['ref_customer_order_id']);

            $cur_month = date('m');
           // $cur_month = 4;
            if ($cur_month > 3) {
                $data['financial_year'] = date('y')."-".(date('y') +1);
            } else {
                $data['financial_year'] = (date('y')-1)."-".date('y');
            }
            
           /* $patient_visit_id = 0;
            if(isset($data['ref_patient_visit_id'])){
                $patient_visit_id = $data['ref_patient_visit_id'];
                //unset($data['patient_visit_id']);
            }*/
            //debug($data); exit;
            $res = $this->Common_model->addRecord('invoice', $data);
            $gst_total = 0;            
            $disc_total = 0;            
            $gst_5_total = 0;            
            $gst_12_total = 0;            
            $gst_18_total = 0;            
            if(isset($po_particulars) && !empty($po_particulars)){
                $supplier_comm_total = 0;
                foreach($po_particulars as $val){               
                    if(!empty($val['qty'])){
                        if($val['gst_perc'] == 5){
                            $gst_5_total += $val['gst'];
                        }
                        if($val['gst_perc'] == 12){
                            $gst_12_total += $val['gst'];
                        }
                        if($val['gst_perc'] == 18){
                            $gst_18_total += $val['gst'];
                        }

                        $gst_total+= $val['gst'];
                        $disc_total+= $val['discount_total'];
                        $org_qty = 0;
                        if(isset($val['org_qty']) && !empty($val['org_qty'])){
                            $org_qty = $val['org_qty'];
                            unset($val['org_qty']);
                        }
                        unset($val['org_qty']);
                       
                        $po_p_data = $val;
                        $po_p_data['ref_invoice_id'] = $res;
                        $res_product = $this->Common_model->getDetails('product','product_id',$val['ref_product_id']);
                        $po_p_data['supplier_comm_perc'] = $res_product[0]->supplier_comm_perc;
                        $po_p_data['supplier_comm_total'] =  (($val['price'] * $val['qty'] ) * $po_p_data['supplier_comm_perc'])/100;           
                        $supplier_comm_total += $po_p_data['supplier_comm_total'];
                       // debug($po_p_data);
                        
                        $this->Common_model->addRecord('invoice_particulars', $po_p_data);
                        $this->Invoice_model->update_product_quantity($val['ref_product_id'],$val['qty'],'deduct');
                        $this->Invoice_model->update_product_batch_quantity($val['ref_product_batch_id'],$val['qty'],'deduct');
                    }
                }
                $this->add_product_comm_txn($supplier_comm_total,$res);
            }
           // Update PDF file           
            $u_data['gst_total'] = $gst_total;
            if($disc_total > 1){
                $u_data['discount_total'] = $disc_total;
            }
            $u_data['gst_5_total'] = $gst_5_total;
            $u_data['gst_12_total'] = $gst_12_total;
            $u_data['gst_18_total'] = $gst_18_total;           
            $this->Common_model->updateRecord('invoice',$u_data,$res);

            //$res_po_file = $this->generate_invoice_pdf($res,$data);
           // $this->Common_model->updateRecord('invoice',array('invoice_file' => $res_po_file),$res);

            if(!empty($data['ref_patient_visit_id'])){
                $u_data1['invoice_status'] = 1;
                $this->Common_model->updateRecord('patient_visit',$u_data1,$data['ref_patient_visit_id']);
            }

            if(!empty($ref_customer_order_id)){
                $u_data2['ref_invoice_id'] = $res;
                $u_data2['ref_status_id'] = 3;
                $this->Common_model->updateRecord('customer_order',$u_data2,$ref_customer_order_id);
            }
           
            if($res){
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('invoice_add',$res); 
                $_SESSION['success_msg'] = 'Invoice successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('sales_return/index');           
        } else {
            $id = $this->uri->segment(3);
            $data['action'] = site_url('invoice/add');
            $this->load->view('common/menu');
            $this->load->view('invoice/invoice_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    
    function add_product_comm_txn($comm_total,$invoice_id){
        $data['accounts_transaction_date'] = date('Y-m-d H:i:s');
        $data['ref_accounts_code_id'] = 1;
        $data['ref_invoice_id'] = $invoice_id;
        $data['ref_accounts_transaction_category_id'] = 1;
        $data['ref_accounts_transaction_type_id'] = 1;
        $data['accounts_transaction_particulars'] = 'Product commission';
        $data['accounts_transaction_credit'] = $comm_total;
        //debug($data); exit;
        $this->Common_model->addRecord('accounts_transaction',$data);

    }

    function view()
    {
        $this->hasPermission('invoice_view');
        $id                      = $this->uri->segment(3);
        $data['invoice']         = $this->Common_model->getDetails('invoice', 'invoice_id', $id);
        $data['invoice_numbers']  = $this->Common_model->getDetails('invoice_contact_numbers', 'ref_invoice_id', $id);
        $data['invoice_emails']  = $this->Common_model->getDetails('invoice_email_ids', 'ref_invoice_id', $id);
        $this->load->view('common/menu');
        $this->load->view('invoice/invoice_details_view', $data);
        $this->load->view('common/footer');
    }
    
    function invoice_return($id=null)
    {
        extract($_POST);
        //print_r($_POST);
        if(isset($ref_customer_order_id))
        {
            //     $this->hasPermission('invoice_add');
            //   if ($this->input->server('REQUEST_METHOD') == 'POST') 
            //   {
            //$this->Common_model->TxnBegin();
            $data = $this->input->post();
            $res_code=$this->Common_model->getDetails('invoice','invoice_id',$id);
            $data['invoice_no'] = $res_code[0]->invoice_no;
            $data['invoice_name'] = $res_code[0]->invoice_name;
            $data['ref_branch_id'] = $res_code[0]->ref_branch_id;
            $data['ref_patient_id'] = $res_code[0]->ref_patient_id;
            $data['ref_customer_id'] = $res_code[0]->ref_customer_id;
            $return_code= $this->Sales_return_model->get_return_invoice_code($res_code[0]->ref_branch_id);
            $data['invoice_return_name']=$return_code['invoice_code'];
            $data['invoice_return_no']=$return_code['invoice_no'];
            $po_particulars = $data['tbl_invoice_particulars'];
            $ref_customer_order_id = $data['ref_customer_order_id'];
            $data['invoice_payment_status'] = 1;
            $data['invoice_date']=$this->Common_model->getDateFormat(date('d-m-Y'));
            unset($data['tbl_invoice_particulars']);
            unset($data['ref_invoice_id']);
            unset($data['ref_customer_order_id']);
            unset($data['id']);
            // echo "<pre>";
            // print_r($data);
            // exit();
            $cur_month = date('m');
            if ($cur_month > 3) {
                $data['financial_year'] = date('y')."-".(date('y') +1);
            } else {
                $data['financial_year'] = (date('y')-1)."-".date('y');
            }
            $res = $this->Common_model->addRecord('invoice_return', $data);
            
            $gst_total = 0;            
            $disc_total = 0;            
            $gst_5_total = 0;            
            $gst_12_total = 0;            
            $gst_18_total = 0;            
            if(isset($po_particulars) && !empty($po_particulars))
            {
                $supplier_comm_total = 0;
                foreach($po_particulars as $val){               
                    if(!empty($val['qty']))
                    {
                        if($val['gst_perc'] == 5){
                            $gst_5_total += $val['gst'];
                        }
                        if($val['gst_perc'] == 12){
                            $gst_12_total += $val['gst'];
                        }
                        if($val['gst_perc'] == 18){
                            $gst_18_total += $val['gst'];
                        }

                        $gst_total+= $val['gst'];
                        $disc_total+= $val['discount_total'];
                        $ord_qty = 0;
                        if(isset($val['ord_qty']) && !empty($val['ord_qty'])){
                            $ord_qty = $val['ord_qty'];
                            unset($val['ord_qty']);
                        }
                        unset($val['ord_qty']);
                       
                        $po_p_data = $val;
                        $po_p_data['ref_invoice_return_id'] = $res;
                        $res_product = $this->Common_model->getDetails('product','product_id',$val['ref_product_id']);
                        $po_p_data['supplier_comm_perc'] = $res_product[0]->supplier_comm_perc;
                        $po_p_data['supplier_comm_total'] =  (($val['price'] * $val['qty'] ) * $po_p_data['supplier_comm_perc'])/100;           
                        $supplier_comm_total += $po_p_data['supplier_comm_total'];
                       // debug($po_p_data);
                        
                        $this->Common_model->addRecord('invoice_return_particulars', $po_p_data);
                        $this->Sales_return_model->update_product_quantity($val['ref_product_id'],$val['qty'],'add');
                        $this->Sales_return_model->update_product_batch_quantity($val['ref_product_batch_id'],$val['qty'],'add');
                    }
                }
            //     $this->add_product_comm_txn($supplier_comm_total,$res);
            }
            //    // Update PDF file          
            $u_data['gst_total'] = $gst_total;
            if($disc_total > 1){
                $u_data['discount_total'] = $disc_total;
            }
            $u_data['gst_5_total'] = $gst_5_total;
            $u_data['gst_12_total'] = $gst_12_total;
            $u_data['gst_18_total'] = $gst_18_total;           
            $this->Common_model->updateRecord('invoice_return',$u_data,$res);
            /*$res_po_file = $this->generate_invoice_pdf($res,$data);
            $this->Common_model->updateRecord('invoice_return',array('invoice_file' => $res_po_file),$res);*/
            redirect('sales_return/index');   

        }
        else
        {
            if(isset($id))
            {
                $data['invoice']    = $this->Common_model->getDetails('invoice','invoice_id',$id);
                $data['invoice_particulars']    = $this->Common_model->getDetails('invoice_particulars','ref_invoice_id',$id);
                $data['id']=$id;
            }
            else
            {
                $data['invoice'] ="";
                $data['invoice_particulars']="";
                $data['id']="";
            }
            $this->load->view('common/menu');
            $this->load->view('sales_return/return_invoice', $data);
            $this->load->view('common/footer');
        }
    }
     function edit()
    {
        $this->hasPermission('invoice_edit');
        $id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data = $this->input->post();
            unset($data['ref_invoice_id']);
            //debug($data); exit;
			
			if($data['home_delivery']) {
			$data['home_delivery'] = 1;
			} else {
			$data['home_delivery'] = 0;
			}
			
            $po_particulars = $data['tbl_invoice_particulars'];
            unset($data['tbl_invoice_particulars']);
            unset($data['ref_customer_order_id']);
            
            $res = $this->Common_model->updateRecord('invoice', $data,$id);
            $gst_total = 0;            
            $disc_total = 0;            
            $supplier_comm_total = 0; 
            $gst_5_total = 0;            
            $gst_12_total = 0;            
            $gst_18_total = 0;           
            if(isset($po_particulars) && !empty($po_particulars)){
                $this->Common_model->removeRecord('invoice_particulars','ref_invoice_id',$id);
                foreach($po_particulars as $val){
                    if($val['gst_perc'] == 5){
                        $gst_5_total += $val['gst'];
                    }
                    if($val['gst_perc'] == 12){
                        $gst_12_total += $val['gst'];
                    }
                    if($val['gst_perc'] == 18){
                        $gst_18_total += $val['gst'];
                    }
                    $gst_total+= $val['gst'];   
                    $disc_total+= $val['discount_total'];   
                    $org_qty = 0;
                    if(isset($val['org_qty'])){
                        $org_qty = $val['org_qty'];
                        unset($val['org_qty']);
                    }
                    $po_p_data = $val;
                    $po_p_data['ref_invoice_id'] = $res;    

                    $res_product = $this->Common_model->getDetails('product','product_id',$val['ref_product_id']);
                    $po_p_data['supplier_comm_perc'] = $res_product[0]->supplier_comm_perc;
                    $po_p_data['supplier_comm_total'] =  (($val['price'] * $val['qty'] ) * $po_p_data['supplier_comm_perc'])/100;           
                    $supplier_comm_total += $po_p_data['supplier_comm_total'];

                    $this->Common_model->addRecord('invoice_particulars', $po_p_data);
                    if($org_qty){
                        if($org_qty > $val['qty']){
                            $u_qty = $org_qty - $val['qty'];
                            $this->Invoice_model->update_product_quantity($val['ref_product_id'],$u_qty,'add');
                            $this->Invoice_model->update_product_batch_quantity($val['ref_product_batch_id'],$u_qty,'add');
                        }else{
                            $u_qty = $val['qty'] - $org_qty;
                            $this->Invoice_model->update_product_quantity($val['ref_product_id'],$u_qty,'deduct');
                            $this->Invoice_model->update_product_batch_quantity($val['ref_product_batch_id'],$u_qty,'deduct');
                        }
                    }else{
                        $this->Invoice_model->update_product_quantity($val['ref_product_id'],$val['qty'],'deduct');
                        $this->Invoice_model->update_product_batch_quantity($val['ref_product_batch_id'],$val['qty'],'deduct');
                    }
                    

                }
            }
            
            // Update PDF file          
            $u_data['gst_total'] = $gst_total;
            if($disc_total > 1){
                $u_data['discount_total'] = $disc_total;
            }          
            $u_data['gst_5_total'] = $gst_5_total;
            $u_data['gst_12_total'] = $gst_12_total;
            $u_data['gst_18_total'] = $gst_18_total;
            
            $this->Common_model->updateRecord('invoice',$u_data,$res);
            
            //$res_po_file = $this->generate_invoice_pdf($res,$data);
            //$this->Common_model->updateRecord('invoice',array('invoice_file' => $res_po_file),$res);
            
            // Update Commission total
            $this->Invoice_model->update_product_commission($id,$supplier_comm_total);

            if($res){
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('invoice_add',$res); 
                $_SESSION['success_msg'] = 'Invoice successfully updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('invoice');           
        } else {
            
            $data['invoice']    = $this->Common_model->getDetails('invoice','invoice_id',$id);
            $data['invoice_particulars']    = $this->Common_model->getDetails('invoice_particulars','ref_invoice_id',$id);
                   
            $data['action'] = site_url('invoice/edit/'.$id);
            $this->load->view('common/menu');
            $this->load->view('invoice/invoice_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    
   
    function delete()
    {        
        $this->hasPermission('invoice_delete');
        // Begin Transaction
		$this->Common_model->TxnBegin();
		$delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('invoice', 'invoice_id', $id);
                $this->Common_model->removeRecord('invoice_particulars', 'ref_invoice_id', $id);
                $this->Common_model->removeRecord('accounts_transaction', 'ref_invoice_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('invoice_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Invoice successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}   
        redirect('invoice/getlist/1');
    }


    function get_patient_pending_prescription_list()
    {
        
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
            $sort = 'patient_visit_id';
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
        
        $data['start']                   = $start;
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;       
        $table['tbl_main']           = 'patient_visit';
        $where = 'invoice_status = 0';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data,'',$where);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data,'',$where);     
        $data['tablefields']      = $this->Common_model->getTableFields('patient_visit');     
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'invoice/get_patient_pending_prescription_list/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
       // debug($data); //exit;
        $this->load->view('common/menu');
        $this->load->view('invoice/patient_pending_prescription_list_view', $data);
        $this->load->view('common/footer');
    }


     function get_patient_pres_sales_form($patient_visit_id){
        $res_pres_product = $this->Common_model->getDetails('prescribed_products','ref_patient_visit_id',$patient_visit_id);
        $res_fees = $this->Common_model->getDetails('consultant_fees','ref_patient_visit_id',$patient_visit_id);
        $doc_fees = 0;      
       if(isset($res_fees) && !empty($res_fees)){
            $doc_fees = $res_fees[0]->fees;
       }
        $data['invoice'][] = (object) array(
            'ref_patient_id' => $res_pres_product[0]->ref_patient_id,
            'ref_patient_visit_id' => $patient_visit_id,
            'p_and_f_total' => $doc_fees
        );
        $data['invoice_particulars'] = array();
        if(isset($res_pres_product) && !empty($res_pres_product)){
            foreach ($res_pres_product as $key => $val) {
                $res_product = $this->Common_model->getDetails('product','product_id',$val->ref_product_id);
                $data['invoice_particulars'][$key] = $res_product[0];
                $data['invoice_particulars'][$key]->selected_quantity = $val->selected_quantity;
                $data['invoice_particulars'][$key]->qty = $val->selected_quantity;
                $data['invoice_particulars'][$key]->price = $res_product[0]->product_price;
                $data['invoice_particulars'][$key]->gst_perc = $res_product[0]->gst_type_name;
                $data['invoice_particulars'][$key]->ref_product_id = $val->ref_product_id;
                $data['invoice_particulars'][$key]->discount_value = 0;
                $data['invoice_particulars'][$key]->discount_total = 0;
            }
        }
       // debug($data); exit;
        $data['doc_pres'] = 1;
        $data['action'] = site_url('invoice/add');
        $this->load->view('common/menu');
        $this->load->view('invoice/invoice_form_view', $data);
        $this->load->view('common/footer');

    }



    function payment_collection(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data = $this->input->post();
            $res_code = $this->Invoice_model->get_payment_code();
            $data['payment_history_no'] = $res_code['payment_history_no'];
            $data['payment_history_name'] = $res_code['payment_history_code'];
            $grand_total = $data['grand_total'];
            unset($data['grand_total']);
            $res = $this->Common_model->addRecord('payment_history',$data);
            
            if($data['invoice_payment_amount'] >= $grand_total){
                $res_1 = $this->Common_model->updateRecord('invoice',array('invoice_payment_status' => '1'),$data['ref_invoice_id']);
            }else{
                $res_1 = 1;
            }

            if($res && $res_1){
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('payment_collection_add',$res); 
                $_SESSION['success_msg'] = 'Payment collection successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('invoice/payment_collection');
        }else{
            $data['action'] = site_url('invoice/payment_collection');
            $this->load->view('common/menu');
            $this->load->view('invoice/payment_collection_form_view', $data);
            $this->load->view('common/footer');
        }   
    }



    function get_payment_history_list()
    {
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
            $sort = 'payment_history_id';
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
        
        $data['start']                   = $start;
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;       
        $table['tbl_main']           = 'payment_history';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data);     
        $data['tablefields']      = $this->Common_model->getTableFields('payment_history');     
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'invoice/get_payment_history_list/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        //debug($data); exit;
        $this->load->view('common/menu');
        $this->load->view('invoice/payment_history_list_view', $data);
        $this->load->view('common/footer');
    }

    function export_payment_history_excel()
    {      
        $this->hasPermission('invoice_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'payment_history_id';
        $data['order'] = 'ASC';
        $table['tbl_main']           = 'payment_history';
        $mainlist      = $this->Common_model->getList($table, $data, $filter_data);
        //debug($mainlist); exit;

        $invoice_payment_amount_total = 0;
        foreach ($mainlist as $key => $val) {
            $invoice_payment_amount_total += $val->invoice_payment_amount;            
            $export_list[] = array(
                getDateFormat($val->invoice_payment_date),
                $val->payment_history_name,                
                $val->invoice_name,
                $val->payment_type_name,
                $val->invoice_payment_amount,
                $val->invoice_payment_details               
            );
        }
    
        $export        = array();
        $export_column = array(            
            'Payment Date',
            'Payment #',
            'Invoice #',
            'Payment Type',
            'Total Received',         
            'Remarks'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        $export[] = array(
            '',
            '',
            '',
            '',
            $invoice_payment_amount_total,
            ''
        );
        $this->Common_model->generateExcel($export,'Payment History List ' . date('d-m-Y_H:i:s'));
       
    }
    
    function cancel_invoice(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data = $this->input->post();
            $u_data['invoice_payment_status'] = 2;
            $u_data['cancelled_reason'] = $data['cancelled_reason'];
            $u_data['cancelled_date_time'] = date('Y-m-d H:i:s');
            //debug($u_data); exit;

            $res_invoice_items = $this->Common_model->getDetails('invoice_particulars','ref_invoice_id',$data['ref_invoice_id']);
            //debug($res_invoice_items);
            //exit;
            if(isset($res_invoice_items) && !empty($res_invoice_items)){
                foreach ($res_invoice_items as $key => $val) {
                    $qty = $val->qty;
                    $res1 = $this->Invoice_model->update_product_quantity($val->ref_product_id,$qty,'add');
                    $res2 = $this->Invoice_model->update_product_batch_quantity($val->ref_product_batch_id,$qty,'add');
                }
            }else{
                $res1 = 1;
                $res2 = 1;
            }

            $res = $this->Common_model->updateRecord('invoice',$u_data,$data['ref_invoice_id']);
            
            if($res && $res1 && $res2){
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('cancel_invoice_add',$res); 
                $_SESSION['success_msg'] = 'Invoice successfully cancelled ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('invoice');
        } 
    }
    
    function generate_invoice_pdf($id){
        $data['invoice'] = $this->Common_model->getDetails('invoice','invoice_id',$id);
        $data['invoice_particulars'] = $this->Common_model->getDetails('invoice_particulars','ref_invoice_id',$data['invoice'][0]->invoice_id);
        
        if($data['invoice'][0]->ref_customer_id){
            $data['customer'] = $this->Common_model->getDetails('customer','customer_id',$data['invoice'][0]->ref_customer_id);
        }else{
            $data['patient'] = $this->Common_model->getDetails('patient','patient_id',$data['invoice'][0]->ref_patient_id);
        }
                
       //debug($data);
        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/invoice_tmp', $data);
        $header_html = $this->parser->parse('template/pdf/pdf_header',$data);
       // $footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $footer_html = '';
        //exit;
        $f_name = 'uploads/invoice/'.str_replace('/','_',$data['invoice'][0]->invoice_no).'_'.time().'.pdf';
        $file_name = FCPATH.$f_name;
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','F');
       // exit;
        return $f_name;
    }



     function export_invoice_excel()
    {      
        $this->hasPermission('invoice_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'invoice_id';
        $data['order'] = 'ASC';
        $table['tbl_main']           = 'invoice';
        $mainlist      = $this->Common_model->getList($table, $data, $filter_data);
        // debug($data);
        // debug($mainlist); exit;
        $gst_5_total = 0;
        $gst_12_total = 0;
        $gst_18_total = 0;
        $gst_total = 0;
        $grand_total = 0;
        $discount_total = 0;
        $sub_total = 0;
        $product_comm_total = 0;
        $doctor_fees_total = 0;
        foreach ($mainlist as $key => $val) {
             $gst_total += $val->gst_total;
             $gst_5_total += $val->gst_5_total;
             $gst_12_total += $val->gst_12_total;
             $gst_18_total += $val->gst_18_total;
            $grand_total += $val->grand_total;
            $discount_total += $val->discount_total;
            $doctor_fees_total += $val->p_and_f_total;
            $sub_total += $val->sub_total - $val->gst_total;
            $res_customer = $this->Common_model->getDetails('patient','patient_id',$val->ref_patient_id);
            $pay_status = 'Pending';
            if($val->invoice_payment_status)
                $pay_status = 'Paid';

            $res_doctor_comm = $this->Common_model->getDetails('accounts_transaction','ref_invoice_id',$val->invoice_id);
            $product_comm_total += $res_doctor_comm[0]->accounts_transaction_credit;
           // debug($res_doctor_comm);
            $name = $val->customer_name;
            $gst_data=$this->Invoice_model->get_gst_based_invoice($val->invoice_id,5);
            $sub_total_gst_5=0;
            $gst_amount_5=0;
            foreach($gst_data as $gt)
            {
                $sub_total_gst_5=$gt->sub_total;
                $gst_amount_5=$gt->gst_val;
            }
            $gst_data=$this->Invoice_model->get_gst_based_invoice($val->invoice_id,12);
            $sub_total_gst_12=0;
            $gst_amount_12=0;
            foreach($gst_data as $gt)
            {
                $sub_total_gst_12=$gt->sub_total;
                $gst_amount_12=$gt->gst_val;
            }
            $gst_data=$this->Invoice_model->get_gst_based_invoice($val->invoice_id,18);
           
            $sub_total_gst_18=0;
            $gst_amount_18=0;
            foreach($gst_data as $gt)
            {
                $sub_total_gst_18=$gt->sub_total;
                $gst_amount_18=$gt->gst_val;
            }
            if(!empty($val->patient_name))
                $name = $val->patient_name;
                $export_list[] = array(
                    $val->invoice_name,
                    getDateFormat($val->invoice_date),
                    $name,
                    ($val->sub_total - $val->gst_total),
                    $val->discount_total,
                    $val->gst_total,
                    $sub_total_gst_5,
                    $gst_amount_5,
                    $gst_amount_5,
                    $sub_total_gst_12,
                    $gst_amount_12,
                    $gst_amount_12,
                    $sub_total_gst_18,
                    $gst_amount_18,
                    $gst_amount_18,
                    $val->p_and_f_total,
                    $val->grand_total,         
                    $pay_status,
                    $res_customer[0]->gst_no,
                    $res_doctor_comm[0]->accounts_transaction_credit
                );
            }
    
        $export        = array();
        $export_column = array(
            'Invoice #',
            'Invoice Date',
            'Patient Name',
            'Sub Total',         
            'Discount',
            'GST',
            'Base Amount GST 5%',
            'SGST 2.5%',
            'CGST 2.5%',
            'Base Amount GST 12%',
            'SGST 6%',
            'CGST 6%',
            'Base Amount GST 18%',
            'SGST 9%',
            'CGST 9%',
            'Doctor Fees',
            'Grand Total',
            'Payment Status',
            'GST No',
            'Product Commission'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        $export[] = array(
            '',
            '',
            '',
            $sub_total,  
            $disc_total,
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $doctor_fees_total,
            $grand_total,
            '',
            '',
            $product_comm_total
        );
        $this->Common_model->generateExcel($export,'Invoice_List_' . date('d-m-Y_H:i:s'));
       
    }

    function print_invoice_return($id,$type=''){
        $data['invoice'] = $this->Common_model->getDetails('invoice_return','invoice_return_id',$id);
        $data['invoice_particulars'] = $this->Common_model->getDetails('invoice_return_particulars','ref_invoice_return_id',$data['invoice'][0]->invoice_return_id);
       
        if($data['invoice'][0]->ref_customer_id){
            $data['customer'] = $this->Common_model->getDetails('customer','customer_id',$data['invoice'][0]->ref_customer_id);
        }else{
            $data['patient'] = $this->Common_model->getDetails('patient','patient_id',$data['invoice'][0]->ref_patient_id);
        }
        $data['type'] = $type;
        $data['branch_address']=$this->Common_model->getDetails('branch','branch_id',$data['invoice'][0]->ref_branch_id);
        
        $this->load->library('parser');
       echo  $html = $this->parser->parse('template/pdf/print_return_invoice_tmp', $data);
        exit;
       // echo $html;
        /*$f_name = 'uploads/invoice/'.str_replace('/','_',$data['invoice'][0]->invoice_no).'_'.time().'.pdf';
        $file_name = FCPATH.$f_name;
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','F');*/
        
       // return $f_name;
    }

    
    
    function add_patient(){
        $where = '';
        $table = 'patient';
        
        $patient_name = $_REQUEST['patient_name'];
        //$category_field = $_REQUEST['category_field'];
        $data = $this->input->post();
        $data['patient_code'] = $this->Common_model->get_patient_code();
        $where .= "patient_name = '".$patient_name."'";
         
        // $res_patient = $this->Common_model->getRecords( $table,$where);
         $res = array();
        /* if($res_patient >= 1){
            echo 'exist'; exit;
         }else{*/
             $main_data = array();
             
             $main_data['patient_name'] = $patient_name;
             $last_id = $this->Common_model->addRecord( $table ,$data);
             
             $res_data = $this->Common_model->getDetails('patient', 'delete_status', '0', 'patient_name', 'ASC');
            
            if (isset($res_data) && !empty($res_data)) {
                foreach ($res_data as $key => $val) {
                    $res[] = array(
                        'id' => $val->patient_id,
                        'name' => $val->patient_name
                    );
                }
            }

         //}

         echo json_encode($res);
        exit;
         
         exit;
    }

    function add_customer(){
        $where = '';
        $table = 'customer';
        //$customer_name = $_REQUEST['customer_name'];

        $data = $this->input->post();
		
        $res = array();
        // $main_data = array();
        // $main_data['customer_name'] = $customer_name;
		$get_data = $this->Invoice_model->get_customer_last_data();
		$prev_id = $get_data[0]->customer_id + 1;
		
        $last_id = $this->Common_model->addRecord( $table ,$data);
        
        $res_data = $this->Common_model->getDetails('customer', 'delete_status', '0', 'customer_name', 'ASC');
        
        if (isset($res_data) && !empty($res_data)) {
            foreach ($res_data as $key => $val) {
                $res[] = array(
                    'id' => $val->customer_id,
                    'name' => $val->customer_name,
                    'prev_id' => $prev_id,
                );
            }
        }
		
        echo json_encode($res);
        exit;
    }


    function update_gst(){
        $res_data = $this->Common_model->getDetails('invoice', 'delete_status', '0','invoice_id','ASC');
        //debug($res_data); exit;
        foreach ($res_data as $key => $value) {
            if($value->gst_5_total == 0.00 && $value->gst_12_total == 0.00 && $value->gst_18_total == 0.00){
           
            $u_data = array();
            $res = $this->Invoice_model->get_gst_total($value->invoice_id);
            if(isset($res) && !empty($res)){
                // debug($value->invoice_id);
                foreach ($res as $k => $val) {
                    if($val->gst_perc == 5.00){
                        $u_data['gst_5_total'] = $val->gst_total;
                    }
                    if($val->gst_perc == 12.00){
                        $u_data['gst_12_total'] = $val->gst_total;
                    }
                    if($val->gst_perc == 18.00){
                        $u_data['gst_18_total'] = $val->gst_total;
                    }
                }
                //debug($u_data); exit;
                $this->Common_model->updateRecord('invoice',$u_data,$value->invoice_id);
                //echo $this->db->last_query();
                //exit;
            }
        }
        }

    }


}
?>
