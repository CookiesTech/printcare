<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">Pending Prescription List</h4>
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
                        <?php if(in_array('invoice_add',$permission)){?> 	
                       <!--  <a class="btn btn-info" href="<?php echo site_url('invoice/export_invoice_excel'); ?>" target="_blank">Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('invoice/export_invoice_pdf'); ?>" target="_blank">PDF</a> -->
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('invoice/get_patient_pending_prescription_list'); ?>
               <?php echo $filter_block; ?>
               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('invoice/adelete'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                              <th class="text-center" width="2%">
                                 <input type ="checkbox" id="checkAll" class="checkbox_list">
                                 <label for="checkAll"></label>
                              </th>
                              <th class="text-center sorting" width="2%">S.No</th>
                              <th class="text-left sorting" width="6%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'added_date/ASC'); ?>">Visit Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'added_date/DESC'); ?>">Visit Date</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'patient_name/ASC'); ?>">Patient</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'patient_name/DESC'); ?>">Patient</a>
                                 <?php } ?>
                              </th>
                             <!--  <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'specialization_name/ASC'); ?>">Specialization</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'specialization_name/DESC'); ?>">Specialization</a>
                                 <?php } ?>
                              </th> -->
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'employee_name/ASC'); ?>">Doctor</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'employee_name/DESC'); ?>">Doctor</a>
                                 <?php } ?>
                              </th>
                              
                              <th class="text-left sorting" width="10%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'ayurveda_diagnosis/ASC'); ?>">Ayurveda Diagnosis</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'ayurveda_diagnosis/DESC'); ?>">Ayurveda Diagnosis</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'m_diagnosis/ASC'); ?>">M.Diagnosis</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'m_diagnosis/DESC'); ?>">M.Diagnosis</a>
                                 <?php } ?>
                              </th>
                             <!--  <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'modern_system/ASC'); ?>">Modern System</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'modern_system/DESC'); ?>">Modern System</a>
                                 <?php } ?>
                              </th> -->
                              <th class="text-left sorting" width="6%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'aayurveda/ASC'); ?>">Aayurveda</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'aayurveda/DESC'); ?>">Aayurveda</a>
                                 <?php } ?>
                              </th>
                               <th class="text-left sorting" width="6%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'panchkarma/ASC'); ?>">Panchkarma</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'panchkarma/DESC'); ?>">Panchkarma</a>
                                 <?php } ?>
                              </th>                     
                              <th class="text-right" width="5%">Action</th>
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
                              <td class="text-left"><?php echo getDateFormat($val->added_date); ?></td>
                           <td class="text-left"><a href="<?= site_url('patient/details/'.$val->ref_patient_id)?>" target="_blank"><?php echo $val->patient_name; ?> <i class="fa fa-search"></i></a></td>  
                           <!-- <td class="text-left"><?php echo $val->specialization_name; ?></td>   -->
                           <td class="text-left"><?php echo $val->employee_name; ?></td> 
                           
                           <td class="text-left"><?php echo $val->ayurveda_diagnosis; ?></td>
                           <td class="text-left"><?php echo $val->m_diagnosis; ?></td>
                           <!-- <td class="text-left"><?php echo $val->modern_system; ?></td>
                           -->
                           <td class="text-left"><?php if($val->aayurveda) echo 'Yes'; else 'No';  ?></td>
                           <td class="text-left"><?php if($val->panchkarma) echo 'Yes'; else 'No';  ?></td>
   							    

							  
                              <td class="text-right">
                                 <a data-toggle="tooltip" class="btn btn-success" style="cursor:pointer"  title="Edit Purchase Order" href="<?php echo site_url('invoice/get_patient_pres_sales_form/'.$val->patient_visit_id); ?>">Create Sales</a>
									  
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

