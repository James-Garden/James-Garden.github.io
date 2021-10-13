<?php include 'header.php'?>

<?php $mysqli = new mysqli("mml.cpzqthyuc4xm.eu-west-2.rds.amazonaws.com","admin","2cqX4g9DYwEzHXzyDdVx","mml",3306); ?>
<h1>Welcome to MyMediaList!</h1>
<table style="margin-left:auto;margin-right:auto;width:95%;">
  <tbody>
    <tr>
      <td style="width:33.33%">
        <?php
          $result = $mysqli->query("SELECT media.cover_image,media.name,media.description FROM media INNER JOIN book ON media.media_id = book.book_id ORDER BY RAND() LIMIT 2;");
          foreach ($result as $row) {
            echo "<table><td><img src=\"cover_images/" . $row['cover_image'] . "\" width=\"259\" height=\"384\"></td>";
            echo "<td><h2>" . $row['name'] ."</h2>";
            echo "<p>".$row['description']."</p></td></table>";
          }
        ?>
      </td>
      <td style="width:33.33%">
        <?php
          $result = $mysqli->query("SELECT media.cover_image,media.name,media.description FROM media INNER JOIN film ON media.media_id = film.film_id ORDER BY RAND() LIMIT 2;");
          foreach ($result as $row) {
            echo "<table><td><img src=\"cover_images/" . $row['cover_image'] . "\" width=\"259\" height=\"384\"></td>";
            echo "<td><h2>" . $row['name'] ."</h2>";
            echo "<p>".$row['description']."</p></td></table>";
          }
        ?>
      </td>
      <td style="width:33.33%">
        <?php
          $result = $mysqli->query("SELECT media.cover_image,media.name,media.description FROM media INNER JOIN tv ON media.media_id = tv.tv_id ORDER BY RAND() LIMIT 2;");
          foreach ($result as $row) {
            echo "<table><td><img src=\"cover_images/" . $row['cover_image'] . "\" width=\"259\" height=\"384\"></td>";
            echo "<td><h2>" . $row['name'] ."</h2>";
            echo "<p>".$row['description']."</p></td></table>";
          }
        ?>
      </td>
    </tr>
  </tbody>
</table>

<?php include 'footer.php'?>
