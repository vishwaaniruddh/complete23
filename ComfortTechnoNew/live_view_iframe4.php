<?php 
  $iframesrc = $_GET['url'];
?>
<div id="loader_4" class="loader_gif"></div>
<iframe id="iframe4" name="4" class="frame" src="<?php echo $iframesrc;?>" scrolling="no" title="PinHole" frameborder="2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

<script>
    const iframe4 = document.getElementById("iframe4");
	iframe4.addEventListener("load", function() {
		$("#loader_4").hide();
	});
    if($("#iframe4").contents().find("body").length) { 
		
	}
  
	$('#iframe4').on('load', function(){ 
	   //  $("#loader_4").hide();
	   // $("#iframe1").contentWindow.location.reload(true);
	  //  $("#video-container1").css("visibility", "hidden");
     // document.getElementById("camera1").html = "";
    });
</script>
