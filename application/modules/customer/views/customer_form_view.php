<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">Add/Update Customer</h4>
            </div>
            <div class="card-body">
               <form id="sub_customers" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                    
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Name</label>
                           <div class="col-md-8">
                              <input type="text" name="customer_name"  placeholder="Name" required class="form-control"  value="<?php if($customer[0]->customer_name) echo $customer[0]->customer_name ;?>"> 
                           </div>
                        </div>
                     </div>
      
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Address</label>
                           <div class="col-md-8">
                              <textarea class="form-control"  name="address"  Placeholder="Customer Address"><?php if(isset($customer[0]->address)) echo $customer[0]->address ;?></textarea>
                           <!-- <input type="text" name="address"  placeholder="Address" class="form-control" value="<?php if(isset($customer[0]->address)) echo $customer[0]->address ;?>">  -->
                           </div>
                        </div>
                     </div>
                     <!-- <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Address Line 2</label>
                           <div class="col-md-8">
                              <input type="text" name="customer_address_line2"  placeholder="Address Line 2" class="form-control" value="<?php if(isset($customer[0]->customer_address_line2)) echo $customer[0]->customer_address_line2 ;?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Address Line 3</label>
                           <div class="col-md-8">
                              <input type="text" name="customer_address_line3"  placeholder="Address Line 3" class="form-control" value="<?php if(isset($customer[0]->customer_address_line3)) echo $customer[0]->customer_address_line3 ;?>"> 
                           </div>
                        </div>
                     </div> -->
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Pincode</label>
                           <div class="col-md-8">
                              <input type="text" name="pincode" value="<?php if(isset($customer[0]->pincode)) echo $customer[0]->pincode ;?>" placeholder="Pincode" class="form-control" onkeypress="return isNumber(event)" maxlength="6"> 
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Country</label>
                           <div class="col-md-8">
                              <select name="ref_country_id" id="select_country" class="form-control custom-select" required>
                                 <option value="" disabled selected>Country</option>
                                 <?php 
                                    if(isset($customer[0]->ref_country_id)){
                                    echo $this->Common_model->getOptionList('country',$customer[0]->ref_country_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('country',DEFAULT_COUNTRY); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">State</label>
                           <div class="col-md-8">
                              <select name="ref_state_id" id="select_state" class="form-control custom-select" required>
                                 <option value="" disabled selected>State</option>
                                 <?php 
                                    if(isset($customer[0]->ref_state_id)){
                                    echo $this->Common_model->getOptionList('state',$customer[0]->ref_state_id,'ref_country_id',$customer[0]->ref_country_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('state','1503','ref_country_id','99'); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">District</label>
                           <div class="col-md-8">
                              <select name="ref_district_id"  class="form-control custom-select" id="select_district">
                                 <option value="" disabled selected>District</option>
                                 <?php 
                                    if(isset($customer[0]->ref_district_id)){
                                    echo $this->Common_model->getOptionList('district',$customer[0]->ref_district_id,'ref_state_id',$customer[0]->ref_state_id); 
                                    }else{
                                    echo $this->Common_model->getOptionList('district','533','ref_state_id','1503'); 
                                    }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Mobile</label>
                           <div class="col-md-8">
                              <input type="text" name="mobile" value="<?php if(isset($customer[0]->mobile)) echo $customer[0]->mobile ;?>" placeholder="Mobile" class="form-control"  maxlength="15"> 
                           </div>
                        </div>
                     </div>
                   <!--   <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Contact Number 2</label>
                           <div class="col-md-8">
                              <input type="text" name="contact_number_2" value="<?php if(isset($customer[0]->contact_number_2)) echo $customer[0]->contact_number_2 ;?>" placeholder="Landline / Mobile" class="form-control" onkeypress="return isNumber(event)" maxlength="12"> 
                           </div>
                        </div>
                     </div> -->

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Email</label>
                           <div class="col-md-8">
                              <input type="email" name="email" value="<?php if(isset($customer[0]->email)) echo $customer[0]->email ;?>" placeholder="Email" class="form-control"  > 
                           </div>
                        </div>
                     </div>
                    <!--  <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Contact Email 2</label>
                           <div class="col-md-8">
                              <input type="email" name="contact_email_2" value="<?php if(isset($customer[0]->contact_email_2)) echo $customer[0]->contact_email_2 ;?>" placeholder="Email" class="form-control"  > 
                           </div>
                        </div>
                     </div> -->
                     
                     <!-- <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">GST No</label>
                           <div class="col-md-8">
                              <input type="text" name="customer_gst_no"  placeholder="GST NO" class="form-control" value="<?php if(isset($customer[0]->customer_gst_no)) echo $customer[0]->customer_gst_no ;?>"> 
                           </div>
                        </div>
                     </div>
                     <?php
							   $branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
							   if($branch_id<=0)
							   {
							?>
							<div class="col-md-6">
								<div class="form-group row">
								<label class="control-label text-right col-md-4">Branch</label>
								<div class="col-md-8">
									<select name="ref_branch_id" id="ref_branch_id" class="form-control">
										<option value="" selected disabled>Select</option>
                              <?php
                                 if(isset($customer[0]->ref_branch_id))
                                 {
                                    echo $this->Common_model->getOptionList('branch',$customer[0]->ref_branch_id);
                                 }
                                 else
                                 {
                                    echo $this->Common_model->getOptionList('branch',$branch_id);
                                 }
                              ?>
                              
									</select>
								</div>
								</div>
								</div>
							<?php
								}
								else
								{
							?>
								<input type='hidden' name='ref_branch_id' id='ref_branch_id' value='<?=$branch_id;?>'>
							<?php
								}
							?> -->
					      <!-- <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">GST File</label>
                           <div class="col-md-8">
                              <input type="file" name="customer_gst_file"  placeholder="GST File" class="form-control" value="">
                               <small class="file_upload_type_hint">Only PDF or pdf file format & less than 1MB</small>
							     <?php if(!empty($customer[0]->customer_gst_file)){ ?>
									<a class="" href="<?php echo base_url().$customer[0]->customer_gst_file; ?>" target="_blank" title="view">view </a>
								   <?php } ?>
                           </div>
                        </div>
                     </div> -->
                 
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">GST Number</label>
                           <div class="col-md-8">
                          <input type="text" name="customer_gst_no"  placeholder="GST Number" class="form-control" value="<?php if(isset($customer[0]->customer_gst_no)) echo $customer[0]->customer_gst_no ;?>">  
                           <!--  <textarea class="form-control"  name="customer_description"  Placeholder="Description"><?php if(isset($customer[0]->customer_description)) echo $customer[0]->customer_description ;?></textarea>-->
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

