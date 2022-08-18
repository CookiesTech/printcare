
<script type="text/javascript">
    $(function() {
        //Tooltip
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });

        //Popover
        $('[data-toggle="popover"]').popover();
    })

    $(function() {
        $(document).on('click', '#reset', function() {
            $('#form')[0].reset();
        });

        $(document).on('click', '#reset', function() {
            $('.form')[0].reset();
        });

        var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
        $('a[data-modal-id]').click(function(e) {
            e.preventDefault();
            $("body").append(appendthis);
            $(".modal-overlay").fadeTo(500, 0.7);
            //$(".js-modalbox").fadeIn(500);
            var modalBox = $(this).attr('data-modal-id');
            $('#' + modalBox).fadeIn($(this).data());
        });


        $(".js-modal-close, .modal-overlay").click(function() {
            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });
        });

        $(window).resize(function() {
            $(".modal-box").css({
                top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
                left: ($(window).width() - $(".modal-box").outerWidth()) / 2
            });
        });

        $(window).resize();

        // DatePicker SCript
        $('.datetimepicker').datetimepicker({
            dayOfWeekStart: 1,
            lang: 'en',
            step: 30,
            format: 'd-m-Y H:i',
            formatDate: 'd-m-Y',
            yearStart: "1920", 
        }).on('change', function() {
            $('.xdsoft_datetimepicker').hide();
        });


        // DatePicker SCript
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

        // DatePicker Script - Feature Dates
        $('.datetimepickerFuture').datetimepicker({
            dayOfWeekStart: 1,
            lang: 'en',
            disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
            startDate: '2015-10-28',
            step: 5,
            format: 'd-m-Y H:i',
            formatDate: 'd-m-Y',
            minDate: '0',
            minTime: '0',
        }).on('change', function() {
            $('.xdsoft_datetimepicker').hide();
        });

        $('.datepickerFuture').datetimepicker({
            dayOfWeekStart: 1,
            lang: 'en',
            disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
            startDate: '2015-10-28',
            step: 5,
            format: 'd-m-Y',
            formatDate: 'd-m-Y',
            minDate: '0',
            minTime: '0',
        }).on('change', function() {
            $('.xdsoft_datetimepicker').hide();
        });
		
        $('.timepicker').timepicker();

    });
    $(document).ready(function() {
        $(document).on('change', '#checkAll', function() {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });

        $(".checkbox_list").click(function() {
            //alert($('input.checkbox_list:checked').length);
            $('.delete').prop('disabled', $('input.checkbox_list:checked').length == 0);
        });
    });



    function confirmDelete() {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            return true;
        else
            return false;
    }

    function clearModalPopup() {
        $("input[name=name]").val("");
        //$("select option:selected").removeAttr("selected");
        //  $('select[name=sele],select[name=appointment_feedback_id]').prop('selectedIndex', 0);
        //  $('input:checkbox').removeAttr('checked');
        setTimeout(function() {
            $('.success_msg').fadeOut();
            $('.success_msg').html(' ');
            $('.success_msg').html(' ');
            $('.msg').html(' ');
            $('.msg').fadeOut();
            $('.js-modal-close').click();
            $('.btn-dange').click();
        }, 1000);
    }

    function myFunction() {
        document.getElementById("myForm").reset();
    }

    $(document).ready(function() {
        // Load States based on Country
        $('#select_country').on('change', function() {
            var id = $(this).val();
			
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url(); ?>index.php/Home/getState?id=' + id,
                success: function(json) {
					var d_html = '';
					d_html += '<option value = "" selected>Select District</option>';
                    var html = '';
                    html += '<option value = "" selected>Select State</option>';
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
                    $('#select_state').html(html);
					$('#select_district').html(d_html);
                }
            });
        });

        // Load City based on State
        $('#select_state').on('change', function() {
            var id = $(this).val();
			
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url(); ?>index.php/patient/ajax/getDistrict?id=' + id,
                success: function(json) {
                    var html = '';
                    
                    html += '<option value = "" selected>Select District</option>';
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
                    $('#select_district').html(html);
                    
                }
            });
        });



        // Load city based on District
        $('#select_district').on('change', function() {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url(); ?>index.php/Home/getCity?id=' + id,
                success: function(json) {
                    var html = '';
                    html += '<option value = "" selected>Select City</option>';
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
                    $('#select_city').html(html);
                }
            });
        });
        
         $(document).on('change','.image_file',function(){
			var f=this.files[0];
			var fileName = f.name;
			var ext = fileName.split('.').pop();
			var allowedExt = ["jpg", "JPG","jpeg", "JPEG","png", "PNG"];
			if(allowedExt.indexOf(ext) < 0){
				$("#image_type_error_popup").modal('show');
				$(this).val('');
			}
		});
		
		 $(document).on('change','.csv_file',function(){
			var f=this.files[0];
			var fileName = f.name;
			var ext = fileName.split('.').pop();
			var allowedExt = ["csv", "CSV"];
			if(allowedExt.indexOf(ext) < 0){
				alert('Invalid file format...');
				$(this).val('');
			}
		});
		
		 $(document).on('change','.excel_file',function(){
			var f=this.files[0];
			var fileName = f.name;
			var ext = fileName.split('.').pop();
			var allowedExt = ["xls", "XLS","xlsx", "XLSX"];
			if(allowedExt.indexOf(ext) < 0){
				alert('Invalid file format...');
				$(this).val('');
			}
		});

		$(document).on('change','.file_size_1',function(){
			var f=this.files[0];
			if(f.fileSize > 1048576 || f.size > 1048576){
				//$("#image_size_error_popup").modal('show');
				alert('File size is too large...');
				$(this).val('');
			}
		});
		
		
		$(document).on('change','.pdf_file',function(){
			var f=this.files[0];
			var fileName = f.name;
			var ext = fileName.split('.').pop();
			var allowedExt = ["pdf","PDF"];
			if(allowedExt.indexOf(ext) < 0){
				alert('Invalid file format...');
				//$("#image_type_error_popup").modal('show');
				$(this).val('');
			}
		});
		
		$(document).on('change','.mixed_file',function(){
			var f=this.files[0];
			var fileName = f.name;
			var ext = fileName.split('.').pop();
			var allowedExt = ["jpg", "JPG","jpeg", "JPEG","doc", "DOC","docx","DOCX","pdf","PDF","xls","xlsx","zip"];
			if(allowedExt.indexOf(ext) < 0){
				alert('Invalid file format...');
				//$("#image_type_error_popup").modal('show');
				$(this).val('');
			}
		});
	
	
    });
    //chat 
    login_member_name = '';
    $(document).ready(function() {
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url(); ?>index.php/login/logout',
                success: function(json) {
                    if (json == 'true') {
                        alert('Session timeout....');
                        location.reload();
                    }
                }
            });
        }, 6000000);

        function chatOnline() {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url(); ?>index.php/dashboard/ajax/getLoginusers',
                success: function(json) {
                    var html = '';
                    if (json && json.length > 1) {
                        $(json).each(function(index, value) {
                            if (login_member_name != value['membername']) {
                                html += '<div class="user"><a href="javascript:void(0)" onclick="javascript:chatWith(\'' + value['membername'] + '\')">' + value['name'] + '</a></div>';
                            }
                        });
                    } else {
                        html += '<div><p class="chat-text">Currently no user in online</p></div>';
                    }
                    $('#online-chat').html(html);
                    setTimeout(function() {
                        chatOnline();
                    }, 60000);
                }
            });

        }

        if (login_member_name != '') {
            setTimeout(function() {
                chatOnline();
            }, 100000);
        }

        $(".chat_head").on("click", function() {
            $(".chat_body").slideToggle();
        });


   
    
    	
     });  
</script>
