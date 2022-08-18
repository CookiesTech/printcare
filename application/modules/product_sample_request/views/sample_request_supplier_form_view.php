<!--- Form --->
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <?php if(isset($_SESSION['success_msg'])){ ?>
         <div role="alert" class="alert alert-success black alert-dismissible  "> 
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> 
            <strong>
            <?php 
               echo $_SESSION['success_msg'];
               unset($_SESSION['success_msg']);
               ?>
            </strong> 
         </div>
         <?php } ?>
         <?php if(isset($_SESSION['error_msg'])){ ?>
         <div role="alert" class="alert alert-danger alert-dismissible  "> 
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> 
            <strong>
            <?php 
               echo $_SESSION['error_msg'];
               unset($_SESSION['error_msg']);
               ?>
            </strong> 
         </div>
         <?php } ?>	
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">Product Request Notification To <b><?php echo $sample[0]->supplier_name; ?></b></h4>
            </div>
            <div class="card-body">
               <h4 class="card-title"></h4>
               <form method="POST" enctype="multipart/form-data" action="<?php echo $action; ?>" autocomplete="off" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').innerHTML='Mail sending to Supplier, Please wait...';">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="email_response"></div>
                        <h4><b>Email Details</b></h4>
                        <div class="row">
                           <div class="col-md-12">
                              <input type="hidden" id="sample_id" value="<?php echo $sample_request_id; ?>" />
                              <input type="hidden"  name="email_subject" value="<?php echo $subject; ?>"> 
                              
                              <ul style="padding:0px;list-style-type:none;">
                                 <?php 
                                    $i = 1;
                                    if(isset($supplier_email_ids) && !empty($supplier_email_ids)){			  
                                     foreach($supplier_email_ids as $key=> $val){				
                                    echo '<li><input type="checkbox" class="" name="supplier_email" value="'.$val->email_id.'" id="email_'.$i.'" >
                                    <label for="email_'.$i.'">'.$val->email_id. ' ( <b>'.$val->contact_person.'</b> )</label>';
                                      
                                      if($val->primary_contact) echo ' - Primary';
                                      $i++;
                                     }	
                                    }
                                    ?>
                              </ul>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="form-line">
                                    <input type="text" id="email_additional" name="email_additional" class="form-control" data-toggle="tooltip" title="Additional Email Ids" placeholder="Additional email ids (mail id 1,mail id 2,etc...) [optional] " > 
                                 </div>
                              </div>
                           </div>
                          
                           <div class="col-md-6">
                              <div class="form-group">
                                 <div class="form-line">
                                    <select  id="select_product_request_email_template" class="form-control custom-select" title="Product Request Template" required>
                                       <option value="" selected>Select Template</option>
                                       <?php 
                                          echo $this->Common_model->getOptionList('product_request_email_template'); 
                                             ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12" style="display:none;" id="email_message_block">
                              <div class="form-group">
                                 <div class="form-line">
                                    <textarea id="email_message" name="email_message" class="form-control " title="" data-toggle="tooltip" rows="10" cols="30" placeholder="Message * " ><?php echo $email_message; ?></textarea>
                                    <?php if(!empty($sample[0]->product_sample_request_file)){ ?>
										<a href="<?php echo base_url().$sample[0]->product_sample_request_file; ?>" target="_blank">view attachment</a>
									<?php } ?>									
                                 </div>
                              </div>
                           </div>
                         <!--  <div class="col-md-12">
							<div class="form-group row">
							   <div class="col-md-12">
								  <textarea class="form-control"  name="special_instruction"  Placeholder="Special Instruction"><?php //if(isset($sample[0]->special_instruction)) echo $sample[0]->special_instruction ;?></textarea>
								  
								  
							   </div>
							</div>
						 </div>-->
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!--<h4><b>Attach Documents</b><?php //echo $sample_request[0]->product_sample_request_file; ?></h4>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <div class="col-md-6"><input type="text" class="form-control" name="product_doc_title[]" placeholder="Document Name"></div>
                                 <div class="col-md-6">
                                    <input type="file" name="product_doc[]" class="form-control file_size_1 pdf_file">
                                    <small class="file_upload_type_hint">Only PDF or pdf file format & less than 1MB</small>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <div class="col-md-6"><input type="text" class="form-control" name="product_doc_title[]" placeholder="Document Name"></div>
                                 <div class="col-md-6">
                                    <input type="file" name="product_doc[]" class="form-control file_size_1 pdf_file">
                                    <small class="file_upload_type_hint">Only PDF or pdf file format & less than 1MB</small>
                                 </div>
                              </div>
                           </div>
                        </div>-->
                     </div>
                  
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-right">
					  <button class="btn btn-primary" type="submit" value="save" id="form">Send Mail To Supplier</button>
                     <a href="<?php echo site_url('product_sample_request'); ?>" class="btn btn-danger">Cancel</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('script_product_request.php'); ?>
