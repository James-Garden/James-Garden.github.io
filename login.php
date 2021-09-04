<?php include 'header.php'?>

<h1>Log In</h1>
<form class="login-form" action="submit_login.php" method="post">
  <p>Username</p>
  <input type="text" name="username" placeholder="Username" required><br>
  <p>Password</p>
  <input type="password" name="password" placeholder="Password" required><br>
  <br>
  <?php
  if ($_GET['userNotFound']) {
    echo "<p style=\"color:red\">User not found!</p>";
  } elseif ($_GET['incorrectPassword']) {
    echo "<p style=\"color:red\">Incorrect password!</p>";
  }
   ?>
  <button type="submit">Log In</button>
</form>

<p>Don't have an account? <a href="registration.php">Click here!</a></p>
<?php include 'footer.php'?>
