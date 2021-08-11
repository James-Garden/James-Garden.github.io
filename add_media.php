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
    <h1>Add Media</h1>

     <form class="mysql-input" method="post" action="submit_media.php">
       <p>Name</p>
       <input type="text" name="media_name" placeholder="Name" maxlength="80" required><br>
       <p>Rating</p>
       <input type="text" name="media_rating" placeholder="9.6" inputmode="decimal" pattern="[0-9].[0-9]"><br>
       <p>Cover Image</p>
       <input type="file" name="media_cover" required><br>
       <p>Description</p>
       <textarea name="media_desc" placeholder="Description..." maxlength="65535" rows="5" cols="50" required></textarea><br>
       <p>Media Type</p>
       <select name="media_type" id="media_type" placeholder="">
         <option disabled selected value>--Media Type--</option>
         <option value="film">Film</option>
         <option value="tv_series">TV Series</option>
         <option value="book">Book</option>
       </select>
       <script>

       </script>
       <div id="book_form" style="display:none;">
         <p>Number of Chapters</p>
         <input type="number" name="chapter_number"><br>
         <p>initial Release Date</p>
         <input type="date" name="release_date_book"><br>
       </div>
       <div id="film_form" style="display:none;">
         <p>Runtime (Minutes)</p>
         <input type="number" name="runtime"><br>
         <p>Initial Release Date</p>
         <input type="date" name="release_date_film"><br>
       </div>
       <div id="tv_form" style="display:none;">
         <p>Number of Episodes</p>
         <input type="number" name="episode_count"><br>
         <p>First Episode Aired</p>
         <input type="date" name="first_aired"><br>
         <p>Last Episode Aired</p>
         <input type="date" name="last_aired"><br>
       </div>
       <br><br>
       <button type="submit">Submit</button>
     </form>
     <?php
       //$input = $mysqli->query("");
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
