<script type="text/javascript"> 
$(function() {

                var file;
                var fileExtension;
                var sendMessageWithFile = "";

                // Set an event listener on the Choose File field.
                $('#sendMessageFile').bind("change", function(e) {
                  var files = e.target.files || e.dataTransfer.files;
                  // Our file var now holds the selected file
                  file = files[0];
                  $('#sendMessageFileSelectedFile').val(file.name);
                  fileExtension = file.type;
                });

                $('#sendMessageButton').click(function() {
                  var sendMessageTextData = $('#sendMessageText').val();
                  if(!sendMessageTextData.trim()){
                    showAlert('<strong class="text_size_20px">Message Failed!</strong>', 'Say something more interesting', '', '');
                    return false;
                  }

                  if(file){
                    var sendMessageFile = new Parse.File(<?php echo '"'.$parse_current_user_uid.'_file"';?>, file);
                    sendMessageWithFile = "with file";
                  }

                  var SendMessage = Parse.Object.extend("Messages");
                  var sendMessage = new SendMessage();
                  for(var i = 0; i < intendedRecipientIds.length; i++){
                    sendMessage.addUnique("recipientIds", intendedRecipientIds[i]);
                  }
                  if(sendMessageFile){
                    sendMessage.set(<?php echo '"'.ParseConstants::KEY_FILE.'"';?>, sendMessageFile);
                    sendMessage.set(<?php echo '"'.ParseConstants::KEY_FILE_TYPE.'"';?>, sendMessageFile);
                    if( fileExtension.indexOf(<?php echo '"'.ParseConstants::TYPE_IMAGE.'"';?>) > -1 ){
                      var sendMessageFileType = <?php echo '"'.ParseConstants::TYPE_IMAGE.'"';?>;
                    } else if( fileExtension.indexOf(<?php echo '"'.ParseConstants::TYPE_VIDEO.'"';?>) > -1 ){
                      var sendMessageFileType = <?php echo '"'.ParseConstants::TYPE_VIDEO.'"';?>;
                    }
                  } else {
                    var sendMessageFileType = <?php echo '"'.ParseConstants::TYPE_TEXT.'"';?>;
                  }

                  sendMessage.save({
                    senderId: <?php echo '"'.$parse_current_user_uid.'"';?>,
                    senderName: <?php echo '"'.$parse_current_user_u.'"';?>,
                    textData: sendMessageTextData,
                    fileType: sendMessageFileType
                  }, 
                    {
                      success: function(SendMessage) {
                        //let user know message successfully sent 
                        showAlert('<strong>Message Sent!</strong>', 
                          '<span class="text_size_20px">Sent "' + sendMessageTextData +'"</span> ' + sendMessageWithFile + '<br> to ' + 
                          intendedRecipientsUString.substring(0, intendedRecipientsUString.trim().length - 1), '', "");

                        /* SEND PUSH NOTIFICATIONS */
                        var sendMessageTextDataBrief="";
                        if( sendMessageTextData!="" && sendMessageTextData!=null ){
                          sendMessageTextDataBrief = 'New message from ' + <?php echo '"'.$parse_current_user_u.'"';?> + ': ' + sendMessageTextData.substring(0, sendMessageTextData.length/2) + "..." ;
                        } else {
                          sendMessageTextDataBrief = 'New message from ' + <?php echo '"'.$parse_current_user_uid.'"';?>;
                        }
                        sendPushNotifications(intendedRecipientIds, <?php echo '"'.$parse_current_user_uid.'"';?> , <?php echo '"'.$parse_current_user_u.'"';?>, sendMessageTextDataBrief);                        
                      },
                      error: function(sendMessage, error) {
                        // The save failed.
                        // error is a Parse.Error with an error code and message.
                        showAlert('<strong class="text_color_red">Message Failed!</strong>', 
                          error, '', "");
                      }
                    }
                  );
});


});
</script>