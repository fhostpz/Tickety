<?php
	session_start();
	
	$eventID = $_POST['eventID'];
	$sql = "SELECT userID FROM events WHERE eventID = $eventID";
	
	$server   = "localhost";
	$user     = "root";
	$password = "";
	$database = "tickety";

	$link = mysqli_connect($server, $user, $password, $database);
	
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_assoc($query);
	
	$_SESSION["organiserID"] = $result['userID'];
	
	header("Location: chat.html");
?>