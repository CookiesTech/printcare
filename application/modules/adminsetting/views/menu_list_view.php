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
							<?php if(in_array('adminsetting_add',$permission)){ ?> 
								<a class="btn btn-success" href="<?php echo site_url('adminsetting/addMenu'); ?>">Add New</a>
								<a class="btn btn-info" href="<?php echo site_url('adminsetting/menuSortorder'); ?>">Change Menu Order</a>
								<a class="btn btn-info" href="<?php echo site_url('adminsetting/submenuSortorder'); ?>">Change Master Order</a>
							<?php } ?>	
						 </div>
					  </div>
				   </div>
					
					<div class="clearfix"></div>
					<?php echo form_open('adminsetting/menulist'); ?>
					<?php echo $filter_block; ?>
					<?php echo form_close(); ?>
					<div class="table-responsive">
						<div class="dataTables_wrapper">
							<?php echo form_open('adminsetting/deleteMenu'); ?>
								<table class="table <?php echo LIST_TH_CLASS; ?>">
									 <thead>
									<tr>
										<th class="text-center"><input type ="checkbox" id="checkAll"><label for="checkAll"></label></th>
										<th class="text-center">S.No</th>
										<th class="text-left">
											<?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
												<a href="<?php echo site_url($listing_page.'menu_name/ASC'); ?>">Menu Name</a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'menu_name/DESC'); ?>">Menu Name</a>
											<?php } ?>
										</th>
										<th class="text-left">
											<?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
												<a href="<?php echo site_url($listing_page.'menu_access_key/ASC'); ?>">Menu Key</a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'menu_access_key/DESC'); ?>">Menu Key</a>
											<?php } ?>
										</th>
										<th class="text-left">
											<?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
												<a href="<?php echo site_url($listing_page.'menu_link/ASC'); ?>">Menu Link</a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'menu_link/DESC'); ?>">Menu Link</a>
											<?php } ?>
										</th>
										<th class="text-left">
											<?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
												<a href="<?php echo site_url($listing_page.'ref_parent_id/DESC'); ?>">Parent </a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'ref_parent_id/ASC'); ?>">Parent </a>
											<?php } ?>
										</th>
										<th class="text-center">
											<?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
												<a href="<?php echo site_url($listing_page.'status/DESC'); ?>">Status </a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'status/ASC'); ?>">Status </a>
											<?php } ?>
										</th>
										
										<th class="text-right">
											<?php if($this->uri->segment( 5 ) == 'ASC'){ ?>
												<a href="<?php echo site_url($listing_page.'sort_order/DESC'); ?>">Sort Order </a>
											<?php }else{ ?>
												<a href="<?php echo site_url($listing_page.'sort_order/ASC'); ?>">Sort Order </a>
											<?php } ?>
										</th>
										
										<th class="text-right" width="7%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(isset($mainlist)&& !empty($mainlist)){ ?>
									<?php $i = $start+1;  foreach ($mainlist as $key => $val){ 
										$res = $this->adminsetting_model->getMenu($val->parent_id);
										$parent_name = '';
										if(isset($res) && !empty($res)){
											$parent_name = $res[0]->menu_name;
										}
										?>
									<tr>
										<td class="text-center">
											<input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->menu_id; ?>" value="<?php echo $val->menu_id; ?>" class=""><label for="checkbox_<?php echo $val->menu_id; ?>"></label>
										</td>
										<td class="text-center"><?php echo $i; ?></td>
										<td class="text-left"><?php echo $val->menu_name; ?></td>
										<td class="text-left"><?php echo $val->menu_access_key; ?></td>
										<td class="text-left"><?php echo $val->menu_link; ?></td>
										<td class="text-left"><?php echo $parent_name; ?></td>
										<td class="text-center"><?php 
											if($val->status_id =='1'){
												echo '<a class="btn btn-success">Enable</a>';
											}else{
												echo '<a class="btn btn-danger">Disable</a>';
											}
										 ?>
										 </td>
										<td class="text-right"><?php echo $val->sort_order; ?></td>
										<td class="text-right">
											<a class="btn" href="<?php echo site_url('adminsetting/editMenu/'.$val->menu_id); ?>"><i class="fa fa-pencil"></i> </a>  
											<a class="" onclick="delete_record(<?php echo $val->menu_id;?>);"><i class="fa fa-trash-o"></i> </a>
										</td>
									</tr>
									<?php  $i++; } ?>
									<?php } ?>	
								</tbody>	
								</table>
								<?php if(in_array('menu_delete',$permission)){?> 
									 <input class="btn btn-danger delete " style="margin-top:10px;" type="submit" value="Delete" onClick="return confirmDelete();">
								<?php } ?> 
							<?php echo form_close(); ?>		
							<?php echo $pagination_block; ?>
						</div>	
					</div>	
					
				</div>	
			</div>	
		</div>	
	</div>	
</div>	
