<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<?php $this->load->view('includes/header.php');?>
	<title>Plane-A-Way Payments</title>
	    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('styles/login.css') ?>" rel="stylesheet">
</head>
<video autoplay muted loop id="myVideo">
  <source src="<?php echo base_url('images/airport.mp4');?>" type="video/mp4">
  Your browser does not support HTML5 video.
</video>
<body class="text-center">
	<div class="container" id="main">
		<h1>Plane-A-way Payments</h1>
		<?php echo validation_errors(); ?>
		<?php $attr = array('class' => 'form-signin'); ?>
		<?php echo form_open('auth/login', $attr); ?>
		<!-- <form class="form-signin"> -->
			<img class="mb-4" src="<?php echo base_url('images/pa_logo.jpeg');?>" alt="" width="121" height="72">
			<h1 class="h3 mb-3 font-weight-normal">Please log in</h1>

			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" id="inputEmail" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email address" required autofocus>
			
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>

			<button class="btn btn-lg btn-primary btn-block" id="btnLogin" type="submit">Sign in</button>
			<p class="mt-5 mb-3 text-muted">&copy; 2017<script>new Date().getFullYear()>2017&&document.write("-"+new Date().getFullYear());</script>, Plane-A-Way.</p>
		</form>
	</div>

<?php $this->load->view('includes/footer.php');?>
</body>
</html>