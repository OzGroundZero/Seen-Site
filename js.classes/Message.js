function Message(messageObjectId, messageSender, messageDate, messageType, messageRecipientsString, messageFileUrl){
	this.messageObjectId = messageObjectId;	
  this.messageSender = messageSender;
  this.messageDate = messageDate;
  this.messageType = messageType;
  this.messageTextData = document.getElementById("messageTextData"+messageObjectId).innerHTML;
  this.messageRecipientsString = messageRecipientsString;
	this.messageId = Math.floor(Math.random() * 99999999999)+111111;
  this.messageFileUrl = messageFileUrl;
}
Message.prototype.makeShowMessage = function(){
  this.message = '<div id="'+this.messageId+'">';
    this.message += '<div class="message_modal_holder" onclick="closeMessage(&#39;'+this.messageId+'&#39;)">';
    this.message += '</div>';
    this.message += '<div id="alertModal" class="message_modal border_cacaca_1px">';      
      this.message += '<div id="dialogbox">';
        this.message += '<div>';
          this.message += '<div id="dialogboxhead" class="padding_20px text_color_white background_color_caribbean_green" style="position:relative; top:0; z-index:9999">';
            this.message += 'From <strong>'+this.messageSender+'</strong>';
            if(this.messageRecipientsString){
              this.message += '<br>To <strong>'+this.messageRecipientsString+'</strong>';
            }
            this.message += '<a class="a_button background_transparent text_color_white margin_5px text_weight_bolder text_size_20px" style="position: relative; left: 0; float: left; top: -15px;" onclick="closeMessage(&#39;'+this.messageId+'&#39;)">X</a>';
          this.message += '</div>';
          this.message += '<div id="dialogboxbody" class="background_color_white text_color_grey808080 margin_10px text_size_18px">'+this.messageTextData+'</div>';
          this.message += '<div id="dialogboxbody" class="background_color_white text_color_grey808080 margin_10px">';
            if(this.messageType== "image" ){
              this.message += '<img style="max-width:100%; max-height: 500px;" src="'+this.messageFileUrl+'" alt="Message File">';
            } else if(this.messageType== "video" ){
              this.message += '<video max-width="100%" max-height="auto" autoplay loop="loop" controls>';
                this.message += '<source src="'+this.messageFileUrl+'" type="video/mp4">';
              this.message += '<p>Your browser does not support the video tag</p>.';
              this.message += '</video>';
            } 
          this.message += '</div>';
          this.message += '<div id="dialogboxfoot" class="margin_top_50px">';
            
          this.message += '</div>';
        this.message += '</div>';
      this.message += '</div>';
    this.message += '</div>';
  this.message += '</div>';
this.message += '</div></div>';
}
Message.prototype.makeDeleteMessage = function(){
  this.message = '<div id="'+this.messageId+'">';
    this.message += '<div class="message_modal_holder" onclick="closeMessage(&#39;'+this.messageId+'&#39;)">';
    this.message += '</div>';
    this.message += '<div id="alertModal" class="message_modal border_cacaca_1px"  style="height:auto;">';      
      this.message += '<div id="dialogbox">';
        this.message += '<div>';
          this.message += '<div id="dialogboxhead" class="padding_20px text_color_white background_color_red" style="position:relative; top:0; z-index:9999">';
            this.message += 'Confirm Action<br><br><strong class="text_size_18px">Permanently Delete Your Message?<br>Your TruFriends <strong>'+this.messageRecipientsString+'</strong> won&#39;t see it again.</strong>';
            this.message += '<div class="100_wide">';
              this.message += '<a class="a_button background_color_white text_color_green p-btn margin_5px" onclick="closeMessage(&#39;'+this.messageId+'&#39;)">No. Keep it!</a>';
              this.message += '<a id="tempModalButtonDeleteMessage'+this.messageId+'" class="a_button background_color_white text_color_red p-btn margin_5px" style="border-radius:3.5px; position:relative; bottom:0;" onclick="destroyMessage(&#39;'+this.messageObjectId+'&#39;, &#39;'+this.messageId+'&#39;)">Destroy it!</a>';
            this.message += '</div>';
            this.message += '<a class="a_button background_transparent text_color_red margin_5px text_weight_bolder text_size_20px" style="position: relative; left: 0; float: left; top: -15px;" onclick="closeMessage(&#39;'+this.messageId+'&#39;)">X</a>';
          this.message += '</div>';
          this.message += '<div id="dialogboxbody" class="background_color_white text_color_grey808080 margin_10px text_size_18px">'+this.messageTextData+'</div>';
          this.message += '<div id="dialogboxbody" class="background_color_white text_color_grey808080 margin_10px">';
            if(this.messageType== "image" ){
              this.message += '<img style="max-width:100%; max-height: 500px;" src="'+this.messageFileUrl+'" alt="Message File">';
            } else if(this.messageType== "video" ){
              this.message += '<video max-width="100%" max-height="auto" autoplay controls>';
                this.message += '<source src="'+this.messageFileUrl+'" type="video/mp4">';
              this.message += 'Your browser does not support the videos.';
              this.message += '</video>';
            } 
          this.message += '</div>';
          this.message += '<div id="dialogboxfoot" class="margin_top_50px" style="right:0; float:right;">';
            
          this.message += '</div>';
        this.message += '</div>';
      this.message += '</div>';
    this.message += '</div>';
  this.message += '</div>';
this.message += '</div></div>';
}
Message.prototype.makeHideMessage = function(){
  this.message = '<div id="'+this.messageId+'">';
    this.message += '<div class="message_modal_holder" onclick="closeMessage(&#39;'+this.messageId+'&#39;)">';
    this.message += '</div>';
    this.message += '<div id="alertModal" class="message_modal border_cacaca_1px"  style="height:auto;">';      
      this.message += '<div id="dialogbox">';
        this.message += '<div>';
          this.message += '<div id="dialogboxhead" class="padding_20px text_color_white background_color_red" style="position:relative; top:0; z-index:9999">';
            this.message += 'Confirm Action<br><br><strong class="text_size_18px">Hide Message?<br>Your won&#39;t be able to see it again.</strong>';
            this.message += '<div class="100_wide">';
              this.message += '<a class="a_button background_color_white text_color_green p-btn margin_5px" onclick="closeMessage(&#39;'+this.messageId+'&#39;)">Cancel</a>';
              this.message += '<a id="tempModalButtonHideMessage'+this.messageId+'" class="a_button background_color_white text_color_red p-btn margin_5px" style="border-radius:3.5px; position:relative; bottom:0;" onclick="hideMessage(&#39;'+this.messageObjectId+'&#39;, &#39;'+this.messageId+'&#39;)">Hide it!</a>';
            this.message += '</div>';
            this.message += '<a class="a_button background_transparent text_color_red margin_5px text_weight_bolder text_size_20px" style="position: relative; left: 0; float: left; top: -15px;" onclick="closeMessage(&#39;'+this.messageId+'&#39;)">X</a>';
          this.message += '</div>';
          this.message += '<div id="dialogboxbody" class="background_color_white text_color_grey808080 margin_10px text_size_18px">'+this.messageTextData+'</div>';
          this.message += '<div id="dialogboxbody" class="background_color_white text_color_grey808080 margin_10px">';
            if(this.messageType== "image" ){
              this.message += '<img style="max-width:100%; max-height: 500px;" src="'+this.messageFileUrl+'" alt="Message File">';
            } else if(this.messageType== "video" ){
              this.message += '<video max-width="100%" max-height="auto" autoplay controls>';
                this.message += '<source src="'+this.messageFileUrl+'" type="video/mp4">';
              this.message += 'Your browser does not support the videos.';
              this.message += '</video>';
            } 
          this.message += '</div>';
          this.message += '<div id="dialogboxfoot" class="margin_top_50px" style="right:0; float:right;">';
            
          this.message += '</div>';
        this.message += '</div>';
      this.message += '</div>';
    this.message += '</div>';
  this.message += '</div>';
this.message += '</div></div>';
}
Message.prototype.show = function(){
  hideSiteMainBody();
  document.getElementById("dynamicPopupDiv").innerHTML = this.message;
}

