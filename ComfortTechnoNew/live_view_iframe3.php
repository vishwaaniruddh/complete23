<?php 
  $iframesrc = $_GET['url'];
?>
<div id="loader_3" class="loader_gif"></div>
<iframe id="iframe3" name="3" class="frame" src="<?php echo $iframesrc;?>" scrolling="no" title="Outdoor" frameborder="2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
<script>
const iframe3 = document.getElementById("iframe3");
	iframe3.addEventListener("load", function() {
		$("#loader_3").hide();
	});
    if($("#iframe3").contents().find("body").length) { 
		
	}
   $('#iframe3').on('load', function(){ //alert('hi');
	    // $("#loader_3").hide();
	   // $("#iframe1").contentWindow.location.reload(true);
	  //  $("#video-container1").css("visibility", "hidden");
     // document.getElementById("camera1").html = "";
    });
</script>