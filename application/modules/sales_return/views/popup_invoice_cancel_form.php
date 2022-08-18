<!-- Large Size -->
<div class="modal fade" id="invoice_cancel" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
             <form id="form" method="POST" action="<?= site_url('invoice/cancel_invoice') ?>">
            <div class="modal-header">
		<h4 class="modal-title" id="largeModalLabel">Cancel Bill</h4>
				<button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
                
            </div>
            <div class="modal-body"> 
				
				<div class="success_msg"></div>
					<input type="hidden" value="" name="ref_invoice_id" id="invoice_id">
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Invoice #</label>
								<div class="col-md-8">
									<div class="invoice_name"></div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Patient</label>
								<div class="col-md-8">
									<div class="patient_name"></div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Reason for cancel</label>
								<div class="col-md-8">
									<textarea  placeholder="Details" class="form-control" cols="30" rows="4" name="cancelled_reason"></textarea>
								</div>
							</div>
						</div>
					</div>
			   </div>
			   
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Save">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
            </form>
        </div>
    </div>
</div>

<script>
	$(function(){
		$('.cancel_invoice').on('click',function(){
			$('#invoice_id').val ($(this).attr('id'));
			$('.patient_name').html ($(this).data('patient_name'));
			$('.invoice_name').html ($(this).data('invoice_name'));
			$('#invoice_cancel').modal('show');
		});
		
	
		
		
		$('#add_remark').on('click',function(){
			if($(this).attr('id') !=undefined){
				var ref_client_id = $('#new_remark_client_id').val(); 
				var client_remark_date_and_time = $('.client_remark_date_and_time').val();
				var client_remark_type = $('input[name=client_remark_type]:checked').val(); 
				var client_remark_details = $('textarea[name=client_remark_details]').val();
				if(client_remark_details !='' && client_remark_type !=''){
					$(".add_new_remark" ).removeAttr('id');			
					$.ajax({
							type: 'POST',
							data: {ref_client_id:ref_client_id,client_remark_date_and_time:client_remark_date_and_time,client_remark_type:client_remark_type,client_remark_details:client_remark_details},
							dataType:'json',
							url: '<?php echo base_url(); ?>index.php/client/ajax/addClientRemark',
							success: function(json) {
								if(json == 'success'){
									$('.success_msg').html('<div role="alert" class="alert alert-success alert-dismissible black "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
									clearModalPopup();
									
								}
							}
					});
				}else{
					$('.success_msg').html('<div role="alert" class="alert alert-danger alert-dismissible "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill the required fields...</strong></div> ').fadeIn('slow');
					///alert('Please fill all the fields');
				}
			}
		});	
	});		
</script>

