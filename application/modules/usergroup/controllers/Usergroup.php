<?php
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
class Usergroup extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model( 'usergroup_model' );
        $this->load->helper( array(
             'form' 
        ) );
        $session_data       = $this->session->userdata( SESSION_LOGIN.'logged_in' );
        $data[ 'username' ] = $session_data[ 'username' ];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        $data['title'] = 'Usergroup';
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
        $this->hasPermission( 'usergroup_view' );
        $res_usergroup = $this->usergroup_model->getUsergroups();
       
        $usergroup     = array();
        if(isset($res_usergroup) && !empty($res_usergroup)){
			foreach ( $res_usergroup as $key => $val ) {
				$usergroup[] = array(
					 'id' => $val->user_group_id,
					'name' => $val->user_group_name,
					'permission' => $val->permission 
				);
			}
		}
		$data[ 'usergroup' ] = $usergroup;
        // $this->load->view('common/header');
        $this->load->view( 'common/menu' );
        $this->load->view( 'usergroup/usergroup_list', $data );
        $this->load->view( 'common/footer' );
    }
    function getForm() {
        $session_data       = $this->session->userdata( 'logged_in' );
        $data[ 'username' ] = $session_data[ 'username' ];
        $res_action         = $this->usergroup_model->getActions();
        $actions            = array();
        
        foreach ( $res_action as $key => $val ) {
            $data[ 'actions' ][] = array(
                'action' => $val->action 
            );
        }
        
        $path = FCPATH.'application/modules/';
		$results = scandir(FCPATH.'application/modules/');
		$pages = array();
		foreach ($results as $result) {
			if ($result === '.' or $result === '..') continue;

			if (is_dir($path . '/' . $result)) {
				//code to use if directory
			}
			$data[ 'pages' ][]['pages_name'] = $result;
		}
        
		 $res_pages  = $this->Common_model->getDetails('module_key','delete_status','0','','	module_key_display_name','ASC');		
			
         foreach ( $res_pages as $key => $val ) {
				$data[ 'other_pages' ][] = array(
					'pages_name' => $val->module_key_name,
					'display_name' => $val->module_key_display_name 
				);
			}
			
			$where = "menu_table_name != ''";
			$res_master_menu  = $this->Common_model->getRecords('menu',$where);		
			 
			 foreach ( $res_master_menu as $key => $val ) {
				$data[ 'master_pages' ][] = array(
					'pages_name' => $val->menu_table_name,
					'display_name' => ucwords(str_replace('_',' ',$val->menu_table_name))
				);
			}
			
			
        asort($data[ 'pages' ]);
        
        //  echo "<pre>";
        //  print_r($data);
        //  echo "</pre>";exit;
        $this->load->view( 'common/menu' );
        $this->load->view( 'usergroup/usergroup_form_view', $data );
        $this->load->view( 'common/footer' );
    }
    function add() {
        $this->hasPermission( 'usergroup_add' );
        if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
             // Begin Transaction
			$this->Common_model->TxnBegin();
            $res = $this->usergroup_model->addUserGroup( $this->input->post() );
            if($res){
				$this->Common_model->TxnCommit();
				$this->Common_model->addUserActivity('usergroup',$res); // Record User Activity
                $_SESSION['success_msg'] = 'User Group successfully added ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            } 
            redirect( 'usergroup' );
        } else {
            $this->getForm();
        }
    }
    function edit() {
       $this->hasPermission( 'usergroup_edit' );
        if ( $this->input->server( 'REQUEST_METHOD' ) == 'POST' ) {
            $id = $this->uri->segment( 3 );
            // Begin Transaction
			$this->Common_model->TxnBegin();
            $res = $this->usergroup_model->updateUserGroup( $this->input->post(), $id );
            if($res){
				$this->Common_model->TxnCommit();
                $_SESSION['success_msg'] = 'User Group successfully updated ...';
            }else{
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            } 
            redirect( 'usergroup' );
            
        } else {
            $user_id       = $this->session->userdata(SESSION_LOGIN. 'user_id' );
			$id       = $this->uri->segment( 3 );
			if($user_id !='1' && $id == '1'){
				redirect( 'access_denied', 'refresh' );
			}else{
            $res_usergroup = $this->usergroup_model->getUserGroup( $id );
            foreach ( $res_usergroup as $key => $val ) {
                $data[ 'usergroup' ] = array(
                     'id' => $val->user_group_id,
                    'name' => $val->user_group_name,
                    'permission' => unserialize( $val->permission ) 
                );
            }
            $permission         = $data[ 'usergroup' ][ 'permission' ];
            $data[ 'permission_allowed' ][] = array();
            if(!empty($permission)){
				foreach ( $permission as $key => $val ) {
					foreach ( $val as $key1 => $val1 ) {
						$data[ 'permission_allowed' ][] = $key . '_' . $key1;
					}
				}
			}
          
            $res_action = $this->usergroup_model->getActions();
            $actions    = array();
            if(!empty($res_action)){
				foreach ( $res_action as $key => $val ) {
					$data[ 'actions' ][] = array(
						'action' => $val->action 
					);
				}
			}
			
            $path = FCPATH.'application/modules/';
			$results = scandir(FCPATH.'application/modules/');
			$pages = array();
			foreach ($results as $result) {
				if ($result === '.' or $result === '..') continue;
				if (is_dir($path . '/' . $result)) {
					//code to use if directory
				}
				$data[ 'pages' ][] = array(
					'pages_name'	=> $result,
					'display_name'	=> $result
				);
			}
			
			 $res_pages  = $this->Common_model->getDetails('module_key','delete_status','0','','	module_key_display_name','ASC');		
			 foreach ( $res_pages as $key => $val ) {
				$data[ 'other_pages' ][] = array(
					'pages_name' => $val->module_key_name,
					'display_name' => $val->module_key_display_name 
				);
			}
			
			$where = "menu_table_name != ''";
			$res_master_menu  = $this->Common_model->getRecords('menu',$where);		
			
			 foreach ( $res_master_menu as $key => $val ) {
				$data[ 'master_pages' ][] = array(
					'pages_name' => $val->menu_table_name,
					'display_name' => ucwords(str_replace('_',' ',$val->menu_table_name))
				);
			}
			
			asort($data[ 'pages' ]);
            $this->load->view( 'common/menu' );
            $this->load->view( 'usergroup/usergroup_edit_view', $data );
            $this->load->view( 'common/footer' );
		}
        }
    }
    function delete() {
        $this->hasPermission( 'usergroup_delete' );
        $id = $this->uri->segment( 3 );
        $res = $this->usergroup_model->removeUserGroup( $id );
        
         if($res){
			$this->Common_model->TxnCommit();
			$_SESSION['success_msg'] = 'User Group successfully deleted ...';
		}else{
			$this->Common_model->TxnRollBack();
			$_SESSION['error_msg'] = 'Error occurred please try again...';
		} 
		redirect( 'usergroup' );
    }
}
?>
