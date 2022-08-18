<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">Add Supplier</h4>
            </div>
            <div class="card-body">
               <form id="sub_suppliers" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                   
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Name</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_name"  placeholder="Name" required class="form-control"  value="<?php if($supplier[0]->supplier_name) echo $supplier[0]->supplier_name ;?>"> 
                           </div>
                        </div>
                     </div>
                     <!-- <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Code</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_code"  placeholder="Code" required class="form-control"  value="<?php if($supplier[0]->supplier_code) echo $supplier[0]->supplier_code ;?>"> 
                           </div>
                        </div>
                     </div> -->
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Address Line 1</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_address_line1"  placeholder="Address Line 1" class="form-control" value="<?php if(isset($supplier[0]->supplier_address_line1)) echo $supplier[0]->supplier_address_line1 ;?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Address Line 2</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_address_line2"  placeholder="Address Line 2" class="form-control" value="<?php if(isset($supplier[0]->supplier_address_line2)) echo $supplier[0]->supplier_address_line2 ;?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Address Line 3</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_address_line3"  placeholder="Address Line 3" class="form-control" value="<?php if(isset($supplier[0]->supplier_address_line3)) echo $supplier[0]->supplier_address_line3 ;?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Pincode</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_pincode" value="<?php if(isset($supplier[0]->supplier_pincode)) echo $supplier[0]->supplier_pincode ;?>" placeholder="Pincode" class="form-control" onkeypress="return isNumber(event)" maxlength="6"> 
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
                                    if(isset($supplier[0]->ref_country_id)){
                                    echo $this->Common_model->getOptionList('country',$supplier[0]->ref_country_id); 
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
                                    if(isset($supplier[0]->ref_state_id)){
                                    echo $this->Common_model->getOptionList('state',$supplier[0]->ref_state_id,'ref_country_id',$supplier[0]->ref_country_id); 
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
                                    if(isset($supplier[0]->ref_district_id)){
                                    echo $this->Common_model->getOptionList('district',$supplier[0]->ref_district_id,'ref_state_id',$supplier[0]->ref_state_id); 
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
                           <label class="control-label text-right col-md-4">Contact Number 1</label>
                           <div class="col-md-8">
                              <input type="text" name="contact_number_1" value="<?php if(isset($supplier[0]->contact_number_1)) echo $supplier[0]->contact_number_1 ;?>" placeholder="Landline / Mobile" class="form-control" onkeypress="return isNumber(event)" maxlength="12"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Contact Number 2</label>
                           <div class="col-md-8">
                              <input type="text" name="contact_number_2" value="<?php if(isset($supplier[0]->contact_number_2)) echo $supplier[0]->contact_number_2 ;?>" placeholder="Landline / Mobile" class="form-control" onkeypress="return isNumber(event)" maxlength="12"> 
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Contact Email 1</label>
                           <div class="col-md-8">
                              <input type="email" name="contact_email_1" value="<?php if(isset($supplier[0]->contact_email_1)) echo $supplier[0]->contact_email_1 ;?>" placeholder="Email" class="form-control"  > 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Contact Email 2</label>
                           <div class="col-md-8">
                              <input type="email" name="contact_email_2" value="<?php if(isset($supplier[0]->contact_email_2)) echo $supplier[0]->contact_email_2 ;?>" placeholder="Email" class="form-control"  > 
                           </div>
                        </div>
                     </div>
                     
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">GST No</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_gst_no"  placeholder="GST NO" class="form-control" value="<?php if(isset($supplier[0]->supplier_gst_no)) echo $supplier[0]->supplier_gst_no ;?>"> 
                           </div>
                        </div>
                     </div>
					<div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">GST File</label>
                           <div class="col-md-8">
                              <input type="file" name="supplier_gst_file"  placeholder="GST File" class="form-control" value="">
                               <small class="file_upload_type_hint">Only PDF or pdf file format & less than 1MB</small>
							<?php if(!empty($supplier[0]->supplier_gst_file)){ ?>
									<a class="" href="<?php echo base_url().$supplier[0]->supplier_gst_file; ?>" target="_blank" title="view">view </a>
								<?php } ?>
                           </div>
                        </div>
                     </div>
                 <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">PAN No</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_pan_no"  placeholder="PAN NO" class="form-control" value="<?php if(isset($supplier[0]->supplier_pan_no)) echo $supplier[0]->supplier_pan_no ;?>"> 
                           </div>
                        </div>
                     </div>
				        <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">PAN File</label>
                           <div class="col-md-8">
                              <input type="file" name="supplier_pan_file"  placeholder="PAN File" class="form-control" value="">
                               <small class="file_upload_type_hint">Only PDF or pdf file format & less than 1MB</small>
							  <?php if(!empty($supplier[0]->supplier_pan_file)){ ?>
									<a class="" href="<?php echo base_url().$supplier[0]->supplier_pan_file; ?>" target="_blank" title="view">view </a>
								<?php } ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Description</label>
                           <div class="col-md-8">
                              <textarea class="form-control"  name="supplier_description"  Placeholder="Description"><?php if(isset($supplier[0]->supplier_description)) echo $supplier[0]->supplier_description ;?></textarea>
                           </div>
                        </div>
                     </div>
                     
                     
                  </div>
                  <div class="">
                     <?php //echo $contact_number_block; ?>
                  </div>
                  <div class="">
                     <?php //echo $contact_email_block; ?>
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
<script>
   $('input:text[name=supplier_name]').on('blur',function(){
   var supplier_name = $(this).val();
   $('.contact_person').val(supplier_name);	
   });
   
   
   $(document).on('click','.contact_number_primary',function () {
   $(".contact_number_primary").removeAttr('checked');
   $(this).prop('checked',true);
   });
   
   $(document).on('change','.email_primary',function () {
   $(".email_primary").removeAttr('checked');
   $(this).prop('checked',true);
   });
   
   var designationNew;
   $(document).ready(function()
   {
   $('.js-open-modal').on('click', function()
   {
   id = $(this).attr('id');
   var id1 = 'popup_' + id;
   //alert(id);
   $('.trriger_popup').attr('id', id1);
   var lable = '';
   if (id == 'data_source')
   {
   var lable = 'Add New Data Source';
   }
   else if (id == 'salutation')
   {
   var lable = 'Add New Salutaion';
   }
   else if (id == 'supplier_business_category')
   {
   var lable = 'Add New Category';
   }
   else if (id == 'supplier_business_sub_category')
   {
   var lable = 'Add New Sub Category';
   }
   else if (id == 'area')
   {
   var lable = 'Add New Area';
   }
   else if (id == 'designation')
   {
   var lable = 'Add New Designation';
   }
   $('#popup h4').text(lable);
   $("#popup").modal('show');
   $('#name').focus();
   })
   $('#name').keypress(function(e)
   {
   var key = e.which;
   if (key == 13) // the enter key code
   {
   $('#insert').click();
   return false;
   }
   });
   $('#select_data_source').on('change', function(e)
   {
   var optionSelected = $("option:selected").val();
   if (optionSelected == '3')
   {
   $(this).after('<div class="data_source_others"><input type="text" name="supplier_data_source_others" required></div>');
   }
   else
   {
   $('.data_source_others').remove();
   }
   });
   $(document).on("click", "#insert_category", function()
   {
   var name = $('#category_name').val();
   var parent = '';
   var parent = $('#select_business_category').val();
   if (name == '')
   {
   alert('Please enter area name');
   }
   else
   {
   $.ajax(
   {
   type: 'POST',
   dataType: 'html',
   url: '<?php echo base_url(); ?>index.php/sub_supplier/ajax/addCategoryItem?field=business_category&name=' + name + '&parent=' + parent,
   success: function(html)
   {
   if (html == 'exist')
   {
   alert('Area already exist');
   }
   else
   {
   $('#select_business_category').html(html);
   $('.success_msg').html('Successfully Added').fadeIn('slow');
   clearModalPopup();
   $("#popup_category").modal('hide');
   }
   }
   });
   }
   });
   $(document).on("click", "#insert", function()
   {
   var name = $('#name').val();
   var parent = '';
   var parent = $('#select_supplier_business_category').val();
   if (name == '')
   {
   alert('Please enter area name');
   }
   else
   {
   if (id == 'supplier_business_sub_category' && !parent)
   {
   alert('Please select parent category');
   }
   else
   {
   $.ajax(
   {
   type: 'POST',
   dataType: 'json',
   url: '<?php echo base_url(); ?>index.php/Common/addFieldItem?field=' + id + '&name=' + name + '&parent=' + parent,
   success: function(json)
   {
   if (json == 'exist')
   {
   alert('Area already exist');
   }
   else
   {
   var html = '';
   $(json).each(function(index, value)
   {
   //alert(value['area_name']);
   if (value['name'] == name)
   {
   html += '<option value = "' + value['id'] + '" selected>' + value['name'] + '</option>';
   }
   else
   {
   html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
   }
   });
   if (id == 'designation')
   {
   $('#email_' + id).html(html);
   designationNew = html;
   }
   $('#select_' + id).html(html);
   $('.success_msg').html('Successfully Added').fadeIn('slow');
   clearModalPopup();
   $("#popup").modal('hide');
   }
   }
   });
   }
   }
   });
   // Load States based on Country
   $('#select_country').on('change', function()
   {
   var id = $(this).val();
   $.ajax(
   {
   type: 'POST',
   dataType: 'json',
   url: '<?php echo base_url(); ?>index.php/sub_supplier/ajax/getState?id=' + id,
   success: function(json)
   {
   var html = '';
   html += '<option value = "" selected>Select State</option>';
   if (json)
   {
   $(json).each(function(index, value)
   {
   //alert(value['area_name']);
   if (value['name'] == name)
   {
   html += '<option value = "' + value['id'] + '" selected>' + value['name'] + '</option>';
   }
   else
   {
   html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
   }
   });
   }
   $('#select_state').html(html);
   }
   });
   });
   // Load district based on State
   $('#select_state').on('change', function()
   {
   var id = $(this).val();
   $.ajax(
   {
   type: 'POST',
   dataType: 'json',
   url: '<?php echo base_url(); ?>index.php/sub_supplier/ajax/getDistrict?id=' + id,
   success: function(json)
   {
   var html = '';
   html += '<option value = "" selected>Select District</option>';
   if (json)
   {
   $(json).each(function(index, value)
   {
   //alert(value['area_name']);
   if (value['name'] == name)
   {
   html += '<option value = "' + value['id'] + '" selected>' + value['name'] + '</option>';
   }
   else
   {
   html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
   }
   });
   }
   $('#select_district').html(html);
   }
   });
   });
   // Load Subcategory based on Category
   $('#select_supplier_business_category').on('change', function()
   {
   var id = $(this).val();
   $.ajax(
   {
   type: 'POST',
   dataType: 'json',
   url: '<?php echo base_url(); ?>index.php/sub_supplier/ajax/getSubcategory?id=' + id,
   success: function(json)
   {
   var html = '';
   html += '<option value = "" selected>Business Sub category</option>';
   if (json)
   {
   $(json).each(function(index, value)
   {
   //alert(value['area_name']);
   if (value['name'] == name)
   {
   html += '<option value = "' + value['supplier_business_sub_category_'] + '" selected>' + value['supplier_business_sub_category_name'] + '</option>';
   }
   else
   {
   html += '<option value = "' + value['supplier_business_sub_category_id'] + '">' + value['supplier_business_sub_category_name'] + '</option>';
   }
   });
   }
   $('#select_supplier_business_sub_category').html(html);
   }
   });
   });
   });
   
   function clearModalPopup()
   {
   $("#name").val("");
   $('.success_msg').fadeOut();
   setTimeout(function()
   {
   $('.success_msg').html(' ');
   $('.js-modal-close').click();
   }, 1000);
   }
</script>
