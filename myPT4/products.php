<?php
include_once 'products_crud.php';
session_start ();
//print alert messages
$alertMessage = isset($_GET['alert']) ? $_GET['alert'] : '';
if (!empty($alertMessage)) {
  echo '<script> alert("' .$alertMessage. '") </script>';
}
// Check if the user is not logged in
if (!isset($_SESSION['id'], $_SESSION['name'], $_SESSION['role'])) {
    // Set an alert message
  $alertMessage = "Sorry. This page can only be accessed by logged-in users.";


    // Redirect back to the previous page with the alert message
  header('Location: index.php?alert=' . urlencode($alertMessage));
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>HitachiWorld Ordering System : Products</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <style type="text/css">     
     select {
      width:200px;
    }

    #productstable th:nth-child(8),
    #productstable td:nth-child(8) {
      width: 16%; /* Set the desired width for the eighth column */
    }
    #productstable th:nth-child(1),
    #productstable td:nth-child(1) {
      width: 10%; 
    }
    #productstable th:nth-child(3),
    #productstable td:nth-child(3) {
      width: 10%; 
    }
    .modal-lg {
      max-width: 60%; /* Set the maximum width as a percentage of the viewport width */
    }
    body{
      background:url("bg.jpg");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
      padding-bottom  :  20px;
    }
    #div-top{
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

    #div-bottom {
      background-color: rgba(255,255,255,0.9);
      margin: auto;
      width:  80%;
      border-radius:  25px;
      padding: 10px;
      padding-bottom:   40px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.9), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

    }


  </style>
  <script src="jquery-3.7.1.min.js"></script>
  <script>
    $(document).ready(function() {
        // Add an event listener for each "Details" button
      $('.btn-details').click(function(e) {
        event.preventDefault();

        var productId = $(this).data('pid');
        $.ajax({
                url: 'products_details_modal.php', // Replace with your server-side script
                type: 'GET',
                data: { pid: productId },
                success: function(response) {
                    // Update the content inside <div class="modal-body">
                  $('#productDetailsContainer').html(response);

                    // Show the modal
                  $('#productDetailsModal').modal('show');
                },
                error: function() {
                  alert('Error fetching product details.');
                }
              });
      });
    });
  </script>

</script>

<body>

 <?php include_once 'nav_bar.php'; ?>

 <div class="container-fluid">
  <?php if ($_SESSION['role'] != 'Normal Staff'){?>
    <div class="row" id="div-top">
     <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
       <h2>Create New Product</h2>
     </div>
     <form action="products.php" class="form-horizontal" method="post">
       <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">ID</label>
        <div class="col-sm-9">
         <input name="pid" class="form-control" id="productid" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>

       </div>
     </div>
     <div class="form-group">
      <label for="productname" class="col-sm-3 control-label">Name</label>
      <div class="col-sm-9">
       <input name="name" class="form-control" id="productname" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>

     </div>
   </div>
   <div class="form-group">
    <label for="productprice" class="col-sm-3 control-label">Price</label>
    <div class="col-sm-9">
     <input name="price" id="productprice" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required>
   </div>
 </div>
 <div class="form-group">
  <label for="productcategory" class="col-sm-3 control-label">Category</label>
  <div class="col-sm-9">
   <select name="category" class="form-control" id="productcategory" required>
    <option selected>Select a category:</option>
    <option value="Air Conditioner" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Air Conditioner") echo "selected"; ?>>Air Conditioner</option>
    <option value="Air Purifier" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Air Purifier") echo "selected"; ?>>Air Purifier</option>
    <option value="Kitchen Appliance" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Kitchen Appliance") echo "selected"; ?>>Kitchen Appliance</option>
    <option value="Refrigerator" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Refrigerator") echo "selected"; ?>>Refrigerator</option>
    <option value="Rice Cooker" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Rice Cooker") echo "selected"; ?>>Rice Cooker</option>
    <option value="Shower Heater" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Shower Heater") echo "selected"; ?>>Shower Heater</option>
    <option value="Vacuum Cleaner" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Vacuum Cleaner") echo "selected"; ?>>Vacuum Cleaner</option>
    <option value="Washing Machine" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Washing Machine") echo "selected"; ?>>Washing Machine</option>
    <option value="Water Pump" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Water Pump") echo "selected"; ?>>Water Pump</option>
  </select>
</div>
</div>
<div class="form-group">
  <label for="productcolour" class="col-sm-3 control-label">Colour</label>
  <div class="col-sm-9">
   <select name="colour" length="10" class="form-control" id="productcolour" required>
    <option selected >Select a colour:</option>
    <option value="Red" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Red") echo "selected"; ?>>Red</option>
    <option value="Black" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Black") echo "selected"; ?>>Black</option>
    <option value="White" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="White") echo "selected"; ?>>White</option>
    <option value="Silver" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Silver") echo "selected"; ?>>Silver</option>
    <option value="Blue" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Blue") echo "selected"; ?>>Blue</option>
    <option value="Others" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Others") echo "selected"; ?>>Others</option>
  </select>
