<?php 
   $supplier_email_ids = array();
   if(isset($supplier) && !empty($supplier)){
      if(isset($supplier[0]->contact_email_1) && !empty($supplier[0]->contact_email_1)){
         $supplier_email_ids[] = $supplier[0]->contact_email_1;
      }
      if(isset($supplier[0]->contact_email_2) && !empty($supplier[0]->contact_email_2)){
         $supplier_email_ids[] = $supplier[0]->contact_email_2;
      }
   }
?>
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
               <h4 class="m-b-0 text-white">Purchase Order To <b><?php echo $sample[0]->supplier_name; ?></b></h4>
            </div>
            <div class="card-body">
               <h4 class="card-title"></h4>
               <form method="POST" enctype="multipart/form-data" action="<?php site_url('policy/policy_claim'); ?>">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="email_response"></div>
                        <h4><b>Email Details</b></h4>
                        <div class="row">
                           <div class="col-md-12">
                              <input type="hidden" id="sample_id" value="<?php echo $sample_request_id; ?>" />
                               <input type="hidden"  name="email_subject"  value="<?php echo $subject; ?>">
                              <ul style="padding:0px;list-style-type:none;">
                                 <?php 
                                    $i = 1;
                                    if(isset($supplier_email_ids) && !empty($supplier_email_ids)){			  
                                       foreach($supplier_email_ids as $key=> $val){				
                                          echo '<li><input type="checkbox" class="" name="supplier_email" value="'.$val.'" id="email_'.$i.'" ><label for="email_'.$i.'">'.$val.'</label></li>';
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
                          
                          <!--  <div class="col-md-6">
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
                           </div> -->
                           <div class="col-md-12" style="display:block;" id="email_message_block">
                              <div class="form-group">
                                 <div class="form-line">
                                    <textarea id="email_message" name="email_message" class="form-control " title="" data-toggle="tooltip" rows="20" cols="30" placeholder="Message * " ><?php echo $email_message; ?></textarea> 
                                    <?php if(!empty($sample[0]->purchase_order_file)){ ?>
										<a href="<?php echo base_url().$sample[0]->purchase_order_file; ?>" target="_blank">view attachment</a>
									<?php } ?>									
                                 </div>
                              </div>
                           </div>
                          <!-- <div class="col-md-12">
							<div class="form-group row">
							   <div class="col-md-12">
								  <textarea class="form-control"  name="special_instruction"  Placeholder="Special Instruction"><?php //if(isset($sample_request[0]->special_instruction)) echo $sample_request[0]->special_instruction ;?></textarea>
							   </div>
							</div>
						 </div>-->
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-right">
                     <input type="submit" value="Send Email" class="btn btn-success">
                     <a href="<?php echo site_url('purchase_order'); ?>" class="btn btn-danger">Cancel</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('script_product_request.php'); ?>
