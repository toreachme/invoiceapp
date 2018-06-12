<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<?php $this->load->view('includes/header.php');?>
	<title>Admin Dashboard</title>
	<!-- Custom styles for this template -->
</head>
<body>
<?php $this->load->view('dash-frame/navbar.php');?>
<div class="container">
	<div id="previews" class="mt-4">
		<h2>Most Recent</h2>
		<p>Listed below is a preview of the most recent added customers and invoices.</p>

		<!-- Recent Customers Table-->
		<table class="table table-responsive-sm">
			<thead class="thead-dark">
				<tr>
					<th>Customer #</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Ticket Price</th>
					<th>Pay Schedule</th>
					<th>Created By</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($RecentCustomers as $customer): ?>
				<tr>
					<td><?php echo $customer->cust_id; ?></td>
					<td><?php echo $customer->first_name ." ". $customer->last_name; ?></td>
					<td><?php echo $customer->email; ?></td>
					<td><?php echo $customer->ticket_price; ?></td>
					<td><?php echo $customer->pay_schedule; ?></td>
					<td><?php echo $customer->created_at;?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php if(empty($RecentCustomers)):?>
		  <div class="text-center my-4"><h3>No Recent Customer.</h3></div>
	    <?php endif;?>

		<!-- Recent Invoices Table-->
		<table class="table table-responsive-sm">
			<thead class="thead-light">
				<tr>
					<th>Invoice #</th>
					<th>Customer #</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Invoice Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($RecentInvoices as $invoice): ?>
				<tr>
					<td><?php echo $invoice->invoice_id; ?></td>
					<td><?php echo $invoice->cust_id; ?></td>
					<td><?php echo $invoice->amount; ?></td>
					<td><?php echo $invoice->description; ?></td>
					<td><?php echo $invoice->status; ?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php if(empty($RecentInvoices)):?>
		  <div class="text-center my-4"><h3>No Recent Invoice.</h3></div>
	    <?php endif;?>
	</div>

</div>
<?php $this->load->view('dash-frame/body_footer.php');?>
<?php $this->load->view('includes/footer.php');?>
</body>
</html>