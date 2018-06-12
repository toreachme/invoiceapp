<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<?php $this->load->view('includes/header.php');?>
	<title>Invoices</title>
	<!-- Custom styles for this template -->
</head>
<body>
<?php $this->load->view('dash-frame/navbar.php');?>
<div class="container">
	<div id="previews" class="mt-4">
		<h2>Invoices</h2>
		<span>Listed below are all created invoice records.</span>
		<div class="clearfix mb-4">
			<? echo $this->pagination->create_links();?> 
			<a class="btn btn-outline-success btn-lg float-right" role="button" href="<?php echo base_url('invoices/createform');?>">Add New Invoice</a>
		</div>


		<!-- Customers Table-->
		<table class="table table-responsive-sm">
			<thead class="thead-dark">
				<tr>
					<th>Invoice #</th>
					<th>Customer #</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Invoice Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($Invoices as $invoice): ?>
				<tr>
					<td><a class="main-td-link" href="<?php echo base_url('invoices/preview/'.$invoice->invoice_id);?>"><i class="fas fa-external-link-alt"></i> <?php echo $invoice->invoice_id; ?></a></td>
					<td><?php echo $invoice->cust_id; ?></td>
					<td><?php echo $invoice->amount; ?></td>
					<td><?php echo $invoice->description; ?></td>
					<td><?php echo $invoice->status; ?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php if(empty($Invoices)):?>
		  <div class="text-center my-4"><h3>No Invoices Added.</h3></div>
	    <?php endif;?>
	</div>

</div>
<?php $this->load->view('dash-frame/body_footer.php');?>
<?php $this->load->view('includes/footer.php');?>
</body>
</html>