</div>
</div> 
<div class="form-group">
  <label for="productsizecapacity" class="col-sm-3 control-label">Size/Capacity</label>
  <div class="col-sm-9">

   <input name="size_capacity" class="form-control" id="productsizecapacity" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_size_capacity']; ?>" required>
 </div>
</div>  
<div class="form-group">
  <label for="productstock" class="col-sm-3 control-label">Stock</label>
  <div class="col-sm-9">

   <input type="number" name="stock" min="0" max="999" step="1" class="form-control" id="productstock" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>" required>

 </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-3 col-sm-9">

   <?php if (isset($_GET['edit'])) { ?>
    <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
    <button type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
  <?php } else { ?>		
    <button type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
  <?php } ?>
  <button type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>	
</div>
</div>
</form>	

</div>
</div>
<?php } ?> 
<br><br>
<div class="row" id="div-bottom">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
   <div class="page-header">
    <h2>Products List</h2>
  </div>
  

  <table id="productstable" class="table table-striped table-bordered">

    <thead>
     <th><center>Product ID</center></th>
     <th><center>Name</center></th>
     <th><center>Price (RM)</center></th>
     <th><center>Category</center></th>
     <th><center>Colour</center></th>
     <th><center>Size/Capacity</center></th>
     <th><center>Stock</center></th>
     <th><center>Extra Action</center></th>
   </thead>
   <tbody>

    <?php
      // Read
    
    
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
    foreach($result as $readrow) {
      ?>   
      <tr>
        <td align="center"><?php echo $readrow['fld_product_num']; ?></td>
        <td align="center"><?php echo $readrow['fld_product_name']; ?></td>
        <td align="center"><?php echo $readrow['fld_product_price']; ?></td>
        <td align="center"><?php echo $readrow['fld_product_category']; ?></td>
        <td align="center"><?php echo $readrow['fld_product_colour']; ?></td>
        <td align="center"><?php echo $readrow['fld_product_size_capacity']; ?></td>
        <td align="center"><?php echo $readrow['fld_product_stock']; ?></td>
        <td align="center">

          <a href="#" data-pid="<?php echo $readrow['fld_product_num']; ?>"class="btn btn-warning btn-xs btn-details" role="button">Details</a>

          <?php if ($_SESSION['role'] != "Normal Staff") { ?>

            <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
            <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
          <?php } ?>

        </td>
      </tr>
      <?php
    }
    $conn = null;
    ?>	
  </tbody>
</table>
<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm col-md-8 col-md">
    <button class="btn btn-primary" id="exportExcel" style="margin-bottom: 20px;">Export to Excel</button>
  </div>
</div>
<!-- Modal -->
<div id="productDetailsModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Product Details</b></h4>
      </div>
      <div class="modal-body" id="productDetailsContainer">
        <!-- Fetched product details will be displayed here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>



</div>
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
    $('#productstable').DataTable({
      "lengthMenu": [[5, 10, 20, 30, -1],
                        [5, 10, 20, 30, "Show All"]], //Options of records per page
      "order": [1, 'asc'],
          "pageLength": -1, //Default records shown per page
          "buttons": ['excel'],
          "columnDefs": [
            { "searchable": false, "targets": 2 }
            ]
        });

    $('#exportExcel').click(function(event) {
          /* Act on the event */
      var confirmed = window.confirm('Are you sure you want to export the table data to Excel?');
      if (confirmed) {
        $('#productstable').DataTable().buttons('.buttons-excel').trigger();
      }
    });
  });
</script>

</body>
</html>