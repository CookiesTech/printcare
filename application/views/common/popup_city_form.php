<div class="modal fade" id="popup_city" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
                <h4 class="modal-title" id="largeModalLabel">Add City</h4>
                
            </div>
            <div class="modal-body"> 
				<div class="msg"></div>
				<h4><b>Please select the District first...</b></h4>
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="city_name" id="city_name" placeholder = "City Name" autofocus> 
						</div>
					</div>
					</div>
            <div class="modal-footer">
               <a class="btn btn-primary pull-right" id="insert_city">Save</a>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).on("click", "#insert_city", function(){
	   var name = $('#city_name').val();
	   var parent = '';
	   var parent = $('#select_district').val();
	   if (name == '')
	   {
		   $('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill all the fields...</strong></div>').fadeIn('slow');
	   }
	   else
	   {
		  $.ajax(
		  {
			 type: 'POST',
			 dataType: 'json',
			 url: '<?php echo base_url(); ?>index.php/Home/addParentItem',
			 data:{table:'city',field:'city_name',value:name,parent_field:'ref_district_id',parent_value:parent},
			 success: function(json)
			 {
				if (json == 'exist')
				{
				   $('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Category already exist...</strong></div>').fadeIn('slow');
				}
				else
				{
					var html = '';
					$(json).each(function(index, value) {
						if (value['name'] == name) {
							html += '<option value = "' + value['id'] + '" selected="selected">' + value['name'] + '</option>';
						} else {
							html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
						}
					});

				   $('#select_city').html(html);				  
				   $('.msg').html('<div role="alert" class="alert alert-success alert-dismissible black fade in"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
				   clearModalPopup();
				 
				}
			 }
		  });
	   }
	});
            
</script>
