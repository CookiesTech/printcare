<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">Add New Purchase Order</h4>
            </div>
            <div class="card-body">
               <form id="sub_suppliers" action="<?php echo $action; ?>" method="post" autocomplete="off" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').innerHTML='Creating PO Please wait...';">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Order Date</label>
                           <div class="col-md-8">
                              <input type="text" name="purchase_order_date" class="datepicker form-control" placeholder="Date" value=""> 
                           </div>
                        </div>
                     </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Supplier</label>
                           <div class="col-md-8">
                              <select name="ref_supplier_id" id="select_supplier" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Supplier</option>
                                 <?php 
									echo $this->Common_model->getOptionList('supplier');
                                    ?>
                              </select>
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
								<th align="left" width="20%">Product</th>
								<th align="left" width="10%">SKU</th>
								<th align="left" width="15%">Avail Qty</th>
								<th align="right" width="10%">Price</th>
								<th align="left" width="10%">Qty</th>
								<th align="right" width="15%">Total</th>
								<th align="right" width="5%"></th>
							</tr>
						</thead>
						<tbody id="product_body">
							<?php 
								$i = 1;
								if(isset($purchase_order_particulars) && !empty($purchase_order_particulars)){
									foreach($purchase_order_particulars as $key => $val){ 	
													
							?>
										<tr id="<?php echo $i; ?>">
											<td align="center" ><?php echo $i; ?></td>
											<td align="left"><?php echo $val->product_name; ?>
											<input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][ref_product_id]" value="<?php echo $val->product_id; ?>" >
											</td>
											<td align="left" ><?= $val->sku?></td>
											<td align="left" ><?= $val->quantity?></td>
											
											<td align="right" ><input type="text" class="base_price form-control text-right" id="price_<?php echo $i; ?>" name="tbl_purchase_order_particulars[<?php echo $i; ?>][price]" value="<?php echo $val->product_price; ?>"></td>
											<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_<?php echo $i; ?>" value=""></td>											
											<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][total]" class="form-control text-right total" id="total_<?php echo $i; ?>" value=""></td>
											<td align="right"><a class="remove_product_particulars btn btn-danger"><i class="fa fa-remove remove_product"></i></a></td>
										</tr>
										
							<?php	
								$i++;		
									}
								}else{
									echo '<tr><td align="center" colspan="8">Please select the supplier...</td></tr>';
								}
							?>						
						</tbody>
						
						<tr>
							<td colspan="6" align="right"><b>Sub Total</b></td>
							<td align="right"><span id="sub_total"><?php echo $purchase_order[0]->sub_total; ?></span><input type="hidden" id="sub_total_hidden" value="<?php echo $purchase_order[0]->sub_total; ?>" name="sub_total"></td>
							<td></td>
						</tr>
						<!-- <tr>
							<td colspan="1"></td>
							<td align="right"><select class="form-control" name="ref_discount_type_id" id="discount_type" style="width:70px;">
								<?php 
									if(isset($purchase_order[0]->ref_discount_type_id)){
										echo $this->Common_model->getOptionList('discount_type',$purchase_order[0]->ref_discount_type_id);
									}else{
										echo $this->Common_model->getOptionList('discount_type','');
									}
								?>
							</td>
							<td align="right"><input type="text" class="form-control" style="width:70px;" id="discount_value" value="<?php if($purchase_order[0]->discount_value) echo $purchase_order[0]->discount_value; else echo '0'; ?>" name="discount_value"></td>
							<td  align="right"><b>Discount</b></td>
							<td align="right"><span id="discount_total"><?php echo $purchase_order[0]->discount_total; ?></span><input type="hidden" id="discount_total_hidden" value="<?php echo $purchase_order[0]->discount_total; ?>" name="discount_total"></td>
						</tr>
						<tr>
							<td colspan="4" align="right"><b>Additional / Extra Charges</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="extra_total_hidden" value="<?php if(isset($purchase_order[0]->extra_total)) echo $purchase_order[0]->extra_total; else echo '0'; ?>" name="extra_total" onkeypress="return isNumber(event)"></td>
						</tr>
						<tr>
							<td colspan="4" align="right"><b>P&F Charges</b></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="p_and_f_total_hidden" value="<?php if(isset($purchase_order[0]->p_and_f_total)) echo $purchase_order[0]->p_and_f_total; else echo '0'; ?>" name="p_and_f_total" onkeypress="return isNumber(event)"></td>
						</tr>
						<tr>
							<td colspan="4" align="right"><b>GST 18%</b></td>
							<td align="right"><span id="gst_total"><?php echo $purchase_order[0]->gst_total; ?></span><input type="hidden" id="gst_total_hidden" value="<?php echo $purchase_order[0]->gst_total; ?>" name="gst_total"></td>
						</tr>
						<tr>
							<td colspan="3" align="right"><b>Round of</b></td>
							<td colspan="1" align="right"><select class="form-control" name="round_off_type" id="round_off_type"><option value="-" <?php if($purchase_order[0]->round_off_type == '-') echo 'selected'; ?>>-</option><option value="+" <?php if($purchase_order[0]->round_off_type == '+') echo 'selected'; ?>>+</option></select></td>
							<td align="right"><input type="text"  class="form-control text-right" style="width:80px;" id="round_off" value="<?php if(isset($purchase_order[0]->round_off)) echo $purchase_order[0]->round_off; else echo '0'; ?>" name="round_off" readonly></td>
						</tr> -->
						<tr>
							<td colspan="6" align="right"><b>Total</b></td>
							<td align="right"><span id="grand_total"><?php echo $purchase_order[0]->grand_total; ?></span><input type="hidden" id="grand_total_hidden" value="<?php echo $purchase_order[0]->grand_total; ?>" name="grand_total"></td>
							<td></td>
						</tr>
					</table>
				</div> 
				</div> 
				
                <div class="clearfix"></div>
				<!-- <div class="col-md-8">
					<div class="form-group row">
					   <label class="control-label text-right col-md-2">Terms and Conditions</label>
					   <div class="col-md-8">
						  <textarea class="form-control"  name="terms_and_conditions"  Placeholder="Details" rows="6">The Price is F.O.R.Salem&#10;Delivery - 1 Week time on receipt of your order&#10;Despatch - Through Roadways&#10;Freight - Extra as applicable&#10;Validity - 30 Days</textarea>
					   </div>
					</div>
				 </div> -->
				 
				 <!--<div class="col-md-6">
					<div class="form-group row">
					   <label class="control-label text-right col-md-4">Order Details</label>
					   <div class="col-md-8">
						  <textarea class="form-control"  name="purchase_order_details"  Placeholder="Details"><?php //if(isset($sample_request[0]->purchase_order_details)) echo $sample_request[0]->purchase_order_details ;?></textarea>
					   </div>
					</div>
				 </div>-->
				 
                       
            </div>
            <div class="text-right" style="margin-right:15px;margin-bottom:15px;">
            <button class="btn btn-primary" type="submit" value="save" id="form">Save</button>
            <a href="<?php echo site_url('purchase_order'); ?>" class="btn btn-danger">Cancel</a>
            </div>
         </div>
         </form>
      </div>
   </div>
</div>
</div>	
</div>	
<?php include('script_purchase_order.php'); ?>
<script>
	$(document).ready(function(){
		$('#select_supplier').trigger('change');
	});
</script>
