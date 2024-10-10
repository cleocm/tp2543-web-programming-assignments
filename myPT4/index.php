<?php
session_start ();
$alertMessage = isset($_GET['alert']) ? $_GET['alert'] : '';
if (!empty($alertMessage)) {
        echo '<script> alert("' .$alertMessage. '") </script>';
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>HitachiWorld Ordering System</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    	<style type="text/css">
      body {
    margin: 0;
    padding: 0;
    overflow: hidden;
}
html {
        width:100%;
        height:100%;
        background:url(sunrise.jpg) center center no-repeat;
        background-size: cover;
        min-height:100%;
        position:   relative;
      }
#background-container {
    
    background:url(sunrise.jpg) ;
        background-size: cover;
        min-height:100%;
    
}

#motto-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    opacity: 0;
    animation: slideAndFade 2s forwards;
}

@keyframes slideAndFade {
    0% {
        top: 40%;
        opacity: 0;
    }
    100% {
        top: 50%;
        opacity: 1;
    }
}
    
}
    </style>
</head>
<!--<script>
        document.addEventListener("DOMContentLoaded", function () {
            // Check if the alert message is present (user is not logged in)
            var alertMessage = "<?php echo isset($_GET['alert']) ? htmlspecialchars($_GET['alert'], ENT_QUOTES) : ''; ?>";
            if (alertMessage) {
                // Trigger the login modal
                $('#loginModal').modal('show');
            }
        });
    </script>-->
<body>
	<!--<p align ="center"> 
		<a href="index.php">Home</a> | 
		<a href="products.php">Products</a> | 
		<a href="customers.php">Customers</a> | 
		<a href="staffs.php">Staffs</a> | 
		<a href="orders.php">Orders</a>
	<br>
	<hr>-->


	<?php include_once 'nav_bar.php'; ?>

  <div id="background-container">
        <div id="motto-container">
            <img src="motto.png" alt="Your Motto">
        </div>
    </div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>