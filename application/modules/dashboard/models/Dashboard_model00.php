<?php
Class Dashboard_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();
        $this->menu_html = '';
        $this->user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $this->employee_id = $this->session->userdata(SESSION_LOGIN . 'employee_id');
        $this->date_time = date('Y-m-d H:i:s');
    }
	
	function get_announcement($employee_id) {
		$month = date('m');
		$year = date('Y');
		$date =  date("Y-m-d",strtotime("+1 day"));
		$sql = "SELECT announcement_details FROM announcement WHERE FIND_IN_SET('".$employee_id."',announcement_to_employee) AND '".$date."' BETWEEN announcement_from_date  AND announcement_to_date AND delete_status = 0 AND transaction_id = 0";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function updateLog(){
		$date = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
		
		$query = $this->db->query("SELECT log_id FROM login_user_logs
									WHERE
										user_id = '".$user_id."'
									ORDER BY log_id DESC LIMIT 0,1	
								");
		$res = $query->result();
		$query = $this->db->query("UPDATE login_user_logs
									SET
										logged_out_date = '".$date."'
									WHERE
										log_id = '".$res[0]->log_id."'
								");
	}
	

    
	
	/************************************************************
		REMAINDAR CALLS AND APPOINTMENTS FOR CLIENT
	************************************************************/
	/*******
	 * Get Distinct Client ID
	 * 
	 * ****/
    function getClientReminderCalls() {
        $query = $this->db->query( "SELECT 
										DISTINCT lc.ref_client_id									
									FROM client_calls AS lc 
									JOIN client AS l ON l.client_id = lc.ref_client_id 
									WHERE lc.transaction_id = 0 AND lc.delete_status = 0 ");
       $today = date('Y-m-d');
       $tomorrow =  date('Y-m-d',strtotime("+1 day"));
	   $next7days =  date('Y-m-d',strtotime("+7 day"));
       $past7days =  date('Y-m-d',strtotime("-7 day"));
       $remindar_client_call = array();
       $remindar_client_call['today'] = array();
       $remindar_client_call['tomorrow'] = array();
       $remindar_client_call['next7days'] = array();
       $remindar_client_call['past7days'] = array();
       foreach($query->result() as $key => $val){
		   $remindar_client_call_res = $this->getLastClientCall($val->ref_client_id);
		    foreach($remindar_client_call_res as $key => $val){
				$date_time = explode(' ',$val->client_call_reminder_date);
				$date = $date_time[0]; 
				if($today == $date ){
					$remindar_client_call['today'][] = $val;
				}
				else if($tomorrow == $date ){
					$remindar_client_call['tomorrow'][] = $val;
				}
				else if($date > $tomorrow && $date <= $next7days){
					$remindar_client_call['next7days'][] = $val;
				}
				else if($date < $today && $date >= $past7days){
					$remindar_client_call['past7days'][] = $val;
				}
				
			}
	   }
	   
	   return $remindar_client_call;
        
    }
    
    /*******
	 * Get Last Call of client 
	 * $client id - client id  
	 * ****/
	 
    function getLastClientCall($client_id){
		 $query = $this->db->query( "SELECT 
										lc.*,
										l.client_name
									FROM client_calls AS lc 
									LEFT JOIN client As l ON l.client_id = lc.ref_client_id 
									WHERE lc.ref_client_id = '".$client_id."' AND  lc.transaction_id = 0 AND lc.delete_status = 0 ORDER BY client_call_date_and_time DESC LIMIT 1");
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	} 
    
    /*******
	 * Get Distinct Client ID to get appointment
	 * 
	 * ****/
    function getClientReminderAppointments() {
      
        $query = $this->db->query( "SELECT 
										DISTINCT la.ref_client_id
										FROM client_appointments AS la
									JOIN client AS l ON l.client_id = la.ref_client_id 
									WHERE  la.transaction_id = 0 AND la.delete_status = 0" );
       $today = date('Y-m-d');
       $tomorrow =  date('Y-m-d',strtotime("+1 day"));
	   $next7days =  date('Y-m-d',strtotime("+7 day"));
       $past7days =  date('Y-m-d',strtotime("-7 day"));
       $remindar_client_apps = array();
       $remindar_client_apps['today'] = array();
       $remindar_client_apps['tomorrow'] = array();
       $remindar_client_apps['next7days'] = array();
       $remindar_client_apps['past7days'] = array();
       foreach($query->result() as $key => $val){
		   $remindar_client_apps_res = $this->getLastClientApps($val->ref_client_id);
			if(!empty($remindar_client_apps_res)){	
				foreach($remindar_client_apps_res as $key => $val){
					$date_time = explode(' ',$val->appointment_to_confirm_date);
					$date = $date_time[0]; 
					if($today == $date ){
						$remindar_client_apps['today'][] = $val;
					}
					else if($tomorrow == $date ){
						$remindar_client_apps['tomorrow'][] = $val;
					}
					else if($date > $tomorrow && $date <= $next7days){
						$remindar_client_apps['next7days'][] = $val;
					}
					else if($date < $today && $date >= $past7days){
						$remindar_client_apps['past7days'][] = $val;
					}
					
				}
		}
	   }
	   
	  return $remindar_client_apps;
	   
	} 
    
    /*******
	 * Get Last Appointments of client 
	 * $client id - client id  
	 * ****/
     function getLastClientApps($client_id){
		 $query = $this->db->query( "SELECT 
										la.*,
										l.client_name
									FROM client_appointments AS la
									LEFT JOIN client As l ON l.client_id = la.ref_client_id 
									WHERE la.ref_client_id = '".$client_id."' AND  la.transaction_id = 0 AND la.delete_status = 0 ORDER BY appointment_process_date DESC LIMIT 1");
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	} 
	
	
	function getHourlyCallCount(){
		 $date = date('Y-m-d');
		 $query = $this->db->query( "SELECT HOUR(lead_call_date_and_time) AS from_hour, COUNT(*) AS total FROM lead_calls WHERE date(lead_call_date_and_time) = '".$date."' GROUP BY from_hour");

   	    if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	
	function getTodayCalllist($table,$day){
		if($table == 'lead_calls'){
			 $date_field = 'lead_call_date_and_time';
			 $ref_table = 'lead';
		 }
		 if($table == 'client_calls'){
			 $date_field = 'client_call_date_and_time';
			 $ref_table = 'client';
		 }
		 if($table == 'client'){
			 $date_field = 'client_data_collection_date_and_time';
		 }
		 if($table == 'lead'){
			 $date_field = 'lead_data_collection_date_and_time';
		 }
		$date = date('Y-m-d');
		if($day == 'today'){
			$today = date('Y-m-d');
			$date_query = "date($date_field) = '$today'"; 
		}
		if($day == 'yesterday'){
			$yesterday = date('Y-m-d',strtotime("-1 day"));
			$date_query = "date($date_field) = '$yesterday'";
		}
		if($day == 'past7days'){
			$past7days =  date('Y-m-d',strtotime("-7 day"));
			$date_query = "date($date_field) BETWEEN '$past7days' AND '$date'";
		}
		
		$sql = '';
		if($table == 'lead_calls' || $table == 'client_calls'){
			$name_field = $ref_table.'_name';
		$id_field = $ref_table.'_id';
		$ref_field = $table.'.ref_'.$id_field;
			$sql .= "SELECT 
							$table.*,$ref_table.$name_field
							FROM $table 
							LEFT JOIN $ref_table  ON $ref_table.$id_field = $ref_field
							WHERE $date_query AND  $table.transaction_id = 0 AND $table.delete_status = 0";
		}else{
			$sql .= "SELECT 
							$table.*
							FROM $table 
							WHERE $date_query AND  $table.transaction_id = 0 AND $table.delete_status = 0";
		}
		
		
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getUserName($id){
					$sql = "SELECT 
							user_name
							FROM user 
							WHERE user_id = '".$id."' AND transaction_id = 0 AND delete_status = 0";
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	
	
	function getOnlineUserList(){
		$date = date('Y-m-d');
		$sql = "SELECT ua1.*,u.user_name FROM user_activity ua1 LEFT JOIN user_activity ua2 ON (ua1.ref_user_id = ua2.ref_user_id AND ua1.user_activity_id < ua2.user_activity_id) LEFT JOIN user AS u ON u.user_id = ua1.ref_user_id WHERE ua1.user_activity_key = 'login' AND date(ua1.added_date) = '".$date."' AND ua2.user_activity_id IS NULL";
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getDashboardBlock(){
		$sql = "SELECT * FROM  dashboard_block WHERE delete_status = 0 AND transaction_id = 0 ORDER BY sort_order";
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	
	

	    function getClientReminderVisit() {
			$sql = "SELECT DISTINCT la.ref_client_id FROM client_visit AS la JOIN client AS c ON c.client_id = la.ref_client_id  WHERE  la.transaction_id = 0 AND la.delete_status = 0";
			
			$admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
			$user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
			$employee_id = $this->session->userdata( SESSION_LOGIN . 'employee_id' );
			if(!in_array($user_group[0],$admin_user_group_id))
			{
				$sql .= " AND FIND_IN_SET('".$employee_id."',c.employee_id) ";
			}
			
				
		$query = $this->db->query( $sql );
		$today = date('Y-m-d');
		$tomorrow =  date('Y-m-d',strtotime("+1 day"));
		$next7days =  date('Y-m-d',strtotime("+7 day"));
		$past7days =  date('Y-m-d',strtotime("-7 day"));
		$remindar_client_visit = array();
		$remindar_client_visit['today'] = array();
		$remindar_client_visit['tomorrow'] = array();
		$remindar_client_visit['next7days'] = array();
		$remindar_client_visit['past7days'] = array();
		foreach($query->result() as $key => $val){
			$remindar_client_visit_res = $this->getLastClientVisit($val->ref_client_id);
			if(!empty($remindar_client_visit_res)){	
				foreach($remindar_client_visit_res as $key => $val){
					$date_time = explode(' ',$val->client_visit_reminder_date);
					$date = $date_time[0]; 
					if($today == $date ){
						$remindar_client_visit['today'][] = $val;
					}
					else if($tomorrow == $date ){
						$remindar_client_visit['tomorrow'][] = $val;
					}
					else if($date > $tomorrow && $date <= $next7days){
						$remindar_client_visit['next7days'][] = $val;
					}
					else if($date < $today && $date >= $past7days){
						$remindar_client_visit['past7days'][] = $val;
					}
				}
			}
		}

    return $remindar_client_visit;

    } 

    function getLastClientVisit($client_id){
		$query = $this->db->query( "SELECT 
		la.*,
		l.client_name
		FROM client_visit AS la
		LEFT JOIN client As l ON l.client_id = la.ref_client_id 
		WHERE la.ref_client_id = '".$client_id."' AND  la.transaction_id = 0 AND la.delete_status = 0 ORDER BY client_visit_id DESC LIMIT 1");
		
		if ( $query->num_rows() >= 1 ) {
			return $query->result();
		} else {
			return false;
		}
	} 

    function get_client_feedback_reminder() {
		$sql = "SELECT 
		DISTINCT la.ref_client_id
		FROM product_sample_request AS la
		JOIN client AS l ON l.client_id = la.ref_client_id 
		WHERE ";
		$admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
		$user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
		$user_id = $this->session->userdata( SESSION_LOGIN . 'user_id' );
		if(!in_array($user_group[0],$admin_user_group_id))
		{
			$sql .= " la.ref_user_id = '".$user_id."' AND ";	
		}
		$sql .= " la.transaction_id = 0 AND la.delete_status = 0 ORDER BY reminder_date DESC";
		$query = $this->db->query( $sql );
							
		$today = date('Y-m-d');
		$tomorrow =  date('Y-m-d',strtotime("+1 day"));
		$next7days =  date('Y-m-d',strtotime("+7 day"));
		$past7days =  date('Y-m-d',strtotime("-7 day"));
		$client_feedback_reminder = array();
		$client_feedback_reminder['today'] = array();
		$client_feedback_reminder['tomorrow'] = array();
		$client_feedback_reminder['next7days'] = array();
		$client_feedback_reminder['past7days'] = array();
		foreach($query->result() as $key => $val){
			$client_feedback_reminder_res = $this->getLastClientFeedback($val->ref_client_id);
			if(!empty($client_feedback_reminder_res)){	
				foreach($client_feedback_reminder_res as $key => $val){
					$date_time = explode(' ',$val->reminder_date);
					$date = $date_time[0]; 
					if($today == $date ){
						$client_feedback_reminder['today'][] = $val;
					}
					else if($tomorrow == $date ){
						$client_feedback_reminder['tomorrow'][] = $val;
					}
					else if($date > $tomorrow && $date <= $next7days){
						$client_feedback_reminder['next7days'][] = $val;
					}
					else if($date < $today && $date >= $past7days){
						$client_feedback_reminder['past7days'][] = $val;
					}
				}
			}
		}

    return $client_feedback_reminder;

    } 


	function getLastClientFeedback($client_id){
		$sql = "SELECT 
		la.*,
		l.client_name,s.supplier_name
		FROM product_sample_request AS la
		LEFT JOIN client As l ON l.client_id = la.ref_client_id 
		LEFT JOIN supplier As s ON s.supplier_id = la.ref_supplier_id 
		
		WHERE la.ref_client_id = '".$client_id."' AND  la.transaction_id = 0 AND la.delete_status = 0 AND ref_product_request_status_id = 2 ORDER BY product_sample_request_id";
		
		
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
			return $query->result();
		} else {
			return false;
		}
	}

	function get_customer_count(){
		$sql = 'SELECT COUNT(*) AS total FROM client WHERE delete_status = 0 AND transaction_id = 0';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function get_supplier_count(){
		$sql = 'SELECT COUNT(*) AS total FROM supplier WHERE delete_status = 0 AND transaction_id = 0';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function get_sample_request_count($type=0){
		$sql = 'SELECT COUNT(*) AS total FROM product_sample_request WHERE delete_status = 0 AND transaction_id = 0 ';
		if($type){
			$sql .= ' AND ref_product_request_status_id = '.$type.'';
		}
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function get_proforma_invoice_count($type=''){
		$sql = 'SELECT COUNT(*) AS total FROM proforma_invoice WHERE delete_status = 0 AND transaction_id = 0 ';
		if($type == 'pending'){
			$sql .= ' AND ref_proforma_invoice_status_id = ""';
		}
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}

	function get_client_outstanding_list()
	{
	    $sql = 'SELECT *,c.client_name,u.user_name FROM client_outstanding as co
	    LEFT JOIN client as c on c.client_id = co.ref_client_id
	    LEFT JOIN user as u on u.user_id = co.ref_user_id
	    WHERE co.delete_status = 0 AND co.transaction_id = 0 ';
	    $query = $this->db->query( $sql );
	    if ( $query->num_rows() >= 1 ) {
		    return $query->result();
		} else {
			return false;
		}

	}

	function get_user_id(){
	    $sql = 'SELECT ref_user_id FROM client_outstanding
	    WHERE delete_status = 0 AND transaction_id = 0 group by ref_user_id  ';
	    $query = $this->db->query( $sql );
	    if ( $query->num_rows() >= 1 ) {
		    return $query->result();
		} else {
			return false;
		}

	}
	
	function get_pending_purchase_order(){
		$sql = 'SELECT i.invoice_no,i.invoice_date,i.ref_supplier_id,i.ref_client_id,i.discount_total,i.gst_total,i.grand_total,i.invoice_file,c.client_name,s.supplier_name,po.purchase_order_code
				FROM invoice AS i
				LEFT JOIN client AS c ON c.client_id = i.ref_client_id 
				LEFT JOIN supplier AS s ON s.supplier_id = i.ref_supplier_id 
				LEFT JOIN purchase_order AS po ON po.purchase_order_id = i.ref_purchase_order_id 
				WHERE i.invoice_payment_status = 0 AND s.direct_to_customer = 1 AND i.delete_status = 0 AND i.transaction_id = 0  ORDER BY i.invoice_date DESC ';
	    $query = $this->db->query( $sql );
	    if ( $query->num_rows() >= 1 ) {
		    return $query->result();
		} else {
			return false;
		}
	}
	
	function get_client_list(){
		$sql = 'SELECT client_id,client_name,visit_interval_count FROM client WHERE delete_status = 0 AND transaction_id = 0';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function get_client_last_visit($client_id){
		$sql = 'SELECT * FROM client_visit WHERE ref_client_id = "'.$client_id.'" AND delete_status = 0 AND transaction_id = 0 ORDER BY added_date DESC LIMIT 0,1';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function get_pending_proforma_list(){
		$sql = 'SELECT pi.*,c.client_name,s.supplier_name FROM  proforma_invoice AS pi 
		LEFT JOIN client AS c ON c.client_id = pi.ref_client_id
		LEFT JOIN supplier AS s ON s.supplier_id = pi.ref_supplier_id
		 ';			
		
		$sql .= 'WHERE';		
		$admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
		$user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
		if(!in_array($user_group[0],$admin_user_group_id))
		{
			$sql .= " FIND_IN_SET('".$this->employee_id."',c.employee_id) AND ";
		}
		
		$sql .= ' pi.ref_proforma_invoice_status_id = 0 AND pi.delete_status = 0 AND pi.transaction_id = 0 ORDER BY pi.proforma_invoice_date ASC';
		
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
		
	

}
?>
