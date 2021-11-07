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
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product List</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                   Order Details
                    <small class="float-right">Date: <?php echo date('d-m-Y');?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
            
              <!-- /.row -->

              <!-- Table row -->
      <form method="post" action="<?php echo base_url()?>cart/save_order_details">        
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Unit Price </th>
                      <th>Quantity #</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php  
                    $i=1;
                    $sub_total=0;
                    foreach ($cart_products as $item) { ?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo  $item['product_name'];?>
                        <input type="hidden" name="product_name[]" value="<?php echo  $item['product_name'];?>">

                      </td>
                      <td><?php echo  $item['product_price'];?>
        <input type="hidden" name="unit_price_[]" id="unit_price_<?php echo $i;?>" value="<?php echo  $item['product_price'];?>">

                      </td>
                      <td>
      <input type="number" min="1" class="form-control" name="qty[]" id="qty_<?php echo $i;?>" style="width:40%" value="<?php echo  $item['product_qty'];?>" onchange="get_sub_total(this.value,<?php echo $i;?>)">


                      </td>
                      <td>
                <?php $sub_total = $sub_total+ ($item['product_price'] * $item['product_qty']);?>
                 <span id="unit_total_<?php echo $i;?>"><?php echo  $item['product_price'] * $item['product_qty'];?></span>

              <input type="hidden" class="subtotal" id="price_total_<?php echo $i;?>" value="<?php echo  $item['product_price'] * $item['product_qty'];?>" name="price_total[]">

                       </td>
                    </tr>
                   <?php  $i++;} ?> 
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
                        <td>$
                       <span id="sub_total"> <?php echo $sub_total;?></span>
                       <input type="hidden" id="old_sub_total" name="old_sub_total" value="<?php echo $sub_total;?>">     
                    

                        </td>
                      </tr>
                      <tr>
                        <th>Tax (10.00%)</th>
                        <td><?php $tax_rate = (10 /100) * $sub_total;?>
                          <span id="old_tax"> <?php echo $tax_rate;?></span>
                          <input type="hidden" name="tax_amount" id="tax_amount" value="<?php echo $tax_rate;?>">
                        </td>
                      </tr>
                      
                       <tr>
                        <th>Subtotal With tax:</th>
                        <td>
                      <span id="old_total_with_tax"> <?php echo ($tax_rate + $sub_total) ;?></span>
                      <input type="hidden" id="total_with_tax" name="total_with_tax" value="<?php echo ($tax_rate + $sub_total) ;?>"> 
                        </td>
                      </tr>
                      <tr>
                        <th>Discount:</th>
                        <td>
                      <span id="discount">$5.00</span>
                      <input type="hidden" id="discount_amount" name="discount_amount" value="5"> 
                        </td>
                      </tr>
                      <tr>
                        <th>Grand  Total:</th>
                        <td>
                          
                          <span id="ol_grand_total"><?php echo ($tax_rate + $sub_total) - 5 ?></span>
                      <input type="hidden" name="grand_total" id="grand_total" value="<?php echo ($tax_rate + $sub_total) - 5 ?>"> 
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?php echo base_url()?>cart/delete_cart" rel="noopener"  class="btn btn-danger"><i class="fas fa-trash"></i> Clear Cart</a>
                  <a href="<?php echo base_url()?>cart" rel="noopener"  class="btn btn-success"><i class="fas fa-cart"></i> Continue Purchase </a>
                  
                  <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate Invoice
                  </button>
                </div>
              </div>
            </div>
          </form>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url()?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>dist/js/demo.js"></script>
</body>
</html>
<script>

  $('#qty').on('change', function() {
      alert("work");
});

  function get_sub_total(val,serial)
  {
     var unit_price = $("#unit_price_"+serial).val(); 
     var unit_toatl = parseInt(unit_price) * parseInt(val);
     var sub_total  =0;
     $("#price_total_"+serial).val(unit_toatl);
     $('#unit_total_'+serial).html(unit_toatl); 
    $(".subtotal").each(function () {  
   sub_total = parseInt (sub_total) + parseInt($(this).val());
                   
                }) 
   
$("#sub_total").html(sub_total);
$("#old_sub_total").val(sub_total); 


var new_tax = parseInt(sub_total) * (10/100);

   var tax_amount = $("#tax_amount").val();
   $("#tax_amount").val(new_tax); 
   $("#old_tax").html(new_tax);
   var old_total_with_tax =parseInt(new_tax) + parseInt(sub_total);

   $("#old_total_with_tax").html(old_total_with_tax);
   $("#total_with_tax").val(old_total_with_tax); 
   
   var grand_total = parseInt(old_total_with_tax ) - 5 ;
    $("#grand_total").val(grand_total); 
    $("#ol_grand_total").html(grand_total); 
    

  

  }
</script>
