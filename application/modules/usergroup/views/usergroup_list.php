<!-- List view-->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-body">
					<div class="row">
					  <div class="col-md-6">
						 <h4 class="card-title">List</h4>
						 <h6 class="card-subtitle"><?php
							if(isset($filter_data) && !empty($filter_data)){
								$search_result_count = 0;
								if($mainlist_count){
									$search_result_count = $mainlist_count;
								}
								echo '<a style="font-size:14px;padding-left:10px;">'.$search_result_count.' result(s) found...</a>';
							}
							?>
						 </h6>
					  </div>
					  <div class="col-md-6 text-right">
						 <div class="dt-buttons">
							<?php if(in_array('usergroup_add',$permission)){ ?> 
								<a class="btn btn-success" href="<?php echo site_url('usergroup/add'); ?>">Add New</a>
							<?php } ?>	
							
						 </div>
					  </div>
				   </div>
					
					<div class="clearfix"></div>
					<?php echo form_open('user_group/getlist'); ?>
					<?php echo $filter_block; ?>
					<?php echo form_close(); ?>
					
					<div class="table-responsive">
						<div class="dataTables_wrapper">
							<?php echo form_open('user_group/delete'); ?>
								<table class="table color-table info-table ">
									<thead>
										<tr>
											<tr>
											<th width="5%" class="text-center">S.No</th>
											<th width="85%" class="text-left">Role Name</th>
											<th width="10%"class="text-right">Action</th>
										</tr>
										</tr>
									</thead>
									<tbody class="no-border-x">
										<?php $i = 1; 
											if(isset($usergroup) && !empty($usergroup)){
											foreach ($usergroup as $usergroup){ ?>
											<tr>
												<td class="text-center"><?php echo $i; ?></td>
												<td class="text-left"><?php echo $usergroup['name']; ?></td>
												<td class="text-right">
													<a class="btn btn-primary" href="<?php echo site_url('usergroup/edit/'.$usergroup['id']); ?>"><i class="fa fa-pencil"></i> </a>
													<a data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="delete_record(<?php echo $usergroup['id'];?>);"><i class="fa fa-trash-o"></i> </a>
													
												</td>
											</tr>
											<?php  $i++; } } ?>
									</tbody>
								</table>
								
							<?php echo form_close(); ?>		
							<?php echo $pagination_block; ?>
						</div>	
					</div>	
					
				</div>	
			</div>	
		</div>	
	</div>	
</div>	
<script>
function delete_record(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = "<?php echo site_url('usergroup/delete'); ?>/"+id;
        else
          return false;
        } 
</script>       
        
