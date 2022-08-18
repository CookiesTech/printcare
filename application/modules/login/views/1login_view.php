<div id="container">
	<header id="header" class="navbar navbar-static-top">
	  <div class="navbar-header">
			<a href="#" class="navbar-brand"><img src="<?php echo asset_url(); ?>/images/logo.png"></a>
		</div>
	</header>

	<div id="content"> 
		<div id="container-fluid"> <br><br>
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4"> 
				<div class="panel panel-default">
					<div class="panel-heading"> 
						<h1 class="panel-title"><i class="fa fa-lock"></i> Please enter your login details.</h1> 
					</div>
					<div class="panel-body">
						  <?php if(isset($_SESSION['msg'])){ ?>
                                <div role="alert" class="alert alert-danger alert-dismissible fade in"> 
                                    <strong>
                                        <?php 
                                            echo $_SESSION['msg'];
                                            unset($_SESSION['msg']);
                                        ?>
                                    </strong> 
                                </div>
                            <?php } ?>
                           <?php echo validation_errors(); ?>
							<?php echo form_open('login/verifylogin'); ?>
							
							<div class="form-group"> 
								<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span> 
								  <input class="form-control" type="text" name="username" id="username" value="" placeholder="Username"> 
								</div> 
							  </div> 
							
							<div class="form-group"> 
								<div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span> 
								  <input class="form-control" type="password" id="passowrd" name="password" value="" placeholder="Password"> 
								</div> 
							 </div> 
											  
							<div class="form-group"> 
								  <input type="checkbox" name="remember_me" id="remember_me">
								Remember me on this computer
							 </div> 
							
							<div class="text-right"> 
								<button type="submit" name="submit" value="Login" class="btn btn-primary"><i class="fa fa-key"></i> Login</button> 
							  </div> 
							 <!--<p class="submit"><input type="submit" name="submit" value="Login"></p>-->
						</form>
					</div>
				</div>
			</div>
		</div>

			<div class="login-help">
			  <p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
			</div>
		</div>
	</div> 
</div> 

  

