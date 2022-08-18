<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Edit</h4>
				</div>
				<div class="card-body">
					<?php echo form_open('user/edit/'.$user[0]->user_id); ?>
					<input type="hidden" value="<?php echo $this->agent->referrer(); ?>" name="redirect_to">
					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Branch</label>
								<div class="col-md-8">
									<select name="ref_branch_id" id="ref_branch_id" class="form-control">
									<option value="0" selected>All</option>
									<?php echo $this->Common_model->getOptionList('branch',$user[0]->ref_branch_id); ?>
									</select>
								</div>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Full Name</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="full_name" value="<?php echo $user[0]->full_name; ?>" placeholder="Full Name" required>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Nick Name</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="nick_name" value="<?php echo $user[0]->nick_name; ?>" placeholder="Nick Name" required>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Email</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="email" value="<?php echo $user[0]->email; ?>" placeholder="Email" required >
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">User Name</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="name" value="<?php echo $user[0]->user_name; ?>" placeholder="User Name" required >
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
									<select name="user_group_id[]" class="form-control" multiple required>
									<option value="" disabled>Select User Group</option>
									<?php 
										if(isset($usergroup)){ ?>
										<?php foreach($usergroup as $user_group){
											if($user_group['id'] !='1'){
											if(in_array($user_group['id'],$assigned_user_group)){ ?>
												<option value="<?php echo $user_group['id']; ?>" selected><?php echo $user_group['name']; ?></option>
												<?php }else{ ?>
											<option value="<?php echo $user_group['id']; ?>"><?php echo $user_group['name']; ?></option>
										<?php } } } ?>
									<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Audit Record</label>
								<div class="col-md-8">
									<input value="1" id="audit_record" type="checkbox" name="audit_record" <?php if($user[0]->audit_record== '1'){ echo "checked"; } ?>  >
									<label for="audit_record">Audit Record</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Status</label>
								<div class="col-md-8">
									<select name="status" class="form-control" required>
										<option value="" disabled>Select Status</option>
										<?php if($user[0]->status== '1'){ ?>
											<option value="1" selected>Enable</option>
											<option value="0">Disable</option>
										<?php }else{ ?>
											<option value="1" >Enable</option>
											<option value="0" selected 	>Disable</option>
										<?php }?>
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

