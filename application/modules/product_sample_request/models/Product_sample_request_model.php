<?php
Class Product_sample_request_model extends CI_Model {    
	private $menu_html;
	 public function __construct() {
        parent::__construct();
        $this->menu_html = '';
    }    

	function get_sof_code($data)
    {
		$query = $this->db->query("SELECT product_sample_request_no FROM product_sample_request ORDER BY product_sample_request_no DESC LIMIT 1");
		
		$res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = $result[0]->product_sample_request_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
                
        $query = $this->db->query("SELECT supplier_code,ref_company_id FROM supplier WHERE supplier_id = '".$data['ref_supplier_id']."'");
        $result = $query->result();
        $supplier_code = $result[0]->supplier_code;
        
        $query = $this->db->query("SELECT company_code FROM company WHERE company_id = '".$result[0]->ref_company_id."'");
        $result = $query->result();
        $company_code = $result[0]->company_code;
        
        $year = date('Y');
        
        $res_code['product_sample_request_no'] = $unique_no_final;
        $res_code['product_sample_request_code'] = $company_code.'/'.$supplier_code.'/'.$unique_no_final.'/'.$year;
		return 	$res_code;
    }
    
    function get_dc_code($data)
    {
		$query = $this->db->query("SELECT delivery_challan_no FROM delivery_challan ORDER BY delivery_challan_no DESC LIMIT 1");
		
		$res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = $result[0]->delivery_challan_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
                
        $query = $this->db->query("SELECT supplier_code,ref_company_id FROM supplier WHERE supplier_id = '".$data['ref_supplier_id']."'");
        $result = $query->result();
        $supplier_code = $result[0]->supplier_code;
        
        $query = $this->db->query("SELECT company_code FROM company WHERE company_id = '".$result[0]->ref_company_id."'");
        $result = $query->result();
        $company_code = $result[0]->company_code;
        
        $year = date('Y');
        
        $res_code['delivery_challan_no'] = $unique_no_final;
        $res_code['delivery_challan_code'] = $company_code.'/'.$supplier_code.'/'.$unique_no_final.'/'.$year;
		return 	$res_code;
    }


	function get_pi_code($data)
    {
		$query = $this->db->query("SELECT proforma_invoice_no FROM proforma_invoice ORDER BY proforma_invoice_no DESC LIMIT 1");
		
		$res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = $result[0]->proforma_invoice_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
                
        $query = $this->db->query("SELECT supplier_code,ref_company_id FROM supplier WHERE supplier_id = '".$data['ref_supplier_id']."'");
        $result = $query->result();
        $supplier_code = $result[0]->supplier_code;
        
        $query = $this->db->query("SELECT company_code FROM company WHERE company_id = '".$result[0]->ref_company_id."'");
        $result = $query->result();
        $company_code = $result[0]->company_code;
        
        $year = date('Y');
        
        $res_code['proforma_invoice_no'] = $unique_no_final;
        $res_code['proforma_invoice_code'] = $company_code.'/'.$supplier_code.'/'.$unique_no_final.'/'.$year;
		return 	$res_code;
    }


     function get_dc_code_from_dc($data)
    {
	
	$query = $this->db->query("SELECT dc_no FROM dc ORDER BY dc_no DESC LIMIT 1");
		
		$res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = $result[0]->delivery_challan_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
                
        $query = $this->db->query("SELECT supplier_code,ref_company_id FROM supplier WHERE supplier_id = '".$data['ref_supplier_id']."'");
        $result = $query->result();
        $supplier_code = $result[0]->supplier_code;
        
        $query = $this->db->query("SELECT company_code FROM company WHERE company_id = '".$result[0]->ref_company_id."'");
        $result = $query->result();
        $company_code = $result[0]->company_code;
        
        $year = date('Y');
        
        $res_code['delivery_challan_no'] = $unique_no_final;
        $res_code['delivery_challan_code'] = $company_code.'/'.$supplier_code.'/'.$unique_no_final.'/'.$year;
		return 	$res_code;
    }
    function updateQty($product_sample_request_id,$ref_product_id,$qty){
        $this->db->query("UPDATE product_sample_request_particulars SET delivered_qty = delivered_qty + $qty WHERE ref_product_sample_request_id = '".$product_sample_request_id."' AND ref_product_id = '".$ref_product_id."'");

        return true;
    }
}
?>
