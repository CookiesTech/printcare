<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
				<h4 class="m-b-0 text-white">Inward</h4>
            </div>
            <div class="card-body">
               <form id="sub_suppliers" action="<?php echo $action; ?>" method="post">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Request Date</label>
                           <div class="col-md-9">
                              <?php echo $this->Common_model->getDateFormat($sample_request[0]->product_sample_request_date); ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Client</label>
                           <div class="col-md-9">
                             <?php echo $sample_request[0]->client_name; ?>
                           </div>
                        </div>
                     </div>
                     
                     <h4>Product Details</h4>
                     <div class="clearfix"></div>
                  <div class="col-md-12">
                  <div style="height:200px;overflow-y:scroll">
					 <table id="product_particulars_list" class="table color-table muted-table">
						<thead>
							<tr>
								<th align="center" width="5%">S.No</th>
								<th align="left" width="55%">Product</th>
								<th align="center" width="10%">Requested Qty</th>
								<th align="center" width="10%">Delivery Qty</th>
								<th align="center" width="10%">Damaged Qty</th>
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
									<td><?php echo $val->product_name; ?></td>
									<td><?php echo $val->qty; ?></td>
									<td>
										<input type="text" name="tbl_product_sample_request_particulars[<?php echo $val->product_sample_request_particulars_id; ?>][delivered_qty]"  class="total form-control" id="total_1" size="5" style="width:80px;" onkeypress="return isNumber(event)">
									</td>		
									<td>
										<input type="text" name="tbl_product_sample_request_particulars[<?php echo $val->product_sample_request_particulars_id; ?>][damaged_qty]"  class="total form-control" id="total_1" size="5" style="width:80px;" onkeypress="return isNumber(event)">
									</td>
								</tr>
								<?php $i++; } ?>
							<?php } ?>
						</tbody>
					</table>
				</div> 
				</div> 
				
                <div class="clearfix"></div>
				<div class="col-md-6">
					<div class="form-group row">
					   <label class="control-label text-right col-md-3">Request Details</label>
					   <div class="col-md-9">
						   <?php echo $sample_request[0]->product_sample_request_details ;?>
					   </div>
					</div>
				 </div>
                       
            </div>
            <div class="text-right" style="margin-right:15px;margin-bottom:15px;">
            <button class="btn btn-primary" type="submit" value="save">Save</button>
            <a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-danger">Cancel</a>
            </div>
         </div>
         </form>
      </div>
   </div>
</div>
</div>	
</div>	
<?php include(APPPATH.'views/common/popup_general_master_form.php'); ?>
<?php include('script_product_sample_request.php'); ?>
