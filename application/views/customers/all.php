<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
<?php $this->load->view('includes/header.php');?>
	<title>Customers</title>
	<!-- Custom styles for this template -->
</head>
<body>
<?php $this->load->view('dash-frame/navbar.php');?>
<?php if($msg): ?>
<div class="container">
	<div class="alert alert-info alert-dismissible fade show" id="msg" role="alert" style="display:none;position:fixed;margin-left:25%;margin-top:1%;">
		<?php echo $msg;?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>	
</div>
<?php endif; ?>

<div class="container">
		<div id="previews" class="mt-4">
			<h2>Customers</h2>
			<span>Listed below are all created customer records.</span>
			<div class="clearfix mb-4">
				<? echo $this->pagination->create_links();?>   
				<a class="btn btn-outline-success btn-lg float-right" role="button" href="<?php echo base_url('customers/createform');?>"><i class="fas fa-plus-circle"></i> Add New Customer</a>
			</div>

			<!-- Customers Table-->
			<table class="table table-responsive-sm">
				<thead class="thead-dark">
					<tr>
						<th>Customer #</th>
						<th>Fullname</th>
						<th>Email</th>
						<th>Ticket Price</th>
						<th>Pay Schedule</th>
						<th>Created By</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($Customers as $customer): ?>
					<tr>
						<td><a class="main-td-link" href="<?php echo base_url('customers/updateform/'.$customer->cust_id);?>"><i class="fas fa-external-link-alt"></i> <?php echo $customer->cust_id; ?></a></td>
						<td><?php echo $customer->first_name ." ". $customer->last_name; ?></td>
						<td><?php echo $customer->email; ?></td>
						<td><?php echo $customer->ticket_price; ?></td>
						<td><?php echo $customer->pay_schedule;?></td>
						<td><?php echo $customer->created_at;?></td>
					</tr>
				    <?php endforeach;?>
			    </tbody>
		    </table>
		    <?php if(empty($Customers)):?>
		      <div class="text-center my-4"><h3>No Customers Added.</h3></div>
		    <?php endif;?>
	    </div>

</div>
<?php $this->load->view('dash-frame/body_footer.php');?>
<?php $this->load->view('includes/footer.php');?>
</body>
</html>