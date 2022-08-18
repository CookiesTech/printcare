<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Add</h4>
				</div>
				<div class="card-body">
					<?php echo form_open('user/add'); ?>
					<div class="row">
						
						<!-- <div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Branch</label>
								<div class="col-md-8">
									<select name="ref_branch_id" id="ref_branch_id" class="form-control">
									<option value="" selected disabled>All</option>
									<?php echo $this->Common_model->getOptionList('branch'); ?>
									</select>
								</div>
							</div>
						</div> -->
						
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Full Name</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="full_name"  placeholder="Full Name" required>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Nick Name</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="nick_name"  placeholder="Nick Name" required>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Email</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="email" id="email" placeholder="Email" required >
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">User Name</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="name"  placeholder="User Name" id="username" required >
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Password</label>
								<div class="col-md-8">
									<input class="form-control" type="password" name="password" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">User Group</label>
								<div class="col-md-8">
									<select name="user_group_id" class="form-control"  required>
									<option value="" disabled>Select User Group</option>
									<?php 
										if(isset($usergroup)){ 
											foreach($usergroup as $user){ 
												if($user['id'] !='1'){
										?>
												<option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
										<?php }  ?>
									<?php }  ?>
								<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<!-- <div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Audit Record</label>
								<div class="col-md-8">
									<input value="1" id="audit_record" type="checkbox" name="audit_record"  >
									<label for="audit_record">Audit Record</label>
								</div>
							</div>
						</div> -->
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Status</label>
								<div class="col-md-8">
									<select name="status" class="form-control" required>
										<option value="" disabled>Select Status</option>
										<option value="1">Enable</option>
										<option value="0">Disable</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="text-right">
						<button class="btn btn-success" type="submit" value="save">Save</button> 
						<a href="<?php echo site_url('user'); ?>" class="btn btn-danger" >Cancel</a>	
						
					</div>	
				   </form>
				</div>	
			</div>	
		</div>	
	</div>	
</div>	

<script>
 $(document).ready(function(){
	 $('#username').change(function() {
		 var username = $('#username').val();
	   $.ajax({
		  url: '<?php echo base_url(); ?>index.php/user/itemEXist?name='+username+'&field=user_name',
		  type: 'POST',
		  dataType: 'json',
		  success: function(json){
					 if(json == 'exist'){
						 alert('User Name already exist');
						 $('#username').val('');
						 // do something if username already exist
					 } 
				}
		  });
	});
	
	$('#email').change(function() {
		 var email = $('#email').val();
	   $.ajax({
		  url: '<?php echo base_url(); ?>index.php/user/itemEXist?name='+email+'&field=email',
		  type: 'POST',
		  dataType: 'json',
		  success: function(json){
					 if(json == 'exist'){
						 alert('Email already exist');
						 $('#email').val('');
						 // do something if username already exist
					 } 
				}
		  });
	});
});
</script>  
