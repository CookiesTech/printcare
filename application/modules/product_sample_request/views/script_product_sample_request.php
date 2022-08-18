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
	 $(document).on('click','.add_product_particular',function(e){	
			var row_id = parseInt($('#product_particulars_list tbody tr:last').attr('id'))+1;
			var supplier_html = '<?php echo $supplier_html; ?>';
			$('#product_particulars_list tbody tr:last').after('<tr id="'+row_id+'"><td align="center"><span class="sno">'+row_id+'</span></td><td align="left"><input type="text" class="product form-control" id="product_'+row_id+'"><input type="hidden" name="tbl_product_sample_request_particulars['+row_id+'][ref_product_id]"  id="product_id_'+row_id+'"></td><td align="right"><input type="text" name="tbl_product_sample_request_particulars['+row_id+'][qty]" class="form-control text-right" style="width:80px;" id="qty_'+row_id+'"></td><td align="right"><a class="remove_product_particulars btn btn-danger"><i class="fa fa-remove"></i></a></td></tr>');
	});
	        
    $(document).on('click','.remove_product_particulars',function(){
		$(this).closest('tr').remove();
		update_serial_no();	
	});
	
       $(document).on('change','#select_supplier1', function() {
			var p_row_id = $(this).parent().parent().attr('id');
			//alert(p_row_id	);
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{table:'product',field:'ref_supplier_id',id:id},
                url: '<?php echo base_url(); ?>index.php/Home/getOptionItem',
                success: function(json) {
                    var html = '';
		  
                    var i = 1;                    
                    if (json) {
                        $(json).each(function(index, value) {
							html += '<tr><td align="center"><span class="sno">'+i+'</span></td><td>'+value['name']+'</td><td align="right"><input type="hidden" name="tbl_product_sample_request_particulars['+i+'][ref_product_id]" value="'+value['id']+'" id="product_id"><input type="text" name="tbl_product_sample_request_particulars['+i+'][qty]"  class="total form-control text-right" id="total_1" size="5" style="width:80px;" onkeypress="return isNumber(event)" ></td></tr>';
						i++;
                        });
                    }
                    $('#product_body').html(html);
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
