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
                        ?>
                     </h6>
                  </div>
                  <div class="col-md-6 text-right">
                     <div class="dt-buttons">
                        <?php if(in_array('customer_add',$permission)){ ?> 
                        <!-- <a class="btn btn-success" href="<?php echo site_url('customer/add'); ?>">Add New</a> -->
                        <?php } ?>	
                        
                         <?php if(in_array('customer_add',$permission)){?> 	
                        <a class="btn btn-info" href="<?php echo site_url('customer/export_customer_excel'); ?>" target="_blank">Download Excel</a>
                       <!-- <a class="btn btn-info" href="<?php echo site_url('customer/export_customer_pdf'); ?>" target="_blank">PDF</a>
                        <?php } ?> -->
                     </div>
                  </div>
               </div>
               <?php echo form_open('customer/getlist'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="clearfix"></div>
               <div class="table-responsive">
                   <div class="dataTables_wrapper">
                     <?php echo form_open('customer/delete'); ?>
                     <table class="<?php echo LIST_TH_CLASS; ?>">
                        <thead>
                           <tr>
                              <th class="text-center" width="3%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="3%">S.No</th>
                              <th class="text-left" width="12%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'customer_name/ASC'); ?>">Name</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'customer_name/DESC'); ?>">Name</a>
                                 <?php } ?>
                              </th>
                              <!--<th class="text-left" width="12%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'ref_branch_id/ASC'); ?>">Branch</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'ref_branch_id/DESC'); ?>">Branch</a>
                                 <?php } ?>
                              </th>-->
                              <th class="text-left sorting " width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'user_type/DESC'); ?>">Type</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'user_type/ASC'); ?>">Type </a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'mobile/DESC'); ?>">Mobile</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'mobile/ASC'); ?>">Mobile</a>
                                 <?php } ?>
                              </th>

                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'email/DESC'); ?>">Email</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'email/ASC'); ?>">Email</a>
                                 <?php } ?>
                              </th>

                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'address/DESC'); ?>">Address</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'address/ASC'); ?>">Address</a>
                                 <?php } ?>
                              </th>

                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'district_name/DESC'); ?>">District</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'district_name/ASC'); ?>">District</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'state_name/DESC'); ?>">State</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'state_name/ASC'); ?>">State</a>
                                 <?php } ?>
                              </th>
                              
						           <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'added_date/DESC'); ?>">Reg Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'added_date/ASC'); ?>">Reg Date</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right" width="7%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php 
								$i = $start+1; foreach ($mainlist as $key => $val){ 
								
							   ?>
                           <tr>
                              <td class="text-center"><input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->customer_id; ?>" value="<?php echo $val->customer_id; ?>" id="checkbox_<?php echo $val->customer_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->customer_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left"><a id="<?php echo $val->customer_id; ?>" data-toggle="tooltip" class="customer_details" style="cursor:pointer"><?php echo $val->customer_name; ?> <i class="fa fa-search"></i></a></td>
                              <!--<td class="text-center"><?=$val->branch_name; ?></td>-->
                           
                              <td class="text-left"><?php if($val->user_type == '1') echo 'Registered'; else echo 'Guest'; ?></td>
                              <td class="text-left"><?php echo $val->mobile; ?></td>
                              <td class="text-left"><?php echo $val->email; ?></td>
                              <td class="text-left"><?php echo $val->address; ?></td>
                              <td class="text-left"><?php echo $val->district_name; ?></td>
                              <td class="text-center"><?php echo $val->state_name; ?></td>
                              
							        <td class="text-left"><?php echo getDateFormat($val->added_date); ?></td>
                              <td class="text-right">
                                  <?php if(in_array('customer_edit',$permission)){?> 
                                 <a title="Edit" data-toggle="tooltip" class="btn btn-success" href="<?php echo site_url('customer/edit/'.$val->customer_id); ?>"><i class="fa fa-pencil"></i> </a>
                                 <?php } ?>
                              </td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
							   <tr><td colspan="6" align="center">No records found...</td></tr>
							<?php } ?>   	
                        </tbody>
                     </table>
                     <?php if(in_array('customer_delete',$permission)){?> 
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


<script>
     function delete_customer(id){
   var r=confirm("Do you want to delete this?");
         var page = '<?php echo $page; ?>';
   if (r==true)
   	window.location = "<?php echo base_url(); ?>/index.php/customer/delete/"+page+"/"+id;
   else
   	return false;
         } 
         
</script>
