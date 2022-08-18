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
                        <?php if(in_array('purchase_order_add',$permission)){?> 	
                        <a class="btn btn-info" href="<?php echo site_url('purchase_order/export_purchase_order_excel'); ?>" target="_blank">Download Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('purchase_order/export_purchase_order_pdf'); ?>" target="_blank">Export PDF</a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('purchase_order/getlist'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('purchase_order/delete'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <th class="text-center" width="2%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="2%">S.No</th>
                              <th class="text-left sorting" width="4%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'purchase_purchase_order_code/ASC'); ?>">PO #</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'purchase_purchase_order_code/DESC'); ?>">PO #</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'purchase_purchase_order_date/ASC'); ?>">Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'purchase_purchase_order_date/DESC'); ?>">Date</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="33%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/ASC'); ?>">Supplier Name</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/DESC'); ?>">Supplier Name</a>
                                 <?php } ?>
                              </th>
                             
                              <th class="text-right sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'sub_total/ASC'); ?>">Sub Total</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'sub_total/DESC'); ?>">Sub Total</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supp_discount_total/ASC'); ?>">Discount</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supp_discount_total/DESC'); ?>">Discount</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'grand_total/ASC'); ?>">Grand Total</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'grand_total/DESC'); ?>">Grand Total</a>
                                 <?php } ?>
                              </th>
                             <!-- <th class="text-center sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'despatch_mode_name/ASC'); ?>">Despatch</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'despatch_mode_name/DESC'); ?>">Despatch</a>
                                 <?php } ?>
                              </th> -->
                            <!--  <th class="text-center sorting" width="4%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_status/ASC'); ?>">Inv</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_status/DESC'); ?>">Inv</a>
                                 <?php } ?>
                              </th> -->
                              <!-- <th class="text-left" width="10%">Inv.No</th>
                              <th class="text-left" width="6%">Inv.Date</th>
                              <th class="text-left" width="6%">Inv.Total</th>
                             <th class="text-center sorting" width="4%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'despatch_mode_name/ASC'); ?>">Pay</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'despatch_mode_name/DESC'); ?>">Pay</a>
                                 <?php } ?>
                              </th>
                             <th class="text-center sorting" width="4%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_commission_status/ASC'); ?>">Comm</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_commission_status/DESC'); ?>">Comm</a>
                                 <?php } ?>
                              </th> -->
                              
                              <th class="text-right" width="12%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ 
								 
							   ?>
                           <tr>
                              <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->purchase_order_id; ?>" value="<?php echo $val->purchase_order_id; ?>" id="checkbox_<?php echo $val->purchase_order_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->purchase_order_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left">
								   <a id="<?php echo $val->purchase_order_id; ?>" data-toggle="tooltip" class="btn" style="cursor:pointer" title="<?php echo $val->purchase_order_code; ?>" href="<?php echo base_url().$val->purchase_order_file; ?>" target="_blank"><?php echo $val->purchase_order_code; ?> <i class="fa fa-search"></i></a>
                              </td>
                           <td class="text-left"><?php echo getDateFormat($val->purchase_order_date); ?></td>
                           <td class="text-left"><?php echo $val->supplier_name; ?></td>
                           <td class="text-right"><?php echo number_format($val->sub_total); ?></td>
                           <td class="text-right"><?php echo number_format($val->supp_discount_total); ?></td>
                           <td class="text-right"><?php echo number_format($val->grand_total); ?></td>
							   
							  
                              <td class="text-right" >	
                                 <?php if($stockin){ ?>
                              <a data-toggle="tooltip" class="btn btn-info" style="cursor:pointer"  title="View Stock-In Details" href="<?php echo site_url('purchase_order/view_stackin_details/'.$val->purchase_order_id); ?>">Stock In</a>
                           <?php }else{ ?>
                               
								
                           <a data-toggle="tooltip" class="btn btn-success" style="cursor:pointer"  title="Edit Purchase Order" href="<?php echo site_url('purchase_order/edit/'.$val->purchase_order_id); ?>"><i class="fa fa-pencil"></i></a>
                                    
                        
									   
                             
									   <?php } ?>
                              </td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
							<tr><td align="center" colspan="10">No records found...</td></tr>   
							<?php } ?>  	
                        </tbody>
                     </table>
                     <?php if(in_array('purchase_order_delete',$permission)){?> 
						<input class="btn btn-danger delete " style="margin-top:10px;" type="submit" value="Delete" onClick="return confirmDelete();">
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
<?php include('popup_update_payment_form_view.php'); ?>
<?php include('popup_update_commission_form_view.php'); ?>
<?php include('popup_commission_history_list_view.php'); ?>
<?php include('popup_payment_history_list_view.php'); ?>
<script>
     
	function delete_purchase_order(id){
		var r=confirm("Do you want to delete this?");
		var page = '<?php echo $page; ?>';
	if (r==true)
		window.location = "<?php echo base_url(); ?>/index.php/purchase_order/delete/"+page+"/"+id;
	else
		return false;
	} 
         
</script>

