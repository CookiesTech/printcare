<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<?php if (isset($purchase_order)) { ?>
						<h4 class="m-b-0 text-white">Edit Purchase Order</h4>
					<?php } else { ?>
						<h4 class="m-b-0 text-white">Add New Purchase Order</h4>
					<?php } ?>
				</div>
				<div class="card-body">
					<form id="sub_suppliers" action="<?php echo $action; ?>" method="post" autocomplete="off" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').innerHTML='Creating PO Please wait...';">

						<div class="row">
						
						<div class="col-md-4">
						<div class="form-group row">
						<label class="control-label text-right col-md-4">Order Date</label>
						<div class="col-md-8">
						<input type="text" name="purchase_order_date" class="datepicker form-control" placeholder="Date" value="<?php if (isset($purchase_order[0]->purchase_order_date)) {
						echo $this->Common_model->getDateFormat($purchase_order[0]->purchase_order_date);
						} else {
						echo date('d-m-Y');
						} ?>">
						</div>
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-group row">
						<label class="control-label text-right col-md-4">Supplier</label>
						<div class="col-md-8">
						<select name="ref_supplier_id" id="select_supplier" class="form-control custom-select" required>
						<option value="" disabled selected>Select Supplier</option>
						<?php
						if (isset($purchase_order[0]->ref_supplier_id)) {
						echo $this->Common_model->getOptionList('supplier', $purchase_order[0]->ref_supplier_id);
						} else {
						echo $this->Common_model->getOptionList('supplier');
						}
						?>
						</select>
						<input type="hidden" id="advanced_product_field" value="1">
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
												<th align="left" width="15%">Product</th>
												<th align="left" width="6%">SKU</th>
												<th align="left" width="5%">Avail Qty</th>
												<th align="right" width="7%">S.Comm (%)</th>
												<th align="right" width="10%">Price</th>
												<th align="center" width="7%">Qty</th>
												<th align="center" width="7%">Full Qty</th>
												<th align="right" width="8%">Discount</th>
												<th align="center" width="3%">GST(%)</th>
												<th align="right" width="8%">Sub Total</th>
												<th align="right" width="8%">GST Total</th>
												<th align="right" width="8%">Total</th>
												<th align="center" width="3%"></th>
											</tr>
										</thead>
										<tbody id="product_body">
											<?php
											$i = 1;
											if (isset($purchase_order_particulars) && !empty($purchase_order_particulars)) {
												foreach ($purchase_order_particulars as $key => $val) {
													$res_product = $this->Common_model->getDetails('product', 'product_id', $val->ref_product_id);
													$sku = '';
													if (isset($res_product) && !empty($res_product)) {
														$sku = $res_product[0]->sku;
														$quantity = $res_product[0]->quantity;
													}
											?>
													<tr id="<?php echo $i; ?>">
														<td align="center"><?php echo $i; ?></td>
														<td align="left"><?php echo $val->product_name; ?>
															<input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][ref_product_id]" value="<?php echo $val->ref_product_id; ?>">
														</td>
														<td align="left"><?= $sku ?></td>
														<td align="left"><?= $quantity ?></td>
														<td align="right"><input type="text" class="form-control text-right supplier_comm_perc" id="supplier_comm_perc_<?php echo $i; ?>" name="tbl_purchase_order_particulars[<?php echo $i; ?>][supplier_comm_perc]" value="<?= $val->supplier_comm_perc ?>" readonly></td>
														<td align="right"><input type="text" class="base_price form-control text-right" id="price_<?php echo $i; ?>" name="tbl_purchase_order_particulars[<?php echo $i; ?>][price]" value="<?php echo $val->price; ?>"></td>
														<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_<?php echo $i; ?>" value="<?php echo $val->qty; ?>"></td>
														<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][full_qty]" class="form-control" onkeypress="return isNumber(event)"  value="<?php echo $val->full_qty; ?>"></td>
														<td align="right"><input type="text" class="form-control text-right supplier_comm_total" id="supplier_comm_total_<?= $i ?>" name="tbl_purchase_order_particulars[<?= $i ?>][supplier_comm_total]" value="<?= $val->supplier_comm_total ?>" readonly></td>
														<td align="right"><input type="hidden" readonly name="tbl_purchase_order_particulars[<?php echo $i; ?>][gst_perc]" class="form-control row_gst_perc" id="gst_perc_<?php echo $i; ?>" onkeypress="return isNumber(event)" value="<?= $val->gst_perc ?>"><?= $val->gst_perc ?></td>
														<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][sub_total]" class="form-control text-right row_total" id="sub_total_<?php echo $i; ?>" value="<?= $val->sub_total ?>"></td>
														<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][gst]" class="form-control text-right row_gst" id="row_gst_<?php echo $i; ?>" value="<?= $val->gst ?>"></td>
														<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][total]" class="form-control text-right total" id="total_<?php echo $i; ?>" value="<?php echo $val->total; ?>"></td>
														<input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][pop_id]" id="pop_id_<?php echo $i; ?>" value="<?php echo $val->order_particulars_id; ?>">
														<td align="right"><a class="remove_product_particulars btn btn-danger" remove_pop_id=<?php echo $val->order_particulars_id; ?>><i class="fa fa-remove remove_product"></i></a></td>
													</tr>

											<?php
													$i++;
												}
											} else {
												echo '<tr><td align="center" colspan="14">Please select the product(s)...</td></tr>';
											}
											?>
										</tbody>

										<tr>
											<td colspan="12" align="right"><b>Sub Total</b></td>
											<td align="right"><span id="sub_total"><?php echo $purchase_order[0]->sub_total; ?></span><input type="hidden" id="sub_total_hidden" value="<?php echo $purchase_order[0]->sub_total; ?>" name="sub_total"></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="12" align="right"><b>Discount Total</b></td>
											<td align="right"><span id="supp_discount_total"><?php echo $purchase_order[0]->supp_discount_total; ?></span><input type="hidden" id="supp_discount_total_hidden" value="<?php echo $purchase_order[0]->supp_discount_total; ?>" name="supp_discount_total"></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="12" align="right"><b>GST Total</b></td>
											<td align="right"><span id="gst_total"><?php echo $purchase_order[0]->gst_total; ?></span><input type="hidden" id="gst_total_hidden" value="<?php echo $purchase_order[0]->gst_total; ?>" name="gst_total"></td>
											<td></td>
										</tr>
										
										<tr>
											<td colspan="12" align="right"><b>Total</b></td>
											<td align="right"><span id="grand_total"><?php echo $purchase_order[0]->grand_total; ?></span><input type="hidden" id="grand_total_hidden" value="<?php echo $purchase_order[0]->grand_total; ?>" name="grand_total"></td>
											<td></td>
										</tr>
									</table>
								</div>
							</div>

							<div class="clearfix"></div>

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
	$(document).ready(function() {
		$('.qty').trigger('keyup');
		$('#select_supplier').trigger('change');
	});
</script>