<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
  <head>
    <title>Error :: <?php echo SITE_TITLE; ?></title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- //for-mobile-apps -->
    <?php my_load_css('plugins/bootstrap/css/bootstrap.min.css'); ?>
    <!-- Font Awesome -->
    <?php my_load_css('plugins/font-awesome/css/font-awesome.min.css'); ?>
    <?php my_load_css('css/style.css?v=' . ASSETS_VERSION); ?>
    <?php my_load_css('css/skins/' . FRONT_SKIN . '.css?v=' . ASSETS_VERSION); ?>
    <!-- js -->
    <?php my_load_js('plugins/jquery/jquery.min.js'); ?>
    <!-- Bootstrap -->
    <?php my_load_js('/plugins/bootstrap/js/bootstrap.min.js'); ?>
    <!-- //js -->
    <link href='//fonts.googleapis.com/css?family=Quicksand:400,300,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <!-- start-smoth-scrolling -->
    <?php my_load_js('js/move-top.js'); ?>
    <?php my_load_js('js/easing.js'); ?>
    <script type="text/javascript">
      jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
          event.preventDefault();
          $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
        });
      });
    </script>
    <!-- start-smoth-scrolling -->
  </head>

  <body>
    <!-- header -->
    <div class="header">	
      <div class="header-top">
        <div class="container"> 
          <div class="header-top-left">
            <ul>
              <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><?php echo CONTACT_PHONE; ?></li>
              <li><a href="mailto:<?php echo CONTACT_EMAIL; ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><?php echo CONTACT_EMAIL; ?></a></li>
            </ul>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="header-bottom">
        <div class="container">
          <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <div class="logo">
                <h1><a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo SITE_TITLE; ?></a></h1>
              </div>
            </div>
            <!-- /.navbar-collapse -->
          </nav>
        </div>
      </div>
    </div>
    <!-- //header -->

    <!-- Start Main Container -->
    <div id="main-container">
      <div class="typo animated wow zoomIn" data-wow-delay=".5s">
        <div class="container">
          <div class="typo-grids">
            <h3 class="title"><span>Error Page</span></h3>
            <p></p>
            <p></p>
          </div>
        </div>
      </div>
    </div>

    <!-- footer -->
    <div class="footer">
      <div class="container">
        <div class="footer-grids">
          <div class="col-md-4 footer-grid">
            <p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?php echo CONTACT_STREET; ?></p>
            <p><a href="mailto:<?php echo CONTACT_EMAIL; ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo CONTACT_EMAIL; ?></a></p>
            <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><?php echo CONTACT_PHONE; ?></p>
          </div>
          <div class="col-md-2 footer-grid">
            <ul>
              <li><a href="<?php echo base_url(); ?>">Home</a></li>
              <li><a href="<?php echo base_url('gallery'); ?>">Gallery</a></li>
              <li><a href="<?php echo base_url('about_us'); ?>">About Us</a></li>
              <li><a href="<?php echo base_url('contact_us'); ?>">Contact Us</a></li>
            </ul>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
    </div>
    <!-- //footer -->
    <!-- here stars scrolling icon -->
    <script type="text/javascript">
      $(document).ready(function () {
        $().UItoTop({easingType: 'easeOutQuart'});
      });
    </script>
    <!-- //here ends scrolling icon -->
  </body>
</html>