<?php 
include("php.loaders/gallery/gallery.home.php");
$thisIsHomeGalleryPage = true;
?>
<style type="text/css">
.seen_image_container{
	display:inline-block;
}
.seen_image{
	width:300px;
	height:300px;
	border-radius: 100%;
	display:inline-block;
}
.seen_image:hover{
	position:fixed;
	width:60%;
	height:60%;
}


/*--responsive design--*/
@media (max-width:1024px){
	.gallery_list{
		width:33%;
	}
}
@media screen and (max-width: 991px) {
	.gallery_list{
		width:33%;
	}
}
@media screen and (max-width: 767px) {
	.gallery_list{
		width:50%;
	}
}
@media screen and (max-width: 479px) {
	.gallery_list{
		width:100%;
	}
}
@media (max-width:320px){
	.gallery_list{
		width:100%;
	}
}
</style>
<div class="margin_bottom_50px margin_0px">
	<div style="width:66%; display:inline-block; position:fixed; right:0">
		<div id="welcomeInfo" class="container background_color_white padding_20px ">
			<h2>Seen <?php echo $site_logo_med;?> </h2>
			<h3>
				Capture Life & Carry On, 
				<?php echo ucfirst( $parse_current_user->get('username') );?>
			</h3>
			<br><br>
			<!--Pagenation button-->
		<div id="load_more_button_holder">
			<a id="load_more_button" class="a_button p-btn text_color_white background_color_red" 
					style="margin-top:20px"
				onclick="loadMorePhotos()">
				Load More
			</a>
		</div>
		<!--END PAGENTAION BUTTON-->
			<p class="text_smaller">Please understand that by using this application, you give up claim to privacy.</p>
		</div>
		<div class="container background_color_white padding_10px">
			<div id="popup_img_container">
				<img id="popupImg" style="z-index:50">
				<h4 id="popupImgDate"></h4>
			</div>
		</div>
	</div>
	<div style="width:33%; display:inline-block">
		<ul id="images_list" class="enlarge" onmouseout="popupSeen('', '')">
			<?php echo $images;?>
			
		</ul>
		<div id="open_img" class="padding_10px" style="margin-top:20px; display:none">
			<div id="opened_img_action_container" class="padding_5px background_color_white">
				
			</div>
			<br>
			<div id="opened_img_comments_container" class="padding_5px background_color_white">
			</div>
			<a class="a_button p-btn text_color_white background_color_red" 
				style="margin-top:20px"
			onclick="openPhoto('','')">Back to All Photos</a>
		</div>
		<?php include_once("php.templates/site.footer.php");?>
	</div>
</div>
<script type="text/javascript">var lastLoaded = 5;</script>
<style type="text/css">
.comment_button{
	  background: #21B8C6;
	  color: #FFF;
	  text-transform: uppercase;
	  width: 32px;
	  height: 32px;
	  padding: 5px;
	  margin-left:10px;
	  display: inline-block;
	  border-radius: 100%;
	  font-size: 1em;
	  cursor: pointer;
	  transition: all 1000ms ease;
	  /*webkit-box-shadow: 0px 2px 10px rgba(0,0,0,.3),0px 0px 1px rgba(0,0,0,.1),inset 0px 1px 0px rgba(255,255,255,.25),inset 0px -1px 0px rgba(0,0,0,.15);
	  -moz-box-shadow: 0px 2px 10px rgba(0,0,0,.3),0px 0px 1px rgba(0,0,0,.1),inset 0px 1px 0px rgba(255,255,255,.25),inset 0px -1px 0px rgba(0,0,0,.15);
	  box-shadow: 0px 2px 10px rgba(0,0,0,.3),0px 0px 1px rgba(0,0,0,.1),inset 0px 1px 0px rgba(255,255,255,.25),inset 0px -1px 0px rgba(0,0,0,.15);*/
}
</style>
<script type="text/javascript">
	var photoOpened = false;
	var loadingMorePhotos = false;
	function popupSeen(url, date){
		var welcomeInfo = document.getElementById('welcomeInfo');

		var popupImgContainer = document.getElementById('popup_img_container');
		var popupImg = document.getElementById('popupImg');
		var popupDate = document.getElementById('popupImgDate');

		if(url==""){
			if(!photoOpened){ 
				welcomeInfo.style.display = "block";
				popupImgContainer.style.display = "none"; 
			}
		}
		else {
			welcomeInfo.style.display = "none";
			popupImgContainer.style.display = "inline-block";
			popupImg.src = url;
			popupDate.innerHTML= date;
		}
	}
	function openPhoto(url,imageId){
		var imagesList = document.getElementById('images_list');
		var loadMoreButton = document.getElementById('load_more_button');

		var image_action_container = document.getElementById('seen_image_actions_container'+imageId);
		var imageComments = document.getElementById('seen_image_comments'+imageId);
		var popupImgContainer = document.getElementById('popup_img_container');
		var popupImg = document.getElementById('popupImg');
		var popupDate = document.getElementById('popupImgDate');
		
		var openImgDiv = document.getElementById('open_img');
		var openImgActionContainer = document.getElementById('opened_img_action_container');
		var openImgCommentsContainer = document.getElementById('opened_img_comments_container');

		if(!loadingMorePhotos){
			if(imageId==""){ 
				photoOpened = false;
				openImgDiv.style.display = "none";
				imagesList.style.display = "block";
				loadMoreButton.style.display = "block";

				welcomeInfo.style.display = "block";
				popupImgContainer.style.display = "none"; 
			} else {
				photoOpened = true;
				welcomeInfo.style.display = "none";
				imagesList.style.display = "none";
				loadMoreButton.style.display = "none";

				openImgDiv.style.display = "block";
				//openImgActionContainer.innerHTML = image_action_container.innerHTML;
				openImgActionContainer.style.display="none";

				openImgCommentsContainer.innerHTML = '<form onsubmit="return false">';
					openImgCommentsContainer.innerHTML += '<input id="sendCommentText" style="border:none; padding:5px; margin:5px; border:2px solid #bdc3c7" type="text" placeholder="Comment ..."/>';
					openImgCommentsContainer.innerHTML += '<img id="sendCommentButton" class="comment_button" style="display:inline-block; position:relative; top:5px" onclick="sendComment(\''+imageId+'\')" src="images/design.android.material/ic_send_24px.svg">';
				openImgCommentsContainer.innerHTML += '</form><br>';
				openImgCommentsContainer.innerHTML += imageComments.innerHTML;

				popupImgContainer.style.display = "inline-block";

				popupImg.src = url;
				welcomeInfo.style.display = "none";
				popupImgContainer.style.display = "inline-block";
			}
		}
	}
</script>