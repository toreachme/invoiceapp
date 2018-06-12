<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
<?php $this->load->view('includes/header.php');?>
<title>Create Payment</title>
<!-- Custom styles for this template -->
<link href="<?php echo base_url('styles/preview.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
 <?php if($this->session->userdata('loggedin')):?>
 <?php $this->load->view('dash-frame/navbar.php');?>
<?php endif;?>
<div class="container">
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Invoice</h1>
      <?php if($this->session->userdata('loggedin')):?>
      <p class="text-center">Payment Page URL: <a href="<?php echo base_url('payments/page/'.$Invoice->link);?>"><?php echo base_url('payments/page/'.$Invoice->link);?></a></p>
      <?php endif;?>
    </div>

    <div class="page-content">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body container-fluid">
          <div class="row">
            <div class="col-lg-4">
              <span><img src="<?php echo base_url('images/pa_logo.jpeg');?>" alt="logo" style="width:150px;"></span>
              <h3>Plane-A-Way</h3>
              <address>
                27, Lee street, 
                <br> Jamaica plain, MA, 02130
                <br>
                <abbr title="Mail">E-mail:</abbr>&nbsp;spc.bstewart@gmail.com 
                <br>
                <abbr title="Phone">Phone:</abbr>&nbsp;(617) 637-9143
              </address>
            </div>
            <div class="col-lg-3 offset-lg-5 text-right">
              <h4>Invoice Info</h4>
              <p>
                <a class="font-size-20" href="#"># <?php echo $Invoice->invoice_id?></a>
                <br> To:
                <br>
                <span class="font-size-20"><?php echo $Customer->first_name." ".$Customer->last_name;?></span>
              </p>
              <span>Invoice Date: <?php echo date("Y-m-d",strtotime($Invoice->created_at));?></span>
<!--               <br>
              <span>Due Date: January 22, 2017</span> -->
            </div>
          </div>

          <div class="page-invoice-table table-responsive">
            <table class="table table-hover text-right">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-left">Description</th>
                  <!-- <th class="text-right">Quantity</th> -->
                  <th class="text-right">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1</td>
                  <td class="text-left"><?php echo $Invoice->description;?></td>
                  <!-- <td>32</td> -->
                  <td><?php echo $Invoice->amount;?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="text-right clearfix">
            <div class="float-right">
              <p>Payment:
                <span><?php echo "$".$Invoice->amount;?></span>
              </p>
              <p class="page-invoice-amount">Balance Due:
                <?php if($Invoice->status == 'paid'){?>
                <span>$0.00</span>
              <?php }else{ ?>
              <span><?php echo "$".$Invoice->amount;?></span>
              <?php } ?>
              </p>
            </div>
          </div>

            <?php if($Invoice->status == 'unpaid'):?>
            <div class="text-right">
              <div class="float-left">
               <button type="button" class="btn btn-animate btn-animate-side btn-default btn-outline" onclick="javascript:window.print();">
                 <span><i class="fa fa-print"></i> Print</span>
               </button>
              </div>

              
              <div>
                <?php echo form_open('payments/charge'); ?>
                <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?php echo $stripePubKey->publishable_key;?>"
                data-amount="<?php echo round($Invoice->amount,0) * 100;?>"
                data-name="Plane-A-Way"
                data-description="<?php echo $Invoice->description;?>"
                data-email="<?php echo $Customer->email;?>"
                data-zip-code="true"
                data-image="<?php echo base_url('images/pa_logo.jpeg');?>"
                data-locale="auto">
                </script>
                </form>
              </div>
            </div>
            <?php endif;?>

            <?php if($Invoice->status == 'paid'):?>
            <div><h1 class="display-1 text-success">PAID</h1></div>
            <?php endif;?>

          </div>
        </div>
        <!-- End Panel -->
      </div>
    </div>

  </div> <!--end Container -->
<?php $this->load->view('includes/footer.php');?>
</body>