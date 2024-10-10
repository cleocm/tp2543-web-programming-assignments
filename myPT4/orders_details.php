<?php
include_once 'orders_details_crud.php';
session_start()
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HitachiWorld Ordering System : Order Details</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>
<style>
  body{
      background:url("bg.jpg");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
      padding-bottom  :  20px;
    }
    #div-middle{
      background-color: rgba(255,255,255,0.8);
      margin: auto;
      width: 70%;
      border: 3px lightgrey  ;
      padding: 10px;
      padding-bottom:   40px;
      justify-content:  center  ;
      border-radius:  25px;

      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #div-top {
      background-color: rgba(255,255,255,0.9);
      margin: auto;
      width:  70%;
      border-radius:  25px;
      padding: 10px;
      padding-top:  40px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.9), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      padding-bottom:   40px;

    }

    #div-bottom {
      background-color: rgba(255,255,255,0.9);
      margin: auto;
      width:  80%;
      border-radius:  25px;
      padding: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.9), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      padding-bottom:   40px;

    }
</style>
<body>
  <?php include_once 'nav_bar.php'; ?>
  <?php
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM tbl_orders_a188384_pt2, tbl_staffs_a188384_pt2,
      tbl_customers_a188384_pt2 WHERE
      tbl_orders_a188384_pt2.fld_staff_num = tbl_staffs_a188384_pt2.fld_staff_num AND
      tbl_orders_a188384_pt2.fld_customer_num = tbl_customers_a188384_pt2.fld_customer_num AND
      fld_order_num = :oid");
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

  <div class="container-fluid">
    <div class="row" id="div-top">
      <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Order Details</strong></div>
          <div class="panel-body">
            Below are details of the order.
          </div>
          <table class="table">
            <tr>
              <td class="col-xs-4 col-sm-4 col-md-4"><strong>Order ID</strong></td>
              <td><?php echo $readrow['fld_order_num'] ?></td>
            </tr>
            <tr>
              <td><strong>Order Date</strong></td>
              <td><?php echo $readrow['fld_order_date'] ?></td>
            </tr>
            <tr>
              <td><strong>Staff</strong></td>
              <td><?php echo $readrow['fld_staff_fname']." ".$readrow['fld_staff_lname'] ?></td>
            </tr>
            <tr>
              <td><strong>Customer</strong></td>
              <td><?php echo $readrow['fld_customer_fname']." ".$readrow['fld_customer_lname'] ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <br><br>
    <div class="row" id="div-middle">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Add a Product</h2>
        </div>

        <form action="orders_details.php" onsubmit="return validateForm()" method="post" class="form-horizontal" name="frmorder" id="frmorder">
          <div class="form-group">
            <label for="prd" class="col-sm-3 control-label">Product</label>
            <div class="col-sm-9">

              <select name="pid" class="form-control" id="prd">
                <option value="">Please select</option>
                <?php
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM tbl_products_a188384_pt2");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                }
                catch(PDOException $e){
                  echo "Error: " . $e->getMessage();
                }
                foreach($result as $productrow) {
                  ?>
                  <option value="<?php echo $productrow['fld_product_num']; ?>"><?php echo $productrow['fld_product_category']." ".$productrow['fld_product_name']; ?></option>
                  <?php
                }
                $conn = null;
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="qty" class="col-sm-3 control-label">Quantity</label>
            <div class="col-sm-9">

              <input name="quantity" type="number" class="form-control" id="quantity" min="1">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <input name="oid" type="hidden" value="<?php echo $readrow['fld_order_num'] ?>">
              <button class="btn btn-default" type="submit" name="addproduct"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Product</button>
              <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <br><br>
    <div class="row" id="div-bottom">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Products in This Order</h2>
        </div>
        <table class="table table-striped table-bordered" id="orderdetailstable">
          <thead>
            <th align="center">Order Detail ID</th>
            <th align="center">Product</th>
            <th align="center">Quantity</th>
            <th></th>
          </thead>
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a188384_pt2,
              tbl_products_a188384_pt2 WHERE
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
            <tbody>
              <td><?php echo $detailrow['fld_order_detail_num']; ?></td>
              <td><?php echo $detailrow['fld_product_name']; ?></td>
              <td><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
              <td>
                <a href="orders_details.php?delete=<?php echo $detailrow['fld_order_detail_num']; ?>&oid=<?php echo $_GET['oid']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button"> Delete</a>
              </td>
            </tbody>
            <?php
          }
          $conn = null;
          ?>
        </table>
        <div class="row">
  <div class="col-xs-12 col-sm-10 col-sm col-md-8 col-md">
    <button class="btn btn-primary" id="exportExcel" style="margin-bottom: 20px;">Export to Excel</button>
  </div>
      </div>
      <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <a href="invoice.php?oid=<?php echo $_GET['oid']; ?>" target="_blank" role="button" class="btn btn-primary btn-lg btn-block">Generate Invoice</a>
      </div>
    </div>
      </div>
    </div>
    
  </div>
  <script type="text/javascript">
 
  function validateForm() {
 
      var x = document.forms["frmorder"]["pid"].value;
      var y = document.forms["frmorder"]["quantity"].value;
      //var x = document.getElementById("prd").value;
      //var y = document.getElementById("qty").value;
      if (x == null || x == "") {
          alert("Please select a product.");
          document.forms["frmorder"]["pid"].focus();
          //document.getElementById("prd").focus();
          return false;
      }
      if (y == null || y == "") {
          alert("Please specify a quantity.");
          document.forms["frmorder"]["quantity"].focus();
          //document.getElementById("qty").focus();
          return false;
      }
       
      return true;
  }
 
</script>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#orderdetailstable').DataTable({
      "lengthMenu": [[5, 10, 20, 30, -1],
                        [5, 10, 20, 30, "Show All"]], //Options of records per page
      "order": [1, 'asc'],
          "pageLength": 10, //Default records shown per page
          "buttons": ['excel'],
          
        });

    $('#exportExcel').click(function(event) {
          /* Act on the event */
      var confirmed = window.confirm('Are you sure you want to export the table data to Excel?');
      if (confirmed) {
        $('#orderdetailstable').DataTable().buttons('.buttons-excel').trigger();
      }
    });
  });
</script>
  
</body>
</html>