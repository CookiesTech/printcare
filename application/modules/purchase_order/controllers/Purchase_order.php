<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Purchase_Order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Purchase_order_model'
        ));
        $this->load->helper(array(
            'form'
        ));
        //$this->load->library("Pdf");
        $session_data       = $this->session->userdata(SESSION_LOGIN . 'logged_in');
        $data['username']   = $session_data['username'];
        $data['permission'] = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        if (empty($data['permission'])) {
            redirect('home');
        }
        $data['designation']         = $this->Common_model->getDropdownList('designation');
        $data['user']            = $this->Common_model->getDropdownList('user');


        $data['title'] = 'Purchase Order';

        $this->load->view('common/header', $data);
    }
    function hasPermission($page)
    {
        $res_permission = $this->session->userdata(SESSION_LOGIN . 'user_permission');
        if ($res_permission && !empty($res_permission)) {
            if (!in_array($page, $res_permission)) {
                redirect('access_denied', 'refresh');
            }
        } else {
            redirect('home');
        }
    }

    function index()
    {
        $this->getlist();
    }
    function getlist()
    {
        $this->hasPermission('purchase_order_view');
        $filter_data = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter_data = $this->input->post();
            $reset_data  = $this->input->post('reset');
            if (isset($reset_data)) {
                $this->session->unset_userdata('filter_data');
                $filter_data = '';
            } else {
                $this->session->set_userdata('filter_data', $filter_data);
            }
        } else {
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
        }
        $data['filter_data'] = $filter_data;
        //$data      = array();
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
        // If not pagination page remove filter data from session
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
            $data['filter_data'] = '';
        }
        if (isset($segment_3)) {
            $page = $segment_3;
        } else {
            $page = '1';
        }
        if (isset($segment_4)) {
            $sort = $segment_4;
        } else {
            $sort = 'purchase_order_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }

        // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $data['page']             = $page;

        $filter_query_data      = array();
        $data['limit'] = '';
        if (isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])) {
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit'] = '?limit=' . $_REQUEST['limit'];
        } else {
            $start                     = (($page - 1) * RPP);
        }

        $data['start']                     = $start; // Generate SNO in result table based on page number
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;
        $where=" 1 ";
        $table['tbl_main']           = 'purchase_order';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data, 'purchase_order_id',$where);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data, 'purchase_order_id',$where);

        $data['tablefields1']      = $this->Common_model->getTableFields('purchase_order');
        $data['tablefields']       = array_merge($data['tablefields1']);
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'purchase_order/getlist/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        $data['stockin'] = 0;
        $this->load->view('common/menu');
        $this->load->view('purchase_order/purchase_order_list_view', $data);
        $this->load->view('common/footer');
    }


    function stockin_po_list()
    {
        $this->hasPermission('purchase_order_view');
        $filter_data = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter_data = $this->input->post();
            $reset_data  = $this->input->post('reset');
            if (isset($reset_data)) {
                $this->session->unset_userdata('filter_data');
                $filter_data = '';
            } else {
                $this->session->set_userdata('filter_data', $filter_data);
            }
        } else {
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
        }
        $data['filter_data'] = $filter_data;
        //$data      = array();
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
        // If not pagination page remove filter data from session
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
            $data['filter_data'] = '';
        }
        if (isset($segment_3)) {
            $page = $segment_3;
        } else {
            $page = '1';
        }
        if (isset($segment_4)) {
            $sort = $segment_4;
        } else {
            $sort = 'purchase_order_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }

        // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $data['page']             = $page;

        $filter_query_data      = array();
        $data['limit'] = '';
        if (isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])) {
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit'] = '?limit=' . $_REQUEST['limit'];
        } else {
            $start                     = (($page - 1) * RPP);
        }

        $data['start']                   = $start; // Generate SNO in result table based on page number
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;

        $table['tbl_main']           = 'purchase_order';
        $where = 'purchase_order.purchase_order_complete_status = 0';
        $data['mainlist_count']      = $this->Common_model->getListCount($table, $filter_data, 'purchase_order_id', $where);
        $data['mainlist']            = $this->Common_model->getList($table, $filter_query_data, $filter_data, 'purchase_order_id', $where);


        $data['tablefields1']      = $this->Common_model->getTableFields('purchase_order');
        $data['tablefields']       = array_merge($data['tablefields1']);
        $data['operations']          = $this->Common_model->getFilterOperation();
        $data['init_listing_page']   = 'purchase_order/stockin_po_list/';
        $data['listing_page']        = $data['init_listing_page'] . $page . '/';
        $data['filter_block']      = $this->parser->parse('common/filter', $data, true);
        $data['pagination_block']   = $this->parser->parse('common/pagination', $data, true);
        $data['stockin'] = 1;
        $this->load->view('common/menu');
        $this->load->view('purchase_order/purchase_order_pending_list_view', $data);
        $this->load->view('common/footer');
    }



    function add()
    {
        $this->hasPermission('purchase_order_add');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data = $this->input->post();
            //debug($data); exit;
			$branch_id = $data['ref_branch_id'];
            $po_data['ref_supplier_id'] = $data['ref_supplier_id'];
            $res_code = $this->Purchase_order_model->get_po_code($po_data,$branch_id);
            $data['purchase_order_no'] = $res_code['purchase_order_no'];
            $data['purchase_order_code'] = $res_code['purchase_order_code'];
            $po_particulars = $data['tbl_purchase_order_particulars'];
            unset($data['tbl_purchase_order_particulars']);
            // debug($po_particulars);
            // exit;
            $res = $this->Common_model->addRecord('purchase_order', $data);

            if (isset($po_particulars) && !empty($po_particulars)) {
                foreach ($po_particulars as $val) {
                    if (!empty($val['qty'])) {
                        $po_p_data = $val;
                        $po_p_data['ref_purchase_order_id'] = $res;
                        //$po_p_data['gst_perc'] = $po_p_data['gst_type_name'];
                        // unset($po_p_data['gst_perc']);
                        //unset($po_p_data['gst_type_name']);
                        $this->Common_model->addRecord('purchase_order_particulars', $po_p_data);
                        $this->Common_model->updateRecord('product', array('reorder_status' => 1), $val['ref_product_id']);
                        // echo $this->db->last_query();
                    }
                }
            }
            //exit;
            // Update PDF file
            $res_po_file = $this->generate_purchase_order_pdf($res, $data);
            $u_data['purchase_order_file'] = $res_po_file;
            $this->Common_model->updateRecord('purchase_order', $u_data, $res);

            /*$u_data1['ref_proforma_invoice_status_id'] = 1;
            $this->Common_model->updateRecord('proforma_invoice',$u_data1,$data['ref_proforma_invoice_id']);*/
            if ($res) {
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('purchase_order_add', $res);
                $_SESSION['success_msg'] = 'Purchase order successfully added ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            redirect('purchase_order');
        } else {
            $id = $this->uri->segment(3);
            $data['action'] = site_url('purchase_order/add');
            $this->load->view('common/menu');
            $this->load->view('purchase_order/purchase_order_form_view', $data);
            $this->load->view('common/footer');
        }
    }


    function add_reorder()
    {
        $post_data = $this->input->post();
        //debug($post_data);
        $data['purchase_order_particulars'] = array();
        if (isset($post_data['product_id']) && !empty($post_data['product_id'])) {
            foreach ($post_data['product_id'] as $key => $val) {
                $res_product = $this->Common_model->getDetails('product', 'product_id', $val);

                $data['purchase_order_particulars'][] = $res_product[0];
            }
        }
        $data['action'] = site_url('purchase_order/add');
        $this->load->view('common/menu');
        $this->load->view('purchase_order/purchase_re_order_form_view', $data);
        $this->load->view('common/footer');
    }

    function view()
    {
        $this->hasPermission('purchase_order_view');
        $id                      = $this->uri->segment(3);
        $data['purchase_order']         = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);
        $data['purchase_order_numbers']  = $this->Common_model->getDetails('purchase_order_contact_numbers', 'ref_purchase_order_id', $id);
        $data['purchase_order_emails']  = $this->Common_model->getDetails('purchase_order_email_ids', 'ref_purchase_order_id', $id);
        $this->load->view('common/menu');
        $this->load->view('purchase_order/purchase_order_details_view', $data);
        $this->load->view('common/footer');
    }


    function edit()
    {
        $this->hasPermission('purchase_order_edit');
        $id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data = $this->input->post();
            //debug($data); exit;
            unset($data['ref_purchase_order_id']);
            $po_particulars = $data['tbl_purchase_order_particulars'];
            unset($data['tbl_purchase_order_particulars']);

            $res = $this->Common_model->updateRecord('purchase_order', $data, $id);

            if (isset($po_particulars) && !empty($po_particulars)) {
                //$this->Common_model->removeRecord('purchase_order_particulars', 'ref_purchase_order_id', $id);
                foreach ($po_particulars as $val) {
                   // $po_p_data = $val;
                   // $po_p_data['ref_purchase_order_id'] = $res;
                   // $this->Common_model->addRecord('purchase_order_particulars', $po_p_data);
					if(isset($val['pop_id'])){
							$pop_id = $val['pop_id'];
							unset($val['pop_id']);
							$po_p_data = $val;
							$this->Purchase_order_model->updatePop('purchase_order_particulars','order_particulars_id',$po_p_data,$pop_id);
					} else {
						$po_p_data = $val;
						$po_p_data['ref_purchase_order_id'] = $res;
						$this->Common_model->addRecord('purchase_order_particulars', $po_p_data);
					}
                }
            }

            // Update PDF file
            $res_po_file = $this->generate_purchase_order_pdf($res, $data);
            $u_data['purchase_order_file'] = $res_po_file;
            $this->Common_model->updateRecord('purchase_order', $u_data, $res);

            if ($res) {
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('purchase_order_add', $res);
                $_SESSION['success_msg'] = 'Purchase order successfully updated ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            redirect('purchase_order');
        } else {

            $data['purchase_order']    = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);
            $data['purchase_order_particulars']    = $this->Common_model->getDetails('purchase_order_particulars', 'ref_purchase_order_id', $id);

            $data['action'] = site_url('purchase_order/edit/' . $id);
            $this->load->view('common/menu');
            $this->load->view('purchase_order/purchase_order_form_view', $data);
            $this->load->view('common/footer');
        }
    }

    function edit1()
    {
        $this->hasPermission('purchase_order_edit');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id  = $this->uri->segment(3);
            // Begin Transaction
            $this->Common_model->TxnBegin();
            $data = $this->input->post();
            $redirect_to = $data['redirect_to'];
            unset($data['redirect_to']);
            $res = $this->Common_model->updateRecord('purchase_order', $data, $id);
            if ($res) {
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('purchase_order_edit', $res); // Record User Activity
                $_SESSION['success_msg'] = 'Product Sample Request successfully updated ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            redirect('purchase_order');
        } else {
            $id                           = $this->uri->segment(3);
            $data['sample_request']              = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);

            $data['action'] = site_url('purchase_order/edit/' . $id);
            $this->load->view('common/menu');
            $this->load->view('purchase_order/purchase_order_form_view', $data);
            $this->load->view('common/footer');
        }
    }
    function delete()
    {
        $this->hasPermission('purchase_order_delete');
        // Begin Transaction
        $this->Common_model->TxnBegin();
        $delete_id = $this->input->post('checkbox');
        if (!empty($delete_id)) {
            foreach ($delete_id as $key => $id) {
                $res = $this->Common_model->removeRecord('purchase_order', 'purchase_order_id', $id);
                $this->Common_model->removeRecord('purchase_order_particulars', 'ref_purchase_order_id', $id);
            }
        }
        if ($res) {
            $this->Common_model->TxnCommit();
            $this->Common_model->addUserActivity('purchase_order_delete', $res); // Record User Activity
            $_SESSION['success_msg'] = 'Purchase_sample_request successfully deleted ...';
        } else {
            $this->Common_model->TxnRollBack();
            $_SESSION['error_msg'] = 'Error occurred please try again...';
        }
        redirect('purchase_order/getlist/1');
    }



    function export_purchase_order_excel()
    {
        $this->hasPermission('purchase_order_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'purchase_order_id';
        $data['purchase_order'] = 'ASC';
        $table['tbl_main']           = 'purchase_order';

        $mainlist      = $this->Common_model->getList($table, $data, $filter_data, 'purchase_order_id');

        foreach ($mainlist as $key => $val) {
            if ($val->invoice_status) {
                $invoice_status = "Updated";
            } else {
                $invoice_status = "Pending";
            }

            if ($val->invoice_payment_status) {
                $invoice_payment_status = "Received";
            } else {
                $invoice_payment_status = "Pending";
            }

            if ($val->invoice_commission_status) {
                $invoice_commission_status = "Received";
            } else {
                $invoice_commission_status = "Received";
            }

            if ($val->mail_status) {
                $mail_status = "Yes";
            } else {
                $mail_status = "-";
            }
            $gst_data=$this->Purchase_order_model->get_gst_based_purchase($val->purchase_order_id,5);
            $sub_total_gst_5=0;
            $gst_amount_5=0;
            foreach($gst_data as $gt)
            {
                $sub_total_gst_5=$gt->sub_total;
                $gst_amount_5=$gt->gst_val;
            }
            $gst_data=$this->Purchase_order_model->get_gst_based_purchase($val->purchase_order_id,12);
            $sub_total_gst_12=0;
            $gst_amount_12=0;
            foreach($gst_data as $gt)
            {
                $sub_total_gst_12=$gt->sub_total;
                $gst_amount_12=$gt->gst_val;
            }
            $gst_data=$this->Purchase_order_model->get_gst_based_purchase($val->purchase_order_id,18);
            $sub_total_gst_18=0;
            $gst_amount_18=0;
            foreach($gst_data as $gt)
            {
                $sub_total_gst_18=$gt->sub_total;
                $gst_amount_18=$gt->gst_val;
            }
            $export_list[] = array(
                $val->purchase_order_code,
                $this->Common_model->getDateFormat($val->purchase_order_date),
                $val->supplier_name,
                $val->sub_total,
                $val->supp_discount_total,
                $val->gst_total,
                $sub_total_gst_5,
                $gst_amount_5,
                $gst_amount_5,
                $sub_total_gst_12,
                $gst_amount_12,
                $gst_amount_12,
                $sub_total_gst_18,
                $gst_amount_18,
                $gst_amount_18,
                $val->grand_total
            );
        }

        $export        = array();
        $export_column = array(
            'Purchase Order Code',
            'Purchase Order Date',
            'Supplier Name',
            'Sub Total',
            'Discount Total',
            'GST',
            'Base Amount GST 5%',
            'SGST 2.5%',
            'CGST 2.5%',
            'Base Amount GST 12%',
            'SGST 6%',
            'CGST 6%',
            'Base Amount GST 18%',
            'SGST 9%',
            'CGST 9%',
            'Grand Total',
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        // echo "<pre>";
        // print_r($export);
        // exit();
        $this->Common_model->generateExcel($export, 'Purchase_Order_List_' . date('d-m-Y_H:i:s'));
    }


    public function export_purchase_order_pdf()
    {
        $this->hasPermission('purchase_order_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'purchase_order_id';
        $data['order']    = 'DESC';
        $table['tbl_main']  = 'purchase_order';
        $mainlist = $this->Common_model->getList($table, $data, $filter_data, 'purchase_order_id');
        $data['title'] = 'Purchase Order List';

        // Row Header
        $data['row_header'] = array();
        $data['row_header'][] = array(
            'name'        => 'S.No',
            'width'        => '5%',
            'align'        => 'center'
        );

        $data['row_header'][] = array(
            'name'        => 'PO#',
            'width'        => '5%',
            'align'        => 'left'
        );


        $data['row_header'][] = array(
            'name'        => 'Date',
            'width'        => '6%',
            'align'        => 'left'
        );

        $data['row_header'][] = array(
            'name'        => 'Supplier',
            'width'        => '35%',
            'align'        => 'left'
        );


        $data['row_header'][] = array(
            'name'        => 'Sub Total',
            'width'        => '10%',
            'align'        => 'center'
        );

        $data['row_header'][] = array(
            'name'        => 'Disc',
            'width'        => '7%',
            'align'        => 'right'
        );

        $data['row_header'][] = array(
            'name'        => 'Grand Total',
            'width'        => '12%',
            'align'        => 'right'
        );

        // Row Data
        $data['row_data'] = array();
        if (isset($mainlist) && !empty($mainlist)) {
            $i = 1;
            foreach ($mainlist as $key => $val) {
                $purchase_order_date = $this->Common_model->getDateFormat($val->purchase_order_date);

                $data['row_data'][] = array(
                    $i,
                    $val->purchase_order_code,
                    $purchase_order_date,
                    $val->supplier_name,
                    $val->sub_total,
                    $val->supp_discount_total,
                    $val->grand_total
                );
                $i++;
            }
        }

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
        $header_html = $this->parser->parse('template/pdf/pdf_header', $data);
        $footer_html = $this->parser->parse('template/pdf/pdf_footer', $data);
        $file_name = 'purchase_order_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html, $footer_html, $html, $file_name, 'P', 'I');
    }


    function send_purchase_order()
    {
        $id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = $this->input->post();

            $res_sample = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);

            $attach_product_request_docs[] = FCPATH . $res_sample[0]->purchase_order_file;
            $to_address                 = array();
            $email_additional           = array();
            if (isset($data['supplier_email'])) {
                $to_address[] = $data['supplier_email'];
            }
            if (!empty($data['email_additional'])) {
                $email_additional = explode(',', $data['email_additional']);
                $to_address       = array_merge($to_address, $email_additional);
            }

            $mail_data                          = array();
            $mail_data['from_address']          = FROM_ADDRESS;
            $mail_data['to_address']            = implode(',', $to_address);
            $mail_data['subject']               = $data['email_subject'];
            $mail_data['message']               = str_replace('&#10;', 'br>', $data['email_message']);
            $mail_data['name']                  = $res_sample[0]->supplier_name;
            $mail_data['attachment']            = $attach_product_request_docs;
            $mail_data['template_path']         = 'template/email/product_document.php';
            /*debug($mail_data);
            exit;*/
            $res = $this->Common_model->sendEmail($mail_data);
            //deug($res); exit;
            if ($res) {
                $pc_data['mail_status'] = 1;
                $this->Common_model->updateRecord('purchase_order', $pc_data, $res_sample[0]->purchase_order_id);
                $_SESSION['success_msg'] = 'Product Request mail successfully sent ...';
            } else {
                $_SESSION['error_msg'] = 'Mail not send...Please try again...';
            }
            redirect('purchase_order/getlist');
        } else {
            $data['sample_request_id'] = $this->uri->segment(3);
            $res_po                               = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);
            $data['sample']                           = $res_po;

            $data['supplier']                               = $this->Common_model->getDetails('supplier', 'supplier_id', $res_po[0]->ref_supplier_id);

            //debug($data['supplier']);
            //$data['supplier_contact_numbers'] = $this->Common_model->getDetails('supplier_contact_numbers', 'ref_supplier_id', $res_po[0]->ref_supplier_id);
            // $data['supplier_email_ids']       = $this->Common_model->getDetails('supplier_email_ids', 'ref_supplier_id', $res_po[0]->ref_supplier_id);
            $data['subject']                          = '';
            $data['message']                          = '';
            if (isset($res_po) && !empty($res_po)) {
                $data['subject'] = 'Product Request - #' . $res_po[0]->purchase_order_code . '';
                $email_message         = 'Hi ' . $res_po[0]->supplier_name . ',&#10;Please find the attached Purchase Order.' . '&#10;';
                $email_message           .= '<br><br>Thanks<br>Ayurveda';
                $data['email_message'] = $email_message;
            }
            $this->load->view('common/menu');
            $this->load->view('purchase_order/purchase_order_to_supplier_form_view', $data);
            $this->load->view('common/footer');
        }
    }


    function generate_purchase_order_pdf($id, $data = '')
    {
        $data['purchase_order'] = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);

        $data['purchase_order_particulars'] = $this->Common_model->getPurchaseOrderPdfDetails('purchase_order_particulars', 'ref_purchase_order_id', $id);

        $data['supplier'] = $this->Common_model->getDetails('supplier', 'supplier_id', $data['purchase_order'][0]->ref_supplier_id);
        //$data['company'] = $this->Common_model->getDetails('company','company_id',$data['supplier'][0]->ref_company_id);
       
        $data['special_instruction'] = $data['special_instruction'];
       

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/purchase_order_tmp', $data);

        $header_html = $this->parser->parse('template/pdf/pdf_header', $data);
        $footer_html = $this->parser->parse('template/pdf/pdf_footer', $data);
        $f_name = 'uploads/purchase_order/' . str_replace('/', '_', $data['purchase_order'][0]->purchase_order_code) . '_' . time() . '.pdf';
        $file_name = FCPATH . $f_name;
        $this->Common_model->exportPdf($header_html, $footer_html, $html, $file_name, 'P', 'F');

        return $f_name;
    }

    function update_purchase_order_invoice()
    {
        $id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data       = $this->input->post();
            //debug($data); //exit;
            $po_particulars = $data['tbl_purchase_order_particulars'];
            unset($data['tbl_purchase_order_particulars']);

            $product_batch = $data['tbl_product_batch'];
            unset($data['tbl_product_batch']);

            // Remove old data if exist
            //$this->Common_model->deleteRecord('invoice','ref_purchase_order_id',$id);

            if (isset($_FILES['invoice_copy']['name']) && !empty($_FILES['invoice_copy']['name'])) {
                $data['invoice_copy'] = $this->Common_model->upload_file($_FILES['invoice_copy']['name'], $_FILES['invoice_copy']['tmp_name'], 'invoice');
            }

            
            $po_complete_status = 0;
            if (isset($product_batch) && !empty($product_batch) && array_filter($product_batch)) {
                $po_complete_status = 1;
                foreach ($product_batch as $key => $val) {
                    //$i = 0;
                    $count = count($val['product_batch_name']);
                    for ($i = 0; $i < $count; $i++) {
                        if ($val['quantity'][$i]) {
                            $pa_data['ref_purchase_order_id'] = $data['ref_purchase_order_id'];
                            $pa_data['ref_branch_id'] = $data['ref_branch_id'];
                            $pa_data['ref_product_id'] = $key;
                            $pa_data['product_batch_name'] = $val['product_batch_name'][$i];
                            $pa_data['quantity'] = $val['quantity'][$i];
                            $pa_data['price'] = $val['price'][$i];
                            $pa_data['avail_quantity'] = $val['quantity'][$i];
                            $pa_data['manufacture_date'] = date('Y-m-d', strtotime($val['manufacture_date'][$i]));
                            $pa_data['expiry_date'] = date('Y-m-d', strtotime($val['expiry_date'][$i]));
                            //debug($pa_data); 
                            
                            $res = $this->Common_model->addRecord('product_batch', $pa_data);
                            $this->Purchase_order_model->update_product_quantity($key, $val['quantity'][$i]);
                            if ($val['product_balance_qty'][$i]) {
                                $po_complete_status = 0;
                            }
                        }
                    }
                }
            }

            if ($po_complete_status) {
                $po_data['purchase_order_complete_status'] = 1;
                $this->Common_model->updateRecord('purchase_order', $po_data, $id);
            }
            // exit;
            //$u_data['invoice_file'] = $this->generate_invoice_pdf($id);
            if ($res) {
                $this->Common_model->TxnCommit();
                $_SESSION['success_msg'] = 'Invoice Details successfully updated ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            redirect('purchase_order');
        } else {
            $data['purchase_order'] = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);
            $data['purchase_order_particulars'] = $this->Common_model->getDetails('purchase_order_particulars', 'ref_purchase_order_id', $id);

            $res_product_batch = $this->Common_model->getDetails('product_batch', 'ref_purchase_order_id', $id);
            $data['po_product_qty'] = array();
            if (isset($res_product_batch) && !empty($res_product_batch)) {
                foreach ($res_product_batch as $k => $v) {
                    $data['po_product_qty'][$v->ref_product_id] += $v->quantity;
                }
            }
            //debug($data['po_product_qty']); exit;
            $data['supplier'] = $this->Common_model->getDetails('supplier', 'supplier_id', $data['purchase_order'][0]->ref_supplier_id);

            $this->load->view('common/menu');
            $this->load->view('purchase_order/purchase_order_invoice_form_view', $data);
            $this->load->view('common/footer');
        }
    }


    function edit_purchase_order_invoice()
    {
        $id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = $this->input->post();
            $po_particulars = $data['tbl_purchase_order_particulars'];
            unset($data['tbl_purchase_order_particulars']);

            // Remove old data if exist
            //$this->Common_model->deleteRecord('invoice','ref_purchase_order_id',$id);

            //~ if(isset($_FILES['invoice_copy']['name']) && !empty($_FILES['invoice_copy']['name'])){
            //~ $data['invoice_copy'] = $this->Common_model->upload_file($_FILES['invoice_copy']['name'], $_FILES['invoice_copy']['tmp_name'], 'invoice');
            //~ }

            //~ echo '<pre>';
            //~ print_r($data);
            //~ echo '</pre>';
            //~ exit;
            $res = $this->Common_model->updateRecord('invoice', $data, $id);
            if (isset($po_particulars) && !empty($po_particulars)) {
                $this->Common_model->deleteRecord('invoice_particulars', 'ref_invoice_id', $id);
                foreach ($po_particulars as $val) {
                    if (!empty($val['qty'])) {
                        $po_p_data = $val;
                        $po_p_data['ref_invoice_id'] = $res;
                        $this->Common_model->addRecord('invoice_particulars', $po_p_data);
                    }
                }
            }
            $u_data['invoice_file'] = $this->generate_edited_invoice_pdf($id);
            if ($res) {
                $this->Common_model->updateRecord('invoice', $u_data, $res);

                $po_data['invoice_status'] = 1;
                $this->Common_model->updateRecord('purchase_order', $po_data, $id);

                $_SESSION['success_msg'] = 'Invoice Details successfully updated ...';
            } else {
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            redirect('purchase_order');
        } else {
            $data['invoice'] = $this->Common_model->getDetails('invoice', 'invoice_id', $id);
            $data['invoice_particulars'] = $this->Common_model->getDetails('invoice_particulars', 'ref_invoice_id', $id);

           
            $data['supplier'] = $this->Common_model->getDetails('supplier', 'supplier_id', $data['invoice'][0]->ref_supplier_id);
            //~ echo '<pre>';
            //~ print_r($data['invoice']);
            //~ print_r($data['invoice_particulars']);
            //~ echo '</pre>';
            //~ exit;

            $this->load->view('common/menu');
            $this->load->view('purchase_order/purchase_order_invoice_edit_view', $data);
            $this->load->view('common/footer');
        }
    }

    function view_stackin_details($id)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->Common_model->TxnBegin();
            $data       = $this->input->post();
            //debug($data); exit;
            if (isset($data['tbl_product_batch']) && !empty($data['tbl_product_batch'])) {
                foreach ($data['tbl_product_batch'] as $key => $val) {
                    if (($val['prev_quantity'] != $val['quantity']) || $val['delete']) {
                        $qty_diff = $val['quantity'] - $val['prev_quantity'];
                        $type = 'add';
                        if ($qty_diff < 0) {
                            $type = 'subtract';
                        }
                        unset($val['prev_quantity']);
                        $val['manufacture_date'] = date('Y-m-d', strtotime($val['manufacture_date']));
                        $val['expiry_date'] = date('Y-m-d', strtotime($val['expiry_date']));
                        if ($val['delete']) {
                            unset($val['delete']);
                            $res_1 = $this->Common_model->removeRecord('product_batch', $val, $key);
                            $res = $this->Purchase_order_model->update_product_quantity($val['ref_product_id'], $val['quantity'], 'subtract');
                        } else {
                            unset($val['delete']);
                            $res_1 = $this->Common_model->updateRecord('product_batch', $val, $key);
                            $res = $this->Purchase_order_model->update_product_quantity($val['ref_product_id'], abs($qty_diff), $type);
                        }
                    }
                }
            }
            if ($res && $res_1) {
                $this->Common_model->TxnCommit();
                $_SESSION['success_msg'] = 'Stock in successfully updated ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'error occurred...Please try again...';
            }
            redirect('purchase_order/view_stackin_details/' . $id);
        } else {
            $data['product_batch'] = $this->Common_model->getDetails('product_batch', 'ref_purchase_order_id', $id, 'ref_product_id', 'ASC');
            $this->load->view('common/menu');
            $this->load->view('purchase_order/purchase_order_stockin_list_view', $data);
            $this->load->view('common/footer');
        }
    }


    function generate_invoice_pdf($id, $data = '')
    {
        $data['invoice'] = $this->Common_model->getDetails('invoice', 'ref_purchase_order_id', $id);
        $data['purchase_order'] = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);

        $data['invoice_particulars'] = $this->Common_model->getDetails('invoice_particulars', 'ref_invoice_id', $data['invoice'][0]->invoice_id);

        $data['supplier'] = $this->Common_model->getDetails('supplier', 'supplier_id', $data['invoice'][0]->ref_supplier_id);
       
        $data['company'] = $this->Common_model->getDetails('company', 'company_id', $data['supplier'][0]->ref_company_id);

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/invoice_tmp', $data);
        $header_html = $this->parser->parse('template/pdf/pdf_header', $data);
        $footer_html = $this->parser->parse('template/pdf/pdf_footer', $data);

        $f_name = 'uploads/invoice/' . str_replace('/', '_', $data['invoice'][0]->invoice_no) . '_' . time() . '.pdf';
        $file_name = FCPATH . $f_name;
        $this->Common_model->exportPdf($header_html, $footer_html, $html, $file_name, 'P', 'F');

        return $f_name;
    }

    function generate_edited_invoice_pdf($id, $data = '')
    {
        $data['invoice'] = $this->Common_model->getDetails('invoice', 'invoice_id', $id);
        $data['purchase_order'] = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $data['invoice'][0]->ref_purchase_order_id);

        $data['invoice_particulars'] = $this->Common_model->getDetails('invoice_particulars', 'ref_invoice_id', $id);

        $data['supplier'] = $this->Common_model->getDetails('supplier', 'supplier_id', $data['invoice'][0]->ref_supplier_id);
        
        $data['company'] = $this->Common_model->getDetails('company', 'company_id', $data['supplier'][0]->ref_company_id);

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/invoice_tmp', $data);
        $header_html = $this->parser->parse('template/pdf/pdf_header', $data);
        $footer_html = $this->parser->parse('template/pdf/pdf_footer', $data);

        $f_name = 'uploads/invoice/' . str_replace('/', '_', $data['invoice'][0]->invoice_no) . '_' . time() . '.pdf';
        $file_name = FCPATH . $f_name;
        $this->Common_model->exportPdf($header_html, $footer_html, $html, $file_name, 'P', 'F');
        //exit;		
        return $f_name;
    }

    // Dhana - 05/05/19
    function purchase_order_report()
    {
        $this->hasPermission('purchase_order_view');
        $filter_data = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter_data = $this->input->post();
            $reset_data  = $this->input->post('reset');
            if (isset($reset_data)) {
                $this->session->unset_userdata('filter_data');
                $filter_data = '';
            } else {
                $this->session->set_userdata('filter_data', $filter_data);
            }
        } else {
            $session_filter_data = $this->session->userdata('filter_data');
            if (isset($session_filter_data)) {
                $filter_data = $session_filter_data;
            } else {
                $filter_data = '';
            }
        }

        //debug($filter_data); //exit;
        $data['filter_data'] = $filter_data;
        //$data      = array();
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        $segment_5 = $this->uri->segment(5);
        // If not pagination page remove filter data from session
        if (!isset($segment_3) && $this->input->server('REQUEST_METHOD') != 'POST') {
            $this->session->unset_userdata('filter_data');
            $filter_data = '';
            $data['filter_data'] = '';
        }
        if (isset($segment_3)) {
            $page = $segment_3;
        } else {
            $page = '1';
        }
        if (isset($segment_4)) {
            $sort = $segment_4;
        } else {
            $sort = 'purchase_order_id';
        }
        if (isset($segment_5)) {
            $order = $segment_5;
        } else {
            $order = 'DESC';
        }

        // No used for Redirect to same page after delete action in page 2, page 3,etc...
        $data['page']             = $page;

        $filter_query_data      = array();
        $data['limit'] = '';
        if (isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])) {
            $start                     = (($page - 1) * $_REQUEST['limit']);
            $filter_query_data['limit'] = $_REQUEST['limit'];
            $data['limit'] = '?limit=' . $_REQUEST['limit'];
        } else {
            $start                     = (($page - 1) * RPP);
        }

        $data['start']                   = $start; // Generate SNO in result table based on page number
        $filter_query_data['start']             = $start;
        $filter_query_data['sort']              = $sort;
        $filter_query_data['order']             = $order;

        //$data['mainlist_count']      = $this->Purchase_model->get_purchase_listListCount($table, $filter_data,'purchase_order_id');

        if (isset($filter_data) && !empty($filter_data)) {
            $data['mainlist']            = $this->Purchase_order_model->get_purchase_order_list($filter_data);
        } else {
            $data['mainlist'] = array();
        }

        $this->load->view('common/menu');
        $this->load->view('purchase_order/purchase_order_report_list_view', $data);
        $this->load->view('common/footer');
    }


    function export_purchase_order_report_excel()
    {
        $this->hasPermission('purchase_order_excel');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data          = array();
        $data['sort']  = 'purchase_order_id';
        $data['purchase_order'] = 'ASC';
        $table['tbl_main']           = 'purchase_order';

        if (isset($filter_data) && !empty($filter_data)) {
            $mainlist            = $this->Purchase_order_model->get_purchase_order_list($filter_data);
        } else {
            $mainlist = array();
        }

        //$mainlist      = $this->Common_model->getList($table, $data, $filter_data,'purchase_order_id');

        foreach ($mainlist as $key => $val) {
            if ($val->invoice_status) {
                $invoice_status = "Updated";
            } else {
                $invoice_status = "Pending";
            }

            if ($val->invoice_payment_status) {
                $invoice_payment_status = "Received";
            } else {
                $invoice_payment_status = "Pending";
            }

            if ($val->invoice_commission_status) {
                $invoice_commission_status = "Received";
            } else {
                $invoice_commission_status = "Received";
            }

            if ($val->mail_status) {
                $mail_status = "Yes";
            } else {
                $mail_status = "-";
            }
            $export_list[] = array(
                $val->purchase_order_code,

                $this->Common_model->getDateFormat($val->purchase_order_date),
                $val->client_name,
                $val->supplier_name,
                $val->desbatch_mode_name,
                $val->delivery_point_name,
                $this->Common_model->getDateFormat($val->schedule_date),
                $val->sub_total,
                $val->discount_total,
                $val->gst_total,
                $val->grand_total,
                $invoice_status,
                //~ $this->Common_model->getDateFormat($val->invoice_date),
                //~ $val->invoice_no, 
                //~ $val->invoice_total,
                $invoice_payment_status,
                //$this->Common_model->getDateFormat($val->invoice_payment_date),
                $invoice_commission_status,
                //$this->Common_model->getDateFormat($val->invoice_commission_date),
                //  $val->invoice_payment_details,
                //$val->invoice_commission_details,          
                $val->purchase_order_details,
                $mail_status
            );
        }

        $export        = array();
        $export_column = array(
            'Purchase Order Code',

            'Purchase Order Date',
            'Client Name',
            'Supplier Name',
            'Desbatch Mode Name',
            'Delivery Point Name',
            'Schedule Date',
            'Sub Total',
            'Discount Total',
            'Gst Total',
            'Grand Total',
            'Invoice Status',
            //~ 'Invoice Date',
            //~ 'Invoice No',       
            //~ 'Invoice Total',
            'Invoice Payment Status',
            //~ 'Invoice Payment Date',
            'Invoice Commission Status',
            //~ 'Invoice Commission Date',
            //~ 'Invoice Payment Details',
            //~ 'Invoice Commission Details',                
            'Purchase Order Details',
            'Mail Status'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        $this->Common_model->generateExcel($export, 'Purchase_Order_List_' . date('d-m-Y_H:i:s'));
    }

    public function export_purchase_order_report_pdf()
    {
        $this->hasPermission('purchase_order_pdf');
        $filter_data         = '';
        $session_filter_data = $this->session->userdata('filter_data');
        if (isset($session_filter_data)) {
            $filter_data = $session_filter_data;
        } else {
            $filter_data = '';
        }
        $data             = array();
        $data['sort']     = 'purchase_order_id';
        $data['order']    = 'DESC';
        $table['tbl_main']  = 'purchase_order';
        if (isset($filter_data) && !empty($filter_data)) {
            $mainlist            = $this->Purchase_order_model->get_purchase_order_list($filter_data);
        } else {
            $mainlist = array();
        }
        $data['title'] = 'Purchase Order List';

        // Row Header
        $data['row_header'] = array();
        $data['row_header'][] = array(
            'name'      => 'S.No',
            'width'     => '5%',
            'align'     => 'center'
        );

        $data['row_header'][] = array(
            'name'      => 'PO#',
            'width'     => '5%',
            'align'     => 'left'
        );


        $data['row_header'][] = array(
            'name'      => 'Date',
            'width'     => '6%',
            'align'     => 'left'
        );


        $data['row_header'][] = array(
            'name'      => 'Client',
            'width'     => '26%',
            'align'     => 'left'
        );

        $data['row_header'][] = array(
            'name'      => 'Supplier',
            'width'     => '26%',
            'align'     => 'left'
        );


        $data['row_header'][] = array(
            'name'      => 'Inv',
            'width'     => '5%',
            'align'     => 'center'
        );

        $data['row_header'][] = array(
            'name'      => 'Inv.No',
            'width'     => '10%',
            'align'     => 'left'
        );
        $data['row_header'][] = array(
            'name'      => 'Inv.Date',
            'width'     => '10%',
            'align'     => 'left'
        );
        $data['row_header'][] = array(
            'name'      => 'Inv.Total',
            'width'     => '10%',
            'align'     => 'right'
        );

        $data['row_header'][] = array(
            'name'      => 'Pay',
            'width'     => '5%',
            'align'     => 'center'
        );

        $data['row_header'][] = array(
            'name'      => 'Comm',
            'width'     => '5%',
            'align'     => 'center'
        );

        // Row Data
        $data['row_data'] = array();
        if (isset($mainlist) && !empty($mainlist)) {
            $i = 1;
            foreach ($mainlist as $key => $val) {
                $purchase_order_date = $this->Common_model->getDateFormat($val->purchase_order_date);
                if ($val->invoice_status) {
                    $invoice_status = "Y";
                } else {
                    $invoice_status = "-";
                }
                if ($val->invoice_payment_status) {
                    $invoice_payment_status = "R";
                } else {
                    $invoice_payment_status = "-";
                }
                if ($val->invoice_commission_status) {
                    $invoice_commission_status = "R";
                } else {
                    $invoice_commission_status = "-";
                }

                $invoice_no = '';
                $invoice_date = '';
                $grand_total = '';
                $res_invoice = $this->Common_model->getDetails('invoice', 'ref_purchase_order_id', $val->purchase_order_id);
                if (isset($res_invoice) && !empty($res_invoice)) {
                    $invoice_no = $res_invoice[0]->invoice_no;
                    $invoice_date = $this->Common_model->getDateFormat($res_invoice[0]->invoice_date);
                    $grand_total = number_format($res_invoice[0]->grand_total);
                }


                $data['row_data'][] = array(
                    $i,
                    substr($val->purchase_order_code, -9, 4),
                    $purchase_order_date,
                    $val->client_name,
                    $val->supplier_name,
                    $invoice_status,
                    $invoice_no,
                    $invoice_date,
                    $grand_total,
                    $invoice_payment_status,
                    $invoice_commission_status
                );
                $i++;
            }
        }

        $this->load->library('parser');
        $html = $this->parser->parse('template/pdf/list_tmp', $data);
        $header_html = $this->parser->parse('template/pdf/pdf_header', $data);
        $footer_html = $this->parser->parse('template/pdf/pdf_footer', $data);
        $file_name = 'purchase_order_list_' . date('Y-m-d _ H:i:s') . '.pdf';
        $this->Common_model->exportPdf($header_html, $footer_html, $html, $file_name, 'P', 'I');
    }

    function copy()
    { 
        $this->hasPermission('purchase_order_add');
        $id = $this->uri->segment(3);
        if(!empty($id)) {
           
            $data = $this->Common_model->getDetails('purchase_order', 'purchase_order_id', $id);
            
            $po_data['ref_supplier_id'] = $data[0]->ref_supplier_id;
            $res_code = $this->Purchase_order_model->get_po_code($po_data);
            unset($data[0]->purchase_order_no);
            unset($data[0]->purchase_order_code);
            unset($data[0]->purchase_order_id);
            unset($data[0]->client_name);
            unset($data[0]->supplier_name);
            unset($data[0]->direct_to_customer);
            unset($data[0]->delivery_point_name);
            unset($data[0]->despatch_mode_name);
            unset($data[0]->discount_type_name);
            unset($data[0]->proforma_invoice_name);
            unset($data[0]->proforma_invoice_code);
            unset($data[0]->user_name);
            unset($data[0]->branch_name);
            $data[0]->purchase_order_no = $res_code['purchase_order_no'];
            $data[0]->purchase_order_code = $res_code['purchase_order_code'];
            $dataa = (array) $data[0];
            $res = $this->Common_model->addRecord('purchase_order', $dataa);
            
            $po_particulars = $this->Purchase_order_model->po_particulars('purchase_order_particulars', 'ref_purchase_order_id', $id);
            
            if (isset($po_particulars) && !empty($po_particulars)) {
                foreach ($po_particulars as $val) { 
                    if (!empty($val['qty'])) {
                        $po_p_data = $val;
                        $po_p_data['ref_purchase_order_id'] = $res;
                        $this->Common_model->addRecord('purchase_order_particulars', $po_p_data);
                        $this->Common_model->updateRecord('product', array('reorder_status' => 1), $val['ref_product_id']);
                        
                    }
                }
            }
           
            // Update PDF file
            $res_po_file = $this->generate_purchase_order_pdf($res, $dataa);
            $u_data['purchase_order_file'] = $res_po_file;
            $this->Common_model->updateRecord('purchase_order', $u_data, $res);
            
            if ($res) {
                $this->Common_model->TxnCommit();
                $this->Common_model->addUserActivity('purchase_order_add', $res);
                $_SESSION['success_msg'] = 'Purchase order successfully copied ...';
            } else {
                $this->Common_model->TxnRollBack();
                $_SESSION['error_msg'] = 'Error occurred please try again...';
            }
            
            redirect('purchase_order');
            
        } else { 
            
            redirect('purchase_order');
        }
    }

    function export_po_product_excel(){
        $id = $this->uri->segment(3);
        if(!empty($id)){
            $po_particulars = $this->Common_model->getDetails('purchase_order_particulars', 'ref_purchase_order_id', $id,'sku','ASC');
          // debug($po_particulars); exit;
           if(isset($po_particulars) && !empty($po_particulars)){
               foreach ($po_particulars as $key => $val) {
                $res_product = $this->Common_model->getDetails('product','product_id',$val->ref_product_id);
                /*$mrp = round($val->price+($val->price*($val->gst_perc/100)),2);
                $basic_price_total = round($val->price * $val->full_qty,2);
                $supp_comm_total = round(($basic_price_total * $val->supplier_comm_perc) / 100,2);
                $sub_total = round($basic_price_total - $supp_comm_total,2);
                $gst_total = round(($sub_total * $val->gst_perc) / 100,2);
                $final_total = round($sub_total + $gst_total,2); */
                $export_list[] = array(
                    $val->sku,
                    $val->product_name,
                    $res_product[0]->unit,
                    $res_product[0]->schedule,
                    $val->full_qty

                );
            }
        }
     
        $export = array();
        $export_column = array(
            'Sku Code',
            'Sky Name',
            'Unit',
            '*',
            'Full Qty'
        );
        $export[0]     = $export_column;
        foreach ($export_list as $key => $export_row) {
            $export[] = $export_row;
        }
        //debug($export); exit;
        $this->Common_model->generateExcel($export,'Purchase_order_product_list_' . date('d-m-Y_H:i:s'));
        }

    }
	
	function remove_po_particulars() {
	$pop_id = $_REQUEST['pop_id'];
	$data['delete_status'] = 1;
	$this->Purchase_order_model->updatePop('purchase_order_particulars','order_particulars_id',$data,$pop_id);
	echo 'success'; exit;
	}

}
