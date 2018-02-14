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
  
  //create query
  $sqlcommand = "SELECT chat.time AS time, `user`.name as sender, chat.text AS message FROM user JOIN dialogue ON `user`.userID = dialogue.senderID JOIN chat ON dialogue.chatID = chat.chatID";
    
  //execute query
  $result = mysqli_query($link, $sqlcommand);
  
  if ($result) {
    while ($table = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $time    = $table["time"];
	  $sender  = $table["sender"];
	  $message = $table["message"];
	  
      echo "  (" . $time . ") " . $sender . ": " . $message . "<br>";
    }
  }
  else {
    die ("Error, please contact the web administrator: " . mysqli_error($link));
  }
  
  mysqli_free_result($result);
  mysqli_close($link);
?>