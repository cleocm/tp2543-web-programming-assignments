<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HitachiWorld Ordering System : Customers</title>
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
	<form action="customers.php" method="post">
		<center>
			<table border="1" width="360px" cellpadding="10">
				<tr>
					<td width="400px">Customer ID:</td>
					<td><input name="cid" type="text" size="25px" required></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><input name="fname" type="text" size="25px" required></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input name="lname" type="text" size="25px" required></td>
				</tr>
				<tr>
					<td>Gender:</td>
					<td>
						<input id="Male" name="gender" type="radio" value="Male"><label for="Male">Male</label>
						<input id="Female" name="gender" type="radio" value="Female"><label for="Female">Female</label>
					</td>
				</tr>
				<tr>
					<td>Phone Number:</td>
					<td><input name="phone" type="text" size="25px" placeholder="01x-xxxxxxx" pattern="01[0-9]{1}-[0-9]{7,8}" required></td>
				</tr>
			</table>
			<br>		
			<button type="submit" name="create">Create</button>
			<button type="reset">Clear</button>	
		</form>
		<hr>
		<table border="1">
			<tr>
				<td align="center" width="100px">Customer ID</td>
				<td align="center" width="100px">First Name</td>
				<td align="center" width="100px">Last Name</td>
				<td align="center" width="100px">Gender</td>
				<td align="center" width="100px">Phone Number</td>
				<td align="center" width="100px">Actions</td>
			</tr>
			<tr>
				<td align="center">C001</td>
				<td align="center">John</td>
				<td align="center">Garcia</td>
				<td align="center">Male</td>
				<td align="center">019-2849132</td>
				<td align="center" width="100px">
					<a href="customers.php">Edit</a>
					<a href="customers.php">Delete</a>
				</td>
			</tr>
			<tr>
				<td align="center">C002</td>
				<td align="center">Amy</td>
				<td align="center">Winehouse</td>
				<td align="center">Female</td>
				<td align="center">011-7226581</td>
				<td align="center">
					<a href="customers.php">Edit</a>
					<a href="customers.php">Delete</a>
				</td>
			</tr>
			<tr>
				<td align="center">C003</td>
				<td align="center">James</td>
				<td align="center">Bond</td>
				<td align="center">Male</td>
				<td align="center">011-7589668</td>
				<td align="center">
					<a href="customers.php">Edit</a>
					<a href="customers.php">Delete</a>
				</td>
			</tr>
		</table>
	</center>

</body>
</html>