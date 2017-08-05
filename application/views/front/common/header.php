<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
  <head>
    <title><?php echo $this->pageTitle; ?> :: <?php echo SITE_TITLE; ?></title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- //for-mobile-apps -->
    <?php my_load_css('plugins/bootstrap/css/bootstrap.min.css'); ?>
    <!-- Font Awesome -->
    <?php my_load_css('plugins/font-awesome/css/font-awesome.min.css'); ?>
    <?php my_load_css('css/style.css?v=' . ASSETS_VERSION); ?>
    <?php my_load_css('css/gallery.css?v=' . ASSETS_VERSION); ?>
    <?php my_load_css('css/skins/' . FRONT_SKIN . '.css?v=' . ASSETS_VERSION); ?>
    <!-- js -->
    <?php my_load_js('plugins/jquery/jquery.min.js'); ?>
    <!-- Bootstrap -->
    <?php my_load_js('/plugins/bootstrap/js/bootstrap.min.js'); ?>
    <!-- //js -->
    <link href='//fonts.googleapis.com/css?family=Quicksand:400,300,500,700' rel='stylesheet' type='text/css'>
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
              <li><a href="tel:<?php echo CONTACT_PHONE; ?>"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><?php echo CONTACT_PHONE; ?></a></li>
              <li><a href="mailto:<?php echo CONTACT_EMAIL; ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><?php echo CONTACT_EMAIL; ?></a></li>
            </ul>
          </div>
          <!--div class="header-top-right">
            <div class="search">
              <input class="search_box" type="checkbox" id="search_box">
              <label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
              <div class="search_form">
                <form action="#" method="post">
                  <input type="text" name="Search" placeholder="Search...">
                  <input type="submit" value=" ">
                </form>
              </div>
            </div>
          </div-->
          <?php if ($this->logined_user): ?>
          <ul class="top-navbar">
            <li class="profile" title="Go to profile page"><a href="#"><?php echo $this->logined_userinfo->fullname; ?></a></li>
            <li><a href="<?php echo base_url('auth/signout'); ?>">Sign Out</a></li>
          </ul>
          <?php endif; ?>
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

            <?php
            $page_slug = $this->uri->segment(1);
            ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
              <nav>
                <ul class="nav navbar-nav">
                  <li class="<?php if ($page_slug == '' || $page_slug == 'home') echo 'active'; ?>"><a href="<?php echo base_url(); ?>" class="<?php echo ($page_slug == '' || $page_slug == 'home') ? '' : 'hvr-bounce-to-bottom'; ?>">Home</a></li>
                  <li class="<?php if ($page_slug == 'gallery' || $page_slug == 'picture') echo 'active'; ?>"><a href="<?php echo base_url('gallery'); ?>" class="<?php echo ($page_slug == 'gallery' || $page_slug == 'picture') ? '' : 'hvr-bounce-to-bottom'; ?>">Gallery</a></li>
                  <li class="<?php if ($page_slug == 'about_us') echo 'active'; ?>"><a href="<?php echo base_url('aboutus'); ?>" class="<?php echo ($page_slug == 'aboutus') ? '' : 'hvr-bounce-to-bottom'; ?>">About Us</a></li>
                  <li class="<?php if ($page_slug == 'contact-us') echo 'active'; ?>"><a href="<?php echo base_url('contact-us'); ?>" class="<?php echo ($page_slug == 'contact-us') ? '' : 'hvr-bounce-to-bottom'; ?>">Contact Us</a></li>
                </ul>
              </nav>
            </div>
            <!-- /.navbar-collapse -->
          </nav>
        </div>
      </div>
    </div>
    <!-- //header -->
    
    <!-- Start Main Container -->
    <div id="main-container">
