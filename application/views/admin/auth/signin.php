<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Signin - <?php echo SITE_TITLE ?></title>
		<meta name="description" content="Dashboard of <?php echo SITE_TITLE?>" />

		<!-- Bootstrap -->
		<?php my_load_css('plugins/bootstrap/css/bootstrap.min.css'); ?>
		<!-- Font Awesome -->
		<?php my_load_css('plugins/font-awesome/css/font-awesome.min.css'); ?>

		<!-- Custom Theme Style -->
		<?php my_load_css('css/admin.css?V=' . ASSETS_VERSION); ?>
	</head>

	<body style="background:#F7F7F7;">
		<div class="">
			<div id="wrapper">
				<div id="login" class=" form">
					<section class="login_content">
						<div class="col-md-12">
							<?php echo form_open(); ?>
								<input type="hidden" name="action" value="signin" />
								<h1 style="margin-bottom: 0 !important;">Login to <?php echo SITE_TITLE; ?></h1>
								<h5>Admin Panel</h5>
								<?php
								if ($error_msgs) {
									my_show_msg($error_msgs, 'error');
								}
								?>
								<div>
									<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $this->user_m->username; ?>" required="" />
								</div>
								<div>
									<input type="password" name="password" class="form-control" placeholder="Password" value="" required="" />
								</div>
								<div class="text-center">
									<button class="btn btn-default submit" >&nbsp;Log in&nbsp;</button>
								</div>
								<div class="clearfix"></div>
							<?php echo form_close(); ?>
						</div>
					</section>
				</div>
			</div>
		</div>
	</body>
</html>