<?php
Class Purchase_Order_model extends CI_Model {    
	private $menu_html;
	 public function __construct() {
        parent::__construct();
        $this->menu_html = '';
    }    


    function update_product_quantity($product_id,$qty,$type='add'){        
        if($type == 'add'){
            $query = $this->db->query("UPDATE product SET quantity = quantity + $qty WHERE product_id = '".$product_id."'");
        }else{
            $query = $this->db->query("UPDATE product SET quantity = quantity - $qty WHERE product_id = '".$product_id."'");        
        }
        return true;
    }

	function get_po_code($data,$branch_id)
    {
		$query = $this->db->query("SELECT purchase_order_no FROM purchase_order WHERE delete_status = 0 AND transaction_id = 0 ORDER BY purchase_order_no DESC LIMIT 1");
		
		$res_code = array();
        if ($query->num_rows() >= 1) {
            $result = $query->result();
            $unique_no     = $result[0]->purchase_order_no;
            if ($unique_no != '') {
                $unique_no = $unique_no + 1;
            }
            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
        } else {
             $unique_no_final = '0001';           
        }
                
       /* $query = $this->db->query("SELECT supplier_code,ref_company_id FROM supplier WHERE supplier_id = '".$data['ref_supplier_id']."'");
        $result = $query->result();
        $supplier_code = $result[0]->supplier_code;
        */
        /*$query = $this->db->query("SELECT company_code FROM company WHERE company_id = '".$result[0]->ref_company_id."'");
        $result = $query->result();
        $company_code = $result[0]->company_code;*/
		
	
        $b_code = 'D';
        $date = date('dmY');
       
        $res_code['purchase_order_no'] = $unique_no_final;
        
        $res_code['purchase_order_code'] = 'PO-'.$b_code.'-'.$date.'-'.$unique_no_final;
		return 	$res_code;
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
    function get_gst_based_purchase($purchase_order_id,$gst_per)
    {
        $sql="SELECT round((sum(gst)/2),2) as gst_val,round(sum(sub_total),2) as sub_total, gst_perc FROM `purchase_order_particulars` where ref_purchase_order_id=".$purchase_order_id." and gst_perc=".$gst_per." group by ref_purchase_order_id, gst_perc";
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

    function get_purchase_order_list($filter_data){
        $main_table = 'purchase_order';

        $sql .= "SELECT $main_table.*,c.client_name,s.supplier_name FROM $main_table ";

         $sql .= " LEFT JOIN client as c ON c.client_id = $main_table.ref_client_id ";   
         $sql .= " LEFT JOIN supplier as s ON s.supplier_id = $main_table.ref_supplier_id ";   
         $sql .= " LEFT JOIN purchase_order_particulars as pop ON pop.ref_purchase_order_id = $main_table.purchase_order_id WHERE ";   
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
                $sql .= " $main_table.purchase_order_date BETWEEN '".$from_date."' AND '".$to_date."' AND ";
            }
            if(!empty($filter_data['po_no'])){
                $sql .= " $main_table.purchase_order_no = '".$filter_data['po_no']."' AND ";
            }
        }

        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 ";
        $sql .= " GROUP BY $main_table.purchase_order_id ";
        $sql .= " ORDER BY $main_table.purchase_order_date ";
        
        /*echo $sql;
        exit;*/

        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }

    }

    function po_particulars($main_table, $id_field, $id) {
        $sql = "select ref_product_id,supplier_comm_perc,price,qty,supplier_comm_total,gst_perc,sub_total,gst,total from $main_table where $id_field = $id AND delete_status = 0 AND transaction_id = 0 ";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function updatePop($main_table,$id_field,$data,$id)
    {
        $this->db->where($id_field, $id);
        $this->db->update($main_table, $data);
        return $id;
        //$this->db->last_query();
    }

}
?>
