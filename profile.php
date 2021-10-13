<?php include 'header.php';?>

<?php
$conn = new mysqli("mml.cpzqthyuc4xm.eu-west-2.rds.amazonaws.com","admin","2cqX4g9DYwEzHXzyDdVx","mml",3306);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = "SELECT * FROM user WHERE user_id={$_SESSION['user_id']}";
$query = $conn->prepare($stmt);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_row();
$username = $row[1];
$avatar = $row[10];

if (empty($row[4])) {
	$last_online = "<p style='margin-left:auto;color:lightGreen;'>Now</p>";
} else {
	$last_date = new DateTime($row[4], new DateTimeZone('Europe/London'));
	$now_date = new DateTime("now", new DateTimeZone('Europe/London'));
	$interval = $last_date->diff($now_date);
	if(!empty($interval->y)){
		if ($interval->y==1){
			$last_online="Last year";
		} else {
			$last_online=$interval->y." years ago";
		}
	} elseif (!empty($interval->m)) {
		if ($interval->m==1){
			$last_online="Last month";
		} else {
			$last_online=$interval->m." months ago";
		}
	} elseif (!empty($interval->d)) {
		if ($interval->d==1){
			$last_online="Yesterday";
		} else {
			$last_online=$interval->d." days ago";
		}
	} elseif (!empty($interval->h)) {
		if ($interval->h==1){
			$last_online="1 hour ago";
		} else {
			$last_online=$interval->h." hours ago";
		}
	} elseif (!empty($interval->i)) {
		if ($interval->i==1){
			$last_online="A minute ago";
		} else {
			$last_online=$interval->i." minutes ago";
		}
	} else {
		$last_online=$interval->s." seconds ago";
	}
	$last_online = "<p style='margin-left:auto;'>{$last_online}</p>";
}

$date = new DateTime($row[3]);
$date_joined = $date->format('M d, Y');


?>

<div class="username">
	<?php echo "<h2>{$username}'s Profile</h2>"; ?>
</div>
<div class="profile-wrapper">
	<div class="profile-left-col">
		<div class="avatar"> 
			<?php echo "<img src='avatars/{$avatar}' id='avatar'>";?>
		</div>
		<div class="user-info"> 
			<?php 
			echo "<div class='info-box'><p>Last Online</p>";
			echo "{$last_online}</div>";
			echo "<div class='info-box'><p>Date Joined</p>";
			echo "<p style='margin-left:auto;'>{$date_joined}</p></div>";
			?>
		</div>
	</div>
	<div class="profile-inner-wrapper">
		<div class="profile-mid-col">
			<p>summary section here</p>
		</div>
		<div class="profile-right-col">
			<p>update section here</p>
		</div>
		<div class="profile-favourites">
			<p>favourites section here</p>
		</div>

	</div>
</div>

<?php include 'footer.php';?>
