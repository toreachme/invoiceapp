<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Plane-A-Way</h1>
<p>Please click button below to make payment</p>
<?php //require_once('third_party/stripe/init.php');?>
<div>
<?php echo form_open('payments/charge'); ?>
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripePublicKey;?>"
    data-amount="2000"
    data-name="Plane-A-Way"
    data-description="plane ticket"
    data-label="Checkout"
    data-email="emonuoha@mail.com"
    data-zip-code="true"
    data-image="<?php echo base_url('images/pa_logo.jpeg');?>"
    data-locale="auto">
  </script>
</form>
</div>

</body>
</html>