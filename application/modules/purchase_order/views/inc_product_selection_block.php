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
<!-- 
<div class="col-md-2"><a class="btn btn-success" id="add_product">Add Product</a></div> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>	 
<script>

	$(document).ready(function(){
		$('#select_product').select2();
		$(document).on('click','.remove_product',function(){
		$(this).closest('tr').remove();	
	});
	
	$(document).on('change','#select_supplier1', function() {		   
			var p_row_id = $(this).parent().parent().attr('id');
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{ref_supplier_id:id},
                url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_product_list',
                beforeSend: function(){
					$("#status").css("display", "block");
					$("#loader").css("display", "block");
				},
                success: function(json) {
                    $("#status").fadeOut("slow"); 
					$("#loader").delay(500).fadeOut();
                    if (json['product']) {
						var html = '<option value="">Select Product</option>';
                        $(json['product']).each(function(index, value) {
							html += '<option value="'+value['product_id']+'">'+value['product_name']+'</option>';
						
                        });
                        $('#select_product').html(html);
                    }
                    
                    if (json['variety']) {
						var html = '<option value="">Select Variety</option>';
                        $(json['variety']).each(function(index, value) {
							html += '<option value="'+value['product_variety_id']+'">'+value['product_variety_name']+'</option>';
						
                        });
                        $('#select_variety').html(html);
                    }                    
                }
            });
        });
        
        $(document).on('change','#select_product1', function() {		  
            var product_id = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{product_id:product_id},
                url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_product_size_quality',
                beforeSend: function(){
					$("#status").css("display", "block");
					$("#loader").css("display", "block");
				},
                success: function(json) {                    
                   $("#status").fadeOut("slow"); 
					$("#loader").delay(500).fadeOut();
						var html = '<option value="">Select Quality</option>';
						if (json['quality']) {
							$(json['quality']).each(function(index, value) {
								html += '<option value="'+value['product_quality_id']+'">'+value['product_quality_name']+'</option>';
							
							});
                        }
                        $('#select_quality').html(html);
                                      
						var html = '<option value="">Select Size</option>';
						if (json['size']) {
							$(json['size']).each(function(index, value) {
								html += '<option value="'+value['product_quality_size_id']+'">'+value['product_quality_size_name']+'</option>';
							
							});
                        }
                        $('#select_size').html(html);
                }
            });
        });
  
        
         $(document).on('change','#select_product',function(e){	
			var product_id = $('#select_product').val();			
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{product_id:product_id},
                url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_product',
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
						
						var html = '<tr id="'+row_id+'"><td align="center"><span class="sno">'+row_id+'</span></td><td align="left">'+json[0]['product_name']+'<input type="hidden" name="tbl_purchase_order_particulars['+row_id+'][ref_product_id]" id="product_id_'+row_id+'" value="'+json[0]['product_id']+'"></td><td align="left">'+json[0]['sku']+'</td><td align="left">'+json[0]['quantity']+'</td><td align="right" ><input type="text" class="form-control text-right supplier_comm_perc" id="supplier_comm_perc_'+row_id+'" name="tbl_purchase_order_particulars['+row_id+'][supplier_comm_perc]" value="'+json[0]['supplier_comm_perc']+'" readonly></td><td align="right" ><input type="text" class="form-control text-right base_price" id="price_'+row_id+'" name="tbl_purchase_order_particulars['+row_id+'][price]" value="'+json[0]['product_price']+'"></td><td align="left" ><input type="text" name="tbl_purchase_order_particulars['+row_id+'][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_'+row_id+'"></td><td align="left" ><input type="text" name="tbl_purchase_order_particulars['+row_id+'][full_qty]" class="form-control" onkeypress="return isNumber(event)"></td><td align="right" ><input type="text" class="form-control text-right supplier_comm_total" id="supplier_comm_total_'+row_id+'" name="tbl_purchase_order_particulars['+row_id+'][supplier_comm_total]" value="" readonly></td><td align="right"><input type="text" name="tbl_purchase_order_particulars['+row_id+'][gst_perc]" class="form-control row_gst_perc" id="gst_perc_'+row_id+'" onkeypress="return isNumber(event)" value="'+json[0]['gst_type_name']+'" readonly></td><td align="left"><input type="text" name="tbl_purchase_order_particulars['+row_id+'][sub_total]" class="form-control text-right row_total" id="sub_total_'+row_id+'" value=""></td><td align="left"><input type="text" name="tbl_purchase_order_particulars['+row_id+'][gst]" class="form-control text-right row_gst" id="row_gst_'+row_id+'" value=""></td><td align="left"><input type="text" name="tbl_purchase_order_particulars['+row_id+'][total]" class="form-control text-right total" id="total_'+row_id+'"></td><td align="right"><a class="remove_product_particulars btn btn-danger"><i class="fa fa-remove remove_product"></i></a></td></tr>';
						
										 
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
