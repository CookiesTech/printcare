<div class="modal fade" id="popup_add_customer" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="largeModalLabel">Add New Customer</h4>
                <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
            </div>
            <div class="modal-body"> 
				<div class="msg"></div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" id="customer_name" placeholder = "Name" autofocus> 
							</div>
						</div>
					</div>
					
					<!-- <div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input type="radio" class="gender" value="male" name="gender" checked="checked"> Male
								<input type="radio" class="gender" value="female" name="gender"> Female
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text"  id="customer_age" placeholder = "Age" onkeypress="return isNumber(event)">
							</div>
						</div>
					</div> -->

					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text"  id="customer_mobile" placeholder = "Mobile" onkeypress="return isNumber(event)">
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" id="address" placeholder = "Address"> 
							</div>
						</div>
					</div>

					<!-- <div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" id="customer_address_2" placeholder = "Address Line 2" autofocus> 
							</div>
						</div>
					</div>
 -->

                    <div class="col-md-6">
						<div class="form-group">
							<div class="form-line">
                              <select name="ref_state_id" id="select_state" class="form-control custom-select" required>
                                 <option value="" disabled selected>State</option>
                                 <?php 
                                    echo $this->Common_model->getOptionList('state','1503','ref_country_id','99'); 
                                    ?>
                              </select>
                           </div>
                        </div>
                    </div>

                    <div class="col-md-6">
						<div class="form-group">
							<div class="form-line">
                              <select name="ref_district_id"  class="form-control custom-select" id="select_district">
                                 <option value="" disabled selected>District</option>
                                 <?php 
                                 	$branch_id = $this->session->userdata(SESSION_LOGIN . 'branch_id');
                                 	if($branch_id && $branch_id == 1)
                                 		echo $this->Common_model->getOptionList('district','516','ref_state_id','1503'); 
                                 	else
                                 		echo $this->Common_model->getOptionList('district','541','ref_state_id','1503'); 

                                 	?>
                              </select>
                           </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text"  id="pincode" placeholder = "Pincode" onkeypress="return isNumber(event)">
							</div>
						</div>
					</div>

					 <div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text"  id="customer_gst" placeholder = "GST No" >
							</div>
						</div>
					</div>



					</div>
			</div>
            <div class="modal-footer">
               <a class="btn btn-primary pull-right" id="insert_customer">Save</a>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).on("click", "#insert_customer", function(){
	   var customer_name = $('#customer_name').val();
	  // var gender = $("input[name='gender']:checked").val();
	   //var customer_age = $("#customer_age").val();
	   var customer_mobile = $("#customer_mobile").val();
	   var customer_address = $("#address").val();
	  // var customer_address_2 = $("#customer_address_2").val();
	   var customer_pincode = $("#customer_pincode").val();
	   var customer_state = $("#select_state").val();
	   var customer_district = $("#select_district").val();
	   var customer_gst = $("#customer_gst").val();
	   if (customer_name == '')
	   {
		   $('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill all the fields...</strong></div>').fadeIn('slow');
	   }
	   else
	   {
		  $.ajax(
		  {
			 type: 'POST',
			 dataType: 'json',
			 url: '<?php echo base_url(); ?>index.php/invoice/add_customer',
			 data:{customer_name:customer_name,mobile:customer_mobile,address:customer_address,ref_state_id:customer_state,ref_district_id:customer_district,pincode:customer_pincode,customer_gst_no:customer_gst},
			 success: function(json)
			 {
				if (json == 'exist')
				{
				   $('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Category already exist...</strong></div>').fadeIn('slow');
				}
				else
				{
				    var html = '';
                    $(json).each(function(index, value) {
                        //if (value['name'] == customer_name) {
                        if (value['prev_id'] == value['id']) {
                            html += '<option value = "' + value['id'] + '" selected="selected">' + value['name'] + '</option>';
                        } else {
                            html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
                        }
                    });
                    $("#select_customer").html(html);
				   $('.msg').html('<div role="alert" class="alert alert-success alert-dismissible black  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
				   //$('.success_msg').html('Successfully Added').fadeIn('slow');
				   clearModalPopup();
				  // $("#popup_customer").modal('hide');
				}
			 }
		  });
	   }
	});
            
</script>
