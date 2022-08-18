<!-- Large Size -->
<div class="modal fade" id="popup_agent_details" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form">	
            <div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Supplier Details</h4>
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
		
		$('.supplier_details').on('click',function(){
		    //alert("1");
			var agent_id = $(this).attr('id');
			$.ajax({
				type: 'POST',
				data: {agent_id:agent_id},
				dataType:'html',
				url: '<?php echo base_url(); ?>index.php/supplier/ajax/view_supplier_details',
				success: function(html) {
					$("#body_content").html(html);
					$("#popup_agent_details").modal('show');
				}
			});
		});	
					
	});
</script>	
