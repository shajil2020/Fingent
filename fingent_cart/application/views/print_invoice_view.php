<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shoping Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
         
          <small class="float-right">Date:<?php echo date('d-m-Y');?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
   
    <!-- /.row -->
<?php 
     // print "<pre>";
    // print_r($order_details);
    // echo "</br>";
    // print "<pre>";
    // print_r($order_product_details);
?>
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          
          <?php 
          $i=1;
          foreach($order_product_details as $det) { ?>
          
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $det['product_name'];?></td>
            <td><?php echo $det['unit_price'];?></td>
            <td><?php echo $det['quantity'];?></td>
            <td><?php echo $det['unit_price'] * $det['quantity'];?></td>
          </tr>

        <?php $i++;} ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      
      <!-- /.col -->
      <div class="col-6">
       

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$<?php echo $order_details[0]['sub_total'];?></td>
            </tr>
            <tr>
              <th>Tax (10.00%)</th>
              <td>$<?php echo $order_details[0]['tax_amount'];?></td>
            </tr>
            <tr>
              <th>Subtotal With Tax:</th>
              <td>$<?php echo $order_details[0]['amount_with_tax'];?></td>
            </tr>
            <tr>
              <th>Discount:</th>
              <td>$<?php echo $order_details[0]['discount'];?></td>
            </tr>
             <tr>
              <th>Grant Total:</th>
              <td>$<?php echo $order_details[0]['grand_total'];?></td>
            </tr>

          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
