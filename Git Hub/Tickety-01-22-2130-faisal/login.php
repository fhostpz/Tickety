<?php
  //Get the input email and password from the login page.
  $user_email    = $_POST["email"];
  $user_password = $_POST["password"];
  
  //Establish a connection with the database, "tickety".
  $server   = "localhost";
  $user     = "root";
  $password = "";
  $database = "tickety";
  
  $link = mysqli_connect($server, $user, $password, $database);
  
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