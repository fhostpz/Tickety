<?php
  //Get the input email and password from the login page (login.html).
  $user_email    = $_POST["email"];
  $user_password = $_POST["password"];
  
  //Establish a connection with the server, "localhost".
  $server   = "localhost";
  $user     = "root";
  $password = "";
  $database = "tickety";
  $link = mysqli_connect($server, $user, $password);
  
  //Establish a connection with the database, "tickety".
  //If failed, try creating the database.
  //If failed again, terminate.
  $repeat = 0;
  do {
    $db_selected = mysqli_select_db($link, $database);
  
    if (!$db_selected) {
      if ($repeat < 1) {
        $sqlcommand = "CREATE DATABASE " . $database;
        $result     = mysqli_query($link, $sqlcommand);
        $repeat++;
	  }
	  else {
        die ("Error, please contact the web administrator: ".mysqli_error($link));
      }
    }
  } while (!$db_selected);
  
  //Check for existing record.
  $sqlcommand = "SELECT * FROM user WHERE email = \"" . $user_email . "\"";
  $result     = mysqli_query($link, $sqlcommand);
  
  //Check if there is a matching row, then compare with the input if there is an existing row.
  //Otherwise, return back to the login page.
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    $verify = (($user_email == $row["email"]) && ($user_password == $row["password"]));
  }
  else {
    header("Location: http://localhost/tickety/login.html");
  }
  
  //If both email and password are a matching pair, proceed to the check page.
  //Otherwise, return to the login page.
  if ($verify)  {
    header("Location: http://localhost/tickety/main.html");
  }
  else {
    header("Location: http://localhost/tickety/login.html");
  }
?>