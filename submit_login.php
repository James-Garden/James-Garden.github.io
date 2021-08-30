<?php
  $conn = new mysqli("127.0.0.1","root","C1aran!183","mml",3306); //Attempts to connect to MySQL database

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  try {
    $get_password = $conn->prepare("SELECT password FROM user WHERE username = ?");
    $get_password->bind_param("s",$username);
    $username = $_POST['username'];
    $get_password->execute();
    $get_password->store_result();
    $get_password->bind_result($password_query);
    $get_password->fetch();
    $stored_password = $password_query;
    if (!$stored_password) { //If user not found
      header("Location: login.php?userNotFound=true");
      die();
    }
    if(password_verify($_POST['password'],$stored_password)) {
      echo "Correct password!";
    } else { //If password incorrect
      header("Location: login.php?incorrectPassword=true");
      die();
    }
  }
  catch (Exception $e) {
    echo "An error has occurred, this incident will be reported automatically.";
    die("Error message: " . $e->getMessage());
  }
  $get_password->close();
  $conn->close();
?>

<!DOCTYPE html>
<head>
  <title>Redirect</title>
  <meta http-equiv="refresh" content="0; url=index.php" />
</head>
<body>
  <h3>You should be redirected shortly</h3>
  <p>If not, click <a href="index.php">here</a></p>
</body>
