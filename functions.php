<?php
function checkenv() {
  $whitelist = array('127.0.0.1','::1');
  if(in_array($_SERVER['REMOTE_ADDR'],$whitelist)) { //Checks if user is in development environment
    return true;
  } else {
    return false;
  }
}

require_once 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
$s3 = new Aws\S3\S3Client([
  'version' => 'latest',
  'region' => 'eu-west-2'
]);

session_start();

function openconn() {
  if(checkenv()) { //Checks if user is in development environment
    $conn = new mysqli("localhost","root","C1aran!183","mml",3306); //Attempts to connect to MySQL database
  } else {
    $conn = new mysqli("mml.cpzqthyuc4xm.eu-west-2.rds.amazonaws.com","admin","2cqX4g9DYwEzHXzyDdVx","mml",3306); //Attempts to connect to MySQL database
  }
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}

function isAdmin() {
  $conn = openconn();
  try {

    if (empty($_SESSION['user_id'])){
      throw new Exception("Not signed in!");
    }
    $this_user_id = $_SESSION['user_id'];
    $stmt = "SELECT admin_id FROM admin WHERE admin_id =" . $this_user_id;
    $query = $conn->prepare($stmt);
    $query->execute();
    $query->store_result();
    $query->bind_result($admin_query);
    $query->fetch();
    $result = $admin_query;
    if (empty($result)) {
      throw new Exception("User not authorised!");
    }
  }
  catch(Exception $e) {
    $conn->close();
    return false;
  }
  $conn->close();
  return true;
}

function invoke401() {
  header('HTTP/1.0 401 Unauthorized');
  echo "<h1>Error 401: Access Denied</h1>";
  echo "<div><a href=\"index.php\">Take me back!</a></div>";

  die();
}

function addToListBtn($mediaId) {
  //This function returns the correct button depending on whether a user has an item in their list or not
  //TODO add checks for if already on list
  $btn = "<button type='button' class='btn btn-link addToList' id=m{$mediaId}>Add</button>";
  return $btn;
}

function updateLastOnline($conn,$user_id) {
  //This function sets the last time a user was online to the current time and date
  //UPDATE user SET last_online=now() WHERE user_id=?;
  $query = $conn->prepare("UPDATE user SET last_online=now() WHERE user_id=?");
  $query->bind_param("i",$user_id);
  $query->execute();
}

function status_button($status,$list) {
  if ($list == 'books') {
    if (empty($status) || $status=='in_progress') {
      return "<button type='button' class='btn btn-success status-button'>Reading</button>";
    } elseif($status == 'complete') {
      return "<button type='button' class='btn btn-primary status-button'>Completed</button>";
    } elseif($status == 'dropped') {
      return "<button type='button' class='btn btn-danger status-button'>Dropped</button>";
    } elseif($status == 'planned') {
      return "<button type='button' class='btn btn-secondary status-button'>Plan to Read</button>";
    } elseif($status == 'on_hold') {
      return "<button type='button' class='btn btn-warning status-button'>On Hold</button>";
    }
  } else {
    if (empty($status) || $status=='in_progress') {
      return "<button type='button' class='btn btn-success status-button'>Watching</button>";
    } elseif($status == 'complete') {
      return "<button type='button' class='btn btn-primary status-button'>Completed</button>";
    } elseif($status == 'dropped') {
      return "<button type='button' class='btn btn-danger status-button'>Dropped</button>";
    } elseif($status == 'planned') {
      return "<button type='button' class='btn btn-secondary status-button'>Plan to Watch</button>";
    } elseif($status == 'on_hold') {
      return "<button type='button' class='btn btn-warning status-button'>On Hold</button>";
    }
  }
}

function getBookList($conn,$user_id) {
  //Returns a users book list
  $query = $conn->prepare("SELECT ul.media_id,m.name,ul.rating,ul.status,ul.notes,ubl.chapters_read,m.cover_image
 FROM ((user_list_entry ul 
 INNER JOIN user_book_list_entry ubl ON ul.entry_id=ubl.entry_id) 
 INNER JOIN media m ON ul.media_id=m.media_id) 
 WHERE user_id=(?);");
  $query->bind_param("i",$user_id);
  $query->execute();
  $query->store_result();
  $row_count = $query->num_rows;
  $query->bind_result($book_id,$book_title,$book_rating,$book_status,$book_notes,$chapters_read,$book_cover_image);
  $book_list = array();
  while ($query->fetch()) {
    $book_list[] = array(
      "book_id" => $book_id,
      "book_title" => $book_title,
      "book_rating" => $book_rating,
      "book_status" => $book_status,
      "book_notes" => $book_notes,
      "chapters_read" => $chapters_read,
      "book_cover_image" => $book_cover_image,
    );
  }
  return $book_list;
}

function getFilmList($conn,$user_id) {
  //Returns a users film list
  $query = $conn->prepare("SELECT ul.media_id,m.name,ul.rating,ul.status,ul.notes,m.cover_image
 FROM ((user_list_entry ul 
 INNER JOIN user_film_list_entry ufl ON ul.entry_id=ufl.entry_id) 
 INNER JOIN media m ON ul.media_id=m.media_id) 
 WHERE user_id=(?);");
  $query->bind_param("i",$user_id);
  $query->execute();
  $query->store_result();
  $row_count = $query->num_rows;
  $query->bind_result($film_id,$film_title,$film_rating,$film_status,$film_notes,$film_cover_image);
  $film_list = array();
  while ($query->fetch()) {
    $film_list[] = array(
      "film_id" => $film_id,
      "film_title" => $film_title,
      "film_rating" => $film_rating,
      "film_status" => $film_status,
      "film_notes" => $film_notes,
      "film_cover_image" => $film_cover_image,
    );
  }
  return $film_list;
}

function getTvList($conn,$user_id) {
  //Returns a users tv list
  $query = $conn->prepare("SELECT ul.media_id,m.name,ul.rating,ul.status,ul.notes,utl.eps_watched,m.cover_image
 FROM ((user_list_entry ul 
 INNER JOIN user_tv_list_entry utl ON ul.entry_id=utl.entry_id) 
 INNER JOIN media m ON ul.media_id=m.media_id) 
 WHERE user_id=(?);");
  $query->bind_param("i",$user_id);
  $query->execute();
  $query->store_result();
  $row_count = $query->num_rows;
  $query->bind_result($tv_id,$tv_title,$tv_rating,$tv_status,$tv_notes,$eps_watched,$tv_cover_image);
  $tv_list = array();
  while ($query->fetch()) {
    $tv_list[] = array(
      "tv_id" => $tv_id,
      "tv_title" => $tv_title,
      "tv_rating" => $tv_rating,
      "tv_status" => $tv_status,
      "tv_notes" => $tv_notes,
      "eps_watched" => $eps_watched,
      "tv_cover_image" => $tv_cover_image,
    );
  }
  return $tv_list;
}