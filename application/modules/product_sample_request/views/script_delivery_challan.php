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
							//~ html += '<tr><td align="center">'+i+'</td><td>'+value['name']+'</td><td><input type="hidden" name="tbl_delivery_challan_particulars['+i+'][ref_product_id]" value="'+value['id']+'" id="product_id"><input type="text" name="tbl_delivery_challan_particulars['+i+'][qty]"  class="total form-control" id="total_1" size="5" style="width:80px;" onkeypress="return isNumber(event)" ></td></tr>';
						//~ i++;
                        //~ });
                    //~ }
                    //~ $('#product_body').html(html);
                //~ }
            //~ });
        //~ });
        
	});
</script>
