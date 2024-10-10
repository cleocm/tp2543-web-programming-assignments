<?php
include_once 'orders_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HitachiWorld Ordering System : Orders</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<?php include_once 'nav_bar.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="page-header">
					<h2>Create New Order</h2>
				</div>
				<form action="orders.php" class="form-horizontal" method="post">
					<div class="form-group">
						<label for="orderid" class="col-sm-3 control-label">Order ID</label>
						<div class="col-sm-9">

							<input name="oid" id="orderid" class="form-control" type="text" size="25px" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_num']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="order_date" class="col-sm-3 control-label">Order Date</label>
						<div class="col-sm-9">

							<input name="orderdate" id="order_date" class="form-control" type="date" size="25px" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="staffid_order" class="col-sm-3 control-label">Staff ID</label>
						<div class="col-sm-9">

							<select name="sid" id="staffid_order" class="form-control">
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
									<?php } // while
									$conn = null;
									?> 
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="customerid_order" class="col-sm-3 control-label">Customer ID</label>
							<div class="col-sm-9">


								<select name="cid" id="customerid_order" class="form-control">
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
										<?php } // while
										$conn = null;
										?> 
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">

									<?php if (isset($_GET['edit'])) { ?>
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
							<h2>Customers List</h2>
						</div>
						<table id="orderstable" class="table table-striped table-bordered">

							<tr>
								<th><center>Order ID</center></th>
								<th><center>Order Date</center></th>
								<th><center>Staff ID</center></th>
								<th><center>Customer ID</center></th>
								<th><center>Actions</center></th>
							</tr>
							<?php
							$per_page = 5;
							if (isset($_GET["page"]))
								$page = $_GET["page"];
							else
								$page = 1;
							$start_from = ($page-1) * $per_page;

							try {
								$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$sql = "SELECT * FROM tbl_orders_a188384_pt2, tbl_staffs_a188384_pt2, tbl_customers_a188384_pt2 WHERE ";
								$sql = $sql."tbl_orders_a188384_pt2.fld_staff_num = tbl_staffs_a188384_pt2.fld_staff_num and ";
								$sql = $sql."tbl_orders_a188384_pt2.fld_customer_num = tbl_customers_a188384_pt2.fld_customer_num";
								$sql = $sql." LIMIT $start_from, $per_page";
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
									<td align="center"><?php echo $orderrow['fld_order_num']; ?></td>
									<td align="center"><?php echo $orderrow['fld_order_date']; ?></td>
									<td align="center"><?php echo $orderrow['fld_staff_fname']." ".$orderrow['fld_staff_lname'] ?></td>
									<td align="center"><?php echo $orderrow['fld_customer_fname']." ".$orderrow['fld_customer_lname'] ?></td>
									<td align="center">
										<a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
										<a href="orders.php?edit=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
										<a href="orders.php?delete=<?php echo $orderrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
							$stmt = $conn->prepare("SELECT * FROM tbl_orders_a188384_pt2");
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
							<li><a href="orders.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<?php
						}
						for ($i=1; $i<=$total_pages; $i++)
							if ($i == $page)
								echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
							else
								echo "<li><a href=\"orders.php?page=$i\">$i</a></li>";
							?>
							<?php if ($page==$total_pages) { ?>
								<li class="disabled"><span aria-hidden="true">»</span></li>
							<?php } else { ?>
								<li><a href="orders.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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