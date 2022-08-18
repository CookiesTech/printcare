
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="body">
		 <ul class="nav nav-tabs customtab" role="tablist">
			<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#details" role="tab"><span class="hidden-sm-up"><i class="ti-details"></i></span> <span class="hidden-xs-down">Basic Details</span></a> </li>
			<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#contact" role="tab"><span class="hidden-sm-up"><i class="ti-contact"></i></span> <span class="hidden-xs-down">Mobile</span></a> </li>
			<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#email" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Email</span></a> </li>
		</ul>
		
		<div class="tab-content tabcontent-border">
			<div class="tab-pane p-20 active" id="details" role="tabpanel">
<div class="row">
    
    
    <div class="col-md-6">
	    <div class="form-group row">
		    <label class="control-label text-right col-md-5">Name</label>
		    <div class="col-md-7">
			    <?php if(isset($suppliers[0]->supplier_name)) echo $suppliers[0]->salutation_name.' '.$suppliers[0]->supplier_name ;?>
		    </div>
	    </div>
    </div>
    <div class="col-md-6">
	    <div class="form-group row">
		    <label class="control-label text-right col-md-5">Code</label>
		    <div class="col-md-7">
			    <?php echo $suppliers[0]->supplier_code; ?>
		    </div>
	    </div>
    </div>
   
    <div class="col-md-6">
	    <div class="form-group row">
		    <label class="control-label text-right col-md-5">Address</label>
		    <div class="col-md-7">
			    <?php if(isset($suppliers[0]->supplier_address_line1)) echo $suppliers[0]->supplier_address_line1 ;?><?php if(isset($suppliers[0]->supplier_address_line2)) echo ','.$suppliers[0]->supplier_address_line2 ;?><?php if(isset($suppliers[0]->supplier_address_line3)) echo ','.$suppliers[0]->supplier_address_line3 ;?>
			    <Br>
			    <?php //if(isset($suppliers[0]->city_name)) echo $suppliers[0]->city_name ;?>
			    <?php if(isset($suppliers[0]->district_name)) echo $suppliers[0]->district_name ;?>
			    <?php if(isset($suppliers[0]->supplier_pincode)) echo '-'.$suppliers[0]->supplier_pincode ;?>
			    <Br>
			    <?php if(isset($suppliers[0]->state_name)) echo $suppliers[0]->state_name ;?>
			    
			    <?php if(isset($suppliers[0]->country_name)) echo $suppliers[0]->country_name ;?>
		    </div>
	    </div>
    </div>
    
    <div class="col-md-6">
	    <div class="form-group row">
		    <label class="control-label text-right col-md-5">Description</label>
		    <div class="col-md-7">
			    <?php if(isset($suppliers[0]->supplier_description)) echo $suppliers[0]->supplier_description ;?>
		    </div>
	    </div>
    </div>
    
    <div class="col-md-6">
		<div class="form-group row">
			<label class="control-label text-right col-md-5">GST No</label>
			<div class="col-md-7">
				<?php echo $suppliers[0]->supplier_gst_no ;?>
			</div>
		</div>
	</div>
	
    
	<div class="col-md-6">
		<div class="form-group row">
			<label class="control-label text-right col-md-5">GST Copy</label>
			<div class="col-md-7">
				<?php if(!empty($suppliers[0]->supplier_gst_file)){ ?>
					<a class="" href="<?php echo base_url().$suppliers[0]->supplier_gst_file; ?>" target="_blank" title="view">view</a>
				<?php }else{ ?>
					-
				<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group row">
			<label class="control-label text-right col-md-5">PAN No</label>
			<div class="col-md-7">
				<?php echo $suppliers[0]->supplier_pan_no ;?>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group row">
			<label class="control-label text-right col-md-5">PAN Copy</label>
			<div class="col-md-7">
				<?php if(!empty($suppliers[0]->supplier_pan_file)){ ?>
					<a class="" href="<?php echo base_url().$suppliers[0]->supplier_pan_file; ?>" target="_blank" title="view">view </a>
				<?php }else{ ?>
					-
				<?php } ?>
			</div>
		</div>
	</div>
	
</div>
</div>
			<div class="tab-pane" id="contact" role="tabpanel">
				<div class="table-responsive">
				<table class="table   ">
					<thead>
			<tr>
				<th align="center" width="5%">S.No</th>
				<th align="left">Primary</th>
				<th align="left">Name</th>
				<th align="left">Designation</th>
				<th align="left">Number Type</th>
				<th align="left">Contact Number</th>
				<th align="left">Extension</th>
				<th align="left">From</th>
				<th align="left">To</th>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($supplier_numbers) && !empty($supplier_numbers)){ ?>
			<?php $i = 1; foreach ($supplier_numbers as $key => $val){ ?>
			 <tr>
				<td align="center"><?php echo $i; ?></td>
				<td align="left"><?php if($val->primary_contact == '1'){ echo 'Yes'; }else{ echo ''; } ?></td>
				<td align="left"><?php echo $val->contact_person; ?></td>
				<td align="left"><?php echo $val->designation_name; ?></td>
				<td align="left"><?php echo $val->contact_number_type_name; ?></td>
				<td align="left"><?php echo $val->contact_number; ?></td>
				<td align="left"><?php echo $val->contact_extension; ?></td>
				<td align="left"><?php echo $val->contact_timing_from; ?></td>
				<td align="left"><?php echo $val->contact_timing_to; ?></td>
			</tr>
			<?php $i++; } ?>
			<?php }else{ ?>
				<tr><td align="center" colspan="9">No records found...</td></tr>
			<?php } ?>
		</tbody>
				</table>
			</div>
			</div>
			<div class="tab-pane" id="email" role="tabpanel">
				<div class="table-responsive">
				<table class="table   ">
				<thead>
					<tr>
						<th align="center" width="5%">S.No</th>
						<th align="left">Primary</th>
						<th align="left">Name</th>
						<th align="left">Email</th>
						<th align="left">Designation</th>
						
					</tr>
				</thead>
				<tbody>
				<?php if(isset($suppliers_emails) && !empty($suppliers_emails)){ ?>
					<?php $i = 1; foreach ($suppliers_emails as $key => $val){ ?>
					<tr>
						<td align="center"><?php echo $i; ?></td>
						<td align="left"><?php if($val->primary_contact == '1'){ echo 'Yes'; }else{ echo ''; } ?></td>
						<td align="left"><?php echo $val->contact_person; ?></td>
						<td align="left"><?php echo $val->email_id; ?></td>
						<td align="left"><?php echo $val->designation_name; ?></td>
					</tr>
					<?php $i++; } ?>
					<?php }else{ ?>
						<tr><td align="center" colspan="5">No records found...</td></tr>
					<?php } ?>
				</tbody>
				</table>
			</div>
			</div>
			
				
									</table>
			</div>
		</div>
		</div>
			
										
		
	</div>
</div>
