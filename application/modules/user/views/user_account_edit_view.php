<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<?php if(isset($_SESSION['success_msg'])){ ?>
					<div role="alert" class="alert black alert-success alert-dismissible"> 
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
					<h4 class="m-b-0 text-white">Edit</h4>
				</div>
				<div class="card-body">
					
					
					 <form id="form"  enctype="multipart/form-data" action="<?php echo site_url('user/accountsetting'); ?>" method="post" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').value='please wait...';">
                     <div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">User Name</label>
								<div class="col-md-8">
									<?php echo $user_data['username']; ?>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Full Name</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="full_name" value="<?php echo $user_data['full_name']; ?>">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Nick Name</label>
								<div class="col-md-8">
									 <input class="form-control" type="text" name="nick_name" value="<?php echo $user_data['nick_name']; ?>" >
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Current Password</label>
								<div class="col-md-8">
									<input class="form-control" type="password" name="old_password">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">New Password</label>
								<div class="col-md-8">
									<input class="form-control" type="password" name="password">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Repeat Password</label>
								<div class="col-md-8">
									 <input class="form-control" type="password" name="repeatpassword">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Session TimeOut Limit (in Minutes)</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="session_time_limit" onkeypress="return isNumber(event)" value="<?php echo $user[0]->session_time_limit; ?>">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Reminder Interval Limit (in Minutes)</label>
								<div class="col-md-8">
									 <input class="form-control" type="text" name="reminder_interval_time" onkeypress="return isNumber(event)" value="<?php echo $user[0]->reminder_interval_time; ?>">
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">User Profile Image</label>
								<div class="col-md-8">
									 <input class="form-control file_size_1 image_file" id="file" type="file" name="user_image" style="padding:0" />
									 <span class="file_upload_type_hint">Only jpg,jpeg & file size is less than 1MB</span><br>
									 <?php if(!empty($user[0]->user_image)){ ?>
										<img src="<?php echo base_url().$user[0]->user_image; ?>" alt="User Profile Image" width="60" height="80">
									<?php } ?>	
								</div>
							</div>
						</div>					
					</div>
					<div class="col-md-12 text-right">
						 <button class=" btn btn-success" type="submit" value="save">Save</button> 
						 <a class=" btn btn-danger" href="<?php echo site_url('dashboard');?>">Cancel</a> 
						
                    </div>
                     </form>					
				</div>	
			</div>	
		</div>	
	</div>	
</div>	
