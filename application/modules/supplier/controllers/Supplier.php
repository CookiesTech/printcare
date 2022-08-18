<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Supplier_model'
        ));
        $this->load->helper(array(
            'form'
        ));
       // $this->load->library("Pdf");
        $session_data       = $this->session->userdata( SESSION_LOGIN . 'logged_in' );
        $data['username']   = $session_data['username'];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        if (empty($data['permission'])) {
            redirect('home');
        }
        $data['designation']         = $this->Common_model->getDropdownList('designation');
        $data['user']            = $this->Common_model->getDropdownList('user');
        
        $data['title'] = 'Suppliers';
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
        $this->hasPermission('supplier_view');
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
            $sort = 'supplier_id';
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

        $table['tbl_main']           = 'supplier';
        $table['tbl_mobile']         = 'supplier_contact_numbers';
        $table['tbl_email']          = 'supplier_email_ids';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data,'supplier_id');
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data,'supplier_id');
		
		
		$data['tablefields1']      = $this->Common_model->getTableFields('supplier');
        $data['tablefields2']      = $this->Common_model->getTableFields('supplier_contact_numbers');
        $data['tablefields3']      = $this->Common_model->getTableFields('supplier_email_ids');
        $data['tablefields']       = array_merge($data['tablefields1'], $data['tablefields2'], $data['tablefields3']);
        		  
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'supplier/getlist/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        
        $this->load->view('common/menu');
        $this->load->view('supplier/supplier_list_view', $data);
        $this->load->view('common/footer');
    }
    
    function getForm()
    {
$data['category']             = $this->Master_model->getCategoryList('business_category');
$data['designation']          = $this->Common_model->getDropdownList('designation');

$data['contact_number_block'] = $this->parser->parse('common/supplier_contact_number_block',$data, true);
$data['contact_email_block']  = $this->parser->parse('common/supplier_contact_email_block',$data, true);
        
        $data['action'] = site_url('supplier/add');
        $this->load->view('common/menu');
        $this->load->view('supplier/supplier_form_view', $data);
        $this->load->view('common/footer');
    }
    function add()
    {
        $this->hasPermission('supplier_add');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Begin Transaction
			$this->Common_model->TxnBegin();
            $data = $this->input->post();
            
            $res_code = $this->Supplier_model->generate_supplier_code();
            $data['supplier_no'] = $res_code['supplier_no'];
            $data['supplier_code'] = $res_code['supplier_code'];
			
			if(isset($_FILES['supplier_pan_file']['name']) && !empty($_FILES['supplier_pan_file']['name'])){
				$data['supplier_pan_file'] = $this->Common_model->upload_file($_FILES['supplier_pan_file']['name'],$_FILES['supplier_pan_file']['tmp_name'],'pan');
			}
			
			if(isset($_FILES['supplier_gst_file']['name']) && !empty($_FILES['supplier_gst_file']['name'])){
				$data['supplier_gst_file'] = $this->Common_model->upload_file($_FILES['supplier_gst_file']['name'],$_FILES['supplier_gst_file']['tmp_name'],'gst');
			}
			
			$res = $this->Common_model->addRecord('supplier', $data);
			if($res){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('supplier_add',$res); // Record User Activity
                $_SESSION['success_msg'] = 'Supplier successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           redirect('supplier');           
        } else {
            $this->getForm();
        }
    }
    function view()
    {
        $this->hasPermission('supplier_view');
        $id                      = $this->uri->segment(3);
        $data['supplier']         = $this->Common_model->getDetails('supplier', 'supplier_id', $id);
        $data['supplier_numbers']  = $this->Common_model->getDetails('supplier_contact_numbers', 'ref_supplier_id', $id);
        $data['supplier_emails']  = $this->Common_model->getDetails('supplier_email_ids', 'ref_supplier_id', $id);
        $this->load->view('common/menu');
        $this->load->view('supplier/supplier_details_view', $data);
        $this->load->view('common/footer');
    }
    
     
    function edit()
    {
        $this->hasPermission('supplier_edit');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id  = $this->uri->segment(3);
            // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			
			if(!isset($data['direct_to_customer'])){
				$data['direct_to_customer'] = 0;
			}
			//~ echo '<pre>';
			//~ print_r($data);
			//~ echo '</pre>';
			//~ exit;
			$redirect_to = $data['redirect_to'];
            unset($data['redirect_to']);
            if(isset($_FILES['supplier_pan_file']['name']) && !empty($_FILES['supplier_pan_file']['name'])){
				$data['supplier_pan_file'] = $this->Common_model->upload_file($_FILES['supplier_pan_file']['name'],$_FILES['supplier_pan_file']['tmp_name'],'pan');
			}
			
			if(isset($_FILES['supplier_gst_file']['name']) && !empty($_FILES['supplier_gst_file']['name'])){
				$data['supplier_gst_file'] = $this->Common_model->upload_file($_FILES['supplier_gst_file']['name'],$_FILES['supplier_gst_file']['tmp_name'],'gst');
			}
             $res = $this->Common_model->updateRecord('supplier', $data, $id);
			if($res){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('supplier_edit', $res); // Record User Activity
                $_SESSION['success_msg'] = 'Supplier successfully updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
            redirect('supplier');
        } else {
            $id                           = $this->uri->segment(3);
            $data['supplier']              = $this->Common_model->getDetails('supplier', 'supplier_id', $id);
	    
            $data['contact_numbers']      = $this->Common_model->getDetails('supplier_contact_numbers', 'ref_supplier_id', $id);
	   
            $data['email_ids']            = $this->Common_model->getDetails('supplier_email_ids', 'ref_supplier_id', $id);
            
            $data['designation']          = $this->Common_model->getDropdownList('designation');
                    
            $data['contact_number_block'] = $this->parser->parse('common/supplier_contact_number_block', $data, true);
            $data['contact_email_block']  = $this->parser->parse('common/supplier_contact_email_block', $data, true);
            $data['action'] = site_url('supplier/edit/'.$id);
            $this->load->view('common/menu');
            $this->load->view('supplier/supplier_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    function delete()
    {        
        $this->hasPermission('supplier_delete');
        // Begin Transaction
		$this->Common_model->TxnBegin();
		$delete_id = $this->input->post('checkbox'); 
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('supplier', 'supplier_id', $id);
                $this->Common_model->removeRecord('supplier_contact_numbers', 'ref_supplier_id', $id);
				$this->Common_model->removeRecord('supplier_email_ids', 'ref_supplier_id', $id);
            }
        }
        if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('supplier_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = 'Supplier successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}   
        redirect('supplier/getlist/1');
    }
    
    function get_supplier_brokerage_history_list()
    {
        $this->hasPermission('supplier_view');
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
            $sort = 'supplier_brokerage_history_id';
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
        $table['tbl_main']         = 'supplier_brokerage_history';
        $data['mainlist_count']    = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']          = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        $data['tablefields']       = $this->Common_model->getTableFields('supplier_brokerage_history');
        $data['operations']        = $this->Common_model->getFilterOperation();
        $data['init_listing_page'] = 'supplier/get_supplier_brokerage_history_list/';
        $data['listing_page']      = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $this->load->view('common/menu');
        $this->load->view('supplier/supplier_brokerage_history_list_view', $data);
        $this->load->view('common/footer');
    }
    
    
    function export_supplier_excel()
    {
      
        $this->hasPermission('supplier_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'supplier_id';
        $data['order'] = 'ASC';
        $table['tbl_main']           = 'supplier';
        $table['tbl_mobile']         = 'supplier_contact_numbers';
        $table['tbl_email']          = 'supplier_email_ids';
        $mainlist      = $this->Common_model->getList($table, $data, $filter_data,'supplier_id');
	
        foreach ($mainlist as $key => $val) {

		$con_num = '';
		$con_per = '';
		$con_desg = '';
		$con_type = '';
		$con_pry = '';
		$email_con = '';
		$email_per = '';
		$email_design = '';
		$email_pry = '';
		
    $contact_number = $this->Common_model->getDetails('supplier_contact_numbers','ref_supplier_id',$val->supplier_id);
    $contact_email = $this->Common_model->getDetails('supplier_email_ids','ref_supplier_id',$val->supplier_id);

    $count_number = count($contact_number);
    $count_email = count($contact_email);

    if($count_number>$count_email){
	$max_count = $count_number;
    }
    else{
	$max_count = $count_email;
    }
	    //~ echo '<pre>';
	    //~ print_r($max_count);
	    //~ exit;
	for($i=0; $i<$max_count; $i++){

		$con_per = $contact_number[$i]->contact_person;
		$con_desg = $contact_number[0]->designation_name;
		$con_type = $contact_number[$i]->contact_number_type_name;
		$con_num = $contact_number[$i]->contact_number;
		$con_pry = $contact_number[$i]->primary_contact;
		if($con_pry==1){$con_pry = 'Primay';}else{$con_pry = '';}
		$email_per = $contact_email[$i]->contact_person;
		$email_con = $contact_email[$i]->email_id;
		$email_design = $contact_email[$i]->designation_name;
		$email_pry = $contact_email[$i]->primary_contact;
		if($email_pry==1){$email_pry = 'Primay';}else{$email_pry = '';
		    }

	    
            $export_list[] = array(
				$val->supplier_name,
				$val->supplier_from_date,
				$val->supplier_address_line1,
				$val->supplier_address_line2,
				$val->supplier_address_line3,
				$val->district_name,
				$val->supplier_pincode,
				$val->state_name,
				$val->country_name,				
				$val->supplier_description,
				$con_per,
				$con_desg,
				$con_type,
				$con_num,
				$con_pry,
				$email_per,
				$email_con,
				$email_design,
				$email_pry
            );

	    for($i=1; $i<$max_count; $i++){

		$con_per = $contact_number[$i]->contact_person;
		$con_desg = $contact_number[0]->designation_name;
		$con_type = $contact_number[$i]->contact_number_type_name;
		$con_num = $contact_number[$i]->contact_number;
		$con_pry = $contact_number[$i]->primary_contact;
		if($con_pry==1){$con_pry = 'Primay';}else{$con_pry = '';}
		$email_per = $contact_email[$i]->contact_person;
		$email_con = $contact_email[$i]->email_id;
		$email_design = $contact_email[$i]->designation_name;
		$email_pry = $contact_email[$i]->primary_contact;
		if($email_pry==1){$email_pry = 'Primay';}else{$email_pry = '';
		    }

	    
            $export_list[] = array(
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
				
				$con_per,
				$con_desg,
				$con_type,
				$con_num,
				$con_pry,
				$email_per,
				$email_con,
				$email_design,
				$email_pry
            );
        }
    }
    }
        $export        = array();
        $export_column = array(
			'Agent Name',
			'Agent From Date',
			'Address line 1',
			'Address line 2',
			'Address line 3',
			'District',
			'Pincode',
			'State',			
			'Country',
			'Contact Person',
			'Description',
			'Designation',
			'Type',
			'Mobile NO',
			'Primary Contact',
			'Contact Person',
			'Email',
			'Designation',
			'Primary Contact'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export,'Agent_List_' . date('d-m-Y_H:i:s'));
        
        
       
    }
    
   
    public function export_supplier_pdf()
    {
       $this->hasPermission('supplier_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'supplier_id';
        $data['order']    = 'ASC';
        $table['tbl_main']  = 'supplier';
        $table['tbl_mobile']         = 'supplier_contact_numbers';
        $table['tbl_email']          = 'supplier_email_ids';
        $mainlist = $this->Common_model->getList($table, $data, $filter_data,'supplier_id');
        
        $data['title'] = 'Supplier List';
        
       // Row Header
        $data['row_header'] = array();
        $data['row_header'][] = array(
			'name'		=> 'S No',
			'width'		=> '7%',
			'align'		=> 'center'
        );
        
        $data['row_header'][] = array(
			'name'		=> 'Supplier Name',
			'width'		=> '40%',
			'align'		=> 'left'
        );
        
        $data['row_header'][] = array(
			'name'		=> 'Code',
			'width'		=> '8%',
			'align'		=> 'left'
        );
        
        
         $data['row_header'][] = array(
			'name'		=> 'District',
			'width'		=> '12%',
			'align'		=> 'left'
        );
        
        
        $data['row_header'][] = array(
			'name'		=> 'Mobile',
			'width'		=> '10%',
			'align'		=> 'left'
        );
        
        $data['row_header'][] = array(
			'name'		=> 'Email',
			'width'		=> '18%',
			'align'		=> 'left'
        );
               
        // Row Data
        $data['row_data'] = array();
        if(isset($mainlist) && !empty($mainlist)){
			$i = 1;
	    foreach($mainlist as $key => $val){
			$address = array();
			$contact_number = $this->Common_model->getDetails('supplier_contact_numbers','ref_supplier_id',$val->supplier_id);
			$contact_email = $this->Common_model->getDetails('supplier_email_ids','ref_supplier_id',$val->supplier_id);
			$address_final = implode('<br>',$address);
				
				 $data['row_data'][] = array(
					$i,
					$val->supplier_name,					
					$val->supplier_code,
					$val->district_name,					
					$contact_number[0]->contact_number,
					$contact_email[0]->email_id
				);
			  $i++;
			}
				
		}
       
         
/*
        echo '<pre>';
        print_r($data['row_data']);
        echo '</pre>';
*/
       // exit;
        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
	$header_html = $this->parser->parse('template/pdf/pdf_header',$data);
	$footer_html = $this->parser->parse('template/pdf/pdf_footer',$data);
        $file_name = 'supplier_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html,$footer_html,$html,$file_name,'P','I');
        
    }
   
   
   function import_product(){
	 //~ if($this->input->server('REQUEST_METHOD') == 'POST') {

		$data         = $this->input->post();
		$ref_user_id = $_POST['ref_user_id'];
		//$user_result = $this->Client_model->delete_old_record_for_user($ref_user_id);
		$tot_ins = 0;
            //$data['file'] = $_FILES['client_file'];
           // if (isset($_FILES['client_file'])) {
                $file                         = FCPATH.'product.csv';
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
					$ref_quantity_type_id = 1;	
					//~ echo '<pre>';
					//~ print_r($filesop);
					//~ echo '</pre>';	
					$where = 'product_quality.product_quality_name1 = "'.str_replace(" ","",$filesop[2]).'" AND product_quality.ref_supplier_id = "'.$filesop[4].'"';
					
					$res_quality = $this->Common_model->getRecords('product_quality',$where);
					if(isset($res_quality) && !empty($res_quality)){
						$ref_product_quality_id = $res_quality[0]->product_quality_id;	
					}
					
					echo $where = 'product_quality_size.product_quality_size_name1 = "'.str_replace(" ","",$filesop[3]).'" AND product_quality_size.ref_supplier_id = "'.$filesop[4].'"';
					echo '<br>';
					$res_size = $this->Common_model->getRecords('product_quality_size',$where);
					if(isset($res_size) && !empty($res_size)){
						$ref_product_quality_size_id = $res_size[0]->product_quality_size_id;	
					}						
             					
					$product_data['product_name'] = trim($filesop[0]);
					$product_data['hsn_sac'] = trim($filesop[1]);
					$product_data['ref_supplier_id'] = $ref_supplier_id;
					$product_data['ref_product_quality_id'] = $ref_product_quality_id;
					$product_data['ref_product_quality_size_id'] = $ref_product_quality_size_id;
					$product_data['ref_quantity_type_id'] = $ref_quantity_type_id;
					//~ echo '<pre>';
					//~ print_r($product_data);
					//~ echo '</pre>';	
					
					echo $res = $this->Common_model->addRecord('product',$product_data);
					$tot_ins++;
						
                }
            //}
                       
            			
            $_SESSION['success_msg'] = 'Cusotomer Outstanding successfully Imported ( '.$tot_ins.' Records )...';
           exit;
            
          //  redirect('client/import_client_outstanding');
		  //~ }else{
			//~ $data['user'] = $this->Common_model->getDetails('user','ref_user_group_id','4','full_name','ASC'); 
			//~ $this->load->view('common/menu');
			//~ $this->load->view('client/import_client_outstanding_form_view', $data);
			//~ $this->load->view('common/footer');
	    //~ }
    }
    
    
}
?>
