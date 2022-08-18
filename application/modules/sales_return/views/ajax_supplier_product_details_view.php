<?php 
	$i = 1;
	if(isset($product_list) && !empty($product_list)){
		foreach($product_list as $key => $val){ 				
?>
			<tr id="<?php echo $i; ?>">
				<td align="center" ><?php echo $i; ?></td>
				<td align="left" ><input type="hidden" name="tbl_purchase_order_particulars[<?php echo $i; ?>][ref_product_id]" value="<?php echo $val->product_id; ?>"><?php echo $val->product_name.'<br>'.$val->product_quality_name.$val->product_quality_size_name; ?></td>
				<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][base_pl]" class="form-control"></td>
				<td align="right" ><input type="text" class="form-control text-right price" id="price_<?php echo $i; ?>" name="tbl_purchase_order_particulars[<?php echo $i; ?>][price]" value="<?php echo (float)$val->product_price; ?>"></td>
				<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_<?php echo $i; ?>"></td>
				<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][base_price]" class="form-control text-right base_price" id="base_price_<?php echo $i; ?>"></td>
				<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][schedule_date]" class="form-control datepicker"></td>
				<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][disc_perc]" class="form-control disc_perc" id="disc_perc_<?php echo $i; ?>" onkeypress="return isNumber(event)"><input type="hidden" class="disc_tot" id="disc_tot_<?php echo $i; ?>"></td>
				<td align="left" ><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][as_perc]" class="form-control as_perc" id="as_perc_<?php echo $i; ?>" onkeypress="return isNumber(event)"><input type="hidden" class="disc_tot" id="as_tot_<?php echo $i; ?>"></td>
				<td align="left"><input type="text" name="tbl_purchase_order_particulars[<?php echo $i; ?>][total]" class="form-control text-right total" id="total_<?php echo $i; ?>"></td>
			</tr>
			
<?php	
	$i++;		
		}
	}else{
		echo '<tr><td align="center" colspan="10">Product not available...</td></tr>';
	}
?>


