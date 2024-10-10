
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
					<td><input name="pid" type="text" size="25px" required></td>
				</tr>
				<tr>
					<td>Name:</td>
					<td><input name="name" type="text" size="25px" required></td>
				</tr>
				<tr>
					<td>Price (RM):</td>
					<td><input name="price" type="text" size="25px" required></td>
				</tr>
				<tr>
					<td>Category:</td>
					<td>
						<select name="category" required>
							<option selected>Select a category:</option>
							<option value="Air Conditioner">Air Conditioner</option>
							<option value="Air Purifier">Air Purifier</option>
							<option value="Kitchen Appliance">Kitchen Appliance</option>
							<option value="Refrigerator">Refrigerator</option>
							<option value="Rice Cooker">Rice Cooker</option>
							<option value="Shower Heater">Shower Heater</option>
							<option value="Vacuum Cleaner">Vacuum Cleaner</option>
							<option value="Washing Machine">Washing Machine</option>
							<option value="Water Pump">Water Pump</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Colour:</td>
					<td>
						<select name="colour" length="10" required>
							<option selected >Select a colour:</option>
							<option value="Red">Red</option>
							<option value="Black">Black</option>
							<option value="White">White</option>
							<option value="Silver">Silver</option>
							<option value="Blue">Blue</option>
							<option value="Others">Others</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Size/Capacity:</td>
					<td><input name="size_capacity" type="text" size="25px" required></td>
				</tr>
				<tr>
					<td>Stock:</td>
					<td><input type="number" name="quantity" min="0" max="999" step="1" required></td>
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
				<td align="center" width="100px">Product ID</td>
				<td align="center" width="250px">Name</td>
				<td align="center" width="100px">Price (RM)</td>
				<td align="center" width="100px">Category</td>
				<td align="center" width="100px">Colour</td>
				<td align="center" width="100px">Size/Capacity</td>
				<td align="center" width="100px">Stock</td>
				<td align="center" width="150px">Extra Action</td>
			</tr>
			<tr>
				<td  align="center">P001</td>
				<td>Hitachi 1.0L Microcomputer Rice Cooker RZ-D10VFY</td>
				<td align="center">329.00</td>
				<td align="center">Rice Cooker</td>
				<td align="center">Black</td>
				<td align="center">1.0L</td>
				<td align="center">17</td>
				<td>  
					<center>
						<a href="products_details.php">Details</a>   
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P002</td>
				<td>Hitachi Cyclonic High Power Compact Bagless Vacuum Cleaner (1600W) CV-SF16</td>
				<td align="center">263.00</td>
				<td align="center">Vacuum Cleaner</td>
				<td align="center">Red</td>
				<td align="center">0.6L</td>
				<td align="center">20</td>
				<td>  
					<center>  
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P003</td>
				<td>Hitachi Stainless Steel Kettle (1.7L) HEK-E60</td>
				<td align="center">76.00</td>
				<td align="center">Kitchen Appliance</td>
				<td align="center">Silver</td>
				<td align="center">1.7L</td>
				<td align="center">99</td>
				<td>  
					<center>   
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P004</td>
				<td>Hitachi New Stylish Line Refridgerator R-H275P7M</td>
				<td align="center">1161.00</td>
				<td align="center">Refrigerator</td>
				<td align="center">Black</td>
				<td align="center">253L</td>
				<td align="center">5</td>
				<td>  
					<center>  
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P005</td>
				<td>Hitachi EP-NZ50J Air Purifier EP-NZ50J</td>
				<td align="center">978.00</td>
				<td align="center">Air Purifier</td>
				<td align="center">White</td>
				<td align="center">537x430x242mm</td>
				<td align="center">2</td>
				<td>  
					<center>   
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P006</td>
				<td>Hitachi New Standard Series R32 1.0HP Air Conditioner RAS-EH10CKM</td>
				<td align="center">979.00</td>
				<td align="center">Air Conditioner</td>
				<td align="center">White</td>
				<td align="center">Indoor: 780x280x230mm; Outdoor: 658x530x275mm</td>
				<td align="center">6</td>
				<td>  
					<center>   
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P007</td>
				<td>Hitachi Inverter Dual Jet Washing Machine (16kg) SF-160TCV</td>
				<td align="center">2152.00</td>
				<td align="center">Washing Machine</td>
				<td align="center">Grey</td>
				<td align="center">16KG</td>
				<td align="center">12</td>
				<td>  
					<center> 
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P008</td>
				<td>Hitachi Electronic Instant Water Heater With Pump (3600W) HES-36WPY</td>
				<td align="center">495.00</td>
				<td align="center">Shower Heater</td><td align="center">White</td>
				<td align="center">215x105x377mm</td>
				<td align="center">11</td>
				<td>  
					<center>   
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P009</td>
				<td>Hitachi Compact Type - Shallow Well Water Pump (250W) WM-P250XS</td>
				<td align="center">757.00</td>
				<td align="center">Water Pump</td>
				<td align="center">White</td>
				<td align="center">354×312×320mm</td>
				<td align="center">3</td>
				<td>  
					<center>   
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>

			<tr>
				<td  align="center">P010</td>
				<td>Hitachi Microcomputer Rice Cooker (1.8L) RZ-D18XFY</td>
				<td align="center">339.00</td>
				<td align="center">Rice Cooker</td>
				<td align="center">White</td>
				<td align="center">1.8L</td>
				<td align="center">39</td>
				<td>  
					<center>
						<a href="products.php">Edit</a>   
						<a href="products.php">Delete</a>  
					</center>
				</td>
			</tr>
			
		</table>
	</center>

</body>
</html>