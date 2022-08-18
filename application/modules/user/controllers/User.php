<?php
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
class User extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model( array( 'user_model') );
        $this->load->helper( array(
             'form' 
        ) );
        $session_data       = $this->session->userdata(SESSION_LOGIN. 'logged_in' );
       
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        $data[ 'username' ] = $session_data[ 'username' ];
        $data['title'] = 'User';
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
        $this->getlist();
/*
        $res_user = $this->user_model->getUserlist('user');
        $user     = array();
        if(isset($res_user) && !empty($res_user)){
			foreach ( $res_user as $key => $val ) {
				$res_user_group = $this->Common_model->getDetails('user_to_group','ref_user_id',$val->user_id);
				$user_group_list = array();
				$user_group_name = '';
				if(isset($res_user_group) && !empty($res_user_group)){
					foreach($res_user_group as $user_group){
						$user_group_list[] = $user_group->user_group_name;	
					}
				}
				$user_group_name = implode(',',$user_group_list);
				$user[] = array(
					'id' 		=> $val->user_id,
					'name' 		=> $val->user_name,
					'full_name' => $val->full_name,
					'nick_name' => $val->nick_name,
					'user_group'=> $user_group_name,
					'status'	=> $val->status 
				);
			}
		}
		$data[ 'user' ] = $user;
        //$this->load->view('common/header',$data);
        $this->load->view( 'common/menu' );
        $this->load->view( 'user/user_list', $data );
        $this->load->view( 'common/footer' );
*/
    }
    
    
     function getlist()
    {
        $this->hasPermission( 'user_view' );
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
            $sort = 'user_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
       
        /**** Filter code ***/
        $data['filter_data'] = $filter_data;   
        $data['page']             = $page; // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $filter_query_data      = array();
        $data['limit_str'] = '';
        if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit_str'] = '?limit='.$_REQUEST['limit'];
        }else{
            $start                     = (($page - 1) * RPP);
        }
        $data['start']             = $start; // Generate SNO in result table based on page number
        
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;
         /**** Ends ***/
        $table = array();
        $table['tbl_main'] 		   = 'user';
        $data['mainlist_count']    = $this->Common_model->getListCount($table, $filter_data);
        $res_user_list      = $this->Common_model->getList($table, $filter_query_data, $filter_data);
        
        if(isset($res_user_list) && !empty($res_user_list)){
			foreach ( $res_user_list as $key => $val ) {
				$res_user_group = $this->Common_model->getDetails('user_to_group','ref_user_id',$val->user_id);
				$user_group_list = array();
				$user_group_name = '';
				if(isset($res_user_group) && !empty($res_user_group)){
					foreach($res_user_group as $user_group){
						$user_group_list[] = $user_group->user_group_name;	
					}
				}
				$user_group_name = implode(',',$user_group_list);
				$data['mainlist'][]  = array(
					'user_id' 		=> $val->user_id,
					'user_name'  	=> $val->user_name,
					'full_name' 	=> $val->full_name,
					'nick_name' 	=> $val->nick_name,
					'original_password' 	=> $val->original_password,
					'user_group'	=> $user_group_name,
					'status'		=> $val->status 
				);
			}
		}
		
       
        $data['init_listing_page'] = 'user/getlist/';
        $data['listing_page']      = $data['init_listing_page'] . $page . '/';
        $data[ 'tablefields' ] = $this->Common_model->getTableFields('user');			
        $data[ 'operations' ] = $this->Common_model->getFilterOperation();
        $data['add'] = site_url('user/add');
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        
        
        $this->load->view('common/menu');
        $this->load->view( 'user/user_list', $data );
        $this->load->view('common/footer');
    }
    
    function chathistory()
    {
        $this->hasPermission( 'user_view' );
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
        
        $user = $this->uri->segment(3);
        $segment_3 = $this->uri->segment(4);
        $segment_4 = $this->uri->segment(5);
        $segment_5 = $this->uri->segment(6);
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
            $sort = 'sent';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }
       
        /**** Filter code ***/
        $data['filter_data'] = $filter_data;   
        $data['page']             = $page; // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $filter_query_data      = array();
        $data['limit_str'] = '';
        if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit_str'] = '?limit='.$_REQUEST['limit'];
        }else{
            $start                     = (($page - 1) * RPP);
        }
        $data['start']             = $start; // Generate SNO in result table based on page number
        
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;
         /**** Ends ***/
        $table = array();
        $table['tbl_main'] 		   = 'chat';
        
        $data['mainlist']      = $this->user_model->getList($table, $filter_query_data, $filter_data,$user);  
        
        if(isset($data['mainlist']) && !empty($data['mainlist'])){
			$data['mainlist_count']    = count($data['mainlist']);
		}else{
			$data['mainlist_count']    = 0;
		}
             
