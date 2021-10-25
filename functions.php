<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;

use Aws\Exception\AwsException;
?>

<?php
session_start();

$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region' => 'eu-west-2'
]);

function openconn() {
  $whitelist = array('127.0.0.1','::1');
  if(in_array($_SERVER['REMOTE_ADDR'],$whitelist)) { //Checks if user is in development environment
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

?>
