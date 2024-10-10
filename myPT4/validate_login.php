<?php
session_start();
include_once 'database.php';

// Create a PDO connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs (you may want to add more robust validation)
	$staffEmail = $_POST["email"];
	$password = $_POST["password"];

	echo '<script>alert("'. $staffEmail .'");</script>';
	echo '<script>alert("'. $password .'");</script>';


	try {


        // Prepare and execute the SQL query
		$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a188384_pt2 WHERE fld_staff_email = :email AND fld_staff_password = :password");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->execute();

        // Fetch the result
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		echo '<script>alert("'. $stmt .'");</script>';

        // Check if login is successful
		if ($result > 0) {
            // Authentication successful
// Fetch the user information
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Store user information in the session
			$_SESSION["staff_id"] = $user['fld_staff_num'];
			$_SESSION['role'] = $user['fld_staff_position'];

            // Redirect to a dashboard or home page
			header("Location: index.php");
			exit();
		} else {
            // Authentication failed
            // You may want to redirect to the login page with an error message
			echo '<script>alert("Log in unsuccessful. :(");</script>';
			echo '<script>window.location.href = "index.php";</script>';

			exit();
		}
	} catch (PDOException $e) {
        // Handle database connection errors
		echo "Error: " . $e->getMessage();
        //echo '<script>alert("Log in unsuccessful. Cannot connect.:(");</script>';
    		//echo '<script>window.location.href = "index.php";</script>';
	} finally {
        // Close the database connection
		$conn = null;
	}
} else {
    // If the form is not submitted, redirect to the login page
	header("Location: index.php");
	exit();
}
?>
