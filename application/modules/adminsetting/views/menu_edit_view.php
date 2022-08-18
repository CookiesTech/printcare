<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Edit Menu</h4>
				</div>
				<div class="card-body">
					<?php echo form_open('adminsetting/editMenu/'.$menu[0]->menu_id); ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Menu Name</label>
								<div class="col-md-8">
									<input type="text" name="menu_name"	class="form-control" placeholder="Menu Name" value="<?php echo $menu[0]->menu_name; ?>" required>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Parent</label>
								<div class="col-md-8">
									 <select name="parent_id" class="form-control">
										 <option value=''>Select Parent</option>
										 <?php if(isset($menulist)){ ?>
											  <?php foreach($menulist as $key => $val){
												 if($val->menu_id == $menu[0]->parent_id ){ ?>
											  <option value="<?php echo $val->menu_id; ?>" selected><?php echo $val->menu_name; ?></option>
											  <?php }else{ ?>
											  <option value="<?php echo $val->menu_id; ?>"><?php echo $val->menu_name; ?></option>
											  <?php } } ?>
											  <?php } ?>	
									 </select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Master Table Name</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="menu_table_name" placeholder="Master Table Name" value="<?php echo $menu[0]->menu_table_name; ?>">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Master Display Name</label>
								<div class="col-md-8">
									 <input class="form-control" type="text" name="menu_alias_name" placeholder="Master Display Name" value="<?php echo $menu[0]->menu_alias_name; ?>">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Menu Link</label>
								<div class="col-md-8">
									 <input type="text" name="menu_link"	class="form-control" placeholder="Menu Link"  value="<?php echo $menu[0]->menu_link; ?>" required>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Menu Key</label>
								<div class="col-md-8">
									<input type="text" name="menu_access_key"	class="form-control"  placeholder="Menu Key" value="<?php echo $menu[0]->menu_access_key; ?>" required>	
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Menu Icon</label>
								<div class="col-md-8">
									<input type="text" name="icon"  placeholder="Menu Icon"	class="form-control" value="<?php echo $menu[0]->icon; ?>">				
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Alt Text</label>
								<div class="col-md-8">
									<input type="text" name="alt_text"  placeholder="Alt Text"	class="form-control" value="<?php echo $menu[0]->alt_text; ?>">				
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Sort Order</label>
								<div class="col-md-8">
									 <input type="text" name="sort_order"	 placeholder="Sort Order" onkeypress="return isNumber(event)" class="form-control" value="<?php echo $menu[0]->sort_order; ?>">		
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="control-label text-right col-md-4">Status</label>
								<div class="col-md-8">
									 <select name="status_id" class="form-control custom-select">
										 <option value="1" <?php if($menu[0]->status_id == '1') echo 'selected'; ?>>Enable</option>
											<option value="2" <?php if($menu[0]->status_id == '2') echo 'selected'; ?>>Disable</option>
									 </select>
								</div>
							</div>
						</div>
												
					</div>
					<div class="text-right">	
						<button class="btn btn-success" type="submit" value="save">Save</button>
						<a href="<?php echo site_url('adminsetting/menulist'); ?>" class="btn btn-danger" >Cancel</a>
						
					</div>	
					</form>
				</div>	
			</div>	
		</div>	
	</div>	
</div>	
