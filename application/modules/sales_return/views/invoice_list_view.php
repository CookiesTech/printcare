<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">List</h4>
                     <h6 class="card-subtitle"><?php
                        if(isset($filter_data) && !empty($filter_data)){
                         $search_result_count = 0;
                         if($mainlist_count){
                          $search_result_count = $mainlist_count;
                         }
                         echo '<a style="font-size:14px;padding-left:10px;">'.$search_result_count.' result(s) found...</a>';
                        }
                        ?></h6>
                  </div>
                  <div class="col-md-6 text-right">
                     <div class="dt-buttons">
                        <?php if(in_array('invoice_add',$permission)){ ?> 
                        <a class="btn btn-success" href="<?php echo site_url('sales_return/invoice_return'); ?>">Add New</a>
                        <?php } ?>	
                        <?php if(in_array('invoice_add',$permission)){?> 	
                      <a class="btn btn-info" href="<?php echo site_url('invoice/export_invoice_excel'); ?>" target="_blank" hidden>Download Excel</a>
                        <!--   <a class="btn btn-info" href="<?php echo site_url('invoice/export_invoice_pdf'); ?>" target="_blank">PDF</a> -->
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('sales_return/getlist'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('invoice/delete'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <!-- <th class="text-center" width="2%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th> -->
                              <th class="text-center sorting" width="2%">S.No</th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_name/ASC'); ?>">Sales Return No #</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_name/DESC'); ?>">Sales Return No #</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_date/ASC'); ?>">Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_date/DESC'); ?>">Date</a>
                                 <?php } ?>
                              </th>
                              <!-- 
                              <th class="text-center sorting" width="4%">Type</th>
                              <th class="text-left sorting" width="12%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'patient_name/ASC'); ?>">Name</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'patient_name/DESC'); ?>">Name</a>
                                 <?php } ?>
                              </th>
                              
                              <th class="text-right sorting" width="5%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'discount_total/ASC'); ?>">Discount</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'discount_total/DESC'); ?>">Discount</a>
                                 <?php } ?>
                              </th> -->
                              <th class="text-right sorting" width="5%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'gst_total/ASC'); ?>">GST</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'gst_total/DESC'); ?>">GST</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right sorting" width="5%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'sub_total/ASC'); ?>">Sub Total</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'sub_total/DESC'); ?>">Sub Total</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right sorting" width="5%" hidden>
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'p_and_f_total/ASC'); ?>">Cons Fees</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'p_and_f_total/DESC'); ?>">Cons Fees</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right sorting" width="7%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'grand_total/ASC'); ?>">Grand Total</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'grand_total/DESC'); ?>">Grand Total</a>
                                 <?php } ?>
                              </th>
                               <th class="text-right sorting" width="5%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'payment_type_name/ASC'); ?>">Pay.Type</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'payment_type_name/DESC'); ?>">Pay.Type</a>
                                 <?php } ?>
                              </th> 
                             <!--  <th class="text-center sorting" width="5%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_payment_status/ASC'); ?>">Payment</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_payment_status/DESC'); ?>">Payment</a>
                                 <?php } ?>
                              </th>   -->                            
                              <th class="text-right" width="12%" hidden>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ 
								
							   ?>
                           <tr>
                             <!--  <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->invoice_id; ?>" value="<?php echo $val->invoice_id; ?>" id="checkbox_<?php echo $val->invoice_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->invoice_id; ?>"></label>
                              </td> -->
                              <td class="text-center"><?php echo $i; ?></td>
                              
								   <td class="text-left">
                           <a href="<?=site_url('sales_return/print_invoice_return/'.$val->invoice_return_id.'/view');?>" target="_blank"><?php echo $val->invoice_return_name; ?> <i class="fa fa-search"></i></a></td>
                           <td class="text-left"><?php echo getDateFormat($val->invoice_date); ?></td>
                              <!-- <td class="text-center">
                              <?php 
                                 if(!empty($val->patient_name))
                                    echo 'P'; 
                                 else
                                    echo 'C';
                              ?></td>
                          
                           
                           <td class="text-left">
                              <?php 
                                 if(!empty($val->patient_name))
                                    echo ucfirst($val->patient_name); 
                                 else
                                    echo ucfirst($val->customer_name);
                              ?></td>
                           <td class="text-right"><?php echo number_format($val->discount_total,2); ?></td> -->
                           <td class="text-right"><?php echo number_format($val->gst_total,2); ?></td>
                            <td class="text-right"><?php echo number_format(round($val->sub_total,2)); ?></td>
                            <td class="text-right" hidden><?php echo number_format($val->p_and_f_total); ?></td>
                           <td class="text-right"><?php echo number_format($val->grand_total); ?></td>
                           <td class="text-right"><?php echo $val->payment_type_name; ?></td>
   							     <!-- <td class="text-center">
                              <?php 
                                 if($val->invoice_payment_status == 1){
                                    echo '<span class="label label-success">Paid</span>';
                                 }elseif($val->invoice_payment_status == 2){
                                    echo '<span class="label label-warning" title="'.$val->cancelled_reason.'">Cancelled</span>'; 
                                 }
                                 else { 
                                    echo '<span class="label label-danger">Pending</span>'; 
                                 }
                             ?>
                           </td> -->

							  
                              <td  class="" style="display:flex;justify-content:space-evenly;" hidden>	
                                 <a data-toggle="tooltip" class="btn btn-success" style="cursor:pointer"  title="Print Invoice" href="<?php echo site_url('sales_return/print_invoiceold/'.$val->invoice_return_id); ?>" target="_blank"><i class="fa fa-print"></i></a>
                                 <a data-toggle="tooltip" class="btn btn-success" style="cursor:pointer"  title="Print Invoice" href="<?php echo site_url('sales_return/print_invoice/'.$val->invoice_return_id); ?>" target="_blank"><i class="fa fa-medkit"></i></a>
                                 
									  
                              </td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
							<tr><td align="center" colspan="10">No records found...</td></tr>   
							<?php } ?>  	
                        </tbody>
                     </table>
                     <?php if(in_array('invoice_delete',$permission)){?> 
						<!-- <input class="btn btn-danger delete " style="margin-top:10px;" type="submit" value="Delete" onClick="return confirmDelete();"> -->
                     <?php } ?> 
                     <?php echo form_close(); ?>		
                     <?php echo $pagination_block; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('popup_invoice_cancel_form.php'); ?>
<script>
     
	function delete_invoice(id){
		var r=confirm("Do you want to delete this?");
		var page = '<?php echo $page; ?>';
	if (r==true)
		window.location = "<?php echo base_url(); ?>/index.php/invoice/delete/"+page+"/"+id;
	else
		return false;
	} 
         
</script>

