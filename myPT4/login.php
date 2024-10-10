<?php
// login.php

// Replace these credentials with your actual database credentials
include_once 'database.php';

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password before checking it against the database
    $hashedPassword = md5($password);

    // Query the database to check the user's credentials
    $sql = "SELECT fld_staff_num, fld_staff_fname, fld_staff_password, fld_staff_position FROM tbl_staffs_a188384_pt2 WHERE fld_staff_email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["fld_staff_password"])) {
            // Password is correct, set up a session and redirect to a protected page
            session_start();
            $_SESSION["user_id"] = $row["fld_staff_num"];
            $_SESSION["user_name"] = $row["fld_staff_fname"];
            $_SESSION["position"] = $row["fld_staff_position"];
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>
