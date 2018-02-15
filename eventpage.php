<?php
	session_start();
	// $_SESSION['userID'] = "1";
?>

<?php
	if(!isset($_SESSION['userID'])) {
		header("location:login.html");
		exit();
	}
	
	$server   = "localhost";
	$user     = "root";
	$password = "";
	$database = "tickety";

  $link = mysqli_connect($server, $user, $password);

  if(!$link) {
	die("could not connect:" . mysqli_connect_error());
  }
  else {
    echo "Successfully connected to localhost.<br>";
  }
  
  //select db
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

  $userID    		= $_SESSION['userID'];
  $eventName 		= $_POST['event_title'];
  $eventDesc 		= $_POST['event_description'];
  $eventTicketPrice = $_POST['event_price'];
  $eventDate 		= $_POST['event_date'];
  
  $sql = "INSERT INTO events(event_title, event_description, event_date, event_price, userID) VALUES ( '$eventName' , '$eventDesc' , '$eventDate', $eventTicketPrice, $userID)";
  
	if (mysqli_query($link, $sql)) {
		echo "Very Nice";
	} else {
		echo "Very Cunt";
	}

  header("Location: main.php");

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    
?>