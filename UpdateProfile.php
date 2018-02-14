<?php
	session_start();
?>

<?php
	
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
		//echo "Selected my_db database. <br>";
	}
	
	$userName = $_POST['name'];
	$email = $_POST['email'];
	$userID = $_SESSION['userID'];
	
	$query = "UPDATE user SET name='$userName', email='$email' WHERE userID=$userID";
	// $result = mysqli_query($link, $query);
	if (mysqli_query($link, $query)) {
		echo "Record updated successfully";
		header("location:User Profile.php");
		exit();
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($link);
	}
?>