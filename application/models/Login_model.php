<?php
Class Login_model extends CI_Model
{
 function Checklogin($username, $password)
 {
   $this -> db -> select('*');
   $this -> db -> from('user');
   $this -> db -> where('user_name', $username);
   $this -> db -> where('password', MD5($password));
    $this -> db -> where(array('status' => '1','delete_status' => '0'));
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
	$session_data = $this->session->userdata(SESSION_LOGIN.'logged_in');
	$user_id = $session_data['id'];
	//echo "SELECT permission FROM user_group where user_group_id = '".$user_group."' AND delete_status = '0' AND transaction_id = '0'";
	$res_user_group = $this->getUsertoGroup($user_id);
	$permission = array();
	if(isset($res_user_group) && !empty($res_user_group)){
		foreach($res_user_group as $user_group_id){
			$user_group = $user_group_id->ref_user_group_id;
			$query = $this->db->query("SELECT permission FROM user_group where user_group_id = '".$user_group."' AND delete_status = '0' AND transaction_id = '0'");
			  foreach($query->result() as $key => $val){
					$access = unserialize($val->permission);
					foreach($access as $key1 => $val1){
						foreach($val1 as $key2 => $val2){
							$permission[] =  $key1.'_'.$key2;
						}
					}
				}
			}
		}
		return $permission;
	}
	
	function getUsertoGroup($id){
		$query = $this->db->query("SELECT ref_user_group_id FROM user_to_group WHERE ref_user_id = '".$id."' AND delete_status = '0' AND transaction_id = '0'");
		if($query -> num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function addLoginLogs($id){
		$ip = $_SERVER["REMOTE_ADDR"];
		$date = date('Y-m-d H:i:s');
		$query = $this->db->query(" INSERT login_user_logs 
									SET
										user_id = '".$id."',
										ip_address = '".$ip."',
										logged_in_date = '".$date."'");
										
		$query = $this->db->query(" update user SET login_time = '".$date."' WHERE user_id = '".$id."'");
	}
	
	function updateLog(){
		$date = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
		
		$query = $this->db->query("SELECT log_id FROM login_user_logs WHERE user_id = '".$user_id."' ORDER BY log_id DESC LIMIT 0,1	");
		$res = $query->result();
		
		$query = $this->db->query("UPDATE login_user_logs SET logged_out_date = '".$date."' WHERE log_id = '".$res[0]->log_id."'");
	
		$query = $this->db->query(" update user SET last_login_time = login_time, login_time = '' WHERE user_id = '".$user_id."'");						
	}
	
	
    function CheckIp(){
        $ip = $_SERVER["REMOTE_ADDR"];
        
        $time = date('H:i:s');
        $query = $this->db->query("SELECT * FROM authorised_ip WHERE authorised_ip_name = '".trim($ip)."' AND ('".$time."' BETWEEN authorised_ip_time_from  AND authorised_ip_time_to) AND delete_status = 0");
        
        if($query -> num_rows() >= 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    
}
?>
