<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <?php if(isset($invoice)){?>
               <h4 class="m-b-0 text-white">Edit Invoice</h4>
               <?php } else { ?>
               <h4 class="m-b-0 text-white">Add New Invoice</h4>
               <?php }?>
            </div>
            <div class="card-body">
               <form id="sub_patients" action="<?php echo $action; ?>" method="post" autocomplete="off" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').innerHTML='Creating Invoice Please wait...';">
               	<input type="hidden" name="ref_patient_visit_id" value="<?= @$invoice[0]->ref_patient_visit_id ?>">
               	<input type="hidden" name="ref_customer_order_id" value="<?= @$invoice[0]->ref_customer_order_id ?>">
                  <div class="row">
					
					<div class="col-md-4">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Branch</label>
                           <div class="col-md-8">
                            <select name="ref_branch_id" id="ref_branch_id" class="form-control">
							<option value="" selected disabled>Select</option>
							<?php echo $this->Common_model->getOptionList('branch',@$invoice[0]->ref_branch_id); ?>
							</select>
                           </div>
                        </div>
                    </div>
					
                     <div class="col-md-4">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Invoice Date</label>
                           <div class="col-md-8">
                              <input type="text" name="invoice_date" class="datepicker form-control" placeholder="Date" value="<?php if(isset($invoice[0]->invoice_date)){echo $this->Common_model->getDateFormat($invoice[0]->invoice_date) ;}else{ echo date('d-m-Y'); }?>"> 
                           </div>
                        </div>
                     </div>
                    
                    <div class="col-md-4">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Patient</label>
                           <div class="col-md-8">
                              <select name="ref_patient_id" id="select_patient" class="form-control custom-select" style="width:82%;float:left;">
                                 <option value="" disabled selected>Select Patient</option>
                                 <?php 
                                    if(isset($invoice[0]->ref_patient_id)){
										echo $this->Common_model->getOptionList('patient',$invoice[0]->ref_patient_id); 
                                    }else{
										echo $this->Common_model->getOptionList('patient'); 
                                    }
                                    ?>
                              </select> 
                              <span class="btn btn-info" data-toggle="modal" data-target="#popup_add_patient" style="margin-left:9px;" title="Add New Patient"><i class="fa fa-plus"></i></span>
                           </div>
                        </div>
                     </div>

                      <div class="col-md-4">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Customer</label>
                           <div class="col-md-8">
                              <select name="ref_customer_id" id="select_customer" class="form-control custom-select" style="width:82%;float:left;">
                                 <option value="" disabled selected>Select Customer</option>
                                 <?php 
                                    if(isset($invoice[0]->ref_customer_id)){
										echo $this->Common_model->getOptionList('customer',$invoice[0]->ref_customer_id); 
                                    }else{
										echo $this->Common_model->getOptionList('customer'); 
                                    }
                                    ?>
                              </select> 
                              <span class="btn btn-info" data-toggle="modal" data-target="#popup_add_customer" style="margin-left:9px;" title="Add New Customer"><i class="fa fa-plus"></i></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                             <div class="form-group row">
                                <label class="control-label text-right col-md-4">Doctor</label>
                                <div class="col-md-8">
                                   <select name="ref_employee_id" class="form-control custom-select">
                                      <option value="">Select Doctor</option>
                                      <?php
                                      echo $this->Common_model->getOptionList('employee', $invoice[0]->ref_employee_id, 'ref_employee_type_id', '1');
                                      ?>
                                   </select>
                                </div>
                             </div>
                          </div>
                     <div class="col-md-4">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Payment Type</label>
                           <div class="col-md-8">
                              <select name="ref_payment_type_id"  class="form-control custom-select" required>
                                
                                 <?php 
                                    if(isset($invoice[0]->ref_payment_type_id)){
										echo $this->Common_model->getOptionList('payment_type',@$invoice[0]->ref_payment_type_id); 
                                    }else{
										echo $this->Common_model->getOptionList('payment_type','1'); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
					 
					 
					 <div class="col-md-4">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Home Delivery </label>
                           <div class="col-md-8">
							<?php 
							if($invoice[0]->home_delivery == 1){
								$checked = 'checked';
							} else {
								$checked = '';
							}
							?>
                              <input type="checkbox" name="home_delivery" value="1" id="home_delivery"<?php echo $checked; ?>><label for="home_delivery">click if Yes</label>
                           </div>
                        </div>
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
								<th align="left" width="13%">Product</th>
								<th align="left" width="6%">SKU</th>
								<th align="left" width="10%">Batch</th>
								<th align="left" width="5%">Avl Qty</th>
								<th align="right" width="8%">Price</th>
								<th align="left" width="6%">Qty</th>
								<th align="right" width="7%">Disc Type</th>
								<th align="right" width="7%">Disc Value</th>
								<th align="right" width="7%">Disc Total</th>
								<th align="right" width="3%">GST(%)</th>
								<th align="right" width="8%">Sub Total</th>
								<th align="right" width="8%">Gst Total</th>
								<th align="right" width="8%">Total</th>
								<th align="right" width="5%"></th>
							</tr>
						</thead>
						<tbody id="product_body">
							<?php 
								$i = 1;
								//debug($invoice_particulars); 
								if(isset($invoice_particulars) && !empty($invoice_particulars)){
									foreach($invoice_particulars as $key => $val){ 	
										$edit_prod_qty = $val->qty;
										if(isset($doc_pres) && $doc_pres == '1')
											$edit_prod_qty = 0;

										$res_product = $this->Common_model->getDetails('product','product_id',$val->ref_product_id);
										$sku = '';
										if(isset($res_product) && !empty($res_product)){
											$sku = $res_product[0]->sku;
										}

										$res_product_batch = $this->Common_model->getDetails('product_batch','product_batch_id',$val->ref_product_batch_id);
										$quantity = '0';

										if(isset($res_product_batch) && !empty($res_product_batch)){
											$quantity = $res_product_batch[0]->avail_quantity;
										}
										
										$res_product_batch_list = $this->Common_model->getDetails('product_batch','ref_product_id',$val->ref_product_id);
										?>
										<tr id="<?php echo $i; ?>">
											<td align="center" ><?php echo $i; ?></td>
											<td align="left"><a href="<?= site_url('product/edit/'.$val->ref_product_id)?>" target="_blank"><?php echo $val->product_name; ?> <i class="fa fa-search"></i></a>
											<input type="hidden" name="tbl_invoice_particulars[<?php echo $i; ?>][ref_product_id]" value="<?php echo $val->ref_product_id; ?>" >
											</td>
											<td align="left" ><?= $sku?></td>
											<td align="right" >
												<?php 
												$readonly = '';
												if(isset($invoice[0]->invoice_id)) {
													$readonly = 'disabled=true';
													echo '<input type="hidden" name="tbl_invoice_particulars['.$i.'][ref_product_batch_id]" value="'.$val->ref_product_batch_id.'">';
												} ?>

												<select class="form-control row_product_batch" name="tbl_invoice_particulars[<?php echo $i; ?>][ref_product_batch_id]" id="row_product_batch_<?php echo $i; ?>" required <?= $readonly ?>>
													<!-- <option>Batch</option> -->
												<?php if(isset($res_product_batch_list) && !empty($res_product_batch_list)){
													foreach ($res_product_batch_list as $key => $v) {
														if($v->avail_quantity + $edit_prod_qty > 0){
															$selected = '';
															if($val->ref_product_batch_id == $v->product_batch_id){
																$selected = 'selected';
																$p_price = $val->price;
															}else{
															    $p_price = $v->price;
															}

															echo '<option value="'.$v->product_batch_id.'" data-avail_quantity="'.$v->avail_quantity.'" '.$selected.' data-batch_price="'.$p_price.'">'.$v->product_batch_name.'</option>';
														}
													}
												}
												?>
											</select>
											</td>

											<td align="left" >
												<span id="row_avail_quantity_text_<?php echo $i; ?>"><?= $quantity ?></span> 
												<?php if(isset($invoice[0]->patient_visit_id) && $invoice[0]->patient_visit_id) { ?>
													<input type="hidden" id="row_avail_quantity_<?php echo $i; ?>" value="<?php echo $quantity; ?>"> 
													<input type="hidden" id="row_ordered_qty_<?php echo $i; ?>" value="0">
												<?php }else{ ?>
													<input type="hidden" id="row_avail_quantity_<?php echo $i; ?>" value="<?php echo $quantity + $val->qty; ?>">
													<input type="hidden" id="row_ordered_qty_<?php echo $i; ?>" value="<?php echo $val->qty; ?>">
												<?php } ?>
												
											

											<input type="hidden" name="tbl_invoice_particulars[<?php echo $i; ?>][org_qty]" value="<?php echo $val->qty; ?>">
											</td>
											
											<td align="right" ><input type="text" class="base_price form-control text-right" id="price_<?php echo $i; ?>" name="tbl_invoice_particulars[<?php echo $i; ?>][price]" value="<?php echo $val->price; ?>"></td>
											<td align="left" ><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_<?php echo $i; ?>" value="<?= $val->qty ?>" ></td>
											<td align="right" >
												<select class="form-control" name="tbl_invoice_particulars[<?php echo $i; ?>][ref_discount_type_id]" id="row_discount_type_<?php echo $i; ?>" style="width:70px;">
												<?php 
													echo $this->Common_model->getOptionList('discount_type',$val->ref_discount_type_id);
													
												?>
											</select>
											</td>
											<td align="right" ><input type="text" class="row_discount_value form-control text-right" id="row_discount_value_<?php echo $i; ?>" name="tbl_invoice_particulars[<?php echo $i; ?>][discount_value]" value="<?php echo $val->discount_value; ?>"></td>

											<td align="right" ><input type="text" class="row_discount_total form-control text-right" id="row_discount_total_<?php echo $i; ?>" name="tbl_invoice_particulars[<?php echo $i; ?>][discount_total]" value="<?php echo $val->discount_total; ?>"></td>

											<td align="right"><input type="hidden" name="tbl_invoice_particulars[<?php echo $i; ?>][gst_perc]" class="form-control row_gst_perc" id="gst_perc_<?php echo $i; ?>" onkeypress="return isNumber(event)" value="<?= $val->gst_perc ?>"><?= $val->gst_perc ?></td>

											

											<td align="left"><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][sub_total]" class="form-control text-right row_total" id="sub_total_<?php echo $i; ?>" value="<?= $val->sub_total ?>"></td>
											<td align="left"><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][gst]" class="form-control text-right row_gst" id="row_gst_<?php echo $i; ?>" value="<?= $val->gst ?>"></td>

											<td align="left"><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][total]" class="form-control text-right total" id="total_<?php echo $i; ?>" value="<?= $val->total ?>"></td>
											
											<td align="right"><a class="remove_product btn btn-danger" id="<?= $val->invoice_particulars_id ?>"><i class="fa fa-remove "></i></a></td>
										</tr>
										
							<?php	
								$i++;		
									}
								}else{
									echo '<tr><td align="center" colspan="11">Please select the patient...</td></tr>';
								}
							?>						
						</tbody>
						
						<tr>
							<td></td>
							<td colspan="12" align="right"><b>Sub Total</b></td>
							<td align="right"><span id="sub_total"><?php echo $invoice[0]->sub_total; ?></span><input type="hidden" id="sub_total_hidden" value="<?php echo $invoice[0]->sub_total; ?>" name="sub_total"></td>
							<td></td>
						</tr>
						<tr id="discount_row">
							<td></td>
							<td colspan="9"></td>
							<td align="right"><select class="form-control" name="ref_discount_type_id" id="discount_type" style="width:70px;">
								<?php 
									if(isset($invoice[0]->ref_discount_type_id)){
										echo $this->Common_model->getOptionList('discount_type',$invoice[0]->ref_discount_type_id);
									}else{
										echo $this->Common_model->getOptionList('discount_type','');
									}
								?>
							</select>
							</td>
							<td align="right"><input type="text" class="form-control" style="width:70px;" id="discount_value" value="<?php if($invoice[0]->discount_value) echo $invoice[0]->discount_value; else echo '0'; ?>" name="discount_value" <?php if(!$invoice[0]->discount_value) echo 'readonly'; ?>></td>
							<td  align="right"><b>Discount</b></td>
							<td align="right">
								<span id="discount_total"><?php echo $invoice[0]->discount_total; ?></span>
								<input type="hidden" id="discount_total_hidden" value="<?php if($invoice[0]->discount_value) echo $invoice[0]->discount_total; else echo '0' ?>" name="discount_total" >
							</td>
							<td></td>
						</tr>
						<!-- <tr>
							<td colspan="9" align="right"><b>Additional / Extra Charges</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="extra_total_hidden" value="<?php if(isset($invoice[0]->extra_total)) echo $invoice[0]->extra_total; else echo '0'; ?>" name="extra_total" onkeypress="return isNumber(event)"></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="9" align="right"><b>P&F Charges</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="p_and_f_total_hidden" value="<?php if(isset($invoice[0]->p_and_f_total)) echo $invoice[0]->p_and_f_total; else echo '0'; ?>" name="p_and_f_total" onkeypress="return isNumber(event)"></td>
							<td></td>
						</tr> -->
						<!-- <tr>
							<td colspan="9" align="right"><b>GST</b></td>
							<td align="right"><span id="gst_total"><?php echo $invoice[0]->gst_total; ?></span><input type="hidden" id="gst_total_hidden" value="<?php echo $invoice[0]->gst_total; ?>" name="gst_total"></td>
							<td></td>
						</tr> -->
						<!-- <tr>
							<td></td>
							<td colspan="11" align="right"><b>Round of</b></td>
							<td colspan="1" align="right"><select class="form-control" name="round_off_type" id="round_off_type"><option value="-" <?php if($invoice[0]->round_off_type == '-') echo 'selected'; ?>>-</option><option value="+" <?php if($invoice[0]->round_off_type == '+') echo 'selected'; ?>>+</option></select></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="round_off" value="<?php if(isset($invoice[0]->round_off)) echo $invoice[0]->round_off; else echo '0'; ?>" name="round_off" readonly></td>
							<td></td>
						</tr>  -->
						<tr>
							<td colspan="13" align="right"><b>Consulting Fees</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="p_and_f_total_hidden" value="<?php if(isset($invoice[0]->p_and_f_total)) echo $invoice[0]->p_and_f_total; else echo '0'; ?>" name="p_and_f_total" onkeypress="return isNumber(event)"></td>
							<td></td>
						</tr>

						<tr>
							<td></td>
							<td colspan="12" align="right"><b>Total</b></td>
							<td align="right"><span id="grand_total"><?php echo $invoice[0]->grand_total; ?></span><input type="hidden" id="grand_total_hidden" value="<?php echo $invoice[0]->grand_total; ?>" name="grand_total"></td>
							<td></td>
						</tr>
					</table>
				</div> 
				</div> 
				
                <div class="clearfix"></div>
			<!-- 	<div class="col-md-8">
					<div class="form-group row">
					   <label class="control-label text-right col-md-2">Terms and Conditions</label>
					   <div class="col-md-8">
						  <textarea class="form-control"  name="terms_and_conditions"  Placeholder="Details" rows="6">Sample Terms and condition</textarea>
					   </div>
					</div>
				 </div> -->
				 
				 
				 
                       
            </div>
            <div class="text-right" style="margin-right:15px;margin-bottom:15px;">
            <button class="btn btn-primary" type="submit" value="save" id="form">Save</button>
            <a href="<?php echo site_url('sales_return'); ?>" class="btn btn-danger">Cancel</a>
            </div>
         </div>
         </form>
      </div>
   </div>
</div>
</div>	
</div>	
<?php include('script_invoice.php'); ?>
<?php include(APPPATH.'views/common/popup_patient_form.php'); ?> 
<?php include(APPPATH.'views/common/popup_customer_form.php'); ?> 
<script>
	$(document).ready(function(){
		$('.row_product_batch').trigger('change');
		$('#select_patient').trigger('change');
		$('.qty').trigger('keyup');
	});
</script>
