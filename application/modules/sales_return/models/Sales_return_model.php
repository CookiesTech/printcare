<?php
Class Sales_return_model extends CI_Model {    
	private $menu_html;
	 public function __construct() {
        parent::__construct();
        $this->menu_html = '';
    }    

 function update_product_commission($invoice_id,$commission){  
        $query = $this->db->query("UPDATE accounts_transaction SET accounts_transaction_credit = '".$commission."' WHERE ref_invoice_id = '".$invoice_id."'");        
        return true;
    }
    function update_product_quantity($product_id,$qty,$type='add'){        
        if($type == 'add'){
            $query = $this->db->query("UPDATE product SET quantity = quantity + $qty WHERE product_id = '".$product_id."'");
        }else{
            $query = $this->db->query("UPDATE product SET quantity = quantity - $qty WHERE product_id = '".$product_id."'");        
        }
        return true;
    }
    function update_product_batch_quantity($product_batch_id,$qty,$type='add'){        
        if($type == 'add'){
            $query = $this->db->query("UPDATE product_batch SET avail_quantity = avail_quantity + $qty WHERE product_batch_id = '".$product_batch_id."'");
        }else{
            $query = $this->db->query("UPDATE product_batch SET avail_quantity = avail_quantity - $qty WHERE product_batch_id = '".$product_batch_id."'");        
        }
        return true;
    }

     function get_gst_total($invoice_id){
        $query = $this->db->query("SELECT gst_perc,SUM(gst) as gst_total FROM invoice_particulars WHERE ref_invoice_id = '".$invoice_id."' AND delete_status = 0 AND transaction_id = 0 GROUP BY gst_perc");
        if ($query->num_rows() >= 1) {
            return $result = $query->result();
        }else{
            return false;
        }   
    }
    function get_gst_based_invoice($invoice_id,$gst_per)
    {
        $sql="SELECT round((sum(gst)/2),2) as gst_val,round(sum(sub_total),2) as sub_total, gst_perc FROM `invoice_particulars` where ref_invoice_id='".$invoice_id."' and gst_perc=".$gst_per." group by ref_invoice_id, gst_perc";
        //echo $sql;
        $query = $this->db->query($sql);
        $result=$query->result();
        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    function get_invoice_code($branch_id)
    {
        $cur_month = date('m');
        //$cur_month = 4;
        if ($cur_month > 3) {
            $year = date('y')."-".(date('y') +1);
        } else {
            $year = (date('y')-1)."-".date('y');
        }
        
        $query = $this->db->query("SELECT invoice_no FROM invoice WHERE ref_branch_id = '".$branch_id."' AND financial_year = '".$year."' AND delete_status = 0 AND transaction_id = 0 ORDER BY invoice_no DESC LIMIT 1");
        
        $res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
           // debug($result); exit;
            $unique_no     = $result[0]->invoice_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
        
		$query_1 = $this->db->query("SELECT branch_code FROM branch WHERE branch_id = '".$branch_id."'");
        $result_1 = $query_1->result();
        $branch_code = $result_1[0]->branch_code;
		
        //$date = date('y').'-'.date('y',strtotime('+1 year'));
        $res_code['invoice_no'] = $unique_no_final;
        if ($cur_month > 3) {
            $res_code['invoice_code'] = $branch_code.'/'.$year.'/KM/'.$unique_no_final;
        }else{
            $res_code['invoice_code'] = $branch_code.'/KM/'.$year.'/'.$unique_no_final;
        }
        return  $res_code;
        //20-21/KM/00001
    }
    
	function get_invoice_code1()
    {
		$query = $this->db->query("SELECT invoice_no FROM invoice WHERE delete_status = 0 AND transaction_id = 0 ORDER BY invoice_no DESC LIMIT 1");
		
		$res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = $result[0]->invoice_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
        
        $date = date('y').'-'.date('y',strtotime('+1 year'));
        
        $res_code['invoice_no'] = $unique_no_final;
        $res_code['invoice_code'] = 'KM/'.$date.'/'.$unique_no_final;
		return 	$res_code;
        //KM/20-21/001
    }

    function get_payment_code()
    {
        $query = $this->db->query("SELECT payment_history_no FROM payment_history WHERE delete_status = 0 AND transaction_id = 0 ORDER BY payment_history_no DESC LIMIT 1");
        
        $res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = $result[0]->payment_history_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
        
        $date = date('dmY');
        
        $res_code['payment_history_no'] = $unique_no_final;
        $res_code['payment_history_code'] = 'IN-'.$date.'-'.$unique_no_final;
        return  $res_code;
    }

    
    function get_dc_code($data)
    {
		$query = $this->db->query("SELECT delivery_challan_no FROM delivery_challan WHERE delete_status = 0 AND transaction_id = 0 ORDER BY delivery_challan_no DESC LIMIT 1");
		
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

     function get_dc_code_from_dc($data)
    {
	
	$query = $this->db->query("SELECT dc_no FROM dc WHERE delete_status = 0 AND transaction_id = 0 ORDER BY dc_no DESC LIMIT 1");
		
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

    function get_invoice_list($filter_data){
        $main_table = 'invoice';

        $sql .= "SELECT $main_table.*,c.client_name,s.supplier_name FROM $main_table ";

         $sql .= " LEFT JOIN client as c ON c.client_id = $main_table.ref_client_id ";   
         $sql .= " LEFT JOIN supplier as s ON s.supplier_id = $main_table.ref_supplier_id ";   
         $sql .= " LEFT JOIN invoice_particulars as pop ON pop.ref_invoice_id = $main_table.invoice_id WHERE ";   
        if(isset($filter_data) && !empty($filter_data)){
            
            if(!empty($filter_data['ref_client_id'])){
                $sql .= " $main_table.ref_client_id = '".$filter_data['ref_client_id']."' AND ";
            }
            if(!empty($filter_data['ref_supplier_id'])){
                $sql .= " $main_table.ref_supplier_id = '".$filter_data['ref_supplier_id']."' AND ";
            }
            if(!empty($filter_data['ref_product_id'])){
                $sql .= " pop.ref_product_id = '".$filter_data['ref_product_id']."' AND ";
            }
            if(!empty($filter_data['ref_product_quality_id'])){
                $sql .= " pop.ref_product_quality_id = '".$filter_data['ref_product_quality_id']."' AND ";
            }
            if(!empty($filter_data['ref_product_quality_size_id'])){
                $sql .= " pop.ref_product_quality_size_id = '".$filter_data['ref_product_quality_size_id']."' AND ";
            }
            if(!empty($filter_data['ref_product_variety_id'])){
                $sql .= " pop.ref_product_variety_id = '".$filter_data['ref_product_variety_id']."' AND ";
            }
            if(!empty($filter_data['payment_status'])){
               
                if($filter_data['payment_status'] == '2'){
                     $sql .= " $main_table.invoice_payment_status = '0' AND ";
                }else{
                     $sql .= " $main_table.invoice_payment_status = '".$filter_data['payment_status']."' AND ";
                }
            }
            
            if(!empty($filter_data['commission_status'])){
                
                if($filter_data['commission_status'] == '2'){
                    $sql .= " $main_table.invoice_commission_status = '0' AND ";
                }else{
                    $sql .= " $main_table.invoice_commission_status = '".$filter_data['commission_status']."' AND ";
                }
            }
            
            if(!empty($filter_data['from_date']) && !empty($filter_data['to_date'])){
                $from_date = date('Y-m-d',strtotime($filter_data['from_date']));
                $to_date = date('Y-m-d',strtotime($filter_data['to_date']));
                $sql .= " $main_table.invoice_date BETWEEN '".$from_date."' AND '".$to_date."' AND ";
            }
            if(!empty($filter_data['po_no'])){
                $sql .= " $main_table.invoice_no = '".$filter_data['po_no']."' AND ";
            }
        }

        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 ";
        $sql .= " GROUP BY $main_table.invoice_id ";
        $sql .= " ORDER BY $main_table.invoice_date ";
        
        /*echo $sql;
        exit;*/

        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }
	
	function get_customer_last_data() {
	$sql = "SELECT customer_id FROM customer ORDER BY customer_id DESC LIMIT 1";
	$query = $this->db->query($sql);
	if ($query->num_rows() >= 1) {
	return $query->result();
	} else {
	return false;
	}
	}
    function get_return_invoice_code($branch_id)
    {
        $cur_month = date('m');
        //$cur_month = 4;
        if ($cur_month > 3) {
            $year = date('y')."-".(date('y') +1);
        } else {
            $year = (date('y')-1)."-".date('y');
        }
        
        $query = $this->db->query("SELECT invoice_return_no FROM invoice_return WHERE ref_branch_id = ".$branch_id." AND financial_year = '".$year."' AND delete_status = 0 AND transaction_id = 0 ORDER BY invoice_return_no DESC LIMIT 1");
        //echo $this->db->last_query();
        $res_code = array();
        if ($query->num_rows() >= 1) 
        {
            $result = $query->result();
           // debug($result); exit;
            $unique_no     = $result[0]->invoice_return_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
        
		$query_1 = $this->db->query("SELECT branch_code FROM branch WHERE branch_id = '".$branch_id."'");
        $result_1 = $query_1->result();
        $branch_code = $result_1[0]->branch_code;
		
        //$date = date('y').'-'.date('y',strtotime('+1 year'));
        $res_code['invoice_no'] = $unique_no_final;
        if($branch_code=='MA')
        {
            $b_code="KM";
        }
        else{
            $b_code = $branch_code;
        }
        if ($cur_month > 3) {
            //$res_code['invoice_code'] = $branch_code.'/'.$year.'/KM/'.$unique_no_final;
            $res_code['invoice_code'] = 'R/'.$year.'/'.$b_code.'/'.$unique_no_final;
        }else{
            //$res_code['invoice_code'] = $branch_code.'/KM/'.$year.'/'.$unique_no_final;
            $res_code['invoice_code'] = 'R/'.$year.'/'.$b_code.'/'.$unique_no_final;
        }
        return  $res_code;
    }

    function getInvoiceListToReturn($branch_id=0){
        $lastWeek = date("Y-m-d", strtotime("-60 days"));

        $sql = "SELECT invoice_id, invoice_name FROM invoice WHERE delete_status = 0 AND transaction_id = 0 AND cancelled_by = 0 AND invoice_date >= '".$lastWeek."'";
        if($branch_id){
            $sql.= " AND ref_branch_id = ".$branch_id."";
        }
        $sql .= " ORDER BY invoice_id DESC"; 
        $query = $this->db->query($sql);

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }
	
}
?>
