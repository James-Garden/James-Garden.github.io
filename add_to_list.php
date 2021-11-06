<?php 
require 'functions.php';

if ($_SESSION['loggedIn']) {
	try{
		//Checks if the media id is set in the URL
		if(!isset($_GET['media_id'])) {
			throw new Exception("No media id to add!");
		}
		$media_id = (integer)$_GET['media_id'];

		$conn = openconn();
		//Checks if the input is a real media id
		$query = $conn->prepare("SELECT media_id FROM media WHERE media_id=?");
		$query->bind_param("i",$media_id);
		$query->execute();
		$result = $query->get_result();
		if(!(mysqli_num_rows($result)==1)) {
			throw new Exception("Media ID not found!");
		}
		$query->close();
		//Checks if the item is already in the users list
		$query = $conn->prepare("SELECT media_id FROM user_list_entry WHERE (media_id=? AND user_id=?)");
		$query->bind_param("ii",$media_id,$_SESSION['user_id']);
		$query->execute();
		$result = $query->get_result();
		if(mysqli_num_rows($result)==1) {
			throw new Exception("Media already in list!");
		}
		$query->close();
		//If all checks pass, add it to the list
		$query = $conn->prepare("INSERT INTO user_list_entry (user_id,media_id) VALUES (?,?)");
		$query->bind_param("ii",$_SESSION['user_id'],$media_id);
		$query->execute();
		$conn->close();
		header("Location: list.php");
	} catch(Exception $e) {
		die("Error: ".$e->getMessage());
	}

	
} else {
	header("Location: login.php?msg=You+must+be+logged+in+to+add+an+item+to+your+list");
}
?>