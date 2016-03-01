<script type="text/javascript">
function Friend(friendObjectId, friendUsername, friendAvatarFileUrl){
	this.friendObjectId = friendObjectId;	
  this.friendUsername = friendUsername;
	this.friendDivId = Math.floor(Math.random() * 99999999999)+111111;
  if(friendAvatarFileUrl!=null && friendAvatarFileUrl!=""){
    this.friendAvatarFileUrl = friendAvatarFileUrl;
  } else {
    this.friendAvatarFileUrl = "images/avatar.empty.png";
  }
  
}
Friend.prototype.make = function(){
  this.friend = '<div id="'+this.friendDivId+'" style="overflow-y: scroll">';
    this.friend += '<div class="friend_modal_holder" onclick="closefriend(&#39;'+this.friendDivId+'&#39;)">';
    this.friend += '</div>';
    this.friend += '<div id="alertModal" class="friend_modal border_cacaca_1px"  style="height:auto; overflow-y: auto; height:100%;">';      
      this.friend += '<div id="dialogbox">';
        this.friend += '<div>';
          this.friend += '<div id="dialogboxhead'+this.friendObjectId+'" class="padding_20px text_color_white background_color_caribbean_green" style="position:relative; top:0; z-index:9999">';
            this.friend += '<a class="a_button background_transparent text_color_white p-btn margin_5px" href="message?page_fragment=sendmessage&uid='+this.friendObjectId+'">'+this.friendUsername+'</a>';
            this.friend += '<a class="a_button background_transparent text_color_white margin_5px text_weight_bolder text_size_20px" style="position: relative; left: 0; float: left; top: -15px;" onclick="closeMessage(&#39;'+this.friendDivId+'&#39;)">X</a>';
          this.friend += '</div>';
          this.friend += '<div id="dialogboxbody" class="background_color_white text_color_grey808080 margin_10px text_size_18px"><img style="max-width:300px; max-height:300px" src="'+this.friendAvatarFileUrl+'"/></div>';
          this.friend += '<div id="dialogboxfoot" class="margin_top_50px" style="right:0; float:right;">';
            this.friend += '<a id="goMessage'+this.friendObjectId+'" class="a_button text_smaller background_color_blue p-btn margin_5px" href="message?page_fragment=sendmessage&uid='+this.friendObjectId+'">Message '+this.friendUsername+'</a>';
            this.friend += '<button id="unFriend'+this.friendObjectId+'" class="a_button text_smaller background_color_silver p-btn margin_5px" style="border-radius:3.5px; border:none; position:relative; bottom:0; right:0; float:right;" onclick="unFriend(&#39;'+this.friendObjectId+'&#39;)">Unfriend</button>';
          this.friend += '</div>';
        this.friend += '</div>';
      this.friend += '</div>';
    this.friend += '</div>';
  this.friend += '</div>';
this.friend += '</div></div>';
}
Friend.prototype.show = function(){
  document.getElementById("dynamicPopupDiv").innerHTML = this.friend;
}

function friendAction(friendObjectId, friendUsername, friendAvatarFileUrl){
  var lfriend= new Friend(friendObjectId, friendUsername, friendAvatarFileUrl);
  lfriend.make();
  lfriend.show();
}
function closeFriendAction(id){
  unHideSiteMainBody();
	if(id!=null){
    document.getElementById(id).innerHTML = "";
		document.getElementById(id).style.display = "none";
	}
}

function toggleFriendship(userId, toggleId) {
  var action = "toggle_friendship";
  var ajax = ajaxObj("POST", "parse.api.custom.addon.php");
  ajax.onreadystatechange = function() {
    if(ajaxReturn(ajax) == true) {
      var dataArray = ajax.responseText.split("|");
      var responseCode = dataArray[0].trim();
      if(dataArray[1]){
        var responseMessage = dataArray[1].trim();
      } else {
        showAlert("Action Failed", ajax.responseText, "", "");
        return false;
      }
      
      if( responseCode != "action_success") {
        showAlert("Action Failed", responseMessage, "", "");
      } else {
        if (responseMessage == 'added_friend') {
          document.getElementById( toggleId ).src = 'images/design.android.material/ic_remove_circle_outline_24px.svg';
          var currentUserUId = <?php echo '"'.$parse_current_user_uid.'"';?>;
          var currentUserU = <?php echo '"'.$parse_current_user_u.'"';?>;
          sendSinglePushNotification(userId, currentUserUId , currentUserU, currentUserU + ' added you as a friend. You will only receive ' + currentUserU +"'s messages if you add, too.");                        
        } else if(responseMessage == 'removed_friend') {
          document.getElementById( toggleId ).src = 'images/design.android.material/ic_add_circle_outline_24px.svg';
        }
      }
    }
  }
  ajax.send("action="+action+"&user_id="+userId);   
}

function unFriend(userId) {
  var action = "toggle_friendship";
  document.getElementById( "unFriend"+userId ).disabled = true;
  document.getElementById( "unFriend"+userId ).innerHTML = 'Unfriending...';
  var ajax = ajaxObj("POST", "parse.api.custom.addon.php");
  ajax.onreadystatechange = function() {
    if(ajaxReturn(ajax) == true) {
      var dataArray = ajax.responseText.split("|");
      var responseCode = dataArray[0].trim();
      if(dataArray[1]){
        var responseMessage = dataArray[1].trim();
      } else {
        showAlert("Action Failed", ajax.responseText, "", "");
        return false;
      }
      
      if( responseCode != "action_success") {
        showAlert("Action Failed", responseMessage, "", "");
      } else {
        if(responseMessage == 'removed_friend') {
          document.getElementById( "unFriend"+userId ).disabled = true;
          document.getElementById( "friend"+userId ).style.display = "none";
          document.getElementById( "goMessage"+userId ).style.display = "none";
          document.getElementById( "dialogboxhead"+userId ).style.background = "#ea5f51";
          document.getElementById( "unFriend"+userId ).style.background = "#ea5f51";
          document.getElementById( "unFriend"+userId ).innerHTML = 'Removed Friend';
        }
      }
    }
  }
  ajax.send("action="+action+"&user_id="+userId);   
}
</script>