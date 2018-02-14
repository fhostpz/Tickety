
<html>
<head>
	<meta charset="utf-8">
		<link rel="stylesheet" href="minimal.css" type="text/css" />
		<link rel="stylesheet" href="topbar.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

	<script type="text/javascript">
    
	function check() {
       var pass1=document.getElementById("password").value;
	   var pass2=document.getElementById("confirm_password").value;
	   
        if ((pass1 == pass2)&&(pass1!=""&&pass2!="")) {
			alert("Password Correct");
        }
		if((pass1!=pass2)&&(pass1!=""&&pass2!="")){
			alert("Password not matched");
		}
     
    }
	<?php
	$link=mysqli_connect("localhost","root","");
	if(!$link){
		die("could not connect:".mysqli_connect_error());
	}
	else{
		echo "Successfully connected to localhost.<br>";
	}
	$db_selected=mysqli_select_db($link,"tickety");
	
	$query ="SELECT * FROM user WHERE email = \"".$_POST["email"]."\"";
	$result = mysqli_query($link, $query);
	$num = mysqli_num_rows($result);
	
	if(($_POST["password"]==$_POST["confirm_password"])&&($_POST["password"]!="")&&($_POST["confirm_password"]!="")&&($num==0)){
		$sql="INSERT INTO user(name, email, password)VALUES('$_POST[name]','$_POST[email]','$_POST[password]')";
		if(mysqli_query($link,$sql)){
			header('Location: http://localhost/tickety/main.php');

		}
		else{ echo "Error inserting data into table".mysqli_error($link)."<br>";}
		
	}
	?>

   
	</script>
		
</head>

<body>
   <div class = "topbar">
      <a href = "main.php">Logo</a>
      <a href = "events.php">Events</a>
           
      <div class = "topbarRight">
        <a href = "http://localhost/tickety/login.html">Login</a>
        <a href = "http://localhost/tickety/SignUp.php">Sign Up</a>
      </div>
    </div>

    <div class = "centre">
      <p class = "motto">Create your Tickety account. It's free and only takes a minute.</p>
      
      <div class = "box padder">
        <form method = "post" action="SignUp.php">
          <label>Name:</label>
          <br>
          <input type = "text" name = "name" placeholder = "Your Name" autofocus required>
          <br><br>
          <label>Email:</label>
          <br>
          <input type = "email" name = "email" placeholder = "you@domain.com" required>
          <br><br>
          <label>Password:</label>
          <br>
          <input type = "password" id = "password" name = "password" placeholder = "********" required>
          <br><br>
          <label>Confirm Password:</label>
          <br>
          <input type = "password" id = "confirm_password" name = "confirm_password" placeholder = "********" required>
          </br><br>
          <div class = "right">
            <input type = "submit" value = "Sign Up" onclick = "check()">
          </div>
        </form>
      </div><br>
      
      <div class = "box padder">
        <p>
          Already have an account? <a href = "http://localhost/tickety/login.html">Log in</a>
        </p>
      </div>
    </div>


</body>
</html>

