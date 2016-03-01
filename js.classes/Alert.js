function Alert(alertTitle, alertMessage, alertType, alertLocation){
	this.alertTitle = alertTitle;
	this.alertMessage = alertMessage;
	this.alertId = Math.floor(Math.random() * 99999999999)+111111;
  this.alertLocation = alertLocation;
}
Alert.prototype.make = function(){
  if( this.alertLocation !="" ){
    //if there is a specified location to put the alert, make it absolutely position and a transparent background filter
  	this.alert = '<div id="'+this.alertId+'" style="position:absolute; width:auto">';
    this.alert += '<div class="site_nav_modal_holder" style="background:transparent">';
    this.alert += '</div>';
  } else {
    this.alert = '<div id="'+this.alertId+'">';
    this.alert += '<div class="site_nav_modal_holder">';
    this.alert += '</div>';
  }
  

    this.alert += '<div id="alertModal" class="site_nav_modal background_color_white border_cacaca_1px"  style="height:auto;">';      
      this.alert += '<div id="dialogbox">';
          this.alert += '<div id="dialogboxhead" class="padding_20px text_color_white background_color_caribbean_green" style="position:relative; top:0; z-index:9999">';
            this.alert += this.alertTitle;
            this.alert += '<a class="a_button background_transparent text_color_white margin_5px text_weight_bolder" style="position: relative; left: 0; float: left; top: -15px;" onclick="closeMessage(&#39;'+this.alertId+'&#39;)">X</a>';
          this.alert += '</div>';
          this.alert += '<div id="dialogboxbody" class="background_color_white text_color_grey808080 margin_10px">';
            this.alert += this.alertMessage;
          this.alert += '</div>';
          this.alert += '<div id="dialogboxfoot" class="margin_top_50px">';
          this.alert += '</div>';
      this.alert += '</div>';
    this.alert += '</div>';
  this.alert += '</div>';
}
Alert.prototype.show = function(){
  //append the alert to the document
	if(this.alertLocation!=""){
     document.getElementById(this.alertLocation).innerHTML = this.alert + document.getElementById(this.alertLocation).innerHTML;
  } else {
    document.getElementById("dynamicPopupDiv").innerHTML = this.alert;
  }
}

function showAlert(alertTitle, alertMessage, alertType, alertLocation){
  var lAlert= new Alert(alertTitle, alertMessage, alertType, alertLocation);
  lAlert.make();
  lAlert.show();
}
function closeAlert(id){
  unHideSiteMainBody();
	if(id!=null){
    document.getElementById(id).innerHTML = "";
		document.getElementById(id).style.display = "none";
	}
}

