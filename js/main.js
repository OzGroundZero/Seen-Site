$(document).ready(function(){



    //mobile menu toggling
    $("#menu_icon").click(function(){
        $("header nav ul").toggleClass("show_menu");
        $("#menu_icon").toggleClass("close_menu");
        return false;
    });

    

    //Contact Page Map Centering
    var hw = $('header').width() + 50;
    var mw = $('#map').width();
    var wh = $(window).height();
    var ww = $(window).width();

    $('#map').css({
        "max-width" : mw,
        "height" : wh
    });

    if(ww>1100){
         $('#map').css({
            "margin-left" : hw
        });
    }

   



    //Tooltip
    $("a").mouseover(function(){

        var attr_title = $(this).attr("data-title");

        if( attr_title == undefined || attr_title == "") return false;
        
        $(this).after('<span class="tooltip"></span>');

        var tooltip = $(".tooltip");
        tooltip.append($(this).data('title'));

         
        var tipwidth = tooltip.outerWidth();
        var a_width = $(this).width();
        var a_hegiht = $(this).height() + 3 + 4;

        //if the tooltip width is smaller than the a/link/parent width
        if(tipwidth < a_width){
            tipwidth = a_width;
            $('.tooltip').outerWidth(tipwidth);
        }

        var tipwidth = '-' + (tipwidth - a_width)/2;
        $('.tooltip').css({
            'left' : tipwidth + 'px',
            'bottom' : a_hegiht + 'px'
        }).stop().animate({
            opacity : 1
        }, 200);
       

    });

    $("a").mouseout(function(){
        var tooltip = $(".tooltip");       
        tooltip.remove();
    });


});

function _(x){
  return document.getElementById(x);
}
function clickOn(x){
  document.getElementById(x).click();
}
function hideSiteMainBody(){
  document.getElementById('siteMainBody').style.display="none";
}
function unHideSiteMainBody(){
  document.getElementById('siteMainBody').style.display="initial";
}
function hideDynamicPopupDiv(){
  document.getElementById('dynamicPopUpDiv').style.display="none";
}
function unHideDynamicPopupDiv(){
  document.getElementById('dynamicPopupDiv').style.display="initial";
}

function toggleElement(x){
  var z = _(x);
  if(z.style.display == 'block'){
    z.style.display = 'none';
  } else{
    if(x=="siteNavNotifications"){
      z.style.display="block";
    } else {
      if(x=="siteNavSearch"){
        z.style.display="block";
        _("site_search_input").focus();
      } else {
        z.style.display = 'block';
      } 
    }
  }
}

function toggleElementInlineBlock(x){
  var z = _(x);
  if(z.style.display == 'inline-block'){
    z.style.display = 'none';
  } else{
    if(x=="siteNavNotifications"){
      z.style.display="inline-block";
    } else {
      if(x=="siteNavSearch"){
        z.style.display="block";
        _("site_search_input").focus();
      } else {
        z.style.display = 'inline-block';
      } 
    }
  }
}


function toggleElement2(x,y){
  if(document.getElementById(x).style.display=="none"){
    document.getElementById(x).style.display="block";
    document.getElementById(y).style.display="none";
  } else if(document.getElementById(y).style.display=="none"){
    document.getElementById(y).style.display="block";
    document.getElementById(x).style.display="none";
  } 
}

function toggleElementInlineBlock2(x,y){
  if(document.getElementById(x).style.display=="none"){
    document.getElementById(x).style.display="inline-block";
    document.getElementById(y).style.display="none";
  } else if(document.getElementById(y).style.display=="none"){
    document.getElementById(y).style.display="inline-block";
    document.getElementById(x).style.display="none";
  } 
}

function toggleElement3(x,y,z){
  if(document.getElementById(x).style.display=="none"){
    document.getElementById(x).style.display="block";
    document.getElementById(y).style.display="none";
    document.getElementById(z).style.display="none";
  } else if(document.getElementById(y).style.display=="none"){
    document.getElementById(y).style.display="block";
    document.getElementById(x).style.display="none";
    document.getElementById(z).style.display="none";
  } else if(document.getElementById(z).style.display=="none"){
    document.getElementById(z).style.display="block";
    document.getElementById(x).style.display="none";
    document.getElementById(y).style.display="none";
  } 
}

function toggleElementInlineBlock3(x,y,z){
  if(document.getElementById(x).style.display=="none"){
    document.getElementById(x).style.display="inline-block";
    document.getElementById(y).style.display="none";
    document.getElementById(z).style.display="none";
  } else if(document.getElementById(y).style.display=="none"){
    document.getElementById(y).style.display="inline-block";
    document.getElementById(x).style.display="none";
    document.getElementById(z).style.display="none";
  } else if(document.getElementById(z).style.display=="none"){
    document.getElementById(z).style.display="inline-block";
    document.getElementById(x).style.display="none";
    document.getElementById(y).style.display="none";
  } 
}

