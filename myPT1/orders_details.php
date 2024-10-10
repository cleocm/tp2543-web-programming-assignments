<!DOCTYPE html>
<html>
<head>
  <title>HitachiWorld Ordering System : Order Details</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    Order ID: O5603f03a9349f0.39900158<br>
    Order Date: 09-09-2015 <br>
    Staff: Adam Martin <br>
    Customer: John Garcia <br>
    <hr>
    <form action="orders_details.php" method="post">
      Product: 
      <select name="pid">
        <option value="P001">Microcomputer Rice Cooker RZ-D10VFY</option>
        <option value="P002">Cyclonic High Power Compact Bagless Vacuum Cleaner (1600W) CV-SF16</option>
        <option value="P003">Stainless Steel Kettle (1.7L) HEK-E60</option>
        <option value="P004">New Stylish Line Refridgerator R-H275P7M</option>
        <option value="P005">Air Purifier EP-NZ50J</option>
        <option value="P006">New Standard Series R32 1.0HP Air Conditioner RAS-EH10CKM</option>
        <option value="P007">Inverter Dual Jet Washing Machine (16kg) SF-160TCV</option>
        <option value="P008">Electronic Instant Water Heater With Pump (3600W) HES-36WPY</option>
        <option value="P009">Compact Type - Shallow Well Water Pump (250W) WM-P250XS</option>
        <option value="P010">Microcomputer Rice Cooker (1.8L) RZ-D18XFY</option>
      </select><br><br>
      Quantity: 
      <input name="quantity" type="text"><br><br>
      <button type="submit" name="addproduct">Add Product</button>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td align="center">Order Detail ID</td>
        <td align="center">Product</td>
        <td align="center">Quantity</td>
        <td></td>
      </tr>
      <tr>
        <td>D5603f136f41334.84833440</td>
        <td>Stainless Steel Kettle (1.7L) HEK-E60</td>
        <td align="center">1</td>
        <td>
          <a href="orders_details.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>O5603f03a9349f0.39900158</td>
        <td>Microcomputer Rice Cooker RZ-D10VFY</td>
        <td align="center">2</td>
        <td>
          <a href="orders_details.php">Delete</a>
        </td>
      </tr>
    </table>
    <hr>
    <a href="invoice.php" target="_blank">Generate Invoice</a>
  </center>
</body>
</html>