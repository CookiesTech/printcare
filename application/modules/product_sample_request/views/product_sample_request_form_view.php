<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <?php if(isset($sample_request[0]->ref_delivery_point_id)){?>
               <h4 class="m-b-0 text-white">Edit</h4>
               <?php } else { ?>
               <h4 class="m-b-0 text-white">Add</h4>
               <?php }?>
            </div>
            <div class="card-body">
               <form id="sub_suppliers" action="<?php echo $action; ?>" method="post" autocomplete="off" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').innerHTML='Creating Sample Request,Please wait...';">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Request Date</label>
                           <div class="col-md-8">
                              <input type="text" name="product_sample_request_date" class="datepicker form-control" placeholder="Request Date" value="<?php if(isset($sample_request)) echo $this->Common_model->getDateFormat($sample_request[0]->schedule_date); else echo date('d-m-Y'); ?>" required> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Client</label>
                           <div class="col-md-8">
                              <select name="ref_client_id" id="select_country" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Client</option>
                                 <?php 
                                    if(isset($sample_request[0]->ref_client_id)){
                                    echo $this->Common_model->getOptionList('client',$sample_request[0]->ref_client_id); 
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
                           <label class="control-label text-right col-md-4">Supplier</label>
                           <div class="col-md-8">
                              <select name="ref_supplier_id" id="select_supplier" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Supplier</option>
                                 <?php 
                                    if(isset($sample_request[0]->ref_supplier_id)){
										echo $this->Common_model->getOptionList('supplier',$sample_request[0]->ref_supplier_id); 
                                    }else{
										echo $this->Common_model->getOptionList('supplier'); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Category</label>
                           <div class="col-md-8">
                              <select name="ref_sample_request_category_id"  class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Category</option>
                                 <?php 
                                    if(isset($sample_request[0]->ref_sample_request_category_id)){
										echo $this->Common_model->getOptionList('sample_request_category',$sample_request[0]->ref_sample_request_category_id); 
                                    }else{
										echo $this->Common_model->getOptionList('sample_request_category'); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Mode of Despatch</label>
                           <div class="col-md-8">
							   <select name="ref_despatch_mode_id" id="select_delivery_point" class="form-control" required>
									<option value="" >Select Mode</option>
									<?php echo $this->Common_model->getOptionList('despatch_mode',$sample_request[0]->ref_despatch_mode_id); ?>
								</select>
                           </div>
                        </div>
                     </div>
                     
                      <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Delivery Point</label>
                           <div class="col-md-8">
							   <select name="ref_delivery_point_id" id="select_delivery_point" class="form-control" required>
									<option value="" >Select Delivery Point</option>
									<?php echo $this->Common_model->getOptionList('delivery_point',$sample_request[0]->ref_delivery_point_id); ?>
								</select>
                           </div>
                        </div>
                     </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Tag</label>
                           <div class="col-md-8">
							   <input type="text" name="tag" class="form-control" value="<?php echo $sample_request[0]->tag; ?>">
                           </div>
                        </div>
                     </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Schedule Date</label>
                           <div class="col-md-8">
							   <input type="text" name="schedule_date" class="form-control datepicker" value="<?php if(isset($sample_request)) echo $this->Common_model->getDateFormat($sample_request[0]->schedule_date); ?>">
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
								<th align="left" width="70%">Product</th>
								<th align="right" width="15%">Qty</th>
								<th align="right" width="10%">Action</th>
							</tr>
						</thead>
						<tbody id="product_body">
							<?php 
								$i =1;
								if(isset($product_sample_request_particulars) && !empty($product_sample_request_particulars)){ 
									foreach($product_sample_request_particulars as $key => $val){
								?>
								<tr id="<?php echo $i;  ?>">
									<td align="center"><span class="sno"><?php echo $i;  ?></span></td>
									<td align="left"><?php echo $val->product_name.'<br>'.$val->product_quality_name.' - '.$val->product_quality_size_name.' '.$val->product_variety_name; ?>
									<input type="hidden" name="tbl_product_sample_request_particulars[<?php echo $i; ?>][ref_product_id]" value="<?php echo $val->ref_product_id; ?>" >
									<input type="hidden" name="tbl_product_sample_request_particulars[<?php echo $i; ?>][ref_product_quality_id]" value="<?php echo $val->ref_product_quality_id; ?>" >
									<input type="hidden" name="tbl_product_sample_request_particulars[<?php echo $i; ?>][ref_product_quality_size_id]" value="<?php echo $val->ref_product_quality_size_id; ?>" >
									<input type="hidden" name="tbl_product_sample_request_particulars[<?php echo $i; ?>][ref_product_variety_id]" value="<?php echo $val->ref_product_variety_id; ?>" >
									</td>
									<td align="right"><input type="text" name="tbl_product_sample_request_particulars[<?php echo $i; ?>][qty]" class="form-control text-right" style="width:80px;" value="<?php echo $val->qty; ?>"></td>
									<td align="right"><a class="remove_product_particulars btn btn-danger"><i class="fa fa-remove remove_product"></i></a></td>
								</tr>	
								<?php $i++; } ?>	
							<?php }else{ ?>	
							
							<?php } ?>					
						</tbody>
					</table>
				</div> 
				</div> 
				
                <div class="clearfix"></div>
				<div class="col-md-6">
					<div class="form-group row">
					   <label class="control-label text-right col-md-4">Request Details</label>
					   <div class="col-md-8">
						  <textarea class="form-control"  name="product_sample_request_details"  Placeholder="Details"><?php if(isset($sample_request[0]->product_sample_request_details)) echo $sample_request[0]->product_sample_request_details ;?></textarea>
					   </div>
					</div>
				 </div>
                       
            </div>
            <div class="text-right" style="margin-right:15px;margin-bottom:15px;">
            <button class="btn btn-primary" type="submit" value="save" id="form">Save</button>
            <a href="<?php echo site_url('product_sample_request'); ?>" class="btn btn-danger">Cancel</a>
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
<Script>
	$(document).ready(function(){	
		$('#select_supplier').trigger('change');
	});
</Script>
