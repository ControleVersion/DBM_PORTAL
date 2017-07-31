$('#video-mask').click(function(){
	var video = $(this).next();
	debugger

	video.autoPlayVideo('Eo34X39KouU','460','315');

	function autoPlayVideo(vcode, width, height){
  		"use strict";
  		$("#videoContainer").html('<iframe width="'+width+'" height="'+height+'" src="https://www.youtube.com/embed/'+vcode+'?autoplay=1&loop=1&rel=0&wmode=transparent" frameborder="0" allowfullscreen wmode="Opaque"></iframe>');
	}

	// // Load the IFrame Player API code asynchronously.
 //  	var tag = document.createElement('script');
	// tag.src = "https://www.youtube.com/player_api";
	// var firstScriptTag = document.getElementsByTagName('script')[0];
	// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	// // Replace the 'ytplayer' element with an <iframe> and
	// // YouTube player after the API code downloads.
	// var player;
	// function onYouTubePlayerAPIReady() {
	// player = new YT.Player('ytplayer', {
	//   height: '360',
	//   width: '640',
	//   videoId: 'M7lc1UVf-VE'
	// });
	// }
});
