<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">Brokerage History List</h4>
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
                       
                        <?php if(in_array('agent_add',$permission)){?> 	
                        <a class="btn btn-info" href="<?php echo site_url('agent/export_agent_excel'); ?>" target="_blank">Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('agent/export_agent_pdf'); ?>" target="_blank">PDF</a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               
               
               <div class="clearfix"></div>
               <?php echo form_open('agent/getlist'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('agent/delete'); ?>
                     <table class="table color-table info-table ">
                        <thead>
                           <tr>
                              <th class="text-center" width="3%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="5%">S.No</th>
                              <th class="text-left sorting" width="12%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'agent_name/ASC'); ?>">Agent</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'agent_name/DESC'); ?>">Agent</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="50%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'policy_name/ASC'); ?>">Policy No</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'policy_name/DESC'); ?>">Policy No</a>
                                 <?php } ?>
                              </th>
                              <th class="text-right sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'agent_brokerage_amount/ASC'); ?>">Brokerage Amount</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'agent_brokerage_amount/DESC'); ?>">Brokerage Amount</a>
                                 <?php } ?>
                              </th>
                             
                              <th class="text-right sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'added_date/ASC'); ?>">Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'added_date/DESC'); ?>">Date</a>
                                 <?php } ?>
                              </th>
                             
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ ?>
                           <tr>
                              <td class="text-center">
                                 <input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->agent_brokerage_history_id; ?>" value="<?php echo $val->agent_brokerage_history_id; ?>" id="checkbox_<?php echo $val->agent_brokerage_history_id; ?>" class="checkbox_list">
                                 <label for="checkbox_<?php echo $val->agent_brokerage_history_id; ?>"></label>
                              </td>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left"><?php echo $val->agent_name; ?></td>
                              <td class="text-left"><?php echo $val->policy_name; ?></td>
                              <td class="text-right"><?php echo $val->agent_brokerage_amount; ?></td>
                               <td class="text-right"><?php echo $this->Common_model->getDateFormat($val->added_date); ?></td>
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
                           <tr>
                              <td align="center" colspan="5">No records found...</td>
                           </tr>
                           <?php } ?>		
                        </tbody>
                     </table>
                     <?php echo form_close(); ?>
                     <?php echo $pagination_block; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

