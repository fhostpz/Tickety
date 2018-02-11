<?php
  //Get the input email and password from the login page.
  $userName    = $_POST["name"];
  $userPassword = $_POST["password"];
  $userGender = $_POST["gender"];
  $userEmail = $_POST["email"];
  $userConfirmPass = $_POST["confirm_password"];
  
  if(($userPassword!=$userConfirmPass))
  {
	  header("Location: http://localhost/tickety/SignUp.html");
  }
  
  $link=mysqli_connect("localhost","root","");
	if(!$link){
		die("could not connect:".mysqli_connect_error());
	}
	else{
		echo "Successfully connected to localhost.<br>";
	}
	
	//select db
	$db_selected=mysqli_select_db($link,"tickety");
	
	//insert data
	$sql="INSERT INTO member(name, gender, email, password )VALUES('$_POST[name]','$_POST[gender]','$_POST[email]','$_POST[password]')";
	if($userPassword==$userConfirmPass){
		header("Location: http://localhost/tickety/MainPage.html");
	}
	else{ echo "Error inserting data into table".mysqli_error($link)."<br>";}
	
 
 
 
?>