<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Access_denied extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $session_data       = $this->session->userdata(SESSION_LOGIN.'logged_in');
        $data['username']   = $session_data['username'];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN.'user_permission');

        $this->load->view('common/header', $data);
    }
    
	function hasPermission($page)
    {
        $res_permission = $this->session->userdata(SESSION_LOGIN.'user_permission');
        if ($res_permission && !empty($res_permission)) {
            if (!in_array($page, $res_permission)) {
                redirect('access_denied', 'refresh');
            }
        } else {
            redirect('home');
        }
    }
    
    function index()
    {
        //$this->load->view('common/header');
        $this->load->view('common/menu');
        $this->load->view('errors/access_denied');
        $this->load->view('common/footer');
    }
    
    
}
?>
