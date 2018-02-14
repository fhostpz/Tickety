<?php
	session_start();
		// $_SESSION['userID'] = "1";
?>

<html>
	<head>
		<title>Tickety</title>
		<meta name = "author" content = "Megat Ilham" />
		<meta name = "description" content = "Event Management Website" />
		<meta name = "viewport" content = "width = device-width, initial-scale=1">
		
		<link rel="stylesheet" href="topbar.css" type="text/css"/>
		<link rel="stylesheet" href="MainPageStyle.css" type="text/css"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		
		<?php
			$server   = "localhost";
			$user     = "root";
			$password = "";
			$database = "tickety";
			
			// $link = mysqli_connect($server, $user, $password, $database);
			$conn = mysqli_connect($server, $user, $password, $database);
			
			if ($conn -> connect_error){
				die("Connection Failed: ".$conn->connect_error);
			} else {
				echo "Connection Successful ";
			}
			
			$sql = "SELECT COUNT(*) FROM events";

			$result = mysqli_query($conn, $sql);
			$rs = mysqli_fetch_array($result);
				
			$sql = "SELECT eventID, event_title, event_description, event_date, event_price FROM events";
		
			$result2 = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result2)){
				$array[] = $row;
			}
			
			mysqli_free_result($result);
		?>
		
		<script type = "text/javascript">
			var slideIndex = 1;
			showSlides(slideIndex);
		
			// Next/previous controls
			function plusSlides(n) {
			  showSlides(slideIndex += n);
			}

			// Thumbnail image controls
			function currentSlide(n) {
			  showSlides(slideIndex = n);
			}

			function showSlides(n) {
			  var i;
			  var slides = document.getElementsByClassName("slides");
			  var dots = document.getElementsByClassName("dot");
			  if (n > slides.length) {slideIndex = 1} 
			  if (n < 1) {slideIndex = slides.length}
			  for (i = 0; i < slides.length; i++) {	
					slides[i].style.display = "none"; 
			  }
			  for (i = 0; i < dots.length; i++) {
					dots[i].className = dots[i].className.replace(" active", "");
			  }
			  slides[slideIndex-1].style.display = "block"; 
			  dots[slideIndex-1].className += " active";
			}
			
		</script>
	</head>
	
	<body onload="showSlides(1);">
	
		<div class = "topbar">
			<a href="main.php">Logo</a>
			<a href="events.php">Events</a>
			
			<div class = "topbarRight">
				<?php if(isset($_SESSION['userID'])): ?>
				<a href="logout.php">Logout</a>
				<?php else: ?>
				<a href="login.html">Login</a>
				<?php endif; ?>
				
				<?php if(isset($_SESSION['userID'])): ?>
					<a href="User Profile.php">Profile</a>
				<?php endif; ?>
				
				<?php if(isset($_SESSION['userID'])): ?>

				<?php else: ?>
				<a href="SignUp.php">Sign Up</a>
				<?php endif; ?>
				

			</div>
		</div>
		
		<div class = "slideshowBox">
			<div class = "slides fade">
					<img class = "parent" src = "slideshowImage/img1.jpg" style = "width:100%;">
			</div>
			
			<div class = "slides fade">
					<img class = "parent" src = "slideshowImage/img2.jpg" style = "width:100%;">
			</div>
			
			<div class = "slides fade">
					<img class = "parent" src = "slideshowImage/img3.jpg" style = "width:100%;">
			</div>
			
			<div class = "buttonRow">
				<a class = "prev" onclick="plusSlides(-1)"> &#10094;</a>
				<a class = "next" onclick="plusSlides(1)"> &#10095;</a>
			</div>
		</div>

		<div style = "text-align: center">
			<br>
			<span class = "dot" onClick="currentSlide(1)"></span>
			<span class = "dot" onClick="currentSlide(2)"></span>
			<span class = "dot" onClick="currentSlide(3)"></span>
		</div>
		<div class = "productInfo">
			<h1 style = "text-align: center;">Tickety</h1>
			<p>
			Tickety is your one stop solution to all your event management problems! What you don't like it? What the fuck did you just fucking say about me, you little bitch? I’ll have you know I graduated top of my class in the Navy Seals, and I’ve been involved in numerous secret raids on Al-Quaeda, and I have over 300 confirmed kills. I am trained in gorilla warfare and I’m the top sniper in the entire US armed forces. You are nothing to me but just another target. I will wipe you the fuck out with precision the likes of which has never been seen before on this Earth, mark my fucking words. You think you can get away with saying that shit to me over the Internet? Think again, fucker. As we speak I am contacting my secret network of spies across the USA and your IP is being traced right now so you better prepare for the storm, maggot. The storm that wipes out the pathetic little thing you call your life. You’re fucking dead, kid. I can be anywhere, anytime,
			</p>
		</div>
	
		<div class = "buyTickets">
			<h1 style = "text-align: center;">Latest Events</h1>
			<div class = "rowTicket">
				<?php
					for($x = 4; $x > -1; $x--){
					echo "
						<div class = 'cardColumn'>
							<div class = 'cardImage'>
								<img class = 'imageCard' src = 'eventLocation/img1.jpg' alt = 'KL' style = 'width: 60%'>
							</div>
							<div class = 'cardContainer'>
								<div class = 'cardTitle'>
									<p>".$array[$x]['event_title']."</p>
								</div>
								<hr>
								<p>".$array[$x]['event_date']."</p>
								<p>".$array[$x]['event_description']."</p>
								<p>
								<button onclick = \"document.getElementById('".$array[$x]['eventID']."').style.display='block' \" class = 'cardButton'>Buy Now</button>
								</p>
								
								<div id = '".$array[$x]['eventID']."' class = 'modal'>
								<span onclick=\"document.getElementById('".$array[$x]['eventID']."').style.display='none'\" class='close' title='Close Modal'>&#10006;</span>
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
										<p style = 'margin-left: 360px'>RM <input id = '".$array[$x]['eventID']."total_price' value='' readonly> </p>
										<p style = 'margin-left: 360px; display: none'>
												Event ID <input name = 'eventID' value='".$array[$x]['eventID']."' readonly>
										</p>
										<div class = 'clearfix'>
											<button type = 'submit' class = 'modalBtn submitBtn'>Order</button>	
										</div>
									
									</div>
								</form>
								</div>
							</div>
						</div>
						";
					}
				?>
			</div>
		
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