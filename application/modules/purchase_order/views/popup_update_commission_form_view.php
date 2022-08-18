<!-- Large Size -->
<div class="modal fade" id="commission_popup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="largeModalLabel">Update Commission Details</h4>
            <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
         </div>
         <div class="modal-body">
            <div class="success_msg"></div>
            <input type="hidden" id="poc_purchase_order_id">
            <form>
               <div class="row">
				   <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Order No</label>
                        <div class="col-md-7">
                           <div id="poc_purchase_order_code"></div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Date</label>
                        <div class="col-md-7">
                           <div id="poc_purchase_order_date"></div>
                        </div>
                     </div>
                  </div>
                  
                  
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Client Name</label>
                        <div class="col-md-7">
                           <span id="poc_client_name"></span>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Supplier</label>
                        <div class="col-md-7">
                           <span id="poc_supplier_name"></span>
                        </div>
                     </div>
                  </div>
               

                
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Commission Date</label>
                        <div class="col-md-7">
                           <input type ="text" id="invoice_commission_date" class="datepicker form-control" value="<?php echo date('d-m-Y'); ?>">
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Amount</label>
                        <div class="col-md-7">
                           <input type ="text" name="invoice_commission_amount" class="form-control" onkeypress="return isNumber(event)">
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Details</label>
                        <div class="col-md-7">
                           <textarea  name="invoice_commission_details" class="form-control" rows="2"></textarea>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Close Payment</label>
                        <div class="col-md-7">
                           <input type="checkbox"  name="invoice_commission_status" value="1" id="invoice_commission_status"><label for="invoice_commission_status"></label>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <div class="clearfix"></div>
            <img class="spinner" style="display:none;float:right;" src="<?php echo asset_url(); ?>/images/ajax-loader.gif">
            <button class="update_commission btn btn-success" id="update_commission">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script>
   $(function(){
   	$('.update_commission_details').on('click',function(){
   		$('#poc_purchase_order_id').val ($(this).attr('id'));
   	});
   	
   	
   $('.update_commission_details').on('click',function(){
   		$(".update_commission" ).attr('id','update_commission');
   			var purchase_order_id = $(this).attr('id');
   			$.ajax({
   				type: 'POST',
   				data: {purchase_order_id:purchase_order_id},
   				dataType:'json',
   				url: '<?php echo base_url(); ?>index.php/purchase_order/ajax/get_purchase_order',
   				success: function(json) {
   					if(json){
						var html = '<ul>';
						$( json).each(function( index, value ) {
							$("#commission_popup").modal('show');							
							$('#poc_purchase_order_code').html(value['purchase_order_code']);
							$('#poc_client_name').html(value['client_name']);								
							$('#poc_supplier_name').html(value['supplier_name']);		
							$('#poc_purchase_order_date').html(value['purchase_order_date']);	
						});
					}else{
						alert('empty result');
					}
   				}
   			});
   	});
   	
   	
   $('#update_commission').on('click',function(){   
      if($(this).attr('id') !=undefined){
		   var purchase_order_id = $('#poc_purchase_order_id').val();  
		   var invoice_commission_date = $('#invoice_commission_date').val();  
		   var invoice_commission_details = $('textarea[name=invoice_commission_details]').val();
		   var invoice_commission_amount = $('input[name=invoice_commission_amount]').val();
		   var invoice_commission_status = $('input[name=invoice_commission_status]:checked').val();
		   					
		   if(purchase_order_id !='' && invoice_commission_date !='' && invoice_commission_details) {
			   $(".update_commission" ).removeAttr('id');		
			   $.ajax({
				   type: 'POST',
				   data: {
						purchase_order_id:purchase_order_id,
						invoice_commission_date:invoice_commission_date,
						invoice_commission_amount:invoice_commission_amount,
						invoice_commission_details:invoice_commission_details,						
						invoice_commission_status:invoice_commission_status						
						},
				   dataType:'json',
				   url: '<?php echo base_url(); ?>index.php/purchase_order/ajax/update_commission_details',
				   success: function(json) {
					   if(json == 'true'){
							$('.success_msg').html('<div role="alert" class="alert alert-success alert-dismissible black "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
							clearModalPopup();
							window.location.reload();
						}
					}
				});
				}else{					
					$('.success_msg').html('<div role="alert" class="alert alert-danger alert-dismissible "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill the required fields...</strong></div> ').fadeIn('slow');
				}
   		}
   	});	
   });		
</script>
