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
                        <?php if(in_array('product_add',$permission)){ ?> 
                        <a class="btn btn-success" href="<?php echo site_url('product/add'); ?>">Add New</a>
                        <?php } ?>  
                        <?php if(in_array('product_add',$permission)){?>   
                        <!-- <a class="btn btn-info" href="<?php echo site_url('product/export_product_excel'); ?>" target="_blank">Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('product/export_product_pdf'); ?>" target="_blank">PDF</a> -->
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('product/getlist'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('product/delete'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <th class="text-center" width="3%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="5%">S.No</th>
                               <th class="text-left sorting" width="25%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'product_name/ASC'); ?>">Product Name</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'product_name/DESC'); ?>">Product Name</a>
                                 <?php } ?>
                              </th>
                               <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'sku/ASC'); ?>">SKU</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'sku/DESC'); ?>">SKU</a>
                                 <?php } ?>
                              </th>

                               <th class="text-left sorting" width="7%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'unit/ASC'); ?>">Unit</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'unit/DESC'); ?>">Unit</a>
                                 <?php } ?>
                              </th>

                              <th class="text-left sorting" width="20%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'category_name/ASC'); ?>">Category</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'category_name/DESC'); ?>">Category</a>
                                 <?php } ?>
                              </th>
                             
                       
                              
                              <th class="text-center sorting" width="6%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'quantity/ASC'); ?>">Qty</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'quantity/DESC'); ?>">Qty</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right sorting" width="6%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'product_price/ASC'); ?>">MRP</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'product_price/DESC'); ?>">MRP</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'gst_type_name/ASC'); ?>">GST</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'gst_type_name/DESC'); ?>">GST</a>
                                 <?php } ?>
                              </th>
                               <!-- <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'star_rating/ASC'); ?>">Star Rating</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'star_rating/DESC'); ?>">Star Rating</a>
                                 <?php } ?>
                              </th> -->
                               <th class="text-center sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'reorder_level/ASC'); ?>">Re-Order</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'reorder_level/DESC'); ?>">Re-Order</a>
                                 <?php } ?>
                              </th>
                             <!--   <th class="text-center sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'featured_product/ASC'); ?>">Featured</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'featured_product/DESC'); ?>">Featured</a>
                                 <?php } ?>
                              </th>
                              -->
                              <th class="text-right" WIDTH="10%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ 
                              $qty = $this->Common_model->get_product_qty($val->product_id);
                              ?>
                           <tr>
                              <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->product_id; ?>" value="<?php echo $val->product_id; ?>" id="checkbox_<?php echo $val->product_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->product_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left">
                                 <a id="<?php echo $val->product_id; ?>" data-toggle="tooltip" class="product_details" style="cursor:pointer"><?php echo $val->product_name; ?> <i class="fa fa-search"></i></a>
                              </td>
                              
                              <td class="text-left"><?php echo $val->sku; ?></td>
                              <td class="text-left"><?php echo $val->unit; ?></td>
                              <td class="text-left"><?php echo $val->category_name; ?></td>
                              <td class="text-center"><?php echo $this->Common_model->get_product_qty($val->product_id);?></td>
                              <td class="text-right"><?php echo $val->product_price; ?></td>
                              <td class="text-right"><?php echo $val->gst_type_name; ?></td>
                              <!-- <td class="text-left"><?php echo $val->star_rating_name; ?> Star</td> -->
                              <td class="text-center"><?php echo $val->reorder_level; ?></td>
                              <!-- <td class="text-center"><?php if($val->featured_product) echo 'Yes'; else echo '-'; ?></td> -->
                              <td class="text-right">                               
                                 <?php if(in_array('product_edit',$permission)){?> 
                                 <a title="Edit" data-toggle="tooltip" class="btn btn-info" href="<?php echo site_url('product/edit/'.$val->product_id); ?>"><i class="fa fa-pencil"></i> </a>
                                 <?php } ?>
                              </td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php } ?>  
                        </tbody>
                     </table>
                     <?php if(in_array('product_delete',$permission)){?> 
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
function delete_product(id){
   var r=confirm("Do you want to delete this?");
         var page = '<?php echo $page; ?>';
   if (r==true)
      window.location = "<?php echo base_url(); ?>/index.php/product/delete/"+page+"/"+id;
   else
      return false;
         } 
         
</script>
