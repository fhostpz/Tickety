<?php
  session_start();
    
  //connect to database
  $server   = "localhost";
  $user     = "root";
  $password = "";
  $database = "tickety";
  $link = mysqli_connect($server, $user, $password, $database);
  
  //check connection
  if (!$link) {
    die ("Error, please contact the web administrator: " . mysqli_error($link));
  }
  
  //get user input
  $time = date("Y-m-d H:i:s");
  $text = $_GET["message"];
  
               //INSERT INTO chat(time, text) VALUES ("$time", "$text")
  $sqlcommand = "INSERT INTO chat(time, text) VALUES (\"" . $time . "\", \"" . $text . "\")";
  $result = mysqli_query($link, $sqlcommand);
  
  if (!$result) {
    die ("Error, please contact the web administrator: " . mysqli_error($link));
  }
  
  $sqlcommand = "SELECT * FROM chat ORDER BY chatID DESC LIMIT 1";
  $result = mysqli_query($link, $sqlcommand);
  
  if (!$result) {
    die ("Error, please contact the web administrator: " . mysqli_error($link));
  }
  
  //get latest row
  $record = mysqli_fetch_assoc($result);
  
  $sender   = $_SESSION["userID"];
  $receiver = $_SESSION["organiserID"];
  $chatID   = $record["chatID"];
  
               //INSERT INTO dialogue(senderID, receiverID, chatID) VALUES ($sender, $receiver, $chatID)
  $sqlcommand = "INSERT INTO dialogue(senderID, recipientID, chatID) VALUES (" . $sender . ", " . $receiver . ", " . $chatID . ")";
  $result = mysqli_query($link, $sqlcommand);
  
  if (!$result) {
    die ("Error, please contact the web administrator: " . mysqli_error($link));
  }
  
  mysqli_close($link);
?>