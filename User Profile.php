<?php
	session_start();
	
	// $_SESSION['userID'] = "1";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>User Profile</title>
		<meta name = "viewport" content = "width = device-width, initial-scale=1">
		
		<link rel = "stylesheet" href = "UserProfileStyle.css" type = "text/css"/>
		<link rel = "stylesheet" href="topbar.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Supermercado+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<div class = "topbar">
			<a href="main.php">Logo</a>
			<a href="events.php">Events</a>	
			
			<div class = "topbarRight">
				<a href="logout.php">Logout</a>
			</div>
		</div>
		
		<div class = "profilePic">
			<img src = "profilePics/putin.jpg"/>
		</div>
		
		
		
		<div class = "userDetails">
			<?php
				$con = mysqli_connect("localhost", "root", "");
				if(!$con) {
					die("Could not connect: ".mysqli_connect_error());
				}
				else {
					// echo "Successfully connected to localhost.<br>";
				}
				
				$db_selected = mysqli_select_db($con, "tickety");
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
				
				$loginID = $_SESSION['userID'];
				
				$sql = "SELECT * FROM user WHERE userID = '$loginID'";
				$result = mysqli_query($con, $sql);
				if(!($result))
					echo "No result found";
				
				$array = array();
				
				while($row = mysqli_fetch_assoc($result)){

				  // add each row returned into an array
				  $array[] = $row;

				  // OR just echo the data:
				  //echo $row['event_title']; // etc

				}
				
				echo
					'<table cellspacing = "40px">
						<col width = "200px">
						<col width = "400px">
						<form method = "post" action = "UpdateProfile.php">
							<tr>
								<th align="left" style="color: black">Name</th>
								<td align="center"><input type="text" class="input" name="name" value ="'.$array[0]["name"].'"/></td>
							</tr>
							<tr>
								<th align="left" style="color: black">Email</th>
								<td align="center"><input type="text" class="input" name="email" value ="'.$array[0]["email"].'"/></td>
							</tr>
						
							<tr>
								<td>
									<a href="events.php">Organized Events</a> 
								</td>
								<td align = "right">
									<button type="submit" value="Save" class = "submit">Save</button>
								</td>
							</tr>
							<tr>
								<td>
									<a href="attendee.php">Attendance List</a> 
								</td>
							</tr>
							<tr>
								<td>
									<a href="eventpage.html">Create An Event</a> 
								</td>
							</tr>
						</form>
					</table>';
			?>
		</div>
		
		<div class = "purchasedEvents">
			<h1>Purchase History</h1>
				<table class = "eventTable">
					<col width = "300px">
					<col width = "150px">
					<col width = "150px">
					<tr>
						<th>Event Title</th>
						<th>Date</th>
						<th>Number of tickets</th>
					</tr>
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
						
						$userID = $_SESSION['userID'];
						
						if ($result = mysqli_query($link, "SELECT events.event_title, events.event_date, participants_list.noOfTickets FROM events, participants_list, user WHERE participants_list.userID=user.userID and events.eventID=participants_list.eventID and user.userID=$userID")) {

							/* determine number of rows result set */
							$row_cnt = mysqli_num_rows($result);

							//echo "Result set has %d rows.\n, $row_cnt";

							/* close result set */
							mysqli_free_result($result);
						} else {
							echo "fuck you";
						}
						
						// run query
						
						
						
						$query = "SELECT events.event_title, events.event_date, participants_list.noOfTickets FROM events, participants_list, user WHERE participants_list.userID=user.userID and events.eventID=participants_list.eventID and user.userID=$userID ORDER BY events.event_date ASC";
						$result = mysqli_query($link, $query);

						// set array
						$array = array();

						// look through query
						while($row = mysqli_fetch_assoc($result)){

						  // add each row returned into an array
						  $array[] = $row;

						  // OR just echo the data:
						  //echo $row['event_title']; // etc

						}
						
						for($x=0; $x<$row_cnt; $x++)
						{
							echo
								"<tr>
									<td>".$array[$x]['event_title']."</td>
									<td>".$array[$x]['event_date']."</td>
									<td>".$array[$x]['noOfTickets']."</td>
								</tr>";
						}
					?>
				</table>
		</div>
		
		<div class = "footer">
			<div class = "row">
				<div class = "column"> Company
					<ul>
						<li>About Us</li>
						<li>Testimony</li>
					</ul>
				
				</div>
				<div class = "column">Help
					<ul>
						<li>Contact Us</li>
					</ul>
				
				</div>
				
				<div class = "column">Social Media
					<ul>
						<li><a href="#" class="fa fa-facebook"></a></li>
						<li><a href="#" class="fa fa-twitter"></a></li>
						<li><a href="#" class="fa fa-instagram"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>