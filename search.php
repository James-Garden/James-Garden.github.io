<?php include('header.php');?>

<?php
$conn = openconn();

$query = $conn->prepare("SELECT * FROM media WHERE name LIKE ? LIMIT 100");
$query->bind_param("s",$input);
$input = "%".$_GET['q']."%";
$query->execute();
$result = $query->get_result();
if (mysqli_num_rows($result)==0) {
  echo"<p>Sorry, your search for '<i>{$_GET['q']}</i>' returned no results</p>";
}
echo "<table class='search-results'><tbody>";
while ($row = $result->fetch_array(MYSQLI_NUM)) {
  $score = number_format($row[2],1);
  if (empty($row[5])) {
    $members = 0;
  } else {
    $members = $row[5];
  }
  if ($row[8]=='tv_series') {
    $title = "<i class='bi bi-tv'> </i>".$row[1];
  } elseif ($row[8]=='film') {
    $title = "<i class='bi bi-film'> </i>".$row[1];
  } elseif ($row[8]=='book') {
    $title = "<i class='bi bi-book'> </i>".$row[1];
  } else {
    $title = "<i class='bi bi-question-circle'> </i>".$row[1];
  }
  $btn = addToListBtn($row[0]);

  echo "
<tr class='search-result'>
  <td class='search-cover-col'><img src='{$row[3]}' class='search-cover'></td>
  <td class='search-info-col'>
    <table class='search-info-table'>
      <tbody class='search-info-body'>
        <tr class='search-info-header'>
          <td colspan='1' class='search-info-cell'>{$title}</td>
          <td colspan='1' class='search-info-cell'><i class='bi bi-star'> </i>{$score}</td>
          <td colspan='1' class='search-info-cell'><i class='bi bi-person'> </i>{$members}</td>
          <td colspan='1' class='search-info-cell'>{$btn}</td>
        </tr>
        <tr class='search-info-description'>
          <td colspan='4' class='search-description'>{$row[4]}</td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
";
}
echo "</tbody></table>";


$conn->close();
?>

<?php include('footer.php');?>
