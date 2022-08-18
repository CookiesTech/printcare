<section class="content home">
    <div class="container-fluid">
    <div class="block-header">
            <h2> <img src="<?php echo asset_url(); ?>images/logo.png"></h2> 
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           
                <div class="card">
                    <div class="header">
                        <h2>Generate Reset Password link</h2> 
                    </div>
                    <div class="body">
						
						  <?php if(isset($_SESSION['success_msg'])){ ?>
								<div role="alert" class="alert black alert-success alert-dismissible fade in"> 
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
								<div role="alert" class="alert alert-danger alert-dismissible fade in"> 
									<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> 
									<strong>
										<?php 
											echo $_SESSION['error_msg'];
											unset($_SESSION['error_msg']);
										?>
									</strong> 
								</div>
							<?php } ?>
						<?php echo form_open('login/resetPassword/'); ?>
						 <div class="form-group">
							<div class="form-line">
								<input class="form-control" type="text" name="username" id="username" value="" placeholder="User Name" required>
							</div>
						</div>
					   <!--<p><input class="form-control" type="email" id="email" name="email" value="" placeholder="Email"></p>-->
						
						<p class="submit"><input class="btn btn-primary white" type="submit" name="submit" value="Generate Link"></p>
					  </form>
      
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>




