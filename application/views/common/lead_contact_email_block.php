<div class="card">
   <div id="contact_email" class="contact_details">
      <div class="header">
         <h2>Contact Emails</h2> </div>
      <div class="body">
         <?php if(isset($lead_contact_emails) && !empty($lead_contact_emails)){ ?>
         <?php $i=1; foreach($lead_contact_emails as $key => $email_id){ ?>
         <div class="contact_email_block" id="<?php echo $i; ?>">
            <div class="table-responsive">
              <div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="tbl_lead_contact_email[<?php echo $i; ?>][contact_person]" value="<?php echo $email_id->contact_person; ?>" placeholder="Contact Person"> 
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="tbl_lead_contact_email[<?php echo $i; ?>][email_id]" value="<?php echo $email_id->email_id; ?>" placeholder="Email"> 
						</div>
					</div>
				</div>
				
				<div class="col-md-3">
                  <select  name="tbl_lead_contact_email[<?php echo $i; ?>][ref_designation_id]" class="form-control designation">
                    <?php echo $designation_block = $this->Common_model->getOptionList('designation',$email_id->ref_designation_id); ?>
                  </select>
               </div>
               
               <div class="col-md-2">
                  <?php if($email_id->primary_contact == '1'){ ?>
                  <input type="radio" class="email_primary" checked name="tbl_lead_contact_email[<?php echo $i; ?>][primary_contact]" value="1">
                  <?php }else{ ?>
                  <input type="radio" class="email_primary" name="tbl_lead_contact_email[<?php echo $i; ?>][primary_contact]" value="1">
                  <?php } ?> Primary Contact
              </div>
                  
                   <div  class="col-md-1">
                  <?php if($i=='1' ){ ?> <a title="Add" data-toggle="tooltip" class="add_email btn  btn-info pull-right"><i class="fa fa-plus"></i></a>
                  <?php }else{ ?> <a title="Delete" data-toggle="tooltip" class="remove_email btn btn-danger pull-right"><i class="fa fa-trash-o"></i></a>
                  <?php } ?> 
               </div>
            </div>
         </div>
         <?php $i++; } }else{ ?>
         <div class="contact_email_block" id="1">
            <div class="table-responsive">
				<div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="tbl_lead_contact_email[1][contact_person]" placeholder="Contact Person"> 
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="tbl_lead_contact_email[1][email_id]" id="LeadEmail" placeholder="Email"> 
						</div>
					</div>
				</div>
				
				<div class="col-md-3">
                  <select class="form-control designation" name="tbl_lead_contact_email[1][ref_designation_id]" id="select_designation" >
                     <?php echo $designation_block = $this->Common_model->getOptionList('designation',''); ?>
                   </select>
               </div>
				
               <div class="col-md-2">
                  <input type="radio" class="email_primary" name="tbl_lead_contact_email[1][primary_contact]" value="1" checked> Primary Contact 
                </div>
                  
               <div class="col-md-1"> 
				   <a title="Add" data-toggle="tooltip" class="add_email btn btn-info pull-right"><i class="fa fa-plus"></i></a> 
				</div>
            </div>
         </div>
         <?php } ?> </div>
   </div>
</div>
<script>
   designationNew = '';
   $(document).ready(function() {
      $('.add_email').on('click', function() {
			var row_id = parseInt($('#contact_email .contact_email_block:last').attr('id')) + 1;
         	if(designationNew !=''){
         		designation = designationNew;
         	}else{
         		designation = '<?php echo $designation_block; ?>';
         	}
         	//$('.designation').html(designation);
         	$('#contact_email .contact_email_block:last').after('<div class="contact_email_block" id='+row_id+'><div class="table-responsive"><div class="col-md-3"><div class="form-group"><div class="form-line"><input class="form-control" type="text" name="tbl_lead_contact_email['+row_id+'][contact_person]" placeholder = "Contact Person"></div></div></div><div class="col-md-3"><div class="form-group"><div class="form-line"><input class="form-control" type="text" name="tbl_lead_contact_email['+row_id+'][email_id]" placeholder="Email"></div></div></div><div class="col-md-3"><select  class="form-control" name="tbl_lead_contact_email['+row_id+'][ref_designation_id]">'+designation+'</select></div><div class="col-md-2"><input type="radio" class="email_primary" name="tbl_lead_contact_email['+row_id+'][primary_contact]" value="'+row_id+'">Primary Contact</div><div  class="col-md-1"><a style="float:right;" class="remove_email btn btn-danger pull-right"><i class="fa fa-trash-o"></i></a></div></div></div>');
         
      });
      $(document).on('click', '.remove_email', function() {
         $(this).closest('.contact_email_block').remove();
      });
   });
</script>
