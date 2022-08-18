<script>
	$(document).ready(function(){	
		 $(document).on('click','.add_batch',function(e){	
		 	var id = $(this).attr('id');
		 	var batch_row_id = $('.product_row_'+id).length;
			//var batch_row_id = parseInt(batch_row_id)+1;
			var row_id = parseInt($('#product_body tr').length)+1;
			var price = $('.product_batch_price_'+id).val();
			$('#row_'+id).after('<tr class="product_row_'+id+'"><td align="left"></td><td align="left"></td><td align="left"></td><td align="left"></td><td></td><td></td><td align="left"><input type="text" class="form-control product_batch_'+id+'" name="tbl_product_batch['+id+'][product_batch_name][]" ></td><td align="left"><input type="text" class="form-control product_batch_price_'+id+'" id="'+id+'" name="tbl_product_batch['+id+'][price][]" value="'+price+'"></td><td align="left"><input type="text" class="form-control cur_qty  product_batch_qty_'+id+'" id="'+id+'" name="tbl_product_batch['+id+'][quantity][]" ></td><td align="left"><input type="text" class="form-control datepicker product_batch_'+id+'" name="tbl_product_batch['+id+'][manufacture_date][]" ></td><td align="left"><input type="text" class="form-control datepicker product_batch_'+id+'" name="tbl_product_batch['+id+'][expiry_date][]" ></td><td><a class="remove_product_particulars btn btn-danger">Remove</a></td></tr>');
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

	 });

		$(document).on('click','.remove_product_particulars',function(){
			var pop_id = $(this).attr('remove_pop_id');
			if(pop_id != '' && pop_id != undefined) {
				remove_po_particulars(pop_id);	
			}
			$(this).closest('tr').remove();	
			$('.qty').trigger('keyup');
		});
		$(document).on('click','.remove_product_batch',function(){
			//$(this).closest('tr').remove();	
			$(this).closest('tr').children('td,th').css('background-color','red').css('color','#fff');
			$(this).addClass('undo_product_batch btn-success').removeClass('remove_product_batch btn-danger').text('Undo');
			var id = $(this).attr('id');

			$('.remove_status_'+id).val('1');
		});
		$(document).on('click','.undo_product_batch',function(){
			//$(this).closest('tr').remove();	
			$(this).closest('tr').children('td,th').css('background-color','#fff').css('color','#000');
			$(this).removeClass('undo_product_batch btn-success').addClass('remove_product_batch btn-danger').text('Remove');
			var id = $(this).attr('id');
			$('.remove_status_'+id).val('0');
		});

	$(document).on("keyup", ".cur_qty", function() {
		var id = $(this).attr('id');
	    var sum = 0;
	    $(".product_batch_qty_"+id).each(function(){
	    	if($(this).val()!=''){
		        sum = parseInt(sum) + parseInt($(this).val());
		    }
	    });
	    var total = parseInt(sum);
	    var balance = parseInt($('#balance_'+id).val());
	    var balance_to_receive = balance - total;

	    $('#balance_to_receive_'+id).val(balance_to_receive);
	    if(total > balance){
	    	alert('Quantity Exceed...');
	    	$(this).val('');
	    	$('#balance_to_receive_'+id).val('0');
	    }

	    //$(".total").val(sum);
	});


		//~ $(document).on("keypress", 'form', function (e) {
		//~ var code = e.keyCode || e.which;
		 //~ //console.log(code);
		 //~ if (code == 13) {
			//~ //console.log('Inside');
			 //~ e.preventDefault();
			 //~ return false;
		//~ }
	//~ });

	 //~ $(document).on('click','.add_product_particular',function(e){	
			//~ var row_id = parseInt($('#product_particulars_list tbody tr:last').attr('id'))+1;
			//~ var supplier_html = '<?php echo $supplier_html; ?>';
			//~ $('#product_particulars_list tbody tr:last').after('<tr id="'+row_id+'"><td align="center">'+row_id+'</td><td><select class="select_supplier form-control" id="select_supplier_'+row_id+'" name="tbl_purchase_order_particulars['+row_id+'][ref_supplier_id]" ><option value="">Select Supplier</option>'+supplier_html+'</select></td><td><select class="select_product form-control" id="select_product_'+row_id+'" name="tbl_purchase_order_particulars['+row_id+'][ref_product_id]"><option value="">Select Product</option></select></td><td><input type="text" name="tbl_purchase_order_particulars['+row_id+'][qty]" value="" class="form-control"  size="5" style="width:80px;" onkeypress="return isNumber(event)"></td><td><a class="remove_product_particulars btn btn-danger"><i class="fa fa-remove"></i></a></td></tr>');
	//~ });
	        //~ 
    //~ $(document).on('click','.remove_product_particulars',function(){
		//~ $(this).closest('tr').remove();	
	//~ });
	
       //~ $(document).on('change','#select_supplier', function() {
			//~ var p_row_id = $(this).parent().parent().attr('id');
            //~ var id = $(this).val();
            //~ $.ajax({
                //~ type: 'POST',
                //~ dataType: 'html',
                //~ data:{id:id},
                //~ url: '<?php echo base_url(); ?>index.php/purchase_order/ajax/get_supplier_product_list',
                //~ success: function(html) {
                    //~ if (html) {
                        //~ $('#product_body').html(html); 
                        //~ $('.datepicker').datetimepicker({
							//~ dayOfWeekStart: 1,
							//~ lang: 'en',
							//~ disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
							//~ startDate: '2015-10-28',
							//~ step: 5,
							//~ format: 'd-m-Y',
							//~ formatDate: 'd-m-Y',
						//~ }).on('change', function() {
							//~ $('.xdsoft_datetimepicker').hide();
						//~ });
                    //~ }
                   //~ 
                //~ }
            //~ });
        //~ });
         $(document).on('keyup','.qty,.price', function() {
			 var row_id =$(this).closest('tr').attr('id');
			 get_row_total(row_id);
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
						
			$('#discount_total').html(parseFloat(total_discount).toFixed(2));
			$('#discount_total_hidden').val(parseFloat(total_discount).toFixed(2));
		
			get_gst_total();
			get_grand_total();
		});
		
		$('#discount_type').on('change', function() { 
			$( "#discount_value" ).trigger('keyup');
		});
		
        $('#round_off_type').on('change', function() {
			 var type = $(this).val();			 
			 var rounded_value = 0;			 
			 grand_total = (parseFloat($('#sub_total_hidden').val()) - parseFloat($('#discount_total_hidden').val())) + parseFloat($('#gst_total_hidden').val()) + parseFloat($('#p_and_f_total_hidden').val()) +parseFloat($('#extra_total_hidden').val());
			 
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
	 
        
	});
	
	function get_row_total(row_id){
		
		var price = $('#price_'+row_id).val();
		var qty = $('#qty_'+row_id).val();
		var disc_perc = $('#supplier_comm_perc_'+row_id).val();
		var as_perc = $('#as_perc_'+row_id).val();
		var gst_perc = $('#gst_perc_'+row_id).val();
		var base_price = 0;
		if(price && qty){
			base_price = parseFloat(price) * qty;
		}
		$('#base_price_'+row_id).val(base_price.toFixed(2));
		
		var disc_perc_total = 0;
		if(disc_perc){
			disc_perc_total = parseFloat(base_price) * disc_perc / 100;
			base_price = base_price - disc_perc_total;
			$('#supplier_comm_total_'+row_id).val(disc_perc_total.toFixed(2));
		}
		
		var as_perc_total = 0;
		if(as_perc){
			as_perc_total = parseFloat(base_price) * as_perc / 100;
			base_price = base_price - as_perc_total;
			$('#as_tot_'+row_id).val(as_perc_total);
		}

		$('#sub_total_'+row_id).val(base_price.toFixed(2));

		if(gst_perc){
			gst_total = parseFloat(base_price) * gst_perc / 100;
			$('#row_gst_'+row_id).val(gst_total.toFixed(2));
		}

		// $('#total_'+row_id).val(Math.round(base_price));
		$('#total_'+row_id).val((base_price+gst_total).toFixed(2));
		get_sub_total();
		get_discount_total();
		get_gst_total();
		get_grand_total();
		$( "#discount_value" ).trigger('keyup');
	}
	
	function get_discount_total(){
		
		var total_discount = 0; 
		$('.supplier_comm_total').each(function(){
			if($(this).val()){
				total_discount = parseFloat(total_discount) + parseFloat($(this).val());
			}
		});
		$('#supp_discount_total').html(Math.round(total_discount).toFixed(2));
		$('#supp_discount_total_hidden').val(Math.round(total_discount).toFixed(2));
		
		
	}
	
	function get_sub_total(){
		var sub_total = 0; 
		$('.row_total').each(function(){
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

		$('#gst_total').html(gst_total.toFixed(2));
		$('#gst_total_hidden').val(gst_total.toFixed(2));
	 }
	 
	 function get_grand_total(){
		var grand_total = 0;
		grand_total = parseFloat($('#sub_total_hidden').val()) + parseFloat($('#gst_total_hidden').val()) ;
		$('#grand_total').html(Math.round(grand_total.toFixed(2)));
		$('#grand_total_hidden').val(Math.round(grand_total.toFixed(2)));
		
	 }
	 
	 function remove_po_particulars(pop_id) {
		$.ajax({ 
		type: "POST",
		data:{pop_id:pop_id},
		url: '<?php echo base_url(); ?>index.php/purchase_order/remove_po_particulars',
		success: function(result){ 
			console.log(result);
		}
		});
	 }
			
</script>
