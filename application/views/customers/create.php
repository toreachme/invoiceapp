<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<?php $this->load->view('includes/header.php');?>
	<title>Create Customer</title>
	<!-- Custom styles for this template -->
</head>
<body>
<?php $this->load->view('dash-frame/navbar.php');?>
<div class="container">
	<div id="creatView" class="mt-4">
		<div class="row">
			<div class="mx-auto text-center">
				<h2>Create Customer</h2>
				<p>Use form below to add a new customer.</p>
			</div>
		</div>

       <!--beginning of form div-->
		<div class="row">
			<div class="mx-auto border main-form p-5">
				<?php echo validation_errors(); ?>
				<?php echo form_open('customers/create'); ?>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputFirstname">First Name</label>
							<input type="text" class="form-control" id="inputFirstname" name="first_name" value="<?php echo set_value('first_name'); ?>" placeholder="First Name">
						</div>
						<div class="form-group col-md-6">
							<label for="inputLastname">Last Name</label>
							<input type="text" class="form-control" id="inputLastname" name="last_name" value="<?php echo set_value('last_name'); ?>" placeholder="Last Name">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-5">
							<label for="inputCustemail">Email Address</label>
							<input type="email" class="form-control" id="inputCustemail" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email Address">
						</div>
						<div class="form-group col-md-4">
							<label for="inputSchedule"> Pay Schedule</label>
							<select id="inputSchedule" class="form-control" name="pay_schedule">
								<option value="">Choose Schedule...</option>
								<option value="bi-weekly" <?php echo set_select('pay_schedule', 'bi-weekly'); ?> >Bi-Weekly</option>
								<option value="monthly" <?php echo set_select('pay_schedule', 'monthly'); ?> >Monthly</option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="inputTicket">Ticket Price</label>
							<input type="text" class="form-control" id="inputTicket" name="ticket_price" value="<?php echo set_value('ticket_price'); ?>" placeholder="$">
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="gridCheck" name="invoice_auto_redirect">
							<label class="form-check-label" for="gridCheck">
								Check this box to auto create Invoice after this.
							</label>
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div> <!--end of form parent div-->
		</div> <!--end of row div-->

	</div>

</div> <!-- end of Container-->
<?php $this->load->view('dash-frame/body_footer.php');?>
<?php $this->load->view('includes/footer.php');?>
</body>
</html>