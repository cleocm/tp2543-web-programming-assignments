<?php
    session_start();
    include_once 'database.php';
    $message="";
    if(isset($_POST['login'])) {

        $email = ($_POST['email']);
        $hashedpassword = md5($_POST["password"]);

        $con = mysqli_connect($servername, $username, $password, $dbname) or die('Unable to connect');
        $result = mysqli_query($con,"SELECT * FROM tbl_staffs_a188384_pt2 WHERE fld_staff_email='" . $email . "' and fld_staff_password = '". $hashedpassword ."'");

        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['fld_staff_num'];
        $_SESSION["name"] = $row['fld_staff_fname'];
        $_SESSION["role"] = $row['fld_staff_position'];

        $message = "Welcome, " .$_SESSION['name']. "! You have successfully logged in as " .$_SESSION['role'].".";
        header('Location: index.php?alert=' . urlencode($message));
        exit();

        } else {
         $message = "Invalid Username or Password!";
         header('Location: index.php?alert=' . urlencode($message));
        }

    }
    
    
    // Check if the user is not logged in
if ($_SESSION['id'] == "" || $_SESSION['name']== "" || $_SESSION['role']== "") {
    // Set an alert message
    $message = "Log in failed. Please try again.";
header('Location: index.php?alert=' . urlencode($message));
    
}


?>