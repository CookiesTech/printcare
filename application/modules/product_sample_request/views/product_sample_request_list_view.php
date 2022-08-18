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
                        <?php if(in_array('product_sample_request_add',$permission)){ ?> 
                        <a class="btn btn-success" href="<?php echo site_url('product_sample_request/add'); ?>">Add New</a>
                        <?php } ?>	
                        <?php if(in_array('product_sample_request_add',$permission)){?> 	
                        <a class="btn btn-info" href="<?php echo site_url('product_sample_request/export_product_sample_request_excel'); ?>" target="_blank">Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('product_sample_request/export_product_sample_request_pdf'); ?>" target="_blank">PDF</a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('product_sample_request/getlist'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('product_sample_request/delete'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <th class="text-center" width="2%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="2%">S.No</th>
                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'client_code/ASC'); ?>">SOF No</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'client_code/DESC'); ?>">SOF No</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'product_sample_request_date/ASC'); ?>">Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'product_sample_request_date/DESC'); ?>">Date</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'client_name/ASC'); ?>">Customer</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'client_name/DESC'); ?>">Customer</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="13%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/ASC'); ?>">Supplier</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/DESC'); ?>">Supplier</a>
                                 <?php } ?>
                              </th>
                             
                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'sample_request_category_name/ASC'); ?>">Category</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'sample_request_category_name/DESC'); ?>">Category</a>
                                 <?php } ?>
                              </th>
                             <!-- <th class="text-center sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'product_sample_request_qty/ASC'); ?>">Quantity</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'product_sample_request_qty/DESC'); ?>">Quantity</a>
                                 <?php } ?>
                              </th>-->
                              
                              <th class="text-left sorting" width="8%"><a>Inst Date</a></th>                                
                              <th class="text-center" width="10%">Status</th>
                              <th class="text-right" width="10%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ 
							   $res_dc = $this->Common_model->getDetails('delivery_challan','ref_product_sample_request_id',$val->product_sample_request_id);
							   ?>
                           <tr>
                              <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->product_sample_request_id; ?>" value="<?php echo $val->product_sample_request_id; ?>" id="checkbox_<?php echo $val->product_sample_request_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->product_sample_request_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left">
								  <?php if(!empty($val->product_sample_request_file)){ ?>
									<a id="<?php echo $val->product_sample_request_id; ?>" data-toggle="tooltip" class="a-btn" style="cursor:pointer" title="Details" href="<?php echo base_url().$val->product_sample_request_file; ?>" target="_blank"><?php echo $val->product_sample_request_code; ?> <i class="fa fa-search"></i></a>
								   <?php }else{ ?>
									   <?php echo $val->product_sample_request_code; ?>
								   <?php } ?>
                              </td>
                              <td class="text-left"><?php echo $this->Common_model->getDateFormat($val->product_sample_request_date); ?></td>
                              <td class="text-left">
                                 <a id="<?php echo $val->ref_client_id; ?>" data-toggle="tooltip" class="product_sample_request_details" style="cursor:pointer"><?php echo $val->client_name; ?> <i class="fa fa-search"></i></a>
                              </td>
                              <td class="text-left"><?php echo $val->supplier_name; ?></td>
                              <td class="text-left"><?php echo $val->sample_request_category_name; ?></td>
                              <!--<td class="text-center"><?php //echo $val->product_sample_request_qty; ?></td>-->
                              
                             <!--<td class="text-left"><?php echo $val->product_sample_request_details; ?></td>-->
                              <td class="text-left"><?php echo $this->Common_model->getDateFormat($val->installation_date); ?></td>
                              </td>
                              <td class="text-center" >
                                 <?php
                                 if($val->ref_product_request_status_id == '1'){ ?>
										<span class="label label-danger"><?php echo $val->product_request_status_name;?></span>
                                 <?php } else if($val->ref_product_request_status_id == '2'){ ?>
									<span class="label label-info"><?php echo $val->product_request_status_name;?></span>
                                 <?php } else if($val->ref_product_request_status_id == '3'){ ?>
									<span class="label label-success"><?php echo $val->product_request_status_name;?></span>
                                 
                                 <?php } else if($val->ref_product_request_status_id == '4'){ ?>
									<span class="label label-warning"><?php echo $val->product_request_status_name;?></span>
                                 <?php }?>
                              </td>
                              <td class="text-right" >											
                                
                                 <?php if($val->ref_product_request_status_id == '2'){ ?>
									<a id="<?php echo $val->product_sample_request_id; ?>" data-toggle="tooltip" class="a-btn  update_feedback_details" style="cursor:pointer" title="Update Customer Feedback"><i class="fa fa-comment-o"></i></a>
                                 <?php } else if($val->ref_product_request_status_id == '4'){ ?>
									<a id="<?php echo $val->product_sample_request_id; ?>" data-toggle="tooltip" class="a-btn update_delivery_details" style="cursor:pointer" id="delivery" title="Update Delivery Details"><i class="fa fa-comment-o"></i></a>
                                 <?php }?>
                                 <?php if(!$val->mail_status){ ?>
									<a data-toggle="tooltip" title="Send Sample Request To Supplier" class="a-btn" href="<?php echo site_url('product_sample_request/sample_request/'.$val->product_sample_request_id); ?>" > <i class="fa fa-envelope"></i></a>
								 <?php } ?>	
								 <?php //if( $val->mail_status == '1' && !$val->delivery_challan_status){ ?>									 
									<a data-toggle="tooltip" title="Generate DC" class="a-btn " href="<?php echo site_url('product_sample_request/generate_dc/'.$val->product_sample_request_id); ?>" > <i class="fa fa-file-pdf-o"></i></a>
								 <?php //} ?>
								 <?php if(!$val->inward_status){ ?>
									<!--<a title="Update Inward" data-toggle="tooltip" class="a-btn " href="<?php //echo site_url('product_sample_request/update_inward/'.$val->product_sample_request_id); ?>"><i class="fa fa-plus"></i> </a>-->
                                  <?php } ?>
                                   
                                   <?php if(isset($res_dc) && !empty($res_dc)){ ?>
										<!--<a data-toggle="tooltip" class="a-btn " style="cursor:pointer"  title="View DC" href="<?php //echo base_url().$res_dc[0]->delivery_challan_file; ?>" target="_blank"><i class="fa fa-download"></i></a>-->
                                   <?php } ?>
                                    <?php if(isset($val->product_sample_request_file) && !empty($val->product_sample_request_file)){ ?>
										<!--<a data-toggle="tooltip" class="btn" style="cursor:pointer"  title="Download Sample Request" href="<?php //echo base_url().$val->product_sample_request_file; ?>" target="_blank"><i class="fa fa-download"></i></a>-->
                                   <?php } ?>
                                  <?php if(!$val->mail_status ){ ?>
									<a title="Edit" data-toggle="tooltip" class="a-btn" href="<?php echo site_url('product_sample_request/edit/'.$val->product_sample_request_id); ?>"><i class="fa fa-pencil"></i> </a>
                                  <?php } ?>
                                 
                              </td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
							<tr><td align="center" colspan="9">No records found...</td></tr>   
							<?php } ?>  	
                        </tbody>
                     </table>
                     <?php if(in_array('product_sample_request_delete',$permission)){?> 
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

<?php include('popup_product_sample_request_details_view.php'); ?>
<?php include('popup_sample_request_update_form_view.php'); ?>
<?php include('popup_sample_request_customer_feedback.php'); ?>
<?php include('popup_sample_request_details_full_view.php'); ?>
<script>
   $('#appointment_to_confirm').on('change',function(){
      $("input[name=appointment_to_confirm_date]").prop("disabled", !$(this).is(':checked'));
   });
   
   function clearModalPopup(){
   $("input[type=text], textarea").val("");
   $("select option:selected").removeAttr("selected");
   $('select[name=sele],select[name=appointment_feedback_id]').prop('selectedIndex',0);
   $('input:checkbox').removeAttr('checked');
   setTimeout(function(){
   	$('.success_msg').fadeOut();
   	$('.success_msg').html(' ');
   	$('.js-modal-close').click();
   },1000);
   }
     
     function delete_product_sample_request(id){
   var r=confirm("Do you want to delete this?");
         var page = '<?php echo $page; ?>';
   if (r==true)
   	window.location = "<?php echo base_url(); ?>/index.php/product_sample_request/delete/"+page+"/"+id;
   else
   	return false;
         } 
         
</script>

