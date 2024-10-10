<?php
include_once 'customers_crud.php';
session_start ();
//print alert messages
$alertMessage = isset($_GET['alert']) ? $_GET['alert'] : '';
if (!empty($alertMessage)) {
        echo '<script> alert("' .$alertMessage. '") </script>';
    }
// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
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
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>HitachiWorld Ordering System : Customers</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
	<style type="text/css">
		#productstable th:nth-child(6),
		#productstable td:nth-child(6) {
			width: 15%; 
		}
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
</head>
<body>
	<?php include_once 'nav_bar.php'; ?>

	<div class="container-fluid">
		<?php if ($_SESSION['role'] != 'Normal Staff'){?>
		<div class="row" id="div-top">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="page-header">
					<h2>Create New Customer</h2>
				</div>
				<form action="customers.php" class="form-horizontal" method="post">
					
					<div class="form-group">
						<label for="customerid" class="col-sm-3 control-label">Customer ID</label>
						<div class="col-sm-9">
							<input name="cid" class="form-control" id="customerid" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_num']; ?>" required></td>
						</div>
					</div>
					<div class="form-group">
						<label for="custfirstname" class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-9">

							<input name="fname" class="form-control" id="custfirstname" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_fname']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="custlastname" class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-9">

							<input name="lname" class="form-control" id="custlastname" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_lname']; ?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="custgender" class="col-sm-3 control-label">Gender</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input id="custgender" name="gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Male") echo "checked"; ?> required>Male
								</label>
							</div>

							<div class="radio">
								<label>

									<input id="custgender" name="gender" type="radio" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Female") echo "checked"; ?>>Female
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="custphone" class="col-sm-3 control-label">Phone Number</label>
						<div class="col-sm-9">
							<input name="phone" class="form-control" id="custphone" type="text" size="25px" placeholder="01x-xxxxxxx" pattern="01[0-9]{1}-[0-9]{7,8}" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">

							<?php if (isset($_GET['edit'])) { ?>	
								<input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_num']; ?>">
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
	<?php } ?>
	<br>
	<br>

		<div class="row" id="div-bottom">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h2>Customers List</h2>
				</div>
				<table id="customerstable" class="table table-striped table-bordered">

					<thead>
						<th><center>Customer ID</center></th>
						<th><center>First Name</center></th>
						<th><center>Last Name</center></th>
						<th><center>Gender</center></th>
						<th><center>Phone Number</center></th>
						<?php if ($_SESSION['role'] != 'Normal Staff'){?>
						<th><center>Actions</center></th>
					<?php } ?>
					</thead>


					<?php
					
      // Read
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
					foreach($result as $readrow) {
						?>
						<tbody>
							<td align="center"><?php echo $readrow['fld_customer_num']; ?></td>
							<td align="center"><?php echo $readrow['fld_customer_fname']; ?></td>
							<td align="center"><?php echo $readrow['fld_customer_lname']; ?></td>
							<td align="center"><?php echo $readrow['fld_customer_gender']; ?></td>
							<td align="center"><?php echo $readrow['fld_customer_phone']; ?></td>
							<?php if ($_SESSION['role'] != 'Normal Staff'){?>
							<td align="center">
								<a href="customers.php?edit=<?php echo $readrow['fld_customer_num']; ?>"class="btn btn-success btn-xs" role="button"> Edit</a>
								<a href="customers.php?delete=<?php echo $readrow['fld_customer_num']; ?>" onclick="return confirm('Are you sure to delete?');"class="btn btn-danger btn-xs" role="button"> Delete</a>
							</td>
						<?php	} ?>
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
    $('#customerstable').DataTable({
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
        $('#customerstable').DataTable().buttons('.buttons-excel').trigger();
      }
    });
  });
</script>

	</body>
	</html>