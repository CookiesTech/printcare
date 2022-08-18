<!-- Large Size -->
<div class="modal fade" id="commission__history_popup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="largeModalLabel">Commission History</h4>
            <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
         </div>
         <div class="modal-body" id="modal_body_poch">
               <input type="hidden" id="poch_purchase_order_id">     
         </div>
         <div class="modal-footer">
            <div class="clearfix"></div>
                        
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script>
   $(function(){
   	$('.commission_history').on('click',function(){
   		$('#poch_purchase_order_id').val ($(this).attr('id'));
   	});
   	   	
   $('.commission_history').on('click',function(){
   			var purchase_order_id = $(this).attr('id');
   			$.ajax({
   				type: 'POST',
   				data: {purchase_order_id:purchase_order_id},
   				dataType:'html',
   				url: '<?php echo base_url(); ?>index.php/purchase_order/ajax/get_invoice_commission_history',
   				success: function(html) {
   					if(html){
						$('#modal_body_poch').html(html);
						$("#commission__history_popup").modal('show');	
					}else{
						alert('empty result');
					}
   				}
   			});
   	});
});		
</script>
