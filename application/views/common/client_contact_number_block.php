<h4 class="box-title">Contact Mobile<span title="Add" data-toggle="tooltip" class="add_contact btn btn-info pull-right"><i class="fa fa-plus"></i> Add More</span> </h4>
<hr class="m-t-0 m-b-40">
            <div id="contact_details" class="contact_details">
               <?php if(isset($contact_numbers) && !empty($contact_numbers)){ ?>
               <?php $i=1; foreach($contact_numbers as $key=> $contact_number){ ?>
               <div class="contact_block" id="<?php echo $i; ?>">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Contact Person</label>
                           <div class="col-md-8">
                              <input class="form-control" type="text" name="tbl_client_contact_numbers[<?php echo $i; ?>][contact_person]" value="<?php echo $contact_number->contact_person; ?>" placeholder="Contact Person"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Designation</label>
                           <div class="col-md-8">
                              <select name="tbl_client_contact_numbers[<?php echo $i; ?>][ref_designation_id]" class="form-control custom-select">
                              <?php 
								echo $designation_block = $this->Common_model->getOptionList('designation',$contact_number->ref_designation_id);
                              //~ if(isset($designation)){ $designation_block='' ; $designation_block.='<option value="" disabled>Designation</option>' ; foreach ( $designation as $key=> $val ) { if($val->designation_id == $contact_number->ref_designation_id){ $designation_block.= '<option value="'.$val->designation_id.'" selected>'.$val->designation_name.'</option>'; }else{ $designation_block.= '<option value="'.$val->designation_id.'">'.$val->designation_name.'</option>'; } } echo $designation_block; } 
                              ?> </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Contact Number Type</label>
                           <div class="col-md-8">
                              <select name="tbl_client_contact_numbers[<?php echo $i; ?>][ref_contact_number_type_id]" class="form-control custom-select">
                              <?php echo $contact_number_type_block = $this->Common_model->getOptionList('contact_number_type',$contact_number->ref_contact_number_type_id); ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Number</label>
                           <div class="col-md-8">
                              <input class="form-control" type="text" name="tbl_client_contact_numbers[<?php echo $i; ?>][contact_number]" value="<?php echo $contact_number->contact_number; ?>" placeholder="Number" onkeypress="return isNumber(event)"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Extension</label>
                           <div class="col-md-8">
                              <input class="form-control" maxlength="12" type="text" name="tbl_client_contact_numbers[<?php echo $i; ?>][contact_extension]" value="<?php if($contact_number->contact_extension) echo $contact_number->contact_extension; ?>" placeholder="Extension"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Timing From</label>
                           <div class="col-md-8">
                              <input type="text" name="tbl_client_contact_numbers[<?php echo $i; ?>][contact_timing_from]" value="<?php echo $contact_number->contact_timing_from; ?>" placeholder="Timing From" class="timepicker form-control"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Timing To</label>
                           <div class="col-md-8">
                              <input type="text" name="tbl_client_contact_numbers[<?php echo $i; ?>][contact_timing_to]" value="<?php echo $contact_number->contact_timing_to; ?>" placeholder="Timing To" class="timepicker form-control"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label class="control-label text-right col-md-4">Primary Contact </label>
                           <div class="col-md-8">
                              <?php if($contact_number->primary_contact == '1'){ ?>
                              <input type="radio" class="contact_number_primary" checked name="tbl_client_contact_numbers[<?php echo $i; ?>][primary_contact]" value="<?php echo $i; ?>">
                              <?php }else{ ?>
                              <input type="radio" class="contact_number_primary" name="tbl_client_contact_numbers[<?php echo $i; ?>][primary_contact]" value="1">
                              <?php } ?> Primary Contact 
                           </div>
                        </div>
                     </div>
                     <div style="float:right;" class="col-md-12">
                        <?php if($i=='1' ){ ?> <span title="Add" data-toggle="tooltip" class="add_contact btn btn-info pull-right"><i class="fa fa-plus"></i></span>
                        <?php }else{ ?> <span title="Delete" data-toggle="tooltip" class="remove_number btn btn-danger pull-right"><i class="fa fa-trash-o"></i></span>
                        <?php } ?>
                     </div>
                     </div>
                     </div>
                     <?php $i++; } } else {?>
                     <div class="clearfix"></div>
                     <div class="contact_block" id="1">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Contact Person</label>
                                 <div class="col-md-8">
                                    <input class="form-control contact_person" type="text" name="tbl_client_contact_numbers[1][contact_person]" placeholder="Contact Person"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Designation</label>
                                 <div class="col-md-8">
                                    <select name="tbl_client_contact_numbers[1][ref_designation_id]" id="select_designation" class="form-control custom-select" style="width:83%;float:left;">
                                    <?php 
                                    echo $designation_block = $this->Common_model->getOptionList('designation');
                                    
                                    //~ if(isset($designation)){ $designation_block='' ; $designation_block.='<option value="" disabled selected>Designation</option>' ; foreach ( $designation as $key=> $val ) { $designation_block.= '<option value="'.$val->designation_id.'">'.$val->designation_name.'</option>'; } echo $designation_block; } 
                                    ?> 
                                    </select>
                                    <span class="js-open-modal btn btn-info" id="designation" style="margin-left:9px;" alt="Add New Designation"><i class="fa fa-plus"></i></span> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Contact Number Type</label>
                                 <div class="col-md-8">
                                    <select name="tbl_client_contact_numbers[1][ref_contact_number_type_id]" class="form-control custom-select">
                                    <?php echo $contact_number_type_block = $this->Common_model->getOptionList('contact_number_type',''); ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Number</label>
                                 <div class="col-md-8">
                                    <input class="form-control client_number" id="client_contact_number_1" maxlength="12" type="text" name="tbl_client_contact_numbers[1][contact_number]"  placeholder="Number" onkeypress="return isNumber(event)"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Extension</label>
                                 <div class="col-md-8">
                                    <input class="form-control" type="text" name="tbl_client_contact_numbers[1][contact_extension]" placeholder="Extension"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Timing From</label>
                                 <div class="col-md-8">
                                    <input type="text" name="tbl_client_contact_numbers[1][contact_timing_from]" class="timepicker form-control" placeholder="Timing From"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Timing To</label>
                                 <div class="col-md-8">
                                    <input type="text" name="tbl_client_contact_numbers[1][contact_timing_to]" class="timepicker form-control" placeholder="Timing To"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Primary Contact</label>
                                 <div class="col-md-8">
                                    <input type="radio" class="contact_number_primary" name="tbl_client_contact_numbers[1][primary_contact]" value="1" checked> Primary Contact 
                                 </div>
                              </div>
                           </div>
                           <!--<div class="col-md-12" style="float:right;"> 
                              <span title="Add" data-toggle="tooltip" class="add_contact btn btn-info pull-right"><i class="fa fa-plus"></i></span> 
                           </div>-->
                        </div>
                     </div>
                     <?php } ?>
                  
                  
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
         var client_name = $('input:text[name=client_name]').val();
	 
         $('#contact_details .contact_block:last').after('<div class="contact_block" id=' + row_id + '><div class="row"><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Contact Person</label><div class="col-md-8"><input class="form-control contact_person" type="text" name="tbl_client_contact_numbers[' + row_id + '][contact_person]" placeholder = "Contact Person" value="" required></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Designation</label><div class="col-md-8"><select class="form-control custom-select" name="tbl_client_contact_numbers[' + row_id + '][ref_designation_id]">'+designation+'</select></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Agency</label><div class="col-md-8"><select name="tbl_client_contact_numbers[' + row_id + '][ref_contact_number_type_id]" class="form-control">'+contact_number_type_block+'</select></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Number</label><div class="col-md-8"><input class="form-control client_number" type="text" maxlength="12" name="tbl_client_contact_numbers[' + row_id + '][contact_number]" id="client_contact_number_'+row_id+'" placeholder = "Number" required onkeypress="return isNumber(event)"></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Extension</label><div class="col-md-8"><input type="text" name="tbl_client_contact_numbers[' + row_id + '][contact_extension]" placeholder = "Extension" class="form-control"></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Timing From</label><div class="col-md-8"><input type="text" name="tbl_client_contact_numbers[' + row_id + '][contact_timing_from]" class="timepicker form-control" placeholder = "Timing From"></div></div></div><div class="col-md-6">	<div class="form-group row"><label class="control-label text-right col-md-4">Timing To</label><div class="col-md-8"><input type="text" name="tbl_client_contact_numbers[' + row_id + '][contact_timing_to]" class="timepicker form-control" placeholder = " Timing To"></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Primary Contact</label>	<div class="col-md-8"><input class="contact_number_primary"  type="radio" name="tbl_client_contact_numbers[' + row_id + '][primary_contact]" value="' + row_id + '" > Primary Contact</div></div></div><div class="col-md-12" style="float:right;"><span title="Delete" data-toggle="tooltip" class="remove_number btn btn-danger pull-right"><i class="fa fa-trash-o"></i></span></div></div></div>');
         $('.timepicker').timepicker();

	 
      });
      $(document).on('click', '.remove_number', function() {
         $(this).closest('.contact_block').remove();
      });
   });
</script>
