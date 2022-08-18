<?php

class User

{

    private $CI;

    public $customer_id;

    public function __construct()

    {

        $this->CI = & get_instance();

        $this->customr_id = @$this->CI->session->userdata('customr_id');

    }

    public function logged_in_user_details(){

        

        $customer_details = $this->CI->Common_model->getRecord('customer','customer_id', $this->customr_id);

        return $customer_details[0];

    }

    public function temp_product_quantity(){

        //debug($customr_id);

        $temp_product = $this->CI->Common_model->getRecords('temp_product', 'customer_id="'.$this->customr_id.'"');

        $total_quantity = 0;

        foreach($temp_product as $temp_key => $temp_val){

            $total_quantity += $temp_val->quantity;

        }

        return $total_quantity;

    }

    public function get_order_id(){

        $query = $this->CI->db->query("SELECT customer_order_id FROM customer_order  ORDER BY customer_order_id DESC LIMIT 1");

        $res_code = array();

        if ($query->num_rows() >= 1) {

            $result = $query->result();
           
            $unique_no     = $result[0]->customer_order_id;

            if ($unique_no != '') {

                $unique_no = $unique_no + 1;

            }

            $unique_no_final = str_pad($unique_no, 4, '0', STR_PAD_LEFT);

        } else {

             $unique_no_final = '0001';           

        }        

        $date = date('y').'-'.date('y',strtotime('+1 year'));

        $res_code = 'KM/'.$date.'/'.$unique_no_final;
        
        return  $res_code;

    }

}

