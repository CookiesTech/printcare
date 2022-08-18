<?php
Class Report_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();
        $this->menu_html = '';
        $this->user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $this->employee_id = $this->session->userdata(SESSION_LOGIN . 'employee_id');
        $this->date_time = date('Y-m-d H:i:s');
    }
	

	function get_patient_by_reference(){
		$sql = 'SELECT COUNT(*) as total,pr.patient_reference_name FROM patient AS p LEFT JOIN patient_reference AS pr ON p.ref_patient_reference_id = pr.patient_reference_id  WHERE p.delete_status = 0 AND p.transaction_id = 0 GROUP BY p.ref_patient_reference_id ';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}

	function get_patient_by_diagnosis(){
		$sql = 'SELECT COUNT(*) as total,ad.ayurveda_diagnosis_name FROM patient_visit AS pv LEFT JOIN ayurveda_diagnosis AS ad ON pv.ref_ayurveda_diagnosis_id = ad.ayurveda_diagnosis_id  WHERE pv.delete_status = 0 AND pv.transaction_id = 0 GROUP BY pv.ref_ayurveda_diagnosis_id ';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}

	function get_patient_by_m_diagnosis(){
		$sql = 'SELECT COUNT(*) as total,md.m_diagnosis_name FROM patient_visit AS pv LEFT JOIN m_diagnosis AS md ON pv.ref_m_diagnosis_id = md.m_diagnosis_id  WHERE pv.delete_status = 0 AND pv.transaction_id = 0 GROUP BY pv.ref_m_diagnosis_id ';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}

	function get_patient_by_modern_system(){
		$sql = 'SELECT COUNT(*) as total,ms.modern_system_name FROM patient_visit AS pv LEFT JOIN modern_system AS ms ON pv.ref_modern_system_id = ms.modern_system_id  WHERE pv.delete_status = 0 AND pv.transaction_id = 0 GROUP BY pv.ref_modern_system_id';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}

	function get_patient_by_gender($gender){
		//$sql = 'SELECT COUNT(*) as total,p.gender FROM patient AS p WHERE p.delete_status = 0 AND p.transaction_id = 0 GROUP BY p.gender' ;
		$sql = 'SELECT COUNT(*) as total,p.gender FROM patient AS p WHERE p.delete_status = 0 AND p.transaction_id = 0 and p.gender="'.$gender.'"';
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}


	function get_patient_by_treatment($type='3'){
		if($type == '1'){
			$sql = 'SELECT COUNT(*) as total FROM patient_visit WHERE aayurveda = 1 AND delete_status = 0 AND transaction_id = 0';
		}else if($type == '2'){
			$sql = 'SELECT COUNT(*) as total FROM patient_visit WHERE panchkarma = 1 AND delete_status = 0 AND transaction_id = 0';
		}else{
			$sql = 'SELECT COUNT(*) as total FROM patient_visit WHERE aayurveda = 1 AND panchkarma = 1 AND delete_status = 0 AND transaction_id = 0 ';
		}
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}

	function get_patient_by_age_group(){
		$sql = "SELECT
				    SUM(IF(age < 10,1,0)) as 'age_0_10',
				    SUM(IF(age BETWEEN 10 and 19,1,0)) as 'age_10_19',
				    SUM(IF(age BETWEEN 20 and 29,1,0)) as 'age_20_29',
				    SUM(IF(age BETWEEN 30 and 39,1,0)) as 'age_30_39',
				    SUM(IF(age BETWEEN 40 and 49,1,0)) as 'age_40_49',
				    SUM(IF(age BETWEEN 50 and 59,1,0)) as 'age_50_59',
				    SUM(IF(age BETWEEN 60 and 69,1,0)) as 'age_60_69',
				    SUM(IF(age BETWEEN 60 and 69,1,0)) as 'age_70_79',
				    SUM(IF(age BETWEEN 60 and 69,1,0)) as 'age_80_89',
				    SUM(IF(age BETWEEN 60 and 69,1,0)) as 'age_90_99'
				FROM patient WHERE delete_status = 0 AND transaction_id = 0";
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}


	function get_patient_by_new_old($type){
		$sql = "SELECT COUNT(*) as total FROM patient_visit WHERE delete_status = 0 AND transaction_id = 0 ";
		if($type == '1'){ // Old Patient
			$sql .= " AND old_patient = 1";
		}else{ // New Patient
			$sql .= " AND old_patient = 0";
		}
		
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}

	function get_patient_by_status($type){
		$sql = "SELECT COUNT(*) as total FROM patient_visit WHERE delete_status = 0 AND transaction_id = 0 ";
		if($type == 'active'){ // Active Patient
			$sql .= " AND date(added_date) <= '".date('Y-m-d',strtotime('-6 months'))."'";
		}else{ // Inactive Patient
			$sql .= " AND date(added_date) >= '".date('Y-m-d',strtotime('-6 months'))."'";
		}

		//$sql .=" GROUP BY ref_patient_id";
		
		$query = $this->db->query( $sql );
		if ( $query->num_rows() >= 1 ) {
            return $query->result();
        } else {
            return false;
        }
	}

	



}
?>
