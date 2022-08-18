<div class="modal fade" id="popup_add_patient" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="largeModalLabel">Add New Patient</h4>
                <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
            </div>
            <div class="modal-body"> 
				<div class="msg"></div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" id="patient_name" placeholder = "Name" autofocus> 
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
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
								<input class="form-control" type="text"  id="patient_age" placeholder = "Age" onkeypress="return isNumber(event)">
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text"  id="patient_mobile" placeholder = "Mobile" onkeypress="return isNumber(event)">
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" id="patient_address_1" placeholder = "Address Line 1" autofocus> 
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" id="patient_address_2" placeholder = "Address Line 2" autofocus> 
							</div>
						</div>
					</div>


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
								<input class="form-control" type="text"  id="patient_pincode" placeholder = "Pincode" onkeypress="return isNumber(event)">
							</div>
						</div>
					</div>

					 <div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text"  id="patient_gst" placeholder = "GST No" >
							</div>
						</div>
					</div>



					</div>
			</div>
            <div class="modal-footer">
               <a class="btn btn-primary pull-right" id="insert_patient">Save</a>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).on("click", "#insert_patient", function(){
	   var patient_name = $('#patient_name').val();
	   var gender = $("input[name='gender']:checked").val();
	   var patient_age = $("#patient_age").val();
	   var patient_mobile = $("#patient_mobile").val();
	   var patient_address_1 = $("#patient_address_1").val();
	   var patient_address_2 = $("#patient_address_2").val();
	   var patient_pincode = $("#patient_pincode").val();
	   var patient_state = $("#select_state").val();
	   var patient_district = $("#select_district").val();
	   var patient_gst = $("#patient_gst").val();
	   if (patient_name == '')
	   {
		   $('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill all the fields...</strong></div>').fadeIn('slow');
	   }
	   else
	   {
		  $.ajax(
		  {
			 type: 'POST',
			 dataType: 'json',
			 url: '<?php echo base_url(); ?>index.php/invoice/add_patient',
			 data:{patient_name:patient_name,gender:gender,mobile:patient_mobile,age:patient_age,patient_address_line1:patient_address_1,patient_address_line2:patient_address_2,ref_state_id:patient_state,ref_district_id:patient_district,pincode:patient_pincode,gst_no:patient_gst},
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
                        if (value['name'] == patient_name) {
                            html += '<option value = "' + value['id'] + '" selected="selected">' + value['name'] + '</option>';
                        } else {
                            html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
                        }
                    });
                    $("#select_patient").html(html);
				   $('.msg').html('<div role="alert" class="alert alert-success alert-dismissible black  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
				   //$('.success_msg').html('Successfully Added').fadeIn('slow');
				   clearModalPopup();
				  // $("#popup_patient").modal('hide');
				}
			 }
		  });
	   }
	});
            
</script>
