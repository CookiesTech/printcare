<?php
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    function index() {
        if ( $this->session->userdata( 'logged_in' ) ) {
            $session_data       = $this->session->userdata( 'logged_in' );
            $data[ 'username' ] = $session_data[ 'username' ];
            $this->load->view( 'common/header' );
            $this->load->view( 'common/menu' );
            $this->load->view( 'home_view', $data );
            $this->load->view( 'common/footer' );
        } else {
            $this->load->helper( array(
                 'form' 
            ) );
            $this->load->view( 'common/header' );
            $this->load->view( 'login/login_view' );
            $this->load->view( 'common/footer' );
        }
    }
}
?>
