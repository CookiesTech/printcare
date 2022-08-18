<?php include('pdf_style.php'); 
// debug($purchase_order);
// debug($purchase_order_particulars);
?>
<div class="lead_container">
	
	<div class="head align-center col-md-12" style="font-size:18px;color:#059649">
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
					<td align="left" width="15%">P.O #</td>
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
				
			</tbody>	
		</table>
		<br>
		<br>
		<br>
		<table id="lead_list" class="table table-border table-color"  cellpadding = "8" >
			<thead >
				<tr>
					<th align="center" width="7%">S.No</th>
					<th align="left" width="33%">Product</th>
					<th align="left" width="10%">SKU</th>
					<th align="center" width="6%">Qty</th>
					<th align="right" width="7%">Rate</th>
					<th align="right" width="7%">GST%</th>
					<th align="right" width="8%">Commission</th>
					<th align="right" width="7%">Sub Total</th>
					<th align="right" width="7%">GST Total</th>
					<th align="right" width="8%">Grand Total</th>
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
							<td align="left"><?php echo $val->product_name; ?></td>
							<td align="left"><?php echo $val->sku; ?></td>
							<td align="center"><?php echo $val->qty; ?></td>
							<td align="right"><?php echo $val->price; ?></td>
							<td align="center"><?php echo $val->gst_perc; ?></td>
							<td align="right"><?php echo number_format($val->supplier_comm_total,2); ?></td>
							<td align="right"><?php echo number_format($val->sub_total,2); ?></td>
							<td align="right"><?php echo number_format($val->gst,2); ?></td>
							<td align="right"><?php echo number_format($val->total,2); ?></td>
						</tr>
					<?php $i++; } ?>
				<?php } ?>
				<tr>
					<td colspan="9" align="right"><b>Sub Total</b></td>
					<td align="right"><?php echo number_format($purchase_order[0]->sub_total,2); ?></td>
				</tr>
				<tr>
					<td colspan="9" align="right"><b>Supplier Commission</b></td>
					<td align="right"><?php echo number_format($purchase_order[0]->supp_discount_total,2); ?></td>
				</tr>
				<tr>
					<td colspan="9" align="right"><b>GST Total</b></td>
					<td align="right"><?php echo number_format($purchase_order[0]->gst_total,2); ?></td>
				</tr>
				<tr>
					<td colspan="9" align="right"><b>Grand Total</b></td>
					<td align="right"><?php echo number_format($purchase_order[0]->grand_total,2); ?></td>
				</tr>
			</tbody>
		</table>		
	</div>	
</body></html>
