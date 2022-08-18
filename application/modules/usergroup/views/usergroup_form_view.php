<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Add New Role</h4>
				</div>
				<div class="card-body">
					 <?php echo form_open('usergroup/add'); ?>
							  <div class="text-right">
								<button class="btn btn-success " type="submit" value="save">Save</button>
								<a href="<?php echo site_url('usergroup'); ?>" class="btn btn-danger " >Cancel</a>	
								</div>
							<div class="form-group col-md-3">
								<div class="form-line">
									<input class="form-control" placeholder="User Group" type="text" name="name" required>
								</div>
							</div>
							
							<table class="table table-striped table-borderless">
								<tr>
								<th align="left">All</th>
								<th align="left"><input type="checkbox" class="setpermission" id="view_permission"><label for="view_permission">View</label></th>
								<th align="left"><input type="checkbox" class="setpermission" id="add_permission"><label for="add_permission">Add</label> </th>
								<th align="left"><input type="checkbox" class="setpermission" id="edit_permission"><label for="edit_permission">Edit</label> </th>
								<th align="left"><input type="checkbox" class="setpermission" id="delete_permission"><label for="delete_permission">Delete</label></th>
								<!-- <th align="left"><input type="checkbox" class="setpermission" id="excel_permission"><label for="excel_permission">Excel</label></th>
								<th align="left"><input type="checkbox" class="setpermission" id="pdf_permission"><label for="pdf_permission">PDF</label></th>
								<th align="left"><input type="checkbox" class="setpermission" id="backup_permission"><label for="backup_permission">Backup</label></th> -->
							</tr>
							
						<?php $i = 1;
						if(isset($pages)){
							foreach($pages as $page){ ?>
								<tr>
								<td align="left"><input type="checkbox" class="setrowpermission" id="row_<?php echo $i; ?>"> <label for="row_<?php echo $i; ?>"><?php echo ucfirst($page['pages_name']); ?></label> <i class="fa fa-question-circle" aria-hidden="true" title="<?php echo $page['pages_name']; ?>"></i></td>
								<?php 
								
								if(isset($actions)){
									foreach($actions as $action){ 
										
										?>
										<td align="left"><input type='checkbox' id="<?php echo $action['action']; ?>_permission" class="<?php echo $action['action'].'_permission'; ?> row_<?php echo $i; ?>" name="permission[<?php echo $page['pages_name']; ?>][<?php echo $action['action']; ?>]" value='1'>  <label for="<?php echo $action['action']; ?>_permission"><?php echo $action['action']; ?></label></td>
									<?php }
								}
							$i++;	
							} ?>
							</tr>	
						<?php  } ?>
					   <tr>
							<th colspan="6" align="center">Master Page Permission</th>
						   </tr>
							<?php 
							if(isset($master_pages)){
								foreach($master_pages as $page){ ?>
									<tr>
									<td><input type="checkbox" class="setrowpermission" id="row_<?php echo $i; ?>"> <label for="row_<?php echo $i; ?>"><?php echo ucfirst($page['display_name']); ?></label> <i class="fa fa-question-circle" aria-hidden="true" title="<?php echo $page['pages_name']; ?>"></i></td>
									<?php 
									if(isset($actions)){
										foreach($actions as $action){ ?>
											<td><input type='checkbox' class="<?php echo $action['action'].'_permission'; ?> row_<?php echo $i; ?>" name="permission[<?php echo $page['pages_name']; ?>][<?php echo $action['action']; ?>]" value='1'> <label for="<?php echo $action['action']; ?>_permission"><?php echo $action['action']; ?></label></td>
										<?php } 
									}
									$i++;
								} ?>
								</tr>	
							<?php } ?>
							
							<tr>
							<th colspan="8" align="center">Other Page Permission</th>
						   </tr>
							<?php 
							
							if(isset($other_pages)){
								foreach($other_pages as $page){ ?>
									<tr>
									<td><input type="checkbox" class="setrowpermission" id="row_<?php echo $i; ?>"> <label for="row_<?php echo $i; ?>"><?php echo ucfirst($page['display_name']); ?></label>  <i class="fa fa-question-circle" aria-hidden="true" title="<?php echo $page['pages_name']; ?>"></i></td>
									<?php 
									if(isset($actions)){
										foreach($actions as $action){ ?>
											<td><input type='checkbox' class="<?php echo $action['action'].'_permission'; ?> row_<?php echo $i; ?>" name="permission[<?php echo $page['pages_name']; ?>][<?php echo $action['action']; ?>]" value='1'> <label for="<?php echo $action['action']; ?>_permission"><?php echo $action['action']; ?></label></td>
										<?php } 
									}
									$i++;
								} ?>
								</tr>	
							<?php } ?>
							   
							</table>
							 <div class="text-right">
								<button class="btn btn-success" type="submit" value="save">Save</button>
								<a href="<?php echo site_url('usergroup'); ?>" class="btn btn-danger " >Cancel</a>	
								
							</div>	  
						</form>
				</div>	
			</div>	
		</div>	
	</div>	
</div>	


<script>
 $(document).ready(function(){
	$(".setpermission").change(function () {
		//alert($(this).attr('id'));
		var class_name = $(this).attr('id');
		$("."+class_name).prop('checked', $(this).prop("checked"));
	});
	
	$(".setrowpermission").change(function () {
		//alert($(this).attr('id'));
		var class_name = $(this).attr('id');
		$("."+class_name).prop('checked', $(this).prop("checked"));
	});
	
});
</script>
