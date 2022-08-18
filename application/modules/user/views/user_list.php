
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
							<?php if(in_array('user_add',$permission)){ ?> 
								<a class="btn btn-success" href="<?php echo site_url('user/add'); ?>">Add New</a>
							<?php } ?>	
							<!-- <?php if(in_array('user_excel',$permission)){?> 	
								<a class="btn btn-info" href="<?php echo site_url('user/export_user_excel'); ?>" target="_blank">Excel</a>
							<?php } ?>	
							<?php if(in_array('user_pdf',$permission)){?>	
								<a class="btn btn-info" href="<?php echo site_url('user/export_user_pdf'); ?>" target="_blank">PDF</a>
							<?php } ?> -->
						 </div>
					  </div>
				   </div>
					
					<div class="clearfix"></div>
					<?php echo form_open('user/getlist'); ?>
					<?php echo $filter_block; ?>
					<?php echo form_close(); ?>
					
					<div class="table-responsive">
						<div class="dataTables_wrapper">
							<?php echo form_open('user/delete'); ?>
								<table class="table color-table info-table ">
									<thead>
									<tr>
										<th class="text-center">S.No</th>
										<th align="left" class="numeric">
											<?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
												<a href="<?php echo site_url($listing_page.'full_name/DESC'.$limit_str); ?>">Full Name</a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'full_name/ASC'.$limit_str); ?>"> Full Name</a>
											<?php } ?>
										</th>
										
										<th align="left" class="numeric">
											<?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
												<a href="<?php echo site_url($listing_page.'nick_name/DESC'.$limit_str); ?>">Nick Name</a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'nick_name/ASC'.$limit_str); ?>">Nick Name</a>
											<?php } ?>
										</th>
										<th align="left" class="numeric">
											<?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
												<a href="<?php echo site_url($listing_page.'user_name/DESC'.$limit_str); ?>">User Name</a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'user_name/ASC'.$limit_str); ?>">User Name</a>
											<?php } ?>
										</th>
											
										
													
										<th align="left" class="numeric">
											<?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
												<a href="<?php echo site_url($listing_page.'original_password/DESC'.$limit_str); ?>">Password</a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'original_password/ASC'.$limit_str); ?>">Password</a>
											<?php } ?>
										</th>
										
										<th align="left" class="numeric">Group Name</th>
										
										<th align="left" class="numeric">
											<?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
												<a href="<?php echo site_url($listing_page.'status/DESC'.$limit_str); ?>">Status</a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'status/ASC'.$limit_str); ?>">Status</a>
											<?php } ?>
										</th>
													
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if(isset($mainlist) && !empty($mainlist)){
									$i = 1; foreach ($mainlist as $mainlist){ ?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td align="left"><?php echo $mainlist['full_name']; ?></td>
										<td align="left"><?php echo $mainlist['nick_name']; ?></td>
										<td class="text-left"><?php echo $mainlist['user_name']; ?></td>
										<td class="text-left"><?php echo $mainlist['original_password']; ?></td>
										<td class="text-left"><?php echo $mainlist['user_group']; ?></td>
										<td  align="left" data-title="Status" class="numeric">
										 <?php if($mainlist['status'] == '1'){ ?>
											<input style="float:right;"  type="checkbox" class="switch_input" value="<?php echo $mainlist['user_id']; ?>" name="ref_status_id" checked>
											<?php }else{ ?>
											<input style="float:right;"  type="checkbox" class="switch_input" value="<?php echo $mainlist['user_id']; ?>" name="ref_status_id" >
											<?php } ?>
										</td>
													
										<!--<td class="text-left"><?php //if($mainlist['status'] == '1'){ echo "Enabled"; }else { echo "Disabled"; } ?></td>-->
										<td class="text-right">
										<!-- <a target="_blank" title="View" data-toggle="tooltip" class="btn btn-info" href="<?php echo site_url('user/chathistory/'.$mainlist['user_id']); ?>"><i class="fa fa-eye"></i> </a>  -->
										<a title="Edit" data-toggle="tooltip" class="btn btn-primary" href="<?php echo site_url('user/edit/'.$mainlist['user_id']); ?>"><i class="fa fa-pencil"></i> </a> 
										<!-- <a data-toggle="tooltip" title="Delete" class="btn btn-warning" onclick="reset_link(<?php echo $mainlist['user_id'];?>);">Reset Link</a>
														
										<a data-toggle="tooltip" title="Delete" class="btn btn-info" onclick="reset_password(<?php echo $mainlist['user_id'];?>);">Reset Pwd</a> -->
										
										<?php if($mainlist['user_id'] !='1'){ ?>				
											<a data-toggle="tooltip" title="Delete" class="btn btn-danger " onclick="delete_record(<?php echo $mainlist['user_id'];?>);"><i class="fa fa-trash-o"></i> </a> 
										<?php }else{ ?>
											<a data-toggle="tooltip" title="Delete" class="btn btn-danger "><i class="fa fa-trash-o"></i> </a>
										<?php } ?>
										</td>
									</tr>
									<?php  $i++; } ?>
									<?php } ?>	
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

   $(document).ready(function(){
	     	
   	$(".bootstrap-switch-label,.bootstrap-switch-handle-on,.bootstrap-switch-handle-off").on('click',function(){
   			var enable_cont_class = $(this).parent().parent().attr('class');
   			var enable_class = 'bootstrap-switch-on';
   			if(enable_cont_class.indexOf(enable_class) > -1){
				var status = '1';
			}else{
				var status = '0';
			}
			var id = '';
   			id = $(this).closest('.bootstrap-switch-container').find('.switch_input').val();

   			$.ajax({
   			type: 'POST',
   			dataType:'json',
   			data:{id:id,status:status},
   			url: '<?php echo base_url(); ?>/index.php/user/updateStatus',
   			success: function(json) {
				//alert(json);
			}
   		});
   			
   		});
   
   	});
   	
	function reset_link(id){
        var r=confirm("Do you want to send Password Reset Link?")
        if (r==true)
          window.location = "<?php echo site_url('user/resetLink'); ?>/"+id;
        else
          return false;
    } 
    
    function reset_password(id){
        var r=confirm("Do you want to Reset the Password?")
        if (r==true)
          window.location = "<?php echo site_url('user/resetPassword'); ?>/"+id;
        else
          return false;
    } 
    
    function delete_record(id){
        var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = "<?php echo site_url('user/delete'); ?>/"+id;
        else
          return false;
    } 
</script>
