<?php
include_once 'orders_crud.php';
session_start ();

// Check if the user is not logged in
if (!isset($_SESSION['id'], $_SESSION['name'], $_SESSION['role'])) {
    // Set an alert message
    $alertMessage = "Sorry. This page can only be accessed by logged-in users.";

    // Redirect back to the previous page with the alert message
    header('Location: index.php?alert=' . urlencode($alertMessage));
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HitachiWorld Ordering System : Orders</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>
<style>
	body{
      background:url("bg.jpg");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
      padding-bottom  :  20px;
    }
    #div-top{
      background-color: rgba(255,255,255,0.8);
      margin: auto;
      width: 70%;
      border: 3px lightgrey  ;
      padding: 10px;
      padding-bottom: 	40px;
      justify-content:  center  ;
      border-radius:  25px;

      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #div-bottom {
      background-color: rgba(255,255,255,0.9);
      margin: auto;
      width:  80%;
      border-radius:  25px;
      padding: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.9), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      padding-bottom: 	40px;

    }
</style>
<body>
	<?php include_once 'nav_bar.php'; ?>
	<div class="container-fluid">
		<div class="row" id="div-top">
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
<br><br>
				<div class="row" id="div-bottom">
					<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
						<div class="page-header">
							<h2>Customers List</h2>
						</div>
						<table id="orderstable" class="table table-striped table-bordered">

							<thead>
								<th><center>Order ID</center></th>
								<th><center>Order Date</center></th>
								<th><center>Staff ID</center></th>
								<th><center>Customer ID</center></th>
								<th><center>Actions</center></th>
							</thead>
							<?php
							
							try {
								$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$sql = "SELECT * FROM tbl_orders_a188384_pt2, tbl_staffs_a188384_pt2, tbl_customers_a188384_pt2 WHERE ";
								$sql = $sql."tbl_orders_a188384_pt2.fld_staff_num = tbl_staffs_a188384_pt2.fld_staff_num and ";
								$sql = $sql."tbl_orders_a188384_pt2.fld_customer_num = tbl_customers_a188384_pt2.fld_customer_num";
								$sql = $sql;
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								$result = $stmt->fetchAll();
							}
							catch(PDOException $e){
								echo "Error: " . $e->getMessage();
							}
							foreach($result as $orderrow) {
								?>
								<tbody>
									<td align="center"><?php echo $orderrow['fld_order_num']; ?></td>
									<td align="center"><?php echo $orderrow['fld_order_date']; ?></td>
									<td align="center"><?php echo $orderrow['fld_staff_fname']." ".$orderrow['fld_staff_lname'] ?></td>
									<td align="center"><?php echo $orderrow['fld_customer_fname']." ".$orderrow['fld_customer_lname'] ?></td>
									<td align="center">
										<a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
										<?php if ($_SESSION['role'] != 'Normal Staff'){?>
										<a href="orders.php?edit=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
										<a href="orders.php?delete=<?php echo $orderrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
									<?php } ?>
									</td>
								</tbody>
								<?php
							}
							$conn = null;
							?>
						</table>
						<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm col-md-8 col-md">
    <button class="btn btn-primary" id="exportExcel" style="margin-bottom: 20px;">Export to Excel</button>
  </div>
			</div>
					</div>
				</div>
						
						
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#orderstable').DataTable({
      "lengthMenu": [[5, 10, 20, 30, -1],
                        [5, 10, 20, 30, "Show All"]], //Options of records per page
      "order": [1, 'asc'],
          "pageLength": 10, //Default records shown per page
          "buttons": ['excel'],
          
        });

    $('#exportExcel').click(function(event) {
          /* Act on the event */
      var confirmed = window.confirm('Are you sure you want to export the table data to Excel?');
      if (confirmed) {
        $('#orderstable').DataTable().buttons('.buttons-excel').trigger();
      }
    });
  });
</script>

	</body>
</html>