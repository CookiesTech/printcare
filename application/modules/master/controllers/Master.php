<?php
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
class Master extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model( array( 'Master_model') );
        $session_data       = $this->session->userdata( 'logged_in' );
        $data[ 'username' ] = $session_data[ 'username' ];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
		if(empty($data['permission'])){
			redirect( 'home');	
		}
        $data[ 'title' ] = 'Master';
        $data['menu']   = $this->Master_model->getMenu();
        $this->load->view( 'common/header', $data );	
        
    }
    function hasPermission( $page ) {
        $res_permission = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        if($res_permission && !empty($res_permission)){
			if ( !in_array( $page, $res_permission ) ) {
				redirect( 'access_denied', 'refresh' );
			}
		}else{
			redirect( 'home');
		}
    }
    
    function index() {
			$this->hasPermission( 'master_view' );
			
			//print_r($data['menu']);
			$this->load->view( 'master/master_menu',$data );		
    }
    
    function getlist($url_data) {
			$this->hasPermission( 'master_view' );
			$url_data = $this->uri->segment( 3 );
			$res_data    = $this->Common_model->getDetails('menu','menu_alias_name',$url_data);
			$table_name    = $res_data[0]->menu_table_name;
			$display_name    = $res_data[0]->menu_alias_name;
			
			$filter_data ='';
			if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
				 $filter_data = $this->input->post();
				 $reset_data = $this->input->post('reset');
				 if(isset($reset_data)){
					$this->session->unset_userdata( 'filter_data' );
				 }else{
					$this->session->set_userdata( 'filter_data', $filter_data );
				 }
			}else{
				$session_filter_data = $this->session->userdata('filter_data');
				if(isset($session_filter_data)){
					$filter_data = $session_filter_data;
				}else{
					
					$filter_data ='';
				}
			}
			
			$data = array();
			$segment_3 = $this->uri->segment( 4 );
			$segment_4 = $this->uri->segment( 5 );
			$segment_5 = $this->uri->segment( 6 );			
			
			if(!isset($segment_3) && $this->input->server( 'REQUEST_METHOD' ) != 'POST'){
				$this->session->unset_userdata( 'filter_data' );
				$filter_data ='';
			}
			if(isset($segment_3)){
				$page = $segment_3;
			}else{
				$page = '1';
			}
			
			if(isset($segment_4)){
				$sort = $segment_4;
			}else{
				if($table_name == 'designation'){
					$sort = 'designation_name';	
				}else if($table_name == 'advt_edition'){
					$sort = 'advt_provider_name';	
				}elseif($table_name == 'page_no'){
					$sort = 'advt_issue_type_name';	
				}else{
					$sort = $table_name.'_id';
				}				
			}
			
			if(isset($segment_5)){
				$order = $segment_5;
			}else{
				if($table_name == 'designation'){
					$order = 'ASC';
				}else{
					$order = 'DESC';
				}
			}
						
			$start = (($page-1)*RPP);
			$data['start'] = $start;
			$data['sort'] = $sort;
			$data['order'] = $order;
			$table = array();
			$table['tbl_main'] = $table_name;
			
			$data[ 'mainlist_count' ] = $this->Common_model->getListCount($table,$filter_data);
			$data[ 'mainlist' ] = $this->Common_model->getList($table,$data,$filter_data);			
			$data[ 'tablefields' ] = $this->Common_model->getTableFields($table_name);
			$data[ 'column' ] = $this->Common_model->getTableColumn($table_name);			
			
			$data[ 'init_listing_page' ] = 'master/getlist/'.$url_data.'/'; 
			$data[ 'listing_page' ] = $data[ 'init_listing_page' ].$page.'/';
			$data['page_data'] = $url_data;
			$data['table'] = $table_name;
			$data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
			
			$this->load->view( 'common/menu' );
			$this->load->view( 'master/master_list_view', $data);
			$this->load->view( 'common/footer' );		
    }
    
    function add($url_data) {
		  $this->hasPermission( 'master_add' );
		  $url_data = $this->uri->segment( 3 );
			$res_data    = $this->Common_model->getDetails('menu','menu_alias_name',$url_data);
			$table_name    = $res_data[0]->menu_table_name;
			$display_name    = $res_data[0]->menu_alias_name;
			
			$data['table'] = $table_name;
			$data['page_data'] = $url_data;
			
		if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
			$this->Common_model->TxnBegin();
			$res = $this->Master_model->addRecord($table_name, $this->input->post() );
			if($res){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('master_add',$res); // Record User Activity
				$_SESSION['success_msg'] = $url_data.' successfully added ...';
			}else{
				$this->Common_model->TxnRollBack();
				$_SESSION['error_msg'] = 'Error occurred please try again...';
			}
			
			redirect( 'master/getlist/'.$url_data);
            
        } else {
			
            $this->getForm($table_name,$data);
        }
    }
     function view($url_data){
		$this->hasPermission( 'master_view' );
		$id       = $this->uri->segment( 4 );
		$url_data = $this->uri->segment( 3 );
		$res_data = $this->Master_model->getTable($url_data);
		$table_name = $res_data[0]->name;
		$data[ 'tablefields' ] = $this->Common_model->getTableFields($table_name);
		$data[ 'column' ] = $this->Common_model->getTableColumn($table_name);
        $data['result'] = $this->Common_model->getDetails( $table_name, $table_name.'_id',$id );
        //print_r($data['result']);
		//$this->load->view( 'master/master_menu' );
		$this->load->view( 'common/menu' );
		$this->load->view( 'master/master_details_view', $data );
		$this->load->view( 'common/footer' );
	}
	
	function edit($url_data) {
       $this->hasPermission( 'master_edit' );
        $this->hasPermission( 'master_add' );
		$url_data = $this->uri->segment( 3 );
		$data['page_data'] = $url_data;
		
		$res_data    = $this->Common_model->getDetails('menu','menu_alias_name',$url_data);
		$table_name    = $res_data[0]->menu_table_name;
		$display_name    = $res_data[0]->menu_alias_name;
		
		$data['table'] = $table_name;		
		$id_field = $table_name.'_id'; 
		$name_field = $table_name.'_name'; 
        if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
            $id  = $this->uri->segment( 4 );
			$data = $this->input->post();
			$this->Common_model->TxnBegin();
			if($table_name == 'advt_edition'){
				$where = "ref_advt_provider_id = '".$data['ref_advt_provider_id']."' AND ".$name_field." = '".trim($data[$name_field])."' AND ".$id_field." != '".$id."'";
				$res_data = $this->Common_model->getRecords($table_name ,$where);		
			}
			//~ elseif($table_name == 'designation' ){
				//~ $where = "ref_department_id = '".$_POST['ref_department_id']."' AND ".$name_field." = '".trim($data[$name_field])."'";
				//~ $res_data = $this->Common_model->getRecords($table_name ,$where);
			//~ }
		
			elseif($table_name == 'page_no' ){
				$where = "ref_advt_issue_type_id = '".$data['ref_advt_issue_type_id']."' AND ".$name_field." = '".trim($data[$name_field])."' AND ".$id_field." != '".$id."'";
				$res_data = $this->Common_model->getRecords($table_name ,$where);
			}else{
				$form_input = trim($data[$name_field]); 
				$where = "$id_field != ".$id." AND $name_field = '".$form_input."'";
				$res_data = $this->Common_model->getRecords($table_name,$where);
			}
		
			
			if(isset($res_data) && !empty($res_data)){
				$this->Common_model->TxnRollBack();
				$_SESSION['error_msg'] = 'The Value Already exist..!';
			}else{
				$res = $this->Master_model->update($table_name, $data, $id );
				if($res){
					$this->Common_model->TxnCommit();
					$this->Common_model->addUserActivity('master_edit',$res); // Record User Activity
					$_SESSION['success_msg'] = $url_data.' successfully updated ...';
				}else{
					$this->Common_model->TxnRollBack();
					$_SESSION['error_msg'] = 'Error occurred please try again...';
				}
			}
			
            redirect( 'master/getlist/'.$url_data);
        } else {
			
			if($table_name == 'business_sub_category'){
				$data[ 'business_category' ] = $this->Common_model->getDropdownList('business_category');
			}
			if($table_name == 'area'){
				$data[ 'country' ] = $this->Common_model->getDropdownList('country');
				$data[ 'state' ] = $this->Common_model->getDropdownList('state');
				$data[ 'district' ] = $this->Common_model->getDropdownList('district');
			}
			if($table_name == 'accounts_code'){
				$data[ 'accounts_transaction_category' ] = $this->Common_model->getDropdownList('accounts_transaction_category');
			}
			if($table_name == 'district'){
				$data[ 'country' ] = $this->Common_model->getDropdownList('country');
				$data[ 'state' ] = $this->Common_model->getDropdownList('state');
			}
			if($table_name == 'state'){
				$data[ 'country' ] = $this->Common_model->getDropdownList('country');
			}
			
            $id       = $this->uri->segment( 4 );
            
            $data[ 'result' ] = $this->Common_model->getDetails( $table_name, $table_name.'_id', $id );
           
            $data['table_name'] = $table_name;
            $this->load->view( 'common/menu' );
            $this->load->view( 'master/master_edit_view', $data );
            $this->load->view( 'common/footer' );
        }
    }
    
	
		
     function delete($url_data) {
		 $this->hasPermission( 'master_delete' );
		 $this->Common_model->TxnBegin();
		 $data['page_data'] = $url_data;
		 $url_data = $this->uri->segment( 3 );
		 $res_data    = $this->Common_model->getDetails('menu','menu_alias_name',$url_data);
		 $table_name    = $res_data[0]->menu_table_name;
		 $display_name    = $res_data[0]->menu_alias_name;
		
		
		 //$res_data = $this->Master_model->getTable($url_data);
		 //$table_name = $res_data[0]->name;
         //$id = $this->uri->segment( 4 );
         $delete_id = $this->input->post('checkbox'); 
         if(!empty($delete_id)){
			  foreach($delete_id as $key => $id){
				 $res = $this->Master_model->removeRecord( $table_name,$table_name.'_id',$id );
			 }	
		 }
		 if($res){
			$this->Common_model->TxnCommit();
			$this->Common_model->addUserActivity('master_delete',$res); // Record User Activity
			$_SESSION['success_msg'] = $url_data. ' successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		}
		
        redirect( 'master/getlist/'.$url_data);
     }

    function getForm($table_name,$data) {

		
			
		if($table_name == 'business_sub_category'){
			$data[ 'business_category' ] = $this->Common_model->getDropdownList('business_category');
		}
		
		if($table_name == 'area'){
			$data[ 'country' ] = $this->Common_model->getDropdownList('country');
			$data[ 'state' ] = $this->Common_model->getDropdownList('state');
			$data[ 'district' ] = $this->Common_model->getDropdownList('district');
		}
		
		if($table_name == 'district'){
			$data[ 'country' ] = $this->Common_model->getDropdownList('country');
			$data[ 'state' ] = $this->Common_model->getDropdownList('state');
		}
		if($table_name == 'accounts_code'){
			$data[ 'accounts_transaction_category' ] = $this->Common_model->getDropdownList('accounts_transaction_category');
		}
		
		if($table_name == 'state'){
			$data[ 'country' ] = $this->Common_model->getDropdownList('country');
		}
		if($table_name == 'product'){

		$data[ 'supplier' ] = $this->Common_model->getDropdownList('supplier');
		$data[ 'product_quality' ] = $this->Common_model->getDropdownList('product_quality');
		
		$data[ 'product_quality_size' ] = $this->Common_model->getDropdownList('product_quality_size');
		}
		$data['table_name'] = $table_name;

        //$this->load->view( 'master/master_menu' );
        $this->load->view( 'common/menu' );
        $this->load->view( 'master/master_form_view', $data);
        $this->load->view( 'common/footer' );
		
	}
	
	function getType(){
		
		$id = $_REQUEST['id'];
		$json =array();
		if($id == '1'){
			$res = $this->Common_model->getDropdownList('domain_type');
			
			if(!empty($res)){
				foreach($res as $type){
					$json[] = array(
						'id' => $type->domain_type_id,
						'name' => $type->domain_type_name
					);
				}
			}
		}
		
		if($id == '2'){
			$res = $this->Common_model->getDropdownList('server_type');
			
			if(!empty($res)){
				foreach($res as $type){
					$json[] = array(
						'id' => $type->server_type_id,
						'name' => $type->server_type_name
					);
				}
			}
		}
		
		 echo json_encode($json);
		 exit;
	}
	
	
	function checkDuplication()
    {	
		if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
				if(isset($_REQUEST['cat_id']) && !empty($_REQUEST['cat_id'])){
					$where = "ref_division_id = '".$_REQUEST['cat_id']."' AND category_name = '".$_REQUEST['name']."' AND category_id != '".$_REQUEST['id']."' ";
					$res_data = $this->Common_model->getRecords('category',$where);
				}else{
					$table_name = $_REQUEST['alias'];
					$name = $table_name.'_name';
					$id = $table_name.'_id';
					$where =  " $name = '".$_REQUEST['name']."' AND $id != '".$_REQUEST['id']."' ";
					$res_data = $this->Common_model->getRecords($table_name,$where);
				}
		
		}else{
		
			if(isset($_REQUEST['cat_id']) && !empty($_REQUEST['cat_id'])){
				$where = "ref_division_id = '".$_REQUEST['cat_id']."' AND category_name = '".$_REQUEST['name']."' ";
				$res_data = $this->Common_model->getRecords('category',$where);
			}else{
				$table_name = $_REQUEST['alias'];
				$res_data = $this->Common_model->getDetails($table_name,$table_name.'_name',$_REQUEST['name']);
			}
		}
		
		$json ='';
		if(!empty($res_data)){
			$json = 'exist';
		}else {
			$json = 'not-exist';
		}
			
		 echo json_encode($json);
		 exit;
	}	
	
	function checkSubCategoryDuplication()
    {	
		if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
				
				$where = "ref_category_id = '".$_REQUEST['cat_id']."' AND sub_category_name = '".$_REQUEST['name']."' AND sub_category_id != '".$_REQUEST['id']."' ";
				
				$res_data = $this->Common_model->getRecords('sub_category',$where);
				
		}else{
				$where = "ref_category_id = '".$_REQUEST['cat_id']."' AND sub_category_name = '".$_REQUEST['name']."' ";
				
				$res_data = $this->Common_model->getRecords('sub_category',$where);
			
		}
		$json ='';
		if(!empty($res_data)){
			$json = 'exist';
		}else {
			$json = 'not-exist';
		}
			
		 echo json_encode($json);
		 exit;
	}
	
	
	function Ajaxadd()
    {		
		
		$table_name = trim($_POST['table_name']);
		$id_field = $table_name.'_id'; 
		//if($table_name != 'policy_brokerage'){
			$name_field = $table_name.'_name'; 
		//}
		unset($_POST['table_name']);
		if($table_name == 'advt_edition'){
			$where = "ref_advt_provider_id = '".$_POST['ref_advt_provider_id']."' AND ".$name_field." = '".trim($_POST[$name_field])."'";
			$res_data = $this->Common_model->getRecords($table_name ,$where);		
		}
		elseif($table_name == 'page_no' ){
			$where = "ref_advt_issue_type_id = '".$_POST['ref_advt_issue_type_id']."' AND ".$name_field." = '".trim($_POST[$name_field])."'";
			$res_data = $this->Common_model->getRecords($table_name ,$where);
		}
		//~ elseif($table_name == 'designation' ){
			//~ $where = "ref_department_id = '".$_POST['ref_department_id']."' AND ".$name_field." = '".trim($_POST[$name_field])."'";
			//~ $res_data = $this->Common_model->getRecords($table_name ,$where);
		//~ }
		elseif($table_name == 'product_quality' ){
			$where = "product_quality.ref_supplier_id = '".$_POST['ref_supplier_id']."' AND ".$name_field." = '".trim($_POST[$name_field])."'";
			$res_data = $this->Common_model->getRecords($table_name ,$where);
		}
		elseif($table_name == 'product_quality_size' ){
			$where = "product_quality_size.ref_supplier_id = '".$_POST['ref_supplier_id']."' AND ".$name_field." = '".trim($_POST[$name_field])."'";
			$res_data = $this->Common_model->getRecords($table_name ,$where);
		}
		elseif($table_name == 'belt' ){
			$where = "belt.ref_grade_id = '".$_POST['ref_grade_id']."' AND ".$name_field." = '".trim($_POST[$name_field])."'";
			$res_data = $this->Common_model->getRecords($table_name ,$where);
		}
		else{
			$form_input = trim($_POST[$name_field]); 
			$res_data = $this->Common_model->getDetails($table_name,$name_field,$form_input);
		}
		
		$json ='';
		if(!empty($res_data)){
			$json = 'exist';
		}else {
			$res = $this->Master_model->addRecord($table_name, $_POST );
			if($table_name == 'dashboard_block'){
				$this->addBlockToUsers($res);
			}
			if($res){
				$json = 'success';
			}else{
				$json = 'error';
			}
		}
			
		 echo json_encode($json);
		 exit;
	}	
	
	
	function addBlockToUsers($dashboard_block_id){
		$res_user = $this->Common_model->getDetails('user','delete_status','0');
		if(isset($res_user) && !empty($res_user)){
			foreach($res_user as $key => $v){
				$res_blocks = $this->Common_model->getDetails('dashboard_block','dashboard_block_id',$dashboard_block_id);
				if(isset($res_blocks) && !empty($res_blocks)){
					foreach($res_blocks as $key => $val){
						$data = array(
						   'ref_dashboard_block_id' => $dashboard_block_id,
						   'column_width' => $val->column_width,
						   'sort_order' => $val->sort_order,
						   'ref_user_id' => $v->user_id
						);
						$data['added_date'] = date('Y-m-d H:i:s');
						$this->db->insert('user_dashboard_block', $data); 
					}
				}
			}
		}
		return true;
	}

	function get_supplier_quality(){

	    $result = $this->Common_model->getDetails('product_quality', 'ref_supplier_id', $_REQUEST['id']);
	    $result2 = $this->Common_model->getDetails('product_quality_size', 'ref_supplier_id', $_REQUEST['id']);
		$json   = array();
		    if (!empty($result)) {
			foreach ($result as $val) {
			    $json[] = array(
				'id' => $val->product_quality_id,
				'name' => $val->product_quality_name
			    );
			}
		    }
        echo json_encode($json);
        exit;
	}

	function get_supplier_quality_size(){

	    //$result = $this->Common_model->getDetails('product_quality', 'ref_supplier_id', $_REQUEST['id']);
	    $result = $this->Common_model->getDetails('product_quality_size', 'ref_supplier_id', $_REQUEST['id']);
		$json   = array();
		    if (!empty($result)) {
			foreach ($result as $val) {
			    $json[] = array(
				'id' => $val->product_quality_size_id,
				'name' => $val->product_quality_size_name
			    );
			}
		    }
        echo json_encode($json);
        exit;
	}

	function get_product_list(){
		$where = "product.ref_supplier_id = '".$_REQUEST['id']."'";
		$group_by = "product.product_name";
		
		$result = $this->Common_model->getRecords('product',$where,$group_by);
		
		//~ $product = array();
		//~ $quality = array();
		//~ $size = array();
		
		$json = array();
		if (isset($result) && !empty($result)) {
			foreach($result as $key => $val){
				$json['product'][] = array(
					'product_id' =>$val->product_id,
					'product_name' =>$val->product_name
				);
			}
		}
		
		//$result_variety = $this->Common_model->getDetails('product_variety','ref_supplier_id',$_REQUEST['ref_supplier_id']);
		
		////if (isset($result_variety) && !empty($result_variety)) {
			//foreach($result_variety as $key => $val){
	//$json['variety'][] = array(
					//'product_variety_id' =>$val->product_variety_id,
					//'product_variety_name' =>$val->product_variety_name					
				//);
			//}
		//}
		
		//~ $result_size = $this->Common_model->getDetails('product_quality_size','ref_supplier_id',$_REQUEST['ref_supplier_id']);
		//~ 
		//~ if (isset($result_size) && !empty($result_size)) {
			//~ foreach($result_size as $key => $val){
				//~ $json['size'][] = array(
					//~ 'product_quality_size_id' =>$val->product_quality_size_id,
					//~ 'product_quality_size_name' =>$val->product_quality_size_name
					//~ 
				//~ );
			//~ }
		//~ }
		
		//~ echo '<pre>';
		//~ print_r($json);
		//~ echo '</pre>';
		//~ exit;
		echo json_encode($json);
		exit;
	}
}
?>
