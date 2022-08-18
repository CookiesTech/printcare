<?php 
	$domain = $this->input->cookie(base_url(),true);
	if(base_url() == $domain){ 
		$remember = $this->input->cookie(base_url().'_remember_me',true); 
		if(isset($remember) && base_url() == $domain){ 
			$cookie_user = $this->input->cookie(base_url().'_username',true);
			$cookie_pswd = $this->input->cookie(base_url().'_password',true);
		 }
	 }else{
		 unset($remember);
	 }
?>

<style>
#loginform{line-height:2.5 !important}
</style>
<section id="wrapper" class="login-register login-sidebar py-3 py-md-5 position-relative">
    <div class="container pb-1">
        <div class="row">
            <div class="col-md-12 px-md-0">
        		<div class="login-box card">
        			<div class="card-body">
        				<form class="form-horizontal form-material" method="POST"  id="loginform" action="<?php echo site_url('login/verifylogin');?>">
        					
        					<div class="login-card mx-auto">
            					<div class="text-center mt-0 mt-lg-5">
            					   <h2>Printcare Login</h2>
            					</div>
        					    <?php if(!isset($reset_password) && !isset($do_reset_password)){ ?>
        						<div class="form-group m-t-40 mb-3 mt-3 mt-lg-4">
        							<div class="col-xs-12">
        								<input class="form-control rounded" type="text" required="" placeholder="Email" name="username" value="<?php if(isset($cookie_user)){ echo $cookie_user; } ?>" style="line-height:35px;">
        							</div>
        						 </div>
        						<div class="form-group mb-3">
        							<div class="col-xs-12">
        								<input class="form-control rounded" type="password" name="password" required="" placeholder="Password" value="<?php if(isset($cookie_pswd)){ echo $cookie_pswd; } ?>" style="line-height:35px;">
        							</div>
        						</div>
        						<!-- <div class="form-group mb-3">
        							<div class="col-md-12 px-0">
        								<div class="checkbox checkbox-primary pull-left p-t-0">
        									<input id="checkbox-signup" name="remember_me" type="checkbox" <?php if(isset($remember)){ echo "checked"; } ?>>
        									<label for="checkbox-signup"> Remember me </label>
        								</div>
    								 </div>
        						</div> -->
        						<div class="form-group text-center m-t-20 mb-0">
        							<div class="col-xs-12">
        								<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign In</button>
        							</div>
        							<a href="javascript:void(0)" id="to-recover" class="mt-3 text-secondary d-block text-center"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
        						</div>
        					    <?php } ?>
    					    </div>
        				</form>
        				<?php if(isset($reset_password) && $reset_password){ ?>
        						<form class="form-horizontal"  action="<?php echo site_url('login/resetPassword/'); ?>" method="POST">
        					<?php }else{ ?>
        						<form class="form-horizontal" id="recoverform" action="<?php echo site_url('login/resetPassword/'); ?>" method="POST">
        					<?php } ?>
        					 <?php if(isset($_SESSION['success_msg'])){ ?>
        						<div role="alert" class="alert black alert-success alert-dismissible  "> 
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
        						<div role="alert" class="alert alert-danger alert-dismissible  "> 
        							<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> 
        							<strong>
        								<?php 
        									echo $_SESSION['error_msg'];
        									unset($_SESSION['error_msg']);
        								?>
        							</strong> 
        						</div>
        					<?php } ?>
        					   
        					    <div class="login-card mx-auto">
            						<div class="form-group ">
            							<div class="col-xs-12 text-center mt-5">
            								<h2 class="text-info font-weight-lighter">Recover Password</h2>
            								<p class="text-dark text-center">Enter your Email and instructions will be sent to you! </p>
            							</div>
            						</div>
            						<div class="form-group ">
            							<div class="col-xs-12">
            								<input class="form-control" type="text" name="username" id="username" required="" placeholder="Username">
            							</div>
            						</div>
            						<div class="form-group text-center m-t-20">
            							<div class="col-xs-12">
            								<button class="btn btn-info btn-lg btn-block waves-effect waves-light mb-2" type="submit">Reset</button>
            								<a class="btn btn-outline-info btn-lg btn-block waves-effect waves-light mb-0" href="<?php echo site_url('login'); ?>">Back To Login</a>
            							</div>
            						</div>
        						</div>
        					</form>
        				<?php //} ?>
        				<?php if(isset($do_reset_password) && $do_reset_password){ ?>
        					<form class="form-horizontal" action="<?php echo site_url('login/updatePassword/'); ?>" method="POST">
        					<input type="hidden" name="ref_user_id" value="<?php echo $ref_user_id; ?>">
        					 <?php if(isset($_SESSION['success_msg1'])){ ?>
        						<div role="alert" class="alert black alert-success alert-dismissible  "> 
        							<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> 
        							<strong>
        								<?php 
        									echo $_SESSION['success_msg1'];
        									unset($_SESSION['success_msg1']);
        								?>
        							</strong> 
        						</div>
        					<?php } ?>
        					
        					 <?php if(isset($_SESSION['error_msg1'])){ ?>
        						<div role="alert" class="alert alert-danger alert-dismissible  "> 
        							<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> 
        							<strong>
        								<?php 
        									echo $_SESSION['error_msg1'];
        									unset($_SESSION['error_msg1']);
        								?>
        							</strong> 
        						</div>
        					<?php } ?>
        						<div class="form-group ">
        							<div class="col-xs-12">
        								<h3>Change Password</h3>
        								<p class="text-muted">Enter your new password! </p>
        							</div>
        						</div>
        						<div class="form-group ">
        							<div class="col-xs-12">
        								<input class="form-control" type="text" name="password"  required="" placeholder="Password">
        							</div>
        						</div>
        						<div class="form-group ">
        							<div class="col-xs-12">
        								<input class="form-control" type="text" name="repeatpassword"  required="" placeholder="Repeat Password">
        							</div>
        						</div>
        						<div class="form-group text-center m-t-20">
        							<div class="col-xs-12">
        								<button class="btn btn-success btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset Now</button>
        								<a class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" href="<?php echo site_url('login'); ?>">Back To Login</a>
        							</div>
        						</div>
        					</form>
        					
        				<?php } ?>
        			</div>
        		</div>
        	</div>
        	
        </div>
    </div>
</section>	
  

