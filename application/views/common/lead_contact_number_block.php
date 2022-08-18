<div class="card">
   <div id="contact_details" class="contact_details">
      <div class="header">
         <h2>Contact Numbers</h2> </div>
      <div class="body">
         <?php if(isset($lead_contact_numbers ) && !empty($lead_contact_numbers )){ ?>
         <?php $i=1; foreach($lead_contact_numbers  as $key=> $contact_number){ ?>
         <div class="contact_block clearfix" id="<?php echo $i; ?>">
            <div class="table-responsive">
				
				
				<div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							<input type="text" class="form-control" name="tbl_lead_contact_number[<?php echo $i; ?>][contact_person]" value="<?php echo $contact_number->contact_person; ?>" placeholder="Contact Person" required> 
						</div>
					</div>
				</div>
				
				<div class="col-md-3">
					<select name="tbl_lead_contact_number[<?php echo $i; ?>][ref_designation_id]" class="form-control">
						<?php echo $designation_block = $this->Common_model->getOptionList('designation',$contact_number->ref_designation_id); ?>
                   </select>
               </div>
				
				<div class="col-md-2">
					<select name="tbl_lead_contact_number[<?php echo $i; ?>][ref_contact_number_type_id]" class="form-control">
					 <?php echo $contact_number_type_block = $this->Common_model->getOptionList('contact_number_type',$contact_number->ref_contact_number_type_id); ?>
          
                  </select>
               </div>
               
				<div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" maxlength="12" type="text" name="tbl_lead_contact_number[<?php echo $i; ?>][contact_number]" value="<?php if($contact_number->contact_number) echo $contact_number->contact_number; ?>" placeholder="Number" onkeypress="return isNumber(event)" required>
						</div>
					</div>
				</div>
				
				<div class="col-md-1">
					 <?php if($i=='1' ){ ?> <a title="Add" data-toggle="tooltip" class="add_contact btn  btn-info pull-right"><i class="fa fa-plus"></i></a>
					  <?php }else{ ?> <a title="Delete" data-toggle="tooltip" class="remove_number btn btn-danger pull-right"><i class="fa fa-trash-o"></i></a>
					  <?php } ?>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="tbl_lead_contact_number[<?php echo $i; ?>][contact_extension]" value="<?php if($contact_number->contact_extension) echo $contact_number->contact_extension; ?>" placeholder="Extension">
						</div>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="tbl_lead_contact_number[<?php echo $i; ?>][contact_timing_from]" value="<?php echo $contact_number->contact_timing_from; ?>" placeholder="Timing From" class="timepicker form-control">
						</div>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="tbl_lead_contact_number[<?php echo $i; ?>][contact_timing_to]" value="<?php echo $contact_number->contact_timing_to; ?>" placeholder="Timing To" class="timepicker form-control">
						</div>
					</div>
				</div>
               
               <div class="col-md-2">
                  <?php if($contact_number->primary_contact == '1'){ ?>
                  <input type="radio" class="contact_number_primary" checked name="tbl_lead_contact_number[<?php echo $i; ?>][primary_contact]" value="1">
                  <?php }else{ ?>
                  <input type="radio" class="contact_number_primary" name="tbl_lead_contact_number[<?php echo $i; ?>][primary_contact]" value="1">
                  <?php } ?> Primary Contact </div>
            </div>
         </div>
         
         <?php $i++; } }else{ ?>
         <div class="contact_block" id="1">
            <div class="table-responsive">
              
               
               <div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="tbl_lead_contact_number[1][contact_person]" placeholder="Contact Person" required> 
						</div>
					</div>
				</div>
				
				<div class="col-md-3">
                  <select class="form-control" name="tbl_lead_contact_number[1][ref_designation_id]" id="select_designation" required style="width:80%;float:left;">
                     <?php echo $designation_block = $this->Common_model->getOptionList('designation',''); ?>
					</select>
					<a class="js-open-modal btn btn-info" id="designation" Alt="Add New Designation" style="margin-left:9px;"><i class="fa fa-plus"></i></a> 
				</div>
				
				<div class="col-md-2">
					<select class="form-control" name="tbl_lead_contact_number[1][ref_contact_number_type_id]" required>
						<?php echo $contact_number_type_block = $this->Common_model->getOptionList('contact_number_type',''); ?>						
					</select>
               </div>
				
               <div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" maxlength="12" type="text" name="tbl_lead_contact_number[1][contact_number]" id="LeadNumber" placeholder="Contact Number" onkeypress="return isNumber(event)" required> 
						</div>
					</div>
				</div>
				<div class="col-md-1"> 
					 <a title="Add" data-toggle="tooltip" class="add_contact btn btn-info pull-right"><i class="fa fa-plus"></i></a> 
				</div>
				
               <div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="tbl_lead_contact_number[1][contact_extension]" placeholder="Extension"> 
						</div>
					</div>
				</div>
				
               <div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="tbl_lead_contact_number[1][contact_timing_from]" class="timepicker form-control" placeholder="Timing From"> 
						</div>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="tbl_lead_contact_number[1][contact_timing_to]" class="timepicker form-control" placeholder="Timing To"> 
						</div>
					</div>
				</div>
				
               <div class="col-md-2">
                  <input type="radio" class="contact_number_primary" name="tbl_lead_contact_number[1][primary_contact]" value="1" checked> Primary Contact 
			  </div>
              
            </div>
         </div>
         <?php } ?> </div>
   </div>
