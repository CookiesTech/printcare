<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            //'Client_model'
        ));
    }

function view_supplier_details(){
		$id = $_REQUEST['agent_id'];
		$data['suppliers']         = $this->Common_model->getDetails('supplier', 'supplier_id', $id);
		//~ echo '<pre>';
		//~ print_r($data['suppliers']);
		//~ echo '</pre>';
		//~ exit;
		$data['supplier_numbers']  = $this->Common_model->getDetails('supplier_contact_numbers', 'ref_supplier_id', $id);
		$data['suppliers_emails']  = $this->Common_model->getDetails('supplier_email_ids', 'ref_supplier_id', $id);        
		//$data['clients_calls']   = $this->Common_model->getDetails('client_calls', 'ref_client_id', $id,'client_call_date_and_time','DESC');
		//$data['clients_apps']    = $this->Common_model->getDetails('client_appointments', 'ref_client_id', $id,'appointment_process_date','DESC');
		//$data['client_remark']   = $this->Common_model->getDetails('client_remark', 'ref_client_id', $id);
		//$data['client_visit']   = $this->Common_model->getDetails('client_visit', 'ref_client_id', $id,'client_visit_date','DESC');
		
		echo $this->parser->parse('supplier/ajax_supplier_details_view', $data, true);
		exit;
	}

	}
?>
