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
               <?php if(isset($sample_request[0]->ref_delivery_point_id)){?>
               <h4 class="m-b-0 text-white">Edit Delivery Challan</h4>
               <?php } else { ?>
               <h4 class="m-b-0 text-white">New Delivery Challan</h4>
               <?php }?>
            </div>
            <div class="card-body">
               <form id="sub_suppliers" action="<?php echo site_url('product_sample_request/add_dc'); ?>" method="post">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">DC Date</label>
                           <div class="col-md-8">
                              <input type="text" name="delivery_challan_date" class="datepicker form-control" placeholder="Date" value="<?php if(isset($sample_request[0]->dc_date)){echo $this->Common_model->getDateFormat($sample_request[0]->dc_date) ;}?>"> 
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
                                    echo $this->Common_model->getOptionList('client',DEFAULT_COUNTRY); 
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
                     <!-- <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Category</label>
                           <div class="col-md-8">
                              <select name="ref_sample_request_category_id"  class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Category</option>
                                 <?php 
                           //~ if(isset($sample_request[0]->ref_sample_request_category_id)){
                           //~ echo $this->Common_model->getOptionList('sample_request_category',$sample_request[0]->ref_sample_request_category_id); 
                           //~ }else{
                           //~ echo $this->Common_model->getOptionList('sample_request_category'); 
                           //~ }
                           ?>
                              </select>
                           </div>
                        </div>
                        </div>-->
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Mode of Despatch</label>
                           <div class="col-md-8">
                              <select name="ref_despatch_mode_id" id="select_delivery_point" class="form-control" required>
                                 <option value="">Select Mode</option>
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
                     <!--      <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Tag</label>
                           <div class="col-md-8">
                        <input type="text" name="tag" class="form-control" >
                           </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Schedule Date</label>
                           <div class="col-md-8">
                        <input type="text" name="schedule_date" class="form-control datepicker" >
                           </div>
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Product</label>
                           <div class="col-md-8">
                              <select name="ref_product_id" id="select_product" class="form-control custom-select" required>
                                 <option value="" disabled selected>Select Product</option>
                                 <?php 
                           //~ if(isset($sample_request[0]->ref_product_id)){
                           //~ echo $this->Common_model->getOptionList('product',$sample_request[0]->ref_product_id); 
                           //~ }else{
                           //~ echo $this->Common_model->getOptionList('product',DEFAULT_COUNTRY); 
                           //~ }
                           ?>
                              </select>
                           </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Request Quantity</label>
                           <div class="col-md-8">
                              <input type="text" name="product_sample_request_qty"  placeholder="Request Quantity" class="form-control" value="<?php //echo $sample_request[0]->product_sample_request_qty ;?>"> 
                           </div>
                        </div>
                        </div>-->
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4"></label>
                           <div class="col-md-8">
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
									<tr>
										<td align="center" colspan="4">Please select the supplier...</td>
									</tr>							
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Additional Details</label>
                           <div class="col-md-8">
                              <textarea class="form-control"  rows="2" name="delivery_challan_details"  Placeholder="Details"><?php if(isset($sample_request[0]->delivery_challan_details)) echo $sample_request[0]->delivery_challan_details ;?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <h4>Email Details</h4>
                  <div class="clearfix"></div>
                  <div id="email_details" class="col-md-6">
						Please select the supplier to load email details...
				  </div>
                  <br><br>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="form-line">
                           <input type="text" id="email_additional" name="email_additional" class="form-control" data-toggle="tooltip" title="Additional Email Ids" placeholder="Additional email ids (mail id 1,mail id 2,etc...) [optional] " > 
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="form-line">
                           <select  id="select_product_request_email_template" class="form-control custom-select" title="Product Request Template" required>
                              <option value="" selected>Select Template</option>
                              <?php  echo $this->Common_model->getOptionList('product_request_email_template'); ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6" style="display:none;" id="email_message_block">
                     <div class="form-group">
                        <div class="form-line">
                           <textarea id="email_message" name="email_message" class="form-control " title="" data-toggle="tooltip" rows="10" cols="30" placeholder="Message * " ><?php echo $email_message; ?></textarea>									
                        </div>
                     </div>
                  </div>
                  <div class="text-right" style="margin-right:15px;margin-bottom:15px;">
                     <button class="btn btn-primary" type="submit" value="save">Save</button>
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
<?php include('script_delivery_challan.php'); ?>
<style>
   #cke_1_top,#cke_1_bottom{display:none;}
</style>
<script>
   CKEDITOR.replace('email_message',{ height : 120 });
   //~ $(document).on('change','#select_supplier', function() {
   //~ var p_row_id = $(this).parent().parent().attr('id');
   //~ //alert(p_row_id	);
           //~ var id = $(this).val();
           //~ $.ajax({
               //~ type: 'POST',
               //~ dataType: 'json',
               //~ data:{table:'supplier_email_ids',field:'ref_supplier_id',id:id},
               //~ url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_supplier_email_details',
               //~ success: function(json) {
                   //~ var html = '';
                   //~ var i = 1;                    
                   //~ if (json) {
                       //~ $(json).each(function(index, value){
   			//~ html += '<input id="email_'+[i]+'" class="" type="checkbox" name="supplier_email[]" value="'+value['email_id']+'"></input><label for="email_'+[i]+'">'+value['email_id']+'</label><br>';
   			//~ i++;
                       //~ });
                   //~ }
                   //~ $('#email_details').html(html);
               //~ }
           //~ });
       //~ });
   
   $('#select_product_request_email_template').on('change',function() {
   var template_id = $(this).val();
   var dc_id = '<?php echo $res;?>';
   //var sample_request_id = $('#sample_id').val();
   //alert(dc_id);
   if(template_id){
   $.ajax({
   type: 'POST',
   dataType:'json',
   url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/update_message_template',
   data:{
      template_id:template_id
      },
   success: function(html) {
   $("#email_message").html(html);
   //alert(html);
   CKEDITOR.instances['email_message'].setData(html);
   $('#email_message_block').slideDown();
   }
   });	
   }else{
   alert('Please select email template...');
   }
   });
     
</script>
