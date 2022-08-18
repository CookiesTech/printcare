
		<footer class="footer">© <?php echo date('Y'); ?><a href="#" target="_blank"> Test</a></footer>
    </div>
</div>
  
  
  
<script>
$(document).ready(function(){
	var alloted_time = '';
	balance_time = '';
	tot_task_time = '';
	<?php if(isset($total_task_time_alert)){ ?>
		var alloted_time = '<?php echo abs($total_task_time_alert); ?>';
	<?php } ?>
	<?php if(isset($total_task_time_balance)){ ?>
		balance_time = '<?php echo abs($total_task_time_balance); ?>';
	<?php } ?>
	var username = '';
	<?php if(isset($username) && !empty($username)){ ?>
		username = 'Hi,<?php echo $username; ?>';
	<?php } ?>
	var tot_task_time = (parseInt(alloted_time) + parseInt(balance_time));
	//alert(tot_task_time);
	setTimeout(function(){ 
		var seconds_final = 0;
		var hms = $('#timer').text();
		//alert(hms);
		if(hms != '00:00:00'){
			var a = hms.split('-'); // split it at the colons

			// minutes are worth 60 seconds. Hours are worth 60 minutes.
			
			var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
			seconds_final =  seconds * 1000;
		}
		//alert(seconds_final);
		if(seconds_final){ 
			if(seconds_final < tot_task_time){
			rem_time_alert = (alloted_time - seconds_final);
			
	
			if(rem_time_alert>0){
				rem_time_alert = rem_time_alert;
				var notiStatus = '80 % of Time completed...make it fast...';
				//var notiStatus = 'pre_alert';
			}else{
				rem_time_alert = (parseInt(balance_time) + parseInt(seconds_final));
				var notiStatus = 'Time completed...you are exceeding time limit...';
				//var notiStatus = 'final_alert';
			}

			setTimeout(function(){  
				notifyMe(notiStatus);
				 }, rem_time_alert);
				 
			 }else{
				 alert('exceed');
				 var notiStatus = 'Time completed...you are exceeding time limit...';
				 setTimeout(function(){  
					notifyMe(notiStatus);
				 }, 1000);
			 }
		}
			 
		 }, 1000);
	
	});
	
	
function final_alert(){
	var notiStatus = 'Time completed...you are exceeding time limit...';
	var finalAltStatus = 1;
	setTimeout(function(){  
			notifyMe(notiStatus,finalAltStatus);
			 }, balance_time);
		 
}	

	
function notifyMe(notiStatus,finalAltStatus) {
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check if the user is okay to get some notification
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
  var options = {
        body: notiStatus,
        icon: "icon.jpg",
        dir : "ltr"
    };
  var notification = new Notification(username,options);
	if(finalAltStatus!=1){
		final_alert();
	}
  }

  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // Whatever the user answers, we make sure we store the information
      if (!('permission' in Notification)) {
        Notification.permission = permission;
      }

      // If the user is okay, let's create a notification
      if (permission === "granted") {
        var options = {
              body: notiStatus,
              icon: "icon.jpg",
              dir : "ltr"
          };
        var notification = new Notification(username,options);
        if(finalAltStatus!=1){
			final_alert();
		}
      }
    });
  }

}



function notifyReminder(title,content) {
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    //alert("This browser does not support desktop notification");
  }

  // Let's check if the user is okay to get some notification
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
  var options = {
        body: content,
        icon: "icon.jpg",
        dir : "ltr"
    };
  var notification = new Notification(title,options);
  }

  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // Whatever the user answers, we make sure we store the information
      if (!('permission' in Notification)) {
        Notification.permission = permission;
      }

      // If the user is okay, let's create a notification
      if (permission === "granted") {
        var options = {
              body: content,
              icon: "icon.jpg",
              dir : "ltr"
          };
        var notification = new Notification(title,options);
        
      }
    });
  }

}




$(document).ready(function(){
	<?php if(isset($user_id)){ ?>
	//notifyRm();
	function notifyRm(){
		$.ajax({
			type: 'POST',
			dataType:'json',
			url: '<?php echo base_url(); ?>index.php/dashboard/getNotificationReminder',
			success: function(json) {
				$( json).each(function( index, value ) {
					var content = value['general_reminder_details'];
					var title = 'General Reminders';
					//notifyReminder(title,content);
				});
				setTimeout(function(){
					//notifyRm();
				}, 360000);
			  }
		});
	}
	<?php } ?>
});

// AUTO REFRESH TO AVOID PAGE LOGOUT 
//~ $(document).ready(function(){
	//~ autoRefresh();
	//~ function autoRefresh(){
		//~ setTimeout(function(){
			//~ location.reload(); 
			//~ autoRefresh();
		//~ }, 600000);
	  //~ }
//~ });

</script>


 <!-- Form Validation Start -->
    <script>
		$(document).ready(function(){
			
			$(document).on('click','.contact_number_primary',function () {
				$(".contact_number_primary").removeAttr('checked');
				$(this).prop('checked',true);
			});

			$(document).on('change','.email_primary',function () {
				$(".email_primary").removeAttr('checked');
				$(this).prop('checked',true);
			});			
			// Check Profile image Size
			$('.file').change(function(){
				var f=this.files[0];
				var fileName = f.name;
				var ext = fileName.split('.').pop();
				var allowedExt = ["jpg", "JPG", "jpeg", "JPEG","png","PNG","doc","docx","pdf","PDF","xlsx"];
				//if(f.fileSize > 1048576 || f.size > 1048576){
				if(allowedExt.indexOf(ext) < 0){
					alert('Invalid file format...');
					$(this).val('');
				}
				if(f.fileSize > 1048576 || f.size > 1048576){
					alert('File size too large...');
					$(this).val('');
				}
			});
		});
		
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	
	</script>
	
</body>

</html>
