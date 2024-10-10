<?php
include_once 'products_crud.php';
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
  </style>
  <body>

  	<?php include_once 'nav_bar.php'; ?>

  	<div class="container-fluid">
  		<div class="row">
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

      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
         <div class="page-header">
          <h2>Products List</h2>
        </div>
        <table id="productstable" class="table table-striped table-bordered">

          <tr>
           <th><center>Product ID</center></th>
           <th><center>Name</center></th>
           <th><center>Price (RM)</center></th>
           <th><center>Category</center></th>
           <th><center>Colour</center></th>
           <th><center>Size/Capacity</center></td>
            <th><center>Stock</center></th>
            <th><center>Extra Action</center></th>
          </tr>
          <?php
      // Read
          $per_page = 8;
          if (isset($_GET["page"]))
            $page = $_GET["page"];
          else
            $page = 1;
          $start_from = ($page-1) * $per_page;
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a188384_pt2 LIMIT $start_from, $per_page");
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
             <td><?php echo $readrow['fld_product_name']; ?></td>
             <td align="center"><?php echo $readrow['fld_product_price']; ?></td>
             <td align="center"><?php echo $readrow['fld_product_category']; ?></td>
             <td align="center"><?php echo $readrow['fld_product_colour']; ?></td>
             <td align="center"><?php echo $readrow['fld_product_size_capacity']; ?></td>
             <td align="center"><?php echo $readrow['fld_product_stock']; ?></td>
             <td>  
              <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
              <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
              <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>

            </td>
          </tr>
          <?php
        }
        $conn = null;
        ?>	
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
        <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a188384_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
            echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
            <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
            ?>
            <?php if ($page==$total_pages) { ?>
              <li class="disabled"><span aria-hidden="true">»</span></li>
            <?php } else { ?>
              <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
            <?php } ?>
          </ul>
        </nav>
      </div>
    </div>

  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

</body>
</html>