<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset_url(); ?>images/favicon.ico">
    <title><?php echo $title; ?></title>
    <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/footable.core.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/bootstrap-select.min.css" rel="stylesheet" />
    
    <link href="<?php echo asset_url(); ?>css/style.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/font-awesome.min.css" rel="stylesheet">
    
    
    
    <link href="<?php echo asset_url(); ?>css/themify-icons.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/flag-icon.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/custom.css" rel="stylesheet">
    <!--
    <link href="<?php echo asset_url(); ?>morrisjs/morris.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/simple-line-icons.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/weather-icons.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/linea.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/spinners.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/animate.css" rel="stylesheet">-->

    <!-- <link href="<?php echo asset_url(); ?>css/blue.css" id="theme" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    
<![endif]-->
  <!-- All Jquery -->
     <script src="<?php echo asset_url(); ?>js/jquery-2.1.1.min.js"></script>
   
    <script src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/popper.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo asset_url(); ?>js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo asset_url(); ?>js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo asset_url(); ?>js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo asset_url(); ?>js/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo asset_url(); ?>js/custom.min.js"></script>
    
    <script src="<?php echo asset_url(); ?>js/footable.all.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap-select.min.js" type="text/javascript"></script>
    <!-- page plugins -->
    <!--sparkline JavaScript -->
    <!--<script src="<?php echo asset_url(); ?>sparkline/jquery.sparkline.min.js"></script>-->
    <!--morris JavaScript -->
    <!--<script src="<?php echo asset_url(); ?>raphael/raphael-min.js"></script>
    <script src="<?php echo asset_url(); ?>morrisjs/morris.min.js"></script>-->
    <!-- Chart JS -->
   <!-- <script src="<?php echo asset_url(); ?>js/dashboard1.js"></script>
   <script src="<?php echo asset_url(); ?>styleswitcher/jQuery.style.switcher.js"></script>-->
   
 <!--DateTime Picker--->
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/datetimepicker/jquery.datetimepicker.css"/>
  <script src="<?php echo asset_url(); ?>js/datetimepicker/jquery.datetimepicker.full.js"></script>
  <!---End--->
  <!--Time Picker--->
  <link rel="stylesheet" href="<?php echo asset_url(); ?>css/timepicker/jquery.timepicker.css">
  <script src="<?php echo asset_url(); ?>js/timepicker/jquery.timepicker.min.js"></script>
  <!---End--->
  
  <!---Timer --->
  <script src="<?php echo asset_url(); ?>js/timer/jquery_timer.js"></script>
  <!--End -->
  
  <!---Ckeditor-->
  <script src="<?php echo asset_url(); ?>ckeditor/ckeditor.js"></script>
  <!---End-->
  <script src="<?php echo asset_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo asset_url(); ?>css/jquery-ui.css" rel="stylesheet" /> 
</head>
<div id="loader">
<div id="status"></div>
</div>	
<script type="text/javascript">
	$(function() {
    //$("form").attr("autocomplete", "off");
		jQuery("#status").fadeOut("slow"); 
		jQuery("#loader").delay(500).fadeOut(); 
	});

   $('.ckeditor').each(function(index){
    var editor_id = $(this).attr('id');
    CKEDITOR.replace( editor_id, {
      height:"200px",
      on: {
        blur: onBlur,
        key: onKeyup
      }
    });
   });
</script>
<style>
#loader  {
     position: fixed;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     background-color: #f1f1f1;
     z-index: 99;
    height: 100%;
    opacity:0.7;
  
 }

#status  {
	width: 150px;
	height: 150px;
	position: absolute;
	left: 50%;
	top: 40%;
	background-image: url('<?php echo asset_url(); ?>images/loading.gif');
	background-repeat: no-repeat;
	background-position: center;
	margin: -100px 0 0 -50px;
 }
</style>
<?php include('popup_category_exist_error.php'); ?>
<?php include('popup_master_exist_error.php'); ?>
<?php include('popup_image_size_error.php'); ?>
<?php include('popup_image_type_error.php'); ?>
<?php include('popup_success_update.php'); ?>
<?php include('script_common.php'); ?>
<?php include('dynamic_style.php'); ?>

<?php 
$user_branch_id   = $this->session->userdata( SESSION_LOGIN . 'user_branch_id' ); 	
$branch_id   = $this->session->userdata( SESSION_LOGIN . 'branch_id' ); 	
//debug($user_branch_id); exit;
?>


<body class="fix-header fix-sidebar card-no-border">
    <!--<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>-->

    <div id="main-wrapper">
        <header class="topbar1">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <b>
                            <img src="<?php echo asset_url(); ?>images/logo.jpg" alt="homepage" class="dark-logo" width="50%" />
                            <!--<img src="<?php echo asset_url(); ?>images/logo-light-icon.png" alt="homepage" class="light-logo" />-->
                        </b>
                        <!--<span>
							<img src="<?php echo asset_url(); ?>images/logo-text.png" alt="homepage" class="dark-logo" />
							<img src="<?php echo asset_url(); ?>images/logo-light-text.png" class="light-logo" alt="homepage" />
						</span>-->
					</a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                    </ul>
					
                </div>
            </nav>
        </header>
        <!-- End Topbar header -->
      
<Script>

  $(document).on('change', '#header_ref_branch_id', function() {
        var branch_id = $(this).val();
        if(branch_id !='') {
            var base_url = '<?php echo base_url() ?>';
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/dashboard/branch_selection',
                data: {'branch_id': branch_id},
                dataType: "json",
                success: function (res) {
					if(res == 1) {
						location.reload();
					}
                }
            });
        }
    });
  
</Script>
