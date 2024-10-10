<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
 
<body>
 
<form method="post" action="insert.php">
  Nama :
  <input type="text" name="name" size="40" required>
  <br>
  Email :
  <input type="text" name="email" size="25" required>
  <br>
  How did you find me? <select name="question">
          <option value="" selected>Select</option>
          <option value="From a friend">From a friend</option>";
          <option value="From Google">I googled you</option>";
          <option value="From surfing">Just surf on in</option>";
          <option value="From Facebook">From your Facebook</option>";
          <option value="From ads">I clicked an ad</option>";
        </select>
  <br>
  I like your: <br>
  <input id="frontpage" type="checkbox" name="frontpage" value="frontpage">
  <label for="frontpage">FrontPage</label><br>
  <input id="form" type="checkbox" name="form" value="form">
  <label for="form">Form</label><br>
  <input id="userinterface" type="checkbox" name="userinterface" value="userinterface">
  <label for="userinterface">User Interface</label><br>

  Comments :<br>
  <textarea name="comment" cols="30" rows="8" required></textarea>
  <br>
  <input type="submit" name="add_form" value="Add a New Comment">
  <input type="reset">
  <br>
</form>
 
</body>
</html>