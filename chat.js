
$(document).ready(
  function() {
	var chatInterval = 1000;
	var chatOutput   = $("#chatOutput");
	var chatSend     = $("#chatSend");
	var message      = $("#message");
	
	function saveChat() {
	  var strMessage = message.val();
	  
	  $.get("./savechat.php", {
            message: strMessage
          });
	}
	
    function updateChat() {
      $.get("readchat.php", function(data) {
        chatOutput.html(data);
      });
    }
	
	chatSend.click(function() {
      saveChat();
    });
	
	setInterval(function() {
      updateChat();
    }, chatInterval);
  }
);

