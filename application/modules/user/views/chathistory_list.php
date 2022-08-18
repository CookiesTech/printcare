<section class="content home">
    <div class="container-fluid">
        <div class="block-header">
            <h2>User</h2>
        </div>
        <div class="row clearfix"> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
						
						<?php $id = $this->uri->segment(3);
						echo form_open('user/chathistory/'.$id.'/'); ?>
					 
					 <div class="col-md-3" style="padding-left:0;">
						<div class="form-group">
							<div class="form-line">
								<input placeholder="User To" type="text" name="user_to" class="form-control" value="<?php if(isset($filter_data['user_to'])) echo $filter_data['user_to']; ?>">
							</div>
						</div>
					</div>
					 
					  <div class="col-md-3" style="padding-left:0;">
						<div class="form-group">
							<div class="form-line">
								<input placeholder="From Date" type="text" name="date_from" class="datepicker form-control" value="<?php if(isset($filter_data['date_from']) && !empty ($filter_data['date_from'])) echo $this->Common_model->getDateFormat($filter_data['date_from']); ?>">
							</div>
						</div>
					  </div>
					 
					 <div class="col-md-3" style="padding-left:0;">
						<div class="form-group">
							<div class="form-line">
								<input placeholder="To Date" type="text" name="date_to" class="datepicker form-control" value="<?php if(isset($filter_data['date_to']) && !empty ($filter_data['date_to'])) echo $this->Common_model->getDateFormat($filter_data['date_to']); ?>">
							</div>
						</div>
					</div>
					 
					<div class="col-md-3" style="padding-left:0;">
						<button class="btn btn-primary" type="submit" name="submit">Submit</button>
						<button class="btn btn-danger" type="submit" name="reset">Reset</button>
					</div> 
						<?php echo form_close(); ?>
						
				<div class="card">
                    <div class="header">
                        <h2>Chat History
                        <?php
							if(isset($filter_data) && !empty($filter_data)){
								$search_result_count = 0;
								if($mainlist_count){
									$search_result_count = $mainlist_count;
								}
								echo '<a style="font-size:14px;padding-left:10px;">'.$search_result_count.' result(s) found...</a>';
							}
						?>
					
                        </h2>
                        <ul class="header-dropdown m-r--5">
							<!--<li><a title="Add New" data-toggle="tooltip" href ="<?php echo site_url('user/add'); ?>">Add New</a></li>
							<li><a href="javascript:void(0);">Export Excel</a></li>
							<li><a href="javascript:void(0);">Export PDF</a></li>-->
								
						</ul>
                    </div>
                 
                   <div class="body"> 	
						<div class="table-responsive">
							<table class="table table-borderless">
								<thead>
									<tr>
										<th class="text-left">S.No</th>
										<th class="text-left">From</th>
										<th class="text-left">To</th>
										<th class="text-left">Message</th>
										<th class="text-right">Sent On</th>
									</tr>
								</thead>
								<tbody>
									
									<?php 
										if(isset($mainlist) && !empty($mainlist)){ 
									$i = 1; foreach ($mainlist as $key => $val){ ?>
									<tr <?php if($val->member_from == $id) echo 'bgcolor="#ccc"'; ?>  >
										<td class="text-left"><?php echo $i; ?></td>
										<td class="text-left"><?php echo $val->user_from; ?></td>
										<td class="text-left"><?php echo $val->user_to; ?></td>
										<td class="text-left"><?php echo $val->message; ?></td>
										<td class="text-right"><?php echo date('d-m-Y H:i:s', strtotime($val->sent)); ?></td>
									</tr>
									<?php  $i++; } ?>
									<?php  } ?>	
								</tbody>
							</table>
						
						</div>
                    </div>  
                 </div>  
            </div>  
        </div>  

