<!-- Large Size -->
<div class="modal fade" id="popup_agent_details" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form">	
            <div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Client Details</h4>
				<button class="js-modal-close close" data-dismiss="modal" type="button">×</button>                
            </div>
            <div class="modal-body" id="body_content"></div>
            <div class="modal-footer">
				<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
			</div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function(){
		$('.js-open-modal').on('click',function(){
			$('#agent_id').val ($(this).attr('id'));
			$("#popup_appointment").modal('show');
		});
		
		$('.product_sample_request_details').on('click',function(){
		    //alert("1");
			var client_id = $(this).attr('id');
			$.ajax({
				type: 'POST',
				data: {client_id:client_id},
				dataType:'html',
				url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/view_client_details',
				success: function(html) {
					$("#body_content").html(html);
					$("#popup_agent_details").modal('show');
				}
			});
		});	
	});
</script>	
