<?php
include_once 'staffs_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HitachiWorld Ordering System : Staffs</title>
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
		<form action="staffs.php" method="post">
			<center>
				<table border="1" width="360px" cellpadding="10">
					<tr>
						<td width="400px">Staff ID:</td>
						<td><input name="sid" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; ?>" required></td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td><input name="fname" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_fname']; ?>" required></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input name="lname" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_lname']; ?>" required></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td>
							<input id="Male" name="gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?>><label for="Male">Male</label>
							<input id="Female" name="gender" type="radio" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?>><label for="Female">Female</label>
						</td>
					</tr>
					<tr>
						<td>Position:</td>
						<td>
							<input id="Sales Assistant" name="position" type="radio" value="Sales Assistant" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_position']=="Sales Assistant") echo "checked"; ?>><label for="Sales Assistant">Sales Assistant</label>
							<input id="Manager" name="position" type="radio" value="Manager" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_position']=="Manager") echo "checked"; ?>><label for="Manager">Manager</label>
						</td>
					</tr>
					<tr>
						<td>Phone Number:</td>
						<td><input name="phone" type="text" size="25px" placeholder="01x-xxxxxxx" pattern="01[0-9]{1}-[0-9]{7,8}" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>" required></td>
					</tr>
					<tr>
						<td>Email Address:</td>
						<td><input name="email" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" required></td>
					</tr>
					</table>

					<br>
					<?php if (isset($_GET['edit'])) { ?>	
					<input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
					<button type="submit" name="update">Update</button>
				<?php } else { ?>	
					<button type="submit" name="create">Create</button>
				<?php } ?>
				<button type="reset">Clear</button>	
			</form>
			<hr>
			<table border="1">
				<tr>
					<td align="center" width="100px">Staff ID</td>
					<td align="center" width="100px">First Name</td>
					<td align="center" width="100px">Last Name</td>
					<td align="center" width="100px">Gender</td>
					<td align="center" width="100px">Position</td>
					<td align="center" width="100px">Phone Number</td>
					<td align="center" width="100px">Email Address</td>
					<td align="center" width="100px">Actions</td>
				</tr>
				<?php
      // Read
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
				foreach($result as $readrow) {
					?>
					<tr>
						<td><?php echo $readrow['fld_staff_num']; ?></td>
						<td><?php echo $readrow['fld_staff_fname']; ?></td>
						<td><?php echo $readrow['fld_staff_lname']; ?></td>
						<td><?php echo $readrow['fld_staff_gender']; ?></td>
						<td><?php echo $readrow['fld_staff_position']; ?></td>
						<td><?php echo $readrow['fld_staff_phone']; ?></td>
						<td><?php echo $readrow['fld_staff_email']; ?></td>
						<td>
							<a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>">Edit</a>
							<a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
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