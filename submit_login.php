<?php
  require('functions.php');
  $conn = openconn();

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
      $get_id = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
      $get_id->bind_param("s",$username);
      $username = $_POST['username'];
      $get_id->execute();
      $get_id->store_result();
      $get_id->bind_result($id_query);
      $get_id->fetch();
      $stored_id = $id_query;
      $_SESSION['user_id'] = $id_query;
      $_SESSION['username'] = $username;
      $_SESSION['loggedIn'] = true;
      updateLastOnline($conn,$_SESSION['user_id']);
      $conn->close();
      header("Location: profile.php");
    } else { //If password incorrect
      header("Location: login.php?incorrectPassword=true");
      die();
    }
  }
  catch (Exception $e) {
    echo "An error has occurred, this incident will be reported automatically.";
    die("Error message: " . $e->getMessage());
  }
  $conn->close();
?>

<!DOCTYPE html>
<head>
  <title>Redirect</title>
</head>
<body>
  <h3>You should be redirected shortly</h3>
  <p>If not, click <a href="index.php">here</a></p>
</body>
