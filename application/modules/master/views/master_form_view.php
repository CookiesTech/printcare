<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="success_msg"></div>
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Add <?php echo ucwords(str_replace('_',' ',$table_name)); ?></h4>
				</div>
				<div class="card-body">
	    <form id="masters" action="<?php echo site_url('master/add/'.$page_data); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="table_name" value="<?php echo $table_name; ?>">
						<?php if ($table=='business_sub_category' ) { ?>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="business_category_id" id="" required>
                           <option value="" disabled selected>Business_category</option>
                           <?php if(isset($business_category)){ foreach ( $business_category as $key=> $val ) { echo '
                              <option value="'.$val->business_category_id.'">'.$val->business_category_name.'</option>'; } } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?>_name" required>
                     </div>
                  </div>
               </div>
               
               <?php } elseif ($table=='accounts_code' ) { ?>
              <!--  <div class=" col-md-4">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_accounts_transaction_category_id" class="form-control" required>
                           <option value="" disabled selected>Accounts Category</option>
                           <?php if(isset($accounts_transaction_category)){ foreach ( $accounts_transaction_category as $key=> $val ) { echo '
                              <option value="'.$val->accounts_transaction_category_id.'">'.$val->accounts_transaction_category_name.'</option>'; } } ?>
                        </select>
                     </div>
                  </div>
               </div> -->
               <div class=" col-md-4">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_accounts_group_id" class="form-control">
                           <option value="">Account Group</option>
                           <?php echo $this->Common_model->getOptionList('accounts_group');?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class=" col-md-4">
                  <input type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="Account Name" required>
               </div>
              
               <?php } elseif ($table=='designation' ) { ?>
             
               <div class=" col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" class="form-control" type="text" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
               <?php } elseif ($table=='area' ) { ?>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="country_id" id="select_country" required>
                           <option value="" disabled selected>Country</option>
                           <?php if(isset($country)){ foreach ( $country as $key=> $val ) { echo '
                              <option value="'.$val->country_id.'">'.$val->country_name.'</option>'; } } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="state_id" id="select_state" required>
                           <option value="" disabled selected>State</option>
                           <?php if(isset($state)){ foreach ( $state as $key=> $val ) { echo '
                              <option value="'.$val->state_id.'">'.$val->state_name.'</option>'; } } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="district_id" id="select_district" required>
                           <option value="" disabled selected>District</option>
                           <?php if(isset($district)){ foreach ( $district as $key=> $val ) { echo '
                              <option value="'.$val->district_id.'">'.$val->district_name.'</option>'; } } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?>_name" required>
                     </div>
                  </div>
               </div>
               <?php } elseif ($table=='district' ) { ?>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="country_id" id="select_country" required>
                           <option value="" disabled selected>Country</option>
                           <?php if(isset($country)){ foreach ( $country as $key=> $val ) { echo '
                              <option value="'.$val->country_id.'">'.$val->country_name.'</option>'; } } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="state_id" id="select_state" required>
                           <option value="" disabled selected>State</option>
                           <?php if(isset($state)){ foreach ( $state as $key=> $val ) { echo '
                              <option value="'.$val->state_id.'">'.$val->state_name.'</option>'; } } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?>_name" required>
                     </div>
                  </div>
               </div>
               <?php } elseif ($table=='state' ) { ?>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <select name="country_id" id="select_country" required>
                           <option value="" disabled selected>Country</option>
                           <?php if(isset($country)){ foreach ( $country as $key=> $val ) { echo '
                              <option value="'.$val->country_id.'">'.$val->country_name.'</option>'; } } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?>_name" required>
                     </div>
                  </div>
               </div>
              
               <?php } elseif($table == 'module_key') {  ?>
               <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <input type ="text"  class="form-control" name="<?php echo $table ?>_name"  placeholder = "<?php echo $page_data ?>" required>
                     </div>
                  </div>
               </div>
               <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <input type ="text"  class="form-control" name="module_key_display_name"  placeholder = "Display Name" value="" required>
                     </div>
                  </div>
               </div>
               <?php } elseif($table == 'dashboard_block') {  ?>
               <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <input type ="text"  class="form-control" name="<?php echo $table ?>_name"  placeholder = "Block Name"  required>
                     </div>
                  </div>
               </div>
               <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <input type ="text"  class="form-control" name="dashboard_block_key"  placeholder = "Block Key" required>
                     </div>
                  </div>
               </div>
               <div class="col-md-2" >
                  <div class="form-group">
                     <div class="form-line">
                        <input type ="text" class="form-control" name="column_width"  placeholder = "Column Width" onkeypress="return isNumber(event)" required>
                     </div>
                  </div>
               </div>
               <div class="col-md-2" >
                  <div class="form-group">
                     <div class="form-line">
                        <input type ="text"  class="form-control" name="sort_order"  placeholder = "Sort Order" onkeypress="return isNumber(event)" required>
                     </div>
                  </div>
               </div>
               <div class="col-md-2" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_active_status_id" class="form-control" required>
                        <?php echo $this->Common_model->getOptionList('active_status',''); ?>
                        </select>
                     </div>
                  </div>
               </div>
		   <?php } elseif($table == 'product') { ?>
			   <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_category_id" class="form-control"  required>
			               <option>Categroy</option>
                        <?php echo $this->Common_model->getOptionList('category',''); ?>
                        </select>
                     </div>
                  </div>
               </div>
		 <!--<div class="col-md-3">-->
		     <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
	       
	      
	       <!-- <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_product_quality_size_id" class="form-control" id="select_quality_size" >
						<option>Size</option>
                        <?php echo $this->Common_model->getOptionList('product_quality_size',''); ?>
                        </select>
                     </div>
                  </div>
               </div>
	       -->
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="sku"  placeholder="SKU" required>
                     </div>
                  </div>
               </div>

                <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="quantity"  placeholder="Quantity" required>
                     </div>
                  </div>
               </div>



               <div class="col-md-3" >
               <div class="form-group">
                  <div class="form-line">
                     <select name="ref_quantity_type_id" class="form-control">
                     <?php echo $this->Common_model->getOptionList('quantity_type',''); ?>
                     </select>
                  </div>
               </div>
            </div>

	           <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_price" value="" placeholder="MRP" required>
                     </div>
                  </div>
               </div>

                <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="file" class="form-control" name="image_file" value="">
                     </div>
                  </div>
               </div>

               <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_gst_type_id" class="form-control" required>
                  <option>GST Type</option>
                        <?php echo $this->Common_model->getOptionList('gst_type',''); ?>
                        </select>
                     </div>
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="form-group">
                     <div class="form-line">
                        <textarea class="form-control ckeditor" id="description" name="description"></textarea> 
                     </div>
                  </div>
               </div>
               <?php } elseif($table == 'product_variety') { ?>
			   <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_supplier_id" class="form-control" id="select_supplier" required>
						<option>Supplier</option>
                        <?php echo $this->Common_model->getOptionList('supplier',''); ?>
                        </select>
                     </div>
                  </div>
               </div>
				<div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
               
		 <?php } elseif($table == 'product_quality') { ?>
		<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_supplier_id" id="select_supplier" class="form-control" required>
			<option value="">Select Supplier</option>
                        <?php echo $this->Common_model->getOptionList('supplier'); ?>
                        </select>
                     </div>
                  </div>
               </div>
	       <tbody id="product_body">

	       <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
	    <select name="ref_product_id" id="select_product" class="form-control" required>
                       <option value="" >Select Product</option>
                        </select>
                     </div>
                  </div>
               </div>

	       <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
	       <?php } elseif($table == 'product_quality_size') { ?>
		<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_supplier_id" id="select_supplier_size"class="form-control" required>
			<option value="">Select Supplier</option>
                        <?php echo $this->Common_model->getOptionList('supplier'); ?>
                        </select>
                     </div>
                  </div>
               </div>

	       <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_product_id"  id="select_product_size" class="form-control" required>
		    <option value="" >select Product</option>
                       
                        </select>
                     </div>
                  </div>
               </div>
	       
	       <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
                <?php } elseif($table == 'belt') { ?>
				   <div class="col-md-3" >
						  <div class="form-group">
							 <div class="form-line">
								<select name="ref_grade_id" class="form-control" required>
								<option value="">Select Grade</option>
								<?php echo $this->Common_model->getOptionList('grade'); ?>
								</select>
							 </div>
						  </div>
					   </div>
				   
				   <div class="col-md-3">
					  <div class="form-group">
						 <div class="form-line">
							<input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
						 </div>
					  </div>
				   </div>
	        <?php } elseif($table == 'tape_size') { ?>
		    <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
		 <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="quality" type="text" class="form-control" name="quality" value="" placeholder="Quality" required>
                     </div>
                  </div>
               </div>   
	       <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="length" type="text" class="form-control" name="length" value="" placeholder="Length" required>
                     </div>
                  </div>
               </div>
	       <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="width" type="text" class="form-control" name="width" value="" placeholder="Width" required>
                     </div>
                  </div>
               </div>
	       <?php } elseif($table == 'top_apron') { ?>
		    <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
	       <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="top_apron_quality" type="text" class="form-control" name="top_apron_quality" value="" placeholder="Top Apron Quality" required>
                     </div>
                  </div>
               </div>
	       <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="top_apron_size" type="text" class="form-control" name="top_apron_size" value="" placeholder="Top Apron Size" required>
                     </div>
                  </div>
               </div>
	       <?php } elseif($table == 'front_cot') { ?>
		   <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
	        <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="front_cot_quality" type="text" class="form-control" name="front_cot_quality" value="" placeholder="Front Cot Quality" required>
                     </div>
                  </div>
               </div>
	        <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="front_cot_size" type="text" class="form-control" name="front_cot_size" value="" placeholder="Front Cot Size" required>
                     </div>
                  </div>
               </div>
	       <?php } elseif($table == 'back_cot') { ?>
		<div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
	        <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="back_cot_quality" type="text" class="form-control" name="back_cot_quality" value="" placeholder="Back Cot Quality" required>
                     </div>
                  </div>
               </div>
	        <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="back_cot_size" type="text" class="form-control" name="back_cot_size" value="" placeholder="Back Cot Size" required>
                     </div>
                  </div>
               </div>
	        <?php } elseif($table == 'bottom_apron') { ?>
		<div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
	       <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="bottom_apron_quality" type="text" class="form-control" name="bottom_apron_quality" value="" placeholder="Bottom Apron Quality" required>
                     </div>
                  </div>
               </div>
	        <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="bottom_apron_size" type="text" class="form-control" name="bottom_apron_size" value="" placeholder="Bottom Apron Size" required>
                     </div>
                  </div>
               </div>
		<?php } else { ?>
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name" value="" placeholder="<?php echo $page_data ?> Name" required>
                     </div>
                  </div>
               </div>
               <?php } ?>
               <div class="clearfix"></div>
		   <div class="text-right">
				<button class="btn btn-success " type="button" id="form">Save</button>
				<a class="submit btn btn-danger " href="<?php echo site_url('master/getlist/'.$page_data); ?>">Back To List</a>
		    </div>
					</form>
				</div>	
			</div>	
		</div>	
	</div>	
</div>
<?php include('script_master.php'); ?>
