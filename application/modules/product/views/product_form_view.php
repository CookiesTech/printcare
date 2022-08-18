<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">Add Product</h4>
            </div>
            <div class="card-body">
               <form id="sub_products" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                     
		                <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Category</label>
                           <div class="col-md-8">
                              <select name="ref_category_id" id="" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Category</option>
                                 <?php 
                                    echo $this->Common_model->getOptionList('category',$product[0]->ref_category_id); 
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Product Name</label>
                           <div class="col-md-8">
                              <input type="text" name="product_name"  placeholder="Enter Product Name" required class="form-control"  value="<?php if($product[0]->product_name) echo $product[0]->product_name ;?>"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">SKU</label>
                           <div class="col-md-8">
                              <input type="text" name="sku"  placeholder="Enter SKU" required class="form-control"  value="<?php if($product[0]->sku) echo $product[0]->sku ;?>"> 
                           </div>
                        </div>
                     </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Unit</label>
                           <div class="col-md-8">
                              <input type="text" name="unit"  placeholder="Enter Unit" required class="form-control"  value="<?php if($product[0]->unit) echo $product[0]->unit ;?>"> 
                           </div>
                        </div>
                     </div>
                     
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Stock Room</label>
                           <div class="col-md-8">
                              <select name="ref_stock_room_id" id="" class="form-control custom-select" required>
                                 <?php 
                                    echo $this->Common_model->getOptionList('stock_room',$product[0]->ref_stock_room_id); 
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Stock Slot</label>
                           <div class="col-md-8">
                              <select name="ref_stock_slot_id" id="" class="form-control custom-select" required>
                                 <?php 
                                    echo $this->Common_model->getOptionList('stock_slot',$product[0]->ref_stock_slot_id); 
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Quantity</label>
                           <div class="col-md-8">
                              <input type="text" name="quantity"  placeholder="Enter Quantity" class="form-control" value="<?php if(isset($product[0]->quantity)) echo $this->Common_model->get_product_qty($product[0]->product_id);?>" onkeypress="return isNumber(event)"> 
                           </div>
                        </div>
                     </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Quantity Type</label>
                           <div class="col-md-8">
                              <select name="ref_quantity_type_id" id="" class="form-control custom-select" required>
                                 <?php 
                                    echo $this->Common_model->getOptionList('quantity_type',$product[0]->ref_quantity_type_id); 
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">MRP</label>
                           <div class="col-md-8">
                              <input type="text" name="product_price"  placeholder="Enter MRP" class="form-control" value="<?php if(isset($product[0]->product_price)) echo $product[0]->product_price ;?>"> 
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">GST</label>
                           <div class="col-md-8">
                              <select name="ref_gst_type_id" id="" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select GST</option>
                                 <?php 
                                    echo $this->Common_model->getOptionList('gst_type',$product[0]->ref_gst_type_id); 
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Re-Order Level</label>
                           <div class="col-md-8">
                              <input type="text" name="reorder_level" value="<?php if(isset($product[0]->reorder_level)) echo $product[0]->reorder_level ;?>" placeholder="Enter Qty" class="form-control" onkeypress="return isNumber(event)"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Supplier Comm (%)</label>
                           <div class="col-md-8">
                              <input type="text" name="supplier_comm_perc" value="<?php if(isset($product[0]->supplier_comm_perc)) echo $product[0]->supplier_comm_perc ;?>" placeholder="Enter %" class="form-control" onkeypress="return isNumber(event)"> 
                           </div>
                        </div>
                     </div>

                    
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Fast Moving ?</label>
                           <div class="col-md-8">
                              <input type="checkbox"  name="featured_product" value="1" <?php if($product[0]->featured_product) echo 'checked'; ?> id="d2c"><label for="d2c">click if Yes</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Display in Homepage ?</label>
                           <div class="col-md-8">
                              <input type="checkbox"  name="display_homepage" value="1" <?php if($product[0]->display_homepage) echo 'checked'; ?> id="dh"><label for="dh">click if Yes</label>
                           </div>
                        </div>
                     </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Star Rating</label>
                           <div class="col-md-8">
                              <select name="ref_star_rating_id" id="" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Rating</option>
                                 <?php 
                                    echo $this->Common_model->getOptionList('star_rating',$product[0]->ref_star_rating_id); 
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
					      <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Product Image</label>
                           <div class="col-md-8">
                              <input type="file" name="product_image_file"  placeholder="Enter Product Image" class="form-control" value="">
                               <small class="file_upload_type_hint">Only jpg,jpeg & less than 1MB</small>
							  <?php if(!empty($product[0]->product_image_file)){ ?>
									<a class="" href="<?php echo base_url().$product[0]->product_image_file; ?>" target="_blank" title="view">view </a>
								<?php } ?>
                           </div>
                        </div>
                     </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Product Image</label>
                           <div class="col-md-8">
                              <img  src="<?php echo base_url().$product[0]->product_image_file; ?>" height="100">

                           </div>
                        </div>
                     </div>
                     
                     <div class="clearfix"></div>

                      <div class="col-md-9">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-2">Description</label>
                           <div class="col-md-10">
                              <textarea rows="10" class="form-control" id="description" name="description"><?php if(isset($product[0]->description)) echo $product[0]->description ;?></textarea>
                           </div>
                        </div>
                     </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12">
                       <?= $product_batch_block ?>
                    </div>
                      <div class="clearfix"></div>

                  </div>         
                  <br>        
                  <br>        
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
   $('input:text[name=product_name]').on('blur',function(){
   var product_name = $(this).val();
   $('.contact_person').val(product_name);	
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
   else if (id == 'product_business_category')
   {
   var lable = 'Add New Category';
   }
   else if (id == 'product_business_sub_category')
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
   $(this).after('<div class="data_source_others"><input type="text" name="product_data_source_others" required></div>');
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
   url: '<?php echo base_url(); ?>index.php/sub_product/ajax/addCategoryItem?field=business_category&name=' + name + '&parent=' + parent,
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
   var parent = $('#select_product_business_category').val();
   if (name == '')
   {
   alert('Please enter area name');
   }
   else
   {
   if (id == 'product_business_sub_category' && !parent)
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
   url: '<?php echo base_url(); ?>index.php/sub_product/ajax/getState?id=' + id,
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
   url: '<?php echo base_url(); ?>index.php/sub_product/ajax/getDistrict?id=' + id,
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
   $('#select_product_business_category').on('change', function()
   {
   var id = $(this).val();
   $.ajax(
   {
   type: 'POST',
   dataType: 'json',
   url: '<?php echo base_url(); ?>index.php/sub_product/ajax/getSubcategory?id=' + id,
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
   html += '<option value = "' + value['product_business_sub_category_'] + '" selected>' + value['product_business_sub_category_name'] + '</option>';
   }
   else
   {
   html += '<option value = "' + value['product_business_sub_category_id'] + '">' + value['product_business_sub_category_name'] + '</option>';
   }
   });
   }
   $('#select_product_business_sub_category').html(html);
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
