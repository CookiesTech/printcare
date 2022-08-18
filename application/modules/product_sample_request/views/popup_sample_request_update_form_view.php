<!-- Large Size -->
<div class="modal fade" id="popup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="largeModalLabel">Update Sample Request</h4>
            <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
         </div>
         <div class="modal-body">
            <div class="success_msg"></div>
            <input type="hidden" value="" id="product_sample_request_id">
            <form>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Client Name</label>
                        <div class="col-md-7">
                           <span id="client_name"></span>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Supplier</label>
                        <div class="col-md-7">
                           <span id="supplier_name"></span>
                        </div>
                     </div>
                  </div>
                 <!-- <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Product</label>
                        <div class="col-md-7">
                           <div id="product_name"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Quantity</label>
                        <div class="col-md-7">
                           <div id="quantity"></div>
                        </div>
                     </div>
                  </div>-->
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Request Date</label>
                        <div class="col-md-7">
                           <div id="request_date"></div>
                        </div>
                     </div>
                  </div>
                 <!-- <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Delivery Point</label>
                        <div class="col-md-7">
                           <select name="ref_delivery_point_id" id="select_delivery_point" class="form-control" required>
                              <option value="" disabled selected>--select--</option>
                              <?php // echo $this->Common_model->getOptionList('delivery_point'); ?>
                           </select>
                        </div>
                     </div>
                  </div>-->
                  <!--<div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Dispatch Date</label>
                        <div class="col-md-7">
                           <input type ="text" name="dispatch_date" class="datetimepicker form-control" >
                        </div>
                     </div>
                  </div>-->
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Delivered Date</label>
                        <div class="col-md-7">
                           <input type ="text" name="delivered_date" class="datetimepicker form-control" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Installation Date</label>
                        <div class="col-md-7">
                           <input type ="text" name="installation_date" class="datetimepicker form-control" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="control-label text-right col-md-5">Reminder Date</label>
                        <div class="col-md-7">
                           <input type ="text" name="reminder_date" class="datetimepicker form-control" >
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <div class="clearfix"></div>
            <img class="spinner" style="display:none;float:right;" src="<?php echo asset_url(); ?>/images/ajax-loader.gif">
            <button class="add_policy_update btn btn-success" id="add_sample_request_update">Save</button>
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
     $('.update_delivery_details').on('click', function() {
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
                         $("#popup").modal('show');
                         $('#product_sample_request_id').val(value['product_sample_request_id']);
                         $('#client_name').html(value['client_name']);
                         $('#supplier_name').html(value['supplier_name']);
                         $('#product_name').html(value['product_name']);
                         $('#quantity').html(value['quantity']);
                         $('#request_date').html(value['request_date']);
                     });
                 } else {
                     alert('empty result');
                 }
             }
         });
     });
     $('#add_sample_request_update').on('click', function() {
         if ($(this).attr('id') != undefined) {
             var product_sample_request_id = $('#product_sample_request_id').val();
             var ref_delivery_point_id = $('#select_delivery_point').val();
             var delivered_date = $('input[name=delivered_date]').val();
             var installation_date = $('input[name=installation_date]').val();
             var reminder_date = $('input[name=reminder_date]').val();
             if (product_sample_request_id != '' && ref_delivery_point_id != '' && dispatch_date != '' && delivered_date != '' && installation_date != '' && reminder_date != '') {
                 $(".add_policy_update").removeAttr('id');
                 $.ajax({
                     type: 'POST',
                     data: {
                         product_sample_request_id: product_sample_request_id,
                         ref_delivery_point_id: ref_delivery_point_id,
                         delivered_date: delivered_date,
                         installation_date: installation_date,
                         reminder_date: reminder_date
                     },
                     dataType: 'json',
                     url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/update_sample_request',
                     success: function(json) {
                         if (json == 'true') {
                             $('.success_msg').html('<div role="alert" class="alert alert-success alert-dismissible black "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
                             clearModalPopup();
                             window.location.reload();
                         }
                     }
                 });
             } else {
                 $('.success_msg').html('<div role="alert" class="alert alert-danger alert-dismissible "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill the required fields...</strong></div> ').fadeIn('slow');
             }
         }
     });
 });
</script>
