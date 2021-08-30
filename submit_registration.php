<?php
  $conn = new mysqli("127.0.0.1","root","C1aran!183","mml",3306); //Attempts to connect to MySQL database

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //TODO add validation to all registration inputs

  try {
    $query = $conn->prepare("INSERT INTO user (username,dob,date_joined,email,password,forename,surname,phone) VALUES (?,?,CURDATE(),?,?,?,?,?)");
    $query->bind_param("ssssssi",$username,$dob,$email,$hashed_password,$forename,$surname,$phone);

    $username = $_POST['reg-username'];
    $dob = $_POST['reg-dob'];
    $email = $_POST['reg-email'];
    //Hashing password for security
    $input_password = $_POST['reg-password'];
    $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);
    var_dump($hashed_password);
    $forename = $_POST['reg-fname'];
    $surname = $_POST['reg-lname'];
    $phone = $_POST['reg-tel'];
    $query->execute();

  }
  catch (Exception $e) {
    echo "An error has occurred, this incident will be reported automatically.";
    die("Error message: " . $e->getMessage());
  }
  $query->close();
  $conn->close();
?>

<!DOCTYPE html>
<head>
  <title>Redirect</title>
  <meta http-equiv="refresh" content="0; url=login.php" />
</head>
<body>
  <h3>You should be redirected shortly</h3>
  <p>If not, click <a href="index.php">here</a></p>
</body>
