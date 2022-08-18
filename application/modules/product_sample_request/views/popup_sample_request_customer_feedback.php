<!-- Large Size -->
<div class="modal fade" id="feedback_popup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="largeModalLabel">Update Customer Feedback</h4>
            <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
         </div>
         <div class="modal-body">
            <div class="success_msg"></div>
            <input type="hidden" value="" id="product_sample_request">
            <form>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Customer Feedback</label>
                        <div class="col-md-7">
                           <select name="ref_feedback_id" id="feedback_id" class="form-control custom-select" required>
                              <option value="" disabled selected>Select</option>
                              <?php 
                                 echo $this->Common_model->getOptionList('feedback'); 
                                 ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Customer Comments</label>
                        <div class="col-md-7">
                           <textarea name="client_feedback" id="client_feedback"rows="2" cols="30" class="form-control"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <div class="clearfix"></div>
            <img class="spinner" style="display:none;float:right;" src="<?php echo asset_url(); ?>/images/ajax-loader.gif">
            <button class="add_policy_update btn btn-success" id="sample_request_update">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>



<script>
	$(function() {
    $('.update_policy_claim').on('click', function() {
        $('#new_policy_claim_id').val($(this).attr('id'));
    });
    $('.update_feedback_details').on('click', function() {
        $(".add_policy_update").attr('id', 'add_policy_claim_update');
        var sample_id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            data: {
                sample_id: sample_id
            },
            dataType: 'json',
            url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_sample_request',
            success: function(json) {
                if (json) {
                    var html = '<ul>';
                    var policy_claim_name = '';
                    $(json).each(function(index, value) {
                        $("#feedback_popup").modal('show');
                        $('#product_sample_request').val(value['product_sample_request_id']);
                    });
                } else {
                    alert('empty result');
                }
            }
        });
    });
    $('#sample_request_update').on('click', function() {
        if ($(this).attr('id') != undefined) {
            var product_sample_request_id = $('#product_sample_request').val();
            var feedback = $('#client_feedback').val();
            var feedback_id = $('#feedback_id').val();
            if (product_sample_request_id != '') {
                $.ajax({
                    type: 'POST',
                    data: {
                        product_sample_request_id: product_sample_request_id,
                        feedback: feedback,
                        feedback_id: feedback_id
                    },
                    dataType: 'json',
                    url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/update_feedback',
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


