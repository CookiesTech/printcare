<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
	$(document).ready(function(){	
		$('#select_product').select2();
		$('#select_patient').select2();
		$('#select_customer').select2();

		
		$(document).on('change','.row_product_batch',function(){
			var row_id =$(this).closest('tr').attr('id');
			var qty = $(this).find(':selected').data('avail_quantity');
			var batch_price = $(this).find(':selected').data('batch_price');
			var ordered_qty = $('#row_ordered_qty_'+row_id).val();
			if (typeof ordered_qty !== "undefined") {
				qty = parseInt(qty) + parseInt(ordered_qty);
			}
			$('#row_avail_quantity_text_'+row_id).text(qty);
			$('#row_avail_quantity_'+row_id).val(qty);
			$('#price_'+row_id).val(batch_price);
		});


         $(document).on('keyup','.qty,.base_price', function() {
			 var row_id =$(this).closest('tr').attr('id');
			 get_row_total(row_id);
			 check_qty_availability(row_id);
		 });
         $(document).on('keyup','.disc_perc', function() {
			 var row_id =$(this).closest('tr').attr('id');
			 get_row_total(row_id);
		 });
         $(document).on('keyup','.as_perc', function() {
			 var row_id =$(this).closest('tr').attr('id');
			 get_row_total(row_id);
		 });
		 
		 $('#p_and_f_total_hidden,#extra_total_hidden').on('keyup', function() {
			get_gst_total();
			get_grand_total();
		 });
        
        $('#discount_value').on('keyup', function() { 
			 var discount = $(this).val();	
			 var sub_total = parseFloat($('#sub_total_hidden').val());			 
			 var discount_type = $('#discount_type').val();		
			 var total_discount = 0;	 
			 if(discount_type == '1'){
				if(discount < 100){ // Perc
					var total_discount =  parseFloat(sub_total) * parseFloat(discount)/100;
				}else{
					alert('100 % discount not allowed...');
					$(this).val(0);
				}
			}else{ //Flat
				
				var total_discount =  discount;
			}
			
			var Itemwise_discount_total = 0
			$('.row_discount_total').each(function(){
				var row_id =$(this).closest('tr').attr('id'); 
				if($(this).val()){
					Itemwise_discount_total = (parseFloat(Itemwise_discount_total) + parseFloat($(this).val())) * parseInt($('#qty_'+row_id).val());
				}
			});

			total_discount = parseFloat(total_discount) + parseFloat(Itemwise_discount_total);
			if(Itemwise_discount_total){
				$('#discount_total').html(parseFloat(total_discount).toFixed(2));
			}else{
				$('#discount_total').html(parseFloat(total_discount).toFixed(2));
				$('#discount_total_hidden').val(parseFloat(total_discount).toFixed(2));
			}
			//alert(total_discount);
		
			get_gst_total();
			get_grand_total();
			//if(discount!='0' && discount!=''){
				if(Itemwise_discount_total == '0'){
					$("#discount_value").attr("readonly", false); 
				}else{
					$("#discount_value").attr("readonly", true); 
				}
				//$('.row_discount_value').val('0');

				//$('.row_discount_value').trigger('keyup');
			//}
		});
		
		$('#discount_type').on('change', function() { 
			$( "#discount_value" ).trigger('keyup');
		});
		
        $('#round_off_type').on('change', function() {
			 var type = $(this).val();			 
			 var rounded_value = 0;			 
			 grand_total = (parseFloat($('#sub_total_hidden').val()) - parseFloat($('#discount_total_hidden').val()));
			 
			 grand_total = grand_total.toFixed(2);
			 
			 var gt = grand_total.toString().split(".");
			 var round_off_value = parseFloat(gt[1]);
			
			 if(type == '+'){
				 rounded_value = 100 - parseInt(round_off_value);
				// alert(rounded_value);
				 $('#round_off').val(parseInt(rounded_value));
				 $('#grand_total').html((parseInt(gt[0]) + parseInt(1)).toFixed(2));
				 $('#grand_total_hidden').val((parseInt(gt[0]) + parseInt(1)).toFixed(2));
			 }else{
				 rounded_value = parseInt(round_off_value);
				 $('#round_off').val(parseInt(round_off_value));
				 $('#grand_total').html(parseInt(gt[0]).toFixed(2));
				$('#grand_total_hidden').val(parseInt(gt[0]).toFixed(2));
			 }
			 
		 });



        // Itemwise Discount
        $(document).on('keyup','.row_discount_value', function() { 
        	
        	 var row_id = $(this).closest('tr').attr('id');
			 var discount = $(this).val();
			 
			 var row_sub_total = parseFloat($('#price_'+row_id).val());			 
			 var discount_type = $('#row_discount_type_'+row_id).val();		
			 var qty = $('#qty_'+row_id).val();		
			 var total_discount = 0;	 
			 if(discount!=''){
				 if(discount_type == '1'){
					if(discount < 100){ // Perc
						var total_discount =  (parseFloat(row_sub_total) * parseFloat(discount)/100) * parseInt(qty);
					}else{
						alert('100 % discount not allowed...');
						$(this).val(0);
					}
				}else{ //Flat
					var total_discount =  discount * parseInt(qty);
				}		
			}
			$('#row_discount_total_'+row_id).val(parseFloat(total_discount).toFixed(2));
			 get_row_total(row_id);
		});

       
		//$( ".qty" ).trigger('keyup');
		$(document).on('change','.row_discount_type', function() { 
			$( ".row_discount_value" ).trigger('keyup');
		});
	 
        
	});
	

	function check_qty_availability(row_id){
		var avail_qty = $('#row_avail_quantity_'+row_id).val();
		var qty = $('#qty_'+row_id).val();
		if(parseInt(qty) > parseInt(avail_qty)){
			alert('Entered quantity not available...');
			$('#qty_'+row_id).val('');
			$('.qty').trigger('keyup');
		}
	}
	function get_row_total(row_id){
		
		var price = $('#price_'+row_id).val();
		var qty = $('#qty_'+row_id).val();
		var gst_perc = $('#gst_perc_'+row_id).val();
		var row_disc = $('#row_discount_total_'+row_id).val();
		var base_price = 0;
		if(price && qty){
			base_price = (parseFloat(price) * qty) - parseFloat(row_disc);
		}
		//alert(base_price);
		$('#base_price_'+row_id).val(base_price.toFixed(2));
		var disc_perc_total = 0;
		/*alert(disc_perc);
		alert(base_price);*/
		$( "#discount_value" ).trigger('keyup');
		//alert(base_price);
		$('#sub_total_'+row_id).val(base_price.toFixed(2));
		if(gst_perc){
			gst_total = parseFloat(base_price) * gst_perc / 100;
			base_price = base_price + gst_total;
			$('#row_gst_'+row_id).val(gst_total.toFixed(2));
		}
		
		/*var as_perc_total = 0;
		if(as_perc){
			as_perc_total = parseFloat(base_price) * as_perc / 100;
			base_price = base_price - as_perc_total;
			$('#as_tot_'+row_id).val(as_perc_total);
		}*/
		
		$('#total_'+row_id).val(Math.round(base_price));
		get_sub_total();
		//get_discount_total();
		get_gst_total();
		get_gst_total_summary();
		get_grand_total();
		
	}
	
	function get_discount_total(){
		var total_discount = 0; 
		$('.row_discount_total').each(function(){
			if($(this).val()){
				total_discount = parseFloat(total_discount) + parseFloat($(this).val());
			}
		});
		//$('#discount_total').html(total_discount.toFixed(2));
		//$('#discount_total_hidden').val(total_discount.toFixed(2));
	}

	function get_gst_total_summary(){
		var taxale_total_5 = 0; 
		var taxale_qty_5 = 0; 
		var gst_total_5 = 0; 
		var taxale_total_12 = 0; 
		var taxale_qty_12 = 0; 
		var gst_total_12 = 0; 
		var taxale_total_18 = 0; 
		var taxale_qty_18 = 0; 
		var gst_total_18 = 0; 
		$('.row_gst_perc').each(function(){
			var row_id = $(this).closest('tr').attr('id');
			if($(this).val() == 5){
				taxale_total_5 += parseFloat($('#sub_total_'+row_id).val()); 
				taxale_qty_5 += parseFloat($('#qty_'+row_id).val());  
				gst_total_5 += parseFloat($('#row_gst_'+row_id).val()); 	
			}
			if($(this).val() == 12){
				taxale_total_12 += parseFloat($('#sub_total_'+row_id).val()); 
				taxale_qty_12 += parseFloat($('#qty_'+row_id).val());  
				gst_total_12 += parseFloat($('#row_gst_'+row_id).val()); 	
			}
			if($(this).val() == 18){
				taxale_total_18 += parseFloat($('#sub_total_'+row_id).val()); 
				taxale_qty_18 += parseFloat($('#qty_'+row_id).val());  
				gst_total_18 += parseFloat($('#row_gst_'+row_id).val()); 	
			}
		});
		
		var gst_html = '';
		if(taxale_qty_5){
			gst_html += '<tr style="font-weight:bold" class="gst_summary">';
			gst_html += '<td colspan="12" align="right">Taxable value for GST 5% : '+taxale_total_5.toFixed(2)+', Qty : '+taxale_qty_5+'</td>';
			gst_html += '<td align="right">CGST 2.5%</td><td align="right">'+(parseFloat(gst_total_5)/2).toFixed(2)+'</td>';
			gst_html += '<td></td>';
			gst_html += '</tr>';
			gst_html += '<tr style="font-weight:bold" class="gst_summary">';
			gst_html += '<td colspan="12" align="right"></td>';
			gst_html += '<td align="right">CGST 2.5%</td><td align="right">'+(parseFloat(gst_total_5)/2).toFixed(2)+'</td>';
			gst_html += '<td></td>';
			gst_html += '</tr>';
		}
		if(taxale_qty_12){
			gst_html += '<tr style="font-weight:bold" class="gst_summary">';
			gst_html += '<td colspan="12" align="right">Taxable value for GST 12% : '+taxale_total_12.toFixed(2)+', Qty : '+taxale_qty_12+'</td>';
			gst_html += '<td align="right">CGST 6%</td><td align="right">'+(parseFloat(gst_total_12)/2).toFixed(2)+'</td>';
			gst_html += '<td></td>';
			gst_html += '</tr>';
			gst_html += '<tr style="font-weight:bold" class="gst_summary">';
			gst_html += '<td colspan="12" align="right"></td>';
			gst_html += '<td align="right">CGST 6%</td><td align="right">'+(parseFloat(gst_total_12)/2).toFixed(2)+'</td>';
			gst_html += '<td></td>';
			gst_html += '</tr>';
		}
		if(taxale_qty_18){
			gst_html += '<tr style="font-weight:bold" class="gst_summary">';
			gst_html += '<td colspan="12" align="right">Taxable value for GST 18% : '+taxale_total_18.toFixed(2)+', Qty : '+taxale_qty_18+'</td>';
			gst_html += '<td align="right">CGST 9%</td><td align="right">'+(parseFloat(gst_total_18)/2).toFixed(2)+'</td>';
			gst_html += '<td></td>';
			gst_html += '</tr>';
			gst_html += '<tr style="font-weight:bold" class="gst_summary">';
			gst_html += '<td colspan="12" align="right"></td>';
			gst_html += '<td align="right">CGST 9%</td><td align="right">'+(parseFloat(gst_total_18)/2).toFixed(2)+'</td>';
			gst_html += '<td></td>';
			gst_html += '</tr>';
		}
		if($(".gst_summary").is(":visible")){
			$(".gst_summary").remove();
			$('#discount_row').after(gst_html);
		}else{
			$('#discount_row').after(gst_html);
		}
		
		//$('#discount_total_hidden').val(total_discount.toFixed(2));
	}

	
	function get_sub_total(){
		var sub_total = 0; 
		$('.total').each(function(){
			if($(this).val()){
				sub_total = parseFloat(sub_total) + parseFloat($(this).val());
			}
		});
		$('#sub_total').html(sub_total.toFixed(2));
		$('#sub_total_hidden').val(sub_total.toFixed(2));
	 }
	 
	 function get_gst_total(){
	 	var gst_total = 0;
	 	$('.row_gst').each(function(){
			if($(this).val()){
				gst_total = parseFloat(gst_total) + parseFloat($(this).val());
			}
		});

		 
		var gst_percentage = 18;
		gst_total = gst_total + parseFloat($('#p_and_f_total_hidden').val());
		
		total_before_gst = (parseFloat($('#sub_total_hidden').val()) - parseFloat($('#discount_total_hidden').val())) + parseFloat($('#p_and_f_total_hidden').val()) + parseFloat($('#extra_total_hidden').val()); 
		
		//alert(total_before_gst);
		//gst_total = (parseFloat(total_before_gst) * parseInt(gst_percentage) ) / 100;
			
		$('#gst_total').html(gst_total.toFixed(2));
		$('#gst_total_hidden').val(gst_total.toFixed(2));
	 }
	 
	 function get_grand_total(){
		var grand_total = 0; 
		
		//grand_total = (parseFloat($('#sub_total_hidden').val()) - parseFloat($('#discount_total_hidden').val())) + parseFloat($('#gst_total_hidden').val());
		var discount_total_hidden = 0;
		if(!isNaN($('#discount_total_hidden').val())){
			discount_total_hidden = parseFloat($('#discount_total_hidden').val());
		}

		var consulting_fees = 0;
		if($('#p_and_f_total_hidden').val()!=''){
			consulting_fees = parseFloat($('#p_and_f_total_hidden').val());
		}

		var sub_total = 0;
		if($('#sub_total_hidden').val()!=''){
			sub_total = parseFloat($('#sub_total_hidden').val());
		}
		grand_total = sub_total + parseFloat(consulting_fees);
 
		//grand_total = (parseFloat($('#sub_total_hidden').val()) - discount_total_hidden) + parseFloat(consulting_fees);
		//rand_total = parseFloat($('#sub_total_hidden').val());
		
		grand_total = grand_total.toFixed(2);
		var gt = grand_total.toString().split(".");
		$('#round_off').val(parseFloat(gt[1]));
		
		$('#grand_total').html(parseInt(gt[0]).toFixed(2));
		$('#grand_total_hidden').val(parseInt(gt[0]).toFixed(2));
		
	 }
			
</script>
