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
               <?php if(isset($proforma_invoice)){ ?>
               <h4 class="m-b-0 text-white">Edit Proforma Invoice</h4>
               <?php } else { ?>
               <h4 class="m-b-0 text-white">New Proforma Invoice</h4>
               <?php }?>
            </div>
            <div class="card-body">
               <form id="sub_suppliers" action="<?php echo $action;  ?>" method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').innerHTML='Please wait...';">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-5">Proforma Invoice Date</label>
                           <div class="col-md-7">
                              <input type="text" name="proforma_invoice_date" class="datepicker form-control" placeholder="Date" value="<?php if(isset($proforma_invoice[0]->proforma_invoice_date)) echo $this->Common_model->getDateFormat($proforma_invoice[0]->proforma_invoice_date); ?>" required> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-5">Proforma Reference</label>
                           <div class="col-md-7">
                              <input type="text" name="proforma_invoice_reference" class="form-control" placeholder="Reference" value="<?php if(isset($proforma_invoice[0]->proforma_invoice_reference)) echo $proforma_invoice[0]->proforma_invoice_reference; ?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-5">Client</label>
                           <div class="col-md-7">
                              <select name="ref_client_id" id="select_client" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Client</option>
                                 <?php 
                                    if(isset($proforma_invoice[0]->ref_client_id)){
                                    echo $this->Common_model->getOptionList('client',$proforma_invoice[0]->ref_client_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('client'); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-5">Supplier</label>
                           <div class="col-md-7">
                              <select name="ref_supplier_id" id="select_supplier" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Supplier</option>
                                 <?php 
                                    if(isset($proforma_invoice[0]->ref_supplier_id)){
                                    echo $this->Common_model->getOptionList('supplier',$proforma_invoice[0]->ref_supplier_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('supplier'); 
                                    }
                                    ?>
                              </select>
                              <input type="hidden" id="advanced_product_field" value="1">
                           </div>
                        </div>
                     </div>
                     
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-5">Display Discount ?</label>
                           <div class="col-md-7">
                              <input type="checkbox" name="display_discount_to_customer" value="1" id="display_discount_to_customer" <?php if($proforma_invoice[0]->display_discount_to_customer) echo 'checked'; ?>><label for="display_discount_to_customer">Click if Yes</label>
                                 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-5">Company Proforma ?</label>
                           <div class="col-md-7">
                              <input type="checkbox" name="company_proforma" value="1" id="company_proforma" class="company_proforma" <?php if($proforma_invoice[0]->company_proforma) echo 'checked'; ?>><label for="company_proforma">Click if Yes</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-5">Company Proforma Copy</label>
                           <div class="col-md-7">
                              <input type="file" name="company_proforma_file" value="1" id="company_proforma_file" class="pdf_file file_size_1" <?php if(!$proforma_invoice[0]->company_proforma) echo 'disabled'; ?> >
                              <br><small style="color:red;">File size below 1MB and .PDF,.pdf only</small>
                              <br><?php if(!empty($proforma_invoice[0]->company_proforma_file)){ ?>
								  <a href="<?php echo base_url().$proforma_invoice[0]->company_proforma_file; ?>" target="_blank">view proforma copy</a>
								  <?php } ?>
                           </div>
                        </div>
                     </div>

		     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-5">Note Book</label>
                           <div class="col-md-7">
                               <textarea class="form-control"  name="notebook"  Placeholder="Notebook" rows="2"><?php if($proforma_invoice[0]->notebook) echo $proforma_invoice[0]->notebook; ?></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6"></div>
					<div class="col-md-12">
						<label>Additional Details</label>
<!--
						  <textarea class="form-control"  name="proforma_invoice_additional_details"  Placeholder="Details" rows="2"><?php if($proforma_invoice[0]->proforma_invoice_additional_details) echo $proforma_invoice[0]->proforma_invoice_additional_details; ?></textarea>
-->
						  <textarea class="ckeditor" name="proforma_invoice_additional_details"><?php if($proforma_invoice[0]->proforma_invoice_additional_details) echo $proforma_invoice[0]->proforma_invoice_additional_details; ?></textarea>
							
					  </div>
					   <div class="clearfix"></div>
                     <?php include('inc_product_selection_block.php'); ?>
                     <div class="clearfix"></div>
                     <div class="col-md-12">
                     <h4>Product Details</h4>
                     </div>
                  <div class="col-md-12">
                  <div style="min-height:150px;">
					 <table id="product_particulars_list" class="table color-bordered-table muted-bordered-table">
						<thead>
							<tr>
								<th align="center" width="5%">S.No</th>
								<th align="left" width="27%">Product</th>
								<th align="left" width="7%">Base PL</th>
								<th align="right" width="8%">Price</th>
								<th align="left" width="6%">Qty</th>
								<!-- <th align="right" width="8%">Base Price</th> -->
								<th align="left" width="10%">Schedule</th>
								<th align="left" width="7%">Disc %</th>
								<th align="left" width="7%">AS %</th>
								<th align="right" width="8%">Total</th>
								<th align="right" width="3%"></th>
							</tr>
						</thead>
						<tbody id="product_body">
							<?php 
								$i = 1;
								if(isset($proforma_invoice_particulars) && !empty($proforma_invoice_particulars)){
									foreach($proforma_invoice_particulars as $key => $val){ 	
										$res_product = $this->Common_model->getDetails('product','product_id',$val->ref_product_id);
										$quality_size = '';
										if(isset($res_product) && !empty($res_product)){
											$quality_size = $res_product[0]->product_quality_name.' - '.$res_product[0]->product_quality_size_name;
										}			
							?>
										<tr id="<?php echo $i; ?>">
											<td align="center" ><?php echo $i; ?></td>
											<td align="left"><?php echo $val->product_name.'<br>'.$val->product_quality_name.' - '.$val->product_quality_size_name.' '.$val->product_variety_name; ?>
											<input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][ref_product_id]" value="<?php echo $val->ref_product_id; ?>" >
											<input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][ref_product_quality_id]" value="<?php echo $val->ref_product_quality_id; ?>" >
											<input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][ref_product_quality_size_id]" value="<?php echo $val->ref_product_quality_size_id; ?>" >
											<input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][ref_product_variety_id]" value="<?php echo $val->ref_product_variety_id; ?>" >
											</td>
											<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][base_pl]" class="form-control" value="<?php echo $val->base_pl; ?>"></td>
											<td align="right" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][price]" class="form-control text-right price" id="price_<?php echo $i; ?>" value="<?php echo (float)$val->price; ?>"></td>
											<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_<?php echo $i; ?>" value="<?php echo $val->qty; ?>"><input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][base_price]" class="form-control text-right base_price" id="base_price_<?php echo $i; ?>" value="<?php echo $val->base_price; ?>"></td>
											
											<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][schedule_date]" class="form-control datepicker" value="<?php echo $this->Common_model->getDateFormat($val->schedule_date); ?>"></td>
											<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][disc_perc]" class="form-control disc_perc" id="disc_perc_<?php echo $i; ?>" onkeypress="return isNumber(event)" value="<?php echo $val->disc_perc; ?>"><input type="hidden" class="disc_tot" id="disc_tot_<?php echo $i; ?>"></td>
											<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][as_perc]" class="form-control as_perc" id="as_perc_<?php echo $i; ?>" onkeypress="return isNumber(event)" value="<?php echo $val->as_perc; ?>"><input type="hidden" class="disc_tot" id="as_tot_<?php echo $i; ?>"></td>
											<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][total]" class="form-control text-right total" id="total_<?php echo $i; ?>" value="<?php echo $val->total; ?>"></td>
											<td align="right"><a class="remove_product_particulars btn btn-danger"><i class="fa fa-remove remove_product"></i></a></td>
										</tr>
										
							<?php	
								$i++;		
									}
								}else{
									echo '<tr><td align="center" colspan="10">Please select the supplier...</td></tr>';
								}
							?>						
						</tbody>
						
						<tr>
							<td colspan="9" align="right"><b>Sub Total</b></td>
							<td align="right"><span id="sub_total"><?php echo $proforma_invoice[0]->sub_total; ?></span><input type="hidden" id="sub_total_hidden" value="<?php echo $proforma_invoice[0]->sub_total; ?>" name="sub_total"></td>
						</tr>
						<tr>
							<td colspan="6"></td>
							<td align="right"><select class="form-control" name="ref_discount_type_id" id="discount_type" style="width:70px;">
								<?php 
									if(isset($proforma_invoice[0]->ref_discount_type_id)){
										echo $this->Common_model->getOptionList('discount_type',$proforma_invoice[0]->ref_discount_type_id);
									}else{
										echo $this->Common_model->getOptionList('discount_type','');
									}
								?>
							</td>
							<td align="right"><input type="text" class="form-control" style="width:70px;" id="discount_value" value="<?php if($proforma_invoice[0]->discount_value) echo $proforma_invoice[0]->discount_value; else echo '0'; ?>" name="discount_value"></td>
							<td  align="right"><b>Discount</b></td>
							<td align="right"><span id="discount_total"><?php echo $proforma_invoice[0]->discount_total; ?></span><input type="hidden" id="discount_total_hidden" value="<?php if($proforma_invoice[0]->discount_total) echo $proforma_invoice[0]->discount_total; else echo '0'; ?>" name="discount_total"></td>
						</tr>
						
						
						<tr>
							<td colspan="9" align="right"><b>Additional / Extra Charges</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="extra_total_hidden" value="<?php if(isset($proforma_invoice[0]->extra_total)) echo $proforma_invoice[0]->extra_total; else echo '0'; ?>" name="extra_total" onkeypress="return isNumber(event)"></td>
						</tr>
						<!-- <tr>
							<td colspan="9" align="right"><b>P&F Charges</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="p_and_f_total_hidden" value="<?php if(isset($proforma_invoice[0]->p_and_f_total)) echo $proforma_invoice[0]->p_and_f_total; else echo '0'; ?>" name="p_and_f_total" ></td>
						</tr> -->

                  <tr>
                     <td colspan="6"></td>
                     <td align="right"><select class="form-control" name="p_and_f_type_id" id="p_and_f_type" style="width:70px;">
                        <?php 
                           if(isset($proforma_invoice[0]->p_and_f_type_id)){
                              echo $this->Common_model->getOptionList('discount_type',$proforma_invoice[0]->p_and_f_type_id);
                           }else{
                              echo $this->Common_model->getOptionList('discount_type','');
                           }
                        ?></select>
                     </td>
                     <td align="right"><input type="text" class="form-control" style="width:70px;" id="p_and_f_value" value="<?php if($proforma_invoice[0]->p_and_f_value) echo $proforma_invoice[0]->p_and_f_value; else echo '0'; ?>" name="p_and_f_value"></td>
                     <td  align="right"><b>P&F Charges</b></td>
                     <td align="right"><span id="p_and_f_total"><?php echo $proforma_invoice[0]->p_and_f_total; ?></span><input type="hidden" id="p_and_f_total_hidden" value="<?php if($proforma_invoice[0]->p_and_f_total) echo $proforma_invoice[0]->p_and_f_total; else echo '0'; ?>" name="p_and_f_total"></td>
                  </tr>

						<tr>
							<td colspan="9" align="right"><b>GST</b>
                        <select class="form-control" name="ref_gst_type_id" id="gst_type" style="width:70px;">
                        <?php 
                           if(isset($proforma_invoice[0]->ref_gst_type_id)){
                              echo $this->Common_model->getOptionList('gst_type',$proforma_invoice[0]->ref_gst_type_id);
                           }else{
                              echo $this->Common_model->getOptionList('gst_type','');
                           }
                        ?></select>
                     </td>
							<td align="right"><span id="gst_total"><?php echo $proforma_invoice[0]->gst_total; ?></span><input type="hidden" id="gst_total_hidden" value="<?php echo $proforma_invoice[0]->gst_total; ?>" name="gst_total"></td>
						</tr>
						<tr>
							<td colspan="8" align="right"><b>Round of</b></td>
							<td colspan="1" align="right"><select class="form-control" name="round_off_type" id="round_off_type"><option value="-" <?php if($proforma_invoice[0]->round_off_type == '-') echo 'selected'; ?>>-</option><option value="+" <?php if($proforma_invoice[0]->round_off_type == '+') echo 'selected'; ?>>+</option></select></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="round_off" value="<?php if(isset($proforma_invoice[0]->round_off)) echo $proforma_invoice[0]->round_off; else echo '0'; ?>" name="round_off" readonly></td>
						</tr>
						<tr>
							<td colspan="9" align="right"><b>Total</b></td>
							<td align="right"><span id="grand_total"><?php echo $proforma_invoice[0]->grand_total; ?></span><input type="hidden" id="grand_total_hidden" value="<?php echo $proforma_invoice[0]->grand_total; ?>" name="grand_total"></td>
						</tr>
					</table>
				</div> 
				</div> 
				
				<div class="clearfix"></div>
				<div class="col-md-6">
					<div class="col-md-12">
						<label>Terms and Conditions</label>
						  <!--<textarea class="form-control"  name="terms_and_conditions"  Placeholder="Details" rows="6"><?php if($proforma_invoice[0]->terms_and_conditions) echo $proforma_invoice[0]->terms_and_conditions; else echo 'The Price is F.O.R.Salem&#10;Delivery - 1 Week time on receipt of your order&#10;Despatch - Through Roadways&#10;Freight - Extra as applicable&#10;Validity - 30 Days'; ?></textarea>-->
					      <textarea class="ckeditor"  name="terms_and_conditions"  rows="6"><?php if($proforma_invoice[0]->terms_and_conditions) echo $proforma_invoice[0]->terms_and_conditions; else echo 'The Price is F.O.R.Salem&#10;Delivery - 1 Week time on receipt of your order&#10;Despatch - Through Roadways&#10;Freight - Extra as applicable&#10;Validity - 30 Days'; ?></textarea>
					   </div>
					</div>
					
					<div class="col-md-6">
						 <h4>Email Details</h4>
                  <div class="clearfix"></div>
                  <div id="email_details" class="col-md-12">
						Please select the supplier to load email details...
				  </div>
                  <br>
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="form-line">
                           <input type="text" id="email_additional" name="email_additional" class="form-control" data-toggle="tooltip" title="Additional Email Ids" placeholder="Additional email ids (mail id 1,mail id 2,etc...) [optional] " > 
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="form-line">
                           <select  id="select_product_request_email_template" class="form-control custom-select" title="Product Request Template" >
                              <option value="" selected>Select Template</option>
                              <?php  echo $this->Common_model->getOptionList('product_request_email_template'); ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="display:none;" id="email_message_block">
                     <div class="form-group">
                        <div class="form-line">
                           <textarea id="email_message" name="email_message" class="form-control " title="" data-toggle="tooltip" rows="10" cols="30" placeholder="Message * " ><?php echo $email_message; ?></textarea>									
                        </div>
                     </div>
                  </div>
					</div>	
                  </div>
                  
                  <div class="clearfix"></div>
                 
                  <div class="text-right" style="margin-right:15px;margin-bottom:15px;">
                     <button class="btn btn-primary" type="submit" value="save" id="form">Save</button>
                     <a href="<?php echo site_url('product_sample_request/get_proforma_invoice_list'); ?>" class="btn btn-danger">Cancel</a>
                  </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>	
<?php include(APPPATH.'views/common/popup_general_master_form.php'); ?>
<?php include('script_proforma_invoice.php'); ?>
<style>
   /*#cke_1_top,#cke_1_bottom{display:none;}*/
</style>
<script>
	$(document).ready(function(){
		$('#select_client').trigger('change');
		$('#select_supplier').trigger('change');
		});
</script>

