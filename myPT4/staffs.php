<?php
include_once 'staffs_crud.php';
session_start ();
//print any alert messages
$alertMessage = isset($_GET['alert']) ? $_GET['alert'] : '';
if (!empty($alertMessage)) {
        echo '<script> alert("' .$alertMessage. '") </script>';
    }
// Check if the user is not logged in
if (!isset($_SESSION['id'], $_SESSION['name'], $_SESSION['role'])) {
    // Set an alert message
    $alertMessage = "Sorry. This page can only be accessed by logged-in users.";

    // Redirect back to the previous page with the alert message
    header('Location: index.php?alert=' . urlencode($alertMessage));
    exit();
}
// Check user role
$userRole = $_SESSION['role'];

// Restrict access based on role
if ($userRole == 'Normal Staff') {
    // Set an alert message for unauthorized users
    $alertMessage = "Sorry. You do not have permission to access this page.";
    header('Location: ' . $_SERVER['HTTP_REFERER'] .'?alert=' . urlencode($alertMessage));
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HitachiWorld Ordering System : Staffs</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<style type="text/css">
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
      padding-bottom:   40px;
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
      padding-bottom:   40px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.9), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

    }
</style>
<script>
	function checkUserRole() {
    // Check user role again (if needed)
    var userRole = "<?php echo $userRole; ?>";

    // Perform additional checks if necessary
    if (userRole === 'Admin') {
        // User has the 'admin' role, proceed with the create action
        
        // Add your logic here for creating something
    } else {
        // User does not have the required role, show a message or take appropriate action
        alert("Sorry, you do not have permission to perform this action.");
        e.preventDefault();
        // Add your logic here for handling unauthorized access
    }
</script>
<body>
	<?php include_once 'nav_bar.php'; ?>

	<div class="container-fluid" >
		<?php if($userRole == "Admin" || isset($_GET['edit'])) { ?>
		<div class="row" id="div-top">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="page-header">
					<?php if(isset($_GET['edit'])) {?>
					<h2>Update Staff Information</h2>
					<?php } else {?>
					<h2>Create New Staff</h2> <?php } ?>
				</div>
				<form action="staffs.php" class="form-horizontal" method="post">
					<div class="form-group">
						<label for="staffid" class="col-sm-3 control-label">Staff ID</label>
						<div class="col-sm-9">
							<input name="sid" id="staffid" class="form-control" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="staffemail" class="col-sm-3 control-label">Email Address</label>
						<div class="col-sm-9">
							<input id="staffemail" class="form-control" name="email" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="staffpassword" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<input id="staffpassword" class="form-control" name="password" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="stafffirstname" class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-9">	
							<input id="stafffirstname" class="form-control" name="fname" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_fname']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="stafflastname" class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-9">
							<input id="stafflastname" class="form-control" name="lname" type="text" size="25px" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_lname']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="staffgender" class="col-sm-3 control-label">Gender</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input id="staffgender" name="gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?> required>Male
								</label>
							</div>
							<div class="radio">
								<label>
									<input id="staffgender" name="gender" type="radio" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?> required>Female
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="staffposition" class="col-sm-3 control-label">Position</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input id="staffposition" name="position" type="radio" value="Normal Staff" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_position']=="Normal Staff") echo "checked"; ?> required>Normal Staff
								</label>
							</div>
							<div class="radio">
								<label>
									<input id="staffposition" name="position" type="radio" value="Supervisor" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_position']=="Supervisor") echo "checked"; ?> required>Supervisor
								</label>
							</div>
							<div class="radio">
								<label>
									<input id="staffposition" name="position" type="radio" value="Admin" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_position']=="Admin") echo "checked"; ?> required>Admin
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="staffphone" class="col-sm-3 control-label">Phone Number</label>
						<div class="col-sm-9">		
							<input id="staffphone" class="form-control" name="phone" type="text" size="25px" placeholder="01x-xxxxxxx" pattern="01[0-9]{1}-[0-9]{7,8}" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>" required>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<?php if (isset($_GET['edit'])) { ?>
								<input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
								<button type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
							<?php } else { 
								if($userRole == "Admin") { ?>

								<button type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
							<?php }
						}
							 ?>
							<button type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
						</div>
					</div>	
				</form>
			</div>
		</div>
	</div>
	<br>
	<br>
	<?php } ?>
		<div class="row" id="div-bottom">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h2>Staffs List</h2>
				</div>
				<table id="staffstable" class="table table-striped table-bordered">

					<thead>
						<th><center>Customer ID</center></th>
						<th><center>Email</center></th>
						<th><center>First Name</center></th>
						<th><center>Last Name</center></th>
						<th><center>Gender</center></th>
						<th><center>Position</center></th>
						<th><center>Phone Number</center></th>
						<th><center>Actions</center></th>
					</thead>
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
						<tbody>
							<td align="center"><?php echo $readrow['fld_staff_num']; ?></td>
							<td align="center"><?php echo $readrow['fld_staff_email']; ?></td>
							<td align="center"><?php echo $readrow['fld_staff_fname']; ?></td>
							<td align="center"><?php echo $readrow['fld_staff_lname']; ?></td>
							<td align="center"><?php echo $readrow['fld_staff_gender']; ?></td>
							<td align="center"><?php echo $readrow['fld_staff_position']; ?></td>
							<td align="center"><?php echo $readrow['fld_staff_phone']; ?></td>
							
							<td align="center">
								<a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit</a>
								<?php if ($userRole	== "Admin") {?>
									<a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button"> Delete</a>
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
    $('#staffstable').DataTable({
      "lengthMenu": [[5, 10, 20, 30, -1],
                        [5, 10, 20, 30, "Show All"]], //Options of records per page
      "order": [1, 'asc'],
          "pageLength": 10, //Default records shown per page
          "buttons": ['excel'],
          "columnDefs": [
            { "searchable": false, "targets": 2 }
            ]
        });

    $('#exportExcel').click(function(event) {
          /* Act on the event */
      var confirmed = window.confirm('Are you sure you want to export the table data to Excel?');
      if (confirmed) {
        $('#staffstable').DataTable().buttons('.buttons-excel').trigger();
      }
    });
  });
</script>
		
	</body>
	</html>