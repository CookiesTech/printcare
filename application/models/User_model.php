<?php
Class User_model extends CI_Model {
    function getUserlist() {
        $query = $this->db->query( "SELECT u.* ,g.user_group_name AS user_group_name, u.status FROM user AS u LEFT JOIN user_group AS g ON g.user_group_id = u.ref_user_group_id WHERE u.transaction_id = 0 AND u.delete_status = 0 AND u.user_id NOT IN (".HIDE_USER.")" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function addUser( $data ) {
		$date = date('Y-m-d H:i:s');	
        $query = $this->db->query( "INSERT INTO user SET full_name = '" . $data[ 'full_name' ] . "',nick_name = '" . $data[ 'nick_name' ] . "',  user_name = '" . $data[ 'name' ] . "', email = '" . $data[ 'email' ] . "',audit_record = '" . $data[ 'audit_record' ] . "', password
	  = '" . md5( $data[ 'password' ] ) . "', status = '" . $data[ 'status' ] . "', added_date = '".$date."',ref_branch_id = '" . $data[ 'ref_branch_id' ] . "'" );
        $last_id = $this->db->insert_id();
        if(isset($data['user_group_id']) && !empty($data['user_group_id'])){
			foreach($data['user_group_id'] as $key => $val){
				 $query = $this->db->query( "INSERT INTO user_to_group SET ref_user_id = '" . $last_id . "',ref_user_group_id = '" . $val."', added_date = '".$date."'" );
			}
		}        
		return $last_id;
    }
    function getUsergroups() {
        $query = $this->db->query( "SELECT * FROM user_group WHERE transaction_id = 0 AND delete_status = 0 ORDER BY user_group_name ASC" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getUser( $id ) {
        $query = $this->db->query( "SELECT * FROM user WHERE user_id = '" . $id . "' ");
        if ( $query->num_rows() == 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function updateUser( $data, $id ) {
        if ( isset( $data[ 'password' ] ) && !empty( $data[ 'password' ] ) ) {
			//$last_id = $this->addUser($data);
			 $query = $this->db->query( "UPDATE user SET full_name = '" . $data[ 'full_name' ] . "',nick_name = '" . $data[ 'nick_name' ] . "', user_name = '" . $data[ 'name' ] . "',  email = '" . $data[ 'email' ] . "', audit_record = '" . $data[ 'audit_record' ] . "', password = '".md5( $data['password'])."', status = '" . $data[ 'status' ] . "',ref_branch_id = '" . $data[ 'ref_branch_id' ] . "' WHERE user_id = '" . $id . "'" );
        } else {
            $query = $this->db->query( "UPDATE user SET full_name = '" . $data[ 'full_name' ] . "',nick_name = '" . $data[ 'nick_name' ] . "', user_name = '" . $data[ 'name' ] . "', email = '" . $data[ 'email' ] . "',audit_record = '" . $data[ 'audit_record' ] . "',status = '" . $data[ 'status' ] . "',ref_branch_id = '" . $data[ 'ref_branch_id' ] . "' WHERE user_id = '" . $id . "'" );
        }
        
       // $last_id = $this->db->insert_id();
	   $date = date('Y-m-d H:i:s');
        if(isset($data['user_group_id']) && !empty($data['user_group_id'])){
			$this->db->query( " DELETE FROM user_to_group  WHERE ref_user_id = '".$id."'" );
			foreach($data['user_group_id'] as $key => $val){
				 $query = $this->db->query( "INSERT INTO user_to_group SET ref_user_id = '" . $id . "',ref_user_group_id = '" . $val."', added_date = '".$date."'" );
			}
		}        		
        return $id;
    }
    function removeUser($id){
		$this->db->query("UPDATE user SET delete_status = '1' WHERE user_id = '" . $id . "'");
		return $id;
	}
	
	function getUserLogs( $data ) {
		if(isset($data['to']) && !empty($data['to'])){
			$to = date('Y-m-d',strtotime($data['to']));
		}else{
			$to = date('Y-m-d');
		}
		if(isset($data['from']) && !empty($data['from'])){
			$from =date('Y-m-d',strtotime($data['from']));
		}else{
			$from =  date('Y-m-d');
		}
	
        $query = $this->db->query( "SELECT l.*,u.user_name FROM `login_user_logs` AS l left join user AS u on u.user_id = l.user_id WHERE date(l.logged_in_date) BETWEEN '".$from."' AND '".$to."' ORDER BY l.logged_in_date DESC" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
  
	function updateAccountSetting($id,$data,$type){
		if($type == 'password'){
			$query = $this->db->query( "UPDATE user SET full_name = '" . $data[ 'full_name' ] . "',nick_name = '" . $data[ 'nick_name' ] . "',session_time_limit = '".$data['session_time_limit']."',reminder_interval_time = '".$data['reminder_interval_time']."', password = '" . md5($data[ 'password' ]) . "' WHERE user_id = '" . $id . "'" );
		}else{
			$query = $this->db->query( "UPDATE user SET full_name = '" . $data[ 'full_name' ] . "',nick_name = '" . $data[ 'nick_name' ] . "',session_time_limit = '".$data['session_time_limit']."',reminder_interval_time = '".$data['reminder_interval_time']."' WHERE user_id = '" . $id . "'" );
		}
		return $id;
	}
	
    function getList($table,$sort_data='',$filter_data='',$user) {
		$main_table = $table['tbl_main']; 
				
		$sql = '';
						
		$sql .= "SELECT $main_table.*,u1.full_name AS user_from,u2.full_name AS user_to FROM $main_table";
		
		$sql .= " LEFT JOIN user AS u1 ON u1.user_id = $main_table.member_from";
		
		$sql .= " LEFT JOIN user AS u2 ON u2.user_id = $main_table.member_to";
								
		$sql .= " WHERE ";
					
		$sql .= " $main_table.transaction_id = 0 AND ";
		$sql .= " $main_table.delete_status = 0";
		
		
		if(isset($filter_data) && !empty($filter_data)){
				if(!empty($filter_data['user_to'])){
					$sql .= " AND $main_table.member_from = '".$user."' AND u2.full_name = '".$filter_data['user_to']."' ";
				}
				
				if(!empty($filter_data['date_from']) && !empty($filter_data['date_to'])){
					$from_date = date('Y-m-d',strtotime($filter_data['date_from']));
					$to_date = date('Y-m-d',strtotime($filter_data['date_to']));
					
					$sql .= " AND ( DATE($main_table.sent) BETWEEN '".$from_date."' AND '".$to_date."') ";
				}
		}else{
			$sql .= " AND $main_table.member_from = '".$user."' OR $main_table.member_to = '".$user."' ";
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
/*
		echo $sql;
		exit;
*/
		$query = $this->db->query( $sql);
		if ( $query->num_rows() >= 1 ) {
			return $query->result();
		} else {
			return false;
		}
    }
}
?>
