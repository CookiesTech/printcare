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
               <h4 class="m-b-0 text-white">Update Stock In Details</h4>
            </div>
            <div class="card-body">
               <h4 class="card-title"></h4>
               <form method="POST" enctype="multipart/form-data" action="<?php site_url('purchase_order/view_stackin_details'); ?>">
                  <div class="row">
                  <div class="col-md-12">
                  <div style="min-height:150px;">
					 <table id="product_particulars_list" class="table color-bordered-table muted-bordered-table">
						<thead>
							<tr>
								<th align="left" width="10%">Added Date</th>
								<th align="left" width="20%">Product</th>
								<th align="left" width="6%">SKU</th>
								<th align="right" width="5%">Price</th>
								<th align="left" width="15%">Batch No</th>
								<th align="left" width="10%">Quantity</th>
								<th align="left" width="12%">Manufacture Date</th>
								<th align="left" width="12%">Expiry Date</th>
								<th align="left" width="6%">Action</th>
							</tr>
						</thead>
						<tbody id="product_body">
							<?php 
								$i = 1;
								if(isset($product_batch) && !empty($product_batch)){
									foreach($product_batch as $key => $val){ 	
										$res_product = $this->Common_model->getDetails('product','product_id',$val->ref_product_id);
										$sku = '';
										$product_price = '';
										if(isset($res_product) && !empty($res_product)){
											$sku = $res_product[0]->sku;
											$product_price = $res_product[0]->product_price;
										}			
							?>
										<tr class="product_row_<?php echo $val->product_batch_id; ?>" id="row_<?= $val->product_batch_id?>">
											<td align="left"><?php echo getDateTimeFormat($val->added_date); ?></td>
											<td align="left"><?php echo $val->product_name; ?>
											<input type="hidden" name="tbl_product_batch[<?= $val->product_batch_id; ?>][ref_product_id]" value="<?php echo $val->ref_product_id; ?>">
											<input type="hidden" class="remove_status_<?php echo $val->product_batch_id; ?>" name="tbl_product_batch[<?= $val->product_batch_id; ?>][delete]" value="0">
											</td>
											<td align="left"><?= $sku?></td>
											<td align="right"><?= $product_price?></td>
											<td align="left"><input type="text" class="form-control product_batch_<?= $val->product_batch_id?>" name="tbl_product_batch[<?= $val->product_batch_id; ?>][product_batch_name]" value="<?= $val->product_batch_name?>"></td>
											<td align="left">
												<input type="hidden" class="" id="" name="tbl_product_batch[<?= $val->product_batch_id; ?>][prev_quantity]" value="<?= $val->quantity?>">

												<input type="text" class="form-control cur_qty product_batch_qty_<?= $val->product_batch_id?>" id="<?= $val->product_batch_id?>" name="tbl_product_batch[<?= $val->product_batch_id; ?>][quantity]" value="<?= $val->quantity?>"></td>
											<td align="left"><input type="text" class="form-control datepicker product_batch_<?= $val->product_batch_id?>" name="tbl_product_batch[<?= $val->product_batch_id; ?>][manufacture_date]" value="<?= getDateFormat($val->manufacture_date)?>"></td>
											<td align="left"><input type="text" class="form-control datepicker product_batch_<?= $val->product_batch_id?>" name="tbl_product_batch[<?= $val->product_batch_id; ?>][expiry_date]" value="<?= getDateFormat($val->expiry_date)?>"></td>
											<td align="left"><a class="remove_product_batch btn btn-danger" id="<?php echo $val->product_batch_id; ?>">Remove</a></td>
										</tr>
										
							<?php	
								$i++;		
									}
								}else{
									echo '<tr><td align="center" colspan="10">Product not available...</td></tr>';
								}
							?>
				
						</tbody>
						
					</table>
				</div> 
				</div> 
				
					<div class="clearfix"></div>
						<!-- <div class="col-md-6">
							<div class="form-group row">
							   <label class="control-label text-right col-md-4">Terms and Conditions</label>
							   <div class="col-md-8">
								  <textarea class="form-control"  name="invoice_terms_and_condition"  Placeholder="Details" rows="6"><?php echo $purchase_order[0]->terms_and_conditions; ?></textarea>
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
