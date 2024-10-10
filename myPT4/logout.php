<?php
// logout.php

session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["role"]);
// Destroy the session and redirect to the login page
session_destroy();
header("Location: index.php");
alert("Successfully logged out!");
exit();
?>
