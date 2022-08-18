<style>
#cke_1_top,#cke_1_bottom{display:none;}
</style>
<script>
	CKEDITOR.replace('email_message',{ height : 100 });
	$(document).ready(function(){
		$('#send_policy_claim').on('click',function() {				
		   var supplier_email = [];
           $.each($("input[name='supplier_email']:checked"), function(){            
                supplier_email.push($(this).val());
				supplier_email.join(", ");
           });
	     //alert(supplier_email);
            var sample_id = '<?php echo $this->uri->segment(3); ?>';
            var type = '<?php echo $type; ?>';
			var email_additional = $('#email_additional').val();
			var email_subject = $('#email_subject').val();			
			var email_message = CKEDITOR.instances['email_message'].getData();
			if((supplier_email !=''|| email_additional !='' ) && email_subject !='' && email_message !='' ){
				$.ajax({
					type: 'POST',
					dataType:'json',
					url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/send_email_notification',
					data:{
					    sample_id:sample_id,
					    email:supplier_email,
					    email_additional:email_additional,
					    email_subject:email_subject,
					    email_message:email_message},
					beforeSend: function(){
						$('#send_policy_claim').text('Please wait...Notification is sending...');
						$("#status").css("display", "block");
						$("#loader").css("display", "block");
					},
					success: function(json) {
						$('#send_policy_claim').text('Send Email');
						$("#status").fadeOut("slow"); 
						$("#loader").delay(500).fadeOut(); 
						if(json == 'false'){
							$('.email_response').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Mail not sent... </strong></div>');
							$("html, body").animate({ scrollTop: 0 }, "slow");
						}else{
							$('.email_response').html('<div role="alert" class="alert alert-success black alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> <strong>Mail sent successfully...</strong></div>');
							$("html, body").animate({ scrollTop: 0 }, "slow");							
						}
					}
				});	
			}else{
				alert('Please fill required fields... ');
			}				
		});
		
		
		$('#send_sms').on('click',function() {				
		   var client_mobile = [];
           $.each($("input[name='client_mobile']:checked"), function(){            
                client_mobile.push($(this).val());
				client_mobile.join(", ");
           });
            var policy_id = '<?php echo $this->uri->segment(3); ?>';
            var client_id = 0;
			var mobile_additional = $('#mobile_additional').val();
			var sms_message = $('#sms_message').val();
			if((client_mobile !=''|| mobile_additional !='' ) && sms_message !='' ){
				$.ajax({
					type: 'POST',
					dataType:'json',
					url: '<?php echo base_url(); ?>index.php/policy/ajax/sendSMSNotification',
					data:{policy_id:policy_id,client_id:client_id,mobile:client_mobile,mobile_additional:mobile_additional,sms_message:sms_message},
					beforeSend: function(){
						$('#send_sms').text('Please wait...Notification is sending...');
						$("#status").css("display", "block");
						$("#loader").css("display", "block");
					},
					success: function(json) {
						$('#send_sms').text('Send Email');
						$("#status").fadeOut("slow"); 
						$("#loader").delay(500).fadeOut(); 
						if(json == 'false'){
							$('.sms_response').html('<div role="alert" class="alert alert-danger alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>SMS not sent... </strong></div>');
							$("html, body").animate({ scrollTop: 0 }, "slow");
						}else{
							$('.sms_response').html('<div role="alert" class="alert alert-success black alert-dismissible  "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> <strong>SMS sent successfully...</strong></div>');
							$("html, body").animate({ scrollTop: 0 }, "slow");							
						}
					}
				});	
			}else{
				alert('Please fill required fields... ');
			}				
		});
		
		$('#select_product_request_email_template').on('change',function() {
			var template_id = $(this).val();
			var sample_request_id = $('#sample_id').val();
			//alert(sample_request_id);
			if(template_id){
		$.ajax({
			type: 'POST',
			dataType:'json',
			url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/update_message_template',
			data:{
			    template_id:template_id,
			    sample_request_id:sample_request_id
			    },
			beforeSend: function(){
				$("#send_policy_claim").html("Please wait...Notification is sending...");
			},
			success: function(html) {
			$("#send_policy_claim").html("Send Email");
				//$("#email_message").html(html);
				//alert(html);
			CKEDITOR.instances['email_message'].setData(html);
			$('#email_message_block').slideDown();
			}
		});	
			}else{
				alert('Please select email template...');
			}
		});
		
	});
	
		
	
</script>
