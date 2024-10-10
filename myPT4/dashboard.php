<?php
// dashboard.php

session_start();

// Redirect to the login page if the user is not authenticated
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h1>Welcome, <?php echo $_SESSION["username"]; ?>!</h1>

    <p>Your role: <?php echo $_SESSION["role"]; ?></p>

    <a href="logout.php">Logout</a>

</body>
</html>
