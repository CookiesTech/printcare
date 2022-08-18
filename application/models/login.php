<?php
Class Login extends CI_Model
{
 function Checklogin($username, $password)
 {
   $this -> db -> select('id, username, password,user_group');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', MD5($password));
    $this -> db -> where('status', '1');
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 
 function checkPermission(){
	$session_data = $this->session->userdata('logged_in');
	$user_group = $session_data['user_group'];
	//echo "SELECT permission FROM user_group where user_group_id = '".$user_group."' AND delete_status = '0' AND transaction_id = '0'";
	$query = $this->db->query("SELECT permission FROM user_group where user_group_id = '".$user_group."' AND delete_status = '0' AND transaction_id = '0'");
	  foreach($query->result() as $key => $val){
			$access = unserialize($val->permission);
			foreach($access as $key1 => $val1){
				foreach($val1 as $key2 => $val2){
					$permission[] =  $key1.'_'.$key2;
				}
			}
		}
		return $permission;
	}
	
	function addLoginLogs($id){
		$ip = $_SERVER["REMOTE_ADDR"];
		$date = date('Y-m-d H:i:s');
		$query = $this->db->query(" INSERT login_user_logs 
									SET
										user_id = '".$id."',
										ip_address = '".$ip."',
										logged_in_date = '".$date."'");
	}
	
	function updateLog(){
		$date = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata('user_id');
		
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
}
?>
