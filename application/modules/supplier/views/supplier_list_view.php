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
                        <?php if(in_array('supplier_add',$permission)){ ?> 
                        <a class="btn btn-success" href="<?php echo site_url('supplier/add'); ?>">Add New</a>
                        <?php } ?>	
                        <?php if(in_array('supplier_add',$permission)){?> 	
                        <!-- <a class="btn btn-info" href="<?php echo site_url('supplier/export_supplier_excel'); ?>" target="_blank">Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('supplier/export_supplier_pdf'); ?>" target="_blank">PDF</a> -->
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('supplier/getlist'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('supplier/delete'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <th class="text-center" width="3%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="5%">S.No</th>
                              
                               <th class="text-left sorting" width="20%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/ASC'); ?>">Supplier Name</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/DESC'); ?>">Supplier Name</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_code/ASC'); ?>">Supplier Code</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_code/DESC'); ?>">Supplier Code</a>
                                 <?php } ?>
                              </th>
                            
                              <th class="text-left" width="13%"><a>Address Line1</a></th>
							        <th class="text-left" width="13%"><a>Address Line2</a></th>
							  
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'district_name/ASC'); ?>">District</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'district_name/DESC'); ?>">District</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_pincode/ASC'); ?>">Pincode</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_pincode/DESC'); ?>">Pincode</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'contact_number_1/ASC'); ?>">Mobile</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'contact_number_1/DESC'); ?>">Mobile</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="12%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'contact_email_1/ASC'); ?>">Email</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'contact_email_1/DESC'); ?>">Email</a>
                                 <?php } ?>
                              </th>
                               <!--<th class="text-center sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'direct_to_customer/ASC'); ?>">Direct To Customer</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'direct_to_customer/DESC'); ?>">Direct To Customer</a>
                                 <?php } ?>
                              </th>-->
                             
                              <th class="text-right" WIDTH="10%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ ?>
                           <tr>
                              <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->supplier_id; ?>" value="<?php echo $val->supplier_id; ?>" id="checkbox_<?php echo $val->supplier_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->supplier_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left">
                                 <a id="<?php echo $val->supplier_id; ?>" data-toggle="tooltip" class="supplier_details" style="cursor:pointer"><?php echo $val->supplier_name; ?> <i class="fa fa-search"></i></a>
                              </td>
                              
                              <td class="text-left"><?php echo $val->supplier_code; ?></td>
                              <td class="text-left"><?php echo $val->supplier_address_line1; ?></td>
							  <td class="text-left"><?php echo $val->supplier_address_line2; ?></td>
                              <td class="text-left"><?php echo $val->district_name; ?></td>
                              <td class="text-left"><?php echo $val->supplier_pincode; ?></td>
                              <td class="text-left"><?php echo $val->contact_number_1; ?></td>
                              <td class="text-left"><?php echo $val->contact_email_1; ?></td>
                             <!-- <td class="text-center"><?php if($val->direct_to_customer) echo 'Yes'; else echo '-'; ?></td>-->
                              <td class="text-right">											
                                 <?php if(in_array('supplier_edit',$permission)){?> 
                                 <a title="Edit" data-toggle="tooltip" class="btn btn-raised bg-indigo waves-effect" href="<?php echo site_url('supplier/edit/'.$val->supplier_id); ?>"><i class="fa fa-pencil"></i> </a>
                                 <?php } ?>
                              </td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php } ?>	
                        </tbody>
                     </table>
                     <?php if(in_array('supplier_delete',$permission)){?> 
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
<?php //include('popup_call_form_supplier.php'); ?>
<?php //include('popup_appointment_form_supplier.php'); ?>
<?php //include('popup_supplier_remark_form.php'); ?>
<?php include('popup_supplier_details_view.php'); ?>
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
     
     function delete_supplier(id){
   var r=confirm("Do you want to delete this?");
         var page = '<?php echo $page; ?>';
   if (r==true)
   	window.location = "<?php echo base_url(); ?>/index.php/supplier/delete/"+page+"/"+id;
   else
   	return false;
         } 
         
</script>
