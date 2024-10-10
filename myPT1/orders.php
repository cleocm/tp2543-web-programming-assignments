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
					<td><input name="oid" type="text" size="25px" disabled></td>
				</tr>
				<tr>
					<td>Order Date:</td>
					<td><input name="orderdate" type="date" size="25px" disabled></td>
				</tr>
				<tr>
					<td>Staff:</td>
					<td>
						<select name="sid">
							<option value="S001">Sarah Bay</option>
							<option value="S002">Adam Martin</option>
							<option value="S003">Ali North</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Customer:</td>
					<td>
						<select name="cid">
							<option value="C001">John Garcia</option>
							<option value="C002">Amy Winehouse</option>
							<option value="C003">James Bond</option>
						</select>
					</td>
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
				<td align="center" width="100px">Order ID</td>
				<td align="center" width="100px">Order Date</td>
				<td align="center" width="100px">Staff ID</td>
				<td align="center" width="100px">Customer ID</td>
				<td align="center" width="150px">Actions</td>
			</tr>
			<tr>
				<td align="center">O5603f03a9349f0.39900158</td>
				<td align="center">09-09-2015</td>
				<td align="center">Adam Martin</td>
				<td align="center">John Garcia</td>
				<td align="center" width="100px"> 
					<a href="orders_details.php">Details</a>  
					<a href="orders.php">Edit</a>  
					<a href="orders.php">Delete</a> 
				</td>
			</tr>
		</table>
	</center>
</body>
</html>