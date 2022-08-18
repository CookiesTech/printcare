<div class="col-md-12">
	<h4>Product Selection</h4>
</div>

<div class="col-md-3">
	<div class="form-group row">
	   <div class="col-md-12">
		   <select id="select_product" class="form-control" style="width:88%;float:left;">
				<option value="" >Select Product</option>
				<?php echo $this->Common_model->getOptionList('product'); ?>
			</select>
	   </div>
	</div>
 </div>

<div class="col-md-2"><a class="btn btn-success" id="add_product">Add Product</a></div>
 
<script>

	$(document).ready(function(){
		$(document).on('click','.remove_product',function(){
			var row_id = $(this).closest('tr').attr('id');
			if (confirm("Are you sure want to delete this product ?")) {
				var inv_item_id = $(this).attr('id');
				//alert(inv_item_id);
				if(typeof inv_item_id !== "undefined"){
				$.ajax({
	                type: 'POST',
	                dataType: 'json',
	                data:{inv_item_id:inv_item_id},
	                url: '<?php echo base_url(); ?>index.php/invoice/Ajax/remove_invoice_product',
	                beforeSend: function(){
						$("#status").css("display", "block");
						$("#loader").css("display", "block");
					},
	                success: function(json) { 	
						$("#status").fadeOut("slow"); 
						$("#loader").delay(500).fadeOut();
						if(json == true){
							if($('#product_body tr').length == 1){
								$('#sub_total_hidden').val('0');
								$('#sub_total').text('0.00');
								$('#grand_total').text('0.00');
								$('#grand_total_hidden').val('0');
								$('.gst_summary').remove();
								$('#discount_value').val('0');
								$('#discount_total_hidden').val('0');
								$('#discount_total').text('0.00');
							}
							$('#'+row_id).closest('tr').remove();	
							$('.qty').trigger('keyup');	
						}else{
							alert('Something went wrong!');
						}
					}
				});
			}else{
				$('#'+row_id).closest('tr').remove();	
				$('.qty').trigger('keyup');	
			}
			}
			return false;
		
	});
         $(document).on('click','#add_product',function(e){	
			var product_id = $('#select_product').val();	
			var discount_type = "<?php echo $this->Common_model->getOptionList('discount_type'); ?>";

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{product_id:product_id},
                url: '<?php echo base_url(); ?>index.php/purchase_order/Ajax/get_product',
                beforeSend: function(){
					$("#status").css("display", "block");
					$("#loader").css("display", "block");
				},
                success: function(json) { 	
					$("#status").fadeOut("slow"); 
					$("#loader").delay(500).fadeOut();
					if(json!='false'){
						var row_id = parseInt($('#product_body tr:last').attr('id'))+1;
						if(isNaN(row_id)){
							row_id = 1;
						}
						var batch_html = '<option value="">Batch</option>';
						$(json[0]['batch_list']).each(function(k,v){
							batch_html += '<option value="'+v['product_batch_id']+'" data-avail_quantity="'+v['avail_quantity']+'" data-batch_price="'+v['price']+'" >'+v['product_batch_name']+'</option>';
						});
						var html = '<tr id="'+row_id+'"><td align="center"><span class="sno">'+row_id+'</span></td><td align="left"><a href="'+json[0]['product_link']+'" target="_blank">'+json[0]['product_name']+' <i class="fa fa-search"></i></a><input type="hidden" name="tbl_invoice_particulars['+row_id+'][ref_product_id]" id="product_id_'+row_id+'" value="'+json[0]['product_id']+'"></td><td align="left">'+json[0]['sku']+'</td><td align="right"><select class="form-control row_product_batch" name="tbl_invoice_particulars['+row_id+'][ref_product_batch_id]" id="row_product_batch_'+row_id+'" required>'+batch_html+'</select></td><td align="left"><span id="row_avail_quantity_text_'+row_id+'"></span> <input type="hidden" id="row_avail_quantity_'+row_id+'" value=""></td><td align="right" ><input type="text" class="form-control text-right base_price" id="price_'+row_id+'" name="tbl_invoice_particulars['+row_id+'][price]" value="'+json[0]['product_price']+'"></td><td align="left" ><input type="text" name="tbl_invoice_particulars['+row_id+'][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_'+row_id+'" required></td><td align="right"><select class="form-control row_discount_type" name="tbl_invoice_particulars['+row_id+'][ref_discount_type_id]" id="row_discount_type_'+row_id+'" style="width:70px;">'+discount_type+'</select></td><td><input type="text" class="form-control row_discount_value" style="width:70px;" id="row_discount_value_'+row_id+'" value="0" name="tbl_invoice_particulars['+row_id+'][discount_value]"></td><td align="right"><input type="text" class="form-control text-right row_discount_total" id="row_discount_total_'+row_id+'" name="tbl_invoice_particulars['+row_id+'][discount_total]" value="0" ></td><td align="right"><input type="hidden" name="tbl_invoice_particulars['+row_id+'][gst_perc]" class="form-control row_gst_perc" id="gst_perc_'+row_id+'" onkeypress="return isNumber(event)" value="'+json[0]['gst_type_name']+'">'+json[0]['gst_type_name']+'</td><td align="left"><input type="text" name="tbl_invoice_particulars['+row_id+'][sub_total]" class="form-control text-right row_total" id="sub_total_'+row_id+'"></td><td align="left"><input type="text" name="tbl_invoice_particulars['+row_id+'][gst]" class="form-control text-right row_gst" id="row_gst_'+row_id+'"></td><td align="left"><input type="text" name="tbl_invoice_particulars['+row_id+'][total]" class="form-control text-right total" id="total_'+row_id+'"></td><td align="right"><a class="remove_product btn btn-danger"><i class="fa fa-remove "></i></a></td></tr>';
						
										 
						var row_id = parseInt($('#product_body tr:last').attr('id'))+1;
					
						if(isNaN(row_id)){
							$('#product_body').html(html);	
						}else{
							$('#product_body tr:last').after(html);	
						}
						update_serial_no();
					}else{
						alert('Product not available...');
					}					
				}
			});
		});	
	});
function update_serial_no(){
	$('.sno').each(function(index, value) {
		var sno = index+1;
		$(this).html(sno);
	});
}	
</script>
