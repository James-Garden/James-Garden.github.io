<?php

function isAdmin() {
  $admin_conn = new mysqli("mml.cpzqthyuc4xm.eu-west-2.rds.amazonaws.com","admin","2cqX4g9DYwEzHXzyDdVx","mml",3306); //Attempts to connect to MySQL database

  if ($admin_conn->connect_error) {
    die("Connection failed: " . $admin_conn->connect_error);
  }
  session_start();
  try {

    if (empty($_SESSION['user_id'])){
      throw new Exception("Not signed in!");
    }
    $this_user_id = $_SESSION['user_id'];
    $stmt = "SELECT admin_id FROM admin WHERE admin_id =" . $this_user_id;
    $query = $admin_conn->prepare($stmt);
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
    $admin_conn->close();
    return false;
  }
  $admin_conn->close();
  return true;
}

function invoke401() {
  header('HTTP/1.0 401 Unauthorized');
  echo "<h1>Error 401: Access Denied</h1>";
  echo "<div><a href=\"index.php\">Take me back!</a></div>";

  die();
}

?>
