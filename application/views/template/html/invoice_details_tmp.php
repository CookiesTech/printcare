<input type="hidden" id="invoice_id" value="<?php echo $invoice_details[0]->invoice_id; ?>">
<input type="hidden" id="invoice_total" name="grand_total" value="<?php echo round($invoice_details[0]->grand_total); ?>">
<table id="lead_list" class="table table-border table-color"  cellpadding = "6">
	<tr>
		<td align="left" width="25%"><b>Invoice NO</b></td>
		<td align="left" width="25%"> : <?php echo $invoice_details[0]->invoice_name; ?></td>
		<td align="left" width="25%"><b>Invoice Date</b></td>
		<td align="left" width="25%"> : <?php echo getDateFormat($invoice_details[0]->invoice_date);?></td>
	</tr>
	<tr>	
		
	</tr>

	<tr>	
		<td align="left"><b>Patient Name</b></td>
		<td align="left"> : <?php echo $invoice_details[0]->patient_name; ?></td>
		<td align="left"><b>Sub Total</b></td>
		<td align="left"> : <?php echo $invoice_details[0]->sub_total; ?></td>
	</tr>
	
	<tr>
		
	</tr>
	<tr>
		<td align="left"><b>Discount Amount</b></td>
		<td align="left"> : <?php echo $invoice_details[0]->discount_total; ?></td>
		<td align="left"><b>GST Amount</b></td>
		<td align="left"> : <?php echo $invoice_details[0]->gst_total; ?></td>
	</tr><tr>
		
	</tr><tr>
		<td align="left"><b>Grand Total</b></td>
		<td align="left"> : <?php echo $invoice_details[0]->grand_total; ?></td>
		<td align="left"><b>Payment Type</b></td>
		<td align="left"> : <?php echo $invoice_details[0]->payment_type_name; ?></td>
	</tr>
	<tr>
		
	</tr>

	<tr>	
		<td align="left"><b>Invoice PDF</b></td>
		<td align="left"> : <a href="<?php echo base_url().$invoice_details[0]->invoice_file; ?>" target="_blank">view invoice</td>
	</tr>	
</table>

