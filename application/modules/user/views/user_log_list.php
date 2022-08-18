<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-body">
					<div class="row">
					  <div class="col-md-6">
						 <h4 class="card-title">Log List</h4>
					  </div>
					  <div class="col-md-6 text-right">
						
					  </div>
				   </div>
					
					<div class="clearfix"></div>
					 <?php echo form_open('user/logs'); ?>
					 <div class="row">
						<div class="col-md-3">
							<div class="form-group row">
								<div class="col-md-12">
									<input placeholder="From Date" type="text" name="from" class="datepicker form-control">
								</div>
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group row">
								<div class="col-md-12">
									<input placeholder="To Date" type="text" name="to" class="datepicker form-control">
								</div>
							</div>
						</div>
					
						<div class="col-md-6">
							<button class="btn btn-success" type="submit" name="submit">Submit</button>
							<button class="btn btn-danger" type="submit" name="submit">Reset</button>
						</div>	
					</div>						  
					<?php echo form_close(); ?>
					
					<div class="table-responsive">
						<div class="dataTables_wrapper">
							
								<table class="table color-table info-table ">
									<thead>
										<tr>
											<th class="text-left">S.No</th>
											<th class="text-left">User Name</th>
											<th class="text-left">User Group</th>
											<th class="text-left">IP Address</th>
											<th class="text-right">Logged In Date & Time</th>
											<th class="text-right">Logged Out Date & Time</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
											if(isset($logs) && !empty($logs)){ 
										$i = 1; foreach ($logs as $key => $logs){ ?>
										<tr>
											<td class="text-left"><?php echo $i; ?></td>
											<td class="text-left"><?php echo $logs->user_name; ?></td>
											<td class="text-left"><?php echo $logs->user_group; ?></td>
											<td class="text-left"><?php echo $logs->ip_address; ?></td>
											<td class="text-right"><?php echo date('d-m-Y H:i:s', strtotime($logs->logged_in_date)); ?></td>
											<td class="text-right"><?php if(date('d-m-Y H:i:s', strtotime($logs->logged_out_date)) != '01-01-1970 05:30:00'){ echo date('d-m-Y H:i:s', strtotime($logs->logged_out_date)); } ?></td>
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
	</div>	
</div>	
