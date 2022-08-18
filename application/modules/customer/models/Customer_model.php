<?php
Class Customer_model extends CI_Model {    
	private $menu_html;
	 public function __construct() {
        parent::__construct();
        $this->menu_html = '';
    }
    function getFieldItemExist($data,$table,$parent=0) {
		
		if($table == 'business_category'){
			$query = $this->db->query( "SELECT ".$table."_id AS id,".$table."_name AS name FROM ".$table." WHERE ".$table."_name = '".$data."' AND ".$table."_parent_id = '".$parent."'" );
		}
		else{
			$query = $this->db->query( "SELECT ".$table."_id AS id, ".$table."_name AS name FROM ".$table." WHERE ".$table."_name = '".$data."'" );
		}
        if ( $query->num_rows() >= 1 ) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    
     function getFieldItem($table) {
			$query = $this->db->query( "SELECT ".$table."_id AS id, ".$table."_name AS name FROM ".$table."" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
        
    
    function addRecord($main_table, $data, $customer_id = 0)
    {

		 if(isset($data['tbl_client_product']) && !empty($data['tbl_client_product'])){
			if(!isset($data['tbl_client_product'][1]['ref_product_id']) && empty($data['tbl_client_product'][1]['ref_product_id'])){
				unset($data['tbl_client_product']);
			}
		}
		if(isset($data['tbl_client_website']) && !empty($data['tbl_client_website'])){
			if(empty($data['tbl_client_website'][1]['website_url'])){
				unset($data['tbl_client_website']);
			}
		}
		
		
		$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $date    = date('Y-m-d H:i:s');
        foreach ($data as $key => $value) {
            if ($this->Common_model->startsWith($key, 'tbl_')) {
                $table_new                  = str_replace('tbl_', '', $key);
                $sub_table_data[$table_new] = $value;
            } else {
                if (strpos($key, '_date') !== false ) {
                    $date_field      = date("Y-m-d H:i:s", strtotime($data[$key]));
                    $main_data[$key] = $date_field;
                } else {
                    $main_data[$key]         = $value;
					if($main_table != 'client'){
						$main_data['ref_user_id']    = $user_id;
					}
                    $main_data['added_date'] = $date;
                }
            }
        }
        $this->db->insert($main_table, $main_data);
        $last_id = $this->db->insert_id();
        if (isset($sub_table_data) && !empty($sub_table_data)) {
            foreach ($sub_table_data as $key => $value1) {
                $new_table = $key;
                foreach ($value1 as $key => $value) {
                    $value['ref_'.$main_table.'_id'] = $last_id;
                    $value['ref_user_id']    = $user_id;
                    $value['added_date'] = $date;
                    //$value['table_name'] = $main_table;
                    $new_data            = $value;
                    //echo $value['valid_upto'];
                   // echo '<br>';
                    if($new_table == 'client_product'){
						$new_data['valid_upto'] = date("Y-m-d H:i:s", strtotime($value['valid_upto']));
						$new_data['creation_date'] = date("Y-m-d H:i:s", strtotime($value['creation_date']));
					}
                    $this->db->insert($new_table, $new_data);
                }
            }
        }
       // exit;
        return $last_id;
    }
   
    function addRecord_old( $data,$client_id = 0 ) {
		//~ echo "<pre>";
			//~ print_r( $data);
			//~ echo "</pre>";
			//~ exit;
		$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
		$data_collection_date = date("Y-m-d H:i:s", strtotime($data['client_data_collection_date_and_time']));
		
		if(!empty($data['client_referred_date'])){
			$refered_date = date("Y-m-d H:i:s", strtotime($data['client_referred_date']));
		}else{
			$refered_date = '0000-00-00';
		}
		$date = date('Y-m-d H:i:s');
		if(isset($data['client_data_source_others'])){
			$data_source_others = $data['client_data_source_others'];
		}else{
			$data_source_others = '';
		}
		
		 $query = $this->db->query( "INSERT INTO client SET 
				client_data_collection_date_and_time = '".$data_collection_date."',
				ref_data_source_id = '".$data['ref_data_source_id']."',
				client_data_source_others = '".str_replace("'","",$data_source_others)."',
				client_data_source_link = '".str_replace("'","",$data['client_data_source_link'])."',
				ref_client_business_category_id = '".$data['ref_client_business_category_id']."',
				ref_client_business_sub_category_id = '".$data['ref_client_business_sub_category_id']."',
				ref_salutation_id = '".$data['ref_salutation_id']."',
				client_name = '".str_replace("'","",$data['client_name'])."',
				client_address_line1 = '".str_replace("'","",$data['client_address_line1'])."',
				client_address_line2 = '".str_replace("'","",$data['client_address_line2'])."',
				client_address_line3 = '".str_replace("'","",$data['client_address_line3'])."',
				ref_area_id = '".$data['ref_area_id']."',
				ref_state_id = '".$data['ref_state_id']."',
				ref_country_id = '".$data['ref_country_id']."',
				ref_district_id = '".$data['ref_district_id']."',
				client_pincode = '".str_replace("'","",$data['client_pincode'])."',
				client_referred_date = '".$refered_date."',
				client_referred_by = '".str_replace("'","",$data['client_referred_by'])."',
				ref_user_id = '".$user_id."',
				added_date = '".$date."'");
        $last_id = $this->db->insert_id();
        
        if(isset($data['tbl_client_contact_numbers'])){
			
			//$this->db->query( " DELETE FROM client_contact_numbers WHERE ref_client_id = '".$client_id."'" );
			$client_contact_numbers = array();
			$client_contact_numbers = $data['client_contact_numbers'];
			foreach( $client_contact_numbers as $key => $contact_number){
				if($key !='primary_contact'){
					if(isset($data['client_contact_numbers']['primary_contact']) && $key == $data['client_contact_numbers']['primary_contact']){
						$primary_contact = '1';
					}else{
						$primary_contact = '0';
					}
					
					$this->db->query( "INSERT INTO client_contact_numbers SET 
							ref_client_id = '".$last_id."',
							primary_contact = '".$primary_contact."',
							contact_person = '".str_replace("'","",$contact_number['contact_person'])."',
							ref_designation_id = '".$contact_number['ref_designation_id']."',
							mobile_or_phone_or_whatsapp = '".$contact_number['mobile_or_phone_or_whatsapp']."',
							std_code = '".str_replace("'","",$contact_number['std_code'])."',
							contact_number = '".str_replace(" ","",$contact_number['contact_number'])."',
							contact_extension = '".str_replace("'","",$contact_number['contact_extension'])."',
							contact_timing_from = '".str_replace("'","",$contact_number['contact_timing_from'])."',
							contact_timing_to = '".str_replace("'","",$contact_number['contact_timing_to'])."',
							ref_user_id = '".$user_id."',
							added_date = '".$date."'");
				}
			}
		}
	
		if(isset($data['tbl_client_email_ids'])){
			//$this->db->query( " DELETE FROM client_email_ids WHERE ref_client_id = '".$client_id."'" );
			foreach($data['client_email_ids'] as $key => $client_email_ids){
				if($key !='primary_contact'){
					if(isset($data['client_email_ids']['primary_contact']) &&$key == $data['client_email_ids']['primary_contact']){
							$primary_contact = '1';
					}else{
						$primary_contact = '0';
					}
					
					$this->db->query( "INSERT INTO  client_email_ids SET 
						ref_client_id = '".$last_id."',
						primary_contact = '".$primary_contact."',
						contact_person = '".str_replace("'","",$client_email_ids['contact_person'])."',
						ref_designation_id = '".$client_email_ids['ref_designation_id']."',
						email_id = '".str_replace("'","",$client_email_ids['email'])."',
						ref_user_id = '".$user_id."',
						added_date = '".$date."'");
				}
			}
		}
		
		if(isset($data['tbl_client_website'])){
			//$this->db->query( " DELETE FROM client_website WHERE ref_client_id = '".$client_id."'" );
			foreach($data['tbl_client_website'] as $key => $client_website){					
					$this->db->query( "INSERT INTO  client_website SET 
						ref_client_id = '".$last_id."',
						website_url = '".$client_website['website_url']."',
						responsive_status = '".$client_website['responsive_status']."',
						website_type = '".$client_website['website_type']."',
						admin_url = '".$client_website['admin_url']."',
						superadmin_password = '".$client_website['superadmin_password']."',
						webadmin_password = '".$client_website['webadmin_password']."',
						ref_user_id = '".$user_id."',
						added_date = '".$date."'");
				//}
			}
		}
		if(isset($data['tbl_client_product'])){
			
			//$this->db->query( " DELETE FROM client_website WHERE ref_client_id = '".$client_id."'" );
			foreach($data['tbl_client_product'] as $key => $client_product){					
					$this->db->query( "INSERT INTO  client_product SET 
						ref_client_id = '".$last_id."',
						ref_product_id = '".$client_product['ref_product_id']."',
						creation_date = '".date('Y-m-d',strtotime($client_product['creation_date']))."',
						valid_upto = '".date('Y-m-d',strtotime($client_product['valid_upto']))."',
						ref_user_id = '".$user_id."',
						added_date = '".$date."'");
				//}
			}
		}
        return $last_id;
    }
    
    function addClientCall( $data ) {
		$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
		//$date_time = date("Y-m-d H:i:s");
		$call_duration = $data[2];
		$tot_sec = 0;
		if (strpos($call_duration,'min') !== false) {
			$min_sec = str_replace(' min','',$call_duration);
			$min = explode(':',$min_sec);
			$tot_sec = $min[0] * 60 + $min[1];
		}
		if (strpos($call_duration,'sec') !== false) {
			$tot_sec = str_replace(' sec','',$call_duration);
		}
		
		 $call_date = date("Y-m-d H:i:s", strtotime(" -$tot_sec seconds"));
		
		if(isset($data[7]) && !empty($data[7])){
			$reaminder_date = date("Y-m-d H:i:s", strtotime($data[7]));
		}else{
			$reaminder_date = '';
		}
		$date = date('Y-m-d H:i:s');	
        $query = $this->db->query( "INSERT INTO client_calls SET ref_client_id = '".$data[0]."',client_call_date_and_time = '".$call_date."',client_call_duration = '".$data[2]."',ref_client_call_not_connected_id = '".$data[3]."',ref_client_call_feedback_id = '".$data[4]."',client_call_comments = '".$data[5]."',client_call_reminder = '".$data[6]."',ref_client_call_purpose_id = '".$data[8]."',contact_number = '".$data[9]."',client_call_reminder_date = '".$reaminder_date."',delete_status = 0, ref_user_id = '".$user_id."',transaction_id = 0, added_date = '".$date."'" );
        return $this->db->insert_id();
    }
    
    function updateClientCall( $data ) {
/*
		$last_id = $this->addClientCall( $data );      
        $query = $this->db->query( "UPDATE client_calls SET transaction_id = '".$last_id."' WHERE client_call_id = '".$data[10]."'");
		return $last_id;
*/
			
		$main_data['ref_client_id'] = $data[0];
        $main_data['ref_client_call_purpose_id'] = $data[8];
        $main_data['ref_client_call_not_connected_id'] = $data[3];
        $main_data['ref_client_call_feedback_id'] = $data[4];
        $main_data['client_call_reminder'] = $data[6];
        if(isset($data[6]) && !empty($data[6])){
			$main_data['client_call_reminder_date'] = date('Y-m-d H:i:s',strtotime($data[7]));
		}else{
			$main_data['client_call_reminder_date'] = '';
		}
       
        $main_data['client_call_comments'] = $data[5];

        $this->db->where( 'client_call_id', $data[10]);
        $this->db->update('client_calls', $main_data);
        return $data[10];
        
    }
   
   function addClientAppointment( $data ) {
		$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
		//$originalDate = "2010-03-21";
		$process_date = date("Y-m-d H:i:s");
		$visit_date = date("Y-m-d H:i:s", strtotime($data[2]));
		if(isset($data[6]) && !empty($data[6])){
			$confirm_date = date("Y-m-d H:i:s", strtotime($data[6]));
		}else{
			$confirm_date = '';
		}
		$date = date('Y-m-d H:i:s');	
        $query = $this->db->query( "INSERT INTO client_appointments SET ref_client_id = '".$data[0]."',appointment_process_date = '".$process_date."',appointment_visit_date = '".$visit_date."',appointment_address = '".$data[3]."',appointment_landmark = '".$data[4]."',appointment_to_confirm = '".$data[5]."',appointment_to_confirm_date = '".$confirm_date."',ref_employee_id = '".$data[7]."',ref_appointment_feedback_id = '".$data[8]."',appointment_comments = '".$data[9]."', delete_status = 0, ref_user_id = '".$user_id."',added_date = '".$date."'" );
        
        return $this->db->insert_id();
    }
    
    function updateClientAppointment( $data ) {
		$last_id = $this->addClientAppointment($data);
		$query = $this->db->query( "UPDATE client_appointments SET transaction_id = '".$last_id."' WHERE client_appointment_id = '".$data[10]."'");
        return $last_id;
    }
    

	function getClientCall($id){
		 $query = $this->db->query( "SELECT * FROM client_calls WHERE client_call_id = '".$id."'" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	
	function getClientAppointment($id){
		 $query = $this->db->query( "SELECT * FROM client_appointments WHERE client_appointment_id = '".$id."'" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	 function getClientAppointmentList(){
		  $query = $this->db->query( "SELECT 
										la.*,
										l.client_name,
										e.employee_name,
										af.appointment_feedback_details 
									FROM client_appointments as la 
									LEFT JOIN client as l ON l.client_id = la.client_id
									LEFT JOIN employee AS e ON e.employee_id = la.employee_id
									LEFT JOIN appointment_feedback AS af ON af.appointment_feedback_id = la.appointment_feedback_id
									WHERE la.transaction_id = 0 AND la.delete_status = 0
									" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	
    //~ function updateClient( $data, $id ) {
			//~ echo "<pre>";
		//~ print_r($data);
		//~ echo "</pre>";
		//~ exit;
		//~ $last_id = $this->addClient($data,$id);
		//~ $this->db->where('client_id', $id);
		//~ $this->db->update('client', array('transaction_id'=>$last_id));
		//~ $this->db->where('ref_client_id', $id);
		//~ $this->db->update('client_calls', array('ref_client_id'=>$last_id));
		//~ $this->db->where('ref_client_id', $id);
		//~ $this->db->update('client_appointments', array('ref_client_id'=>$last_id));
        //~ return $last_id;
    //~ }

	
	function updateClient($main_table, $data, $id ) { 
		
        $user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $date = date('Y-m-d H:i:s');
        foreach ($data as $key => $value) {
            if ($this->Common_model->startsWith($key, 'tbl_')) {
                $table_new                  = str_replace('tbl_', '', $key);
                $sub_table_data[$table_new] = $value;
            } else {
                if (strpos($key, '_date') !== false) {
                    $date_field      = date("Y-m-d H:i:s", strtotime($data[$key]));
                    $main_data[$key] = $date_field;
                } else {
                    $main_data[$key]         = $value;
					if($main_table != 'client'){
						$main_data['ref_user_id']    = $user_id;
					}
                    $main_data['added_date'] = $date;
                }
            }
        }
		
        //update Current record 
        $this->db->where($main_table.'_id', $id);
        $this->db->update($main_table, $main_data);
		
		$this->Common_model->dataBackup('client_backup',$main_table,$id);
		
		// Sub table data insertion - Mobile number and Email ids
		if(isset($sub_table_data) && !empty($sub_table_data)){
			foreach ($sub_table_data as $key => $value) {
				$this->db->where('ref_'.$main_table.'_id', $id);
				$this->db->update($key, array('delete_status' => 1));
				$new_table = $key;
				foreach ($value as $key => $value) {
					$value['ref_'.$main_table.'_id'] = $id;
					//$value['table_name'] = $main_table;
					$value['ref_user_id'] = $user_id;
					$value['added_date'] = $date;
					$new_data = $value;
					if($new_table == 'client_product'){
						$new_data['creation_date'] = date("Y-m-d H:i:s", strtotime($new_data['creation_date']));
						$new_data['valid_upto'] = date("Y-m-d H:i:s", strtotime($new_data['valid_upto']));
					}
					$this->db->insert($new_table, $new_data);
					//echo $this->db->last_query();
				}
			}
		}
		//exit;
		// Ends here
		return $id;
        
    }
    
	function addFieldItem($data,$table,$parent){
		$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
		$date = date('Y-m-d H:i:s');
		if($table == 'business_category'){
			$query = $this->db->query( "INSERT INTO ".$table." set ".$table."_name = '".$data."' , ".$table."_parent_id ='".$parent."',ref_user_id = '".$user_id."', added_date = '".$date."'" );
		}
		else{
			$query = $this->db->query( "INSERT INTO ".$table." set ".$table."_name = '".$data."',ref_user_id = '".$user_id."', added_date = '".$date."'" );
		}
        return $this->db->insert_id();
	} 
	
	function parentCheck($cat_id){
		$sql = "select product_parent_id from product where product_id=$cat_id";
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
			
			$res = $query->result();
			//echo $res[0]->product_parent_id;
			return $res[0]->product_parent_id;
		}else{
			return false;
		}
	}
	function hasParent($cat_id) {
		$rec_count = 1;
		do {
			$result = $this->parentCheck($cat_id);
			$rec_count++;
			$cat_id = $result;
		}while($result);
		return $rec_count;
	} 
	
	
	
	function render_menu($parent_id,$product_id){
		$sql = "select * from product where product_parent_id=$parent_id";
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
			foreach( $query->result() as $key=> $val){
				if($parent_id == 0)
				$this->menu_html.="<option value='".$val->product_id."'>".$val->product_name."</option>";
			else {
				 $rec_count = $this->hasParent($val->product_id);
				$space = '';
				for($i = 0; $i < $rec_count; $i++ ) {
					$space .= '&nbsp;&nbsp;';
				}
				if($val->product_id == $product_id){
					$this->menu_html.="<option value='".$val->product_id."' selected>".$space."--".$val->product_name."</option>";
				}else{
					$this->menu_html.="<option value='".$val->product_id."'>".$space."--".$val->product_name."</option>";
				}
				$space = '';
			}	
			$this->render_menu($val->product_id,$product_id);
			$this->menu_html.="</option>";
			
			}
			
			return $this->menu_html;
		} else {
			return false;
		}				
		
	}
			
	function getProductList($product_id=0){
		$this->menu_html = "";
		$category = $this->render_menu(0,$product_id);
		return $category; 
		
	}
	function getClientCallsByDate($call_date,$client,$date,$type=''){		
		//echo $type;
		if($type == 'month'){
			$sql = "SELECT  cc.ref_client_id,client_call_duration As duration FROM client_calls AS cc
			WHERE DATE_FORMAT(cc.client_call_date_and_time, '%m-%Y') = '".$date."' AND cc.ref_client_id = '".$client."' AND cc.client_call_date_and_time = '".$call_date."' AND cc.delete_status = 0 AND cc.transaction_id = 0";
		}else{
			$sql = "SELECT  cc.ref_client_id,client_call_duration As duration FROM client_calls AS cc
			WHERE DATE_FORMAT(cc.client_call_date_and_time, '%m-%Y') = '".$date."' AND cc.ref_client_id = '".$client."' AND cc.client_call_date_and_time = '".$call_date."' AND cc.delete_status = 0 AND cc.transaction_id = 0";
		}
		//echo $sql;
		//exit;
		$query = $this->db->query($sql);
		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function getCallsDate($client,$date){		
		$sql = "SELECT cc.ref_client_id,cc.client_call_date_and_time FROM client_calls AS cc
		LEFT JOIN client As c ON c.client_id = cc.ref_client_id
		WHERE DATE_FORMAT(cc.client_call_date_and_time, '%m-%Y') = '".$date."' AND cc.ref_client_id ='".$client."' AND cc.delete_status = 0 AND cc.transaction_id = 0 ORDER BY cc.client_call_date_and_time DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function getMonthFromCallsReport($client){		
		$sql = "SELECT DATE_FORMAT(cc.client_call_date_and_time, '%M-%Y') as month FROM client_calls AS cc
		LEFT JOIN client As c ON c.client_id = cc.ref_client_id
		WHERE cc.ref_client_id ='".$client."' AND cc.delete_status = 0 AND cc.transaction_id = 0 GROUP BY DATE_FORMAT(cc.client_call_date_and_time, '%M-%Y') ORDER BY DATE_FORMAT(cc.client_call_date_and_time, '%Y') DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function getClientList(){
		$sql   = "SELECT client_id,client_name FROM client WHERE delete_status = 0 AND transaction_id = 0";
		
		$admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
		$user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
		if(!in_array($user_group[0],$admin_user_group_id))
		{
			$sql .= " AND FIND_IN_SET('".$this->employee_id."',client.employee_id) ";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$client_list = array();
		if ($query->num_rows() >= 1) {
			foreach ($query->result() as $key => $val) {
				$client_list[] = '"'.$val->client_name.'"';
			}
		}
		return implode(',',$client_list);
	}
	
	function getClientIdByName($client_name){
		$sql   = "SELECT client_id,client_name FROM client WHERE client_name = '".trim($client_name)."' AND delete_status = 0 AND transaction_id = 0";
		$query = $this->db->query($sql);
		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function get_client_id($client_name)
	{
	    $sql   = "SELECT client_id,client_name FROM client WHERE client_name = '".trim($client_name)."' AND delete_status = 0 AND transaction_id = 0";
		$query = $this->db->query($sql);
		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}

	}

	function get_client_employee_name_list($employee_id){
		$employee_id_list = explode(',',$employee_id);
		$employee_name_list_array = array();
		$employee_name_list = '';
		if(isset($employee_id_list) &&  !empty($employee_id_list)){
			foreach($employee_id_list as $id){
				$sql   = "SELECT employee_id,employee_name FROM employee WHERE employee_id = '".$id."' AND delete_status = 0 AND transaction_id = 0";
				$query = $this->db->query($sql);
				$result = $query->result();
				$employee_name_list_array[] = $result[0]->employee_name;
			}
		}
		if(isset($employee_name_list_array) &&  !empty($employee_name_list_array)){
			$employee_name_list = implode(', ',$employee_name_list_array);	
		}
		return $employee_name_list;
	}

	function get_pending_purchase_order($client_id){
		$sql = 'SELECT i.invoice_no,i.invoice_date,i.ref_supplier_id,i.ref_client_id,i.discount_total,i.gst_total,i.grand_total,i.invoice_file,c.client_name,s.supplier_name,po.purchase_order_code
				FROM invoice AS i
				LEFT JOIN client AS c ON c.client_id = i.ref_client_id 
				LEFT JOIN supplier AS s ON s.supplier_id = i.ref_supplier_id 
				LEFT JOIN purchase_order AS po ON po.purchase_order_id = i.ref_purchase_order_id 
				WHERE i.ref_client_id = "'.$client_id.'" AND i.invoice_payment_status = 0 AND s.direct_to_customer = 1 AND i.delete_status = 0 AND i.transaction_id = 0  ORDER BY i.invoice_date DESC ';
	    $query = $this->db->query( $sql );
	    if ( $query->num_rows() >= 1 ) {
		    return $query->result();
		} else {
			return false;
		}
	}
	
	
}
?>
