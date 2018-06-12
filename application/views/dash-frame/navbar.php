<nav class="navbar navbar-expand-lg navbar-light bg-white main-navbar">
	<a class="navbar-brand">
		<img src="<?php echo base_url('images/pa_logo.jpeg');?>" alt="logo" style="width:110px;">
	</a>

	<!-- Toggler/collapsibe Button -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url('dashboard');?>">Dashboard <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('customers');?>">Customers</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('invoices');?>">Invoices</a>
			</li>
		</ul>
		<span class="navbar-text">
			<a class="nav-link" href="<?php echo base_url('auth/logout');?>">Logout</a>
		</span>
	</div>
</nav>	