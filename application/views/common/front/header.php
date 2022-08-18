<?php 
$customer_id = @$this->session->userdata('customr_id');
$total_quantity = 0;
if(empty($customer_id)){
  $session_products = @$this->session->userdata('cart');
  if(!empty($session_products)){
      foreach($session_products as $sess_key => $see_val){
          $pro_extract = explode('-', $see_val);
          $total_quantity += $pro_extract[1];
      }    
  }  
}else{
  $user_details = $this->user->logged_in_user_details();
  $total_quantity = $this->user->temp_product_quantity();
}

?>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="">

  <meta name="author" content="">

  <title>Kottakal Ayurveda</title>
    <link rel="icon" href="<?php echo asset_url(); ?>front/img/favicon.png" type="image/png" sizes="16x16">
  <!-- Bootstrap core CSS -->

  <link href="<?php echo asset_url(); ?>front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->

  <link href="<?php echo asset_url(); ?>front/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <link href="<?php echo asset_url(); ?>front/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">

  <!-- Roboto -->

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->

  <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>front/vendor/owlcarousel/owl.carousel.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>front/vendor/owlcarousel/owl.theme.default.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>front/vendor/ekko-lightbox/ekko-lightbox.css">

  <link href="<?php echo asset_url(); ?>front/css/style.css" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
<div class="banner-volume text-right">

	<a href="javascript:void(0);" class="d-inline-block text-decoration-none banner-anchor" onClick="togglePlay()">

		<img src="<?php echo asset_url(); ?>front/img/icon-volume.png" class="img-fluid img-active" alt="Image">
		<img src="<?php echo asset_url(); ?>front/img/icon-mute.png" class="img-fluid img-mute" alt="Image">

	</a>

</div>
<div class="d-block">

    <audio volume="0.4" autoplay loop id="flute">

      <source src="<?php echo asset_url(); ?>front/audio/flute.mp3" type="audio/mpeg">

    </audio>

  </div>


 

  <header class="bg-white position-relative shadow">

    <div class="container-fluid"> 

      <div class="row">

        <div class="col-md-12">

          <nav class="navbar navbar-expand-lg navbar-light px-0 px-md-3">

            <a class="navbar-brand" href="<?= site_url()?>">

              <img src="<?php echo asset_url(); ?>front/img/kottakkal.png" class="img-fluid logo" alt="Logo">

            </a>

            <button class="navbar-toggler border-success bg-success" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

              <span class="navbar-toggler-icon d-flex flex-wrap align-items-center"><i class="fa fa-bars text-white mx-auto"></i></span>

            </button>



            <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <ul class="navbar-nav ml-auto">

                <li class="nav-item active">

                  <a class="nav-link font-14 text-success" href="<?= site_url()?>">Home <span class="sr-only">(current)</span></a>

                </li>

                <li class="nav-item">

                  <a class="nav-link font-14 text-success" href="<?= site_url('home/about_us')?>">About Us</a>

                </li>

                <li class="nav-item">

                  <a class="nav-link font-14 text-success" href="<?= site_url('home/ayur_vaidyah')?>">Ayur Vaidyah</a>

                </li>

                <li class="nav-item">

                  <a class="nav-link font-14 text-success" href="<?= site_url('home/ayur_oushadhi')?>">Ayur Oushadhi</a>

                </li>

                <li class="nav-item">

                  <a class="nav-link font-14 text-success" href="<?= site_url('home/panchakarma')?>">Panchakarma</a>

                </li>

                <li class="nav-item dropdown">

                  <a class="nav-link dropdown-toggle font-14 text-success" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gallery</a>

                  <div class="dropdown-menu text-center radius-10" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item font-14 text-white bg-transparent" href="<?= site_url('home/image_gallery')?>">Image Gallery</a>

                    <div class="dropdown-divider bg-light"></div>

                    <a class="dropdown-item font-14 text-white bg-transparent" href="<?= site_url('home/video_gallery')?>">Video Gallery</a>

                  </div>

                </li>

                <li class="nav-item">

                  <a class="nav-link font-14 text-success" href="<?= site_url('home/contact_us')?>">Contact Us</a>

                </li>

                <li class="nav-item">

                  <a class="nav-link font-14 text-success position-relative cart-link" href="<?= site_url('home/cart')?>">Cart <img src="<?php echo asset_url(); ?>front/img/cart-icon.png" class="img-fluid" alt="Image"><span class="count bg-warning rounded-circle text-white position-absolute text-center font-weight-500"><?=$total_quantity?></span></a>

                </li>

                <?php if(empty($customer_id)){ ?>
                  <li class="nav-item">

                    <a class="nav-link font-14 text-success font-weight-500 text-uppercase" href="<?= site_url('home/login')?>">Login <img src="<?php echo asset_url(); ?>front/img/login.png" class="img-fluid" alt="Image"></a>

                  </li>
              <?php }else{ ?>
                <li class="nav-item">
                  <a href="<?=base_url().'index.php/home/orderHistory'?>"><?=$user_details->customer_name?></a>
                  <a class="nav-link font-14 text-success font-weight-500 text-uppercase" href="<?= site_url('home/logout')?>">Logout</a>

                </li>
              <?php } ?>

              </ul>

            </div>

          </nav>

        </div>

      </div>

    </div>

  </header>