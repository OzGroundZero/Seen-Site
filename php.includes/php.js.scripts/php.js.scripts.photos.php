<?php /**************Item Specific JS Functions**************/;?>
<script type="text/javascript">
  <?php /*Send*/;?>
  function clickBidButtonOnEnter(e, photoId){
    // look for window.event in case event isn't passed in
    if (typeof e == 'undefined' && window.event) { e = window.event; }
    if (e.keyCode == 13 && !e.shiftKey) { e.preventDefault(); document.getElementById('bidbtn'+photoId).click(); }
  }

  function loadMorePhotos(){
    loadingMorePhotos = true;
    var pagenationDiv = document.getElementById("images_list");
    var loadMoreButtonHolder = document.getElementById('load_more_button_holder');
    var loadMoreButton = loadMoreButtonHolder.innerHTML;
    var currentPhotos = pagenationDiv.innerHTML;

    loadMoreButtonHolder.innerHTML = "<a class='p-btn text_smaller' style='cursor:wait'>Loading More</a>";
    var ajax = ajaxObj("POST", "index.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        var dataArray = ajax.responseText.split("|");
        var responseCode = dataArray[0].trim();
        var responseText = dataArray[1].trim();


        if(responseCode == "success"){
          var dataArrayInfo = responseText.split("@seen");
          var responseTextInfo = dataArrayInfo[0].trim();
          var responseTextData = dataArrayInfo[1].trim();

          pagenationDiv.innerHTML = currentPhotos + responseTextInfo;
          loadMoreButtonHolder.innerHTML = loadMoreButton;
          lastLoaded = responseTextData;
          //loadMorePhotos();//recurse
        } else if(responseCode == "done"){
          loadMoreButtonHolder.innerHTML = "<a class='p-btn background_color_green text_small' style='cursor:pointer' onclick='location.reload();'>No More. Refresh Page</a>";
        } else {
          loadMoreButtonHolder.innerHTML = ajax.responseText;
        }
        loadingMorePhotos = false;
      } else {
        loadMoreButtonHolder.innerHTML = loadMoreButton;
        loadingMorePhotos = false;
      }
    }
    ajax.send("photo_pagenate=true&last_loaded="+lastLoaded);   
  }

  function likePhoto(photoId){
    var photoLikeBtnImg = document.getElementById("likebtn_img"+photoId);
    var photoLikesCount = document.getElementById("photo_likes"+photoId);

    var ajax = ajaxObj("POST", "index.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        var dataArray = ajax.responseText.split("|");
        var responseCode = dataArray[0].trim();
        var currentLikes = dataArray[1].trim();

        if(responseCode == "liked"){
          photoLikeBtnImg.src = "images/design.android.material/ic_favorite_red_24px.svg";
          photoLikesCount.innerHTML = currentLikes;
        } else if(responseCode == "disliked"){
          photoLikeBtnImg.src = "images/design.android.material/ic_favorite_grey_24px.svg";
          photoLikesCount.innerHTML = currentLikes;
        } else {
          alert(ajax.responseText);
        }
      }
    }
    ajax.send("photo_like=true&photo_id="+photoId);   
  }

  function sendComment(photoId){
    var button = document.getElementById("sendCommentButton");
    var comment = document.getElementById("sendCommentText").value;
    var imageComments = document.getElementById('seen_image_comments'+photoId);
    var openedImgCommentsContainer = document.getElementById('opened_img_comments_container');

    if(comment!=""){
      button.disabled = true;
      var ajax = ajaxObj("POST", "index.php");
      ajax.onreadystatechange = function() {
        if(ajaxReturn(ajax) == true) {
          button.disabled = false;
          if(ajax.responseText == "success"){
            imageComments.innerHTML += '<p>'+comment+'</p>';
            openedImgCommentsContainer.innerHTML += '<p>'+comment+'</p>';
            comment = "";
          } else {
            //showAlert("Comment Error", ajax.responseText, "", "");
            openedImgCommentsContainer.innerHTML += '<p>'+comment+' <span class="text_smaller" style="color:red;">(did not send)</span></p>';  
          }
        }
      }
      ajax.send("photo_comment="+comment+"&photo_id="+photoId); 
    }
  }

  <?php /*START Doubletap item*/;?>
  var myLatestItemMiddleTap;
  function doubleTapItem(itemId) {
    var now = new Date().getTime();
    var timesince = now - myLatestItemMiddleTap;
    if((timesince < 600) && (timesince > 0)){
      // double tap
      document.getElementById("likebtn"+itemId).click();
    } else {
      // too much time to be a doubletap
      document.getElementById("openImgBtn"+itemId).click();
    }

    myLatestItemMiddleTap = new Date().getTime();
  }
  <?php /*END Doubletap on sale item*/;?>
</script>