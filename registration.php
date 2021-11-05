<?php include 'header.php'?>

<h1>Create a New Account</h1>
<form class="register-form" action="submit_registration.php" method="post">
  <p>Username</p>
  <input type="text" name="reg-username" placeholder="Username" required><br>
  <p>Email</p>
  <input type="email" name="reg-email" placeholder="example@example.com" required><br>
  <p>First Name</p>
  <input type="text" name="reg-fname" placeholder="First Name" required><br>
  <p>Last Name</p>
  <input type="text" name="reg-lname" placeholder="Last Name" required><br>
  <p>Password</p>
  <input type="password" name="reg-password" placeholder="Password" required><br>
  <p>Date of Birth</p>
  <input type="date" name="reg-dob"><br>
  <p>Phone Number</p>
  <input type="tel" name="reg-tel" placeholder="Phone Number" required><br>
  <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
  <div class="h-captcha" data-sitekey="a7576f7e-ff2b-47d3-8204-3e4b6afb5c16"></div><br>
  <br>
  <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="login.php">Click here!</a></p>

<?php include 'footer.php'?>
