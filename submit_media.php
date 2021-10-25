<?php
  require('functions.php');
  $conn = openconn();

  $types = array("book","film","tv_series"); //Sets the accepted types of media
  try {
    //Checks if a media type is set, if not throw an error and stop
    if (!in_array($_POST['media_type'],$types)) {
      throw new Exception("Error in media type");
    }
    //Code for inserting media record
    $query = $conn->prepare("INSERT INTO media (name,rating,cover_image,description,media_type) VALUES (?,?,?,?,?)");
    $query->bind_param("sdsss",$name,$rating,$cover,$description,$media_type);
    $media_type = $_POST['media_type'];
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
        $query = $conn->prepare("INSERT INTO film (film_id,runtime,release_date) VALUES (?,?,?)");
        $query->bind_param("iis",$film_id,$film_length,$release_date);
        $film_id = $this_media_id;
        $film_length = $_POST['runtime'];
        $release_date = $_POST['release_date_film'];
        $query->execute();
        break;
      case "tv_series":
        $query = $conn->prepare("INSERT INTO tv (tv_id,episode_count,first_aired,finished_airing) VALUES (?,?,?,?)");
        $query->bind_param("iiss",$tv_id,$episode_count,$first_aired,$finished_airing);
        $tv_id = $this_media_id;
        $episode_count = $_POST['episode_count'];
        $first_aired = $_POST['first_aired'];
        $finished_airing = $_POST['last_aired'];
        $query->execute();
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
  <meta http-equiv="refresh" content="0; url=index.php" />
</head>
<body>
  <h3>You should be redirected shortly</h3>
  <p>If not, click <a href="index.php">here</a></p>
</body>
