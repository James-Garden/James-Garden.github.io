<?php
  require('functions.php');
  $conn = openconn(); //Attempts to connect to MySQL database

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //hCaptcha validation

  $data = array(
    'secret' => "0x602C0B4232c65FBAC3fB2Ab4e972d4408E261133",
    'response' => $_POST['h-captcha-response']
  );
  $verify = curl_init();
  curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
  curl_setopt($verify, CURLOPT_POST, true);
  curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($verify);

  // var_dump($response);

  $responseData = json_decode($response);
  if(!($responseData->success)) {
      die("Error: invalid hCaptcha response");
  }

  //end of hCaptcha validation

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
