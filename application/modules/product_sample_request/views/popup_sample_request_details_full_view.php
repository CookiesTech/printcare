<!-- Large Size -->
<div class="modal fade" id="full_view_popup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="largeModalLabel">Sample Request Details</h4>
            <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
         </div>
         <div class="modal-body">
            <div class="success_msg"></div>
            <input type="hidden" value="" id="product_sample_request_id">
            <form>
               <h4>Request Details</h4>
               <div class="row">
				   <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Date</label>
                        <div class="col-md-6">
                           <span id="request_date1"></span>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Client Name</label>
                        <div class="col-md-6">
                           <span id="client"></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Supplier</label>
                        <div class="col-md-6">
                           <span id="supplier"></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Product</label>
                        <div class="col-md-6">
                           <div id="product"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Quantity</label>
                        <div class="col-md-6">
                           <div id="req_quantity"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Details</label>
                        <div class="col-md-6">
                           <div id="request_details"></div>
                        </div>
                     </div>
                  </div>
                  
               </div>
               <h4>Delivery and Installation Details</h4>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Delivery Point</label>
                        <div class="col-md-6">
                           <div id="delivery_point"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Dispatch</label>
                        <div class="col-md-6">
                           <div id="dispatch_date"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Delivered</label>
                        <div class="col-md-6">
                           <div id="delivered_date"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Installation</label>
                        <div class="col-md-6">
                           <div id="installation_date"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Reminder</label>
                        <div class="col-md-6">
                           <div id="reminder_date"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <h4>Feedback Details</h4>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Feedback</label>
                        <div class="col-md-6">
                           <div id="feedback_name"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Comments</label>
                        <div class="col-md-6">
                           <div id="feedback"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-6">Status</label>
                        <div class="col-md-6">
                           <div id="status"></div>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
         </form>
      </div>
      <!--
         <div class="modal-footer">
         <div class="clearfix"></div>
             <img class="spinner" style="display:none;float:right;" src="<?php //echo asset_url(); ?>/images/ajax-loader.gif">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
         -->
   </div>
</div>
</div>
<script>
   $(function(){
   	$('.update_policy_claim').on('click',function(){
   		$('#new_policy_claim_id').val ($(this).attr('id'));
   	});
   	
   	
   $('.full_view_details').on('click',function(){
   		//$(".add_policy_update" ).attr('id','add_policy_claim_update');
   			var sample_id = $(this).attr('id');
   			//alert(sample_id);
   			$.ajax({
   				type: 'POST',
   				data: {sample_id:sample_id},
   				dataType:'json',
   				url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_sample_request_full_view',
   				success: function(json) {
   					if(json){
   					    
   					    
   var html = '<ul>';
   var policy_claim_name = '';
   $( json).each(function( index, value )
   {
     
   $("#full_view_popup").modal('show');							
   $('#product_sample_request_id').val(value['product_sample_request_id']);
   $('#client').html(value['client_name']);				
   $('#supplier').html(value['supplier_name']);		
   $('#product').html(value['product_name']);	
   $('#req_quantity').html(value['quantity']);
   $('#request_details').html(value['product_sample_request_details']);						
   $('#request_date1').text(value['request_date']);						
   $('#delivery_point').html(value['delivery_point']);					
   $('#dispatch_date').html(value['dispatch_date']);					
   $('#delivered_date').html(value['delivered_date']);			
   $('#installation_date').html(value['installation_date']);			
   $('#reminder_date').html(value['reminder_date']);					
   $('#feedback_name').html(value['feedback_name']);				
   $('#feedback').html(value['client_feedback']);
   if(value['status_id'] == '3'){
   htmls = '<span class="label label-success">'+value['status']+'</span>';
   }else if(value['status_id'] == '2'){
   htmls = '<span class="label label-info">'+value['status']+'</span>';
   }
   else if(value['status_id'] == '1'){
   htmls = '<span class="label label-warning">'+value['status']+'</span>';
   }
   $('#status').html(htmls);
   });
   
   }else{
   alert('empty result');
   }
   				}
   			});
   	});
   });		
</script>
