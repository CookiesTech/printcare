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
                       
                        <?php if(in_array('invoice_view',$permission)){?> 	
                       <a class="btn btn-info" href="<?php echo site_url('invoice/export_payment_history_excel'); ?>" target="_blank">Download Excel</a>
                        <!--  <a class="btn btn-info" href="<?php echo site_url('invoice/export_invoice_pdf'); ?>" target="_blank">PDF</a> -->
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('invoice/get_payment_history_list'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('invoice/delete_payment_history'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <th class="text-center" width="2%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="2%">S.No</th>
                              <th class="text-left sorting" width="12%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'payment_history_name/ASC'); ?>">Payment Receipt #</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'payment_history_name/DESC'); ?>">Payment Receipt #</a>
                                 <?php } ?>
                              </th>
                               <th class="text-left sorting" width="12%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_name/ASC'); ?>">Invoice #</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_name/DESC'); ?>">Invoice #</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_payment_date/ASC'); ?>">Payment Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_payment_date/DESC'); ?>">Payment Date</a>
                                 <?php } ?>
                              </th>
                              
                              
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'payment_type_name/ASC'); ?>">Payment Type</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'payment_type_name/DESC'); ?>">Payment Type</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="30%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_payment_details/ASC'); ?>">Remarks</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_payment_details/DESC'); ?>">Remarks</a>
                                 <?php } ?>
                              </th>    
                              <th class="text-right sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_payment_amount/ASC'); ?>">Amount</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_payment_amount/DESC'); ?>">Amount</a>
                                 <?php } ?>
                              </th>                                                
                              <th class="text-right" width="8%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ 
								
							   ?>
                           <tr>
                              <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->invoice_id; ?>" value="<?php echo $val->invoice_id; ?>" id="checkbox_<?php echo $val->invoice_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->invoice_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left"><?php echo $val->payment_history_name; ?></td>
                              <td class="text-left"><?php echo $val->invoice_name; ?></td>
                           <td class="text-left"><?php echo getDateFormat($val->invoice_payment_date); ?></td>
                           
                          
                           
                            <td class="text-left"><?php echo $val->payment_type_name; ?></td>
                            <td class="text-left"><?php echo $val->invoice_payment_details; ?></td>
                           
                            <td class="text-right"><?php echo number_format($val->invoice_payment_amount); ?></td>
							  
                              <td class="text-right">	
                                 <a data-toggle="tooltip" class="a-btn" style="cursor:pointer"  title="Edit Purchase Order" href="<?php echo site_url('invoice/edit/'.$val->invoice_id); ?>"><i class="fa fa-pencil"></i></a>									  
                              </td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
							<tr><td align="center" colspan="10">No records found...</td></tr>   
							<?php } ?>  	
                        </tbody>
                     </table>
                     <?php if(in_array('invoice_delete',$permission)){?> 
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
     
	function delete_invoice(id){
		var r=confirm("Do you want to delete this?");
		var page = '<?php echo $page; ?>';
	if (r==true)
		window.location = "<?php echo base_url(); ?>/index.php/invoice/delete/"+page+"/"+id;
	else
		return false;
	} 
         
</script>

