<div class="modal fade" id="popup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
				
                <h4 class="modal-title" id="largeModalLabel">Add New Area</h4>
                <button class="js-modal-close close" data-dismiss="modal" type="button">×</button>
            </div>
            <div class="modal-body"> 
				 <div class="msg"></div>
				<div class="form-group">
					<div class="form-line">
						<input class="form-control" type="text" name="name" id="name" placeholder="Name" autofocus> 
					</div>
				</div>
			</div>
            <div class="modal-footer">
                <a class="btn btn-primary waves-effect pull-right" id="insert">Save</a>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

$('.js-open-modal').on('click', function() {
    id = $(this).attr('id');
    popup_title = $(this).attr('alt');
    error_text = popup_title.replace("Add New", "");
    var id1 = 'popup_' + id;
    $('.trriger_popup').attr('id', id1);
    $('#popup h4').text(popup_title);
    $("#popup").modal('show');
    $('#name').focus();
});


$('#name').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {
        $('#insert').click();
        return false;
    }
});

$(document).on("click", "#insert", function() {
    var name = $('#name').val();
    var parent = '';
    var parent = $('#select_category').val();
    if (name == '') {
       // alert('Please enter area name');
        $('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Please fill all the fields...</strong></div>').fadeIn('slow');
    } else {
        if (id == 'sub_category' && !parent) {
            alert('Please select parent category');
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url(); ?>index.php/home/addMasterItem?field=' + id + '&name=' + name + '&parent=' + parent,
                success: function(json) {
                    if (json == 'exist') {
						//$('#master_exist_error_popup').modal('show');
						$('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Master Name already exist...</strong></div>').fadeIn('slow');
                    } else {
                        var html = '';
                        $(json).each(function(index, value) {
                            if (value['name'] == name) {
                                html += '<option value = "' + value['id'] + '" selected="selected">' + value['name'] + '</option>';
                            } else {
                                html += '<option value = "' + value['id'] + '">' + value['name'] + '</option>';
                            }
                        });

                        if (id == 'designation') {
                            $('#email_' + id).html(html);
                            designationNew = html;
                        }
                        $('#select_' + id).html(html);
                        $('.msg').html('<div role="alert" class="alert alert-success alert-dismissible black  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span> </button> <strong>Successfully Added...</strong></div>').fadeIn('slow');
                        clearModalPopup();
                    }
                }
            });
        }
    }
});
</script>
