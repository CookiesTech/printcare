<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Edit <?php echo ucwords(str_replace('_',' ',$table_name)); ?></h4>
				</div>
				<div class="card-body">
					<?php 
   $edit_id=$table. '_id'; 
   $name=$table. '_name'; ?>
<form id="masters" action="<?php echo site_url('master/edit/'.$page_data.'/'.$result[0]->$edit_id); ?>" method="post">
   <?php if ($table=='business_sub_category' ) { ?>
   <div class="col-md-3">
      <div class="form-group">
         <div class="form-line">
            <select name="ref_business_category_id" id="" required>
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
         <input type="text" name="<?php echo $table; ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" placeholder="<?php echo $table; ?>_name" required> 
      </div>
   </div>
   
   <?php } elseif ($table == 'product_request_email_template' ) { ?>
		
			 <div class=" col-md-6">
			  <div class="form-group">
				 <div class="form-line">
					<input id="table_name" class="form-control" type="text" name="<?php echo $table; ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?> Name" required>
				 </div>
			  </div>
		   </div>
		   <div class="clearfix"></div>
			<div class="col-md-12">
			  <div class="form-group">
				 <div class="form-line">
					<textarea rows="12" cols="" class="form-control" name="<?php echo $table ?>_content"placeholder="Template Content"><?php echo $result[0]->product_request_email_template_content ; ?></textarea>
				 </div>
			  </div>
		   </div>
		
		
		<div class="col-md-6">
			
		</div>	
	
   
               
   <?php } elseif ($table=='accounts_code' ) { ?>
  
         <div class=" col-md-4">
            <div class="form-group">
                     <div class="form-line">
            <select name="ref_accounts_group_id" class="form-control">
               <option value="">Account Group</option>
               <?php echo $this->Common_model->getOptionList('accounts_group',$result[0]->ref_accounts_group_id);?> 
            </select>
         </div>
         </div>
         </div>
         <div class=" col-md-4">
            <div class="form-group">
                     <div class="form-line">
            <input type="text" class="form-control" name="<?php echo $table; ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="Account Name" required> 
         </div>
         </div>
         </div>
   
   <?php } elseif ($table=='designation' ) { ?>

   <div class=" col-md-3">
      <div class="form-group">
         <div class="form-line">
            <input type="text" class="form-control" name="<?php echo $table; ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="Rate" required> 
         </div>
      </div>
   </div>
   <?php } elseif ($table=='area' ) { ?>
   <div class="col-md-3">
      <div class="form-group">
         <div class="form-line">
            <select name="ref_country_id" id="select_country" required>
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
            <select name="ref_state_id" id="select_state" required>
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
            <select name="ref_district_id" id="select_district" required>
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
            <input type="text" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
         </div>
      </div>
      <?php } elseif ($table=='district' ) { ?>
      <div class="col-md-3">
         <div class="form-group">
            <div class="form-line">
               <select name="ref_country_id" id="select_country" required>
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
               <select name="ref_state_id" id="select_state" required>
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
               <input type="text" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
            </div>
         </div>
         <?php } elseif ($table=='state' ) { ?>
         <div class="col-md-3">
            <div class="form-group">
               <div class="form-line">
                  <select name="ref_country_id" id="select_country" required>
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
                  <input type="text" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
               </div>
            </div>
            
           
            <?php } elseif($table == 'module_key') {  ?>
            <div class="col-md-3" >
               <div class="form-group">
                  <div class="form-line">
                     <input type ="text"  class="form-control" name="<?php echo $table ?>_name"  placeholder = "<?php echo $page_data ?>" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" required>
                  </div>
               </div>
            </div>
            <div class="col-md-3" >
               <div class="form-group">
                  <div class="form-line">
                     <input type ="text"  class="form-control" name="module_key_display_name"  placeholder = "Display Name" value="<?php if(isset($result[0]->module_key_display_name)) echo $result[0]->module_key_display_name ;?>" required>
                  </div>
               </div>
            </div>
            <?php } elseif($table == 'dashboard_block') {  ?>
            <div class="col-md-3" >
               <div class="form-group">
                  <div class="form-line">
                     <input type ="text"  class="form-control" name="<?php echo $table ?>_name"  placeholder = "Block Name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" required>
                  </div>
               </div>
            </div>
            <div class="col-md-3" >
               <div class="form-group">
                  <div class="form-line">
                     <input type ="text"  class="form-control" name="dashboard_block_key"  placeholder = "Block Key" value="<?php if(isset($result[0]->dashboard_block_key)) echo $result[0]->dashboard_block_key ;?>" required>
                  </div>
               </div>
            </div>
            <div class="col-md-2" >
               <div class="form-group">
                  <div class="form-line">
                     <input type ="text" class="form-control" name="column_width"  placeholder = "Column Width" value="<?php if(isset($result[0]->column_width)) echo $result[0]->column_width ;?>" onkeypress="return isNumber(event)" required>
                  </div>
               </div>
            </div>
            <div class="col-md-2" >
               <div class="form-group">
                  <div class="form-line">
                     <input type ="text"  class="form-control" name="sort_order"  placeholder = "Sort Order" value="<?php if(isset($result[0]->sort_order)) echo $result[0]->sort_order ;?>"onkeypress="return isNumber(event)" required>
                  </div>
               </div>
            </div>
            <div class="col-md-2" >
               <div class="form-group">
                  <div class="form-line">
                     <select name="ref_active_status_id" class="form-control" required>
                     <?php echo $this->Common_model->getOptionList('active_status',$result[0]->ref_active_status_id); ?>
                     </select>
                  </div>
               </div>
            </div>
	    <?php } elseif($table == 'product') {  ?>
			<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_supplier_id" class="form-control" id="select_supplier" required>
                        <?php echo $this->Common_model->getOptionList('supplier',$result[0]->ref_supplier_id); ?>
                        </select>
                     </div>
                  </div>
               </div>
		<div class="col-md-3">
		  <div class="form-group">
		     <div class="form-line">
			<input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name"  placeholder="<?php echo $page_data ?> Name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" required>
		     </div>
		  </div>
		</div>
	       
	       <!--<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_product_quality_id" class="form-control" id="select_quality" >
                        <option value="">Select Quality</option>
                        <?php echo $this->Common_model->getOptionList('product_quality',$result[0]->ref_product_quality_id); ?>
                        </select>
                     </div>
                  </div>
               </div>
	       <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_product_quality_size_id" class="form-control" id="select_quality_size" >
							<option value="">Select Size</option>
                        <?php echo $this->Common_model->getOptionList('product_quality_size',$result[0]->ref_product_quality_size_id); ?>
                        </select>
                     </div>
                  </div>
               </div>
	       <div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_quantity_type_id" class="form-control" required>
                        <?php echo $this->Common_model->getOptionList('quantity_type',$result[0]->ref_quantity_type_id); ?>
                        </select>
                     </div>
                  </div>
               </div>-->
               <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="hsn_sac"  placeholder="HSN / SAC" value="<?php  echo $result[0]->hsn_sac ;?>" required>
                     </div>
                  </div>
               </div>
	        <div class="col-md-3">
                  <div class="form-group">
                     <div class="form-line">
                        <input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_price" value="<?php if(isset($result[0]->product_price)) echo $result[0]->product_price ;?>" placeholder="Price" required>
                     </div>
                  </div>
               </div>
               
               <?php } elseif($table == 'product_variety') {  ?>
				<div class="col-md-3" >
					  <div class="form-group">
						 <div class="form-line">
							<select name="ref_supplier_id" class="form-control" id="select_supplier" required>
							<?php echo $this->Common_model->getOptionList('supplier',$result[0]->ref_supplier_id); ?>
							</select>
						 </div>
					  </div>
				   </div>
			<div class="col-md-3">
			  <div class="form-group">
				 <div class="form-line">
				<input id="table_name" type="text" class="form-control" name="<?php echo $table; ?>_name"  placeholder="<?php echo $page_data ?> Name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" required>
				 </div>
			  </div>
			</div>
	       
	    <?php } elseif($table == 'product_quality') {  ?>
		<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_supplier_id" id="select_supplier"class="form-control" required>
                       <option value="">Select Supplier</option>
                        <?php echo $this->Common_model->getOptionList('supplier',$result[0]->ref_supplier_id); ?>
                        </select>
                     </div>
                  </div>
               </div>

			<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_product_id" id="select_product" class="form-control" required>
							<option value="">Select Product</option>
							<?php echo $this->Common_model->getOptionList('product',$result[0]->ref_product_id,'ref_supplier_id',$result[0]->ref_supplier_id); ?>
                        </select>
                     </div>
                  </div>
               </div>
	       
	       <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
	       <?php } elseif($table == 'product_quality_size') {  ?>
		<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_supplier_id" id="select_supplier_size"class="form-control" required>
						<option value="">Select Supplier</option>
                        <?php echo $this->Common_model->getOptionList('supplier',$result[0]->ref_supplier_id); ?>
                        </select>
                     </div>
                  </div>
               </div>

		<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
						<select name="ref_product_id" id="select_product_size"  class="form-control" required>
						<option value="" >Select Product</option>
                        <?php echo $this->Common_model->getOptionList('product',$result[0]->ref_product_id,'ref_supplier_id',$result[0]->ref_supplier_id); ?>

                        </select>
                     </div>
                  </div>
               </div>
	       
	       <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
               
                <?php } elseif($table == 'belt') {  ?>
		
				<div class="col-md-3" >
                  <div class="form-group">
                     <div class="form-line">
                        <select name="ref_grade_id" class="form-control" required>
						<option value="">select</option>
                        <?php echo $this->Common_model->getOptionList('grade',$result[0]->ref_grade_id); ?>
                        </select>
                     </div>
                  </div>
               </div>
	       
			<div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
	      <?php } elseif($table == 'tape_size') {  ?>
		  <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
	       </div>
	        <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="quality" value="<?php if(isset($result[0]->quality)) echo $result[0]->quality ;?>" placeholder="Quality" required> 
                  </div>
               </div>
	       </div>
	       <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="length" value="<?php if(isset($result[0]->length)) echo $result[0]->length ;?>" placeholder="Length" required> 
                  </div>
               </div>
	       </div>
	       <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="width" value="<?php if(isset($result[0]->width)) echo $result[0]->width ;?>" placeholder="Width" required> 
                  </div>
               </div>
	       </div>
	     <?php } elseif($table == 'top_apron') {  ?>
		  <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
	       </div>
	        <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="top_apron_quality" value="<?php if(isset($result[0]->top_apron_quality)) echo $result[0]->top_apron_quality ;?>" placeholder="Top Apron Quality" required> 
                  </div>
               </div>
	       </div>
	        <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="top_apron_size" value="<?php if(isset($result[0]->top_apron_size)) echo $result[0]->top_apron_size ;?>" placeholder="Top Apron Size" required> 
                  </div>
               </div>
	       </div>
	    <?php } elseif($table == 'front_cot') {  ?>
		<div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
	       </div>
	        <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="front_cot_quality" value="<?php if(isset($result[0]->front_cot_quality)) echo $result[0]->front_cot_quality ;?>" placeholder="Front Cot" required> 
                  </div>
               </div>
	       </div>
	        <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="front_cot_size" value="<?php if(isset($result[0]->front_cot_size)) echo $result[0]->front_cot_size ;?>" placeholder="Front Cot Size" required> 
                  </div>
               </div>
	       </div>
	     <?php } elseif($table == 'back_cot') {  ?>
		<div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
	       </div>
	        <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="back_cot_quality" value="<?php if(isset($result[0]->back_cot_quality)) echo $result[0]->back_cot_quality;?>" placeholder="Back Cot Quality" required> 
                  </div>
               </div>
	       </div>
	       <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="back_cot_size" value="<?php if(isset($result[0]->back_cot_size)) echo $result[0]->back_cot_size;?>" placeholder="Back Cot Size" required> 
                  </div>
               </div>
	       </div>
	       <?php } elseif($table == 'bottom_apron') {  ?>
		<div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
	       </div>
	       <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="bottom_apron_quality" value="<?php if(isset($result[0]->bottom_apron_quality)) echo $result[0]->bottom_apron_quality;?>" placeholder="Back Cot Size" required> 
                  </div>
               </div>
	       </div>
	       <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="bottom_apron_size" value="<?php if(isset($result[0]->bottom_apron_size)) echo $result[0]->bottom_apron_size;?>" placeholder="Back Cot Size" required> 
                  </div>
               </div>
	       </div>
            <?php } else { ?>
            <div class="col-md-3">
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" class="form-control" name="<?php echo $table ?>_name" value="<?php if(isset($result[0]->$name)) echo $result[0]->$name ;?>" placeholder="<?php echo $page_data ?>" required> 
                  </div>
               </div>
               <?php } ?>
               <div class="clearfix"></div>
               <input class="submit btn btn-success" type="submit" value="Update"> <a class="submit btn btn-danger" href="<?php echo site_url('master/getlist/'.$page_data); ?>">Cancel</a> 
</form>
				</div>	
			</div>	
		</div>	
	</div>	
</div>	


<?php include('script_master.php'); ?>

<script>
	$(document).ready(function(){	
		
	});
</script>
