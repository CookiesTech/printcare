<?php
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
class Report extends CI_Controller
  {
    function __construct()
      {
        parent::__construct();
        $this->load->model( array(
            'Report_model',
            'Reminder/Reminder_model'
        ) );

        $session_data = $this->session->userdata( SESSION_LOGIN . 'logged_in' );	
        $data['username'] = $session_data['username'];
        $data['permission'] = $this->session->userdata( SESSION_LOGIN . 'user_permission' );
        $data['user'] = $this->Common_model->getDropdownList( 'user' );
        $data['title'] = 'Reports';
        $this->load->view( 'common/header', $data );
       
       // echo $this->output->enable_profiler(TRUE);  
      }
    function hasPermission( $page )
      {
        $res_permission = $this->session->userdata( SESSION_LOGIN . 'user_permission' );
        if ( $res_permission && !empty( $res_permission ) )
          {
            if ( !in_array( $page, $res_permission ) )
              {
                redirect( 'access_denied', 'refresh' );
              }
          }
        else
          {
            redirect( 'home' );
          }
      }
  
     
   
     function chart_patient_by_refence(){
          $res = $this->Report_model->get_patient_by_reference();
          //debug($res); exit;
          $x_val = array();
          $y_val = array();
          if(isset($res) && !empty($res)){
            foreach ($res as $key => $val) {
                $x_val[] = $val->patient_reference_name;
                $y_val[] = (int)$val->total;
            }
          }

          $data['x_val_data'] = json_encode($x_val);
          $data['y_val_data'] = json_encode($y_val);
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_refence', $data );
          $this->load->view( 'common/footer' );
    }

    function chart_patient_by_diagnosis(){
          $res = $this->Report_model->get_patient_by_diagnosis();
          //debug($res); exit;
          $x_val = array();
          $y_val = array();
          if(isset($res) && !empty($res)){
            foreach ($res as $key => $val) {
                $x_val[] = $val->ayurveda_diagnosis_name;
                $y_val[] = (int)$val->total;
            }
          }

          $data['x_val_data'] = json_encode($x_val);
          $data['y_val_data'] = json_encode($y_val);
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_diagnosis', $data );
          $this->load->view( 'common/footer' );
    }

    function chart_patient_by_m_diagnosis(){
          $res = $this->Report_model->get_patient_by_m_diagnosis();
          //debug($res); exit;
          $x_val = array();
          $y_val = array();
          if(isset($res) && !empty($res)){
            foreach ($res as $key => $val) {
                $x_val[] = $val->m_diagnosis_name;
                $y_val[] = (int)$val->total;
            }
          }

          $data['x_val_data'] = json_encode($x_val);
          $data['y_val_data'] = json_encode($y_val);
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_m_diagnosis', $data );
          $this->load->view( 'common/footer' );
    }

    function chart_patient_by_modern_system(){
          $res = $this->Report_model->get_patient_by_modern_system();
          //debug($res); exit;
          $x_val = array();
          $y_val = array();
          if(isset($res) && !empty($res)){
            foreach ($res as $key => $val) {
                $x_val[] = $val->modern_system_name;
                $y_val[] = (int)$val->total;
            }
          }

          $data['x_val_data'] = json_encode($x_val);
          $data['y_val_data'] = json_encode($y_val);
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_modern_system', $data );
          $this->load->view( 'common/footer' );
    }

    function chart_patient_by_gender(){
          $male = $this->Report_model->get_patient_by_gender('male');
          $female = $this->Report_model->get_patient_by_gender('female');
          $data['male']=$male[0]->total;
          $data['female']=$female[0]->total;
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_gender', $data );
          $this->load->view( 'common/footer' );
    }

    function chart_patient_by_age_group(){
          $res = $this->Report_model->get_patient_by_age_group();
          //debug($res); exit;
          $x_val = array();
          $y_val = array();
          /*if(isset($res) && !empty($res)){
            foreach ($res as $key => $val) {
                $x_val[] = $key;
                $y_val[] = (int)$val;
            }
          }*/

          $x_val = array(
            'Under 10',
            '10 - 19',
            '20 - 29',
            '30 - 39',
            '40 - 49',
            '50 - 59',
            '60 - 69',
            '70 - 79',
            '80 - 89',
            '90 - 99'
          );
          $y_val = array(
            (int) $res[0]->age_0_10,
            (int) $res[0]->age_10_19,
            (int) $res[0]->age_20_29,
            (int) $res[0]->age_30_39,
            (int) $res[0]->age_40_49,
            (int) $res[0]->age_50_59,
            (int) $res[0]->age_60_69,
            (int) $res[0]->age_70_79,
            (int) $res[0]->age_80_89,
            (int) $res[0]->age_90_99
          );

          $data['x_val_data'] = json_encode($x_val);
          $data['y_val_data'] = json_encode($y_val);
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_age_group', $data );
          $this->load->view( 'common/footer' );
    }


    function chart_patient_by_treatment(){
          $res_aayurveda = $this->Report_model->get_patient_by_treatment('1');
          $res_panchkarma = $this->Report_model->get_patient_by_treatment('2');
          $res_both = $this->Report_model->get_patient_by_treatment('3');
          
          $x_val = array();
          $y_val = array();
          if(isset($res) && !empty($res)){
            foreach ($res as $key => $val) {
                //$x_val[] = $val->gender;
                $y_val[] = (int)$val->total;
            }
          }

          $x_val = array(
            'Aayurveda',
            'Panchkarma',
            'Both'
          );
          $y_val = array(
            (int) $res_aayurveda[0]->total,
            (int) $res_panchkarma[0]->total,
            (int) $res_both[0]->total
          );

          $data['x_val_data'] = json_encode($x_val);
          $data['y_val_data'] = json_encode($y_val);
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_treatment', $data );
          $this->load->view( 'common/footer' );
    }    


    function chart_patient_by_new_old(){
          $res_old_patient = $this->Report_model->get_patient_by_new_old('1');
          $res_new_patient = $this->Report_model->get_patient_by_new_old('0');
         
        
          $data['old_patient_count'] = $res_old_patient[0]->total;
          $data['new_patient_count'] = $res_new_patient[0]->total;
          
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_new_old', $data );
          $this->load->view( 'common/footer' );
    }
    function chart_patient_by_status(){ // active / inactive
          $res_active_patient = $this->Report_model->get_patient_by_status('active');
          $res_inactive_patient = $this->Report_model->get_patient_by_status('inactive');
          //debug($res_active_patient);
         // debug($res_inactive_patient); exit;
        
          $data['active_patient_count'] = $res_active_patient[0]->total;
          $data['inactive_patient_count'] = $res_inactive_patient[0]->total;
          
          //debug($data); exit;
          $this->load->view( 'common/menu' );
          //$this->load->view( 'report/report_list', $data );
          $this->load->view( 'report/chart_patient_by_status', $data );
          $this->load->view( 'common/footer' );
    }    

     public function export_product_reorder_excel()
    {   
        $where = 'quantity < reorder_level';
        $order_by = 'category_name ASC, product_name ASC';
        $mainlist = $this->Common_model->getRecords('product',$where,'',$order_by);

        //debug($mainlist); exit;
       
        $j =1;
        if (isset($mainlist) && !empty($mainlist)) {
            foreach ($mainlist as $key => $val) {
                $export_list[] = array(
                     $j,
                     $val->product_name,
                     $val->category_name,
                     $val->sku,
                     $val->quantity                    
                );
            $j++; }
        }
         
       $export_column = array(
            'SNo',            
            'Product',
            'Category',
            'SKU',
            'Qty'
        );
        //}

        $export        = array();
        $export[0]     = $export_column;
    
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }

        $this->Common_model->generateExcel($export,'product_reorder_report' . date('Y-m-d_H:i:s'));
    }


    public function export_product_expiry_excel()
    {   
        $expiry_date = date('Y-m-d',strtotime('+1 months'));
        $where = 'product_batch.expiry_date < "'.$expiry_date.'"';
        $order_by = 'product_batch.expiry_date ASC';
        $mainlist = $this->Common_model->getRecords('product_batch',$where,'',$order_by);

       // debug($mainlist); exit;
       
        $j =1;
        if (isset($mainlist) && !empty($mainlist)) {
            foreach ($mainlist as $key => $val) {
                $export_list[] = array(
                     $j,
                     $val->product_name,
                     $val->product_batch_name,
                     $val->avail_quantity,
                     getDateFormat($val->manufacture_date),                    
                     getDateFormat($val->expiry_date)                    
                );
            $j++; }
        }
         
       $export_column = array(
            'SNo',            
            'Product',
            'Batch',
            'Qty',
            'Manuf Date',
            'Expiry Date'
        );
        //}

        $export        = array();
        $export[0]     = $export_column;
    
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }

        $this->Common_model->generateExcel($export,'product_expiry_report' . date('Y-m-d_H:i:s'));
    }


  }
?>