function toggleElement4(w,x,y,z){
  if(document.getElementById(x).style.display=="none"){
    document.getElementById(x).style.display="block";
    document.getElementById(y).style.display="none";
    document.getElementById(z).style.display="none";
    document.getElementById(w).style.display="none";
  } else if(document.getElementById(y).style.display=="none"){
    document.getElementById(y).style.display="block";
    document.getElementById(x).style.display="none";
    document.getElementById(z).style.display="none";
    document.getElementById(w).style.display="none";
  } else if(document.getElementById(z).style.display=="none"){
    document.getElementById(z).style.display="block";
    document.getElementById(x).style.display="none";
    document.getElementById(y).style.display="none";
    document.getElementById(w).style.display="none";
  } else if(document.getElementById(w).style.display=="none"){
    document.getElementById(w).style.display="block";
    document.getElementById(x).style.display="none";
    document.getElementById(y).style.display="none";
    document.getElementById(z).style.display="none";
  } 
}

function toggleElementInlineBlock4(w,x,y,z){
  if(document.getElementById(w).style.display=="none"){
    document.getElementById(w).style.display="inline-block";
    document.getElementById(x).style.display="none";
    document.getElementById(y).style.display="none";
    document.getElementById(z).style.display="none";
  } else if(document.getElementById(x).style.display=="none"){
    document.getElementById(x).style.display="inline-block";
    document.getElementById(y).style.display="none";
    document.getElementById(z).style.display="none";
    document.getElementById(w).style.display="none";
  } else if(document.getElementById(y).style.display=="none"){
    document.getElementById(y).style.display="inline-block";
    document.getElementById(x).style.display="none";
    document.getElementById(z).style.display="none";
    document.getElementById(w).style.display="none";
  } else if(document.getElementById(z).style.display=="none"){
    document.getElementById(z).style.display="inline-block";
    document.getElementById(x).style.display="none";
    document.getElementById(y).style.display="none";
    document.getElementById(w).style.display="none";
  }
}

//this function takes 4 element id arguments, but unlike the toggle functions, 
//this function displays the first argument inline-block and hides all the others no matter the state of the 1st element
function displayElementInlineBlock4(w,x,y,z){
  document.getElementById(w).style.display="inline-block";
  document.getElementById(x).style.display="none";
  document.getElementById(y).style.display="none";
  document.getElementById(z).style.display="none";
}

function togglePostForms(x){
  if(x=="newSalePost"){
    _("newHousingPost").style.display="none";
    _("newSalePost").style.display="inline-block";
  } else if(x=="newHousingPost"){
    _("newSalePost").style.display="none";
    _("newHousingPost").style.display="inline-block";
  }
}


function addItemMax(field, maxlimit, maxlimit) {
  var usedChars=field.value.length;
  var result= parseInt(maxlimit)-parseInt(usedChars);
  if (field.value.length > maxlimit){
    _("photo_form_status").innerHTML="<span class='text_smaller' style='color:red'>"+result+"</span>";
    /*field.value = field.value.substring(0, maxlimit);*/
  } else if (field.value.length <= maxlimit){
    _("photo_form_status").innerHTML="<span class='text_smaller' style='color:green'>"+result+"</span>";
  }
}

function textAreaMax(field, maxlimit, status){
  var usedChars=document.getElementById(field).value.length;
  var result= parseInt(maxlimit)-parseInt(usedChars);
  if (usedChars> maxlimit){
    _(status).innerHTML="<span class='text_smaller' style='color:red'>"+result+"</span>";
    _(status).innerHTML="<span class='text_smaller' style='color:red'>"+result+"</span>";
    /*field.value = field.value.substring(0, maxlimit);*/
  } else if (usedChars <= maxlimit){
    _(status).innerHTML="<span class='text_smaller' style='color:green'>"+result+"</span>";
    _(status).innerHTML="<span class='text_smaller' style='color:green'>"+result+"</span>";
  }
}


function addingItem(){
  
}

function closeAllModals(){
  if(_("site_nav_drop_down_menu").style.left!="-85px"){
    _("site_nav_drop_down_menu").style.left="-85px";
  } else {
    _("site_nav_drop_down_menu").style.left= "-9999px";
  }
  
  document.getElementById("siteNavAboutUser").style.display="none";
}

