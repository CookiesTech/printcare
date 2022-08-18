<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			 <?php if(isset($_SESSION['success_msg'])){ ?>
				<div role="alert" class="alert alert-success black alert-dismissible"> 
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
					<h4 class="m-b-0 text-white">Active Blocks</h4>
				</div>
				<div class="card-body">
					<?php if(isset($mainlist)&& !empty($mainlist)){ ?>
							<ul id="sortable">
							<?php $i = 1; foreach ($mainlist as $key => $val){ 
								if($val->ref_active_status_id == '1'){ 
								if(in_array($val->dashboard_block_key.'_view',$permission)){ 
								?>
								<li id="item-<?php echo $val->user_dashboard_block_id; ?>"  class="dash_block col-md-<?php echo $val->column_width-1;?>">
									
									<?php echo ucwords(str_replace('_',' ',$val->dashboard_block_name)); ?> 
									 <?php if($val->ref_active_status_id == '1'){ ?>
										<input style="float:right;"  type="checkbox" class="switch_input" value="<?php echo $val->user_dashboard_block_id; ?>" name="status_id" checked>
										<?php }else{ ?>
										<input style="float:right;"  type="checkbox" class="switch_input" value="<?php echo $val->user_dashboard_block_id; ?>" name="status_id" >
									<?php } ?>
																			
									<?php //if(in_array('adminsetting_edit',$permission)){?> 
										<a data-toggle="tooltip" title="Edit" class="btn btn-primary pull-right" href="<?php echo site_url('user/editDashboardBlock/'.$val->user_dashboard_block_id); ?>"><i class="fa fa-pencil"> </i> </a>
									<?php //} ?>
									<?php if(in_array('adminsetting_delete',$permission)){?> 
										 <a data-toggle="tooltip" title="Delete" class="btn btn-danger pull-right" href="javascript:void(0);" onclick="deleteRecord(<?php echo $val->user_dashboard_block_id;?>);"><i class="fa fa-trash-o"> </i> </a>
									<?php } ?> 
								</li>
							<?php } ?>
							<?php } ?>
							<?php } ?>
							</ul>
						<?php } ?>
				</div>	
			</div>	
		</div>	
	</div>	
</div>	


<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Inactive Blocks</h4>
				</div>
				<div class="card-body">
					<?php if(isset($mainlist)&& !empty($mainlist)){ ?>
						<ul id="sortable">
						<?php $i = 1; foreach ($mainlist as $key => $val){  
							if($val->ref_active_status_id == 2){ 
							if(in_array($val->dashboard_block_key.'_view',$permission)){ 
							?>
							<li id="item-<?php echo $val->user_dashboard_block_id; ?>"  class="dash_block col-md-<?php echo $val->column_width-1;?>">
								
								<?php echo ucwords(str_replace('_',' ',$val->dashboard_block_name)); ?> 
								 <?php if($val->ref_active_status_id == '1'){ ?>
									<input style="float:right;"  type="checkbox" class="switch_input" value="<?php echo $val->user_dashboard_block_id; ?>" name="status_id" checked>
									<?php }else{ ?>
									<input style="float:right;"  type="checkbox" class="switch_input" value="<?php echo $val->user_dashboard_block_id; ?>" name="status_id" >
								<?php } ?>
																		
								<?php //if(in_array('adminsetting_edit',$permission)){?> 
									<a data-toggle="tooltip" title="Edit" class="btn btn-primary pull-right" href="<?php echo site_url('user/editDashboardBlock/'.$val->user_dashboard_block_id); ?>"><i class="fa fa-pencil"> </i> </a>
								<?php //} ?>
								<?php if(in_array('adminsetting_delete',$permission)){?> 
									 <a data-toggle="tooltip" title="Delete" class="btn btn-danger pull-right" href="javascript:void(0);" onclick="deleteRecord(<?php echo $val->user_dashboard_block_id;?>);"><i class="fa fa-trash-o"> </i> </a>
								<?php } ?> 
							</li>
						<?php } ?>
						<?php } ?>
						<?php } ?>
						</ul>
					<?php } ?>
				</div>	
			</div>	
		</div>	
	</div>	
</div>	

<style>
#sortable li{
	padding:6px 0px;
	list-style-type:none;
}
.dash_block{ height: 50px;
border: 1px solid #e4e4e4;
padding: 10px 10px;
margin:10px 5px;
font-weight:bold;
text-align:center;
background-color:#e4e4e4;
}
</style>
<script src="<?php echo asset_url(); ?>js/jquery-ui.js"></script>
<script>
 $(document).ready(function(){ 	
   	$(".bootstrap-switch-label,.bootstrap-switch-handle-on,.bootstrap-switch-handle-off").on('click',function(){
   			var enable_cont_class = $(this).parent().parent().attr('class');
   			var enable_class = 'bootstrap-switch-on';
   			if(enable_cont_class.indexOf(enable_class) > -1){
				var status = '1';
			}else{
				var status = '2';
			}
			var id = '';
   			id = $(this).closest('.bootstrap-switch-container').find('.switch_input').val();

   			$.ajax({
   			type: 'POST',
   			dataType:'json',
   			data:{id:id,status:status},
   			url: '<?php echo base_url(); ?>/index.php/user/updateBlockStatus',
   			success: function(json) {
				//alert('Block Successfully Updated...');
				$('#success_update_popup').modal('show');	
				//location.reload();
				//alert(json);
			}
   		});
   			
   		});
   
   	});
   	
$(document).ready(function(){
	// Code for Drag items
	$('#sortable').sortable({
		axis: 'y',
		update: function (event, ui) {
			var data = $(this).sortable('serialize');
			var type = 'update_sortorder';
			$.ajax({
				data:data,
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/user/updateSortOrder',
				success: function(json) {
				$('#success_update_popup').modal('show');	
				//alert('Block Successfully Updated...');
				//location.reload();
				//alert(json);
			}
			});
		}
	});
	
});

function deleteRecord(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = "<?php echo site_url('user/delete'); ?>/"+id;
        else
          return false;
        } 
</script>

