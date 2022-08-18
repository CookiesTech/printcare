<div class="col-md-12">
	<h4>Product Selection</h4>
</div>
<div class="col-md-3">
	<div class="form-group row">
	   <div class="col-md-12">
		   <select id="select_product" class="form-control" style="width:88%;float:left;">
				<option value="" >Select Product</option>
			</select>
			<a class="btn btn-info open_popup_add_product" href="<?php echo site_url('master/add/Product'); ?>" target="_blank" style="margin:4px 0px 0px 1px;"><i class="fa fa-plus"></i></a>
	   </div>
	</div>
 </div>
<div class="col-md-2">
	<div class="form-group row">
	   <div class="col-md-12">
		   <select id="select_quality" class="form-control" style="width:80%;float:left;">
				<option value="" >Quality</option>
			</select>
			<a class="btn btn-info" href="<?php echo site_url('master/add/ProductQuality'); ?>" target="_blank" style="margin:4px 0px 0px 1px;"><i class="fa fa-plus"></i></a>
	   </div>
	</div>
 </div>
<div class="col-md-3">
	<div class="form-group row">
	   <div class="col-md-12">
		   <select id="select_size" class="form-control" style="width:88%;float:left;">
				<option value="" >Select Size</option>
			</select>
			<a class="btn btn-info" href="<?php echo site_url('master/add/ProductQualitySize'); ?>" target="_blank" style="margin:4px 0px 0px 1px;"><i class="fa fa-plus"></i></a>
	   </div>
	</div>
 </div>
<div class="col-md-2">
	<div class="form-group row">
	   <div class="col-md-12">
		   <select id="select_variety" class="form-control" style="width:80%;float:left;">
				<option value="" >Variety</option>
				<?php //echo $this->Common_model->getOptionList('product_variety'); ?>
			</select>
			<a class="btn btn-info" href="<?php echo site_url('master/add/ProductVariety'); ?>" target="_blank" style="margin:4px 0px 0px 1px;"><i class="fa fa-plus"></i></a>
	   </div>
	</div>
 </div>
<div class="col-md-2"><a class="btn btn-success" id="add_product">Add Product</a></div>
	 
