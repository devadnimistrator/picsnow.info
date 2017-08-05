<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $this->page_title ?> - <?php echo SITE_TITLE ?></title>
		<meta name="description" content="Dashboard of <?php echo SITE_TITLE?>" />

		<!-- Bootstrap -->
		<?php my_load_css('plugins/bootstrap/css/bootstrap.min.css'); ?>
		<!-- Font Awesome -->
		<?php my_load_css('plugins/font-awesome/css/font-awesome.min.css'); ?>
    <!-- iCheck -->
    <?php my_load_css('/plugins/iCheck/skins/flat/green.css'); ?>
		<!-- bootstrap-progressbar -->
		<?php my_load_css('/plugins/bootstrap/css/bootstrap-progressbar-3.3.4.min.css'); ?>
		<!-- iCheck -->
		<?php my_load_css('/plugins/iCheck/skins/flat/green.css'); ?>
		<!-- bootstrap-wysiwyg -->
		<?php my_load_css('/plugins/google-code-prettify/prettify.min.css'); ?>
		<!-- Select2 -->
		<?php my_load_css('/plugins/select2/css/select2.min.css'); ?>
		<!-- Switchery -->
		<?php my_load_css('/plugins/switchery/switchery.min.css'); ?>
		<!-- starrr -->
		<?php my_load_css('/plugins/starrr/starrr.css'); ?>
		<!-- Datatables -->
		<?php my_load_css('/plugins/datatables/css/dataTables.bootstrap.min.css'); ?>
		<?php my_load_css('/plugins/datatables/css/buttons.bootstrap.min.css'); ?>
		<?php my_load_css('/plugins/datatables/css/fixedColumns.dataTables.min.css'); ?>
		<?php my_load_css('/plugins/datatables/css/fixedHeader.bootstrap.min.css'); ?>
		<?php my_load_css('/plugins/datatables/css/responsive.bootstrap.min.css'); ?>
		<?php my_load_css('/plugins/datatables/css/scroller.bootstrap.min.css'); ?>
			
		<!-- Custom Theme Style -->
		<?php my_load_css('/css/admin.css?v=' . ASSETS_VERSION); ?>

		<!-- jQuery -->
		<?php my_load_js('/plugins/jquery/jquery.min.js'); ?>
		<!-- Bootstrap -->
		<?php my_load_js('/plugins/bootstrap/js/bootstrap.min.js'); ?>
		<!-- FastClick -->
		<?php my_load_js('/plugins/fastclick.js'); ?>
		<!-- NProgress -->
		<?php my_load_js('/plugins/nprogress.js'); ?>
		<!-- Switchery -->
		<?php my_load_js('/plugins/switchery/switchery.min.js'); ?>
		
		<script>
			var day_options = {
				timeZone : '<?php echo DEFAULT_TIMEZONE; ?>',
					year : 'numeric',
					month : 'short',
					day : 'numeric',
				};

				var time_options = {
					timeZone : '<?php echo DEFAULT_TIMEZONE; ?>',
					hour : 'numeric',
					minute : 'numeric',
					second : 'numeric',
				};
		</script>
	</head>

	<?php
	$page_slug = $this->uri->rsegment(1);
	$page_sub_slug = $this->uri->rsegment(2);
	?>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="#" class="site_title"> 
								<h1><?php echo SITE_TITLE ?></h1> 
							</a>
						</div>

						<div class="clearfix"></div>

						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<ul class="nav side-menu">
									<!--li class="<?php if ($page_slug == 'home') echo "active" ?>">
										<a href="<?php echo base_url('admin/home'); ?>"><i class="fa fa-tachometer"></i> Dashboard</a>
									</li-->
									
									<li class="<?php if ($page_slug == 'address') echo "active" ?>">
										<a href="<?php echo base_url('admin/address'); ?>"><i class="fa fa-building"></i> Address</a>
									</li>
									
									<li class="<?php if ($page_slug == 'users') echo "active" ?>">
										<a href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-users"></i> Users</a>
									</li>
									
									<li class="<?php if ($page_slug == 'system') echo "active" ?>">
										<a href="<?php echo base_url('admin/config'); ?>"><i class="fa fa-cog"></i> System Configuration</a>
									</li>
									
									<li>
										<a href="<?php echo base_url('admin/auth/signout'); ?>"><i class="fa fa-sign-out"></i> Logout</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- /sidebar menu -->
					</div>
				</div>

				<!-- top navigation -->
				<div class="top_nav">

					<div class="nav_menu">
						<nav class="" role="navigation">
							<div class="nav toggle">
								<a id="menu_toggle"><i class="fa fa-bars"></i></a>
							</div>
							<div class="nav toggle current-time">
								<i class="fa fa-clock-o"></i>&nbsp;<span id="current-day"><?php echo date('M j, Y'); ?></span><br/>
								<i class="fa" style="width:1em;"></i>&nbsp;<span id="current-time"><?php echo date('g:i:s A'); ?></span>
							</div>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-user"></i> <?php echo $this->logined_user->username?> <span class=" fa fa-angle-down"></span> </a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li>
											<a href="<?php echo base_url('admin/profile/change_password') ?>"><i class="fa fa-key pull-right"></i> Change Password</a>
										</li>
										<li>
											<a href="<?php echo base_url('admin/auth/signout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>

				</div>
				<!-- /top navigation -->

				<!-- Start Right Content -->
				<div class="right_col" role="main">