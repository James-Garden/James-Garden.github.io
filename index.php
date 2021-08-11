<?php
$mysqli = new mysqli("127.0.0.1","php","peanuts","mml",3306);
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
  <meta charset="UTF-8">
  <title>My Media List</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="script.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
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
        <a href = "index.php"><button class="button-logo">
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
        <input type="search" name="userquery" placeholder="SEARCH..." class="search-input"><br>
      </form>
    </div>
  </div>
  <!--This is the main page content-->
  <main>
    <h1>test header</h1>
    <?php
      $result = $mysqli->query("SELECT * FROM media LIMIT 3");
      foreach ($result as $row) {
        echo "Title: " . $row['name'] . "\n";
        echo "<img src=\"cover_images/" . $row['cover_image'] . "\" width=\"259\" height=\"384\">\n";
      }
     ?>
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
