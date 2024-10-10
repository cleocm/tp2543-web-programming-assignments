<!DOCTYPE html>
<html>
<head>

  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Questrial" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

    <head>  
        <style>
            html{
                background-color: #white;
            }
            body{
                letter-spacing:1px;
                font-family: Questrial; 
                border-width: 0;

            }
            nav div{
                background-color: ghostwhite    ;
                

            }
            nav div a{
                color: white;
            }
            .active, nav div ul li:hover{
                background-color: #C19E7B;
            }
            .active, nav div a:hover{
                color: #3A3434;
            }


        </style>

    </head>
    <!-- Brand and toggle get grouped for better mobile display -->
  <body> 
<nav class="navbar navbar-default">
    <div class="container-fluid">   
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    
    <a class="navbar-brand" href="index.php" font-family="aria-label">HitachiWorld</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav" font-weight= "bold">
      <li><a href="index.php">Home</a></li>
      <li><a href="products.php">Products</a></li>
      <li><a href="customers.php">Customers</a></li>
      <li><a href="staffs.php">Staffs</a></li>
      <li><a href="orders.php">Orders</a></li>
  </ul> 

  
  
  <ul class="nav navbar-nav navbar-right">
    <?php
    if (isset($_SESSION['id'], $_SESSION['name'], $_SESSION['role'])) {
    // User is logged in, show "Log Out" button
    
    echo '<li><a href=#>Hello, ' .$_SESSION['name'].' !</a></li>';
}
?>
    
<?php
                // Check if the user is logged in
if (isset($_SESSION['id'], $_SESSION['name'], $_SESSION['role'])) {
    // User is logged in, show "Log Out" button
    
    echo '<li><a href="logout.php">Log Out</a></li>';
} else {
                    // User is not logged in, show "Log In" button
    echo '<li><a href="#" data-toggle="modal" data-target="#loginModal">Log In</a></li>';
}
?>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Log In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your login form here -->
                <form id="login" name="login" onsubmit="return validateForm()" action="verify_login_details.php" method="post">
                    <!-- Your login form fields go here -->
                    <div class="form-group">
                        <label for="email">Staff Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" name ="login" class="btn btn-primary">Log In</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 
  function validateForm() {
 
      //var x = document.forms["login"]["email"].value;
      //var y = document.forms["login"]["password"].value;
      var x = document.getElementById("email").value;
      var y = document.getElementById("password").value;
      if (x == null || x == "") {
          alert("Please enter an email.");
          //document.forms["login"]["email"].focus();
          document.getElementById("email").focus();
          return false;
      }
      if (y == null || y == "") {
          alert("Please enter a password.");
          //document.forms["login"]["password"].focus();
          document.getElementById("password").focus();
          return false;
      }
       
      return true;
  }
 
</script>
</body>
