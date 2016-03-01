<script type="text/javascript"> 
$(function() {

                var file;
                var fileExtension;

                //clear the selectedfile display onclick of choose file
                $('#selectAvatarFile').click(function() {
                  $('#selectAvatarFileSelectedFile').val("");
                });
                // Set an event listener on the Choose File field.
                $('#selectAvatarFile').bind("change", function(e) {
                  var files = e.target.files || e.dataTransfer.files;
                  // Our file var now holds the selected file
                  file = files[0];
                  $('#selectAvatarFileSelectedFile').val(file.name);
                  fileExtension = file.type;
                });

                // This function is called when the user clicks on Upload to Parse. It will create the REST API request to upload this image to Parse.


                $('#uploadbutton').click(function() {
                  if( file && ( fileExtension.indexOf(<?php echo '"'.ParseConstants::TYPE_IMAGE.'"';?>) > -1 ) ){
                    var serverUrl = 'https://api.parse.com/1/files/' + file.name;

                    $.ajax({
                      type: "POST",
                      url: serverUrl,
                      data: file,
                      processData: false,
                      contentType: false,
                      beforeSend: function(request) {
                        request.setRequestHeader("X-Parse-Application-Id", parse_app_id);
                        request.setRequestHeader("X-Parse-REST-API-Key", parse_rest_api_id);
                        request.setRequestHeader("Content-Type", file.type);
                      },
                      success: function(data) {

                        var myimage = new Parse.Object("userImages");
                        myimage.set({imagetitle: "avatar"+"<?php echo $parse_current_user->getObjectId();?>"});
                        myimage.set({imageurl: data.url});
                        myimage.set({imagefile: {"name": data.name,"url": data.url,"__type": "File"}});
                        myimage.save();

                        //update UI with uploaded image
                        updateUIWithNewAvatar(data.url);
                        


                      },
                      error: function(data) {
                        var obj = jQuery.parseJSON(data);
                        alert(obj.error);
                      }
                    });
                  } else {
                    showAlert('<strong class="text_size_20px">Avatar Update Failed!</strong>', 'Choose an image first, silly', '', '');
                  }
});


});

function updateUIWithNewAvatar(imgUrl){
  var updateLogProfileAvatar = document.getElementById("logProfileAvatar");
  var displayNewAvatar = document.getElementById("newAvatar");
  updateLogProfileAvatar.src = imgUrl;
  displayNewAvatar.src = imgUrl;
}
</script>