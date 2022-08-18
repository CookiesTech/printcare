<?php
Class Common_model extends CI_Model
{
    private $menu_html;
    public function __construct()
    {
        parent::__construct();
        $this->menu_html = '';
        $this->user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $this->employee_id = $this->session->userdata(SESSION_LOGIN . 'employee_id');
        $this->date_time = date('Y-m-d H:i:s');
        $this->branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
    }
    
     function get_patient_code()
    {
        $query = $this->db->query("SELECT patient_code FROM patient WHERE delete_status = 0 AND transaction_id = 0 ORDER BY patient_id DESC LIMIT 1");
        
        $res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = substr($result[0]->patient_code,-4);
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);

        } else {
             $unique_no_final = '0001';           
        }
        
        $date = date('Ymd');
        $patient_code = 'P/'.$date.'/'.$unique_no_final;
        return  $patient_code;
        //KM/20-21/001
    }

    function addRecord($main_table, $data, $customer_id = 0)
    {
        $main_table = trim($main_table);
        $user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $date    = date('Y-m-d H:i:s');
        foreach ($data as $key => $value) {
            if ($this->Common_model->startsWith($key, 'tbl_')) {
                $table_new                  = str_replace('tbl_', '', $key);
                $sub_table_data[$table_new] = $value;
            } else {
                if (strpos($key, '_date') !== false) {
                    $date_field      = date("Y-m-d H:i:s", strtotime($data[$key]));
                    $main_data[$key] = $date_field;
                }elseif (strpos($key, '_time') !== false) {
                    $date_field      = date("H:i:s", strtotime($data[$key]));
                    $main_data[$key] = $date_field;
                } else {
                    $main_data[$key]         = $value;
                    if($main_table != 'client_outstanding' && $main_table != 'user_to_group'){
						$main_data['ref_user_id']    = $user_id;
					}
                    $main_data['added_date'] = $date;
                }
            }
        }
        if($main_table == 'user' ){
			unset($main_data['ref_user_id']);
		}
        /*if($this->branch_id){
            if($main_table == 'patient' || $main_table == 'customer' || $main_table == 'employee' || $main_table == 'patient_visit' || $main_table == 'product_batch'){
                $main_data['ref_branch_id'] = $this->branch_id;
            }
        }*/
        $this->db->insert($main_table, $main_data);
        $last_id = $this->db->insert_id();
        if (isset($sub_table_data) && !empty($sub_table_data)) {
            foreach ($sub_table_data as $key => $value) {
                $new_table = $key;
                foreach ($value as $key => $v1) {
					$sub_table_main_data = array();
                    $sub_table_main_data['ref_'.$main_table.'_id'] = $last_id;
                    foreach($v1 as $k2 => $v2){
						if (strpos($k2, '_date') !== false) {
							$date_field      = date("Y-m-d H:i:s", strtotime($v1[$k2]));
							$sub_table_main_data[$k2] = $date_field;
						}else if(strpos($k2, '_time') !== false){
							$date_field      = date("Y-m-d H:i:s", strtotime($v1[$k2]));
							$sub_table_main_data[$k2] = $date_field;
						}else{
							$sub_table_main_data[$k2] = $v1[$k2];
						}
					}
					
                    $value['user_id']    = $user_id;
                    $sub_table_main_data['added_date'] = $this->date_time;
                    $this->db->insert($new_table, $sub_table_main_data);
                }
            }
        }
       // exit;
        return $last_id;
    }
    
    function getFieldItemExist($data,$table,$parent=0) {
		
		if($table == 'data_source'){
			$query = $this->db->query( "SELECT data_source_id AS id, data_source_name AS name FROM data_source WHERE data_source_name = '".$data."'" );
		}
		if($table == 'salutaion'){
			$query = $this->db->query( "SELECT salutation_id AS id, salutation_name AS name FROM salutation WHERE salutation_name = '".$data."'" );
		}
		if($table == 'category'){
			$query = $this->db->query( "SELECT business_category_id AS id, business_category_name AS name FROM business_category WHERE business_category_name = '".$data."' AND business_category_parent_id ='0'" );
		}
		if($table == 'sub_category'){
			$query = $this->db->query( "SELECT business_sub_category_id AS id, business_sub_category_name AS name FROM business_sub_category WHERE business_sub_category_name = '".$data."' AND business_category_parent_id = '".$parent."'" );
		}
		if($table == 'area'){
			$query = $this->db->query( "SELECT area_id AS id, area_name AS name FROM area WHERE area_name = '".$data."' AND ref_district_id = '".$parent."'" );
		}
		if($table == 'city'){
			$query = $this->db->query( "SELECT city_id AS id, city_name AS name FROM city WHERE city_name = '".$data."' AND ref_district_id = '".$parent."'" );
		}
		if($table == 'designation'){
			$query = $this->db->query( "SELECT designation_id AS id, designation_name AS name FROM designation WHERE designation_name = '".$data."'" );
		}
		if($table == 'blood_group'){
			$query = $this->db->query( "SELECT blood_group_id AS id, blood_group_name AS name FROM blood_group WHERE blood_group_name = '".$data."'" );
		}
		if($table == 'bank'){
			$query = $this->db->query( "SELECT bank_id AS id, bank_name AS name FROM bank WHERE bank_name = '".$data."'" );
		}
		if($table == 'height_feet'){
			$query = $this->db->query( "SELECT height_feet_id AS id, height_feet_name AS name FROM height_feet WHERE height_feet_name = '".$data."'" );
		}
		if($table == 'height_inch'){
			$query = $this->db->query( "SELECT height_inch_id AS id, height_inch_name AS name FROM height_inch WHERE height_inch_name = '".$data."'" );
		}
		if($table == 'domain_type'){
			$query = $this->db->query( "SELECT domain_type_id AS id, domain_type_name AS name FROM domain_type WHERE domain_type_name = '".$data."'" );
		}
        if ( $query->num_rows() >= 1 ) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    
    function addFieldItem($data,$table,$parent){
		$user_id = $this->session->userdata('user_id');
		$date = date('Y-m-d H:i:s');
		if($table == 'data_source'){
			$query = $this->db->query( "INSERT INTO data_source set data_source_name = '".$data."',user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'salutaion'){
			$query = $this->db->query( "INSERT INTO salutation set salutation_name = '".$data."',user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'category'){
			$query = $this->db->query( "INSERT INTO  business_category set business_category_name = '".$data."',user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'sub_category'){
			$query = $this->db->query( "INSERT INTO business_sub_category set business_sub_category_name = '".$data."' , business_category_parent_id ='".$parent."',user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'area'){
			$query = $this->db->query( "INSERT INTO area set area_name = '".$data."', ref_district_id ='".$parent."',user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'city'){
			$query = $this->db->query( "INSERT INTO city set city_name = '".$data."', ref_district_id ='".$parent."',user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'designation'){
			$query = $this->db->query( "INSERT INTO designation set designation_name = '".$data."' , ref_department_id ='".$parent."',ref_user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'blood_group'){
			$query = $this->db->query( "INSERT INTO blood_group set blood_group_name = '".$data."' ,ref_user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'bank'){
			$query = $this->db->query( "INSERT INTO bank set bank_name = '".$data."' ,ref_user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'height_feet'){
			$query = $this->db->query( "INSERT INTO height_feet set height_feet_name = '".$data."' ,ref_user_id = '".$user_id."', added_date = '".$date."'" );
		}
		if($table == 'height_inch'){
			$query = $this->db->query( "INSERT INTO height_inch set height_inch_name = '".$data."' ,ref_user_id = '".$user_id."', added_date = '".$date."'" );
		}
		
		if($table == 'height_inch'){
			$query = $this->db->query( "INSERT INTO domain_type set domain_type_name = '".$data."' ,ref_user_id = '".$user_id."', added_date = '".$date."'" );
		}
		
        return $this->db->insert_id();
	} 
	
	
   function getFieldItem($table) {
		
		if($table == 'data_source'){
			$query = $this->db->query( "SELECT data_source_id AS id, data_source_name AS name FROM data_source " );
		}
		if($table == 'salutaion'){
			$query = $this->db->query( "SELECT salutation_id AS id, salutation_name AS name FROM salutation " );
		}
		if($table == 'category'){
			$query = $this->db->query( "SELECT business_category_id AS id, business_category_name AS name FROM business_category WHERE  business_category_parent_id ='0'" );
		}
		if($table == 'sub_category'){
			$query = $this->db->query( "SELECT business_sub_category_id AS id, business_sub_category_name AS name FROM business_sub_category" );
		}
		if($table == 'area'){
			$query = $this->db->query( "SELECT area_id AS id, area_name AS name FROM area" );
		}
		if($table == 'city'){
			$query = $this->db->query( "SELECT city_id AS id, city_name AS name FROM city" );
		}
		if($table == 'designation'){
			$query = $this->db->query( "SELECT designation_id AS id, designation_name AS name FROM designation" );
		}
		if($table == 'blood_group'){
			$query = $this->db->query( "SELECT blood_group_id AS id, blood_group_name AS name FROM blood_group" );
		}
		if($table == 'bank'){
			$query = $this->db->query( "SELECT bank_id AS id, bank_name AS name FROM bank" );
		}
		if($table == 'height_feet'){
			$query = $this->db->query( "SELECT height_feet_id AS id, height_feet_name AS name FROM height_feet" );
		}
		if($table == 'height_inch'){
			$query = $this->db->query( "SELECT height_inch_id AS id, height_inch_name AS name FROM height_inch" );
		}
		
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getDropdownList($table, $id = 0)
    {
        if ($table == 'sub_category') {
            $query = $this->db->query("SELECT * FROM business_sub_category WHERE business_category_parent_id = '" . $id . "'");
        } else if ($table == 'district') {
            $query = $this->db->query("SELECT * FROM " . $table . " WHERE state_id = '" . $id . "'  order by " . $table . "_name ASC");
        }else if ($table == 'state') {
            $query = $this->db->query("SELECT * FROM " . $table . " WHERE country_id = '" . $id . "'  order by " . $table . "_name ASC");
        } else if ($table == 'court') {
            $query = $this->db->query("SELECT * FROM " . $table . " order by " . $table . "_name ASC");
        }else if ($table == 'project_task') {
			//echo "SELECT * FROM " . $table . "  WHERE ref_project_id = '".$id."' AND delete_status = 0 AND transaction_id = 0 order by project_task_id ASC ";
			//exit;
			 $query = $this->db->query("SELECT * FROM " . $table . "  WHERE ref_project_id = '".$id."' AND delete_status = 0 AND transaction_id = 0 order by project_task_id ASC "); 
        } else if($table == 'user') {
            $query = $this->db->query("SELECT * FROM " . $table . " WHERE delete_status = 0 AND transaction_id = 0 AND " . $table . ".user_id NOT IN (".HIDE_USER.") order by " . $table . "_name ASC");
        } else {
            $query = $this->db->query("SELECT * FROM " . $table . " WHERE delete_status = 0 AND transaction_id = 0 order by " . $table . "_name ASC");
        }
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    /**
	 * Get List
	 * 
	 * Get Table record List
	 * 
	 * @param $main_table table name
	 * @param $sort_data for sorting the record(ASC,DESC) optional
	 * @param $filter_Data filter the table record soptional
	 * @param $distinct_field list only one row from multiple records optional
	 */ 
     function getList($table,$sort_data='',$filter_data='',$distinct_field="",$where_condition='') {
				$main_table = $table['tbl_main']; 
				if(isset($table['tbl_mobile'])){
					$mobile_table = $table['tbl_mobile']; 
				}
				if(isset($table['tbl_email'])){
					$email_table = $table['tbl_email']; 
				}
				$table_fields = $this->getTableColumn($main_table);
				
				$filter_query = array();
				$sql = '';
				$filter_sql = '';
				$join_query = '';
				$select_fields = '';
				$filter_data_field = array();
				$join_table_name = array();

				if(isset($filter_data['filter_data']) && !empty($filter_data['filter_data'])){
					foreach($filter_data['filter_data'] as $data){
						 if(empty($data['value'] )){
							$data['value']  = '';
						 }
						 if(empty($data['value_from'] )){
							$data['value_from']  = '';
						 }
						 if(empty($data['value_to'] )){
							$data['value_to']  = '';
						 }
						if ($data['value'] != '' || $data['value_from'] != '' || $data['value_to'] != '') {
							$data['value'] = str_replace("'",'',trim($data['value']));
							if($data['field'] == 'lead_call_reminder' || $data['field'] == 'appointment_to_confirm' || $data['field'] == 'client_call_reminder' ){
								if(strtolower($data['value']) == 'yes'){
									$data['value'] = '1';
								}else{
									$data['value'] = '0';
								}
							}
							
							if($data['field'] == 'call_type'){
								if(strtolower($data['value']) == 'incoming'){
									$data['value'] = '2';
								}else{
									$data['value'] = '1';
								}
							}
							if($data['field'] == 'accounts_transaction_credit' || $data['field'] == 'accounts_transaction_debit'){
								if($data['field'] == 'accounts_transaction_credit'){
									$data['field'] = 'accounts_transaction_debit';
									$data['value'] = '0';
									$data['operation'] = '=';
								}else{		
									$data['field'] = 'accounts_transaction_credit';
									$data['value'] = '0';
									$data['operation'] = '=';
								}
							}
							 if (strpos($data['field'], '_date') !== false) {
								 $data['value'] = date('Y-m-d',strtotime($data['value']));
								// $data['field'] = 'date('.$data['field'].')';
							 }
							$filter_data_field[] = $data['field'];
							 if($this->startsWith($data['field'], 'ref_')){
								$ref_field = $data['field'];
								$primary_field = str_replace('ref_','',$data['field']);
								$table_name = str_replace('_id','',$primary_field);
							
								// Restrict duplication of Join Same table
								if(!in_array($table_name,$join_table_name)){
									$ref_data_field = $table_name."_name";
									$join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
									$select_fields .= " , $table_name.$ref_data_field";
									$join_table_name[] = $table_name; 
								}
								
								if($data['operation'] == 'LIKE %...%'){
									if(isset($data['filter_type'])){
										$filter_query[] = $data['filter_type']." ".$ref_data_field." ".str_replace('%...%',"'%".$data['value']."%'",$data['operation']).""; 
									}else{
										$filter_query[] = $ref_data_field." ".str_replace('%...%',"'%".$data['value']."%'",$data['operation']).""; 
									}
								}else{
									if(isset($data['filter_type'])){
										$filter_query[] = $data['filter_type']." ".$ref_data_field." ".$data['operation']." '".$data['value']."'"; 
									}else{
										$filter_query[] = $ref_data_field." ".$data['operation']." '".$data['value']."'"; 
									}
								}
							 }else{
								if($data['operation'] == 'LIKE %...%'){
									if(isset($data['filter_type'])){
										$filter_query[] = $data['filter_type']." ".$data['field']." ".str_replace('%...%',"'%".$data['value']."%'",$data['operation']).""; 
									}else{
										$filter_query[] = $data['field']." ".str_replace('%...%',"'%".$data['value']."%'",$data['operation'])."";
									}
								}else if($data['operation'] == 'BETWEEN'){
									if (isset($data['filter_type'])) {
										$filter_query[] = $data['filter_type'] . " date(" . $main_table.'.'.date($data['field']) . ") " . $data['operation'] . " '" . date('Y-m-d',strtotime($data['value_from'])) . "' AND '" . date('Y-m-d',strtotime($data['value_to'] )). "'";
									} else {
										$filter_query[] = "date(".$main_table.'.'.$data['field'] . ") " . $data['operation'] . " '" . date('Y-m-d',strtotime($data['value_from'])) . "' AND '" . date('Y-m-d',strtotime($data['value_to'] )). "'";
									}
								}else{
									if(isset($data['filter_type'])){
										$filter_query[] = $data['filter_type']." ".$data['field']." ".$data['operation']." '".$data['value']."'"; 
									}else{
										$filter_query[] = $data['field']." ".$data['operation']." '".$data['value']."'"; 
									}
								}
							}
						}
					}				
					if(isset($filter_query) && !empty($filter_query)){
						$filter_sql .= " AND (";
						$filter_sql .= implode(" ",$filter_query);
						$filter_sql .= " )";
					}
					// Set Search data in cookie
					//$this->setCookie($filter_data);
				}
				
			if(isset($table_fields) && !empty($table_fields)){	
				foreach($table_fields as $data){
						if($this->startsWith($data, 'ref_')){
							if(isset($filter_data_field) && !empty($filter_data_field)){
								if(!in_array($data,$filter_data_field)){
									$ref_field = $data;
									$primary_field = str_replace('ref_','',$data);
									$table_name = str_replace('_id','',$primary_field);
									$ref_data_field = $table_name."_name";
									$join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
									
									if($table_name == 'seo_keyword'){
										$select_fields .= " , $table_name.seo_keyword";
									}elseif($table_name == 'supplier'){
										$select_fields .= " , direct_to_customer";
									}elseif($table_name == 'invoice'){
										$select_fields .= " , invoice_file";
									}elseif($table_name == 'user' || $table_name == 'client_visit' ){
										$select_fields .= " , user.full_name,user.nick_name";
									}
									
									$select_fields .= " , $table_name.$ref_data_field";
							
								}
							}else{
								if($this->startsWith($data, 'ref_')){
									$ref_field = $data;
									$primary_field = str_replace('ref_','',$data);
									$table_name = str_replace('_id','',$primary_field);
									$ref_data_field = $table_name."_name";
									$join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
									if($table_name == 'seo_keyword'){
										$select_fields .= " , $table_name.seo_keyword";
									}elseif($table_name == 'supplier'){
										$select_fields .= " ,direct_to_customer";
									}elseif($table_name == 'user'){
										$select_fields .= " , user.full_name";
									}elseif($table_name == 'invoice'){
										$select_fields .= " , invoice_file";
									}	
									$select_fields .= " , $table_name.$ref_data_field";
								}
							}
						}
					}
				}
				
				
				 //~ if($main_table == 'product' || $main_table == 'business_category'){
					//~ echo $join_query .= " LEFT JOIN $table_name ON $table_name.'_parent_id' = $main_table.'_id' ";
					//~ //$select_fields .= " , $table_name.$ref_data_field";
				//~ }
				
				
				$primary_field = $main_table."_id";
				if($main_table == 'lead' || $main_table == 'client'){
					$sql .= "SELECT DISTINCT $main_table.$primary_field,$main_table.*";
				}else{
					$sql .= "SELECT $main_table.*";
				}
				if(isset($select_fields) && !empty($select_fields)){
					$sql .= " $select_fields ";
				}
				$sql .= " FROM $main_table ";
				if(isset($join_query) && !empty($join_query)){
					$sql .= $join_query;
				}
				if (isset($filter_data['filter_data']) && !empty($filter_data['filter_data'])) {
					if(isset($mobile_table) && !empty($mobile_table)){
						$main_table_key_filed = $main_table."_id";
						$ref_table_key_filed = "ref_".$main_table."_id";	
						$sql .= " LEFT JOIN $mobile_table ON $mobile_table.$ref_table_key_filed = $main_table.$main_table_key_filed";
					}
					
					if(isset($email_table) && !empty($email_table)){
						$main_table_key_filed = $main_table."_id";
						$ref_table_key_filed = "ref_".$main_table."_id";	
						$sql .= " LEFT JOIN $email_table ON $email_table.$ref_table_key_filed = $main_table.$main_table_key_filed";
					}
				}
					
				$sql .= " WHERE ";
				if(!empty($where_condition)){
					$sql .= "$where_condition AND ";
				}	
				$sql .= " $main_table.transaction_id = 0 AND ";
				$sql .= " $main_table.delete_status = 0";
				$sql .=  $filter_sql;
				
				
				/*$branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
				if($main_table == "user" || $main_table == "purchase_order" || $main_table == "invoice" || $main_table == "accounts_transaction" || $main_table == "patient_visit"){
					if($branch_id != 0) {
						$sql.=" AND $main_table.ref_branch_id = '".$branch_id."'";
					}
				}*/
				
				
				$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');	
				if($main_table == 'general_reminder'){
					if($user_id != '1'){
						$sql .= " AND $main_table.ref_status_id != '4' ";
						$sql .= " AND ($main_table.ref_user_id = '".$user_id."'";
						$sql .= " OR $main_table.assigned_user_id = '".$user_id."')";
					}
				}
				
				if($main_table == 'client' ){
					$admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
					$user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
					if(!in_array($user_group[0],$admin_user_group_id))
					{
						$sql .= " AND FIND_IN_SET('".$this->employee_id."',$main_table.employee_id) ";
					}
				}
				
				//~ if($main_table == 'client_calls' || $main_table == 'client_appointments' || $main_table == 'client_remark' || $main_table == 'client_visit' || $main_table == 'client_outstanding' ){
					//~ $admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
					//~ $user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
					//~ if(!in_array($user_group[0],$admin_user_group_id))
					//~ {
						//~ $sql .= " AND $main_table.ref_user_id = '".$user_id."'";
					//~ }
				//~ }
				if($main_table == 'user' || $main_table == 'user_group'){
					if($user_id != '1'){
						$sql .= " AND $main_table.user_id NOT IN (".HIDE_USER.") AND $main_table.".$main_table."_id != '1' ";
					}else {
						$sql .= " AND $main_table.user_id NOT IN (".HIDE_USER.") ";
					}
				}

				if(isset($filter_data['customer_dc']) && $filter_data['customer_dc'] == 1){
					$sql .= " AND $main_table.customer_delivery_challan = 1 ";
				}
				if(isset($distinct_field) && !empty($distinct_field)){
					$primary_field = str_replace('ref_','',$distinct_field);
					$table_name = str_replace('_id','',$primary_field);
					$sql .= " GROUP BY $table_name.$primary_field ";
				}
				if(isset($sort_data['sort']) && !empty($sort_data['sort'])){
					$sql .= " ORDER BY ".$sort_data['sort']." ".$sort_data['order']."";
				}
				
				if (isset($sort_data['start'])) {
                    if(isset($sort_data['limit']) && !empty($sort_data['limit'])){
                        if($sort_data['limit'] == 'View All'){
                             $sql .= '';
                        }else{
                            $sql .= " LIMIT " . $sort_data['start'] . ",".$sort_data['limit']."";
                        }
                    }else{
                        $sql .= " LIMIT " . $sort_data['start'] . "," . RPP . "";
                    }
                }
                /*echo '<br>';
				 echo $sql;
				 echo '<br>';
				 echo '<br>';*/
				// exit;
				$query = $this->db->query( $sql);
				if ( $query->num_rows() >= 1 ) {
					return $query->result();
				} else {
					return false;
				}
    }
    
    function filterRecord($filter_data, $main_table)
    {
        $filter_sql      = '';
        $join_table_name = array();
        $join_query      = '';
        $select_fields   = '';
        if (isset($filter_data['filter_data']) && !empty($filter_data['filter_data'])) {
            foreach ($filter_data['filter_data'] as $data) {
                if (empty($data['value'])) {
                    $data['value'] = '';
                }
                if (empty($data['value_from'])) {
                    $data['value_from'] = '';
                }
                if (empty($data['value_to'])) {
                    $data['value_to'] = '';
                }
                if ($data['value'] != '' || $data['value_from'] != '' || $data['value_to'] != '') {
                    $data['value'] = str_replace("'", '', trim($data['value']));
                    if ($data['field'] == 'lead_call_reminder' || $data['field'] == 'appointment_to_confirm' || $data['field'] == 'client_call_reminder') {
                        if (strtolower($data['value']) == 'yes') {
                            $data['value'] = '1';
                        } else {
                            $data['value'] = '0';
                        }
                    }
                    if ($data['field'] == 'call_type') {
                        if (strtolower($data['value']) == 'incoming') {
                            $data['value'] = '2';
                        } else {
                            $data['value'] = '1';
                        }
                    }
                    if (strpos($data['field'], '_date') !== false) {
                        $data['value'] = date('Y-m-d', strtotime($data['value']));
                        // $data['field'] = 'date('.$data['field'].')';
                    }
                    $filter_data_field[] = $data['field'];
                    if ($this->startsWith($data['field'], 'ref_')) {
                        $ref_field     = $data['field'];
                        $primary_field = str_replace('ref_', '', $data['field']);
                        $table_name    = str_replace('_id', '', $primary_field);
                        // Restrict duplication of Join Same table
                        if (!in_array($table_name, $join_table_name)) {
                            $ref_data_field = $table_name . "_name";
                            $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                            $select_fields .= " , $table_name.$ref_data_field";
                            $join_table_name[] = $table_name;
                        }
                        if ($data['operation'] == 'LIKE %...%') {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $ref_data_field . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            } else {
                                $filter_query[] = $ref_data_field . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            }
                        } else {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $ref_data_field . " " . $data['operation'] . " '" . $data['value'] . "'";
                            } else {
                                $filter_query[] = $ref_data_field . " " . $data['operation'] . " '" . $data['value'] . "'";
                            }
                        }
                    } else {
                        if ($data['operation'] == 'LIKE %...%') {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $data['field'] . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            } else {
                                $filter_query[] = $data['field'] . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            }
                           
                        } else if ($data['operation'] == 'BETWEEN') {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " date(" . $main_table . '.' . date($data['field']) . ") " . $data['operation'] . " '" . date('Y-m-d', strtotime($data['value_from'])) . "' AND '" . date('Y-m-d', strtotime($data['value_to'])) . "'";
                            } else {
                                $filter_query[] = "date(" . $main_table . '.' . $data['field'] . ") " . $data['operation'] . " '" . date('Y-m-d', strtotime($data['value_from'])) . "' AND '" . date('Y-m-d', strtotime($data['value_to'])) . "'";
                            }
                        } else {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $data['field'] . " " . $data['operation'] . " '" . $data['value'] . "'";
                            } else {
                                $filter_query[] = $data['field'] . " " . $data['operation'] . " '" . $data['value'] . "'";
                            }
                        }
                    }
                }
            }
            if (isset($filter_query) && !empty($filter_query)) {
                $filter_sql .= " AND (";
                $filter_sql .= implode(" ", $filter_query);
                $filter_sql .= " )";
            }
        }
        return $filter_sql;
    }
    
    /**
     * Get Record Details view
     * 
     * Get Table record details
     * 
     * @param $main_table table name
     * @param $id_field for matching field in table(ex:id) 
     * @param $id filter the matching data(ex:1)
     * @param $sort_field sorting filed name optional
     * * @param $sort_data ASC or DESC  optional
     */
    function getDetails($main_table, $id_field, $id, $sort_field = "", $sort_data = "")
    {
	
        $table_fields      = $this->getTableColumn($main_table);
       
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        if(isset($table_fields) && !empty($table_fields)){
			foreach ($table_fields as $data) {
				if ($this->startsWith($data, 'ref_')) {
					$ref_field      = $data;
					$primary_field  = str_replace('ref_', '', $data);
					$table_name     = str_replace('_id', '', $primary_field);
					$ref_data_field = $table_name . "_name";
					$join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
					if($table_name == 'seo_keyword'){
						$select_fields .= " , $table_name.seo_keyword";
					}else{
						$select_fields .= " , $table_name.$ref_data_field";
					}	
					if($table_name == 'dashboard_block'){
						$select_fields .= " , $table_name.dashboard_block_key";
					}
					if($table_name == 'supplier'){
						$select_fields .= " , $table_name.direct_to_customer";
					}
					if($table_name == 'proforma_invoice'){
						$select_fields .= " , $table_name.proforma_invoice_code";
					}
					if($table_name == 'product'){
						$select_fields .= " , $table_name.sku";
					}
					if($main_table == 'project_assigned' || $main_table == 'project_task_assigned' || $main_table == 'general_reminder' || $main_table == 'client' || $main_table == 'client_visit'){
						 $select_fields .= " ,user.full_name";
					}
					
				}
			}
        }
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 AND ";
		
		// $branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
		// if($main_table == "user" || $main_table == "purchase_order" || $main_table == "invoice" || $main_table == "accounts_transaction" || $main_table =='product'){
		// 	if($branch_id != 0) {
		// 		$sql.=" AND $main_table.ref_branch_id = '".$branch_id."'";
		// 	}
		// }
        
        if($main_table == 'user' ){
			if($this->user_id != '1'){
				$sql .= " $main_table.user_id NOT IN (".HIDE_USER.") AND ";
			}
        }
        
         if( $main_table == 'user_activity' ){
			$sql .= " $main_table.ref_user_id NOT IN (".HIDE_USER.") AND ";
        }
        
      /*  if($this->branch_id){
            if($main_table == 'patient' || $main_table == 'customer' || $main_table == 'employee' || $main_table == 'patient_visit' || $main_table == 'product_batch'){
               $sql .= "  $main_table.ref_branch_id = ".$this->branch_id." AND ";
            }
        }*/
        
        if (strpos($id_field, '_date') !== false ) {
			$sql .= " date($main_table.$id_field) = '$id'";
		}else{
			$sql .= " $main_table.$id_field = '$id'";
		}
		
        //echo $sql;
        //~ echo "<br>";
        //~ echo "<br>";
        //~ echo "<br>";
        if (!empty($sort_field) && !empty($sort_data)) {
            $sql .= " ORDER BY $sort_field $sort_data";
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getPurchaseOrderPdfDetails($main_table, $id_field, $id, $sort_field = "", $sort_data = "")
    {
	
        $table_fields      = $this->getTableColumn($main_table);
       
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        if(isset($table_fields) && !empty($table_fields)){
			foreach ($table_fields as $data) {
				if ($this->startsWith($data, 'ref_')) {
					$ref_field      = $data;
					$primary_field  = str_replace('ref_', '', $data);
					$table_name     = str_replace('_id', '', $primary_field);
					$ref_data_field = $table_name . "_name";
					$join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
					if($table_name == 'seo_keyword'){
						$select_fields .= " , $table_name.seo_keyword";
					}else{
						$select_fields .= " , $table_name.$ref_data_field";
					}	
					if($table_name == 'dashboard_block'){
						$select_fields .= " , $table_name.dashboard_block_key";
					}
					if($table_name == 'supplier'){
						$select_fields .= " , $table_name.direct_to_customer";
					}
					if($table_name == 'proforma_invoice'){
						$select_fields .= " , $table_name.proforma_invoice_code";
					}
					if($table_name == 'product'){
						$select_fields .= " , $table_name.sku";
					}
					if($main_table == 'project_assigned' || $main_table == 'project_task_assigned' || $main_table == 'general_reminder' || $main_table == 'client' || $main_table == 'client_visit'){
						 $select_fields .= " ,user.full_name";
					}
					
				}
			}
        }
        $sql .= "SELECT $main_table.*, gst_type.gst_perc";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
		}
		$sql .= " LEFT JOIN gst_type ON gst_type.gst_type_id = product.ref_gst_type_id ";
        $sql .= " WHERE ";
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 AND ";
        
        if($main_table == 'user' ){
			if($this->user_id != '1'){
				$sql .= " $main_table.user_id NOT IN (".HIDE_USER.") AND ";
			}
        }
        
         if( $main_table == 'user_activity' ){
			$sql .= " $main_table.ref_user_id NOT IN (".HIDE_USER.") AND ";
        }
        
        
        if (strpos($id_field, '_date') !== false ) {
			$sql .= " date($main_table.$id_field) = '$id'";
		}else{
			$sql .= " $main_table.$id_field = '$id'";
		}
		
        //~ echo $sql;
        //~ echo "<br>";
        //~ echo "<br>";
        //~ echo "<br>";
        if (!empty($sort_field) && !empty($sort_data)) {
            $sql .= " ORDER BY $sort_field $sort_data";
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function getDetailsCount($main_table, $id_field, $id, $sort_field = "", $sort_data = "")
    {
        $table_fields      = $this->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        foreach ($table_fields as $data) {
            if ($this->startsWith($data, 'ref_')) {
                $ref_field      = $data;
                $primary_field  = str_replace('ref_', '', $data);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                $select_fields .= " , $table_name.$ref_data_field";
                if($main_table == 'project_assigned'){
					 $select_fields .= " ,user.full_name";
				}
            }
        }
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 AND ";
        if (strpos($id_field, '_date') !== false ) {
			$sql .= " date($main_table.$id_field) = '$id'";
		}else{
			$sql .= " $main_table.$id_field = '$id'";
		}
		
         //~ echo $sql;
        //~ echo "<br>";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    
    
    
    function getDetailsNew($main_table, $where = '', $group_by = '', $order_by = '', $limit = '')
    {
        $table_fields      = $this->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        foreach ($table_fields as $data) {
            if ($this->startsWith($data, 'ref_')) {
                $ref_field      = $data;
                $primary_field  = str_replace('ref_', '', $data);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                $select_fields .= " , $table_name.$ref_data_field";
            }
        }
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        if (isset($where) && !empty($where)) {
            $sql .= $where . " AND ";
        }
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 ";
        if (isset($group_by) && !empty($group_by)) {
            $sql .= " GROUP BY " . $group_by;
        }
        if (isset($order_by) && !empty($order_by)) {
            $sql .= " ORDER BY " . $order_by;
        }
        if (isset($limit) && !empty($limit)) {
            $sql .= " LIMIT " . $limit;
        }
        //echo $sql;
        //echo "<br>";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function startsWith($string, $key)
    {
        // search backwards starting from haystack length characters from the end
        return $key === "" || strrpos($string, $key, -strlen($string)) !== FALSE;
    }
   /**
         * Get List Count
         * 
         * Get Table record List Count
         * 
         * @param $main_table table name
         * @param $filter_Data filter the table record soptional
         * @param $distinct_field list only one row from multiple records optional
         */
         
    function getListCount( $table,$filter_data,$distinct_field="",$where_condition='') {
				//$main_table = 'lead';
				$main_table = $table['tbl_main']; 
				if(isset($table['tbl_mobile'])){
					$mobile_table = $table['tbl_mobile']; 
				}
				if(isset($table['tbl_email'])){
					$email_table = $table['tbl_email']; 
				} 
				$filter_query = array();
				$sql = '';
				$filter_sql = '';
				$join_query = '';
				$select_fields = '';
				$join_table_name = array();
				
				if(isset($filter_data['filter_data']) && !empty($filter_data['filter_data'])){
					foreach($filter_data['filter_data'] as $data){
						 if(empty($data['value'] )){
							$data['value']  = '';
						 }
						 if(empty($data['value_from'] )){
							$data['value_from']  = '';
						 }
						 if(empty($data['value_to'] )){
							$data['value_to']  = '';
						 }
						if ($data['value'] != '' || $data['value_from'] != '' || $data['value_to'] != '') {
							$data['value'] = str_replace("'",'',trim($data['value']));
							if($data['field'] == 'lead_call_reminder' || $data['field'] == 'appointment_to_confirm' || $data['field'] == 'client_call_reminder' ){
								if(strtolower($data['value']) == 'yes'){
									$data['value'] = '1';
								}else{
									$data['value'] = '0';
								}
							}
							
							if($data['field'] == 'call_type'){
								if(strtolower($data['value']) == 'incoming'){
									$data['value'] = '2';
								}else{
									$data['value'] = '1';
								}
							}
							 if (strpos($data['field'], '_date') !== false) {
								 $data['value'] = date('Y-m-d',strtotime($data['value']));
								// $data['field'] = 'date('.$data['field'].')';
							 }

							 if($data['field'] == 'accounts_transaction_credit' || $data['field'] == 'accounts_transaction_debit'){
								if($data['field'] == 'accounts_transaction_credit'){
									$data['field'] = 'accounts_transaction_debit';
									$data['value'] = '0';
									$data['operation'] = '=';
								}else{		
									$data['field'] = 'accounts_transaction_credit';
									$data['value'] = '0';
									$data['operation'] = '=';
								}
							}
							
							 
							if($this->startsWith($data['field'], 'ref_')){
								$ref_field = $data['field'];
								$primary_field = str_replace('ref_','',$data['field']);
								$table_name = str_replace('_id','',$primary_field);
								
								// Restrict duplication of Join Same table
								if(!in_array($table_name,$join_table_name)){
									$ref_data_field = $table_name."_name";
									$join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
									$select_fields .= " , $table_name.$ref_data_field";
									$join_table_name[] = $table_name; 
								}
								
								if($data['operation'] == 'LIKE %...%'){
									if(isset($data['filter_type'])){
										$filter_query[] = $data['filter_type']." ".$ref_data_field." ".str_replace('%...%',"'%".$data['value']."%'",$data['operation']).""; 
									}else{
										$filter_query[] = $ref_data_field." ".str_replace('%...%',"'%".$data['value']."%'",$data['operation']).""; 
									}
								}else{
									if(isset($data['filter_type'])){
										$filter_query[] = $data['filter_type']." ".$ref_data_field." ".$data['operation']." '".$data['value']."'"; 
									}else{
										$filter_query[] = $ref_data_field." ".$data['operation']." '".$data['value']."'"; 
									}
								}
							 }else{
								if($data['operation'] == 'LIKE %...%'){
									if(isset($data['filter_type'])){
										$filter_query[] = $data['filter_type']." ".$data['field']." ".str_replace('%...%',"'%".$data['value']."%'",$data['operation']).""; 
									}else{
										$filter_query[] = $data['field']." ".str_replace('%...%',"'%".$data['value']."%'",$data['operation'])."";
									}
								}else if($data['operation'] == 'BETWEEN'){
									if (isset($data['filter_type'])) {
										$filter_query[] = $data['filter_type'] . " date(" . $main_table.'.'.date($data['field']) . ") " . $data['operation'] . " '" . date('Y-m-d',strtotime($data['value_from'])) . "' AND '" . date('Y-m-d',strtotime($data['value_to'] )). "'";
									} else {
										$filter_query[] = "date(".$main_table.'.'.$data['field'] . ") " . $data['operation'] . " '" . date('Y-m-d',strtotime($data['value_from'])) . "' AND '" . date('Y-m-d',strtotime($data['value_to'] )). "'";
									}	
								}else{
									if(isset($data['filter_type'])){
										$filter_query[] = $data['filter_type']." ".$data['field']." ".$data['operation']." '".$data['value']."'"; 
									}else{
										$filter_query[] = $data['field']." ".$data['operation']." '".$data['value']."'"; 
									}
								}
							}
						}
					}
					
				
					if(isset($filter_query) && !empty($filter_query)){
						$filter_sql .= " AND (";
						$filter_sql .= implode(" ",$filter_query);
						$filter_sql .= " ) ";
					}
					
				}
				
				
				
				/****** Select Query starts Here *****/
				
				// Select main table Fields
				$primary_field = $main_table."_id";
				if($main_table == 'lead' || $main_table == 'client'){
					$sql .= "SELECT DISTINCT $main_table.$primary_field,$main_table.*";
				}else{
					$sql .= "SELECT $main_table.*";
				}
				
				// Select Joined table Fileds If available
				if(isset($select_fields) && !empty($select_fields)){
					$sql .= " $select_fields ";
				}
				
				// From Main table
				$sql .= " FROM $main_table ";
				
				// Join query if available
				if(isset($join_query) && !empty($join_query)){
					$sql .= $join_query;
				}
				if (isset($filter_data['filter_data']) && !empty($filter_data['filter_data'])) {
					if(isset($mobile_table) && !empty($mobile_table)){
						$main_table_key_filed = $main_table."_id";
						$ref_table_key_filed = "ref_".$main_table."_id";	
						$sql .= " LEFT JOIN $mobile_table ON $mobile_table.$ref_table_key_filed = $main_table.$main_table_key_filed";
					}
					
					if(isset($email_table) && !empty($email_table)){
						$main_table_key_filed = $main_table."_id";
						$ref_table_key_filed = "ref_".$main_table."_id";	
						$sql .= " LEFT JOIN $email_table ON $email_table.$ref_table_key_filed = $main_table.$main_table_key_filed";
					}
				}
				
				// Where condition 
				$sql .= " WHERE ";
				if(!empty($where_condition)){
					$sql .= "$where_condition AND ";
				}
				$sql .= " $main_table.transaction_id = 0 AND ";
				$sql .= " $main_table.delete_status = 0";
				$sql .= $filter_sql;
				
				/*$branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
				if($main_table == "user" || $main_table == "purchase_order" || $main_table == "invoice" || $main_table == "accounts_transaction" || $main_table == "patient_visit"){
					if($branch_id != 0) {
						$sql.=" AND $main_table.ref_branch_id = '".$branch_id."'";
					}
				}
*/
				
				$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');	
				if($main_table == 'general_reminder'){
					if($user_id != '1'){
						$sql .= " AND $main_table.ref_status_id != '4' ";
						$sql .= " AND ($main_table.ref_user_id = '".$user_id."'";
						$sql .= " OR $main_table.assigned_user_id = '".$user_id."')";
					}
				}
				//~ if($main_table == 'client' || $main_table == 'client_calls' || $main_table == 'client_appointments' || $main_table == 'client_remark' || $main_table == 'client_visit' || $main_table == 'client_outstanding' ){
					//~ $admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
					//~ $user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
					//~ if(!in_array($user_group[0],$admin_user_group_id))
					//~ {
						//~ $sql .= " AND $main_table.ref_user_id = '".$user_id."'";
					//~ }
				//~ }
				
				if($main_table == 'client' ){
					$admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
					$user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
					if(!in_array($user_group[0],$admin_user_group_id))
					{
						$sql .= " AND FIND_IN_SET('".$this->employee_id."',$main_table.employee_id) ";
					}
				}
				
				if($main_table == 'user' || $main_table == 'user_group'){
					if($user_id != '1'){
						$sql .= " AND $main_table.user_id NOT IN (".HIDE_USER.") AND $main_table.".$main_table."_id != '1' ";
					}else {
						$sql .= " AND $main_table.user_id NOT IN (".HIDE_USER.") ";
					}
				}

				// Get Only Customer DC
				if(isset($filter_data['customer_dc']) && $filter_data['customer_dc'] == 1){
					$sql .= " AND $main_table.customer_delivery_challan = 1 ";
				}
				
				if(isset($distinct_field) && !empty($distinct_field)){
					$primary_field = str_replace('ref_','',$distinct_field);
					$table_name = str_replace('_id','',$primary_field);
					$sql .= " GROUP BY $main_table.$distinct_field ";
				}
				/*echo $sql;	
				echo '<br>';			
				echo '<br>';			
				echo '<br>';	*/		
				$query = $this->db->query( $sql);
				
				if ( $query->num_rows() >= 1 ) {
					return $query->num_rows();
				} else {
					return false;
				}
    }
    function removeRecord($main_table, $id_field, $id)
    {
        $data                  = array();
        $data['delete_status'] = '1';
        $this->db->where($id_field, $id);
        $this->db->update($main_table, $data);
        return $id;
        //$this->db->last_query();
    }
    
    function deleteRecord($main_table, $id_field, $id)
    {
        $data                  = array();
        $this->db->where($id_field, $id);
        $this->db->delete($main_table);
        return $id;
        //$this->db->last_query();
    }
    
     function truncateTable($main_table)
    {
		$this->db->from($main_table); 
		$this->db->truncate(); 
        return true;
    }
    
    function getTableFields($table)
    {
        $query = $this->db->query("SELECT 
										DISTINCT COLUMN_NAME, COLUMN_COMMENT
									FROM INFORMATION_SCHEMA.COLUMNS
									WHERE TABLE_SCHEMA = '" . $this->db->database . "' AND  TABLE_NAME= '" . $table . "' AND COLUMN_COMMENT !='' ORDER BY ORDINAL_POSITION");
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getTableColumn($table)
    {
        $query  = $this->db->query("SELECT 
										DISTINCT COLUMN_NAME
									FROM INFORMATION_SCHEMA.COLUMNS
									WHERE TABLE_SCHEMA = '" . $this->db->database . "' AND  TABLE_NAME= '" . $table . "' ORDER BY ORDINAL_POSITION");
        $result = array();
        foreach ($query->result() as $data) {
            $result[] = $data->COLUMN_NAME;
        }
        if ($query->num_rows() >= 1) {
            return $result;
        } else {
            return false;
        }
    }
 
    function getFilterOperation()
    {
        $query = $this->db->query("SELECT filter_operation_details FROM filter_opration");
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getRecord($table, $where_field, $where_id)
    {
        $query = $this->db->query("SELECT * FROM " . $table . " WHERE " . $where_field . " = '" . $where_id . "' AND delete_status = 0 AND transaction_id = '0'");
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function parentCheck($table,$cat_id)
    {
        $sql   = "select ".$table."_parent_id from $table where ".$table."_id=$cat_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            $res = $query->result();
            //echo $res[0]->product_parent_id;
            $id = $table.'_parent_id';
            return $res[0]->$id;
        } else {
            return false;
        }
    }
    function hasParent($table,$cat_id)
    {
        $rec_count = 1;
        do {
            $result = $this->parentCheck($table,$cat_id);
            $rec_count++;
            $cat_id = $result;
        } while ($result);
        return $rec_count;
    }
    function render_menu($table,$parent_id,$item_id)
    {
		//echo $item_id;
        $sql   = "select * from $table where ".$table."_parent_id = $parent_id ORDER BY ".$table."_name ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            foreach ($query->result() as $key => $val) {
				$id = $table.'_id';
				$name = $table.'_name';
                if ($parent_id == 0){
                    if($val->$id == $item_id){
                        $this->menu_html .= "<option value='" . $val->$id . "' selected>" . $val->$name . "</option>";
                    }else{
                        $this->menu_html .= "<option value='" . $val->$id . "'>" . $val->$name . "</option>";
                    }
                    
                }else {
                    $rec_count = $this->hasParent($table,$val->$id);
                    $space     = '';
                    for ($i = 0; $i < $rec_count; $i++) {
                        $space .= '&nbsp;&nbsp;';
                    }
                   
                    if($val->$id == $item_id){
						 $this->menu_html .= "<option value='" . $val->$id . "' selected>" . $space . "--" . $val->$name . "</option>";
						//$this->menu_html.="<option value='".$val->product_id."' selected>".$space."--".$val->product_name."</option>";
					}else{
						 $this->menu_html .= "<option value='" . $val->$id . "'>" . $space . "--" . $val->$name . "</option>";
						//$this->menu_html.="<option value='".$val->product_id."'>".$space."--".$val->product_name."</option>";
					}
						
                   // $this->menu_html .= "<option value='" . $val->$id . "'>" . $space . "--" . $val->$name . "</option>";
                    $space = '';
                }
                $this->render_menu($table,$val->$id,$item_id);
                $this->menu_html .= "</option>";
            }
            return $this->menu_html;
        } else {
            return false;
        }
    }
    function getCategoryList($table,$item_id=0)
    {
		//echo $item_id;
         $category = $this->render_menu($table,0,$item_id);
      //  exit;
        return $category;
    }
    
    function setCookie($filter_data){

		if(array_key_exists('recentsearch', $_COOKIE)) {
			$cookie = $_COOKIE['recentsearch'];
			$cookie = unserialize($cookie);
		} else {
			$cookie = array();
		}

		$cookie[] = array(
			'field' => $filter_data['filter_data'][0]['field'],
			'value' => $filter_data['filter_data'][0]['value'],
		);
		$cookie = serialize($cookie);
		
		setcookie('recentsearch', $cookie, time()+3600);
		
	}
	
	function addUserActivity($key,$data){
		$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
		$date = date('Y-m-d H:i:s');
		$main_data['user_activity_key']  = $key;
		$main_data['user_activity_data'] = $data;
		$main_data['ref_user_id'] = $user_id;
		$main_data['added_date'] = $date;
       
        $this->db->insert('user_activity', $main_data);
        $last_id = $this->db->insert_id();
	}
	
	function hasPermissionBackup($page)
    {
		$res_permission = $this->session->userdata(SESSION_LOGIN.'user_permission');
        if (isset($res_permission) && !empty($res_permission)) {
            if (in_array($page, $res_permission)) {
				
                return TRUE;
            
			}else {
				 return FALSE;
			}
            
        } else {			
            return FALSE;
        }
    } 
    /**
     * $audit => tablename_audit(employee_audit)
     * 
     * ***/
	function dataBackup($audit,$main_table,$id){
		$audit_permission = $this->session->userdata(SESSION_LOGIN.'audit_record');
		$this->hasPermissionBackup($audit);
		$temp_table = 'tmp_'.$main_table;
		
		if($this->hasPermissionBackup($audit) && $audit_permission == '1'){
			
			 if($this->db->table_exists('tmp_'.$main_table) == FALSE){				
				$this->db->query("CREATE TABLE $temp_table LIKE $main_table");
			}
		
			$primary_field = $main_table . '_id';
			$res_record    = $this->Common_model->getRecord($main_table, $primary_field, $id);
			$audit_record  = $res_record[0];
			
			unset($audit_record->$primary_field);
			$audit_record_final = array();
			foreach ($audit_record as $key => $val) {
				$audit_record_final[$key] = $val;
				if (strpos($key, '_date') !== false) {
					if ($val != '00-00-0000 00:00:00' && $val != '') {
						$date_field               = date("Y-m-d H:i:s", strtotime($val));
						$audit_record_final[$key] = $date_field;
					}
				}
			}
			//$audit_record_final['ref_user_id']    = $this->user_id;
			$audit_record_final['transaction_id'] = $id;
			$audit_record_final['added_date']     = date("Y-m-d H:i:s");
			$this->addRecord($temp_table, $audit_record_final);
		}
		
	}
	
	
	
	function getCommonMenu(){
		$query = $this->db->query("SELECT * FROM menu WHERE parent_id = 0 AND status_id = 1 AND delete_status =0 AND transaction_id = 0  ORDER BY sort_order ");
      // $query = $this->db->query("SELECT * FROM `menu` WHERE `parent_id` = 0 AND `status_id` = 1 AND `delete_status` = 0 AND `transaction_id` = 0 AND `menu_id` != 238 AND `menu_id` != 243  AND `menu_id` != 278 ");
       
		if ($query->num_rows() >= 1) {
			//echo "<pre>";print_r($query->result());exit;
            return $query->result();

        } else {
            return false;
        }
	}
	
	function getSubMenu($id){
		$query = $this->db->query("SELECT * FROM menu WHERE parent_id = '".$id."' AND status_id = 1 AND delete_status =0 AND transaction_id = 0 ORDER BY sort_order ");
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	 public function exportPdf($header,$footer,$html,$file,$orientation='',$output_type='')
    {
        $orientation_mode = '';
        //$mpdf = new mPDF(' ', 'A4-P');
        if(empty($orientation)){
			$orientation_mode = 'A4-P';
		}else{
			$orientation_mode = 'A4-'.strtoupper($orientation);
		}
		/**
		 * Create a new PDF document
		 *
		 * @param string $mode
		 * @param string $format
		 * @param int $font_size
		 * @param string $font
		 * @param int $margin_left
		 * @param int $margin_right
		 * @param int $margin_top (Margin between content and header, not to be mixed with margin_header - which is document margin)
		 * @param int $margin_bottom (Margin between content and footer, not to be mixed with margin_footer - which is document margin)
		 * @param int $margin_header
		 * @param int $margin_footer
		 * @param string $orientation (P, L)
		 */
		// new mPDF($mode, $format, $font_size, $font, $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer, $orientation);
		
       // $mpdf = new mPDF('utf-8', $orientation_mode, 0, '', 10, 10, 40, 20, 10, 10);
        if(!empty($header)){  // With Header
			$mpdf = new mPDF('utf-8', $orientation_mode, 9, '', 10, 10, 42, 20, 10, 10);
		}else{  // Without Header
			$mpdf = new mPDF('utf-8', $orientation_mode, 9, '', 10, 10, 10, 10, 10, 10);
		}
        //class mPDF ([ string $mode [, mixed $format [, float $default_font_size [, string $default_font [, float $margin_left , float $margin_right , float $margin_top , float $margin_bottom , float $margin_header , float $margin_footer [, string $orientation ]]]]]])
		
		$mpdf->SetHTMLHeader($header);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->WriteHTML($html);
		
		
		//$mpdf->Output();
		 if ($output_type != '') {
            $output_type = $output_type;
        } else {
            $output_type = 'I';
        }
       // $mpdf->use_kwt = true;
        $mpdf->debug = true;
		$mpdf->Output($file, $output_type);
    }
    
    
     public function exportNewPdf($html,$file,$output_type,$orientation='',$header='')
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sigma');
        $pdf->SetTitle('Proposal');
        $pdf->SetSubject('Proposal');
        $pdf->SetKeywords('Proposal,Invoice');
        
        if($header =='NO'){
		}else{
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, array(
				31,73,125
			), array(
				31,73,125
			));
		}
        $pdf->setFooterData(array(
           31,73,125
        ), array(
           31,73,125
        ));
        $pdf->setHeaderFont(Array(
            PDF_FONT_NAME_MAIN,
            '',
            PDF_FONT_SIZE_MAIN
        ));
        $pdf->setFooterFont(Array(
            PDF_FONT_NAME_DATA,
            '',
            PDF_FONT_SIZE_DATA
        ));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
       
        if($header =='NO'){
			$pdf->SetMargins(PDF_MARGIN_LEFT, 2, PDF_MARGIN_RIGHT);
		}else{
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			
		}
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->setFontSubsetting(true);
        //$pdf->SetFont('calibri', '', 9, '', true);
        //$pdf->SetFont('trebuchetms', '', 9, '', true);
		$pdf->SetFont('dejavusans', '', 9, '', true);
        if($orientation == 'L'){
			$pdf->AddPage('L');
		}else{
			$pdf->AddPage();
		}
		$pdf->SetTextColor(31,73,125);

        $pdf->setTextShadow(array(
            'enabled' => true,
            'depth_w' => 0.2,
            'depth_h' => 0.2,
            'color' => array(
              196,196,196
            ),
            'opacity' => 1,
            'blend_mode' => 'Normal'
        ));
		$pdf->SetFont('dejavusans', 'B', 10, '', true);
        //$file_name = $file.'_'.date('Y-m-d_H:i:s') . '.pdf';
         //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $pdf->writeHTMLCell(40, 5, 20, 30, 'Dated: 12-01-2017', 'B', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(50, 5, 140, 30, 'Invoice No : SIG/00001', 'B', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(60, 5, 100, 35, '', 0, 1, 0, true, '', true);
        $pdf->writeHTMLCell(180,5 , '','', 'Proposal for Sigma website', 'B', 1, 0, true, 'C', true);
         $pdf->writeHTMLCell(0, 5, '','', '', 0, 1, 0, true, '', true);
         $pdf->SetFont('dejavusans', '', 9, '', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        if($output_type == 'F'){
			$output_type = $output_type;
		}else{
			$output_type = 'I';
		}
        $pdf->Output($file, $output_type);
    }
    
    Function generatePDF($html,$file,$output_type,$title,$sno,$type){
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sigma');
        $pdf->SetTitle('Proposal');
        $pdf->SetSubject('Proposal');
        $pdf->SetKeywords('Proposal,Invoice');
        
     
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, array(
				31,73,125
			), array(
				31,73,125
			));
		
        $pdf->setFooterData(array(
           31,73,125
        ), array(
           31,73,125
        ));
        $pdf->setHeaderFont(Array(
            PDF_FONT_NAME_MAIN,
            '',
            PDF_FONT_SIZE_MAIN
        ));
        $pdf->setFooterFont(Array(
            PDF_FONT_NAME_DATA,
            '',
            PDF_FOOTER_FONT_SIZE_DATA
        ));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
       
       
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			
		
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->setFontSubsetting(true);
        //$pdf->SetFont('calibri', '', 9, '', true);
        //$pdf->SetFont('trebuchetms', '', 9, '', true);
		$pdf->SetFont('dejavusans', '', 8, '', true);
       
		$pdf->AddPage();
		
		$pdf->SetTextColor(31,73,125);

/*
        $pdf->setTextShadow(array(
            'enabled' => true,
            'depth_w' => 0.2,
            'depth_h' => 0.2,
            'color' => array(
              196,196,196
            ),
            'opacity' => 1,
            'blend_mode' => 'Normal'
        ));
*/
		$date = date('d-m-Y');
		if($type == 'invoice'){
			$name = 'Invioce for '.$title.' website';
		}else{
			$name = 'Proposal for '.$title.' website';
		}
        $string_length = strlen($name);
        $tot_mm = 182;
        $mm_per_letter = 2.8;
        $mm_per_string = $string_length * 2.1;
        $text_length_mm = (($tot_mm - $mm_per_string)/2)+15;
        //exit; 
		$pdf->SetFont('dejavusans', 'B', 9, '', true);
        //$file_name = $file.'_'.date('Y-m-d_H:i:s') . '.pdf';
         //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        //$pdf->writeHTMLCell(40, 5, 15, 25, 'Dated:'.$date, 'B', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(40, 5, 15, 25, 'Dated : '.$date, '', 1, 0, true, 'C', true);
      //  $pdf->writeHTMLCell(50, 5, 144, 25, 'Invoice No : '.$proposal_no, 'B', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(50, 5, 144, 25, $type.' No : '.$sno, '', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(60, 3, 100, 30, '', 0, 1, 0, true, '', true);
       // $pdf->writeHTMLCell($mm_per_string,5 , $text_length_mm,'', $proposal_name, 'B', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell($mm_per_string,5 , $text_length_mm,'', $name, '', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(182, 2, '','', '', '', 1, 0, true, '', true);
        $pdf->SetFont('dejavusans', '', 9, '', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        if($output_type == 'F'){
			$output_type = $output_type;
		}else{
			$output_type = 'I';
		}
        $pdf->Output($file, $output_type);
	}
    
    
    function generateExcelCSV($data,$file_name){
    	$delimiter = ',';
    	header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$file_name.'.csv";');
        $f = fopen('php://output', 'w');
        foreach ($data as $line) {
            fputcsv($f, $line, $delimiter);
        }
        exit;
    }
    
    function generateExcel($data,$file_name){
        $this->generateExcelCSV($data,$file_name);
        exit;        
        //Send Headers
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=".$file_name.".xls ");
        header("Content-Transfer-Encoding: binary ");

        //XLS Data Cell
        $this->xlsBOF();
        if(isset($data) && !empty($data)){
            foreach($data as $row_key => $row_val){
                 foreach($row_val as $col_key => $col_val){
                   $this->xlsWriteLabel($row_key,$col_key,$col_val); // row, col, value
                }
            }
        }
        $this->xlsEOF(); 
    }
    

    function generateExcelXlS($data,$file_name){
        //Send Headers
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=".$file_name.".xls ");
        header("Content-Transfer-Encoding: binary ");

        //XLS Data Cell
        $this->xlsBOF();
        if(isset($data) && !empty($data)){
            foreach($data as $row_key => $row_val){
                 foreach($row_val as $col_key => $col_val){
                   $this->xlsWriteLabel($row_key,$col_key,$col_val); // row, col, value
                }
            }
        }
        $this->xlsEOF(); 
    }
    
    //Beginning of file...
    function xlsBOF() {
       echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);  
       return;
    }

    //End of file...
    function xlsEOF() {
       echo pack("ss", 0x0A, 0x00);
       return;
    }

    //Creates a heading...
    function xlsWriteLabel($Row, $Col, $Value ) {
       $L = strlen($Value);
       echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
       echo $Value;
       return;
    }
    
    function updateRecord($main_table,$data,$id){
		if(isset($data) && !empty($data)){
			foreach($data as $key => $val){
				 if ($this->Common_model->startsWith($key, 'tbl_')) {
					$table_new                  = str_replace('tbl_', '', $key);
					$sub_table_data[$table_new] = $val;
				} else {
					if (strpos($key, '_date') !== false) {
						$date_field      = date("Y-m-d H:i:s", strtotime($data[$key]));
						$main_data[$key] = $date_field;
					} else {
						$main_data[$key]         = $val;
						$main_data['ref_user_id'] = $this->user_id;
						//$main_data['added_date'] = $this->date_time;
					}
				}
			}
		}
		
		if($main_table == 'user'){
			unset($main_data['ref_user_id']);
		}
		
		$this->db->where($main_table . '_id', $id);
		$this->db->update($main_table, $main_data);
		
		// Update Sub Tabel data
		if(isset($sub_table_data) && !empty($sub_table_data)){
			foreach ($sub_table_data as $key => $val1) {
				$this->db->where('ref_'.$main_table.'_id', $id);
				$this->db->delete($key);
				$new_table = $key;
				foreach ($val1 as $key => $v1) {
					$sub_table_main_data = array();
                    $sub_table_main_data['ref_'.$main_table.'_id'] = $id;
                    foreach($v1 as $k2=>$v2){
						if (strpos($k2, '_date') !== false) {
							$date_field      = date("Y-m-d H:i:s", strtotime($v1[$k2]));
							$sub_table_main_data[$k2] = $date_field;
						}else if(strpos($k2, '_time') !== false){
							$date_field      = date("Y-m-d H:i:s", strtotime($v1[$k2]));
							$sub_table_main_data[$k2] = $date_field;
						}else{
							$sub_table_main_data[$k2] = $v1[$k2];
						}
					}
                    $value['user_id']    = $this->user_id;;
                    //$sub_table_main_data['added_date'] = $this->date_time;
                    $this->db->insert($new_table, $sub_table_main_data);
                }
			}
		}
		
		return $id;
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
	
	function getOptionList($table,$item_id=0,$where_field="",$where_id=0,$order_by_field='')
	    {
		$order_by = $table.'_name';
		
		if(!empty($order_by_field))
			$order_by = $order_by_field;
			
		$this->menu_html = ''; 
		if(empty($where_field) && empty($where_id)){
			$sql  .= "select * from $table where delete_status = 0 AND transaction_id = 0 ";
			/*if($this->branch_id){
			    if($table == 'patient' || $table == 'customer' || $table == 'employee'){
			        $sql  .= ' AND ref_branch_id = '.$this->branch_id;
			    }
			}*/
			$sql  .= " order by ".$order_by." ASC ";
		}else{
			$sql   = "select * from $table where ".$where_field." = '".$where_id."' AND delete_status = 0 AND transaction_id = 0 ";
			/*if($this->branch_id){
			    if($table == 'patient' || $table == 'customer' || $table == 'employee'){
			        $sql  .= ' AND ref_branch_id = '.$this->branch_id;
			    }
			}*/
			$sql  .= " order by ".$order_by." ASC ";

		}
		//echo $sql;
	
		$query = $this->db->query($sql);
		if ($query->num_rows() >= 1) {
			foreach ($query->result() as $key => $val) {
				$id = $table.'_id';
				
				$name = $table.'_name';
				if($val->$id == $item_id){
					if($table == 'patient' || $table == 'customer'){
						$this->menu_html .= "<option value=" . $val->$id . " selected>". $val->$name.' ['.$val->mobile.']' . "</option>";
					}else{
					 	$this->menu_html .= "<option value=" . $val->$id . " selected>". $val->$name . "</option>";
					}
				
				}else{
					if($table == 'patient' || $table == 'customer'){
						$this->menu_html .= "<option value=" . $val->$id . ">". $val->$name.' ['.$val->mobile.']' . "</option>";
					}else{
					 $this->menu_html .= "<option value=" . $val->$id . ">" . $val->$name . "</option>";
					}
				}
			}
			$this->menu_html .= "</option>";
		}
		return $this->menu_html;
    }
    
    function checkImageExist($src_image,$path,$thumb=''){
        if(empty($src_image)){
            $image = asset_url().'images/logo.png';
        }else{
            if(!file_exists(FCPATH.$src_image)){
                $image = asset_url().'images/logo.png';
            }else{
                $image = base_url().$src_image;
                if($thumb){
                    $image = str_replace('/uploads/'.$path,'/uploads/'.$path.'/thumb',$image);
                }
            }
        }
        return $image;
    }
    
    function checkFileExist($src_image,$path){
        if(empty($src_image)){
            $image = '';
        }else{
            if(!file_exists(FCPATH.$src_image)){
                $image = '';
            }else{
                $image = base_url().$src_image;
                if($thumb){
                    $image = str_replace('/uploads/'.$path,'/uploads/'.$path.'/thumb',$image);
                }
            }
        }       

        return $image;
    }
    
    function getMinDetails($main_table, $id_field, $id, $sort_field = "", $sort_data = "",$include_fields=array())
    {
        $table_fields      = $this->Common_model->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        foreach ($table_fields as $data) {
            if ($this->Common_model->startsWith($data, 'ref_')) {
                $ref_field      = $data;
                $primary_field  = str_replace('ref_', '', $data);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                if ($table_name == 'case_type') {
                    $select_fields .= " , $table_name.case_type_abbr ";
                }
                $select_fields .= " , $table_name.$ref_data_field";
            }
        }
       
		$sql .= "SELECT ";
		
        if(isset($include_fields) && !empty($include_fields)){
			$fields_select = implode(',',$include_fields);
			$sql .= " $fields_select ";
		}else{
			$sql .= $main_table . "_id, " . $main_table . "_name ";
		}
        //~ if (isset($select_fields) && !empty($select_fields)) {
            //~ $sql .= " $select_fields ";
        //~ }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        
        if(!empty($module_name)){
			$sql .= " $main_table.table_name = '$module_name' AND ";
		}
		if($main_table == 'profile'){
            $sql .= " $main_table.ref_membership_status_id = 1 AND ";
        }
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 AND ";
        
        if($main_table == 'page'){
            $sql .= " $main_table.ref_status_id = 1 AND ";
        }
                
        $sql .= " $main_table.$id_field = '$id'";
       
        if (!empty($sort_field) && !empty($sort_data)) {
            $sql .= " ORDER BY $sort_field $sort_data";
        }
       
      //   echo $sql;
       // echo "<br>";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function getRecords($main_table, $where = '', $group_by = '', $order_by = '', $limit = '')
    {
        $table_fields      = $this->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        foreach ($table_fields as $data) {
            if ($this->startsWith($data, 'ref_')) {
                $ref_field      = $data;
                $primary_field  = str_replace('ref_', '', $data);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                
                if($table_name == 'seo_keyword'){
					$select_fields .= " , $table_name.seo_keyword";
				}else{
					$select_fields .= " , $table_name.$ref_data_field";
				}
				if($table_name == 'dashboard_block'){
					$select_fields .= " , $table_name.dashboard_block_key";
				}
				if($table_name == 'employee'){
					$select_fields .= " , $table_name.profile_pic";
				}
				if($table_name == 'invoice'){
					$select_fields .= " , $table_name.invoice_date";
				}
                
                if($main_table == 'project_assigned' || $main_table == 'project_task_assigned' || $main_table == 'general_reminder' || $main_table == 'project_timetracker' || $main_table == 'client_visit'){
					 $select_fields .= " ,user.full_name";
				}
				
            }
        }
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        
        if(isset($where) && !empty($where)){
			$sql .= $where." AND ";
		}
		
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 ";
		
		/*$branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
		if($main_table == "user" || $main_table == "purchase_order" || $main_table == "invoice" || $main_table == "accounts_transaction"){
			if($branch_id != 0) {
				$sql.=" AND $main_table.ref_branch_id = '".$branch_id."'";
			}
		}*/
        
        if(isset($group_by) && !empty($group_by)){
			$sql .= " GROUP BY ".$group_by;
		}
       
        if (isset($order_by) && !empty($order_by)) {
            $sql .= " ORDER BY ".$order_by;
        }
        
        if (isset($limit) && !empty($limit)) {
            $sql .= " LIMIT ".$limit;
        }
       
        /*  echo $sql;
        echo "<br>";
        exit;*/
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getProductWiseSalesReportData($main_table, $where = '', $group_by = '', $order_by = '', $limit = '') {
        $table_fields      = $this->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        foreach ($table_fields as $data) {
            if ($this->startsWith($data, 'ref_')) {
                $ref_field      = $data;
                $primary_field  = str_replace('ref_', '', $data);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
            }
        }
        $sql .= "SELECT product.product_id,product.product_name,product.quantity, product_batch.product_batch_name, invoice_particulars.price, gst_type.gst_perc, SUM(invoice_particulars.qty) AS Total_Quantity, SUM(invoice_particulars.gst) AS Total_GST, SUM(invoice_particulars.sub_total) AS Total_SubTotal, SUM(invoice_particulars.total) AS Total";
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
		}
		$sql .= " LEFT JOIN gst_type ON gst_type.gst_type_id = product.ref_gst_type_id ";
		//$sql .= " LEFT JOIN product_batch ON product_batch.product_batch-id = product.ref_product_batch_id ";
        $sql .= " WHERE ";
        
        if(isset($where) && !empty($where)){
			$sql .= $where." AND ";
		}
		
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 ";
        
        if(isset($group_by) && !empty($group_by)){
			$sql .= " GROUP BY ".$group_by;
		}
       
        if (isset($order_by) && !empty($order_by)) {
            $sql .= " ORDER BY ".$order_by;
        }
        
        if (isset($limit) && !empty($limit)) {
            $sql .= " LIMIT ".$limit;
        }
       
        //  echo $sql; exit;
        //echo "<br>";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getPatientInvoiceReportData($main_table, $where = '', $group_by = '', $order_by = '', $limit = '') {
        $table_fields      = $this->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        foreach ($table_fields as $data) {
            if ($this->startsWith($data, 'ref_')) {
                $ref_field      = $data;
                $primary_field  = str_replace('ref_', '', $data);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
            }
        }
        $sql .= "SELECT invoice.invoice_name,invoice.invoice_date, patient.patient_name,customer.customer_name,invoice.ref_patient_id, invoice.invoice_id, invoice.invoice_file,invoice.discount_total,invoice.gst_total, invoice.p_and_f_total, invoice.sub_total, invoice.grand_total,payment_type.payment_type_name, invoice.ref_payment_type_id ";
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
		}
		//$sql .= " LEFT JOIN payment_type ON payment_type.payment_type_id = product.ref_payment_type_id";
	//	$sql .= " LEFT JOIN patient ON patient.patient_id = invoice.ref_patient_id ";
	//	$sql .= " LEFT JOIN customer ON customer.customer_id = invoice.ref_customer_id ";
        $sql .= " WHERE ";
        
        if(isset($where) && !empty($where)){
			$sql .= $where." AND ";
		}
		
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 ";
       
        //  echo $sql; exit;
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function getRecordsCount($main_table, $where = '', $group_by = '', $order_by = '', $limit = '')
    {
        $table_fields      = $this->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        foreach ($table_fields as $data) {
            if ($this->startsWith($data, 'ref_')) {
                $ref_field      = $data;
                $primary_field  = str_replace('ref_', '', $data);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                $select_fields .= " , $table_name.$ref_data_field";
            }
        }
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        
        if(isset($where) && !empty($where)){
			$sql .= $where." AND ";
		}
		
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 ";
		
		/*$branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
		if($main_table == "user" || $main_table == "purchase_order" || $main_table == "invoice" || $main_table == "accounts_transaction"){
			if($branch_id != 0) {
				$sql.=" AND $main_table.ref_branch_id = '".$branch_id."'";
			}
		}*/
        
        if(isset($group_by) && !empty($group_by)){
			$sql .= " GROUP BY ".$group_by;
		}
       
        if (isset($order_by) && !empty($order_by)) {
            $sql .= " ORDER BY ".$order_by;
        }
        
        if (isset($limit) && !empty($limit)) {
            $sql .= " LIMIT ".$limit;
        }
       
         //echo $sql;
        //echo "<br>";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    
	
	function convert_number($number) 
		{	 
		if (($number < 0) || ($number > 999999999)) 
		{ 
		throw new Exception("Number is out of range");
		} 

		$Gn = floor($number / 1000000);  /* Millions (giga) */ 
		$number -= $Gn * 1000000; 
		$ln = floor($number / 100000);  /* Millions (giga) */ 
		$number -= $ln * 100000; 
		$kn = floor($number / 1000);     /* Thousands (kilo) */ 
		$number -= $kn * 1000; 
		$Hn = floor($number / 100);      /* Hundreds (hecto) */ 
		$number -= $Hn * 100; 
		$Dn = floor($number / 10);       /* Tens (deca) */ 
		$n = $number % 10;               /* Ones */ 

		$res = ""; 

		if ($Gn) 
		{ 
			$res .= $this->convert_number($Gn) . " Million"; 
		} 
		if ($ln) 
		{ 
			$res .= $this->convert_number($ln) . " Lak"; 
		} 

		if ($kn) 
		{ 
			$res .= (empty($res) ? "" : " ") .$this->convert_number($kn) . " Thousand"; 
		} 

		if ($Hn) 
		{ 
			$res .= (empty($res) ? "" : " ") .$this->convert_number($Hn) . " Hundred"; 
		} 

		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); 
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
			"Seventy", "Eigthy", "Ninety"); 

		if ($Dn || $n) 
		{ 
			if (!empty($res)) 
			{ 
				$res .= " and "; 
			} 

			if ($Dn < 2) 
			{ 
				$res .= $ones[$Dn * 10 + $n]; 
			} 
			else 
			{ 
				$res .= $tens[$Dn]; 

				if ($n) 
				{ 
					$res .= "-" . $ones[$n]; 
				} 
			} 
		} 

		if (empty($res)) 
		{ 
			$res = "zero"; 
		} 

		return $res; 
	} 
	
	function TxnBegin(){
		$this->db->query("START TRANSACTION");
		$this->db->query("BEGIN");
	}
	
	function TxnCommit(){
		$this->db->query("COMMIT");	
	}
	
	function TxnRollBack(){
		$this->db->query("ROLLBACK");	
	}
	
	
	function getExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	
	// Codeignetor thumb Image Creation
	function image_thumb( $image_path,$image) {
		$height = '150';
		$width = '150';
		
		// Get the CodeIgniter super object
		$CI =& get_instance();
		
		// Thumb DIR create If not Exist
		$thumb_path = dirname( $image_path ) . '/thumb/';
		if (!file_exists($thumb_path)) {
				mkdir($thumb_path, 0777, true);
			}
			
		// Path to image thumbnail
		$image_thumb =  $thumb_path.$image;

		if ( !file_exists( $image_thumb ) ) {
			// LOAD LIBRARY
			$CI->load->library( 'image_lib' );

			// CONFIGURE IMAGE LIBRARY
			$config['image_library']    = 'gd2';
			$config['source_image']     = $image_path;
			$config['new_image']        = $image_thumb;
			$config['maintain_ratio']   = TRUE;
			$config['height']           = $height;
			$config['width']            = $width;
			$CI->image_lib->initialize( $config );
			$CI->image_lib->resize();
			$CI->image_lib->clear();
		}
	}
	
	function upload_file($image,$tmp_image,$path)
		{	
			//echo $path;
			//echo "<br>";
			$success ="";
			$error ="";
			$invalid ="";
			$upload_path = "uploads/".$path."/";
			$thumb_path = "uploads/".$path."/thumb/";
			
			if (!file_exists($upload_path)) {
				mkdir($upload_path, 0777, true);
			}
			
			if (!file_exists($thumb_path)) {
				mkdir($thumb_path, 0777, true);
			}

			$file_name = time().'_'.rand(10,999).'_'.$image;
			$target_file = $upload_path.$file_name;
			//echo "<br>";
			$thumb_file = $thumb_path.$file_name;
			//echo "<br>";
			$file_ext = explode('.',$image);
			//print_r($file_ext);
			$ext = $file_ext[1];
			$allowedext = array("jpg","png","jpeg","gif","pdf",'xlsx');
			$exist = array();
			if(in_array($ext,$allowedext)){ // Check the file extension
				$file = $tmp_image;
				move_uploaded_file($file,$target_file); // Move image to the folde
			}else{
				$invalid[] = $image;
			}
			if($ext !="pdf" && $ext !="xlsx"){
				$this->make_thumb($target_file,$thumb_file);
			}
			
			if($exist){
				$exists= count($exist);
				echo "Existing Files(".$exists.")";
				foreach($exist as $exist_file){
					echo $exist_file;
				}
			}
			
			return $target_file;
			
		}
	
	function make_thumb($img_name,$filename)
	{
		
		$new_w = '150';
		$new_h = '150';
		//get image extension.
		$ext=$this->getExtension($img_name);
		//creates the new image using the appropriate function from gd library
		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
			$src_img=imagecreatefromjpeg($img_name);
		
		if(!strcmp("JPG",$ext) || !strcmp("JPEG",$ext))
			$src_img=imagecreatefromjpeg($img_name);
					 
		if(!strcmp("png",$ext))
			$src_img=imagecreatefrompng($img_name);
			
		if(!strcmp("PNG",$ext))
			$src_img=imagecreatefrompng($img_name);
					 
		//gets the dimmensions of the image
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
				 
		$ratio1=$old_x/$new_w;
		$ratio2=$old_y/$new_h;
		if($ratio1>$ratio2)
		{
			$thumb_w=$new_w;
			$thumb_h=$old_y/$ratio1;
		}
		else 
		{
			$thumb_h=$new_h;
			$thumb_w=$old_x/$ratio2;
		}
				 
		// we create a new image with the new dimmensions
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		 
		// resize the big image to the new created one
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
				 
		// output the created image to the file. Now we will have the thumbnail into the file named by $filename
		if(!strcmp("png",$ext))
			imagepng($dst_img,$filename);
		else
			imagejpeg($dst_img,$filename);
				 
		//destroys source and destination images.
			imagedestroy($dst_img);
			imagedestroy($src_img);
	}
	
	function generateThumb($source_image, $tn_w, $tn_h)
        {
		//echo $source_image;
		//$source_image = explode('.',$source_image);
			
		//print_r($source_image);
		if(empty($source_image)){
            $image = asset_url().'images/logo.jpg';
        }else{
			
            if(!file_exists(FCPATH.$source_image)){
                $image = asset_url().'images/logo.jpg';
            }else{  
				    
				$quality = 100;

				$wmsource = false;			
				$url = FCPATH.$source_image;
				$pos = strrpos($url, '/');
				
				$image_name = $pos === false ? $url : substr($url, $pos + 1);
				
				$folder = str_replace('/'.$image_name,'',$url);
				
				// Thumb DIR create If not Exist
				$thumb_path = $folder. '/thumb/';
				$source_image = FCPATH.$source_image;
				if (!file_exists($thumb_path)) {
					mkdir($thumb_path, 0777, true);
				}
								
				$destination = $image_name;
				$destination_image_parts = explode('.',str_replace('./','',$destination));
				$destination = $destination_image_parts[0].'_'.$tn_w.'x'.$tn_h.'.'.$destination_image_parts[1]; 
				$destination = $thumb_path.$destination;
				
				
				if (!file_exists($destination)) {
					
					$info = getimagesize($source_image);
					$imgtype = image_type_to_mime_type($info[2]);

					#assuming the mime type is correct
					switch ($imgtype) {
						case 'image/jpeg':
							$source = imagecreatefromjpeg($source_image);
							break;
						case 'image/gif':
							$source = imagecreatefromgif($source_image);
							break;
						case 'image/png':
							$source = imagecreatefrompng($source_image);
							break;
						default:
						  //  die('Invalid image type.');
					}

					#Figure out the dimensions of the image and the dimensions of the desired thumbnail
					$src_w = imagesx($source);
					$src_h = imagesy($source);


					#Do some math to figure out which way we'll need to crop the image
					#to get it proportional to the new size, then crop or adjust as needed

					$x_ratio = $tn_w / $src_w;
					$y_ratio = $tn_h / $src_h;

					if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
						$new_w = $src_w;
						$new_h = $src_h;
					} elseif (($x_ratio * $src_h) < $tn_h) {
						$new_h = ceil($x_ratio * $src_h);
						$new_w = $tn_w;
					} else {
						$new_w = ceil($y_ratio * $src_w);
						$new_h = $tn_h;
					}

					$newpic = imagecreatetruecolor(round($new_w), round($new_h));
					
					$backgroundColor = imagecolorallocate($newpic, 255, 255, 255);
					imagefill($newpic, 0, 0, $backgroundColor);
					
					imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
					
					$final = imagecreatetruecolor($tn_w, $tn_h);
					$backgroundColor = imagecolorallocate($final, 255, 255, 255);
					imagefill($final, 0, 0, $backgroundColor);
					
					//imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
					
					imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);

					#if we need to add a watermark
					if ($wmsource) {
						#find out what type of image the watermark is
						$info    = getimagesize($wmsource);
						$imgtype = image_type_to_mime_type($info[2]);

						#assuming the mime type is correct
						switch ($imgtype) {
							case 'image/jpeg':
								$watermark = imagecreatefromjpeg($wmsource);
								break;
							case 'image/gif':
								$watermark = imagecreatefromgif($wmsource);
								break;
							case 'image/png':
								$watermark = imagecreatefrompng($wmsource);
								break;
							default:
								die('Invalid watermark type.');
						}

						#if we're adding a watermark, figure out the size of the watermark
						#and then place the watermark image on the bottom right of the image
						$wm_w = imagesx($watermark);
						$wm_h = imagesy($watermark);
						imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);

					}    
					imagejpeg($final, $destination);
					chmod($destination, 0777);
					}
					$image = base_url().str_replace(FCPATH,'',$destination);
				}
			}    
            return $image;
    }
	
	function getTableDetails($main_table, $where_data,$sort_data = "")
    {       
        $table_fields      = $this->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        if(isset($table_fields) && !empty($table_fields)){
			foreach ($table_fields as $data) {
				if ($this->startsWith($data, 'ref_')) {
					$ref_field      = $data;
					$primary_field  = str_replace('ref_', '', $data);
					$table_name     = str_replace('_id', '', $primary_field);
					$ref_data_field = $table_name . "_name";
					$join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";

					if($main_table === 'bill'){
						$select_fields .= " , patient.patient_no,patient_admission.patient_admission_code,op_register.op_register_code";
					}

/*
					if($main_table == 'bill_service'){
						$select_fields .= " , service.service_rate";
					}
					if($main_table == 'patient_admission' || $main_table == 'op_register'){
						$select_fields .= " , patient.patient_no";
					}
*/
					$select_fields .= " , $table_name.$ref_data_field";
				}
			}
		}
		
		
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 AND ";
        $where_sql = array();
        if(isset($where_data) && !empty($where_data)){
			foreach($where_data as $key => $val){
				foreach($val as $key => $val){
					 if (strpos($val, '_date') !== false ) {
						$where_sql[] = " date($main_table.$key) = '".$val."'";
					}else{
						$where_sql[] = " $main_table.$key = '".$val."'";
					}
				}
			}
		}
        if(isset($where_sql) && !empty($where_sql)){
			$sql .= implode(' AND ',$where_sql);
		}

		$sort_sql = array();
       if(isset($sort_data) && !empty($sort_data)){
			foreach($sort_data as $key => $val){
				foreach($val as $key => $val){
						$sort_sql[] = " $main_table.$key $val ";
					}
				}
			}
		
		if(isset($sort_sql) && !empty($sort_sql)){
			$sql .= " ORDER BY ".implode(' , ',$sort_sql);
		}
		
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function getIDArray($data,$id_field){
		$result = array();
		if(isset($data) && !empty($data)){
			foreach($data as $key => $val){
				$result[] = $val->$id_field;
			}
		}
		return 	$result;
	}	
	
	function convertToHoursMins($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}
	
	function printArray($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	
	function printArrayExit($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		exit;
	}
    
    function formatUrl($url){
		$url = str_replace('http://','',$url);
		$url = str_replace('https://','',$url);
		$url = str_replace('HTTP://','',$url);
		$url = str_replace('HTTPS://','',$url);
		return $url;
	}	
	
	public function smssend($mobile,$message){
		//echo $mobile;
		//~ echo 'aaaaaa';
		//~ echo SMS_API_THROUGH;
		if(SMS_API_THROUGH == '2'){ // External Server
			//$mobile = '7502973484';
			//$message = 'Test From cURL method '.date('d-m-Y H:i:s');
			$curl_method = SMS_CURL_METHOD;
			if(SMS_ACTIVE_API == '1'){
				$url_temp = SMS_API_URL_TEMPLATE_1;
			}
			if(SMS_ACTIVE_API == '2'){
				$url_temp = SMS_API_URL_TEMPLATE_2;
			}
			if(SMS_ACTIVE_API == '3'){
				$url_temp = SMS_API_URL_TEMPLATE_3;
			}
			if(SMS_ACTIVE_API == '4'){
				$url_temp = SMS_API_URL_TEMPLATE_4;
			}
			$api_url_template = str_replace('&','||',$url_temp);
			$request = "mobile=$mobile&message=$message&curl_method=$curl_method&api_url_template=$api_url_template";
			//exit;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, SMS_API_REMOTE_LINK);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
			
			$response = curl_exec($ch);
			curl_close($ch);
			return $response;
		}else{
			$message = str_replace(' ','%20',$message);
			if(SMS_ACTIVE_API == '1'){
				$request = SMS_API_URL_TEMPLATE_1;
			}
			if(SMS_ACTIVE_API == '2'){
				$request = SMS_API_URL_TEMPLATE_2;
			}
			if(SMS_ACTIVE_API == '3'){
				$request = SMS_API_URL_TEMPLATE_3;
			}
			if(SMS_ACTIVE_API == '4'){
				$request = SMS_API_URL_TEMPLATE_4;
			}
			
			$request = str_replace('{MOBILE}',$mobile,$request);
			$request = str_replace('{MESSAGE}',$message,$request);
			$request = str_replace('***','%0a',$request);
			if(SMS_CURL_METHOD == '1'){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, $request);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$response=curl_exec($ch);
				curl_close($ch);
				return $response;
			}else{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
				$response=curl_exec($ch);
				curl_close($ch);
				return $response;
			}
		}
	}
	
	public function smssend1($mobile,$message){
		//echo SMS_CURL_METHOD;
		//echo $message;
		$message = str_replace(' ','%20',$message);
		if(SMS_ACTIVE_API == '1'){
			$request = SMS_API_URL_TEMPLATE_1;
		}
		if(SMS_ACTIVE_API == '2'){
			$request = SMS_API_URL_TEMPLATE_2;
		}
		if(SMS_ACTIVE_API == '3'){
			$request = SMS_API_URL_TEMPLATE_3;
		}
		if(SMS_ACTIVE_API == '4'){
			$request = SMS_API_URL_TEMPLATE_4;
		}
		
		$request = str_replace('{MOBILE}',$mobile,$request);
		 $request = str_replace('{MESSAGE}',$message,$request);
		//exit;
		if(SMS_CURL_METHOD == '1'){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $request);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$response=curl_exec($ch);
			curl_close($ch);
			return $response;
		}else{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
			$response=curl_exec($ch);
			curl_close($ch);
			return $response;
		}

	}
	
	function sendEmail($mail_data,$print_body=0){
		//~ echo '<pre>';
		//~ print_r($mail_data);
		//~ echo '</pre>';
		//~ exit;
		$this->load->library('email');
		if(MAIL_PROTOCOL == 'smtp'){
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = SMTP_HOSTNAME;
			$config['smtp_port']    = SMTP_PORT;
			$config['smtp_timeout'] = SMTP_TIMEOUT;
			$config['smtp_user']    = SMTP_USERNAME;
			$config['smtp_pass']    = SMTP_PASSWORD;
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not      
			$this->email->initialize($config);
		}
		
		$to = array();
		$cc = array();
		$bcc = array();
		$this->email->set_mailtype("html");
		$this->email->from($mail_data['from_address'],MAIL_FROM_NAME);
		$this->email->to($mail_data['to_address']);
		if (!empty($cc)) {
			$this->email->cc($cc);
		}
		if (!empty($bcc)) {
			$this->email->bcc($bcc);
		}
		$this->email->subject($mail_data['subject']);
		$body = '';
		if(isset($mail_data['template_path']) && !empty($mail_data['template_path'])){
			$body = $this->parser->parse($mail_data['template_path'],$mail_data,TRUE);
		}else{
			$body = $mail_data['message'];
		}
		if($print_body){
			echo $body;
			exit;
		}
		$this->email->message($body);	
		
		if(isset($mail_data['attachment']) && !empty($mail_data['attachment'])){
			if(is_array($mail_data['attachment'])){
				foreach($mail_data['attachment'] as $k => $v){
					$this->email->attach($v);
				}
			}else{
				$this->email->attach($mail_data['attachment']);
			}
		}
		
		if($this->email->send()){
			$this->email->clear(TRUE);
			return true;
		}else{
			//echo 'Simple Mail'; exit;
			//debug($mail_data); //exit;
			$this->email->clear(TRUE);
			$to = $mail_data['to_address'];

			$file =  $mail_data['attachment'];
			$file_size = filesize($file);
			$handle = fopen($file, "r");
			$content = fread($handle, $file_size);
			fclose($handle);

			$content = chunk_split(base64_encode($content));
			$uid = md5(uniqid(time()));
			$name = basename($file);

			 $filenameArray = explode('/',$mail_data['attachment']);
			 $filename = end($filenameArray);
			 $uid = md5(uniqid(time()));


			 $subject = $mail_data['subject'];
			if(isset($mail_data['template_path']) && !empty($mail_data['template_path'])){
				$body = $this->parser->parse($mail_data['template_path'],$mail_data,TRUE);
			}else{
				$body = $mail_data['message'];
			}

			$eol = PHP_EOL;
			$replyto = $mail_data['reply_to'];
			$from_mail =$mail_data['from_address'];
			$from_name = $mail_data['from_name'];
			// Basic headers
			$header = "From: ".$from_name." <".$from_mail.">".$eol;
			$header .= "Reply-To: ".$replyto.$eol;
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

			// Put everything else in $message
			$message = "--".$uid.$eol;
			$message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
			$message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
			$message .= $body.$eol;
			$message .= "--".$uid.$eol;
			$message .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
			$message .= "Content-Transfer-Encoding: base64".$eol;
			$message .= "Content-Disposition: attachment; filename=\"".$filename."\"".$eol;
			$message .= $content.$eol;
			$message .= "--".$uid."--";

			if (mail($to, $subject, $message, $header)){

				return true;
			}else{
				return false;
			}		
		}			
	}
	function sendEmailNewTest($mail_data,$print_body=0){

		$to = $mail_data['to_address'];

		$file =  $mail_data['attachment'];
		$file_size = filesize($file);
		$handle = fopen($file, "r");
		$content = fread($handle, $file_size);
		fclose($handle);

		$content = chunk_split(base64_encode($content));
		$uid = md5(uniqid(time()));
		$name = basename($file);

		 $filenameArray = explode('/',$mail_data['attachment']);
		 $filename = end($filenameArray);
		 $uid = md5(uniqid(time()));

		 $subject = $mail_data['subject'];
		if(isset($mail_data['template_path']) && !empty($mail_data['template_path'])){
			$body = $this->parser->parse($mail_data['template_path'],$mail_data,TRUE);
		}else{
			$body = $mail_data['message'];
		}

		$eol = PHP_EOL;
		$replyto = $mail_data['reply_to'];
		$from_mail =$mail_data['from_address'];
		$from_name = $mail_data['attachment'];
		// Basic headers
		$header = "From: ".$from_name." <".$from_mail.">".$eol;
		$header .= "Reply-To: ".$replyto.$eol;
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

		// Put everything else in $message
		$message = "--".$uid.$eol;
		$message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
		$message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
		$message .= $body.$eol;
		$message .= "--".$uid.$eol;
		$message .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
		$message .= "Content-Transfer-Encoding: base64".$eol;
		$message .= "Content-Disposition: attachment; filename=\"".$filename."\"".$eol;
		$message .= $content.$eol;
		$message .= "--".$uid."--";

		if (mail($to, $subject, $message, $header)){

			return true;
		}else{
			return false;
		}
}
	
	function get_random_number($length=0)
	{
		if(!$length){
			$length = 6;
		}
		$alphabet    = '1234567890';
		$pass        = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < $length; $i++) {
		    $n      = rand(0, $alphaLength);
		    $pass[] = $alphabet[$n];
		}
		return implode($pass);
	}
	
	function getGmailContactByCurl($url) {
		$curl = curl_init();
		$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';

		curl_setopt($curl, CURLOPT_URL, $url);   //The URL to fetch. This can also be set when initializing a session with curl_init().
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);    //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);   //The number of seconds to wait while trying to connect.    

		curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //The contents of the "User-Agent: " header to be used in a HTTP request.
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);  //To follow any "Location: " header that the server sends as part of the HTTP header.
		curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); //To automatically set the Referer: field in requests where it follows a Location: redirect.
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);   //The maximum number of seconds to allow cURL functions to execute.
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //To stop cURL from verifying the peer's certificate.
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

		$contents = curl_exec($curl);
		curl_close($curl);
		return $contents;
	}
	
	function getGmailContact($auth_code) {
		$accesstoken = '';
		//~ $client_id = '331570309656-ftkigi0h3ht0o055an8a4lh8lgug2t2e.apps.googleusercontent.com';
		//~ $client_secret = 'CRHIZOffaiRhjY3MmAXh_eup';
		//~ $redirect_uri = 'http://localhost/gopal_trucks/index.php/client/getGmailContactCallback';
		//~ $simple_api_key = 'AIzaSyAmzDCSu6HjyYlUGuN4MSnAd5nq6MH2LU4';
		//~ $max_results = 5000;
		
		$client_id = GM_CLIENT_ID;
		$client_secret = GM_CLIENT_SECRET;
		$redirect_uri = GM_REDIRECT_URI;
		$simple_api_key = GM_API_KEY;
		$max_results = GM_MAX_RESULT;
		
		$auth_code = $auth_code;
	
		$fields = array(
			'code' => urlencode($auth_code),
			'client_id' => urlencode($client_id),
			'client_secret' => urlencode($client_secret),
			'redirect_uri' => urlencode($redirect_uri),
			'grant_type' => urlencode('authorization_code')
		);
		$post = '';
		foreach ($fields as $key => $value) {
			$post .= $key . '=' . $value . '&';
		}
		$post = rtrim($post, '&');

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
		curl_setopt($curl, CURLOPT_POST, 5);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		$result = curl_exec($curl);

		curl_close($curl);

		$response = json_decode($result);
		   
		if (isset($response->access_token)) {
			$accesstoken = $response->access_token;
			$_SESSION['access_token'] = $response->access_token;
		}

		if (isset($_GET['code'])) {
			$accesstoken = $_SESSION['access_token'];
		}

		if (isset($_REQUEST['logout'])) {
			unset($_SESSION['access_token']);
		}

		$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results=' . $max_results . '&oauth_token=' . $accesstoken;
		$xmlresponse = $this->getGmailContactByCurl($url);
		if ((strlen(stristr($xmlresponse, 'Authorization required')) > 0) && (strlen(stristr($xmlresponse, 'Error ')) > 0)) {
			echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
			exit();
		}


	$xmlContacts = new SimpleXMLElement($xmlresponse);
	$xmlContacts->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
	
	$contactsArray = array();

	foreach ($xmlContacts->entry as $xmlContactsEntry) {
		$contactDetails = array();
		
		$contactDetails['id'] = (string) $xmlContactsEntry->id;
		$contactDetails['name'] = (string) $xmlContactsEntry->title;
		$contactDetails['content'] = (string) $xmlContactsEntry->content;

		foreach ($xmlContactsEntry->children() as $key => $value) {
			$attributes = $value->attributes();

			if ($key == 'link') {
				if ($attributes['rel'] == 'edit') {
					$contactDetails['editURL'] = (string) $attributes['href'];
				} elseif ($attributes['rel'] == 'self') {
					$contactDetails['selfURL'] = (string) $attributes['href'];
				} elseif ($attributes['rel'] == 'http://schemas.google.com/contacts/2008/rel#edit-photo') {
					$contactDetails['photoURL'] = (string) $attributes['href'];
				}
			}
		}

		$contactGDNodes = $xmlContactsEntry->children('http://schemas.google.com/g/2005');
		
		foreach ($contactGDNodes as $key => $value) {
			switch ($key) {
				case 'organization':
					$contactDetails[$key]['orgName'] = (string) $value->orgName;
					$contactDetails[$key]['orgTitle'] = (string) $value->orgTitle;
					break;
				case 'email':
					$attributes = $value->attributes();
					$emailadress = (string) $attributes['address'];
					$emailtype = substr(strstr($attributes['rel'], '#'), 1);
					$contactDetails[$key][] = ['type' => $emailtype, 'email' => $emailadress];
					break;
				case 'phoneNumber':
					$attributes = $value->attributes();
					//$uri = (string) $attributes['uri'];
					$type = substr(strstr($attributes['rel'], '#'), 1);
					//$e164 = substr(strstr($uri, ':'), 1);
					$contactDetails[$key][] = ['type' => $type, 'number' => $value->__toString()];
					break;
				default:
					$contactDetails[$key] = (string) $value;
					break;
			}
		}
		//~ echo "<pre>";
		//~ print_r($contactDetails);
		//~ echo "</pre>";
		$contactsArray[] = (object) $contactDetails;
	}
		return $contactsArray;
	}
	
	function getClientList(){
		$sql   = "SELECT client_id,client_name FROM client WHERE delete_status = 0 AND transaction_id = 0";
		$admin_user_group_id = explode(",",ADMIN_USER_GROUP_ID);
		$user_group = $this->session->userdata( SESSION_LOGIN . 'user_group' );
		if(!in_array($user_group[0],$admin_user_group_id))
		{
			$sql .= " AND FIND_IN_SET('".$this->employee_id."',client.employee_id) ";
		}
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

	function get_product_qty($product_id){
		 $sql = 'SELECT SUM(avail_quantity) as qty FROM `product_batch` WHERE delete_status = 0 and transaction_id = 0 AND ref_product_id = "'.$product_id.'"';

		/*if($this->branch_id !=0 ){
			$sql .= ' AND ref_branch_id = '.$this->branch_id;
		}*/
		
		$query = $this->db->query($sql);
		if ( $query->num_rows() >= 1 ) {
			$res = $query->result();
			if(!empty($res[0]->qty)){
				return $res[0]->qty;
			}else{
				return 0;
			}
		} else {
			return false;
		}
	}


}
?>
