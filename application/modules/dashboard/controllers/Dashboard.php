<?php
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
class Dashboard extends CI_Controller
  {
    function __construct()
      {
        parent::__construct();
        
         
        $this->load->model( array(
            'Dashboard_model'
        ) );
       
        $session_data = $this->session->userdata( SESSION_LOGIN . 'logged_in' );	
        //debug($session_data); exit;
        $data['username'] = $session_data['username'];
        $data['permission'] = $this->session->userdata( SESSION_LOGIN . 'user_permission' );
        $data['user'] = $this->Common_model->getDropdownList( 'user' );
        $data['title'] = 'Dashboard';
       
        $this->load->view( 'common/header', $data );
     
       // echo $this->output->enable_profiler(TRUE);  
      }
    function hasPermission( $page )
      {
        $res_permission = $this->session->userdata( SESSION_LOGIN . 'user_permission' );
      
        if ( $res_permission && !empty( $res_permission ) )
          {
            if ( !in_array( $page, $res_permission ) )
              {
                redirect( 'access_denied', 'refresh' );
              }
          }
        else
          {
            redirect( 'home' );
          }
      }

      
    function index()
      {
        $this->hasPermission( 'dashboard_view' );

       $data['test'] = '';
      //debug($data['appointment_list']); exit;       
		    //debug($data['expiry_product_list']); exit;
        $this->load->view( 'common/menu' );
        $this->load->view( 'dashboard/dashboard_list', $data );
        $this->load->view( 'common/footer' );
      }
     
        
  }
?>
