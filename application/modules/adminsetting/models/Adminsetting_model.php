<?php
Class Adminsetting_model extends CI_Model
{
    private $menu_html;
    public function __construct()
    {
        parent::__construct();
    }
    function updateTable($data)
    {
        $sql   = $data['sql_query'];
        $query = $this->db->query("$sql");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function backupTable($tables, $name)
    {
        $return = '';
        if ($tables == '*') {
            $tables = array();
            $query  = $this->db->query('SHOW TABLES');
            foreach ($query->result() AS $key => $val) {
                $tables[] = $val->Tables_in_crm;
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }
        $return .= "CREATE DATABASE $name DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE $name;";
        foreach ($tables as $table) {
            $query       = $this->db->query('SELECT * FROM ' . $table);
            $num_fields  = $query->num_fields();
            $query1      = $this->db->query('SHOW CREATE TABLE ' . $table);
            $row2        = $query1->result();
            $tab_str_arr = array();
            foreach ($query1->result() as $tab_str) {
                foreach ($tab_str as $tab_str1) {
                    $tab_str_arr[] = $tab_str1;
                }
            }
            $return .= "" . $tab_str_arr[1] . ";";
            foreach ($query->result() AS $key => $val) {
                $table_field = array();
                foreach ($val as $assokey) {
                    $table_field[] = $assokey;
                }
                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $num_fields; $j++) {
                    $table_field[$j] = addslashes($table_field[$j]);
                    $table_field[$j] = str_replace("nn", " ", $table_field[$j]);
                    if (isset($table_field[$j])) {
                        $return .= '"' . $table_field[$j] . '"';
                    } else {
                        $return .= '""';
                    }
                    if ($j < ($num_fields - 1)) {
                        $return .= ',';
                    }
                }
                $return .= ");";
            }
            $return .= "";
        }
        $file_name = 'db-backup-' . time() . '-' . $name . '.sql';
        $full_name = 'backup/'.$file_name;
        $handle = fopen($full_name, 'w+');
        fwrite($handle, $return);
        fclose($handle);
        
        $user_id = $this->session->userdata('user_id');
        $date    = date('Y-m-d H:i:s');
        
        $this->db->query("INSERT INTO table_backup SET table_backup_name ='".$file_name."', user_id = '".$user_id."', added_date = '".$date."'");
        return $file_name;
    }
    
    function getDbTables(){
		return $this->db->list_tables();
	}
	
	function getUserActivity( $data ) {
		if(isset($data['to']) && !empty($data['to'])){
			
			$to = date('Y-m-d',strtotime($data['to']));
		}else{
			$to = date('Y-m-d');
		}
		if(isset($data['from']) && !empty($data['from'])){
			$from =date('Y-m-d',strtotime($data['from']));
		}else{
			$from =  date('Y-m-d',strtotime("-7 day"));
		}
        $query = $this->db->query( "SELECT 
										a.*,
										u.user_name
										FROM user_activity AS a
										JOIN user AS u ON u.user_id = a.ref_user_id
									    WHERE date(a.added_date) BETWEEN '".$from."' AND '".$to."' ORDER BY a.added_date
										" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function addAdminsetting1( $data)
    {	
        if(isset($data['adminsetting']) && !empty($data['adminsetting'])){
			$query = $this->db->query( "DELETE FROM admin_setting");
			foreach($data['adminsetting'] as $key => $val){
				//$query = $this->db->query( "DELETE FROM admin_setting WHERE admin_setting_key ='".$key."'");
				
				$query = $this->db->query( "INSERT INTO admin_setting SET admin_setting_key = '".$key."', admin_setting_value ='".$val."'");  
			}
		}
  
        return true;
    }
    
    
    function addAdminsetting( $data, $type)
    {	
		$logo_img = '';
        if (isset($data['logo']['name']) && !empty($data['logo']['name'])) {
			$logo_image = $data['logo'];
            $logo_img   = $this->Common_model->upload_file($logo_image['name'], $logo_image['tmp_name'], 'logo');
        }
        //~ $data          = $data['main'];
		//~ if(!empty($logo_img)){
			//~ $data['adminsetting']['LOGO'] =  $logo_img;
		//~ }
       //~ 
        if(isset($data['adminsetting']) && !empty($data['adminsetting'])){
			$this->db->query( "DELETE FROM admin_setting WHERE type = '".$type."'");
			foreach($data['adminsetting'] as $key => $val){
				$query = $this->db->query( "INSERT INTO admin_setting SET admin_setting_key = '".$key."', admin_setting_value ='".$val."',type='".$type."' ");  
			}
		}
	
        return true;
    }
    
    function updateRecord($main_table, $data, $id ) { 
		//~ echo "<pre>";
		//~ print_r($data);
		//~ echo "</pre>";
		//~ exit;
        $user_id = $this->session->userdata('user_id');
        $date = date('Y-m-d H:i:s');
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
                }
                else {
                    $main_data[$key]         = $value;
                    $main_data['ref_user_id'] = $user_id;
                    $main_data['added_date'] = $date;
                }
            }
        }
        $primary_field = $main_table.'_id';
        $res_record   = $this->Common_model->getRecord($main_table, $primary_field, $id);
        $audit_record = $res_record[0];
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
		//$audit_record_final['ref_user_id']    = $user_id;
        $audit_record_final['transaction_id'] = $id;
        $audit_record_final['added_date']     = date("Y-m-d H:i:s");
        $last_id                              = $this->Common_model->addRecord($main_table,$audit_record_final,$id);
        //update Current record 
        $this->db->where($main_table.'_id', $id);
        $this->db->update($main_table, $main_data);
		
		// Sub table data insertion - Mobile number and Email ids
		if(isset($sub_table_data) && !empty($sub_table_data)){
			foreach ($sub_table_data as $key => $value1) {
				$this->db->where('ref_'.$main_table.'_id', $id);
				$this->db->update($key, array('delete_status' => 1));
				$new_table = $key;
				foreach ($value1 as $key => $value) {
					$value['ref_'.$main_table.'_id'] = $id;
					$value['ref_user_id'] = $user_id;
					$value['added_date'] = $date;
					$new_data = $value;
					$this->db->insert($new_table, $new_data);
				}
			}
		}
		// Ends here
		return $last_id;
        
    }
    
    function getMenu($id){
		 $query = $this->db->query( "SELECT 
										m.*
										FROM menu AS m
									    WHERE m.menu_id = '".$id."'
										" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getUserlist() {
        $query = $this->db->query( "SELECT u.* ,g.user_group_name AS user_group_name, u.status FROM user AS u LEFT JOIN user_group AS g ON g.user_group_id = u.ref_user_group_id WHERE u.transaction_id = 0 AND u.delete_status = 0 " );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function getSortingFields($table, $column,$where)
    {
		$col = implode(',', $column);
		
		$sql = "SELECT ".$table."_id,$col,sort_order FROM " . $table . ""; 
		$sql .= " WHERE ";
		
		if(isset($where) && !empty($where)){
			$sql .= $where." AND ";
		}
		$sql .= "delete_status = '0' AND transaction_id = '0' order by sort_order asc";
        
        $query = $this->db->query($sql);
		
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
	 function updateSorting($table,$where_field, $id,$order)
    {
		$update_data = array('sort_order' => $order);
		$this->db->where($where_field, $id);
		$this->db->update($table, $update_data);
		//echo $this->db->last_query();
		return true;
	}
	
    
}
?>
