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
			$link = mysqli_connect($server, $user, $password);
			
			$db_selected = mysqli_select_db($link, "try");
			
			if(!$db_selected) {
				$sql = "CREATE DATABASE try";
				mysqli_query($link, $sql);
				$db_selected = mysqli_select_db($link,"try");
				if($db_selected){
					echo "Selected tickety database. <br>";
				}
				else {
					//echo "Selected my_db database. <br>";
				}
			}			
			
			$query = "SELECT ID FROM user";
			$result = mysqli_query($link, $query);
			
			if(empty($result)) {
               $sql = "CREATE TABLE IF NOT EXISTS `user` (
				  `userID` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(32) NOT NULL,
				  `password` varchar(32) NOT NULL,
				  `email` varchar(32) NOT NULL,
				  PRIMARY KEY (`userID`)
				) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;";
				mysqli_query($link, $sql);
				
				$sql = "
					INSERT INTO `user` (`userID`, `name`, `password`, `email`) VALUES
					(115, 'Megat Ilham', '12345', 'megat@ilham.com'),
					(116, 'John Smith', '12345', 'john@smith.com'),
					(117, 'Rock Lee', '12345', 'rock@lee.com'),
					(118, 'Rin', '12345', 'rin@ingan');
				";
				mysqli_query($link, $sql);
			}
			
			$query = "SELECT ID FROM events";
			$result = mysqli_query($link, $query);
			
			if (empty($result)) {
				$sql = "CREATE TABLE IF NOT EXISTS `events` (
				  `eventID` int(3) NOT NULL AUTO_INCREMENT,
				  `event_title` varchar(12) NOT NULL,
				  `event_description` varchar(265) NOT NULL,
				  `event_date` date NOT NULL,
				  `event_price` int(4) NOT NULL,
				  `eventParticipants` int(5) DEFAULT NULL,
				  `event_url` varchar(32) DEFAULT NULL,
				  `event_alt` varchar(32) DEFAULT NULL,
				  `userID` int(11) NOT NULL,
				  PRIMARY KEY (`eventID`)
				) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1";
				mysqli_query($link, $sql);
				
				$sql = "
					INSERT INTO `events` (`eventID`, `event_title`, `event_description`, `event_date`, `event_price`, `eventParticipants`, `event_url`, `event_alt`, `userID`) VALUES
					(1, 'Dance Party', 'The dance revolution that you need!', '2018-01-24', 200, 0, 'eventImage/festival', '', 115),
					(3, 'Traffic Jam', 'What the fuck is this. WHAT THE FUCK IS THIS.', '2018-01-27', 300, 0, '', '', 115),
					(4, 'LAN Party', 'Get your mouse out and lets get partying!', '2018-02-28', 10, 0, 'eventImage/disneyland', '', 115),
					(5, 'Code Breaker', 'Hack into your Favorite Companies', '2018-02-24', 5000, 0, 'eventImage/presentation', '', 115),
					(6, 'Gala Bois', 'What is this', '2018-02-26', 1, 0, 'eventImage/cheers', '', 115),
					(7, 'The Bomb', 'It\'s the Bomb', '2018-02-28', 28, NULL, NULL, NULL, 115),
					(8, 'Kill', 'The Kill', '2018-02-22', 200, NULL, NULL, NULL, 115),
					(9, 'Fuck', 'weeqrweffa', '2018-02-28', 210, NULL, NULL, NULL, 115),
					(10, 'What is THis', '', '2018-02-28', 200, NULL, NULL, NULL, 115),
					(11, 'ASK', 'efwefwfa', '2018-02-27', 200, NULL, NULL, NULL, 115),
					(12, 'HOw are', '', '2018-02-28', 2313131, NULL, NULL, NULL, 115),
					(13, 'Creqat', 'wqeqwe', '2018-02-28', 289, NULL, NULL, NULL, 115);
				";
				mysqli_query($link, $sql);
			}
			
			$query = "SELECT ID FROM participants_list";
			$result = mysqli_query($link, $query);
			
			if (empty($result)) {
				$sql = "CREATE TABLE IF NOT EXISTS `participants_list` (
				  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
				  `userID` int(32) NOT NULL,
				  `eventID` int(32) NOT NULL,
				  `noOfTickets` int(6) NOT NULL,
				  PRIMARY KEY (`purchase_id`),
				  KEY `eventID` (`eventID`),
				  KEY `userID` (`userID`)
				) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;";
				mysqli_query($link, $sql);
				
				$sql = "
					INSERT INTO `participants_list` (`purchase_id`, `userID`, `eventID`, `noOfTickets`) VALUES
						(1, 115, 4, 1),
						(2, 115, 6, 2),
						(3, 116, 3, 32);
				";
				mysqli_query($link, $sql);
				
			}
			
			$query = "SELECT ID FROM credential";
			$result = mysqli_query($link, $query);
			
			if (empty($result)) {
				$sql = "CREATE TABLE IF NOT EXISTS `credential` (
				  `email` varchar(32) NOT NULL,
				  `password` int(11) NOT NULL,
				  PRIMARY KEY (`email`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
				mysqli_query($link, $sql);
				
			}
			
			$query = "SELECT ID FROM dialouge";
			$result = mysqli_query($link, $query);
			
			if (empty($result)) {
				$sql = "CREATE TABLE IF NOT EXISTS `dialogue` (
				  `senderID` int(11) NOT NULL AUTO_INCREMENT,
				  `ricipientID` int(11) NOT NULL,
				  `chatID` int(11) NOT NULL,
				  PRIMARY KEY (`senderID`,`ricipientID`),
				  KEY `chatID` (`chatID`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
				mysqli_query($link, $sql);
				
			}
			
			$query = "SELECT ID FROM chat";
			$result = mysqli_query($link, $query);
			
			if (empty($result)) {
				$sql = "CREATE TABLE IF NOT EXISTS `chat` (
				  `chatID` int(11) NOT NULL AUTO_INCREMENT,
				  `time` datetime NOT NULL,
				  `text` varchar(256) NOT NULL,
				  PRIMARY KEY (`chatID`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
				mysqli_query($link, $sql);
			}
			
			if ($link -> connect_error){
				die("Connection Failed: ".$link->connect_error);
			} else {
				echo "Connection Successful ";
			}
			
			$date_str = date("Y-m-d");
			
			if ($result = mysqli_query($link, "SELECT * FROM events WHERE event_date > '$date_str'")) {
					$row_cnt = mysqli_num_rows($result);

					mysqli_free_result($result);
				}

			$sql = "SELECT eventID, event_title, event_description, event_date, event_price FROM events";
		
			$result = mysqli_query($link, $sql);
			while ($row = mysqli_fetch_assoc($result)){
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
					for($x = $row_cnt; $x > $row_cnt-5; $x--){
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