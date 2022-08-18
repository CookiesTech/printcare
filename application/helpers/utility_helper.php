<?php

function asset_url(){

   return base_url().'assets/';

}



function debug($data){

	echo '<pre>';

	print_r($data);

	echo '</pre>';

}



function getDateFormat($date){

	if(!empty($date) && $date !='0000-00-00' && $date!='1970-01-01'){

		return date('d-m-Y',strtotime($date));

	}else{

		return false;

	}  

}



function getDateTimeFormat($date){

	if($date !='' && $date !='0000-00-00 00:00:00' && $date !='1970-01-01 00:00:00' && $date !='1970-01-01 05:30:00'){

		return date('d-m-Y H:i',strtotime($date));

	}else{

		return false;

	}  

}



function getTimeFormat($time){

	if($time !='' && $time !='00:00:00' && $time !='01:00:00'){

		return date('h:i a',strtotime($time));

	}else{

		return false;

	}  

	}

	
function send_otp($mobile){
	$curl = curl_init();
	$request = SMS_API_URL_TEMPLATE_1;
	$request = str_replace('{MOBILE}',$mobile,$request);
	//$request = str_replace('{MESSAGE}',$message,$request);
	//echo $request; exit;
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $request,
	 
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_POSTFIELDS => "",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  return $err;
	} else {
	  return $response;
	}

}


?>

