<section class="content home">
    <div class="container-fluid">
        <div class="block-header">
            <h2> <img src="<?php echo asset_url(); ?>images/logo.png"></h2> 
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <?php if(isset($_SESSION['success_msg'])){ ?>
				<div role="alert" class="alert alert-success alert-dismissible fade in"> 
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
                <div class="card">
                    <div class="header">
                        <h2>Change Password</h2> 
                    </div>
                    <div class="body">
						
					<?php echo form_open('login/updatePassword'); ?>
						<input type="hidden" name="ref_user_id" value="<?php echo $ref_user_id; ?>">
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="password" name="password"   	placeholder="Password" required>
							</div>	
						</div>	
						<div class="form-group">
							<div class="form-line">
								<input class="form-control" type="password"  name="repeatpassword"  placeholder="Repeat Password" required>
							</div>	
						</div>	
					
					<p class="submit"><input class="btn btn-primary white" type="submit" name="submit" value="Reset Now"></p>
				  </form>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>


