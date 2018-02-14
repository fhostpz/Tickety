<?php
  //server: localhost
  //username: root
  //password: NULL
  //database: event
  //table: eventpage

  $link = mysqli_connect("localhost", "root", "");

  if(!$link) {
	die("could not connect:" . mysqli_connect_error());
  }
  else {
    echo "Successfully connected to localhost.<br>";
  }
  
  //select db
  $db_selected = mysqli_select_db($link, "event");

 $nameErr = $locErr = $startErr = $endErr = "";
  $name = $loc = $start = $end = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["event"]);
    }
    
    if (empty($_POST["email"])) {
      $locErr = "Email is required";
    } else {
      $loc = test_input($_POST["location"]);
    }
      
    if (empty($_POST["website"])) {
      $startErr = "";
    } else {
      $start = test_input($_POST["start_datetime"]);
    }

    if (empty($_POST["comment"])) {
      $endErr = "";
    } else {
      $end = test_input($_POST["start_datetime"]);
    }

  }

  else{
    $sql = "INSERT INTO eventpage(e_name, e_loc, e_country,startDatetime,endDatetime,  e_dscp) VALUES ( '$_POST[event]' , '$_POST[location]' ,  '$_POST[country]' , '$_POST[start_datetime]', '$_POST[end_datetime]',   '$_POST[description]' )";

    mysqli_query($link, $sql); 
  }

  header("Location: http://localhost/event/eventpage.html");

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    
?>