<?php
include_once 'orders_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HitachiWorld Ordering System : Orders</title>
</head>
<body>
	<p align ="center"> 
		<a href="index.php">Home</a> | 
		<a href="products.php">Products</a> | 
		<a href="customers.php">Customers</a> | 
		<a href="staffs.php">Staffs</a> | 
		<a href="orders.php">Orders</a>
		<br>
		<hr>
		<form action="orders.php" method="post">
			<center>
				<table border="1" width="360px" cellpadding="10">
					<tr>
						<td width="400px">Order ID:</td>
						<td><input name="oid" type="text" size="25px" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_num']; ?>"></td>
					</tr>
					<tr>
						<td>Order Date:</td>
						<td><input name="orderdate" type="date" size="25px" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>"></td>
					</tr>
					<tr>
						<td>Staff:</td>
						<td>
							<select name="sid">
								<?php
								try {
									$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
									$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a188384_pt2");
									$stmt->execute();
									$result = $stmt->fetchAll();
								}
								catch(PDOException $e){
									echo "Error: " . $e->getMessage();
								}
								foreach($result as $staffrow) {
									?>
									<?php if((isset($_GET['edit'])) && ($editrow['fld_staff_num']==$staffrow['fld_staff_num'])) { ?>
										<option value="<?php echo $staffrow['fld_staff_num']; ?>" selected><?php echo $staffrow['fld_staff_fname']." ".$staffrow['fld_staff_lname'];?></option>
									<?php } else { ?>
										<option value="<?php echo $staffrow['fld_staff_num']; ?>"><?php echo $staffrow['fld_staff_fname']." ".$staffrow['fld_staff_lname'];?></option>
									<?php } ?>
									<?php
      } // while
      $conn = null;
      ?> 
  </select>
</td>
</tr>
<tr>
	<td>Customer:</td>
	<td>
		<select name="cid">
			<?php
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $conn->prepare("SELECT * FROM tbl_customers_a188384_pt2");
				$stmt->execute();
				$result = $stmt->fetchAll();
			}
			catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
			foreach($result as $custrow) {
				?>
				<?php if((isset($_GET['edit'])) && ($editrow['fld_customer_num']==$custrow['fld_customer_num'])) { ?>
					<option value="<?php echo $custrow['fld_customer_num']; ?>" selected><?php echo $custrow['fld_customer_fname']." ".$custrow['fld_customer_lname']?></option>
				<?php } else { ?>
					<option value="<?php echo $custrow['fld_customer_num']; ?>"><?php echo $custrow['fld_customer_fname']." ".$custrow['fld_customer_lname']?></option>
				<?php } ?>
				<?php
      } // while
      $conn = null;
      ?> 
  </select>
</td>
</tr>
</table>

<br>
<?php if (isset($_GET['edit'])) { ?>
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
			<td align="center" width="100px">Order ID</td>
			<td align="center" width="100px">Order Date</td>
			<td align="center" width="100px">Staff ID</td>
			<td align="center" width="100px">Customer ID</td>
			<td align="center" width="150px">Actions</td>
		</tr>
		<?php
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM tbl_orders_a188384_pt2, tbl_staffs_a188384_pt2, tbl_customers_a188384_pt2 WHERE ";
			$sql = $sql."tbl_orders_a188384_pt2.fld_staff_num = tbl_staffs_a188384_pt2.fld_staff_num and ";
			$sql = $sql."tbl_orders_a188384_pt2.fld_customer_num = tbl_customers_a188384_pt2.fld_customer_num";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		foreach($result as $orderrow) {
			?>
			<tr>
				<td><?php echo $orderrow['fld_order_num']; ?></td>
				<td><?php echo $orderrow['fld_order_date']; ?></td>
				<td><?php echo $orderrow['fld_staff_fname']." ".$orderrow['fld_staff_lname'] ?></td>
				<td><?php echo $orderrow['fld_customer_fname']." ".$orderrow['fld_customer_lname'] ?></td>
				<td>
					<a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>">Details</a>
					<a href="orders.php?edit=<?php echo $orderrow['fld_order_num']; ?>">Edit</a>
					<a href="orders.php?delete=<?php echo $orderrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
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