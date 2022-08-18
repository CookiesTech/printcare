<script>
   $(document).ready(function() {
	    var page = '<?php echo $table; ?>';
	
       $('#form').on('click', function() {
     var str = $( "#masters" ).serialize();
     //alert(str);
     
           var $inputs = $('#masters :input');
           var values = {};
           $inputs.each(function() {
     
		  if(this.name !='proposal_basic_type_content' && this.name !='ref_product_quality_id' && this.name !='ref_product_quality_size_id' && this.name !='description' && this.name !='image_file'){
    			if ($(this).val() == ''  && this.name != '') {
    			   alert('Please fill all the fields...');
    			   e.preventDefault();
    			}
		  }
           
           });
   
           var page = '<?php echo $table; ?>';
           var name = $('#table_name').val();
			
           $.ajax({
               type: 'POST',
               dataType: 'json',
               data : str,
               url: '<?php echo base_url(); ?>index.php/master/Ajaxadd',
               success: function(json) {
                   if (json == 'exist') {
                        $('.success_msg').html('<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>The Name Value Already exist..!</strong></div> ').fadeIn('slow');
                      // $('#table_name').val('');
                       //e.preventDefault();
                   } else if(json == 'success'){
                       $('.success_msg').html('<div role="alert" class="alert alert-success alert-dismissible black "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
                        $('#table_name').val('');
                        clearModalPopup();
                   } else if(json == 'error'){
                       $('.success_msg').html('<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Error Occured Please check the data & try again...</strong></div> ').fadeIn('slow');
                   }
               }
           });
   
       });
       
      //~ if(page == 'product_quality'){ 
			//~ $('#select_supplier').on('change', function() {
			//~ var id = $(this).val();
			//~ $.ajax({
					//~ type: 'POST',
					//~ dataType: 'json',
					//~ url: '<?php echo base_url(); ?>index.php/master/get_supplier_quality?id=' + id,
					//~ success: function(json) {
						//~ var html = '';
						//~ html += '<option value = "" selected>Product Quality</option>';
						//~ if (json) {
							//~ $(json).each(function(index, value) {
								//~ //alert(value['area_name']);
								//~ if (value['name'] == name) {
									//~ html += '<option value = "' + value['id'] + '" selected>' + value['name'] + '</option>';
								//~ } else {
									//~ html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
								//~ }
							//~ });
						//~ }
						//~ $('#select_quality').html(html);
					//~ }
				//~ });
		//~ });
	//~ }
     //~ 
     //~ if(page == 'product_quality_size'){   
	//~ $('#select_supplier').on('change', function() {
	    //~ var id = $(this).val();
		//~ $.ajax({
                //~ type: 'POST',
                //~ dataType: 'json',
                //~ url: '<?php echo base_url(); ?>index.php/master/get_supplier_quality_size?id=' + id,
                //~ success: function(json) {
                    //~ var html = '';
                    //~ html += '<option value = "" selected>Product Quality Size</option>';
                    //~ if (json) {
                        //~ $(json).each(function(index, value) {
                            //~ //alert(value['area_name']);
                            //~ if (value['name'] == name) {
                                //~ html += '<option value = "' + value['id'] + '" selected>' + value['name'] + '</option>';
                            //~ } else {
                                //~ html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
                            //~ }
                        //~ });
                    //~ }
                    //~ $('#select_quality_size').html(html);
                //~ }
            //~ });
	//~ });
//~ }
       //
       
       
       
       
       
       
       $('#select_supplier').on('change', function(){
		    var id = $(this).val();
			//alert(id);
		    $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{id:id},
                url: '<?php echo base_url(); ?>index.php/master/get_product_list',
                success: function(json) {
                    var html = '';
				if (json['product']) {
		var html = '<option value="">Select Product</option>';
                        $(json['product']).each(function(index, value) {
	    html += '<option value="'+value['product_id']+'">'+value['product_name']+'</option>';
						
                        });
                        $('#select_product').html(html);
                    }
                    
                   
                }
            });
		});

		$('#select_supplier_size').on('change', function(){
		    var id = $(this).val();
			//alert(id);
		    $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{id:id},
                url: '<?php echo base_url(); ?>index.php/master/get_product_list',
                success: function(json) {
                    var html = '';
		  if (json['product']) {
		var html = '<option value="">Select Product</option>';
                        $(json['product']).each(function(index, value) {
	    html += '<option value="'+value['product_id']+'">'+value['product_name']+'</option>';
						
                        });
                        $('#select_product_size').html(html);
                    }
                    
                   
                }
            });
		});
		
   function clearModalPopup()
   {
   $("input[type=text], textarea").val("");
   $("select option:selected").removeAttr("selected");
   $('select[name=sele],select[name=appointment_feedback_id]').prop('selectedIndex', 0);
   $('input:checkbox').removeAttr('checked');
   }
   
       
      
   
       // Load States based on Country
       $('#service').on('change', function() {
           var id = $(this).val();
           $.ajax({
               type: 'POST',
               dataType: 'json',
               url: '<?php echo base_url(); ?>index.php/master/getType?id=' + id,
               success: function(json) {
                   var html = '';
                   if (id == '1') {
                       html += '<select name="ref_domain_type_id" class="form-control">';
                   } else if (id == '2') {
                       html += '<select name="ref_server_type_id" class="form-control">';
                   }
   
                   if (id == '1' || id == '2') {
                       html += '<option value = "" selected>Select Type</option>';
                       if (json) {
                           $(json).each(function(index, value) {
                               //alert(value['area_name']);
                               if (value['name'] == name) {
                                   html += '<option value = "' + value['id'] + '" selected>' + value['name'] + '</option>';
                               } else {
                                   html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
                               }
                           });
                       }
                       html += '</select>';
                       $('#type').html(html);
                   } else {
                       $('#type').html('');
                   }
               }
           });
       });
   });
</script>
