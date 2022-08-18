<?php
Class Usergroup_model extends CI_Model {
    function getPages() {
        $this->db->select( '*' );
        $this->db->where( 'delete_status','0' );
        //$this->db->order_by('pages_name','desc');
        $this->db->from( 'pages' );
        $query = $this->db->get();
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getActions() {
        $this->db->select( '*' );
        $this->db->from( 'actions' );
        $query = $this->db->get();
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function addUserGroup( $data ) {
		$user_id = $this->session->userdata(SESSION_LOGIN.'user_id');
		$date = date('Y-m-d H:i:s');
        $query = $this->db->query( "INSERT INTO user_group SET user_group_name = '" . $data[ 'name' ] . "', permission = '" . serialize( $data[ 'permission' ] ) . "' , user_id = '".$user_id."', added_date = '".$date."'" );
        return $this->db->insert_id();
    }
    function getUsergroups() {
        $query = $this->db->query( "SELECT * FROM user_group WHERE transaction_id = 0 AND delete_status = 0" );
        if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getUserGroup( $id ) {
        $query = $this->db->query( "SELECT * FROM user_group WHERE user_group_id = '" . $id . "'" );
        if ( $query->num_rows() == 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function updateUserGroup( $data, $id ) {
		$user_id = $this->session->userdata(SESSION_LOGIN.'user_id');
		$query = $this->db->query( "UPDATE user_group SET user_group_name = '" . $data[ 'name' ] . "', permission = '" . serialize( $data[ 'permission' ] ) . "' , user_id = '".$user_id."' WHERE user_group_id = '".$id."'" );
		//$last_id = $this->addUserGroup($data);
        //$query = $this->db->query( "UPDATE user_group SET transaction_id = '" . $last_id . "' WHERE user_group_id = '" . $id . "'" );
       // $query = $this->db->query( "UPDATE users SET user_group = '" . $last_id . "' where user_group = '".$id."'" );
       return $id;
        
    }
    function removeUserGroup( $id ) {
        $query = $this->db->query( "UPDATE user_group SET delete_status = 1 WHERE user_group_id = '" . $id . "'" );
        return $id;
    }
}
?>
