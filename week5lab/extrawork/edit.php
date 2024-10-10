<?php
 
if (isset($_GET['id'])) {
 
  include "db.php";
 
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      $stmt = $conn->prepare("SELECT * FROM myguestbook WHERE id = :record_id");
      $stmt->bindParam(':record_id', $id, PDO::PARAM_INT);
      $id = $_GET['id'];
 
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
      }
 
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
 
    $conn = null;
  }
else {
  echo "Error: You have execute a wrong PHP. Please contact the web administrator.";
  die();
}
 
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
 
<body>
 
<form method="post" action="update.php">
  Nama :
  <input type="text" name="name" size="40" required value="<?php echo $result["user"]; ?>">
  <br>
  Email :
  <input type="text" name="email" size="25" required value="<?php echo $result["email"]; ?>">
  <br>
  How did you find me? <select name="question">
          <option value="">Select</option>
          <option value="From a friend" <?php if ($result["question"] === "From a friend") echo "selected"; ?>>From a friend</option>";
          <option value="From Google" <?php if ($result["question"] === "From Google") echo "selected"; ?>>I googled you</option>";
          <option value="From surfing" <?php if ($result["question"] === "From surfing") echo "selected"; ?>>Just surf on in</option>";
          <option value="From Facebook" <?php if ($result["question"] === "From Facebook") echo "selected"; ?>>From your Facebook</option>";
          <option value="From ads" <?php if ($result["question"] === "From ads") echo "selected"; ?>>I clicked an ad</option>";
        </select>
  <br>
  I like your: <br>
  <input type="checkbox" name="frontpage" value="frontpage" <?php if ($result["frontpage"] === 1) echo "checked"; ?>>
  <label for="frontpage">FrontPage</label><br>
  <input type="checkbox" name="form" value="form" <?php if ($result["form"] === 1) echo "checked"; ?>>
  <label for="form">Form</label><br>
  <input type="checkbox" name="userinterface" value="userinterface" <?php if ($result["userinterface"] === 1) echo "checked"; ?>>
  <label for="userinterface">User Interface</label><br>
  Comments :<br>
  <textarea name="comment" cols="30" rows="8" required><?php echo $result["comment"]; ?></textarea>
  <br>
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
  <input type="submit" name="edit_form" value="Modify Comment">
  <input type="reset">
  <br>
</form>
 
</body>
</html>