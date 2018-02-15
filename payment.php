<?php
	session_start();
?>

<?php
	if(!isset($_SESSION['userID'])) {
		header("location:login.html");
		exit();
	}
	
	$link = mysqli_connect("localhost", "root", "");
	if(!$link) {
		die("Could not connect: ".mysqli_connect_error());
	}
	else {
		// echo "Successfully connected to localhost.<br>";
	}
	
	//selecting database
	$db_selected = mysqli_select_db($link, "tickety");
	if(!$db_selected) {
		$sql = "CREATE DATABASE tickety";
		mysqli_query($link, $sql);
		$db_selected = mysqli_select_db($link,"tickety");
		if($db_selected)
			echo "Selected tickety database. <br>";
	}
	else {
		//echo "Selected my_db e database. <br>";
	}
	
	$userID = $_SESSION['userID'];
	$eventID = $_POST['eventID'];
	$noOfTickets = $_POST['numTickets'];
	
	$query = "INSERT INTO participants_list (userID, eventID, noOfTickets) VALUES ($userID, $eventID, $noOfTickets)";
	// $result = mysqli_query($link, $query);
	if (mysqli_query($link, $query)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($link);
	}
	header("location:main.php");
	exit();
?>