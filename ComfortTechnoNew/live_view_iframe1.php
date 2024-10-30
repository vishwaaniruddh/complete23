<?php 
  $iframesrc = $_GET['url'];
?>
<div id="loader_1" class="loader_gif"></div>
<iframe id="iframe1" name="1" class="frame" src="<?php echo $iframesrc;?>" scrolling="no" title="Lobby" frameborder="2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

<script>
const iframe1 = document.getElementById("iframe1");
iframe1.addEventListener("load", function() {
    $("#loader_1").hide();
});
if($("#iframe1").contents().find("body").length) { 
		
	}
$('#iframe1').on('load', function(){ 
	   //  $("#loader_1").hide();
	   // $("#iframe1").contentWindow.location.reload(true);
	  //  $("#video-container1").css("visibility", "hidden");
     // document.getElementById("camera1").html = "";
    });
</script>