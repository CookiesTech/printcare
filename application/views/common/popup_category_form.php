<div class="modal fade" id="popup_category" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="largeModalLabel">Add Business Category</h4>
                <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
            </div>
            <div class="modal-body"> 
				<div class="msg"></div>
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="text" name="category_name" id="category_name" placeholder = "Category Name" autofocus> 
						</div>
					</div>
			</div>
            <div class="modal-footer">
               <a class="btn btn-primary pull-right" id="insert_category">Save</a>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).on("click", "#insert_category", function(){
	   var name = $('#category_name').val();
	   var parent = '';
	   var parent = $('#select_business_category').val();
	   if (name == '')
	   {
		   $('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill all the fields...</strong></div>').fadeIn('slow');
	   }
	   else
	   {
		  $.ajax(
		  {
			 type: 'POST',
			 dataType: 'html',
			 url: '<?php echo base_url(); ?>index.php/Home/addMultiLevelCategoryItem',
			 data:{table:'business_category',category_field:'business_category_name',category_value:name,parent_category_field:'business_category_parent_id',parent_category_value:parent},
			 success: function(html)
			 {
				if (html == 'exist')
				{
				   $('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Category already exist...</strong></div>').fadeIn('slow');
				}
				else
				{
				   $('#select_business_category').html(html);
				   $('.msg').html('<div role="alert" class="alert alert-success alert-dismissible black  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
				   //$('.success_msg').html('Successfully Added').fadeIn('slow');
				   clearModalPopup();
				  // $("#popup_category").modal('hide');
				}
			 }
		  });
	   }
	});
            
</script>
