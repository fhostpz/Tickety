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


  $sql = "INSERT INTO eventpage(e_name, e_loc, e_region,startDatetime,endDatetime,  e_dscp) VALUES ( '$_POST[event]' , '$_POST[location]' ,  '$_POST[region]' , '$_POST[start_datetime]', '$_POST[end_datetime]',   '$_POST[description]' )";

  mysqli_query($link, $sql); 

  header("Location: http://localhost/event/eventpage.html");

    
?>