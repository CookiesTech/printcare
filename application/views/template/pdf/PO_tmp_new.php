<?php include('pdf_style.php'); ?>
<div class="lead_container">
	
	<div class="head align-right col-md-12" style="font-size:18px;color:#059649">
		PURCHASE ORDER
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
					<td align="left" width="15%">P.O. No</td>
					<td width="30%"> : <b><?php echo $purchase_order[0]->purchase_order_code; ?></b></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php 
						echo $supplier[0]->supplier_address_line1.$supplier[0]->supplier_address_line2.'<br>';
						echo $supplier[0]->district_name.' - '.$supplier[0]->supplier_pincode; ?></td>
						
						<td align="left">Date</td>
						<td> : <b><?php echo $this->Common_model->getDateFormat($purchase_order[0]->purchase_order_date);?></b></td>	
										
				</tr>
				<tr>
					<td >Customer</td>
					<td ><b><?php echo $client[0]->client_name; ?></b></td>
					<td align="left">Despatch Mode</td>
					<td> : <b><?php echo $purchase_order[0]->despatch_mode_name; ?></b></td>		
				</tr>
				<tr>
					<td></td>
					<td><?php 
						echo $client[0]->client_address_line1.$client[0]->client_address_line2.'<br>';
						echo $client[0]->district_name.' - '.$client[0]->client_pincode; ?></td>
					<td align="left">Destination</td>
					<td> : <b><?php echo $purchase_order[0]->delivery_point_name; ?></b></td>	
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
					<th align="left" width="33%">Product Description</th>
					<th align="center" width="6%">Qty</th>
					<th align="left" width="10%">Base PL</th>
					<th align="right" width="7%">Rate</th>
					<th align="right" width="8%">Value</th>
					<th align="left" width="12%">Schedule</th>
					<th align="right" width="7%">Disc %</th>
					<th align="right" width="7%">AS %</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 1;
					if(isset($purchase_order_particulars)&& !empty($purchase_order_particulars)){ ?>
					<?php 
						foreach ($purchase_order_particulars as $key => $val){ 
														
						?>
						<tr>
							<td align="center"><?php echo $i; ?></td>
							<td align="left"><?php echo $val->product_name.'<br>'.$val->product_quality_name.' - '.$val->product_quality_size_name.' '.$val->product_variety_name; ?></td>
							<td align="center"><?php echo $val->qty; ?></td>
							<td align="left">PL17</td>
							<td align="right"><?php echo $price; ?></td>
							<td align="right"><?php echo number_format($val->qty * $price); ?></td>
							<td align="left"><?php echo $this->Common_model->getDateFormat($purchase_order[0]->schedule_date);?></td>
							<td align="right">40.00</td>
							<td align="right">0.00</td>
						</tr>
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
		<br>
		<p>Thanking you and assuring you of our best services and prompt attention always.</p>
		<br>
		<br>
		<div class="align-left col-md-12">
			<b>For <span style="font-size:14px;"><?php echo $company[0]->company_name; ?></span></b>
		</div>	
		<br>
		<br>
		<br>
		<div class="align-left col-md-12">
			Authorised Signatory
		</div>	
		
	</div>	
</body></html>
