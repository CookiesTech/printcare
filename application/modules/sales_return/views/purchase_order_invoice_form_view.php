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
               <h4 class="m-b-0 text-white">Update Invoice Details</h4>
            </div>
            <div class="card-body">
               <h4 class="card-title"></h4>
               <form method="POST" enctype="multipart/form-data" action="<?php site_url('purchase_order/update_purchase_order_invoice'); ?>">
               <input type="hidden" name="ref_client_id" value="<?php echo $purchase_order[0]->ref_client_id; ?>">
               <input type="hidden" name="ref_supplier_id" value="<?php echo $purchase_order[0]->ref_supplier_id; ?>">
               <input type="hidden" name="ref_purchase_order_id" value="<?php echo $purchase_order[0]->purchase_order_id; ?>">
                  <div class="row">
					  <div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">PO No</label>
								<div class="col-md-8">	
									<?php echo $purchase_order[0]->purchase_order_code; ?>
								</div>					  
							</div>					  
						</div>		
						
						 <div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">PO Date</label>
								<div class="col-md-8">	
									<?php echo $this->Common_model->getDateFormat($purchase_order[0]->purchase_order_date); ?>
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
					<div class="col-md-6"></div>
					<div class="clearfix"></div>
					  <div class="col-md-6">
						<div class="form-group row">
							<label class="control-label text-right col-md-4">Invoice Date</label>
							<div class="col-md-8">
								<input type="text" class="form-control datepicker" name="invoice_date" placeholder="Date" value="<?php echo date('d-m-Y'); ?>">
							</div>
						</div>
					</div>
					  <div class="col-md-6">
						<div class="form-group row">
							<label class="control-label text-right col-md-4">Invoice No</label>
							<div class="col-md-8">
								<input type="text" class="form-control" placeholder="Invoice #" name="invoice_no">
							</div>
						</div>
					</div>
					 <div class="clearfix"></div>
                  <div class="col-md-12">
                  <div style="min-height:150px;">
					 <table id="product_particulars_list" class="table color-bordered-table muted-bordered-table">
						<thead>
							<tr>
								
								<th align="left" width="15%">Product</th>
								<th align="left" width="8%">SKU</th>
								<th align="right" width="7%">Price</th>
								<th align="left" width="8%">Ordered</th>
								<th align="left" width="8%">Rec Before</th>
								<th align="left" width="8%">Balance</th>
								<th align="left" width="10%">Patch No</th>
								<th align="left" width="10%">Qty</th>
								<th align="left" width="12%">Manuf Date</th>
								<th align="left" width="12%">Expiry Date</th>
								<th align="right" width="8%"></th>
							</tr>
						</thead>
						<tbody id="product_body">
							<?php 
								$i = 1;
								if(isset($purchase_order_particulars) && !empty($purchase_order_particulars)){
									foreach($purchase_order_particulars as $key => $val){ 	
										$res_product = $this->Common_model->getDetails('product','product_id',$val->ref_product_id);
										$sku = '';
										$product_price = '';
										if(isset($res_product) && !empty($res_product)){
											$sku = $res_product[0]->sku;
											$product_price = $res_product[0]->product_price;
										}			
							?>
										<tr class="product_row_<?php echo $val->ref_product_id; ?>" id="row_<?= $val->ref_product_id?>">
											
											<td align="left"><?php echo $val->product_name; ?>
											<input type="hidden" value="<?php echo $val->ref_product_id; ?>" >
											</td>
											<td align="left"><?= $sku?></td>
											<td align="right"><?= $product_price?></td>
											<td align="left"><?= $val->qty?></td>
											<td align="left"><?= $po_product_qty[$val->ref_product_id] ?>
											<input type="hidden" id="balance_<?=$val->ref_product_id?>" value="<?= $val->qty - $po_product_qty[$val->ref_product_id] ?>"></td>
											<td align="left"><?= $val->qty - $po_product_qty[$val->ref_product_id] ?></td>
											<?php if($val->qty - $po_product_qty[$val->ref_product_id] > 0){ ?>
											<td align="left"><input type="text" class="form-control product_patch_<?= $val->ref_product_id?>" name="tbl_product_patch[<?= $val->ref_product_id; ?>][product_patch_name][]" value=""></td>
											<td align="left"><input type="text" class="form-control cur_qty product_patch_qty_<?= $val->ref_product_id?>" id="<?= $val->ref_product_id?>" name="tbl_product_patch[<?= $val->ref_product_id; ?>][quantity][]" value=""></td>
											<td align="left"><input type="text" class="form-control datepicker product_patch_<?= $val->ref_product_id?>" name="tbl_product_patch[<?= $val->ref_product_id; ?>][manufacture_date][]" value=""></td>
											<td align="left"><input type="text" class="form-control datepicker product_patch_<?= $val->ref_product_id?>" name="tbl_product_patch[<?= $val->ref_product_id; ?>][expiry_date][]" value=""></td>
											<td align="left"><a class="add_patch btn btn-success" id="<?= $val->ref_product_id; ?>">Add Patch</a></td>
										<?php }else{ ?>
											<td colspan="5"></td>
										<?php } ?>
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
					
					 <div class="col-md-6">
						<div class="form-group row">
							<label class="control-label text-right col-md-4">Invoice Copy</label>
							<div class="col-md-8">
								<input type="file" name="invoice_copy" class="form-control file_size_1 pdf_file">
								<small class="file_upload_type_hint">Only PDF or pdf file format & less than 1MB</small>
							 </div>
						</div>
					</div>   
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
