<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">Stock List</h4>
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
                       <!--  <?php if(in_array('product_add',$permission)){ ?> 
                        <a class="btn btn-success" href="<?php echo site_url('product/add'); ?>">Add New</a> -->
                        <?php } ?>	
                        <?php if(in_array('product_stock_report_view',$permission)){?> 	
                        <a class="btn btn-info" href="<?php echo site_url('product/export_product_stock_excel'); ?>" target="_blank">Download Excel</a>
                        <!-- <a class="btn btn-info" href="<?php echo site_url('product/export_product_stock_pdf'); ?>" target="_blank">PDF</a> -->
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('product/product_stock_list'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('product/delete'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <!-- <th class="text-center" width="3%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th> -->
                              <th class="text-center sorting" width="5%">S.No</th>
                               <th class="text-left sorting" width="20%">
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

                              <th class="text-left sorting" width="20%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'category_name/ASC'); ?>">Category</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'category_name/DESC'); ?>">Category</a>
                                 <?php } ?>
                              </th>
                             
							  
                              
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'quantity/ASC'); ?>">Quantity</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'quantity/DESC'); ?>">Quantity</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'product_price/ASC'); ?>">MRP</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'product_price/DESC'); ?>">MRP</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'gst_type_name/ASC'); ?>">GST</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'gst_type_name/DESC'); ?>">GST</a>
                                 <?php } ?>
                              </th>
                               <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'star_rating/ASC'); ?>">Star Rating</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'star_rating/DESC'); ?>">Star Rating</a>
                                 <?php } ?>
                              </th>
                               <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'reorder_level/ASC'); ?>">Re-Order Level</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'reorder_level/DESC'); ?>">Re-Order Level</a>
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
                             
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ ?>
                           <tr>
                              <!-- <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->product_id; ?>" value="<?php echo $val->product_id; ?>" id="checkbox_<?php echo $val->product_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->product_id; ?>"></label>
                              </td> -->
                              <?php

                                 $qty = $this->Common_model->get_product_qty($val->product_id);
                              ?>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left"><?php echo $val->product_name; ?></td>
                              
                              <td class="text-left"><?php echo $val->sku; ?></td>
                              <td class="text-left"><?php echo $val->category_name; ?></td>
							         <td class="text-left"><?php echo $qty; ?></td>
                              <td class="text-left"><?php echo $val->product_price; ?></td>
                              <td class="text-left"><?php echo $val->gst_type_name; ?></td>
                              <td class="text-left"><?php echo $val->star_rating_name; ?> Star</td>
                              <td class="text-left"><?php echo $val->reorder_level; ?></td>
                              <!-- <td class="text-center"><?php if($val->featured_product) echo 'Yes'; else echo '-'; ?></td> -->
                             
                           </tr>
                           <?php  $i++; } ?>
                           <?php } ?>	
                        </tbody>
                     </table>
                    <!--  <?php if(in_array('product_delete',$permission)){?> 
                     <input class="btn btn-danger delete " style="margin-top:10px;" type="submit" value="Delete" onClick="return confirmDelete();">
                     <?php } ?>  -->
                     <?php echo form_close(); ?>		
                     <?php echo $pagination_block; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

