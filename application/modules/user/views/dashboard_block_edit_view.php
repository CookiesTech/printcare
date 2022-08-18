<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Edit</h4>
				</div>
				<div class="card-body">
					<form id="form"  enctype="multipart/form-data" action="<?php echo site_url('user/editDashboardBlock/'.$dashboard_block[0]->user_dashboard_block_id); ?>" method="post" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').value='please wait...';">
						<input type="hidden" name="ref_dashboard_block_id" value="<?php echo $dashboard_block[0]->ref_dashboard_block_id?>">
						
						
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="control-label text-right col-md-4">Block Name </label>
									<div class="col-md-8">
										<?php echo ucwords(str_replace('_',' ',$dashboard_block[0]->dashboard_block_name)); ?>
									</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group row">
									<label class="control-label text-right col-md-4">Column Size</label>
									<div class="col-md-8">
										<input class="form-control" title="Column Width" type ="text" name="column_width" placeholder="Column Size" value="<?php echo $dashboard_block[0]->column_width; ?>" >
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="control-label text-right col-md-4">Sort Order</label>
									<div class="col-md-8">
										<input type="text" title="Sort Order" placeholder="Sort Order" class="form-control" name="sort_order" value="<?php echo $dashboard_block[0]->sort_order; ?>"  required>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="control-label text-right col-md-4">Status</label>
									<div class="col-md-8">
										<select name="ref_active_status_id" title="Status" class="form-control custom-select" required>
											<?php echo $this->Common_model->getOptionList('active_status',$dashboard_block[0]->ref_active_status_id); ?> 
										</select>
									</div>
								</div>
							</div>
						</div>
							
							<div class="clearfix"></div>
							
							<div class="text-right">
								<button class="btn btn-success" type="submit" value="save">Save</button>
								<a href="<?php echo site_url('user/customizeDashboardBlock');?>" class="btn btn-danger">Cancel</a>
							</div>
						</form>	
				</div>	
			</div>	
		</div>	
	</div>	
</div>	
