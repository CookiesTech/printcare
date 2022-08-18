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

function view_client_details(){

		$id = $_REQUEST['client_id'];
		$data['clients']         = $this->Common_model->getDetails('client', 'client_id', $id);
		
		$data['client_numbers']  = $this->Common_model->getDetails('client_contact_numbers', 'ref_client_id', $id);
		$data['client_emails']  = $this->Common_model->getDetails('client_email_ids', 'ref_client_id', $id);        
		
		echo $this->parser->parse('product_sample_request/ajax_product_sample_request_details_view', $data, true);
		exit;
	}

	function get_sample_request(){
	   $res_sample = $this->Common_model->getDetails('product_sample_request','product_sample_request_id',$_REQUEST['sample_id']);
	   $json = array();
	   if($res_sample){
	    $request_date = $this->Common_model->getDateFormat($res_sample[0]->product_sample_request_date);
	    if(empty($request_date))
	    $request_date = '';
	    $json[] = array(
	    'product_sample_request_id'	=> $res_sample[0]->product_sample_request_id,
	    'client_name'	=> $res_sample[0]->client_name,
	    'supplier_name'=> $res_sample[0]->supplier_name,
	    'product_name' => $res_sample[0]->product_name,
	    'quantity' => $res_sample[0]->product_sample_request_qty,
	    'request_date' => $request_date
		  ); 
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
	}
	
	function get_proforma_invoice(){
	   $res_proforma_invoice = $this->Common_model->getDetails('proforma_invoice','proforma_invoice_id',$_REQUEST['proforma_invoice_id']);
	   $json = array();
	   if(isset($res_proforma_invoice) && !empty($res_proforma_invoice)){
			$json = $res_proforma_invoice;
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
	}
	
	function update_proforma_invoice_status(){
	  $proforma_invoice_id =  $_POST['proforma_invoice_id'];
	  unset($_POST['proforma_invoice_id']);
	  $res_proforma_invoice = $this->Common_model->updateRecord('proforma_invoice',$_POST,$proforma_invoice_id);
	   $json = array();
	   if(isset($res_proforma_invoice) && !empty($res_proforma_invoice)){
			$json = 'true';
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
	}
	
	

	function get_sample_request_full_view(){
	     $res_sample = $this->Common_model->getDetails('product_sample_request','product_sample_request_id',$_REQUEST['sample_id']);
		//~ echo '<pre>';
		//~ print_r($res_sample);
		//~ exit;
	     $json = array();
	    $request_date = $this->Common_model->getDateFormat($res_sample[0]->product_sample_request_date);
	    if(isset($request_date)){
		$request_date = $request_date;
	    }
	    if($res_sample[0]->delivered_date != '0000-00-00 00:00:00'){
		$dispatch_date = $this->Common_model->getDateFormat($res_sample[0]->dispatch_date);
	    }
	     if($res_sample[0]->dispatch_date != '0000-00-00 00:00:00'){
	    $delivered_date = $this->Common_model->getDateFormat($res_sample[0]->delivered_date);
	    }
	     if($res_sample[0]->installation_date != '0000-00-00 00:00:00'){
	    $installation_date = $this->Common_model->getDateFormat($res_sample[0]->installation_date);
	    }
	    if($res_sample[0]->reminder_date != '0000-00-00 00:00:00'){
	    $reminder_date = $this->Common_model->getDateFormat($res_sample[0]->reminder_date);
	    }
	     $json[] = array(
			'product_sample_request_id'	=> $res_sample[0]->product_sample_request_id,
			'client_name'	=> $res_sample[0]->client_name,
			'supplier_name'=> $res_sample[0]->supplier_name,
			'product_name' => $res_sample[0]->product_name,
			'quantity' => $res_sample[0]->product_sample_request_qty,
			'product_sample_request_details' => $res_sample[0]->product_sample_request_details,
			'request_date' => $request_date,
			'delivery_point' => $res_sample[0]->delivery_point_name,
			'dispatch_date' => $dispatch_date,
			'delivered_date' => $delivered_date,
			'installation_date' => $installation_date,
			'reminder_date' => $reminder_date,
			'feedback_name' => $res_sample[0]->feedback_name,
			'client_feedback' => $res_sample[0]->client_feedback,
			'status' => $res_sample[0]->product_request_status_name,
			'status_id' => $res_sample[0]->ref_product_request_status_id
	    ); 
		
		echo json_encode($json);
		exit;
	    }

	function update_sample_request(){
	   $data['product_sample_request_id'] = $_REQUEST['product_sample_request_id'];
	   $data['ref_delivery_point_id'] = $_REQUEST['ref_delivery_point_id'];
	   $data['dispatch_date'] = $_REQUEST['dispatch_date'];
	   $data['delivered_date'] = $_REQUEST['delivered_date'];
	   $data['installation_date'] = $_REQUEST['installation_date'];
	   $data['reminder_date'] = $_REQUEST['reminder_date'];
	   $data['ref_product_request_status_id'] = 2;
	   //unset($_REQUEST['product_sample_request_id']);
	   //~ echo '<pre>';
	   //~ print_r($pc_data);
	   //~ echo '</pre>';
	   $res = $this->Common_model->updateRecord('product_sample_request',$data,$data['product_sample_request_id']);
	   if($res){
		   $json = 'true';
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
	   
   }

   function update_feedback(){
	   $data['product_sample_request_id'] = $_REQUEST['product_sample_request_id'];
	   $data['client_feedback'] = $_REQUEST['feedback'];
	   $data['ref_feedback_id'] = $_REQUEST['feedback_id'];
	   $data['ref_product_request_status_id'] = 3;
	   $res = $this->Common_model->updateRecord('product_sample_request',$data,$data['product_sample_request_id']);
	   if($res){
		   $json = 'true';
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
   }

    function update_message_template()
    {
	$sms_template = $this->Common_model->getDetails('product_request_email_template', 'product_request_email_template_id', $_REQUEST['template_id']);
	$message_details = $this->Common_model->getDetails('product_sample_request','product_sample_request_id',$_REQUEST['sample_request_id']);
	$reg_date = $this->Common_model->getDateFormat($message_details[0]->product_sample_request_date);
	//~ echo "<pre>";
	//~ print_r($message_details);
	//~ echo "</pre>";
	//~ exit;
	$sms_template_content = $sms_template[0]->product_request_email_template_content;

        if (isset($sms_template_content) && !empty($sms_template_content)) {
            if (!empty($message_details[0]->product_sample_request_date)) {
                $sms_template_content = str_replace('{request_date}', '<b>' . $reg_date . '</b>', $sms_template_content);
            }
            if (!empty($message_details[0]->client_name)) {
                $sms_template_content = str_replace('{client_name}', '<b>' . $message_details[0]->client_name . '</b>', $sms_template_content);
            }
            if (!empty($message_details[0]->supplier_name)) {
                $sms_template_content = str_replace('{supplier_name}', '<b>' . $message_details[0]->supplier_name . '</b>', $sms_template_content);
            }
            if (!empty($message_details[0]->product_sample_request_qty)) {
                $sms_template_content = str_replace('{request_qty}', '<b>' . $message_details[0]->product_sample_request_qty . '</b>', $sms_template_content);
            }
            if (!empty($message_details[0]->product_name)) {
                $sms_template_content = str_replace('{product_name}', '<b>' . $message_details[0]->product_name . '</b>', $sms_template_content);
            }
            //~ if (!empty($_REQUEST['estimate'])) {
                //~ $sms_template_content = str_replace('{estimate}', '<b>' . $_REQUEST['estimate'] . '</b>', $sms_template_content);
            //~ }

            $sms_template_content = nl2br($sms_template_content);
            $sms_template_content = str_replace('{', '{<b>', $sms_template_content);
            $sms_template_content = str_replace('}', '</b>}', $sms_template_content);
            //$sms_template_content = str_replace('<br />','\n',$sms_template_content);
            echo $sms_template_content = json_encode($sms_template_content);
        }
	else
	{
            echo 'Template not available...';
        }
    }

    function send_email_notification(){

		$to_address = array();
		$email_additional = array();
		if(isset($_REQUEST['email'])){
			$to_address = $_REQUEST['email'];
		}		
		if(!empty($_REQUEST['email_additional'])){
			$email_additional = explode(',',$_REQUEST['email_additional']);
			$to_address = array_merge($to_address,$email_additional);
		}
		//$res_policy = $this->Common_model->getDetails('policy','policy_id',$_REQUEST['policy_id']); 
				
		$mail_data = array();
		$mail_data['from_address'] = FROM_ADDRESS;
		$mail_data['to_address'] = implode(',',$to_address);
		$mail_data['subject'] = $_REQUEST['email_subject']; 
		$mail_data['message'] = str_replace('&#10;','br>',$_REQUEST['email_message']); 		
		//$mail_data['name'] = $res_policy[0]->insurance_agency_name; 		
		//$mail_data['attachment'] = FCPATH.$res_policy[0]->policy_pdf_file;
		//$mail_data['template_path'] = 'template/email/policy_claim.php';
		//print_r($mail_data);	
		$res = $this->Common_model->sendEmail($mail_data,1);
				
		//~ $mail_history_data['ref_client_id'] = $_REQUEST['client_id'];
		//~ $mail_history_data['ref_advt_provider_id'] = $_REQUEST['advt_provider_id'];
		//~ $mail_history_data['subject'] = $_REQUEST['email_subject'];
		//~ if(isset($_REQUEST['email_message'])){
			//~ $mail_history_data['message'] = $_REQUEST['email_message'];
		//~ }
		//~ $mail_history_data['email'] = implode(',',$to_address);
		if($res){			
			//~ if($_REQUEST['type'] == 'revised'){
				//~ $update_data['release_order_send_status'] = 1; 
				//~ $this->Common_model->updateRecord('release_order_edited',$update_data,$_REQUEST['ro_id']);
			//~ }else{
				//~ $update_data['release_order_send_status'] = 1; 
				//~ $this->Common_model->updateRecord('release_order',$update_data,$_REQUEST['ro_id']);
			//~ }
			//~ $this->Common_model->addRecord('email_notification_history',$mail_history_data);
			$res = 'true';
		}else{
			$res = 'false';
		}
		echo json_encode($res);
		exit;
	}

	function get_supplier_email_details(){
	    if (isset($_REQUEST['id'])) {
            $result = $this->Common_model->getDetails($_REQUEST['table'], $_REQUEST['field'], trim($_REQUEST['id']));

            $json = array();
            if (isset($result) && !empty($result)) {
				foreach($result as $key => $val){
					$json[] = array(
						'supplier_id' =>$_REQUEST['id'],
						'email_id' =>$val->email_id
					);
				}
            }
            echo json_encode($json);
            exit;
        }
	}
	
	function get_client_email_details(){
	    if (isset($_REQUEST['id'])) {
            $result = $this->Common_model->getDetails($_REQUEST['table'], $_REQUEST['field'], trim($_REQUEST['id']));

            $json = array();
            if (isset($result) && !empty($result)) {
				foreach($result as $key => $val){
					$json[] = array(
						'client_id' =>$_REQUEST['id'],
						'email_id' =>$val->email_id
					);
				}
            }
            echo json_encode($json);
            exit;
        }
	}
	
	function get_product_list(){
		$where = "product.ref_supplier_id = '".$_REQUEST['ref_supplier_id']."'";
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
		
		$result_variety = $this->Common_model->getDetails('product_variety','ref_supplier_id',$_REQUEST['ref_supplier_id'],'product_variety_name','ASC');
		
		if (isset($result_variety) && !empty($result_variety)) {
			foreach($result_variety as $key => $val){
				$json['variety'][] = array(
					'product_variety_id' =>$val->product_variety_id,
					'product_variety_name' =>$val->product_variety_name					
				);
			}
		}
		
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
	
	function get_product_size_quality(){
		$result = $this->Common_model->getDetails('product_quality','ref_product_id',$_REQUEST['product_id'],'product_quality_name','ASC');
		$json = array();
		if (isset($result) && !empty($result)) {
			foreach($result as $key => $val){
				$json['quality'][] = array(
					'product_quality_id' =>$val->product_quality_id,
					'product_quality_name' =>$val->product_quality_name
				);
			}
		}
		
		$result = $this->Common_model->getDetails('product_quality_size','ref_product_id',$_REQUEST['product_id'],'product_quality_size_name','ASC');
		if (isset($result) && !empty($result)) {
			foreach($result as $key => $val){
				$json['size'][] = array(
					'product_quality_size_id' =>$val->product_quality_size_id,
					'product_quality_size_name' =>$val->product_quality_size_name
				);
			}
		}
		echo json_encode($json);
		exit;
	}
	
	function get_product_size(){
		$where = 'product.product_name="'.trim($_REQUEST['product_name']).'" AND product.ref_product_quality_id = "'.$_REQUEST['quality_id'].'"';
		
		$result = $this->Common_model->getRecords('product',$where);
		
		$json = array();
		if (isset($result) && !empty($result)) {
			foreach($result as $key => $val){
				$json['size'][] = array(
					'product_quality_size_id' =>$val->ref_product_quality_size_id,
					'product_quality_size_name' =>$val->product_quality_size_name,
					
				);
			}
		}
		echo json_encode($json);
		exit;
	}
	
	function get_product(){
		$product = array();
				
		$result = $this->Common_model->getDetails('product','product_id',$_REQUEST['product_id']);		
				
		if (isset($result) && !empty($result)) {
			$product[] = array(
				'product_id'	=> $result[0]->product_id,
				'product_name'	=> $result[0]->product_name,
				'product_price'	=> $result[0]->product_price,
				'gst_type_name'	=> $result[0]->gst_type_name,
				'sku'	=> $result[0]->sku,
				//'quantity'	=> $result[0]->quantity,
				'quantity'=>$this->Common_model->get_product_qty($result[0]->product_id),
				'expiry_date'	=> getDateFormat($result[0]->expiry_date),
				'reorder_level'	=> $result[0]->reorder_level,
				'supplier_comm_perc'	=> $result[0]->supplier_comm_perc
			);
			echo json_encode($product);
		}else{
			echo json_encode('false');
		}
		exit;
	}
	
	  function add_product(){
		  print_r($_REQUEST);
	   $res = $this->Common_model->addRecord('product',$_REQUEST);
	   if($res){
		   $json = 'true';
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
   }
   

}
?>
