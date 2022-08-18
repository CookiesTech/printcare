<?php
Class Supplier_model extends CI_Model {    
	private $menu_html;
	 public function __construct() {
        parent::__construct();
        $this->menu_html = '';
    }    

    function generate_supplier_code() {
		$query = $this->db->query("SELECT supplier_no FROM supplier WHERE transaction_id = 0 ORDER BY supplier_no DESC LIMIT 1");
		
		$res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = $result[0]->supplier_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }

        $date = date('dmY');
        $res_code['supplier_no'] = $unique_no_final;
        $res_code['supplier_code'] = 'SUP-'.$date.'-'.$unique_no_final;
		return 	$res_code;
        //SUP-ddMMyyyy-0001
    }

}
?>
