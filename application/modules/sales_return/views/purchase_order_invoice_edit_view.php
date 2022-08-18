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
               <h4 class="m-b-0 text-white">Edit Invoice Details</h4>
            </div>
            <div class="card-body">
               <h4 class="card-title"></h4>
               <form method="POST" enctype="multipart/form-data" action="<?php site_url('invoice/edit_purchase_order_invoice/'.$invoice[0]->invoice_id); ?>">
               <input type="hidden" name="ref_client_id" value="<?php echo $invoice[0]->ref_client_id; ?>">
               <input type="hidden" name="ref_supplier_id" value="<?php echo $invoice[0]->ref_supplier_id; ?>">
               
                  <div class="row">
					  <!--<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Invoice No</label>
								<div class="col-md-8">	
									<?php echo $invoice[0]->invoice_no; ?>
								</div>					  
							</div>					  
						</div>		
						
						 <div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Invoice Date</label>
								<div class="col-md-8">	
									<?php echo $this->Common_model->getDateFormat($invoice[0]->invoice_date); ?>
								</div>					  
							</div>					  
						</div>	-->				  
					   <div class="col-md-6">
						<div class="form-group row">
							<label class="control-label text-right col-md-4">Client</label>
							<div class="col-md-8">
								<b><?php echo $client[0]->client_name; ?></b>
								<?php 
								echo $client[0]->client_address_line1.$client[0]->client_address_line2.'<br>';
								echo $client[0]->district_name.' - '.$client[0]->client_pincode; 
								if(!empty($client[0]->client_gst_no))
								echo '<br>GST No : '.$client[0]->client_gst_no;
								if(!empty($client[0]->client_pan_no))
								echo '<br>PAN No : '.$client[0]->client_pan_no;
								?>
							</div>
						</div>
					</div>
					  <div class="col-md-6">
						<div class="form-group row">
							<label class="control-label text-right col-md-4">Supplier</label>
							<div class="col-md-8">
								<b><?php echo $supplier[0]->supplier_name; ?></b>
								<?php 
									echo '<br>'.$supplier[0]->supplier_address_line1.$supplier[0]->supplier_address_line2.'<br>';
									echo $supplier[0]->district_name.' - '.$supplier[0]->supplier_pincode; 
									if(!empty($supplier[0]->supplier_gst_no))
									echo '<br>GST No : '.$supplier[0]->supplier_gst_no;
									if(!empty($supplier[0]->supplier_pan_no))
									echo '<br>PAN No : '.$supplier[0]->supplier_pan_no;
								?>
							</div>
						</div>
					</div>
					  <div class="col-md-6">
						<div class="form-group row">
							<label class="control-label text-right col-md-4">Invoice Date</label>
							<div class="col-md-8">
								<input type="text" class="form-control datepicker" name="invoice_date" placeholder="Date" value="<?php echo $this->Common_model->getDateFormat($invoice[0]->invoice_date); ?>">
							</div>
						</div>
					</div>
					  <div class="col-md-6">
						<div class="form-group row">
							<label class="control-label text-right col-md-4">Invoice No</label>
							<div class="col-md-8">
								<input type="text" class="form-control" placeholder="Invoice #" name="invoice_no" value="<?php echo $invoice[0]->invoice_no; ?>">
							</div>
						</div>
					</div>
					 <div class="clearfix"></div>
                  <div class="col-md-12">
                  <div style="min-height:150px;">
					 <table id="product_particulars_list" class="table color-bordered-table muted-bordered-table">
						<thead>
							<tr>
								<th align="center" width="5%">S.No</th>
								<th align="left" width="28%">Product</th>
								<th align="left" width="7%">Base PL</th>
								<th align="right" width="7%">Price</th>
								<th align="left" width="7%">Qty</th>
								<th align="right" width="8%">Base Price</th>
								<th align="left" width="10%">schedule_date</th>
								<th align="left" width="7%">Disc %</th>
								<th align="left" width="7%">AS %</th>
								<th align="right" width="8%">Total</th>
							</tr>
						</thead>
						<tbody id="product_body">
							<?php 
								$i = 1;
								if(isset($invoice_particulars) && !empty($invoice_particulars)){
									foreach($invoice_particulars as $key => $val){ 	
										$res_product = $this->Common_model->getDetails('product','product_id',$val->ref_product_id);
										$quality_size = '';
										if(isset($res_product) && !empty($res_product)){
											$quality_size = $res_product[0]->product_quality_name.' - '.$res_product[0]->product_quality_size_name;
										}			
							?>
										<tr id="<?php echo $i; ?>">
											<td align="center" ><?php echo $i; ?></td>
											<td align="left"><?php echo $val->product_name.'<br>'.$val->product_quality_name.' - '.$val->product_quality_size_name.' '.$val->product_variety_name; ?>
											<input type="hidden" name="tbl_invoice_particulars[<?php echo $i; ?>][ref_product_id]" value="<?php echo $val->ref_product_id; ?>" >
											<input type="hidden" name="tbl_invoice_particulars[<?php echo $i; ?>][ref_product_quality_id]" value="<?php echo $val->ref_product_quality_id; ?>" >
											<input type="hidden" name="tbl_invoice_particulars[<?php echo $i; ?>][ref_product_quality_size_id]" value="<?php echo $val->ref_product_quality_size_id; ?>" >
											<input type="hidden" name="tbl_invoice_particulars[<?php echo $i; ?>][ref_product_variety_id]" value="<?php echo $val->product_variety_id; ?>" >
											</td>											
											<td align="left" ><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][base_pl]" class="form-control" value="<?php echo $val->base_pl; ?>"></td>
											<td align="right" ><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][price]" class="form-control text-right price" id="price_<?php echo $i; ?>" value="<?php echo $val->price; ?>"></td>
											<td align="left" ><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_<?php echo $i; ?>" value="<?php echo $val->qty; ?>"></td>
											<td align="left"><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][base_price]" class="form-control text-right base_price" id="base_price_<?php echo $i; ?>" value="<?php echo $val->base_price; ?>"></td>
											<td align="left" ><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][schedule_date]" class="form-control datepicker" value="<?php echo $this->Common_model->getDateFormat($val->schedule_date); ?>"></td>
											<td align="left" ><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][disc_perc]" class="form-control disc_perc" id="disc_perc_<?php echo $i; ?>" onkeypress="return isNumber(event)" value="<?php echo $val->disc_perc; ?>"><input type="hidden" class="disc_tot" id="disc_tot_<?php echo $i; ?>"></td>
											<td align="left" ><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][as_perc]" class="form-control as_perc" id="as_perc_<?php echo $i; ?>" onkeypress="return isNumber(event)" value="<?php echo $val->as_perc; ?>"><input type="hidden" class="disc_tot" id="as_tot_<?php echo $i; ?>"></td>
											<td align="left"><input type="text" name="tbl_invoice_particulars[<?php echo $i; ?>][total]" class="form-control text-right total" id="total_<?php echo $i; ?>" value="<?php echo $val->total; ?>"></td>
										</tr>
										
							<?php	
								$i++;		
									}
								}else{
									echo '<tr><td align="center" colspan="10">Product not available...</td></tr>';
								}
							?>
				
						</tbody>
						<tr>
							<td colspan="9" align="right"><b>Sub Total</b></td>
							<td align="right"><span id="sub_total"><?php echo $invoice[0]->sub_total; ?></span><input type="hidden" id="sub_total_hidden" value="<?php echo $invoice[0]->sub_total; ?>" name="sub_total"></td>
						</tr>
