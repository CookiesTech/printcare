<div class="clearfix"></div>
		  <?php if(isset($lead_contact_emails) && !empty($lead_contact_emails)){ ?>
		 <?php $i=1; foreach($lead_contact_emails as $key => $email_id){ ?>
		<div class="contact_email_block" id="<?php echo $i; ?>">
			<div class="table-responsive">
				<div style="float:right;" class="col-md-12">
					<?php  if($i == '1' ){ ?>
						<a class="add_email btn btn-add pull-right"><i class="fa fa-plus"></i></a>
					<?php }else{ ?>
						<a class="remove_email btn btn-danger pull-right"><i class="fa fa-trash-o"></i></a>
					<?php } ?>
				</div>

				
				<div class="col-md-4">
					<input class="form-control" type="email" name="tbl_lead_contact_email[<?php echo $i; ?>][email_id]"  value="<?php echo $email_id->email_id; ?>" placeholder = "Email">
				</div>
			
				<div class="col-md-4">
					<input class="form-control" type="text" name="tbl_lead_contact_email[<?php echo $i; ?>][contact_person]"  value="<?php echo $email_id->contact_person; ?>" placeholder = "Contact Person">
				</div>
			
				<div class="col-md-4">
					<select required name="tbl_lead_contact_email[<?php echo $i; ?>][ref_designation_id]" class="form-control">
					<?php 
						 if(isset($designation)){
							 $designation_block = ''; 
							 $designation_block.= '<option value="" disabled>Designation</option>';
							foreach ( $designation as $key => $val ) {
								if($key == $email_id->designation_id){
									$designation_block.= '<option value="'.$val->designation_id.'" selected>'.$val->designation_name.'</option>';
								}else{
									$designation_block.= '<option value="'.$val->designation_id.'">'.$val->designation_name.'</option>';
								}
								}
								echo $designation_block;
							}
						?>
					</select>
				</div>
					
				<div class="col-md-4">Primary Contact
					<?php if($email_id->primary_contact == '1'){ ?>
						<input type="radio" class="email_primary" checked name="tbl_lead_contact_email[<?php echo $i; ?>][primary_contact]" value="1">
					<?php }else{ ?>
						<input type="radio" name="tbl_lead_contact_email[<?php echo $i; ?>][primary_contact]" value="1">
					<?php } ?>
				</div>
			</tr>
			</div>
	</div>
	<?php $i++; } }else{  ?>
		
		<div class="contact_email_block" id="<?php echo $row; ?>">
	<div class="table-responsive">
			
			<div class="col-md-3">
				<input class="form-control" type="email" name="tbl_lead_contact_email[<?php echo $row; ?>][email_id]" id="LeadEmail"  placeholder = "Email">
			</div>
			
			<div class="col-md-3">
				<input class="form-control" type="text" name="tbl_lead_contact_email[<?php echo $row; ?>][contact_person]" placeholder ="Contact Person">
			</div>
			
			<div class="col-md-3">
				<select class="form-control" name="tbl_lead_contact_email[<?php echo $row; ?>][ref_designation_id]" id="select_designation" required>
				<?php 
					 if(isset($designation)){
						 $designation_block = '';
						 $designation_block.= '<option value="" disabled selected>Designation</option>';
						foreach ( $designation as $key => $val ) {
							$designation_block.= '<option value="'.$val->designation_id.'">'.$val->designation_name.'</option>';
							}
							echo $designation_block;
						}
					?>
				</select>
			</div>
			
			<div class="col-md-2">
				
				<input type="radio" class="email_primary" name="tbl_lead_contact_email[<?php echo $row; ?>][primary_contact]" value="1">Primary Contact
			</div>
			
			<div class="col-md-1">
					<?php  if($row == '1' ){ ?>
						<a class="add_email btn btn-add pull-right"><i class="fa fa-plus"></i></a>
					<?php }else{ ?>
						<a class="remove_email btn btn-danger pull-right"><i class="fa fa-trash-o"></i></a>
					<?php } ?>
				
			</div>
		</div>
	</div>
		<?php } ?>