function showMessage(messageId, messageSender, messageDate, messageType, messageRecipientsString, messageFileUrl, actionCode){
  if(actionCode == "9326s"){
    //show the message
    var lmessage= new Message(messageId, messageSender, messageDate, messageType, messageRecipientsString, messageFileUrl);
    lmessage.makeShowMessage();
    lmessage.show();
  } else if(actionCode == "9305d"){
    //destroy the message
    var lmessage= new Message(messageId, messageSender, messageDate, messageType, messageRecipientsString, messageFileUrl);
    lmessage.makeDeleteMessage();
    lmessage.show();
  } else if(actionCode == "9902h"){
    //destroy the message
    var lmessage= new Message(messageId, messageSender, messageDate, messageType, messageRecipientsString, messageFileUrl);
    lmessage.makeHideMessage();
    lmessage.show();
  }
}
function closeMessage(id){
  unHideSiteMainBody();
  if(id!=null){
    document.getElementById(id).innerHTML = "";
    document.getElementById(id).style.display = "none";
  }
}

function destroyMessage(messageId, tempModalId){
  var action = "delete_message";
  document.getElementById('tempModalButtonDeleteMessage'+tempModalId).disabled = true;
  document.getElementById('tempModalButtonDeleteMessage'+tempModalId).innerHTML = 'deleting...';
  var ajax = ajaxObj("POST", "parse.api.custom.addon.php");
        ajax.onreadystatechange = function() {
          if(ajaxReturn(ajax) == true) {
            var dataArray = ajax.responseText.split("|");
            var responseCode = dataArray[0].trim();
            var responseMessage = dataArray[1].trim();
            if( responseCode != "action_success") {
              showAlert("Action Failed", responseMessage, "", "");
              document.getElementById('tempModalButtonDeleteMessage'+tempModalId).disabled = false;
              document.getElementById('tempModalButtonDeleteMessage'+tempModalId).innerHTML = 'Retry Destruction';
            } else {
              showAlert("Action Success", responseMessage, "", "");
              document.getElementById("message"+messageId).style.background = "#e74c3c";
              document.getElementById("deleteMessage"+messageId).style.display = "none";
              document.getElementById("showMessage"+messageId).style.cursor = 'auto';
              document.getElementById("showMessage"+messageId).disabled = true;
              document.getElementById("message"+messageId).style.color = "#ffffff"; //For real browsers;
            }
          }
        }
        ajax.send("action="+action+"&message_id="+messageId);
}
function hideMessage(messageId, tempModalId){
  var action = "hide_message";
  document.getElementById('tempModalButtonHideMessage'+tempModalId).disabled = true;
  document.getElementById('tempModalButtonHideMessage'+tempModalId).innerHTML = 'hiding...';
  var ajax = ajaxObj("POST", "parse.api.custom.addon.php");
  ajax.onreadystatechange = function() {
    document.getElementById('tempModalButtonHideMessage'+tempModalId).innerHTML = 'hiding2...';
    if(ajaxReturn(ajax) == true) {
      document.getElementById('tempModalButtonHideMessage'+tempModalId).innerHTML = 'hiding3...';
      var dataArray = ajax.responseText.split("|");
      var responseCode = dataArray[0].trim();
      var responseMessage = dataArray[1].trim();
      if( responseCode != "action_success") {
        document.getElementById('tempModalButtonHideMessage'+tempModalId).innerHTML = 'hiding4...';
        showAlert("Action Failed", responseMessage, "", "");
        document.getElementById('tempModalButtonHideMessage'+tempModalId).disabled = false;
        document.getElementById('tempModalButtonHideMessage'+tempModalId).innerHTML = 'Retry Hide';
      } else {
        document.getElementById('tempModalButtonHideMessage'+tempModalId).innerHTML = 'hiding5...';
        showAlert("Action Success", responseMessage, "", "");
        document.getElementById("message"+messageId).style.background = "#e74c3c";
        document.getElementById("message"+messageId).style.color = "#ffffff";
        document.getElementById("hideMessage"+messageId).style.display = "none";
        document.getElementById("showMessage"+messageId).style.cursor = 'auto';
        document.getElementById("showMessage"+messageId).disabled = true;
      }
    }
  }
  ajax.send("action="+action+"&message_id="+messageId);
}


