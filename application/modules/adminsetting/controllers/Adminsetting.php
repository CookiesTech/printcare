<?php
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
class Adminsetting extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model( array( 'adminsetting_model','User_model') );
        $this->load->helper( array(
             'form' 
        ) );
        $session_data       = $this->session->userdata( SESSION_LOGIN . 'logged_in' );
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        $data[ 'username' ] = $session_data[ 'username' ];
        $data[ 'user' ] = $this->adminsetting_model->getUserlist();
        $data['title']	= 'Adminsetting';
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
        $this->hasPermission( 'user_view' );
        if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
            
            $data = $this->input->post();
            $data['adminsetting']['AUTO_USER'] = implode(',',$data['adminsetting']['AUTO_USER']);
            $data['adminsetting']['HIDE_USER'] = implode(',',$data['adminsetting']['HIDE_USER']);
            //$res = $this->adminsetting_model->addAdminsetting( $data );
            $res = $this->adminsetting_model->addAdminsetting( $data ,'1');
             if ( $res ) {
				$_SESSION['success_msg'] = 'Successfully Updated...';   
            }else{
				$_SESSION['error_msg'] = 'Something went wrong please try again...!';   
			}
            redirect( 'adminsetting' );
        }else{    
			$table['tbl_main'] = 'admin_setting'; 
			$results = $this->Common_model->getList($table);
			if(isset($results) && !empty($results)){
				foreach ($results as $key => $val) {
					if($val->admin_setting_key == 'AUTO_USER'){
						$data['adminsetting'][$val->admin_setting_key] = explode(',',$val->admin_setting_value);
					}else if($val->admin_setting_key == 'HIDE_USER'){
						$data['adminsetting'][$val->admin_setting_key] = explode(',',$val->admin_setting_value);
					}else{
						$data['adminsetting'][$val->admin_setting_key] = $val->admin_setting_value;
					}
				}
			}
			//$data['filter_block']      = $this->parser->parse('common/filter', $data, true);
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/adminsetting_form_view', $data );
			$this->load->view( 'common/footer' );
		}
    }
    
    function updateTable() {
        $this->hasPermission( 'updatetable_add' );
        if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
            $res = $this->adminsetting_model->updateTable( $this->input->post() );
            if ( $res ) {
				$data['msg'] = "Successfully Update";
				$this->load->view( 'common/menu' );
				$this->load->view( 'adminsetting/updatetable_form_view' ,$data);
				$this->load->view( 'common/footer' );
            }
        }else{    
			//$data['adminsetting'] = $this->adminsetting_model->getAdminSetting();
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/updatetable_form_view' );
			$this->load->view( 'common/footer' );
		}
    }
    
    function backupTable1(){
		$this->hasPermission( 'backuptable_add' );
		 if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
			 $table_list = $this->input->post('backup_table');
			 $table_list = implode(',',$table_list);
			  $res = $this->adminsetting_model->backupTable($table_list ,'crm');
			  if($res){
				  redirect('adminsetting/backupList');
			  }
		}else{
			$data['tables'] = $this->adminsetting_model->getDbTables();
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/backup_form_view',$data );
			$this->load->view( 'common/footer' );
		}
	}
	
	function backupTable(){
		$this->hasPermission( 'adminsetting_view' );
		 if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
			 $table_list = $this->input->post('backup_table');
			 //$table_list = implode(',',$table_list);
			 // $res = $this->adminsetting_model->backupTable($table_list ,$this->db->database);			 
			 $this->load->dbutil();
		
			$prefs = array(
				'tables'        => $table_list,   // Array of tables to backup.
				'ignore'        => array(),                     // List of tables to omit from the backup
				'format'        => 'zip',                       // gzip, zip, txt
				'filename'      => $this->db->database . '_'.time().'.sql',              // File name - NEEDED ONLY WITH ZIP FILES
				'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
				'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
				'newline'       => "\n"                         // Newline character used in backup file
			);


			// Backup your entire database and assign it to a variable
			$backup = $this->dbutil->backup($prefs);

			// Load the file helper and write the file to your server
			$this->load->helper('file');
			$file_name =  $this->db->database . '_'.time().'.gz';
			
			$full_name = 'backup/'.$file_name;
			
			write_file($full_name, $backup);
			
			$main_data['table_backup_name'] = $file_name;
			$res = $this->Common_model->addRecord('table_backup',$main_data);
			if($res){
			  redirect('adminsetting/backupList');
			}
		
		}else{
			$data['tables'] = $this->adminsetting_model->getDbTables();
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/backup_form_view',$data );
			$this->load->view( 'common/footer' );
		}
	}
	
	function backupList(){
		$this->hasPermission( 'backuptable_view' );
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
			$segment_3 = $this->uri->segment( 3 );
			$segment_4 = $this->uri->segment( 4 );
			$segment_5 = $this->uri->segment( 5 );			
			
			// If not pagination page remove filter data from session
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
				$sort = ' table_backup_id';
			}
			
			if(isset($segment_5)){
				$order = $segment_5;
			}else{
				$order = 'DESC';
			}
			
			
			$start = (($page-1)*RPP);
			$data['start'] = $start;
			$data['sort'] = $sort;
			$data['order'] = $order;
			$table['tbl_main']  = ' table_backup';
			
			$data[ 'mainlist_count' ] = $this->Common_model->getListCount($table,$filter_data);
			$data[ 'mainlist' ] = $this->Common_model->getList($table,$data,$filter_data);
			$data[ 'tablefields' ] = $this->Common_model->getTableFields('table_backup');
			$data[ 'operations' ] = $this->Common_model->getFilterOperation();
			$data[ 'init_listing_page' ] = 'adminsetting/backupList/'; 
			$data[ 'listing_page' ] = $data[ 'init_listing_page' ].$page.'/';
			$data['filter_block']      = $this->parser->parse('common/filter', $data, true);
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/backup_list_view',$data );
			$this->load->view( 'common/footer' );
	 }
	
	function download(){
		//$this->hasPermission('adminsetting_view');
		$file = $this->uri->segment(3);
		$file ='backup/'.$file;
		if (file_exists($file)) {
			//echo "ters";
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}   
	}
	
	function errorLog(){
		$this->hasPermission('errorlog_view');
		$path = FCPATH.'application/logs/';
		$results = scandir(FCPATH.'application/logs');
		foreach ($results as $result) {
			if ($result === '.' or $result === '..' or $result == 'index.html') continue;

			if (is_dir($path . '/' . $result)) {
				//code to use if directory
			}
			$data[ 'error_logs' ][] = $result;
		}
		
		$this->load->view( 'common/menu' );
		$this->load->view( 'adminsetting/error_log_list', $data );
		$this->load->view( 'common/footer' );
	}
	
	function errorLogView(){
		$this->hasPermission('errorlog_view');
		$path = FCPATH.'application/logs/';
		$file_name = $this->uri->segment( 3 );
		$data['error_details'] = file_get_contents($path.$file_name);		
		$this->load->view( 'common/menu' );
		$this->load->view( 'adminsetting/error_log_view', $data );
		$this->load->view( 'common/footer' );
	}
	
	
	function downloadLogs()
    {
        $this->hasPermission('adminsetting_view');
        $file = $this->uri->segment(3);
        $file = 'application/logs/' . $file;
        if (file_exists($file)) {
            //echo "ters";
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
    function userActivity(){
		$this->hasPermission('useractivity_view');
		$data['user_activity'] = $this->adminsetting_model->getUserActivity($this->input->post());
		$this->load->view( 'common/menu' );
		$this->load->view( 'adminsetting/user_activity_list', $data );
		$this->load->view( 'common/footer' );
		
	}
	
	function menuList(){
            $this->hasPermission( 'menu_view' );
			$filter_data ='';
			if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ){
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
			$segment_3 = $this->uri->segment( 3 );
			$segment_4 = $this->uri->segment( 4 );
			$segment_5 = $this->uri->segment( 5 );			
			
			 // If not pagination page remove filter data from session
            if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
                $this->session->unset_userdata('filter_data');
                $filter_data = '';
                $data['filter_data'] = '';
            }
			
			if(isset($segment_3)){
				$page = $segment_3;
			}else{
				$page = '1';
			}
			
			if(isset($segment_4)){
				$sort = $segment_4;
			}else{
				$sort = ' menu_id';
			}
			
			if(isset($segment_5)){
				$order = $segment_5;
			}else{
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
        
			// $start = (($page-1)*RPP);
			// $data['start'] = $start;
			// $data['sort'] = $sort;
			// $data['order'] = $order;
			$table['tbl_main']  = ' menu';
			
			$data[ 'mainlist_count' ] = $this->Common_model->getListCount($table,$filter_data);
			$data[ 'mainlist' ] = $this->Common_model->getList($table,$filter_query_data,$filter_data);
			$data[ 'tablefields' ] = $this->Common_model->getTableFields('menu');
			$data[ 'operations' ] = $this->Common_model->getFilterOperation();
			$data[ 'init_listing_page' ] = 'adminsetting/menuList/'; 
			$data[ 'listing_page' ] = $data[ 'init_listing_page' ].$page.'/';
			$data['filter_data'] = $filter_data;
            $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
            $data['pagination_block']      = $this->parser->parse('common/pagination', $data, true);
        
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/menu_list_view',$data );
			$this->load->view( 'common/footer' );
	 }
	 
	function addMenu(){
		$this->hasPermission( 'menu_add' );
		if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
			  $res = $this->Common_model->addRecord('menu',$this->input->post());
			  if($res){
				  redirect('adminsetting/menuList');
			  }
		}else{
			$data['menulist'] = $this->Common_model->getDetails('menu','parent_id','0','menu_name','ASC');
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/menu_form_view',$data );
			$this->load->view( 'common/footer' );
		}
	}
	
	
	function editMenu()
    {
       $this->hasPermission( 'menu_edit' ); 
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id  = $this->uri->segment(3);
            $res = $this->adminsetting_model->updateRecord('menu',$this->input->post(), $id);
            redirect('adminsetting/menuList');
        } else {
            $id                   = $this->uri->segment(3);
            $data['menu']        = $this->adminsetting_model->getMenu($id);
            $data['menulist'] = $this->Common_model->getDetails('menu','parent_id','0','menu_name','ASC');
            $this->load->view('common/menu');
            $this->load->view('adminsetting/menu_edit_view', $data);
            $this->load->view('common/footer');
        }
    }
    
    function deleteMenu()
    {
        $this->hasPermission('menu_delete');
		$delete_id = $this->input->post('checkbox'); 
		if(!empty($delete_id)){
			 foreach($delete_id as $key => $id){
				 $this->Common_model->removeRecord('menu', 'menu_id', $id);
			 }
		}
		redirect('adminsetting/menuList');
    }
    
    function IpList(){
		$this->hasPermission( 'menu_view' );
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
			$segment_3 = $this->uri->segment( 3 );
			$segment_4 = $this->uri->segment( 4 );
			$segment_5 = $this->uri->segment( 5 );			
			
			// If not pagination page remove filter data from session
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
				$sort = 'authorised_ip_id';
			}
			
			if(isset($segment_5)){
				$order = $segment_5;
			}else{
				$order = 'ASC';
			}
			
			$start = (($page-1)*RPP);
			$data['start'] = $start;
			$data['sort'] = $sort;
			$data['order'] = $order;
			$table['tbl_main']  = 'authorised_ip';
			
			$data[ 'mainlist_count' ] = $this->Common_model->getListCount($table,$filter_data);
			$data[ 'mainlist' ] = $this->Common_model->getList($table,$data,$filter_data);
			$data[ 'tablefields' ] = $this->Common_model->getTableFields('authorised_ip');
			$data[ 'operations' ] = $this->Common_model->getFilterOperation();
			$data[ 'init_listing_page' ] = 'adminsetting/IpList/'; 
			$data[ 'listing_page' ] = $data[ 'init_listing_page' ].$page.'/';
            $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/ip_list_view',$data );
			$this->load->view( 'common/footer' );
	 }
	 
	function addIp(){
		$this->hasPermission( 'ip_add' );
		if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
			  $res = $this->Common_model->addRecord('authorised_ip',$this->input->post());
			  if($res){
				  redirect('adminsetting/IpList');
			  }
		}else{
			$data[''] = '';
			$this->load->view( 'common/menu' );
			$this->load->view( 'adminsetting/ip_form_view',$data );
			$this->load->view( 'common/footer' );
		}
	}
	
	
	function editIp()
    {
       $this->hasPermission( 'ip_edit' ); 
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id  = $this->uri->segment(3);
            $res = $this->adminsetting_model->updateRecord('authorised_ip',$this->input->post(), $id);
            redirect('adminsetting/IpList');
        } else {
            $id                   = $this->uri->segment(3);
            $data['ip'] = $this->Common_model->getDetails('authorised_ip','authorised_ip_id',$id);
            $this->load->view('common/menu');
            $this->load->view('adminsetting/ip_edit_view', $data);
            $this->load->view('common/footer');
        }
    }
    
    function deleteIp()
    {
        $this->hasPermission('ip_delete');
		$delete_id = $this->input->post('checkbox'); 
		if(!empty($delete_id)){
			 foreach($delete_id as $key => $id){
				 $this->Common_model->removeRecord('authorised_ip', 'authorised_ip_id', $id);
			 }
		}
		redirect('adminsetting/IpList');
    }
    
    function dayendComment(){
		//$this->hasPermission('dayendfeedback_view');
		$date = date('d-m-Y H:i:s');
		$filter_data['date_from'] = $date; 
		$filter_data['date_to'] = $date; 
		$sort_data['sort']      = 'project_timetracker_id';
        $sort_data['order']     = 'DESC';
        
        $user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $where = "project_timetracker.ref_user_id = '".$user_id."' AND ( date(project_timetracker.added_date) BETWEEN '". date('Y-m-d',strtotime($date))."' AND '". date('Y-m-d',strtotime($date))."')";
        
        $data['task_list'] = $this->Common_model->getRecords('project_timetracker',$where);
		//$data['task_list'] = $this->project_model->getTimeTrackerList('project_timetracker',$sort_data,$filter_data);
		//~ echo '<pre>';
		//~ print_r($res_timetracker_list);
		//~ print_r($data['task_list']);
		//~ echo '</pre>';
		//~ exit;
		$this->load->view('common/menu');
        $this->load->view('adminsetting/day_end_task_list_view', $data);
        $this->load->view('common/footer');
	}
	
	function dayendFeedbackList(){
		 $this->hasPermission('dayendfeedback_view');
         $filter_data = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter_data = $this->input->post();
            $reset_data  = $this->input->post('reset');
            if (isset($reset_data)) {
                $this->session->unset_userdata('filter_data');
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
        $data      = array();
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
		
		if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
        }
        if (isset($segment_3)) {
            $page = $segment_3;
        } else {
            $page = '1';
        }
        
        if (isset($segment_4)) {
            $sort = $segment_4;
        } else {
            $sort = 'day_end_user_feed_back_id';
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
        
/*
        $start                     = (($page - 1) * RPP);
        $data['start']             = $start;
        $data['sort']              = $sort;
        $data['order']             = $order;
*/
        
        $table['tbl_main']         = 'day_end_user_feed_back';
        $data['mainlist_count']    = $this->Common_model->getListCount($table, $filter_data);
        $data['mainlist']          = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        $data['init_listing_page'] = 'adminsetting/dayendFeedbackList/';
        $data['listing_page']      = $data['init_listing_page'] . $page . '/';
         $data['tablefields']      = $this->Common_model->getTableFields('day_end_user_feed_back');
      
		$data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $this->load->view('common/menu');
        $this->load->view('adminsetting/day_end_feedback_list_view', $data);
        $this->load->view('common/footer');
        
	}
	
	function viewUserFeedback(){
		//$this->hasPermission('dayendfeedback_view');
		$id = $this->uri->segment(3);
		$user_feedback = $this->Common_model->getDetails('day_end_user_feed_back','day_end_user_feed_back_id',$id);
		$date = $user_feedback[0]->added_date;
		$filter_data['user'] = $user_feedback[0]->ref_user_id;
		$filter_data['date_from'] = $date; 
		$filter_data['date_to'] = $date; 
		$sort_data['sort']      = 'project_timetracker_id';
        $sort_data['order']     = 'DESC';
		$data['task_list'] = $this->project_model->getTimeTrackerList('project_timetracker',$sort_data,$filter_data);

		$this->load->view('common/menu');
        $this->load->view('adminsetting/day_end_task_review_view', $data);
        $this->load->view('common/footer');
	}
	
	function addDayendComment(){
		//$this->hasPermission('dayendfeedback_view');
		$_SESSION['day_end_cmt_status'] = '1';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $res = $this->Common_model->addRecord('day_end_user_feed_back', $this->input->post());
            if ($res) {
                redirect('dashboard/logout');
            } else {
                echo "Error in insertion";
                exit;
            }
        } else {
            redirect('adminsetting/dayEnd');
        }
	}
    
    function ConvertTableEngine(){	
		$sql = $this->db->query("show tables");
		$table = $sql->result();
		foreach($table as $key => $val ){
			$table_name = "Tables_in_".$this->db->database;
			$this->db->query("ALTER TABLE ".$val->$table_name." ENGINE = InnoDB");
		}
	}
	
	function ConvertTableEngineToMyISAM(){
		$sql = $this->db->query("show tables");
		$table = $sql->result();
		foreach($table as $key => $val ){
			$table_name = "Tables_in_".$this->db->database;
			$this->db->query("ALTER TABLE ".$val->$table_name." ENGINE = MyISAM");
		}
	}
	
	function customizeDashboardBlock(){
		$data['mainlist'] = $this->Common_model->getDetails('dashboard_block','delete_status','0','sort_order','ASC');
				
		$this->load->view('common/menu');
        $this->load->view('adminsetting/customize_dashboard_block_view', $data);
        $this->load->view('common/footer');
	}
	
	function editDashboardBlock(){
		$id = $this->uri->segment(3);
		 if ($this->input->server('REQUEST_METHOD') == 'POST') {
			 // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			$res = $this->Common_model->updateRecord('dashboard_block',$data,$id);
			if($res){
				$this->Common_model->TxnCommit();
                $_SESSION['success_msg'] = 'Dashboard Block successfully Updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            } 
            redirect('adminsetting/customizeDashboardBlock');  
		 }else{
			$data['dashboard_block'] = $this->Common_model->getDetails('dashboard_block','dashboard_block_id',$id);
			
			$this->load->view('common/menu');
			$this->load->view('adminsetting/dashboard_block_edit_view', $data);
			$this->load->view('common/footer');
		}
	}
	
	function updateSortOrder(){
		if(isset($_POST['item']) && !empty($_POST['item'])){
			$i = 1;
			foreach($_POST['item'] as $key => $val){
				$update_data['sort_order'] = $i;
				$this->Common_model->updateRecord('dashboard_block',$update_data,$val);
				$i++;
			}	
		}
		exit;
	}
	
	function menuSortorder()
    {
		$this->hasPermission('adminsetting_edit');
        $column		   = array('menu_name');
        $where = 'parent_id = 0 ';
		$data['sorting'] = $this->adminsetting_model->getSortingFields('menu', $column,$where);	
		$data['fields']       = array('Menu Name','Sort Order');
		$data['table'] = 'menu';
		
		$data['action'] = 'adminsetting/updateMenuSortorder';
		$this->load->view('common/menu');
		$this->load->view('adminsetting/sorting_view', $data);
        $this->load->view('common/footer');
	}
	
	function submenuSortorder()
    {
		$this->hasPermission('adminsetting_edit');
        $column		   = array('menu_name');
        $where = 'parent_id = 81 ';
		$data['sorting'] = $this->adminsetting_model->getSortingFields('menu', $column,$where);	
		$data['fields']       = array('Menu Name','Sort Order');
		$data['table'] = 'menu';
		
		$data['action'] = 'adminsetting/updateMenuSortorder';
		$this->load->view('common/menu');
		$this->load->view('adminsetting/sorting_view', $data);
        $this->load->view('common/footer');
	}
	
    
     function updateMenuSortorder()
    {
		$i = 1;
		foreach($_POST['item'] as $key => $val){
			$res = $this->adminsetting_model->updateSorting('menu','menu_id', $val,$i);
			$i++;
		}
		if(isset($res)){
			echo json_encode('true');
		}else{
			echo json_encode('false');
		}
		exit;
	}
	
	function testSms(){
		$mobile = $_REQUEST['mobile'];
		$json =array();
		$msg = 'API Test Message ***  Sent on *** '.date('d-m-Y H:i:s');
		$res = $this->Common_model->smssend($mobile, $msg);
		if (strpos($res, 'alert') !== false) 
			echo json_encode($res);
		else
			echo json_encode('false');
		exit;
	}
	
	function testEmail(){
		$mail_data = array();
		$mail_data['from_address'] = FROM_ADDRESS; 
		$mail_data['to_address'] = TO_ADDRESS; 
		$mail_data['subject'] = 'Test Email Subject';
		$mail_data['message'] = 'Test Email Content on '.date('d-m-Y h:i:s a');
		$res = $this->Common_model->sendEmail($mail_data);
		echo json_encode($res);
		exit;
	}
	
}
?>
