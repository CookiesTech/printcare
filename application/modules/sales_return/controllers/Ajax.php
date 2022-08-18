<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Invoice_model'
        ));
    }

    function remove_invoice_product(){
    	$inv_item_id = trim($this->input->post('inv_item_id'));
    	$invoice_item_details = $this->Common_model->getDetails('invoice_particulars',' invoice_particulars_id',$inv_item_id);
    	$qty = 0;
    	if(isset($invoice_item_details) && !empty($invoice_item_details)){
    		$qty = $invoice_item_details[0]->qty;
    		$res1 = $this->Invoice_model->update_product_quantity($invoice_item_details[0]->ref_product_id,$qty,'add');
            $res2 = $this->Invoice_model->update_product_batch_quantity($invoice_item_details[0]->ref_product_batch_id,$qty,'add');
    	}
    	if($res1 && $res2){
    		$this->Common_model->removeRecord('invoice_particulars',' invoice_particulars_id',$inv_item_id);
    		$json = true;
    	}else{
    		$json = false;
    	}
    	echo json_encode(trim($json));
    	exit;
    	//debug($invoice_item_details);
    }

    function update_invoice_item_batch(){
    	$inv_item_id = trim($this->input->post('inv_item_id'));
    	$batch_id = trim($this->input->post('batch_id'));
    	$res = $this->Common_model->updateRecord('invoice_particulars',array('ref_product_batch_id' => $batch_id),$inv_item_id);
    	
    	if($res ){    
    		$json = true;
    	}else{
    		$json = false;
    	}
    	echo json_encode(trim($json));
    	exit;
    }

    function get_invoice_details(){		
		$invoice_id = trim($this->input->post('invoice_id'));
		$data['invoice_details'] = $this->Common_model->getDetails('invoice','invoice_id',$invoice_id);
		//debug($data); exit;
		$this->load->library('parser');
        echo $html = $this->parser->parse('template/html/invoice_details_tmp', $data);
        //exit;
		/*if($res_client_calls){
			$res = $res_client_calls;
		}else{
			$res = 'fail';
		}*/
		//echo json_encode($res);
		exit;
	}


	function view_client_details(){

		$id = $_REQUEST['client_id'];
		$data['clients']         = $this->Common_model->getDetails('client', 'client_id', $id);
		
		$data['client_numbers']  = $this->Common_model->getDetails('client_contact_numbers', 'ref_client_id', $id);
		$data['client_emails']  = $this->Common_model->getDetails('client_email_ids', 'ref_client_id', $id);        
		
		echo $this->parser->parse('product_sample_request/ajax_product_sample_request_details_view', $data, true);
		exit;
	}

	function get_purchase_order(){
	   $result = $this->Common_model->getDetails('purchase_order','purchase_order_id',$_REQUEST['purchase_order_id']);
	   $json = array();
	   if(isset($result)){
			$purchase_order_date = $this->Common_model->getDateFormat($result[0]->purchase_order_date);
			$json[] = array(
				'purchase_order_id'	=> $result[0]->purchase_order_id,
				'purchase_order_code'	=> $result[0]->purchase_order_code,
				'client_name'	=> $result[0]->client_name,
				'supplier_name'=> $result[0]->supplier_name,
				'purchase_order_date' => $purchase_order_date
			); 
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
	    }

	
	function update_payment_details(){
		//~ echo '<pre>';
		//~ print_r($_REQUEST);
		//~ echo '</pre>';
		//~ exit;
		
	   
	   if($_REQUEST['invoice_payment_status']){
			$u_data['invoice_payment_status'] = 1;
			$res = $this->Common_model->updateRecord('purchase_order',$u_data,$_REQUEST['purchase_order_id']);
		}
	   $res_invoice = $this->Common_model->getRecord('invoice','ref_purchase_order_id',$_REQUEST['purchase_order_id']);	
	   $data['ref_invoice_id'] = $res_invoice[0]->invoice_id;
	   $data['invoice_payment_details'] = $_REQUEST['invoice_payment_details'];
	   $data['invoice_payment_date'] = $_REQUEST['invoice_payment_date'];
	   $data['invoice_payment_amount'] = $_REQUEST['invoice_payment_amount'];
	   $res = $this->Common_model->addRecord(' invoice_payment_history',$data);
	   if($res){
		   $json = 'true';
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
	   
   }
   
   function update_commission_details(){
	   if($_REQUEST['invoice_commission_status']){
			$u_data['invoice_commission_status'] = 1;
			$res = $this->Common_model->updateRecord('purchase_order',$u_data,$_REQUEST['purchase_order_id']);
		}
	   $res_invoice = $this->Common_model->getRecord('invoice','ref_purchase_order_id',$_REQUEST['purchase_order_id']);	
	   $data['ref_invoice_id'] = $res_invoice[0]->invoice_id;
	   $data['invoice_commission_details'] = $_REQUEST['invoice_commission_details'];
	   $data['invoice_commission_date'] = $_REQUEST['invoice_commission_date'];
	   $data['invoice_commission_amount'] = $_REQUEST['invoice_commission_amount'];
	   $res = $this->Common_model->addRecord(' invoice_commission_history',$data);
	   
	   if($res){
		   $json = 'true';
	   }else{
			$json = 'false';
		}
		echo json_encode($json);
		exit;
	   
   }
   
  function get_invoice_commission_history(){
	  $res_invoice = $this->Common_model->getRecord('invoice','ref_purchase_order_id',$_REQUEST['purchase_order_id']);	
	  
	  $res_commission_history = $this->Common_model->getDetails('invoice_commission_history','ref_invoice_id',$res_invoice[0]->invoice_id);
	  echo ' <table class="table color-table muted-table ">
                        <thead>
                           <tr>
								<th align="center" width="10%">S.No</th>
								<th align="left" width="20%">Date</th>								
								<th align="left" width="55%">Details</th>
								<th align="right" width="15%">Amount</th>
							</tr>
						</thead>
						<tbody>';
	$i = 1;
	$total = 0;					
	  if(isset($res_commission_history) && !empty($res_commission_history)){
		  foreach($res_commission_history as $key => $val){
			    $total+= $val->invoice_commission_amount;
				echo '<tr>
					<td align="center">'.$i.'</td>
					<td align="left">'.$this->Common_model->getDateFormat($val->invoice_commission_date).'</td>
					<td align="left">'.$val->invoice_commission_details.'</td>
					<td align="right">'.number_format($val->invoice_commission_amount).'</td>
				</tr>';		
							
			$i++;	
		  }
	  }else{
		  echo '<tr><td colspan="4" align="center">No records found...</td></tr>';
	  }
	  echo '<tr><th colspan="3" align="right"><b>Total</b></th><th align="right">'.number_format($total).'</th></tr>';
	  echo '</tbody>		
						</table>
                           ';
  }
  
  function get_invoice_payment_history(){
	  $res_invoice = $this->Common_model->getRecord('invoice','ref_purchase_order_id',$_REQUEST['purchase_order_id']);	
	  
	  $res_payment_history = $this->Common_model->getDetails('invoice_payment_history','ref_invoice_id',$res_invoice[0]->invoice_id);
	  echo ' <table class="table color-table muted-table ">
                        <thead>
                           <tr>
								<th align="center" width="10%">S.No</th>
								<th align="left" width="20%">Date</th>								
								<th align="left" width="55%">Details</th>
								<th align="right" width="15%">Amount</th>
							</tr>
						</thead>
						<tbody>';
	$i = 1;
	$total = 0;					
	  if(isset($res_payment_history) && !empty($res_payment_history)){
		  foreach($res_payment_history as $key => $val){
			    $total+= $val->invoice_payment_amount;
				echo '<tr>
					<td align="center">'.$i.'</td>
					<td align="left">'.$this->Common_model->getDateFormat($val->invoice_payment_date).'</td>
					<td align="left">'.$val->invoice_payment_details.'</td>
					<td align="right">'.number_format($val->invoice_payment_amount).'</td>
				</tr>';		
							
			$i++;	
		  }
	  }else{
		  echo '<tr><td colspan="4" align="center">No records found...</td></tr>';
	  }
	  echo '<tr><th colspan="3" align="right"><b>Total</b></th><th align="right">'.number_format($total).'</th></tr>';
	  echo '</tbody>		
						</table>
                           ';
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

    function update_message_template(){
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
        }else{
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
	
	
	function get_supplier_product_list(){

		$data['product_list']         = $this->Common_model->getDetails('product', 'ref_supplier_id',$_REQUEST['id']);
		
		echo $this->parser->parse('purchase_order/ajax_supplier_product_details_view', $data, true);
		exit;
	}

}
?>
