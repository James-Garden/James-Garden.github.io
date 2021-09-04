<?php include 'header.php';?>

<?php
echo "<span>Username: ".  $_SESSION['username']."</span><br>";
if (empty($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<button id="logout-button">Log Out</button>

<?php include 'footer.php';?>
