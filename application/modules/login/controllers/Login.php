<?php
ob_start();
ob_flush();
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
class Login extends CI_Controller {
    function __construct() {
	
        parent::__construct();
         $this->load->model( 'login_model');
        
    }
    function index() {
		
        if ( $this->session->userdata( SESSION_LOGIN .'logged_in' ) ) {
            $session_data       = $this->session->userdata( SESSION_LOGIN .'logged_in' );
            $data[ 'username' ] = $session_data[ 'username' ];
            redirect( 'dashboard');
        } else {
				
            $this->load->helper( array(
                 'form' 
            ) );
            $data['title'] = 'Login';
            $this->load->view( 'common/login_header' ,$data);
            $this->load->view( 'login/login_view' );
            $this->load->view( 'common/login_footer' );
        }
    }
    
     function verifylogin() {
        //$res_ip = $this->login_model->CheckIp( );
       // if($res_ip){
            //This method will have the credentials validation
            $this->load->library( 'form_validation' );
            $this->form_validation->set_rules( 'username', 'Username', 'trim|required' );
            $this->form_validation->set_rules( 'password', 'Password', 'trim|required|callback_check_database' );
            if ( $this->form_validation->run() == FALSE ) {
                //Field validation failed.  User redirected to login page
                $this->load->view( 'common/login_header' );
                $this->load->view( 'login/login_view' );
                $this->load->view( 'common/login_footer' );
            } else {
                //Go to private area
                redirect( 'dashboard');
            }
    }

    
     function check_database( $password ) {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post( 'username' );
        //query the database
        $result   = $this->login_model->Checklogin( $username, $password );
	
        if ( $result ) {
			$remember = $this->input->post( 'remember_me' );
			if ($remember) {
				$cookie_domain= array(
					  'name'   => base_url(),
					  'value'  => base_url(),
					  'expire' => time()+86500,  
				  );
				  
				$cookie= array(
					  'name'   =>  base_url().'_remember_me',
					  'value'  => 'remember_me',
					   'expire' => time()+86500,
				  );
				  $cookie_username= array(
					  'name'   => base_url().'_username',
					  'value'  => $username,
					  'expire' => time()+86500,
				  );
				  $cookie_password= array(
					  'name'   => base_url().'_password',
					  'value'  => $password,
					   'expire' => time()+86500,
				  );
				  $this->input->set_cookie($cookie);
				  $this->input->set_cookie($cookie_domain);
				  $this->input->set_cookie($cookie_username);
				  $this->input->set_cookie($cookie_password);
				  $this->input->cookie(base_url(),true);
				  //exit;
			} else {
				$cookie_domain= array(
					  'name'   => base_url(),
					  'value'  => '',
					  'expire' => '',
				  );
				  
				$cookie= array(
					  'name'   => base_url().'_remember_me',
					  'value'  => '',
					  'expire' => '',
				  );
				  $cookie_username= array(
					  'name'   => base_url().'_username',
					  'value'  => '',
					  'expire' => '',
				  );
				  $cookie_password= array(
					  'name'   => base_url().'_password',
					  'value'  => '',
					  'expire' => '',
				  );
				  $this->input->set_cookie($cookie);
				  $this->input->set_cookie($cookie_domain);
				  $this->input->set_cookie($cookie_username);
				  $this->input->set_cookie($cookie_password);
			}
            $sess_array = array();
            foreach ( $result as $row ) {
                $sess_array = array(
                    'id' => $row->user_id,
                    'username' => $row->user_name,
                    'full_name' => $row->full_name,
                    'nick_name' => $row->nick_name,
                    'password'	=> $row->password,
                    'user_group' => $row->ref_user_group_id,
                    'audit_record' => $row->audit_record 
                );
				//debug($sess_array); //exit;
                $this->session->set_userdata( SESSION_LOGIN.'logged_in', $sess_array );
                $this->session->set_userdata( SESSION_LOGIN.'full_name', $row->full_name);
                $this->session->set_userdata( SESSION_LOGIN.'user_name', $row->user_name);
                $this->session->set_userdata( SESSION_LOGIN.'user_id', $row->user_id);
                $this->session->set_userdata( SESSION_LOGIN.'audit_record', $row->audit_record);
                // $this->session->set_userdata( SESSION_LOGIN.'employee_id', $row->ref_employee_id);
				// $this->session->set_userdata( SESSION_LOGIN.'user_branch_id', $row->ref_branch_id);
				//$this->session->set_userdata( SESSION_LOGIN.'branch_id', $row->ref_branch_id);
                $session_data = $this->session->userdata( SESSION_LOGIN . 'logged_in' );	
				// debug($session_data); exit;
                $this->Login_model->addLoginLogs($row->user_id);
                $this->Common_model->addUserActivity('login',$row->user_id); // Record User Activity
                
                //$update_data['login_time'] =  date('Y-m-d H:i:s');
               // $this->Common_model->updateRecord('user',$update_data, $row->user_id); // Update login time
                
                $res_user_to_group = $this->Common_model->getDetails('user_to_group','ref_user_id',$row->user_id);
				$users_group_list = array();
	if(isset($res_user_to_group) && !empty($res_user_to_group)){
		    foreach($res_user_to_group as $key => $val){
			    $users_group_list[] = $val->ref_user_group_id;
				}
			}
	$this->session->set_userdata(SESSION_LOGIN.'user_group',$users_group_list);
	    
            }
           
            $permission = $this->login_model->checkPermission();
            $this->session->set_userdata( SESSION_LOGIN.'user_permission',$permission);
              
            return TRUE;
        } else {
            $this->form_validation->set_message( 'check_database', '<div role="alert" class="alert alert-danger alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Invalid username or Password </strong></div>' );
            return false;
        }
    }
    