<script>
	$(document).ready(function(){	
		$(document).on('click','.remove_product',function(){
		$(this).closest('tr').remove();	
	});
	
	$(document).on('change','#select_supplier', function() {		   
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
                    
                    //~ if (json['size']) {
						//~ var html = '<option value="">Select Size</option>';
                        //~ $(json['size']).each(function(index, value) {
							//~ html += '<option value="'+value['product_quality_size_id']+'">'+value['product_quality_size_name']+'</option>';
						//~ 
                        //~ });
                        //~ $('#select_size').html(html);
                    //~ }
                    
                    
                }
            });
        });
        
        $(document).on('change','#select_product', function() {		  
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
        
       
        
          //~ $(document).on('change','#select_quality', function() {		   
            //~ var quality_id = $(this).val();
            //~ var name = $('#select_product').val();
            //~ $.ajax({
                //~ type: 'POST',
                //~ dataType: 'json',
                //~ data:{product_name:name,quality_id:quality_id},
                //~ url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_product_size',
                //~ success: function(json) {                    
                    //~ if (json['size']) {
						//~ var html = '<option value="">Select Size</option>';
                        //~ $(json['size']).each(function(index, value) {
							//~ html += '<option value="'+value['product_quality_size_id']+'">'+value['product_quality_size_name']+'</option>';
						//~ 
                        //~ });
                        //~ $('#select_size').html(html);
                    //~ }
                   //~ 
                //~ }
            //~ });
        //~ });
        //~ 
        
         $(document).on('click','#add_product',function(e){	
			var product_id = $('#select_product').val();
			var quality_id = $('#select_quality').val();
			var size_id = $('#select_size').val();
			var product_variety_id = $('#select_variety').val();
			var advanced_product_field = $('#advanced_product_field').val();
			//alert(quality_id);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{product_id:product_id,quality_id:quality_id,size_id:size_id,product_variety_id:product_variety_id},
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
						if(advanced_product_field){
							var html = '<tr id="'+row_id+'"><td align="center"><span class="sno">'+row_id+'</span></td><td align="left">'+json[0]['product_name']+'<br>'+json[0]['product_quality_name']+' - '+json[0]['product_quality_size_name']+' '+json[0]['product_variety_name']+'<input type="hidden" name="tbl_purchase_order_particulars['+row_id+'][ref_product_id]"  id="product_id_'+row_id+'" value="'+json[0]['product_id']+'"><input type="hidden" name="tbl_purchase_order_particulars['+row_id+'][ref_product_quality_id]"  id="product_quality_id_'+row_id+'" value="'+json[0]['product_quality_id']+'"><input type="hidden" name="tbl_purchase_order_particulars['+row_id+'][ref_product_quality_size_id]"  id="product_quality_size_id_'+row_id+'" value="'+json[0]['product_quality_size_id']+'"><input type="hidden" name="tbl_purchase_order_particulars['+row_id+'][ref_product_variety_id]"  id="product_variety_id'+row_id+'" value="'+json[0]['product_variety_id']+'"></td><td align="left" ><input type="text" name="tbl_purchase_order_particulars['+row_id+'][base_pl]" class="form-control"></td><td align="right" ><input type="text" class="form-control text-right price" id="price_'+row_id+'" name="tbl_purchase_order_particulars['+row_id+'][price]" value="'+json[0]['product_price']+'"></td><td align="left" ><input type="text" name="tbl_purchase_order_particulars['+row_id+'][qty]" class="form-control qty" onkeypress="return isNumber(event)" id="qty_'+row_id+'"><input type="hidden" name="tbl_purchase_order_particulars['+row_id+'][base_price]" class="form-control text-right base_price" id="base_price_'+row_id+'"></td><td align="left" ><input type="text" name="tbl_purchase_order_particulars['+row_id+'][schedule_date]" class="form-control datepicker"></td><td align="left" ><input type="text" name="tbl_purchase_order_particulars['+row_id+'][disc_perc]" class="form-control disc_perc" id="disc_perc_'+row_id+'" onkeypress="return isNumber(event)"><input type="hidden" class="disc_tot" id="disc_tot_'+row_id+'"></td><td align="left" ><input type="text" name="tbl_purchase_order_particulars['+row_id+'][as_perc]" class="form-control as_perc" id="as_perc_'+row_id+'" onkeypress="return isNumber(event)"><input type="hidden" class="disc_tot" id="as_tot_'+row_id+'"></td><td align="left"><input type="text" name="tbl_purchase_order_particulars['+row_id+'][total]" class="form-control text-right total" id="total_'+row_id+'"></td><td align="right"><a class="remove_product_particulars btn btn-danger"><i class="fa fa-remove remove_product"></i></a></td></tr>';
							$('.datepicker').datetimepicker({
								dayOfWeekStart: 1,
								lang: 'en',
								disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
								startDate: '2015-10-28',
								step: 5,
								format: 'd-m-Y',
								formatDate: 'd-m-Y',
							}).on('change', function() {
								$('.xdsoft_datetimepicker').hide();
							});
						}else{						
							var html = '<tr id="'+row_id+'"><td align="center"><span class="sno">'+row_id+'</span></td><td align="left">'+json[0]['product_name']+'<br>'+json[0]['product_quality_name']+' - '+json[0]['product_quality_size_name']+' '+json[0]['product_variety_name']+'<input type="hidden" name="tbl_product_sample_request_particulars['+row_id+'][ref_product_id]"  id="product_id_'+row_id+'" value="'+json[0]['product_id']+'"><input type="hidden" name="tbl_product_sample_request_particulars['+row_id+'][ref_product_quality_id]"  id="product_quality_id_'+row_id+'" value="'+json[0]['product_quality_id']+'"><input type="hidden" name="tbl_product_sample_request_particulars['+row_id+'][ref_product_quality_size_id]"  id="product_quality_size_id_'+row_id+'" value="'+json[0]['product_quality_size_id']+'"><input type="hidden" name="tbl_product_sample_request_particulars['+row_id+'][ref_product_variety_id]"  id="product_variety_id'+row_id+'" value="'+json[0]['product_variety_id']+'"></td><td align="right"><input type="text" name="tbl_product_sample_request_particulars['+row_id+'][qty]" class="form-control text-right" style="width:80px;" id="qty_'+row_id+'"></td><td align="right"><a class="remove_product_particulars btn btn-danger"><i class="fa fa-remove remove_product"></i></a></td></tr>';
						}
										 
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
</script>
