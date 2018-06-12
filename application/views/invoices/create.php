<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<?php $this->load->view('includes/header.php');?>
	<title>Create Payment</title>
	<!-- Custom styles for this template -->
</head>
<body>
<?php $this->load->view('dash-frame/navbar.php');?>
<div class="container">
	<div id="previews" class="mt-4">
		<div class="row">
			<div class="mx-auto text-center">
				<h2>Create Invoice</h2>
				<p>Use form below to add a new invoice.</p>
			</div>
		</div>

		<!-- Create Payment Form-->
		<div class="row">
			<div class="mx-auto border main-form p-5">
				<?php echo validation_errors(); ?>
				<?php echo form_open('invoices/create'); ?>
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="inputCustId">Customer number</label>
						<input type="number" class="form-control" id="inputCustId" name="cust_id" value="<?php echo set_value('cust_id',$cust_id); ?>" placeholder="Customer #">
					</div>
					<div class="form-group col-md-4">
						<label for="inputAmount">Amount</label>
						<input type="number" class="form-control" id="inputAmount" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="Amount $">
					</div>
				</div>

				<div class="form-group">
					<label for="descriptionText">Description</label>
					<textarea class="form-control" id="descriptionText" name="description" value="<?php echo set_value('description'); ?>" rows="3"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Save</button>
			</form>
		</div> <!--end of form parent div-->
	</div> <!--end of row div-->

	</div>

</div>
<?php $this->load->view('dash-frame/body_footer.php');?>
<?php $this->load->view('includes/footer.php');?>
</body>
</html>