<?php 
  $iframesrc = $_GET['url'];
?>
<div id="loader_2" class="loader_gif"></div>
<iframe id="iframe2" name="2" class="frame" src="<?php echo $iframesrc;?>" scrolling="no" title="Backroom" frameborder="2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

<script>
   const iframe2 = document.getElementById("iframe2");
	iframe2.addEventListener("load", function() {
		$("#loader_2").hide();
	});
   if($("#iframe2").contents().find("body").length) { 
		
	}
  $('#iframe2').on('load', function(){ 
	    // $("#loader_2").hide();
	   // $("#iframe1").contentWindow.location.reload(true);
	  //  $("#video-container1").css("visibility", "hidden");
     // document.getElementById("camera1").html = "";
    });
</script>