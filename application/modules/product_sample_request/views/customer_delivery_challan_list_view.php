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
                       
                        <?php if(in_array('delivery_challan_add',$permission)){?> 	
                        <a class="btn btn-info" href="<?php echo site_url('product_sample_request/export_customer_delivery_challan_excel'); ?>" target="_blank">Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('product_sample_request/export_customer_delivery_challan_pdf'); ?>" target="_blank">PDF</a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('product_sample_request/get_customer_delivery_challan_list'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('product_sample_request/delete_delivery_challan'); ?>
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
                                 <a href="<?php echo site_url($listing_page.'customer_delivery_challan_code/ASC'); ?>">DC No</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'customer_delivery_challan_code/DESC'); ?>">DC No</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'customer_delivery_challan_date/ASC'); ?>">Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'customer_delivery_challan_date/DESC'); ?>">Date</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="20%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'client_name/ASC'); ?>">Client</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'client_name/DESC'); ?>">Client</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="20%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/ASC'); ?>">Supplier</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/DESC'); ?>">Supplier</a>
                                 <?php } ?>
                              </th>
                             
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'despatch_mode_name/ASC'); ?>">Despatch</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'despatch_mode_name/DESC'); ?>">Despatch</a>
                                 <?php } ?>
                              </th>                                                          
                              <th class="text-left" width="8%">Delivery To</th>
                              <!--<th class="text-right" width="7%">Action</th>-->
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ 
                                 $despatch_mode_name = '';
                                 $delivery_point_name = '';
                                 $res_despatch_mode = $this->Common_model->getDetails('despatch_mode','despatch_mode_id',$val->customer_despatch_mode_id);
                                 if(isset($res_despatch_mode) && !empty($res_despatch_mode)){
                                    $despatch_mode_name = $res_despatch_mode[0]->despatch_mode_name;   
                                 }

                                 $res_delivery_point = $this->Common_model->getDetails('delivery_point','delivery_point_id',$val->customer_delivery_point_id);
                                 if(isset($res_delivery_point) && !empty($res_delivery_point)){
                                    $delivery_point_name = $res_delivery_point[0]->delivery_point_name;   
                                 }
                                 
                              ?>
                           <tr>
                              <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->delivery_challan_id; ?>" value="<?php echo $val->delivery_challan_id; ?>" id="checkbox_<?php echo $val->delivery_challan_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->delivery_challan_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left">
								           <a id="<?php echo $val->delivery_challan_id; ?>" data-toggle="tooltip" class="btn" style="cursor:pointer" id="" title="Details" href="<?php echo base_url().$val->delivery_challan_file; ?>" target="_blank"><?php echo $val->customer_delivery_challan_code; ?> <i class="fa fa-search"></i></a>
                              </td>
                              <td class="text-left"><?php echo $this->Common_model->getDateFormat($val->customer_delivery_challan_date); ?></td>
                              <td class="text-left">
                                 <a id="<?php echo $val->ref_client_id; ?>" data-toggle="tooltip" class="delivery_challan_details" style="cursor:pointer"><?php echo $val->client_name; ?> <i class="fa fa-search"></i></a>
                              </td>
                              <td class="text-left"><?php echo $val->supplier_name; ?></td>
                              <td class="text-left"><?php echo $despatch_mode_name; ?></td>
                              <td class="text-left"><?php echo $delivery_point_name; ?></td>
                              
                              
								  <?php if(in_array('delivery_challan_view',$permission)){?> 
									  <!--<a data-toggle="tooltip" class="btn" style="cursor:pointer"  title="Download DC" href="<?php echo base_url().$val->delivery_challan_file; ?>" target="_blank" download><i class="fa fa-download"></i></a>-->
									  
									  <!--<a title="Edit" data-toggle="tooltip" class="btn" href="<?php echo site_url('delivery_challan/edit/'.$val->delivery_challan_id); ?>"><i class="fa fa-pencil"></i> </a>   -->                             
                                 <?php } ?>
                              
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
							<tr><td align="center" colspan="8">No records found...</td></tr>   
							<?php } ?>  	
                        </tbody>
                     </table>
                     <?php if(in_array('delivery_challan_delete',$permission)){?> 
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
<?php //include('popup_delivery_challan_details_view.php'); ?>
<script> 
    function delete_delivery_challan(id){
	   var r=confirm("Do you want to delete this?");
			 var page = '<?php echo $page; ?>';
	   if (r==true)
		window.location = "<?php echo base_url(); ?>/index.php/delivery_challan/delete/"+page+"/"+id;
	   else
		return false;
      } 
         
</script>

