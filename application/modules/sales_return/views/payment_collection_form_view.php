<div class="container-fluid">
   <div class="row">
       

      <div class="col-lg-12">
      	<?php if(isset($_SESSION['success_msg'])){ ?>
         <div role="alert" class="alert alert-success black alert-dismissible"> 
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
         <div role="alert" class="alert alert-danger alert-dismissible"> 
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
               <h4 class="m-b-0 text-white">Payment Collection</h4>
            </div>
            <div class="card-body">
               <form id="cargo_bookings" action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                 
                  <div class="row">
                     <div class="col-md-4">
                     <div class="col-md-12">
                        <div class="form-group row">
                           <div class="col-md-12">
                              <select name="ref_invoice_id" id="select_invoice_no" class="form-control custom-select" required>
                                 <option value="">Select Invoice No</option>
                                 <?php echo $this->Common_model->getOptionList('invoice','','invoice_payment_status','0'); ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="form-group row">
                           <div class="col-md-12">
                              <input type="text" name="invoice_payment_date" placeholder="Enter Payment Date" class="form-control datepicker"> 
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="form-group row">
                           <div class="col-md-12">
                              <select name="ref_payment_type_id" class="form-control custom-select" required>
                                 <?php echo $this->Common_model->getOptionList('payment_type','1'); ?>
                              </select>
                           </div>
                        </div>
                     </div>

                      
                      <div class="col-md-12">
                        <div class="form-group row">
                           <div class="col-md-12">
                              <input type="text" id="invoice_payment_amount" name="invoice_payment_amount" placeholder="Enter Amount" onkeypress="return isNumber(event)" required class="form-control"> 
                           </div>
                        </div>
                     </div>
                     
                      <div class="col-md-12">
                        <div class="form-group row">
                           <div class="col-md-12">
                              <textarea rows="3" name="invoice_payment_details" placeholder="Enter Payment Details" class="form-control"></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="text-right">
                        <button class="btn btn-success" type="submit" value="save">Update Payment</button>
                        <a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-danger">Cancel</a>
                     </div>
                  </div>


                     <div id="invoice_details" class="col-md-8">
                        
                     </div>
                  <br>                
                  <!-- <div class="text-right">
                     <button class="btn btn-success" type="submit" value="save">Save</button>
                     <a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-danger">Cancel</a>
                  </div> -->
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>	 
<script type="text/javascript">

	$(document).ready(function(){
		$('#select_invoice_no').select2();
	});
  
   $(document).on('change','#select_invoice_no',function() {
      var invoice_id = $(this).val();
      if(invoice_id!=''){
         $.ajax({
           url: '<?php echo base_url(); ?>index.php/invoice/ajax/get_invoice_details',
           type: 'POST',
           data:{invoice_id:invoice_id},
           dataType: 'html',
           success: function(html){
                if(html != ''){
                   $('#invoice_details').html(html);
                   $('#ref_invoice_id').val($('#invoice_id').val());
                }
               }
           });
        }
   });

   $('#invoice_payment_amount').on('keyup',function(){
   	var org_amount = $('#invoice_total').val();
   	var eneterd_amount = $(this).val();
   	if(parseInt(eneterd_amount) > parseInt(org_amount)){
   		alert('Amount exceed!');
   		$('#invoice_payment_amount').val('');
   	}
   });

</script>