/*
        echo "<pre>";     
        print_r($data['mainlist']);
        exit;
*/
        
        
        $data['init_listing_page'] = 'user/chathistory/'.$user.'/';
        $data['listing_page']      = $data['init_listing_page'] . $page . '/';
        $data[ 'tablefields' ] = $this->Common_model->getTableFields('chat');			
        $data[ 'operations' ] = $this->Common_model->getFilterOperation();
       // $data['add'] = site_url('user/add');
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        
        
        $this->load->view('common/menu');
        $this->load->view( 'user/chathistory_list', $data );
        $this->load->view('common/footer');
    }
    
    function getForm() {
        $res_group           = $this->user_model->getUsergroups();
        $data[ 'usergroup' ] = array();
        foreach ( $res_group as $key => $val ) {
            $data[ 'usergroup' ][] = array(
                 'id' => $val->user_group_id,
                'name' => $val->user_group_name 
            );
        }
        //$this->load->view('common/header',$data);
        $this->load->view( 'common/menu' );
        $this->load->view( 'user/user_form_view', $data );
        $this->load->view( 'common/footer' );
    }
    function add() {
        $this->hasPermission( 'user_add' );
        if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
            // Begin Transaction
			$this->Common_model->TxnBegin();
            $res = $this->user_model->addUser( $this->input->post() );
            if($res){
				$this->addDashboardBlock($res);
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('user',$res); // Record User Activity
                $_SESSION['success_msg'] = 'User successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            } 
             redirect('user');    
        } else {
            $this->getForm();
        }
    }
    
    function edit() {
        $this->hasPermission( 'user_edit' );
        if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
            $id  = $this->uri->segment( 3 );
            // Begin Transaction
			$this->Common_model->TxnBegin();
            $data = $this->input->post();
            $redirect_to = $data['redirect_to'];
            unset($data['redirect_to']);
            $res = $this->user_model->updateUser( $data, $id );
            if($res){
				$this->addDashboardBlock($res);
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('user_edit',$res); // Record User Activity
                $_SESSION['success_msg'] = 'User successfully updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
            redirect($redirect_to);        
        } else {
				$user_id       = $this->session->userdata(SESSION_LOGIN. 'user_id' );
				$id       = $this->uri->segment( 3 );
				$hide_to = explode(',',HIDE_USER);
				//$this->addDashboardBlock($id);
				if($user_id !='1' && $id == '1'){
					redirect( 'access_denied', 'refresh' );
					
				} else if($user_id !='1' && in_array($id,$hide_to)){
					redirect( 'access_denied', 'refresh' );
				} else{
				
					$data[ 'user' ] = $this->Common_model->getDetails( 'user','user_id',$id );
					$res_user_group = $this->Common_model->getDetails('user_to_group','ref_user_id',$id);
					$user_group_list = array();
					$user_group_name = '';
					if(isset($res_user_group) && !empty($res_user_group)){
						foreach($res_user_group as $user_group){
							$user_group_list[] = $user_group->ref_user_group_id;	
						}
					}
					$data['assigned_user_group'] = $user_group_list; 
						
					$res_group           = $this->user_model->getUsergroups();
					$data[ 'usergroup' ] = array();
					foreach ( $res_group as $key => $val ) {
						$data[ 'usergroup' ][] = array(
							 'id' => $val->user_group_id,
							'name' => $val->user_group_name 
						);
					}
					
					//~ echo '<pre>';
					//~ print_r($data[ 'usergroup' ]);
					//~ echo '</pre>';
					//~ exit;
					//$this->load->view('common/header',$data);
					$this->load->view( 'common/menu' );
					$this->load->view( 'user/user_edit_view', $data );
					$this->load->view( 'common/footer' );
				}
			}
		}
    
    function delete() {
        $this->hasPermission( 'user_delete' );
        $id = $this->uri->segment( 3 );
        if($id != '1'){
			// Begin Transaction
			$this->Common_model->TxnBegin();
			
			$res = $this->user_model->removeUser( $id );
			if($res){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('user_delete',$res); // Record User Activity
                $_SESSION['success_msg'] = 'User successfully deleted ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }            
           
			redirect( 'user');
		}else{
			redirect( 'access_denied', 'refresh' );
		}
    }
    
    function logs(){
		$this->hasPermission( 'user_view' );
		$res_user_log_list = $this->user_model->getUserLogs($this->input->post());
		
		if(isset($res_user_log_list) && !empty($res_user_log_list)){
		foreach ( $res_user_log_list as $key => $val ) {
			if($val->user_id != '1'){
				$res_user_group = $this->Common_model->getDetails('user_to_group','ref_user_id',
				$val->user_id);
			
				$user_group_list = array();
				$user_group_name = '';
				if(isset($res_user_group) && !empty($res_user_group)){
					foreach($res_user_group as $user_group){
						$user_group_list[] = $user_group->user_group_name;	
					}
				}
				$user_group_name = implode(',',$user_group_list);
				$data['logs'][]  = (object) array(
					'user_id' 		=> $val->user_id,
					'user_name' 		=> $val->user_name,
					'user_group' 		=> $user_group_name,
					'ip_address'  	=> $val->ip_address,
					'logged_in_date' 	=> $val->logged_in_date,
					'logged_out_date' 	=> $val->logged_out_date
					
				);
			}
		}
		}
		
/*
		echo '<pre>';
		print_r($data['logs']);
		echo '</pre>';
*/
		
		
		$this->load->view( 'common/menu' );
		$this->load->view( 'user/user_log_list', $data );
		$this->load->view( 'common/footer' );
		
	}
	
	function accountsetting(){
		$this->hasPermission( 'dashboard_view' );
		$session_data       = $this->session->userdata(SESSION_LOGIN.'logged_in');	
        $password       = $session_data['password'];
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data = $this->input->post();
			
			if(isset($_FILES['user_image']['name']) && !empty($_FILES['user_image']['name'])){
				$up_data['user_image'] = $this->Common_model->upload_file($_FILES['user_image']['name'],$_FILES['user_image']['tmp_name'],'profile_images');
				$this->Common_model->updateRecord('user',$up_data,$session_data['id']);
			}
			if(!empty($data['password']) && !empty($data['repeatpassword']) && !empty($data['old_password'])){
				if($password == md5($data['old_password'])){
					$data['password'] = trim($data['password']);
					$data['repeatpassword'] = trim($data['repeatpassword']);
					if(!empty($data['password']) && !empty($data['repeatpassword'])){    
						if(trim($data['password']) == trim($data['repeatpassword'])){
							 $this->user_model->updateAccountSetting($session_data['id'],$data,'password');
							 $_SESSION['success_msg'] = 'Successfully Updated';
						}else{
							$_SESSION['error_msg'] = 'New Password Mismatch';
						}
					 }else{
							$_SESSION['error_msg'] = 'New Password is empty';
						}
				}else{
					$_SESSION['error_msg'] = 'Current Password Mismatch';
				}
			}else{
				$update_data['full_name'] = $data['full_name'];
				$update_data['nick_name'] = $data['nick_name'];
				$update_data['session_time_limit'] = $data['session_time_limit'];
				$update_data['reminder_interval_time'] = $data['reminder_interval_time'];
				$res = $this->user_model->updateAccountSetting($session_data['id'],$update_data,'');
				if($res){
					$_SESSION['success_msg'] = 'Successfully Updated...';
				}else{
					$_SESSION['error_msg'] = 'Error in user updation...';
				}
			}
			redirect('user/accountsetting');
		}else{
			
			$data['user_data'] = $this->session->userdata(SESSION_LOGIN.'logged_in');
			$data['user'] = $this->Common_model->getDetails('user','user_id',$data['user_data']['id']);	
			$data['page_title'] = 'Account Settings';
			$this->load->view( 'common/menu' ,$data);
			$this->load->view( 'user/user_account_edit_view', $data );
			$this->load->view( 'common/footer' );
		}
	}
	
	function accountsetting_old(){
		$data['user_data'] = $this->session->userdata( 'logged_in');			
		if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
			if($user_data['password'] == md5($this->input->post('old_password'))){
				$this->user_model->updateAccountSetting($user_data['id'],$this->input->post());
				$_SESSION['success_msg'] = 'Your Password Successfully Updated';
				redirect('user/accountsetting');
			}else{
				echo "Your old password is not correct";
			}
			
		}else{
			$this->load->view( 'common/menu' );
			$this->load->view( 'user/user_account_edit_view', $data );
			$this->load->view( 'common/footer' );
		}
	}
	
	
	function resetLink()
    {
		$id = $this->uri->segment( 3 );
		$res_user = $this->Common_model->getDetails('user','user_id',$id);
		if(isset($res_user) && !empty($res_user)){
			$randomNumber = $this->randomNumber(30);
			
			$reset_data['ref_user_id'] = $res_user[0]->user_id;
			$reset_data['hash_key'] = $randomNumber;
			$reset_data['added_date'] = date('Y-m-d H:i:s');
			$this->db->insert('reset_password', $reset_data);
			$last_id = $this->db->insert_id();
	
			$mail_data['user'] = $res_user[0]->user_name;            
			$mail_data['to_address'] = $res_user[0]->email;            
			$mail_data['subject'] = 'Reset Password';             
			$mail_data['template_path'] = 'template/email/reset_password.php';  
			$mail_data['login_link'] = site_url('login/doResetPassword?hashkey='.$randomNumber); 
			$res = $this->sendEmail($mail_data);
			$_SESSION['success_msg'] = $res;
		}else{
			$_SESSION['error_msg'] = 'Invalid UserName...';
		}
		redirect('user');
    }
    
    
    function sendEmail($mail_data){	
			$to = $mail_data['to_address'];
			$sender = FROM_ADDRESS;
			$headers = 'From:'.$sender."\r\n";
			$headers .= 'MIME-Version: 1.0'."\n";
			$headers .= 'Content-type: text/HTML; charset=utf-8'."\r\n";
			
			$subject = $mail_data['subject'];
			$body = $this->parser->parse($mail_data['template_path'],$mail_data,TRUE);
			
			$send = mail($to, $subject, $body, $headers);
			
			if($send){
				$mail_status = 'Password reset link Successfully Sent to your Registered Email Id... Link Valid for 15 Mins only';
			}else{
				$mail_status = 'Mail not Sent!';
			}
			return $mail_status;
			
	}
     function randomNumber($length)
    {
        $alphabet    = '1234567890abcdefghijklmnopqrstuvwxyz';
        $pass        = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $n      = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
    
	
	function resetPassword(){
		$id = $this->uri->segment( 3 );
		$data['password'] = $this->randomNumber(8);
		/*** UPDATE IN USER TABLE ***/
		$main_data['password'] = md5($data['password']);
		$main_data['original_password'] = $data['password'];
		$this->db->where('user_id', $id);
		$this->db->update('user', $main_data);
		$res = $this->db->affected_rows();
		if($res){
			$_SESSION['success_msg'] = 'Password successfully Reset...';
		}else{
			$_SESSION['error_msg'] = 'error occurred please  try again....';
		}
		redirect('user');	
	}
	
	function updateStatus(){
		$id = $_REQUEST['id'];
		$update_data['status'] = $_REQUEST['status'];
		
		$this->db->where('user_id', $id);
		$this->db->update('user', $update_data);
		$res = $this->db->affected_rows();
		echo json_encode($res);
		exit;
	}
	
	function itemEXist(){
        if (isset($_REQUEST['name'])) {
		 $res_name = $this->Common_model->getDetails('user',$_REQUEST['field'], trim($_REQUEST['name']));
         //echo '<pre>';
         //print_r($res_name);
		 if(isset($res_name) && !empty($res_name)){
			$res = 'exist';
		 }else{
            $res = 'not exist';
         } 
		 echo json_encode($res);
		 exit;
	 } 
	}
	
	function addDashboardBlock($id){
		$this->db->query('DELETE FROM user_dashboard_block WHERE ref_user_id = "'.$id.'"');
		$res_blocks = $this->Common_model->getDetails('dashboard_block','delete_status','0');
		if(isset($res_blocks) && !empty($res_blocks)){
			foreach($res_blocks as $key => $val){
				$data = array(
				   'ref_dashboard_block_id' => $val->dashboard_block_id ,
				   'column_width' => $val->column_width,
				   'sort_order' => $val->sort_order,
				   'ref_user_id' => $id
				);
				$this->db->insert('user_dashboard_block', $data); 
			}
		}
		return true;
	}
	
	function generateDashboardBlock(){
		$this->Common_model->truncateTable('user_dashboard_block');
		
		$res_user = $this->Common_model->getDetails('user','delete_status','0');
		if(isset($res_user) && !empty($res_user)){
			foreach($res_user as $key => $v){
				$res_blocks = $this->Common_model->getDetails('dashboard_block','delete_status','0');
				if(isset($res_blocks) && !empty($res_blocks)){
					foreach($res_blocks as $key => $val){
						$data = array(
						   'dashboard_block_name' => $val->dashboard_block_name ,
						   'dashboard_block_key' => $val->dashboard_block_key ,
						   'column_width' => $val->column_width,
						   'sort_order' => $val->sort_order,
						   'ref_user_id' => $v->user_id
						);
						$this->db->insert('user_dashboard_block', $data); 
					}
				}
			}
		}
		return true;
	}
	
	function customizeDashboardBlock(){
		$this->hasPermission( 'dashboard_view' );
		$user_id       = $this->session->userdata(SESSION_LOGIN. 'user_id' );
		$data['mainlist'] = $this->Common_model->getDetails('user_dashboard_block','ref_user_id',$user_id,'sort_order','ASC');
        //~ echo '<pre>';
        //~ print_r($data['mainlist']);
        //~ echo '</pre>';
		$data['page_title'] = 'Dashboard Block';
		$this->load->view('common/menu',$data);
        $this->load->view('user/customize_dashboard_block_view', $data);
        $this->load->view('common/footer');
	}
	
	function editDashboardBlock(){
		$id = $this->uri->segment(3);
		 if ($this->input->server('REQUEST_METHOD') == 'POST') {
			 // Begin Transaction
			$this->Common_model->TxnBegin();
			$data = $this->input->post();
			
			//~ echo '<pre>';
			//~ print_r($data);
			//~ echo '</pre>';
			//~ exit;
			$res = $this->Common_model->updateRecord('user_dashboard_block',$data,$id);
			if($res){
				$this->Common_model->TxnCommit();
                $_SESSION['success_msg'] = 'Dashboard Block successfully Updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            } 
            redirect('user/customizeDashboardBlock');  
		 }else{
			$data['dashboard_block'] = $this->Common_model->getDetails('user_dashboard_block','user_dashboard_block_id',$id);
			$data['page_title'] = 'Dashboard Block';
			$this->load->view('common/menu',$data);
			$this->load->view('user/dashboard_block_edit_view', $data);
			$this->load->view('common/footer');
		}
	}
	
	function updateSortOrder(){
		if(isset($_POST['item']) && !empty($_POST['item'])){
			$i = 1;
			foreach($_POST['item'] as $key => $val){
				$update_data['sort_order'] = $i;
				$this->Common_model->updateRecord('user_dashboard_block',$update_data,$val);
				$i++;
			}	
		}
		exit;
	}
	
	function updateBlockStatus(){
		$id = $_REQUEST['id'];
		$update_data['status_id'] = $_REQUEST['status'];
		
		$this->db->where('user_dashboard_block_id', $id);
		$this->db->update('user_dashboard_block', $update_data);
		$res = $this->db->affected_rows();
		echo json_encode($res);
		exit;
	}
}
?>
