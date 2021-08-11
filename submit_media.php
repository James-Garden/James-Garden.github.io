<?php
  $conn = new mysqli("127.0.0.1","root","C1aran!183","mml",3306); //Attempts to connect to MySQL database

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $types = array("book","film","tv_series"); //Sets the accepted types of media

  try {
    //Checks if a media type is set, if not throw an error and stop
    if (!in_array($_POST['media_type'],$types)) {
      throw new Exception("Error in media type");
    }
    //Code for inserting media record
    $query = $conn->prepare("INSERT INTO media (name,rating,cover_image,description) VALUES (?,?,?,?)");
    $query->bind_param("sdss",$name,$rating,$cover,$description);
    $name = $_POST['media_name'];
    $rating = $_POST['media_rating'];
    $cover = $_POST['media_cover'];
    $description = $_POST['media_desc'];
    $query->execute();

    $get_media_id = $conn->query("SELECT LAST_INSERT_ID();");
    $row = $get_media_id->fetch_row();
    $this_media_id = $row[0] ?? false;

    switch ($_POST['media_type']) { //Is the media  a book, film or tv series
      case "book": //If it's a book, add a record to the book table
        $query = $conn->prepare("INSERT INTO book (book_id,chapter_number,release_date) VALUES (?,?,?)");
        $query->bind_param("iis",$book_id,$chapter_number,$release_date);
        $book_id = $this_media_id;
        $chapter_number = $_POST['chapter_number'];
        $release_date=$_POST['release_date_book'];
        $query->execute();
        break;
      case "film":
        break;
      case "tv_series":
        break;
    }
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
  <!--<meta http-equiv="refresh" content="0; url=index.php" />-->
</head>
<body>
  <h3>You should be redirected shortly</h3>
  <p>If not, click <a href="index.php">here</a></p>
</body>