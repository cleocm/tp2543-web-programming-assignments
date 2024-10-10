<?php
include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HitachiWorld Ordering System : Products</title>
</head>
<style type="text/css">     
	select {
		width:200px;
	}
</style>
<body>
	<p align ="center"> 
		<a href="index.php">Home</a> | 
		<a href="products.php">Products</a> | 
		<a href="customers.php">Customers</a> | 
		<a href="staffs.php">Staffs</a> | 
		<a href="orders.php">Orders</a>
		<br>
		<hr>
		<form action="products.php" method="post">
			<center>
				<table border="1" width="360px" margin="20px"cellpadding="10">
					<tr>
						<td width="400px">Product ID:</td>
						<td><input name="pid" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required></td>
					</tr>
					<tr>
						<td>Name:</td>
						<td><input name="name" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required></td>
					</tr>
					<tr>
						<td>Price (RM):</td>
						<td><input name="price" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>"required></td>
					</tr>
					<tr>
						<td>Category:</td>
						<td>
							<select name="category" required>
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
						</td>
					</tr>
					<tr>
						<td>Colour:</td>
						<td>
							<select name="colour" length="10" required>
								<option selected >Select a colour:</option>
								<option value="Red" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Red") echo "selected"; ?>>Red</option>
								<option value="Black" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Black") echo "selected"; ?>>Black</option>
								<option value="White" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="White") echo "selected"; ?>>White</option>
								<option value="Silver" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Silver") echo "selected"; ?>>Silver</option>
								<option value="Blue" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Blue") echo "selected"; ?>>Blue</option>
								<option value="Others" <?php if(isset($_GET['edit'])) if($editrow['fld_product_colour']=="Others") echo "selected"; ?>>Others</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Size/Capacity:</td>
						<td><input name="size_capacity" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_size_capacity']; ?>" required></td>
					</tr>
					<tr>
						<td>Stock:</td>
						<td><input type="number" name="stock" min="0" max="999" step="1" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>" required></td>
					</tr>
				</table>
				<br>
				<?php if (isset($_GET['edit'])) { ?>
					<input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
					<button type="submit" name="update">Update</button>
				<?php } else { ?>		
					<button type="submit" name="create">Create</button>
				<?php } ?>
				<button type="reset">Clear</button>	
			</form>	
		</center>	 

		<hr>
		<center>
			<table border="1"> 

				<tr>
					<td align="center" width="100px">Product ID</td>
					<td align="center" width="250px">Name</td>
					<td align="center" width="100px">Price (RM)</td>
					<td align="center" width="100px">Category</td>
					<td align="center" width="100px">Colour</td>
					<td align="center" width="100px">Size/Capacity</td>
					<td align="center" width="100px">Stock</td>
					<td align="center" width="150px">Extra Action</td>
				</tr>
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
						<td  align="center"><?php echo $readrow['fld_product_num']; ?></td>
						<td><?php echo $readrow['fld_product_name']; ?></td>
						<td align="center"><?php echo $readrow['fld_product_price']; ?></td>
						<td align="center"><?php echo $readrow['fld_product_category']; ?></td>
						<td align="center"><?php echo $readrow['fld_product_colour']; ?></td>
						<td align="center"><?php echo $readrow['fld_product_size_capacity']; ?></td>
						<td align="center"><?php echo $readrow['fld_product_stock']; ?></td>
						<td>  
							<center>
								<a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>">Details</a>   
								<a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>">Edit</a>   
								<a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>  
							</center>
						</td>
					</tr>
					<?php
				}
				$conn = null;
				?>	
			</table>
		</center>

	</body>
	</html>