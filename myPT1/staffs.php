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
					<td>Position:</td>
					<td>
						<input id="salesAssistant" name="position" type="radio" value="Sales Assistant"><label for="salesAssistant">Sales Assistant</label>
						<input id="manager" name="position" type="radio" value="Manager"><label for="manager">Manager</label>
					</td>
				</tr>
				<tr>
					<td>Phone Number:</td>
					<td><input name="phone" type="text" size="25px" placeholder="01x-xxxxxxx" pattern="01[0-9]{1}-[0-9]{7,8}" required></td>
				</tr>
				<tr>
					<td>Email Address:</td>
					<td><input name="email" type="text" size="25px" required></td>
				</tr>
			</table>
		
			<br>		
			<button type="submit" name="create">Create</button>
			<button type="reset">Clear</button>	
		</form>
		</center>
		<hr>
		<center>
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
			<tr>
				<td align="center">S001</td>
				<td align="center">Sarah</td>
				<td align="center">Bay</td>
				<td align="center">Female</td>
				<td align="center">Manager</td>
				<td align="center">013-3922010</td>
				<td align="center">sarah.bay@hitachi.com</td>
				<td align="center" width="100px">
					<a href="staffs.php">Edit</a>
					<a href="staffs.php">Delete</a>
				</td>
			</tr>
			<tr>
				<td align="center">S002</td>
				<td align="center">Adam</td>
				<td align="center">Martin</td>
				<td align="center">Male</td>
				<td align="center">Sales Assistant</td>
				<td align="center">019-8321266</td>
				<td align="center">adam.martin@hitachi.com</td>
				<td align="center">
					<a href="staffs.php">Edit</a>
					<a href="staffs.php">Delete</a>
				</td>
			</tr>
			<tr>
				<td align="center">S003</td>
				<td align="center">Ali</td>
				<td align="center">North</td>
				<td align="center">Male</td>
				<td align="center">Sales Assistant</td>
				<td align="center">016-3925442</td>
				<td align="center">ali.north@hitachi.com</td>
				<td align="center">
					<a href="staffs.php">Edit</a>
					<a href="staffs.php">Delete</a>
				</td>
			</tr>
		</table>
	</center>

</body>
</html>