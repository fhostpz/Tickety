<?php
	session_start();
	
	// $_SESSION['userID'] = "1";
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Events For You</title>
		<meta name = "viewport" content = "width = device-width, initial-scale=1">
		
		<link rel="stylesheet" href="topbar.css" type="text/css"/>
		<link rel = 'stylesheet' href = 'EventsStyle.css' type = 'text/css'/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Supermercado+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<script type="text/javascript">
		<!--
			function toggle_description(id) {
				event.preventDefault();
			   var e = document.getElementById(id);
			   if(e.style.display == 'block')
				  e.style.display = 'none';
			   else
				  e.style.display = 'block';
			}
			
			// $(document).on('keyup mouseup', '#your-id', function() {                                                                                                                     
			  // console.log('changed');
			// });
			
			// function updatePrice() {
				// var price = $("#dare_price").val();
				// var total = (price + 1) * 1.05;
				// $("$total_price_amount").val(total);
			// }​
			
			// function display_purchase(id) {
				// // event.preventDefault();
			    // document.getElementByName(id).style.display='block';
			// }
			
			// function close(id) {
				// // event.preventDefault();
			    // document.getElementByName(id).style.display='none';
			// }
		//-->
		</script>
	</head>

	<body>
		<div class = "topbar">
			<a href="main.php">Tickety</a>
			<a href="events.php">Events</a>
			
			<div class = "topbarRight">
				<?php if(isset($_SESSION['userID'])): ?>
				  <a class="link" href="logout.php" style="text-decoration:none">Logout</a>
				<?php else: ?>
				  <a class="link" href="login.html" style="text-decoration:none">Login</a>
				<?php endif; ?>
				<!--<a href="">Login</a>-->
				
				<?php if(isset($_SESSION['userID'])): ?>
					<a href="User Profile.php">Profile</a>
				<?php endif; ?>
				
			</div>
			
		</div>
		
		<div class = "eventBox">
			<?php
				//establishing connection
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
				
				$date_str = date("Y-m-d");
				//create sql query
				// $query = "SELECT COUNT(*) FROM event";
				// $result = mysqli_query($link, $query);
				// $number = $result->fetch_object();
				if ($result = mysqli_query($link, "SELECT * FROM events WHERE event_date > '$date_str'")) {

					/* determine number of rows result set */
					$row_cnt = mysqli_num_rows($result);

					//echo "Result set has %d rows.\n, $row_cnt";

					/* close result set */
					mysqli_free_result($result);
				}
				
				// run query
				
				$query = "SELECT * FROM events WHERE event_date > '$date_str' ORDER BY event_date ASC";
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

				// debug:
				//print_r($array); // show all array data
				//echo $array[0]['event_title'];
				//echo $row[1]['event_title'];
				
				// echo $number;
				
				for($x=0; $x<$row_cnt; $x++)
				{
					echo "<div class = 'eventCard'>
						<div class = 'eventImage'>
							<img src = '".$array[$x]['event_url']."' alt = '".$array[$x]['event_alt']."'>
						</div>
						<a href = '#' onclick=\"toggle_description('".$array[$x]['eventID']."')\">
							<div class = 'eventTitle'>
								<h1>".$array[$x]['event_title']."</h1>
								<div class='eventDescription' id ='".$array[$x]['eventID']."'>
									".$array[$x]['event_description']."
								</div>
							</div>
						</a>
						<form method = 'post' action = 'contact.php'>
									<input type = 'submit' value = 'Contact Us'>
									<input name = 'eventID' value='".$array[$x]['eventID']."' readonly>
								</form>
						<div class = 'eventDate'>
							".$array[$x]['event_date']."
							<button onclick = \"document.getElementsByName('".$array[$x]['eventID']."')[0].style.display='block'\" class = 'cardButton'>Buy Now</button>
								
								<div name = '".$array[$x]['eventID']."' class = 'modal'>
									<span onclick=\"document.getElementsByName('".$array[$x]['eventID']."')[0].style.display='none'\" class='close' title='Close Modal'>&#10006;</span>
									<form method = 'post' action = 'payment.php' class = 'modal-content'>
										<div class = 'buyTicketContainer'>
											<h1>".$array[$x]['event_title']."</h1>
											<p> Price (RM ".$array[$x]['event_price'].")</p>
											
											<label><b>Number of Tickets</b></label>
											<br>
											<input name = 'numTickets' type = 'number' min = 0 style = 'width: 50%;' onchange = \"document.getElementById('".$array[$x]['eventID']."total_price').value=(".$array[$x]['event_price']."*value)\"/>
											<br>
											<hr>
											<label style = 'margin-left: 360px'><b>Total Price</b></label>
											<p style = 'margin-left: 360px'>
												RM<input id = '".$array[$x]['eventID']."total_price' value='' readonly>
											</p>
											<p style = 'margin-left: 360px; display: none'>
												Event ID<input name = 'eventID' value='".$array[$x]['eventID']."' readonly>
											</p>
											<div class = 'clearfix'>
												<button type = 'submit' class = 'modalBtn submitBtn'>Order</button>	
											</div>
										
										</div>
									</form>
								</div>
						</div>
					</div>";
				}
			
				
			?>
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