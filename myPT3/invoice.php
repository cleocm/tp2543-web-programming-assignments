<?php
include_once 'database.php';
?>
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM tbl_orders_a188384_pt2, tbl_staffs_a188384_pt2,
    tbl_customers_a188384_pt2, tbl_orders_details_a188384_pt2 WHERE
    tbl_orders_a188384_pt2.fld_staff_num = tbl_staffs_a188384_pt2.fld_staff_num AND
    tbl_orders_a188384_pt2.fld_customer_num = tbl_customers_a188384_pt2.fld_customer_num AND
    tbl_orders_a188384_pt2.fld_order_num = tbl_orders_details_a188384_pt2.fld_order_num AND
    tbl_orders_a188384_pt2.fld_order_num = :oid");
  $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
  $oid = $_GET['oid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="row">
    <div class="col-xs-6 text-center">
      <br>
      <img src="logo.png" width="60%" height="60%">
    </div>
    <div class="col-xs-6 text-right">
      <h1>INVOICE</h1>
      <h5>Order: <?php echo $readrow['fld_order_num'] ?></h5>
      <h5>Date: <?php echo $readrow['fld_order_date'] ?></h5>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>From: My Bike Sdn. Bhd.</h4>
        </div>
        <div class="panel-body">
          <p>
            HitachiWorld Sdn. Bhd. <br>
            Lot 123, Lorong 9A, <br>
            43600 Bangi,<br>
            Selangor<br>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xs-5 col-xs-offset-2 text-right">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>To : <?php echo $readrow['fld_customer_fname']." ".$readrow['fld_customer_lname'] ?></h4>
        </div>
        <div class="panel-body">
          <p>
            TB123, Lorong 9 <br>
            Taman ABC, <br>
            43600 Bangi,<br>
            Selangor<br>
          </p>
        </div>
      </div>
    </div>
  </div>
  <table class="table table-bordered">
    <tr>
      <th align="center" width="30px">No</th>
      <th align="center">Product</th>
      <th class="text-right">Quantity</th>
      <th class="text-right">Price(RM)/Unit</th>
      <th class="text-right">Total(RM)</th>
    </tr>
    <?php
    $grandtotal = 0;
    $counter = 1;
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a188384_pt2,
        tbl_products_a188384_pt2 where 
        tbl_orders_details_a188384_pt2.fld_product_num = tbl_products_a188384_pt2.fld_product_num AND
        fld_order_num = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $result = $stmt->fetchAll();
    }
    catch(PDOException $e){
      echo "Error: " . $e->getMessage();
    }
    foreach($result as $detailrow) {
      ?>
      <tr>
        <td><?php echo $counter; ?></td>
        <td><?php echo $detailrow['fld_product_name']; ?></td>
        <td><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
        <td><?php echo $detailrow['fld_product_price']; ?></td>
        <td><?php echo $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity']; ?></td>
      </tr>
      <?php
      $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity'];
      $counter++;
      } // while
      $conn = null;
      ?>
      <tr>
        <td colspan="4" class="text-right">Grand Total</td>
        <td class="text-right"><?php echo $grandtotal ?></td>
      </tr>
    </table>
    <div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Bank Details</h4>
      </div>
      <div class="panel-body">
        <p>Cleo Christine Mianggi Sibungkil</p>
        <p>Maybank</p>
        <p>SWIFT : -</p>
        <p>Account Number : 1602 1111 1111</p>
        <p>IBAN : -</p>
      </div>
    </div>
    </div>
  <div class="col-xs-7">
    <div class="span7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Contact Details</h4>
        </div>
        <div class="panel-body">
          <p> Staff: <?php echo $readrow['fld_staff_fname']." ".$readrow['fld_staff_lname'] ?> </p>
          <p> Email: <?php echo $readrow['fld_staff_email'] ?> </p>
          <p><br></p>
          <p><br></p>
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>