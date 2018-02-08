<html>
	<head>
		<meta charset="utf-8">
		<meta name = "viewport" content = "width = device-width, initial-scale=1">
		
		<link rel = 'stylesheet' href = 'EventsStyle.css' type = 'text/css'/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Supermercado+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<script type="text/javascript">
		<!--
			function toggle_visibility(id) {
				event.preventDefault();
			   var e = document.getElementById(id);
			   if(e.style.display == 'block')
				  e.style.display = 'none';
			   else
				  e.style.display = 'block';
			}
		//-->
		</script>
	</head>

	<body>
		<?php
			//establishing connection
			$link = mysqli_connect("localhost", "root", "");
			if(!$link) {
				die("Could not connect: ".mysqli_connect_error());
			}
			else {
				echo "Successfully connected to localhost.<br>";
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
			if ($result = mysqli_query($link, "SELECT * FROM event WHERE event_date > '$date_str'")) {

				/* determine number of rows result set */
				$row_cnt = mysqli_num_rows($result);

				//echo "Result set has %d rows.\n, $row_cnt";

				/* close result set */
				mysqli_free_result($result);
			}
			
			// run query
			
			
			$query = "SELECT * FROM event WHERE event_date > '$date_str'";
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
						<img src = '".$array[$x]['event_url']."' alt = 'Drinks together'>
					</div>
					<a href = '#' onclick=\"toggle_visibility('".$array[$x]['event_id']."')\">
						<div class = 'eventTitle' >
							<h1>".$array[$x]['event_title']."</h1>
							<div class='eventDescription' id ='".$array[$x]['event_id']."'>
								".$array[$x]['event_description']."
							</div>
						</div>
					</a>
					<div class = 'eventDate'>
						".$array[$x]['event_date']."
						<button onclick = \"document.getElementById('".$array[$x]['event_id']."').style.display='block'\" class = 'cardButton'>Buy Now</button>
							</p>
							
							<div id = '".$array[$x]['event_id']."' class = 'modal'>
								<span onclick=\"document.getElementById('".$array[$x]['event_id']."').style.display='none'\" class='close' title='Close Modal'>&#10006;</span>
								<form action = '' class = 'modal-content'>
									<div class = 'buyTicketContainer'>
										<h1>Dance Party in KL</h1>
										<p> Price ( RM #price)</p>
										
										<label><b>Number of Tickets</b></label>
										<br>
										<input name = 'numTickets' type = 'number' min = 0 style = 'width: 50%;'/>
										<br>
										<hr>
										<label style = 'margin-left: 360px'><b>Total Price</b></label>
										<p style = 'margin-left: 360px'>#price</p>
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
	</body>
</html>