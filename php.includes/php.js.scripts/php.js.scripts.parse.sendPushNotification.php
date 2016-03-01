<script type="text/javascript"> 
function sendPushNotifications(intendedRecipientIds, senderObjectId, senderUsername, message){
  var query = new Parse.Query(Parse.Installation);
  query.containedIn(<?php echo '"'.ParseConstants::KEY_USER_ID.'"';?>, intendedRecipientIds);

  Parse.Push.send({
    // Set our Installation query
    where: query, 
    data: {
      alert: message
    }
  }, {
    success: function() {},
    error: function(error) { /*Handle error*/ }
  });
}
function sendSinglePushNotification(intendedRecipientId, senderObjectId, senderUsername, message){
  var query = new Parse.Query(Parse.Installation);
  var intendedRecipientIds = intendedRecipientId+" ";
  var intendedRecipientIds = intendedRecipientIds.split(" ");
  query.containedIn(<?php echo '"'.ParseConstants::KEY_USER_ID.'"';?>, intendedRecipientIds);

  Parse.Push.send({
    // Set our Installation query
    where: query, 
    data: {
      alert: message
    }
  }, {
    success: function() {},
    error: function(error) { /*Handle error*/ }
  });
}
</script>