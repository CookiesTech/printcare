<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-body">						
					<div class="row">
					  <div class="col-md-6">
						 <h4 class="card-title"><?php echo ucwords(str_replace('_',' ',$table)); ?> List</h4>
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
							<?php if(in_array('master_add',$permission)){ ?> 
								<a class="btn btn-success" href="<?php echo site_url('master/add/'.$page_data); ?>">Add New</a>
							<?php } ?>	
						 </div>
					  </div>
				   </div>
					
					<div class="clearfix"></div>
					<?php if(isset($_SESSION[ 'success_msg'])){ ?>
					  <div role="alert" class="alert alert-success alert-dismissible black">
						 <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
						 </button> <strong>
									<?php 
										echo $_SESSION['success_msg'];
										unset($_SESSION['success_msg']);
									?>
								</strong> </div>
					  <?php } ?>
					  <?php if(isset($_SESSION[ 'error_msg'])){ ?>
					  <div role="alert" class="alert alert-danger alert-dismissible">
						 <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
						 </button> <strong>
									<?php 
										echo $_SESSION['error_msg'];
										unset($_SESSION['error_msg']);
									?>
								</strong> </div>
					  <?php } ?> 
					 <?php 
						echo form_open('master/getlist/'.$page_data); 
						echo $filter_block; 
						echo form_close(); 
						?>
					<div class="clearfix"></div>	
					<div class="table-responsive">
						<div class="dataTables_wrapper">
							<?php echo form_open('master/delete/'.$page_data); ?>
								<table class="table <?php echo LIST_TH_CLASS; ?>">
									 <thead>
								 <tr>
									<th class="text-center"  width="3%">
										<input type ="checkbox" id="checkAll" class="checkbox_list">
										<label for="checkAll"></label>
									</th>
									<th align="center" width="5%">S.No</th>
									
									<?php
										foreach ($tablefields as $key => $val){ ?>
											<?php if($val->COLUMN_COMMENT != 'Added Date' && trim($val->COLUMN_COMMENT) != 'User' && trim($val->COLUMN_COMMENT) != 'User Name' ){ ?>
											<th align="left" width=""><?php echo $val->COLUMN_COMMENT; ?></th>
										<?php } ?>
									<?php } ?>
								    
									<th align="left" width="10%">User</th>
									<th align="left" width="12%">Added Date</th>
									<th align="right" width="5%">Action</th>
								 </tr>
							  </thead>
							  
							  <tbody>
								 <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
								 <?php $i = 1; foreach ($mainlist as $key => $val){ 
									$vall = $table.'_name';
									$vall_id = $table.'_id'
								  ?>
								 <tr>
									 
									<td align="center">
										<input name="checkbox[]" type="checkbox" id="checkbox_<?php echo $val->$vall_id; ?>" value="<?php echo $val->$vall_id; ?>" id="checkbox_<?php echo $val->$vall_id; ?>" class="checkbox_list">
										<label for="checkbox_<?php echo $val->$vall_id; ?>"></label>
                                 
										</td>
									<td align="center"><?php echo $i; ?></td>
									
									<?php $k=1; foreach ($column as $key => $j){ 
									   if(strrpos($j, 'ref_')!== FALSE){
											$ref_field = $j;
											$primary_field = str_replace('ref_','',$j);
											$table_name = str_replace('_id','',$primary_field);
											$j = $table_name."_name";
									   }
									   if(strrpos($j, '_date')!== FALSE){
										   $val->$j = $this->Common_model->getDateTimeFormat($val->$j);
									   }
									   
									   if($j != $table."_id" && $j != $table."_content" && $j != "delete_status" && $j != "transaction_id"   ){ ?>
											<td align="left">
											   <?php  echo $val->$j; ?>
											</td>
									<?php }  $k++;
									   }  ?>
									   
									<td align="right">
									   <?php if(in_array('master_view',$permission)){?> 
									   <!--<a class="btn btn-info" href="<?php echo site_url('master/view/'.$page_data.'/'.$val->$vall_id); ?>"><i class="fa fa-eye"></i> </a>-->
									   <?php } ?>
									   <?php if(in_array('master_edit',$permission)){?> 
									   <a class="btn btn-raised bg-indigo waves-effect" href="<?php echo site_url('master/edit/'.$page_data.'/'.$val->$vall_id); ?>"><i class="fa fa-pencil"></i> </a>
									   <?php } ?>
									   <?php if(in_array('master_delete',$permission)){?> 
									   <!--<a class="btn btn-xs btn-danger" href="javascript:void(0);" onclick="delete_employee(<?php echo $val->$vall_id;?>);"><i class="fa fa-trash-o"></i> </a>-->
									   <?php } ?> 
									 
									</td>
								 </tr>
								 <?php  $i++; } ?>
								 <?php } ?>	
							  </tbody>
								</table>
								<?php if(in_array('master_delete',$permission)){?> 
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