<!--
						<tr>
							<td colspan="9" align="right"><b>Discount</b></td>
							<td align="right"><span id="discount_total"><?php echo $invoice[0]->discount_total; ?></span><input type="hidden" id="discount_total_hidden" value="<?php echo $invoice[0]->discount_total; ?>" name="discount_total"></td>
						</tr>
-->

						<tr>
							<td colspan="6"></td>
							<td align="right"><select class="form-control" name="ref_discount_type_id" id="discount_type" style="width:70px;">
								<?php 
									if(isset($invoice[0]->ref_discount_type_id)){
										echo $this->Common_model->getOptionList('discount_type',$invoice[0]->ref_discount_type_id);
									}else{
										echo $this->Common_model->getOptionList('discount_type','');
									}
								?>
							</td>
							<td align="right"><input type="text" class="form-control" style="width:70px;" id="discount_value" value="<?php if($invoice[0]->discount_value) echo $invoice[0]->discount_value; else echo '0'; ?>" name="discount_value"></td>
							<td  align="right"><b>Discount</b></td>
							<td align="right"><span id="discount_total"><?php echo $invoice[0]->discount_total; ?></span><input type="hidden" id="discount_total_hidden" value="<?php echo $invoice[0]->discount_total; ?>" name="discount_total"></td>
						</tr>
						<tr>
							<td colspan="9" align="right"><b>Additional / Extra Charges</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="extra_total_hidden" value="<?php if(isset($invoice[0]->extra_total)) echo $invoice[0]->extra_total; else echo '0'; ?>" name="extra_total" onkeypress="return isNumber(event)"></td>
						</tr>
						<tr>
							<td colspan="9" align="right"><b>P&F Charges</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="p_and_f_total_hidden" value="<?php if(isset($invoice[0]->p_and_f_total)) echo $invoice[0]->p_and_f_total; else echo '0'; ?>" name="p_and_f_total" onkeypress="return isNumber(event)"></td>
						</tr>
						
						<tr>
							<td colspan="9" align="right"><b>GST 18%</b></td>
							<td align="right"><span id="gst_total"><?php echo $invoice[0]->gst_total; ?></span><input type="hidden" id="gst_total_hidden" value="<?php echo $invoice[0]->gst_total; ?>" name="gst_total"></td>
						</tr>
						<tr>
							<td colspan="8" align="right"><b>Round of</b></td>
							<td colspan="1" align="right"><select class="form-control" name="round_off_type" id="round_off_type"><option value="-" <?php if($invoice[0]->round_off_type == '-') echo 'selected'; ?>>-</option><option value="+" <?php if($invoice[0]->round_off_type == '+') echo 'selected'; ?>>+</option></select></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="round_off" value="<?php if(isset($invoice[0]->round_off)) echo $invoice[0]->round_off; else echo '0'; ?>" name="round_off" readonly></td>
						</tr>
						<tr>
							<td colspan="9" align="right"><b>Total</b></td>
							<td align="right"><span id="grand_total"><?php echo $invoice[0]->grand_total; ?></span><input type="hidden" id="grand_total_hidden" value="<?php echo $invoice[0]->grand_total; ?>" name="grand_total"></td>
						</tr>
					</table>
				</div> 
				</div> 
				
					<div class="clearfix"></div>
						<div class="col-md-6">
							<div class="form-group row">
							   <label class="control-label text-right col-md-4">Terms and Conditions</label>
							   <div class="col-md-8">
								  <textarea class="form-control"  name="invoice_terms_and_condition"  Placeholder="Details" rows="6"><?php echo $invoice[0]->invoice_terms_and_condition; ?></textarea>
							   </div>
							</div>
						 </div>
					
					 <!--<div class="col-md-6">
						<div class="form-group row">
							<label class="control-label text-right col-md-4">Invoice Copy</label>
							<div class="col-md-8">
								<input type="file" name="invoice_copy" class="form-control file_size_1 pdf_file">
								<small class="file_upload_type_hint">Only PDF or pdf file format & less than 1MB</small>
							 </div>
						</div>
					</div> -->  
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-right">
                     <input type="submit" value="Update" class="btn btn-success">
                     <a href="<?php echo site_url('purchase_order'); ?>" class="btn btn-danger">Cancel</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('script_product_request.php'); ?>
<?php include('script_purchase_order.php'); ?>
