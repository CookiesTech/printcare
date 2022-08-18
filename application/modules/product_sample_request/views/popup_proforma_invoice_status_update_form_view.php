<!-- Large Size -->
<div class="modal fade" id="proforma_invoice_status_popup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="largeModalLabel">Update Proforma Invoice Status</h4>
            <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
         </div>
         <div class="modal-body">
            <div class="success_msg"></div>
            <input type="hidden" value="" id="proforma_invoice_id">
            <form>
               <div class="row">
				     <div class="col-md-12">
						 <div class="form-group row">
							<label class="control-label text-right col-md-5">Client</label>
							<div class="col-md-7">
								<span id="client_name"></span>
							</div>	
						</div>	
					</div>	
				     <div class="col-md-12">
						 <div class="form-group row">
							<label class="control-label text-right col-md-5">Proforma Inv.No </label>
							<div class="col-md-7">
								<span id="proforma_invoice_code"></span>
							</div>	
						</div>	
					</div>	
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Status</label>
                        <div class="col-md-7">
                           <select name="ref_proforma_invoice_status_id" id="proforma_invoice_status_id" class="form-control custom-select" required>
                              <option value="" disabled selected>Select</option>
                              <?php 
                                 echo $this->Common_model->getOptionList('proforma_invoice_status'); 
                                 ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">PO Date</label>
                        <div class="col-md-7">
                           <input type="text" name="invoice_date" id="invoice_date" class="datepicker form-control">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">PO No</label>
                        <div class="col-md-7">
                           <input type="text" name="invoice_no" id="invoice_no" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Details</label>
                        <div class="col-md-7">
                           <textarea name="details" id="details"rows="2" cols="30" class="form-control"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <div class="clearfix"></div>
            <img class="spinner" style="display:none;float:right;" src="<?php echo asset_url(); ?>/images/ajax-loader.gif">
            <button class="add_proforma_invoice_status btn btn-success" id="update_proforma_invoice_status">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>



<script>
	$(function() {
    $('.update_proforma_invoice_status').on('click', function() {
        $('#proforma_invoice_id').val($(this).attr('id'));
    });
    $('.update_proforma_invoice_status').on('click', function() {
        $(".add_proforma_invoice_status").attr('id', 'add_proforma_invoice_status');
        var proforma_invoice_id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            data: {
                proforma_invoice_id: proforma_invoice_id
            },
            dataType: 'json',
            url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_proforma_invoice',
            success: function(json) {
                if (json) {
                    $(json).each(function(index, value) {
                        $("#proforma_invoice_status_popup").modal('show');
                        $('#client_name').html(value['client_name']);
                        $('#proforma_invoice_code').html(value['proforma_invoice_code']);
                    });
                    $('#proforma_invoice_status_popup').modal('show');
                } else {
                    alert('empty result');
                }
            }
        });
    });
    $('#update_proforma_invoice_status').on('click', function() {
        if ($(this).attr('id') != undefined) {
            var proforma_invoice_id = $('#proforma_invoice_id').val();
            var proforma_invoice_status_id = $('#proforma_invoice_status_id').val();
            var invoice_date = $('#invoice_date').val();
            var invoice_no = $('#invoice_no').val();
            var details = $('#details').val();
            if (proforma_invoice_id != '') {
                $.ajax({
                    type: 'POST',
                    data: {
                        proforma_invoice_id: proforma_invoice_id,
                        ref_proforma_invoice_status_id: proforma_invoice_status_id,
                        invoice_date: invoice_date,
                        invoice_no: invoice_no,
                        details: details
                    },
                    dataType: 'json',
                    url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/update_proforma_invoice_status',
                    success: function(json) {
                        if (json == 'true') {
                            $('.success_msg').html('<div role="alert" class="alert alert-success alert-dismissible black "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
                            clearModalPopup();
                            window.location.reload();
                        }
                   
                    }
                });
            } else {
                //alert('Please fill the required fields...');
                $('.success_msg').html('<div role="alert" class="alert alert-danger alert-dismissible "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill the required fields...</strong></div> ').fadeIn('slow');
            }
        }
    });
});
</script>