</div>
<script>
   designationNew = '';
   $(document).ready(function() {
      $('.add_contact').on('click', function() {
         var row_id = parseInt($('#contact_details .contact_block:last').attr('id')) + 1;
         if (designationNew != '') {
            designation = designationNew;
         }
         else {
            designation = '<?php echo $designation_block; ?>';
         }
         var contact_number_type_block = '<?php echo $contact_number_type_block; ?>';
         
         $('#contact_details .contact_block:last').after('<div class="clearfix contact_block" id=' + row_id + '><div class=""><div class="col-md-3"><div class="form-group"><div class="form-line"><input class="form-control" type="text" name="tbl_lead_contact_number[' + row_id + '][contact_person]" placeholder = "Contact Person" required></div></div></div><div class="col-md-3"><select required class="form-control" name="tbl_lead_contact_number[' + row_id + '][ref_designation_id]">' + designation + '</select></div><div class="col-md-2"><select name="tbl_lead_contact_number[' + row_id + '][ref_contact_number_type_id]" class="form-control">'+contact_number_type_block+'</select></div><div class="col-md-3"><div class="form-group"><div class="form-line"><input class="form-control" type="text" maxlength="12" name="tbl_lead_contact_number[' + row_id + '][contact_number]" placeholder = "Contact Number" onkeypress="return isNumber(event)" required></div></div></div><div class="col-md-1"><a title="Delete" data-toggle="tooltip" class="pull-right remove_number btn btn-danger"><i class="fa fa-trash-o"></i></a></div><div class="clearfix"></div><div class="col-md-2"><div class="form-group"><div class="form-line"><input class="form-control" type="text" name="tbl_lead_contact_number[' + row_id + '][contact_extension]" placeholder = "Contact Extension"></div></div></div><div class="col-md-2"><div class="form-group"><div class="form-line"><input class="timepicker form-control" type="text" name="tbl_lead_contact_number[' + row_id + '][contact_timing_from]"  placeholder = "Contact Timing From"></div></div></div><div class="col-md-2"><div class="form-group"><div class="form-line"><input class="form-control timepicker" type="text" name="tbl_lead_contact_number[' + row_id + '][contact_timing_to]" placeholder = "Contact Timing To"></div></div></div><div class="col-md-2"><input type="radio" class="contact_number_primary" name="tbl_lead_contact_number[' + row_id + '][primary_contact]" value="1" > Primary Contact</div></div></div>');
         $('.timepicker').timepicker();
      });
      $(document).on('click', '.remove_number', function() {
         $(this).closest('.contact_block').remove();
      });
   });
</script>
