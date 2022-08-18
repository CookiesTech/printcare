<script>
	$(document).ready(function(){		
		$(document).on("keypress", 'form', function (e) {
		var code = e.keyCode || e.which;
		 //console.log(code);
		 if (code == 13) {
			//console.log('Inside');
			 e.preventDefault();
			 return false;
		}
	});
   
    CKEDITOR.replace('email_message',{ height : 100 });
   $(document).on('change','#select_client', function() {
   var p_row_id = $(this).parent().parent().attr('id');
           var id = $(this).val();
           $.ajax({
               type: 'POST',
               dataType: 'json',
               data:{table:'client_email_ids',field:'ref_client_id',id:id},
               url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_client_email_details',
               success: function(json) {
                   var html = '';
                   var i = 1;                    
                   if (json) {
                       $(json).each(function(index, value){
							html += '<input id="email_'+[i]+'" class="" type="checkbox" name="client_email[]" value="'+value['email_id']+'"></input><label for="email_'+[i]+'">'+value['email_id']+'</label><br>';
							i++;
                       });
                   }
                   $('#email_details').html(html);
               }
           });
       });
   
   $('#select_product_request_email_template').on('change',function() {
	   var template_id = $(this).val();
	   var dc_id = '<?php echo $res;?>';
	   if(template_id){
	   $.ajax({
		   type: 'POST',
		   dataType:'json',
		   url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/update_message_template',
		   data:{template_id:template_id},
		   success: function(html) {
		   $("#email_message").html(html);
		   CKEDITOR.instances['email_message'].setData(html);
		   $('#email_message_block').slideDown();
		   }
	   });	
	   }else{
	   alert('Please select email template...');
	   }

	   $(document).on('click','.remove_product_particulars',function(){
			$(this).closest('tr').remove();
			update_serial_no();	
		});
	   
   });
   
    
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
        
        
        
        $(document).on('keyup','.qty, .price', function() {
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

		 $('#gst_type').on('change', function() {
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
		
		$('#p_and_f_type').on('change', function() { 
			$( "#p_and_f_value" ).trigger('keyup');
		});
		$('#p_and_f_value').on('keyup', function() { 
			 var p_and_f_value = $(this).val();	
			 var sub_total = parseFloat($('#sub_total_hidden').val());			 
			 var p_and_f_type = $('#p_and_f_type').val();		
			 var total_p_and_f = 0;	 
			 if(p_and_f_type == '1'){
				if(p_and_f_value < 100){ // Perc
					var total_p_and_f =  parseFloat(sub_total) * parseFloat(p_and_f_value)/100;
				}else{
					alert('100 % discount not allowed...');
					$(this).val(0);
				}
			}else{ //Flat
				
				var total_p_and_f =  p_and_f_value;
			}
						
			$('#p_and_f_total').html(parseFloat(total_p_and_f).toFixed(2));
			$('#p_and_f_total_hidden').val(parseFloat(total_p_and_f).toFixed(2));
		
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
	 
	
       //~ $(document).on('change','#select_supplier', function() {
			//~ var p_row_id = $(this).parent().parent().attr('id');
			//~ //alert(p_row_id	);
            //~ var id = $(this).val();
            //~ $.ajax({
                //~ type: 'POST',
                //~ dataType: 'json',
                //~ data:{table:'product',field:'ref_supplier_id',id:id},
                //~ url: '<?php echo base_url(); ?>index.php/Home/getOptionItem',
                //~ success: function(json) {
                    //~ var html = '';
		  //~ 
                    //~ var i = 1;                    
                    //~ if (json) {
                        //~ $(json).each(function(index, value) {
							//~ html += '<tr><td align="center">'+i+'</td><td>'+value['name']+'</td><td><input type="hidden" name="tbl_proforma_invoice_particulars['+i+'][ref_product_id]" value="'+value['id']+'" id="product_id"><input type="text" name="tbl_proforma_invoice_particulars['+i+'][qty]"  class="total form-control" id="total_1" size="5" style="width:80px;" onkeypress="return isNumber(event)" ></td></tr>';
						//~ i++;
                        //~ });
                    //~ }
                    //~ $('#product_body').html(html);
                //~ }
            //~ });
        //~ });
        //~ 
        
        
	$('.company_proforma').on('click', function(){
		if($(this).is(":checked")){
			$( "#company_proforma_file" ).prop( "disabled", false );
		}else{
			$( "#company_proforma_file" ).prop( "disabled", true );
			$( "#company_proforma_file" ).val("");
		}
	});
	});
	
	function get_row_total(row_id){
		
		var price = $('#price_'+row_id).val();
		var qty = $('#qty_'+row_id).val();
		var disc_perc = $('#disc_perc_'+row_id).val();
		var as_perc = $('#as_perc_'+row_id).val();
		var base_price = 0;
		if(price && qty){
			base_price = parseFloat(price) * qty;
		}
		$('#base_price_'+row_id).val(base_price.toFixed(2));
		var disc_perc_total = 0;
		if(disc_perc){
			disc_perc_total = parseFloat(base_price) * disc_perc / 100;
			base_price = base_price - disc_perc_total;
			$('#disc_tot_'+row_id).val(disc_perc_total);
		}
		
		var as_perc_total = 0;
		if(as_perc){
			as_perc_total = parseFloat(base_price) * as_perc / 100;
			base_price = base_price - as_perc_total;
			$('#as_tot_'+row_id).val(as_perc_total);
		}
		
		$('#total_'+row_id).val(base_price.toFixed(2));

		get_sub_total();
		get_discount_total();
		get_gst_total();
		get_grand_total();
		$( "#discount_value" ).trigger('keyup');
		$( "#p_and_f_discount_value" ).trigger('keyup');
	}
	
	function get_discount_total(){
		
		//~ var total_discount = 0; 
		//~ $('.disc_tot').each(function(){
			//~ if($(this).val()){
				//~ total_discount = parseFloat(total_discount) + parseFloat($(this).val());
			//~ }
		//~ });
		//~ $('#discount_total').html(total_discount.toFixed(2));
		//~ $('#discount_total_hidden').val(total_discount.toFixed(2));
		
		
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
		var gst_percentage = $('#gst_type option:selected').text();
		//alert(gst_percentage);
		total_before_gst = (parseFloat($('#sub_total_hidden').val()) - parseFloat($('#discount_total_hidden').val())) + parseFloat($('#p_and_f_total_hidden').val()) + parseFloat($('#extra_total_hidden').val()); 
		
		gst_total = (parseFloat(total_before_gst) * parseInt(gst_percentage) ) / 100;
			
		$('#gst_total').html(gst_total.toFixed(2));
		$('#gst_total_hidden').val(gst_total.toFixed(2));
	 }
	 
	
	 
	 function get_grand_total(){
		var grand_total = 0; 
		
		grand_total = (parseFloat($('#sub_total_hidden').val()) - parseFloat($('#discount_total_hidden').val())) + parseFloat($('#gst_total_hidden').val()) + parseFloat($('#p_and_f_total_hidden').val()) +parseFloat($('#extra_total_hidden').val());
		
		grand_total = grand_total.toFixed(2);
		var gt = grand_total.toString().split(".");
		$('#round_off').val(parseFloat(gt[1]));
		
		$('#grand_total').html(parseInt(gt[0]).toFixed(2));
		$('#grand_total_hidden').val(parseInt(gt[0]).toFixed(2));
	 }
	function update_serial_no(){
		$('.sno').each(function(index, value) {
			var sno = index+1;
			$(this).html(sno);
		});
	}

</script>
