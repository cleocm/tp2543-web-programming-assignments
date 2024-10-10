<?php
 
if (isset($_POST['add_form'])) {
 
  include "db.php";
 
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      // Prepare the SQL statement
      $stmt = $conn->prepare("INSERT INTO myguestbook(user, email, question, frontpage, form, userinterface, postdate, posttime,
        comment) VALUES (:user, :email, :question, :frontpage, :form, :userinterface, :pdate, :ptime, :comment)");
     
      // Bind the parameters
      $stmt->bindParam(':user', $name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':question', $question, PDO::PARAM_STR);
      $stmt->bindParam(':frontpage', $frontpage, PDO::PARAM_STR);
      $stmt->bindParam(':form', $form, PDO::PARAM_STR);
      $stmt->bindParam(':userinterface', $userinterface, PDO::PARAM_STR);
      $stmt->bindParam(':pdate', $postdate, PDO::PARAM_STR);
      $stmt->bindParam(':ptime', $posttime, PDO::PARAM_STR);
      $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
       
      // Give value to the variables
      $name = $_POST['name'];
      $email = $_POST['email'];
      $question = $_POST['question'];
      $frontpage = isset($_POST['frontpage']);
      $form = isset($_POST['form']);
      $userinterface = isset($_POST['userinterface']);
      $postdate = date("Y-m-d",time());
      $posttime = date("H:i:s",time());
      $comment = $_POST['comment'];

      $stmt->execute();
 
      //echo "New records created successfully";
      header("Location:list.php");
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