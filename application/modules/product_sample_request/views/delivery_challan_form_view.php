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
               <h4 class="m-b-0 text-white">Delivery Challan To <b><?php echo $sample[0]->client_name; ?></b></h4>
            </div>
            <div class="card-body">
               <h4 class="card-title"></h4>
               <form method="POST" enctype="multipart/form-data" action="<?php site_url('policy/generate_dc'); ?>" autocomplete="off" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').innerHTML='Please wait...';">
                <input type="hidden" name="email_subject" value="<?php echo $subject; ?>"> 
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div style="height:200px;overflow-y:scroll">
							 <table id="product_particulars_list" class="table color-table muted-table">
								<thead>
									<tr>
										<th align="center" width="5%">S.No</th>
										<th align="left" width="50%">Product</th>
										<th align="center" width="10%">Req Qty</th>
										<th align="center" width="10%">Delivered Qty</th>
                              <th align="center" width="15%">Delivery Qty</th>
										<!--<th align="center" width="10%">Damaged Qty</th>-->
									</tr>
								</thead>
								<tbody>
									<?php 
										$i = 1;
										if(isset($product_sample_request_particulars) && !empty($product_sample_request_particulars)){
										foreach($product_sample_request_particulars as $key => $val){
										 ?>
										<tr id='<?php echo $i; ?>'>
											<td align="center"><?php echo $i; ?></td>
											<td><?php echo $val->product_name.'<br>'.$val->product_quality_name.' - '.$val->product_quality_size_name.' '.$val->product_variety_name; ?>
											<input type="hidden" name="tbl_delivery_challan_particulars[<?php echo $i; ?>][ref_product_id]" value="<?php echo $val->ref_product_id; ?>" >
											<input type="hidden" name="tbl_delivery_challan_particulars[<?php echo $i; ?>][ref_product_quality_id]" value="<?php echo $val->ref_product_quality_id; ?>" >
											<input type="hidden" name="tbl_delivery_challan_particulars[<?php echo $i; ?>][ref_product_quality_size_id]" value="<?php echo $val->ref_product_quality_size_id; ?>" >
											<input type="hidden" name="tbl_delivery_challan_particulars[<?php echo $i; ?>][ref_product_variety_id]" value="<?php echo $val->ref_product_variety_id; ?>" >
											
											</td>
											
                                 <td align="center"><?php echo $val->qty; ?></td>
                                 <td align="center"><?php echo $val->delivered_qty; ?></td>
											<td align="center">
												<input type="text" name="tbl_delivery_challan_particulars[<?php echo $i; ?>][qty]"  class="total form-control" id="total_1" size="5" style="width:80px;" onkeypress="return isNumber(event)" required>
                                    <input type="hidden" value="<?php echo $val->qty - $val->delivered_qty; ?>">
											</td>		
											<!--<td>
												<input type="text" name="tbl_product_sample_request_particulars[<?php //echo $val->product_sample_request_particulars_id; ?>][damaged_qty]"  class="total form-control" id="total_1" size="5" style="width:80px;" onkeypress="return isNumber(event)">
											</td>-->
										</tr>
										<?php $i++; } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>  
						<div class="col-md-12">
							<div class="form-group row">
							   <div class="col-md-12">
								   <label>Instruction </label>
								  <textarea class="form-control"  name="delivery_challan_details"  Placeholder="Special Instruction" rows="4">As per the discussions our Mr.K.Sundharalingam and Undersigned had with you,We are sending herewith the following  Samples for your Kind <?php echo $sample[0]->sample_request_category_name; ?> Purpose.</textarea>
							   </div>
							</div>
						 </div>
						 
				     </div>		 
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="email_response"></div>
                        <div class="row">
      							<div class="col-md-12">
      								<div class="form-group row">
      								   <div class="col-md-8">
      									  <input type="text" name="delivery_challan_date" class="datepicker form-control" placeholder="DC Date" required> 
      								   </div>
      								</div>
      							 </div>
      							<div class="col-md-12">
      								<div class="form-group row">
      								   <div class="col-md-8">
      									  <input type="text" name="delivery_challan_code" class="form-control" placeholder="DC No" required> 
      								   </div>
      								</div>
      							 </div>

                            <h4>Customer DC Details</h4>
                            <div class="col-md-12">
                              <div class="form-group row">
                                 <div class="col-md-8">
                                   <input type="text" name="customer_delivery_challan_date" class="datepicker form-control" placeholder="DC Date" required> 
                                 </div>
                              </div>
                            </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <div class="col-md-8">
                                   <input type="text" name="customer_delivery_challan_code" class="form-control" placeholder="DC No" required> 
                                 </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row">
                                 <div class="col-md-8">
                                    <select name="customer_despatch_mode_id" id="select_delivery_point" class="form-control" required>
                                       <option value="" >Select Mode</option>
                                       <?php echo $this->Common_model->getOptionList('despatch_mode',''); ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           
                            <div class="col-md-12">
                              <div class="form-group row">
                                 <div class="col-md-8">
                                    <select name="customer_delivery_point_id" id="select_delivery_point" class="form-control" required>
                                       <option value="" >Select Delivery Point</option>
                                       <?php echo $this->Common_model->getOptionList('delivery_point',''); ?>
                                    </select>
                                 </div>
                              </div>
                           </div>


                         <!--   <div class="col-md-12">
                              <input type="hidden" id="sample_id" value="<?php echo $sample_request_id; ?>" />
                             <ul style="padding:0px;list-style-type:none;">
                                 <?php 
                                    //~ $i = 1;
                                    //~ if(isset($client_email_ids) && !empty($client_email_ids)){			  
                                     //~ foreach($client_email_ids as $key=> $val){				
                                    //~ echo '<li><input type="checkbox" class="" name="supplier_email" value="'.$val->email_id.'" id="email_'.$i.'" >
                                    //~ <label for="email_'.$i.'">'.$val->email_id. ' ( <b>'.$val->contact_person.'</b> )</label>';
                                      //~ 
                                      //~ if($val->primary_contact) echo ' - Primary';
                                      //~ $i++;
                                     //~ }	
                                    //~ }
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
                           
                            

                           <div class="col-md-12">
							<div class="form-group row">
							   <div class="col-md-12">
								   <label>Instruction 2</label>
								  <textarea class="form-control"  name="delivery_challan_details_1"  Placeholder="Special Instruction" rows="2">Kindly acknowledge the receipt and revert your feedback results.&#10;Thanking you and assuring you of our best services always.</textarea>
							   </div>
							</div>
						 </div>
-->
						 <!--<div class="col-md-6">
                              <div class="form-group">
                                 <div class="form-line">
                                    <select  id="select_product_request_email_template" class="form-control custom-select" title="Product Request Template">
                                       <option value="" selected>Select Template</option>
                                       <?php //echo $this->Common_model->getOptionList('product_request_email_template'); ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12" style="display:none;" id="email_message_block">
                              <div class="form-group">
                                 <div class="form-line">
                                    <textarea id="email_message" name="email_message" class="form-control " title="" data-toggle="tooltip" rows="10" cols="30" placeholder="Message * " ><?php //echo $email_message; ?></textarea>									
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
					 <button class="btn btn-primary" type="submit" value="save" id="form">Save</button><a href="<?php echo site_url('product_sample_request'); ?>" class="btn btn-danger">Cancel</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('script_product_request.php'); ?>