function showsignupexp(type){
    _(type).style.visibility="visible";
  if(type!="studentsignupexp"){
    _('studentsignupexp').style.visibility="hidden";
  }
  if(type!="localsignupexp"){
    _('localsignupexp').style.visibility="hidden";
  }
  if(type!="signupfaq"){
    _('signupfaq').style.visibility="hidden";
  }

}

function statusMax(field, maxlimit) {
  var result= parseInt(maxlimit)-field.value.length;
  if (field.value.length > maxlimit){
    _("postStatus").innerHTML="<span class='text_color_white text_smaller'>"+result+"</span>";
  } else {
    _("postStatus").innerHTML="<span class='text_color_white text_smaller'>"+result+"</span>";
  }
}

function editStatusMax(field, maxlimit) {
  var result= parseInt(maxlimit)-field.value.length;
  if (field.value.length > maxlimit){
    _("editStatusActionStatus").innerHTML="<span class='text_color_red text_smaller'>"+result+"</span>";
  } else {
    _("editStatusActionStatus").innerHTML="<span class='text_smaller'>"+result+"</span>";
  }
}

function replyStatusMax(field, statusid, maxlimit) {
  var result= parseInt(maxlimit)-field.value.length;
  if (field.value.length > maxlimit){
    _("replyStatus_"+statusid).innerHTML="<span class='text_color_red text_smaller'>"+result+"</span>";
  } else {
    _("replyStatus_"+statusid).innerHTML="<span class='text_color_white text_smaller'>"+result+"</span>";
  }
}

function highlightReplyButton(sid,ta, colorHex, maxlength){
  var data = _(ta).value;
  var replyButton='replyBtn_'+sid;
  var replyButtonHolder='replyBtn_'+sid+'_holder';
  if(data.length>maxlength){
    _(replyButton).style.backgroundColor= '#e74c3c';
    _(replyButtonHolder).style.backgroundColor= '#e74c3c';
    document.getElementById(replyButton).style.WebkitTransition = 'background 1s';
    document.getElementById(replyButton).style.MozTransition = 'background 1s';
  } else if(data.length>0){
    _(replyButton).style.backgroundColor= colorHex;
    _(replyButtonHolder).style.backgroundColor= colorHex;
    document.getElementById(replyButton).style.WebkitTransition = 'background 1s';
    document.getElementById(replyButton).style.MozTransition = 'background 1s';

    document.getElementById(replyButtonHolder).style.WebkitTransition = 'background 1s';
    document.getElementById(replyButtonHolder).style.MozTransition = 'background 1s';
  } else {
    _(replyButton).style.backgroundColor= "#f0f0f0";
    _(replyButtonHolder).style.backgroundColor= "#f0f0f0";
  }
}


function clickStatusButtonOnEnter(e){
  // look for window.event in case event isn't passed in
  if (typeof e == 'undefined' && window.event) { e = window.event; }
  if (e.keyCode == 13 && !e.shiftKey) { e.preventDefault(); document.getElementById('statusBtn').click(); }
}
function clickReplyButtonOnEnter(e, sid){
  //sid is the id of the status the user is responding to
  // look for window.event in case event isn't passed in
  if (typeof e == 'undefined' && window.event) { e = window.event; }
  if (e.keyCode == 13 && !e.shiftKey) { e.preventDefault(); document.getElementById("replyBtn_"+sid).click(); }
}

function clickOptionAnchorClick(boxId, type, location) {
  var selectBox = document.getElementById(boxId);
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  if(type=="navigateToShopShelf"){
    window.location='shop?shlf='+selectedValue.trim();
  } else if(type=="navigateToUserShelf"){
    window.location='user.php?u='+location+'&shlf='+selectedValue.trim();
  } 
}

window.onload = function(unhideMenuLeft){
  document.getElementById('menu-left').style.display='';
}

$("a[href='#__']").click(
  function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  }
);

$("#semail").keyup(
  function(event){
    if(event.keyCode == 13){
      $("#studentsignupbtn").click();
    }
  }
);
$("#spass1").keyup(
  function(event){
    if(event.keyCode == 13){
      $("#studentsignupbtn").click();
    }
  }
);

$("#lemail").keyup(
  function(event){
    if(event.keyCode == 13){
      $("#localsignupbtn").click();
    }
  }
);
$("#lpass1").keyup(
  function(event){
    if(event.keyCode == 13){
      $("#localsignupbtn").click();
    }
  }
);


$("#loginemail").keyup(
  function(event){
    if(event.keyCode == 13){
      $("#loginbtn").click();
    }
  }
);
$("#loginpassword").keyup(function(event){
    if(event.keyCode == 13){
        $("#loginbtn").click();
    }
});





