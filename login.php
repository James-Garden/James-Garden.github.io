<?php include 'header.php'?>

<h1>Log In</h1>
<?php
if (isset($_GET['msg'])){
  echo "<p>{$_GET['msg']}</p>";
}
?>
<form class="login-form" action="submit_login.php" method="post">
  <p>Username</p>
  <input type="text" class="form-control" name="username" placeholder="Username" required><br>
  <p>Password</p>
  <input type="password" class="form-control" name="password" placeholder="Password" required><br>
  <br>
  <?php
  //TODO check if array keys are empty using empty()
  if ($_GET['userNotFound']) {
    echo "<p style=\"color:red\">User not found!</p>";
  } elseif ($_GET['incorrectPassword']) {
    echo "<p style=\"color:red\">Incorrect password!</p>";
  }
   ?>
  <button type="submit" class="btn btn-dark">Log In</button>
</form>

<p>Don't have an account? <a href="registration.php">Click here!</a></p>
<?php include 'footer.php'?>
