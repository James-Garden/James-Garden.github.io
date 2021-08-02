<!DOCTYPE html>
<html lang="en-GB">
<head>
  <meta charset="UTF-8">
  <title>My Media List</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="script.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
  <!--This is the side menu-->
  <div class="sidenav" id="sidenav">
    <div class="sidenav-flex">
      <button class="button-close-side-menu">
        <i class="bi bi-x"></i>
      </button><br>
    </div>
    <div class="side-menu-links">
      <button class="button-link" id="test-1">
        <a href="#"><i class="bi bi-film"></i> Films</a>
      </button><br>
      <button class="button-link" id="test-2">
        <a href="#"><i class="bi bi-tv"></i> TV</a>
      </button><br>
      <button class="button-link" id="test-3">
        <a href="#"><i class="bi bi-book"></i> Books</a>
      </button><br>
    </div>
  </div>
  <!--This is the header-->
  <header>
    <div class="header-wrapper">
      <div class="header-flex-left">
        <button class="button-menu">
          <i class="bi bi-list"></i>
        </button>
      </div>
      <div class="header-flex-logo">
        <a href = "index.html"><button class="button-logo">
          <i class="bi bi-collection"></i>
        </button></a>
      </div>
      <div class="header-flex-right">
        <a href="#"><button class="button-profile">
          <i class="bi bi-person-circle"></i>
        </button></a>
        <button class="button-search">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </header>
  <!--This is the search bar-->
  <div class="search-bar">
    <div class="search-wrapper">
      <form class="search-form">
        <label for="user-query">
          <i class="bi bi-search"></i>
        </label>
        <input type="text" name="userquery" placeholder="SEARCH..." class="search-input"><br>
      </form>
    </div>
  </div>
  <!--This is the main page content-->
  <main>
    <h1>Create a New Account</h1>
    <form class="register-form" action="index.php" method="post">
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
      <br>
      <button type="submit">Sign Up</button>
    </form>

  </main>
  <!--This is the footer-->
  <footer>
    <div class="footer-wrapper">
      <div class="footer-copy">
        <p class>&copyJames Garden 2020</p>
      </div>
    </div>
  </footer>
</body>
</html>
