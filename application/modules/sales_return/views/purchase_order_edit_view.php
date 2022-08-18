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
               <form id="sub_suppliers" action="<?php echo $action; ?>" method="post">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Request Date</label>
                           <div class="col-md-9">
                              <input type="text" name="product_sample_request_date" class="datepicker form-control" placeholder="Request Date" value="<?php if(isset($sample_request[0]->product_sample_request_date)){echo $this->Common_model->getDateFormat($sample_request[0]->product_sample_request_date) ;}?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Client</label>
                           <div class="col-md-9">
                              <select name="ref_client_id" id="select_country" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Client</option>
                                 <?php 
                                    if(isset($sample_request[0]->ref_client_id)){
                                    echo $this->Common_model->getOptionList('client',$sample_request[0]->ref_client_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('client',DEFAULT_COUNTRY); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Supplier</label>
                           <div class="col-md-9">
                              <select name="ref_supplier_id" id="select_supplier" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Supplier</option>
                                 <?php 
                                    if(isset($sample_request[0]->ref_supplier_id)){
                                    echo $this->Common_model->getOptionList('supplier',$sample_request[0]->ref_supplier_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('supplier',DEFAULT_COUNTRY); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Product</label>
                           <div class="col-md-9">
                              <select name="ref_product_id" id="select_product" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Product</option>
                                 <?php 
                                    if(isset($sample_request[0]->ref_product_id)){
                                    echo $this->Common_model->getOptionList('product',$sample_request[0]->ref_product_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('product',DEFAULT_COUNTRY); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Request Quantity</label>
                           <div class="col-md-9">
                              <input type="text" name="product_sample_request_qty"  placeholder="Request Quantity" class="form-control" value="<?php echo $sample_request[0]->product_sample_request_qty ;?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Request Details</label>
                           <div class="col-md-9">
                              <textarea class="form-control"  name="product_sample_request_details"  Placeholder="Details"><?php if(isset($sample_request[0]->product_sample_request_details)) echo $sample_request[0]->product_sample_request_details ;?></textarea>
                           </div>
                        </div>
                     </div>
                     <?php if(isset($sample_request[0]->ref_delivery_point_id)){ ?>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Delivery Point</label>
                           <div class="col-md-9">
							   <select name="ref_delivery_point_id" id="select_delivery_point" class="form-control" required>
									<option value="" >Select Delivery Point</option>
									<?php echo $this->Common_model->getOptionList('delivery_point',$sample_request[0]->ref_delivery_point_id); ?>
								</select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Dispatch Date</label>
                           <div class="col-md-9">
                              <input type="text" name="dispatch_date" class="datetimepicker form-control" placeholder="Dispatch Date" value="<?php echo $this->Common_model->getDateTimeFormat($sample_request[0]->dispatch_date) ;?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Installation Date</label>
                           <div class="col-md-9">
                              <input type="text" name="installation_date" class="datetimepicker form-control" placeholder="Installation Date" value="<?php echo $this->Common_model->getDateTimeFormat($sample_request[0]->installation_date); ?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Delivery Date</label>
                           <div class="col-md-9">
                              <input type="text" name="delivered_date" class="datetimepicker form-control" placeholder="Delivered Date" value="<?php echo $this->Common_model->getDateTimeFormat($sample_request[0]->delivered_date); ?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Reminder Date</label>
                           <div class="col-md-9">
                              <input type="text" name="reminder_date" class="datetimepicker form-control" placeholder="Reminder Date" value="<?php echo $this->Common_model->getDateTimeFormat($sample_request[0]->reminder_date); ?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Product Request Status</label>
                           <div class="col-md-9">
                              <select name="ref_product_request_status_id" id="select_country" class="form-control custom-select" required>
                                 <option value="" disabled selected>--select--</option>
                                 <?php 
                                    if(isset($sample_request[0]->ref_product_request_status_id)){
                                    echo $this->Common_model->getOptionList('product_request_status',$sample_request[0]->ref_product_request_status_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('product_request_status',DEFAULT_COUNTRY); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-3">Client Feedback</label>
                           <div class="col-md-9">
                              <textarea class="form-control"  name="client_feedback"  Placeholder="Feedback"><?php if(isset($sample_request[0]->client_feedback)) echo $sample_request[0]->client_feedback ;?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php }?>
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
