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
                       
                        <?php if(in_array('proforma_invoice_add',$permission)){?> 	
                        <a class="btn btn-info" href="<?php echo site_url('product_sample_request/export_proforma_invoice_excel'); ?>" target="_blank">Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('product_sample_request/export_proforma_invoice_pdf'); ?>" target="_blank">PDF</a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('product_sample_request/get_proforma_invoice_list'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('product_sample_request/delete_proforma_invoice'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <th class="text-center" width="3%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="3%">S.No</th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'proforma_invoice_code/ASC'); ?>">Proforma Inv No</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'proforma_invoice_code/DESC'); ?>">Proforma Inv No</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'proforma_invoice_date/ASC'); ?>">Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'proforma_invoice_date/DESC'); ?>">Date</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'client_name/ASC'); ?>">Client</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'client_name/DESC'); ?>">Client</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/ASC'); ?>">Supplier</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/DESC'); ?>">Supplier</a>
                                 <?php } ?>
                              </th>
                              
                              <th class="text-center sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'company_proforma/ASC'); ?>">Company Prof</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'company_proforma/DESC'); ?>">Company Prof</a>
                                 <?php } ?>
                              </th>
                                                           
                             <th class="text-center" width="7%">PO Status</th>
                             <th class="text-right" width="7%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){
									//$res_po = $this->Common_model->getDetails('purchase_order','ref_proforma_invoice_id',$val->proforma_invoice_id);
							    ?>
                           <tr>
                              <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->proforma_invoice_id; ?>" value="<?php echo $val->proforma_invoice_id; ?>" id="checkbox_<?php echo $val->proforma_invoice_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->proforma_invoice_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left">
								   <a id="<?php echo $val->proforma_invoice_id; ?>" data-toggle="tooltip" class="btn" style="cursor:pointer" id="" title="Details" href="<?php echo base_url().$val->proforma_invoice_file; ?>" target="_blank"><?php echo $val->proforma_invoice_code; ?> <i class="fa fa-search"></i></a>
                              </td>
                              <td class="text-left"><?php echo $this->Common_model->getDateFormat($val->proforma_invoice_date); ?></td>
                              <td class="text-left"><?php echo $val->client_name; ?></td>
                              <td class="text-left"><?php echo $val->supplier_name; ?></td>
                              <td class="text-center">
								  <?php 
									if($val->company_proforma)
										echo '<span class="label label-success"><a href="'.base_url().$val->company_proforma_file.'" target="_blank" style="color:#fff;" title="view Invoice Copy">Yes <i class="fa fa-search"></i><a></span>';
									else
										echo '<span class="label label-danger">No</span>';	
								   ?>
							</td>
                              <td class="text-center">
								  <?php 
									if(isset($val->proforma_invoice_status_name) && !empty($val->proforma_invoice_status_name))
										echo '<span class="label label-success">'.$val->proforma_invoice_status_name.'</span>';
									else
										echo '<span class="label label-danger">Pending</span>';	
								   ?>
							</td>
                             <td class="text-right" >
								<?php if(!$val->ref_proforma_invoice_status_id ){ ?>
									<a id="<?php echo $val->proforma_invoice_id; ?>" data-toggle="tooltip" class="a-btn  update_proforma_invoice_status" style="cursor:pointer" title="Update Proforma Invoice Status"><i class="fa fa-comment-o"></i></a>
								
									<a title="Create Purchase Order" data-toggle="tooltip" class="a-btn" href="<?php echo site_url('purchase_order/add/'.$val->proforma_invoice_id); ?>"><i class="fa fa-plus"></i> </a>
								 
									<a title="Edit" data-toggle="tooltip" class="a-btn" href="<?php echo site_url('product_sample_request/edit_proforma_invoice/'.$val->proforma_invoice_id); ?>"><i class="fa fa-pencil"></i> </a>
                                 <?php } ?>
                                  
                              </td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
							<tr><td align="center" colspan="7">No records found...</td></tr>   
							<?php } ?>  	
                        </tbody>
                     </table>
                     <?php if(in_array('proforma_invoice_delete',$permission)){?> 
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
<?php include('popup_proforma_invoice_status_update_form_view.php'); ?>
<script> 
    function delete_proforma_invoice(id){
	   var r=confirm("Do you want to delete this?");
			 var page = '<?php echo $page; ?>';
	   if (r==true)
		window.location = "<?php echo base_url(); ?>/index.php/proforma_invoice/delete/"+page+"/"+id;
	   else
		return false;
      } 
         
</script>

