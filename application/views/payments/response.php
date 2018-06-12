<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('includes/header.php');?>
	<title>Payments</title>
	<!-- Custom styles for this template -->
</head>
<body>
<div class="jumbotron">
  <span></span>
  <h1 class="display-4"><img src="<?php echo base_url('images/pa_logo.jpeg');?>" alt="logo" style="width:150px;"> Plane-A-Way</h1>
  <p class="lead">Flexible Travel Payments.</p>
  <hr class="my-4">
  <?php if($response){ ?>
  <h3 class="text-success mb-4"><?php echo $response;?></h3>
  <?php } else{ ?>
  <h3 class="text-warning mb-4"><?php echo "Sorry no response!";?></h3>
  <?php }?>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="https://plane-a-way.com/" role="button">Learn more</a>
  </p>
</div>
</div>
<?php $this->load->view('includes/footer.php');?>
</body>
</html>