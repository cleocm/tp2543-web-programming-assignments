<?php
include_once 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HitachiWorld Ordering System : Products Details</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>


      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a188384_pt2 WHERE fld_product_num = :pid");
        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $pid = $_GET['pid'];
        $stmt->execute();
        $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
      catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      $conn = null;
      ?>


      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-5 text-center">
            <?php if ($readrow['fld_product_image'] == "") {
              echo "No image";
            } else { ?>
              <img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-responsive">
            <?php } ?>
          </div>
          <div class="col-xs-12 col-sm-7">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>Product Details</strong></div>
              <div class="panel-body">
                <table class="table">
                  <tr>
                    <td><strong>Product ID</strong></td>
                    <td><?php echo $readrow['fld_product_num'] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Name</strong></td>
                    <td><?php echo $readrow['fld_product_name'] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Price</strong></td>
                    <td>RM <?php echo $readrow['fld_product_price'] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Category</strong></td>
                    <td><?php echo $readrow['fld_product_category'] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Colour</strong></td>
                    <td><?php echo $readrow['fld_product_colour'] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Size/Capacity</strong></td>
                    <td><?php echo $readrow['fld_product_size_capacity'] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Stock</strong></td>
                    <td><?php echo $readrow['fld_product_stock'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </body>
  </html>
