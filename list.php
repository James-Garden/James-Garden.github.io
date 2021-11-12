<?php 
include 'header.php';
?>

<?php 
$conn = openconn();

if ($_GET['list']=='books') {
	$bookResult = getBookList($conn,$_SESSION['user_id']);
	$list_string = "";
	for($i=0; $i<count($bookResult); $i++) {
		$book_row = $bookResult[$i];
		$row_num = $i+1;
		if ($row_num % 2 === 0) {
			$row = "<tr class='list-row list-row-even'>";
		} else {
			$row = "<tr class='list-row list-row-odd'>";
		}
		$status_button = status_button($book_row['book_status'],$_GET['list']);
		$row = $row."<td class='list-number-cell list-cell'>{$row_num}</td>";
		$row = $row."<td class='list-image-cell list-cell'><img src='{$book_row['book_cover_image']}' class='list-cover-image'></td>";
		$row = $row."<td class='list-title-cell list-cell'>{$book_row['book_title']}</td>";
		$row = $row."<td class='list-score-cell list-cell'>{$book_row['book_rating']}</td>";
		$row = $row."<td class='list-chapters-read-cell list-cell'>{$book_row['chapters_read']}</td>";
		$row = $row."<td class='list-status-cell list-cell'>{$status_button}</td>";
		$row = $row."<td class='list-notes-cell list-cell'><button type='button' class='btn btn-info'><i class='bi bi-chat-left-text'></i></button></td>";
		$row = $row."</tr>";
		$list_string = $list_string . $row;
	}
	$extra_columns = "<th colspan='1' class='list-header-chapters-read list-header'>Chapters Read</th>";
} elseif ($_GET['list']=='tv') {
	$tvResult = getTvList($conn,$_SESSION['user_id']);
	$list_string = "";
	for($i=0; $i<count($tvResult); $i++) {
		$tv_row = $tvResult[$i];
		$row_num = $i+1;
		if ($row_num % 2 === 0) {
			$row = "<tr class='list-row list-row-even'>";
		} else {
			$row = "<tr class='list-row list-row-odd'>";
		}
		$status_button = status_button($tv_row['tv_status'],$_GET['list']);
		$row = $row."<td class='list-number-cell list-cell'>{$row_num}</td>";
		$row = $row."<td class='list-image-cell list-cell'><img src='{$tv_row['tv_cover_image']}' class='list-cover-image'></td>";
		$row = $row."<td class='list-title-cell list-cell'>{$tv_row['tv_title']}</td>";
		$row = $row."<td class='list-score-cell list-cell'>{$tv_row['tv_rating']}</td>";
		$row = $row."<td class='list-chapters-read-cell list-cell'>{$tv_row['eps_watched']}</td>";
		$row = $row."<td class='list-status-cell list-cell'>{$status_button}</td>";
		$row = $row."<td class='list-notes-cell list-cell'><button type='button' class='btn btn-info'><i class='bi bi-chat-left-text'></i></button></td>";
		$row = $row."</tr>";
		$list_string = $list_string . $row;
	}
	$extra_columns = "<th colspan='1' class='list-header-chapters-read list-header'>Episodes Watched</th>";
} elseif ($_GET['list']=='films') {
	$filmResult = getfilmList($conn,$_SESSION['user_id']);
	$list_string = "";
	for($i=0; $i<count($filmResult); $i++) {
		$film_row = $filmResult[$i];
		$row_num = $i+1;
		if ($row_num % 2 === 0) {
			$row = "<tr class='list-row list-row-even'>";
		} else {
			$row = "<tr class='list-row list-row-odd'>";
		}
		$status_button = status_button($film_row['film_status'],$_GET['list']);
		$row = $row."<td class='list-number-cell list-cell'>{$row_num}</td>";
		$row = $row."<td class='list-image-cell list-cell'><img src='{$film_row['film_cover_image']}' class='list-cover-image'></td>";
		$row = $row."<td class='list-title-cell list-cell'>{$film_row['film_title']}</td>";
		$row = $row."<td class='list-score-cell list-cell'>{$film_row['film_rating']}</td>";
		$row = $row."<td class='list-chapters-read-cell list-cell'>{$film_row['eps_watched']}</td>";
		$row = $row."<td class='list-status-cell list-cell'>{$status_button}</td>";
		$row = $row."<td class='list-notes-cell list-cell'><button type='button' class='btn btn-info'><i class='bi bi-chat-left-text'></i></button></td>";
		$row = $row."</tr>";
		$list_string = $list_string . $row;
	}
	$extra_columns = "<th colspan='1' class='list-header-chapters-read list-header'>Episodes Watched</th>";
} else {
	$list_string = "<td colspan='2' class='error-message'>Error, invalid list</td><td colspan='4'><a href='profile.php'><button type='button' class='btn btn-warning'>Return to your profile</button></a></td>";
}

$conn->close();
?>

<div class="list-wrapper">
	<table class="list-table">
		<thead>
			<tr>
				<th colspan='1' class='list-header-number list-header'>#</th>
				<th colspan='1' class='list-header-image list-header'>Image</th>
				<th colspan='1' class='list-header-title list-header'>Title</th>
				<th colspan='1' class='list-header-score list-header'>Score</th>
				<?php
				echo $extra_columns;
				?>
				<th colspan='1' class='list-header-status list-header'>Status</th>
				<th colspan='1' class='list-header-notes list-header'>Notes</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			echo $list_string;
			?>
		</tbody>
	</table>
</div>

<?php
include 'footer.php'
?>