    function resetPassword()
    {
		$this->load->helper( array(
                 'form' 
            ) );
        $data['reset_password'] = 1;    
		$data['title'] = 'Reset Password';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
			//print_r($this->input->post());
			$username = trim($_POST['username']);
			$res_user = $this->Common_model->getDetails('user','user_name',$username);
			 
			if(isset($res_user) && !empty($res_user)){
				$randomNumber = $this->randomNumber();
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
				$res = $this->Common_model->sendEmail($mail_data);
				if($res){
					$mail_status = 'Password reset link Successfully Sent to your Registered Email Id... Link Valid for 15 Mins only';
				}else{
					$mail_status = 'Mail not Send!';
				}
				$_SESSION['success_msg'] = $mail_status;
				
			}else{
				$_SESSION['error_msg'] = 'Invalid UserName...';
			}
             $this->load->view( 'common/login_header',$data);
             $this->load->view('login/login_view');
        } else {
			$this->load->view( 'common/login_header',$data);
            $this->load->view('login/login_view');
        }
        $this->load->view('common/login_footer');
    }
    
     
    function sendEmail($mail_data){
			$this->load->library('email');
			
			$to = array();
			$cc = array();
			$bcc = array();
			
			$this->email->from(FROM_ADDRESS);
			$this->email->to($mail_data['to_address']);
			
			$this->email->subject($mail_data['subject']);
			$body = '';
			$body = $this->parser->parse($mail_data['template_path'],$mail_data,TRUE);
			
			$this->email->message($body);	
			
			if(isset($mail_data['attachment']) && !empty($mail_data['attachment'])){
				$this->email->attach($mail_data['attachment']);
			}
			
			if($this->email->send()){
				$mail_status = 'Password reset link Successfully Sent to your Registered Email Id... Link Valid for 15 Mins only';
			}else{
				$mail_status = 'Mail not Send!';
			}
			return $mail_status; 

			
			
/*
			$to = $mail_data['to_address'];
			$sender = "info@smmaruti.com";
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
*/
			
	}
	
	
    function doResetPassword(){
		$hash_key = $_REQUEST['hashkey'];
		$res_hash_key = $this->Common_model->getDetails('reset_password','hash_key',$hash_key,'','reset_password_id','DESC');
		//echo '------'.$res_hash_key[0]->reset_password_id;
		$seconds = 15 * 60;
		$expiry_time = date("Y-m-d H:i:s", strtotime($res_hash_key[0]->added_date) + $seconds);
		$cur_time = date("Y-m-d H:i:s");
		
		if(isset($res_hash_key) && !empty($res_hash_key)){
			if($res_hash_key[0]->reset_password_status == '1' || $cur_time > $expiry_time){
				$_SESSION['error_msg'] = 'Link expired,please generate new link...';
				$data['reset_password'] = 1; 
				$this->load->view( 'common/login_header',$data);
				$this->load->view('login/login_view');
			}else{
				$data['do_reset_password'] = 1; 
				$data['ref_user_id'] = $res_hash_key[0]->ref_user_id;
				$this->load->view( 'common/login_header',$data);
				$this->load->view('login/login_view');
			}
		}else{
			$data['reset_password'] = 1; 
			$_SESSION['error_msg'] = 'Invalid Hashcode,please generate new link...';
			$this->load->view( 'common/login_header',$data);
			$this->load->view('login/login_view');
		}
		
	}
	
	function updatePassword(){
		 if ($this->input->server('REQUEST_METHOD') == 'POST') {
			 
			 $data = $this->input->post();
			 $data['password'] = trim($data['password']);
             //echo '<br>';
             $data['repeatpassword'] = trim($data['repeatpassword']);
            
             if(!empty($data['password']) && !empty($data['repeatpassword'])){  	
				if(trim($data['password']) == trim($data['repeatpassword'])){
					
					/*** UPDATE IN USER TABLE ***/
					 $main_data['password'] = md5($data['password']);
					 $main_data['original_password'] = $data['password'];
					 $this->db->where('user_id', $data['ref_user_id']);
					 $this->db->update('user', $main_data);
					 //echo $this->db->last_query();
					
						
					/*** UPDATE IN RESET PASSWORD TABLE ***/	
					 $main_data1['reset_password_status'] = '1';
					 $this->db->where('ref_user_id', $data['ref_user_id']);
					 $this->db->update('reset_password', $main_data1);
					 
					 $_SESSION['success_msg1'] = 'Password successfully reset...You can login now';
					$data['do_reset_password'] = 1; 
					$this->load->view( 'common/login_header',$data);
					$this->load->view('login/login_view');
					 //redirect('login');
				}else{
					//~ echo 'npm';
					//~ exit;
					$data['do_reset_password'] = 1; 
					$_SESSION['error_msg1'] = 'New Password Mismatch';
					$this->load->view( 'common/login_header',$data);
					$this->load->view('login/login_view');
				}
			}else{
				//~ echo 'npe';
					//~ exit;
				$data['do_reset_password'] = 1; 
				$_SESSION['error_msg1'] = 'New Password is empty';
				$this->load->view( 'common/login_header',$data);
				$this->load->view('login/login_view');
			}
			
		 }
	}
    
     function randomNumber($length=0)
    {
		if(!$length){
			$length = 30;
		}
        $alphabet    = '1234567890abcdefghijklmnopqrstuvwxyz';
        $pass        = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $n      = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
    
    
    function logout(){
        $this->login_model->updateLog();
        $this->session->unset_userdata(SESSION_LOGIN.'logged_in');
        $this->session->unset_userdata(SESSION_LOGIN.'full_name');
        $this->session->unset_userdata(SESSION_LOGIN.'user_name');
        $this->session->unset_userdata(SESSION_LOGIN.'user_id');
        $this->session->unset_userdata(SESSION_LOGIN.'audit_record');
        $this->session->unset_userdata(SESSION_LOGIN.'user_group');
        $this->session->unset_userdata(SESSION_LOGIN.'user_permission');
		$this->session->unset_userdata(SESSION_LOGIN.'user_branch_id');
		$this->session->unset_userdata(SESSION_LOGIN.'branch_id');
        redirect('login');
    }
}
?>
