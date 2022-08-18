<?php include('pdf_style.php'); ?>
<div class="lead_container">
	
	<div class="head align-center col-md-12" style="font-size:18px;color:#059649">
		SAMPLE ORDER REQUEST
	</div>
	<hr>
	<br>
	<br>
	<br>
	 <table id="lead_list" class="table"  cellpadding = "8">
		 <tbody>
				<tr>
					<td width="15%">Supplier</td>
					<td width="40%"><b><?php echo $supplier[0]->supplier_name; ?></b></td>
					<td align="left" width="15%">SOF. No</td>
					<td width="30%"> : <b><?php echo $product_sample_request[0]->product_sample_request_code; ?></b></td>
				</tr>
				<tr>
					<td></td>
					<td><?php 
						echo $supplier[0]->supplier_address_line1.$supplier[0]->supplier_address_line2.'<br>';
						echo $supplier[0]->district_name.' - '.$supplier[0]->supplier_pincode; ?></td>
						
						<td align="left">Date</td>
						<td> : <b><?php echo $this->Common_model->getDateFormat($product_sample_request[0]->product_sample_request_date);?></b></td>	
										
				</tr>
				<tr>
					<td >Customer</td>
					<td ><b><?php echo $client[0]->client_name; ?></b></td>
					<td align="left">Despatch Mode</td>
					<td> : <b><?php echo $product_sample_request[0]->despatch_mode_name; ?></b></td>		
				</tr>
				<tr>
					<td></td>
					<td><?php 
						echo $client[0]->client_address_line1.$client[0]->client_address_line2.'<br>';
						echo $client[0]->district_name.' - '.$client[0]->client_pincode; ?></td>
					<td align="left">Destination</td>
					<td> : <b><?php echo $product_sample_request[0]->delivery_point_name; ?></b></td>	
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td align="left">Category</td>
					<td> : <b><?php echo $product_sample_request[0]->sample_request_category_name; ?></b></td>	
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td align="left">Tag</td>
					<td> : <b><?php echo $product_sample_request[0]->tag; ?></b></td>	
				</tr>
			</tbody>
			
				
		</table>
		<br>
		<br>
		<br>	 
		<table id="lead_list" class="table table-border table-color"  cellpadding = "8" >
			<thead >
				<tr>
					<th align="center" width="7%">S.No</th>
					<th align="left" width="68%">Product Description</th>
					<th align="center" width="10%">Qty</th>
					<th align="left" width="15%">Scehdule</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 1;
					if(isset($product_sample_request_particulars)&& !empty($product_sample_request_particulars)){ ?>
					<?php 
						foreach ($product_sample_request_particulars as $key => $val){ 
							if($val->qty){
							//$res_product = $this->Common_model->getDetails('product','product_id',$val->ref_product_id);
							//$quality_size = '';
							//if(isset($res_product) && !empty($res_product))
							//$quality_size = $res_product[0]->product_quality_name.' - '.$res_product[0]->product_quality_size_name;
						?>
						<tr>
							<td align="center"><?php echo $i; ?></td>
							<td align="left"><?php echo $val->product_name.'<br>'.$val->product_quality_name.' - '.$val->product_quality_size_name.' '.$val->product_variety_name; ?></td>
							<td align="center"><?php echo $val->qty; ?></td>
							<td align="left"><?php echo $this->Common_model->getDateFormat($product_sample_request[0]->schedule_date);?></td>
						</tr>
						<?php } ?>
					<?php $i++; } ?>
				<?php } ?>
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<div class="align-left col-md-12">
			<b>Special instructions if any </b><br>
			<?php if(isset($special_instruction) && !empty($special_instruction)) echo $special_instruction; else echo 'Nil' ?>
		</div>	
		<br>
		<p>Thanking you and assuring you of our best services and prompt attention always.</p>
		<br>
		<br>
		<div class="align-right col-md-12">
			<b>For <span style="font-size:14px;"><?php echo $company[0]->company_name; ?></span></b>
		</div>	
		<br>
		<br>
		<br>
		<div class="align-right col-md-12">
			Authorised Signatory
		</div>	
		
	</div>	
</body></html>
