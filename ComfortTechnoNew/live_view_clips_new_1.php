<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head_liveView.php');
	$url = "http://" . $_SERVER['SERVER_NAME'] ;
    $url = rtrim($url,"/");
   ?>
	
	<style>
	
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
				border-right: 1px solid #282844;
		  }
		   div.card-body {
		/*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px;  
			height: 210px; */
			/*overflow-x: hidden;
			overflow-y: scroll; */
			text-align:justify;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
		.videoplay_msg{
			display:none;
		}
		#camera1 { width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera2 { width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera3 { width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera4 { width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		
		#camera1 iframe{ width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera2 iframe{ width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera3 iframe{ width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera4 iframe{ width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		
		#camera1 iframe img{ width: 100% !important;height:200px !important;}
		#camera2 iframe img{ width: 100% !important;height:200px !important;}
		#camera3 iframe img{ width: 100% !important;height:200px !important;}
		#camera4 iframe img{ width: 100% !important;height:200px !important;}
		
		
@media (min-width: 768px)
.col-md-5 {
    flex: 0 0 41.66667%;
    max-width: 35.66667%; !important;
}

@media screen and (max-width:900px) {
    .card-body {
        height: auto   OR  0px !important;
        padding-bottom: 0px;
    }
#camera1 iframe{
height: 20vh;
}
#stopCamera1{
padding-right: 0px;
}
#camera2 iframe{
height: 20vh;
}
#stopCamera2{
padding-right: 0px;
}
#camera3 iframe{
height: 20vh;
}
#stopCamera3{
padding-right: 0px;
}
#camera4 iframe{
height: 20vh;
}
#stopCamera4{
padding-right: 0px;
}
}
		
	</style>
 <?php include('top-navbar.php');?>   
   <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        
<div class="col-12 grid-margin">
<h3 class="card-title">Live View</h3>
              <div class="card">
                <div class="card-body">
                    <input type="hidden" id="url_link" value="<?php echo $url;?>">
                 
                    <?php include('filters/sitehealth_filter.php');?>
					
					       
    <!--<video src="" id="video" autoplay muted playsinline></video>-->
					              
					            <div class="row">
								    <!--<div class="sortblock col-md-1 form-group"></div>--> 
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera1">Video will stop automatically after <span id="progressBar1"></span> seconds</h6> 
										<h6 class="videoplay_msg" id="net_issue_cam1"></h6> 
                                        <input type="hidden" id="camurl_1">
										<input type="hidden" id="dvr_ip">
										<div id="camera1_iframe" style="display:none;"></div>
										<div class="card form-group">
										    
                                            <div class="card-header" id="cameraheading-1" role="tab">
                                                Lobby Camera 
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera1" onclick="startCamera(1)">
												
												</span>
												
											</div>
											
                                            <div class="card-body" id="camera1" style="height: 300px;padding-top:0px;">
											   <video id="myvideo" width="100%" height="300" muted autoplay playsinline><source src="" type="video/mp4"></video>
                                            </div>
                                        </div>
                                    </div>
									<!--<div class="sortblock col-md-1 form-group"></div> -->
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera2">Video will stop automatically after <span id="progressBar2"></span> seconds</h6> 
                                        <h6 class="videoplay_msg" id="net_issue_cam2"></h6>                                        
									   <input type="hidden" id="camurl_2">
										<div id="camera1_iframe2" style="display:none;"></div>
										<div class="card">
                                            <div class="card-header" id="cameraheading-2" role="tab">
                                                Backroom Camera
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera2" onclick="startCamera(2)">
												
												</span>
												
                                            </div>
                                            <div class="card-body" id="camera2" style="height: 300px;padding-top:0px;">
											   <video id="myvideo2" width="100%" height="300" muted autoplay playsinline><source src="" type="video/mp4"></video>
                                            </div>
                                        </div>
                                    </div>
									
                                    
                                </div>
								
								<div class="row">
								    <!--<div class="sortblock col-md-1 form-group"></div> -->
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera3">Video will stop automatically after <span id="progressBar3"></span> seconds</h6> 
                                        <h6 class="videoplay_msg" id="net_issue_cam3"></h6> 
										<input type="hidden" id="camurl_3">
										<div id="camera1_iframe3" style="display:none;"></div>
										<div class="card form-group">
                                            <div class="card-header" id="cameraheading-3" role="tab">
                                                Outdoor Camera
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera3" onclick="startCamera(3)">
												
												</span>
												
                                            </div>
                                            <div class="card-body" id="camera3" style="height: 300px;padding-top:0px;">
											    <video id="myvideo3" width="100%" height="300" muted autoplay playsinline><source src="" type="video/mp4"></video>
                                            </div>
                                        </div>
                                    </div>
									<!--<div class="sortblock col-md-1 form-group"></div> -->
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera4">Video will stop automatically after <span id="progressBar4"></span> seconds</h6> 
                                        <h6 class="videoplay_msg" id="net_issue_cam4"></h6>                                        
									   <input type="hidden" id="camurl_4">

										<div id="camera1_iframe4" style="display:none;"></div>
										<div class="card">
                                            <div class="card-header" id="cameraheading-4" role="tab">
                                                Pinhole Camera
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera4" onclick="startCamera(4)">
												 
												</span>
												
                                            </div>
                                            <div class="card-body" id="camera4" style="height: 300px;padding-top:0px;">
											   <video id="myvideo4" width="100%" height="300" muted autoplay playsinline><source src="" type="video/mp4"></video>
                                            </div>
                                        </div>
                                    </div>
									
                                    
                                </div>
					
					
                    </div>
                   </div>
                 
                </div>
              </div>
</div>
                    </div>
                    <?php include('footer.php');?>
                </div>
            </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/select2.js"></script>
        <script src="vendors/video-js/video.min.js">
		
        </script>
<script language="javascript" >
	var video_array = new Array();
	var video_array2 = new Array();
	var video_array3 = new Array();
	var video_array4 = new Array();
	var activeVideo = 0;
	var activeVideo2 = 0;
	var activeVideo3 = 0;
	var activeVideo4 = 0;
		var v = new Array();
		var v = [
	  "test/172.55.24.223_1_1.mp4","test/172.55.24.223_1_2.mp4","test/172.55.24.223_1_3.mp4","test/172.55.24.223_1_4.mp4","test/172.55.24.223_1_5.mp4","test/172.55.24.223_1_6.mp4",
	  "test/172.55.24.223_1_7.mp4","test/172.55.24.223_1_8.mp4","test/172.55.24.223_1_9.mp4","test/172.55.24.223_1_10.mp4","test/172.55.24.223_1_11.mp4","test/172.55.24.223_1_12.mp4"
	  ];
     
   
	var activeMyVideo = 0;
	var vidElem = document.getElementById('myvideo');
	
	//if(activeMyVideo<=12){
    vidElem.addEventListener('ended', function(e) { debugger; 
	   // file_exists();
		//alert(activeMyVideo);
      //set_StopInterval(1,false);
      activeMyVideo = (++activeMyVideo) % video_array.length;
      if(activeMyVideo >= video_array.length){
        video_array.splice(0, video_array.length);
      }else{
		  vidElem.src = video_array[activeMyVideo];
          vidElem.play();
	  }
      
    });
	
	var activeMyVideo2 = 0;
	var vidElem2 = document.getElementById('myvideo2');
	
	//if(activeMyVideo<=12){
    vidElem2.addEventListener('ended', function(e) { debugger; 
	   // file_exists();
		//alert(activeMyVideo);
      //set_StopInterval(1,false);
      activeMyVideo2 = (++activeMyVideo2) % video_array2.length;
      if(activeMyVideo2 >= video_array2.length){
        video_array2.splice(0, video_array2.length);
      }else{
		  vidElem2.src = video_array2[activeMyVideo2];
          vidElem2.play();
	  }
      
    });
	
	var activeMyVideo3 = 0;
	var vidElem3 = document.getElementById('myvideo3');
	
	//if(activeMyVideo<=12){
    vidElem3.addEventListener('ended', function(e) { debugger; 
	   // file_exists();
		//alert(activeMyVideo);
      //set_StopInterval(1,false);
      activeMyVideo3 = (++activeMyVideo3) % video_array3.length;
      if(activeMyVideo3 >= video_array3.length){
        video_array3.splice(0, video_array3.length);
      }else{
		  vidElem3.src = video_array3[activeMyVideo3];
          vidElem3.play();
	  }
      
    });
	
	var activeMyVideo4 = 0;
	var vidElem4 = document.getElementById('myvideo4');
	
	//if(activeMyVideo<=12){
    vidElem4.addEventListener('ended', function(e) { debugger; 
	   // file_exists();
		//alert(activeMyVideo);
      //set_StopInterval(1,false);
      activeMyVideo4 = (++activeMyVideo4) % video_array4.length;
      if(activeMyVideo4 >= video_array4.length){
        video_array4.splice(0, video_array4.length);
      }else{
		  vidElem4.src = video_array4[activeMyVideo4];
          vidElem4.play();
	  }
      
    });
	
	vidElem.onloadeddata = function() {
		//set_StopInterval(1,true);
	};
	
	 vidElem.addEventListener('onload', function(e) {
            
    });
	//}
	
    function file_exists(){
		var n = activeMyVideo + 1;
		var dvrip = $('#dvr_ip').val();;
		var channel = 1;
		$.ajax({
			url: "api/get_liveview_videos.php",
			method: 'POST',
            data: {'n': n,'dvrip': dvrip, 'channel': channel},			
			dataType: "json",
			success: (function (result) { debugger;
			   
			   var objCode = result[0].code;
			   if(objCode==200){
				    activeMyVideo = (++activeMyVideo) % video_array.length;
					if(activeMyVideo >= video_array.length){
						video_array.splice(0, video_array.length);
					}else{
						vidElem.src = video_array[activeMyVideo];
						vidElem.play();
					}
			   }
			})
		});
	}
  
    function changeVid(n){ debugger;
		var video = document.getElementById('myvideo');
		//var video = document.getElementById('camera1');
      //  activeVideo++;
		video.setAttribute("src", video_array[n]);
        if(n==0){
			
			$('#startCamera1').css('display','block');
			$("#stop_camera1").css('display','block');
			set_StopInterval(1);
		}
		video.load();
	}
	
	
	
	//setInterval(play_video,20000);
	
	var play_video_count = 0;
	//var vidElem = document.getElementById('myvideo');
	function play_video() { debugger;
       // var vidElem = document.getElementById('myvideo');
		//var video = document.getElementById('camera1');
      //  activeVideo++;
	  //  alert(activeMyVideo); 
	  
	    play_video_count++;
	    var n = 1;
		var dvrip = $('#dvr_ip').val();;
		var channel = 1;
		$.ajax({
			url: "api/get_liveview_videos.php",
			method: 'POST',
            data: {'n': n,'dvrip': dvrip, 'channel': channel},			
			dataType: "json",
			success: (function (result) { debugger;
			   
			   var objCode = result[0].code;
			   if(objCode==200){
				    vidElem.setAttribute("src", video_array[0]);
					if(n==1){
						$('#startCamera1').css('display','block');
						$("#stop_camera1").css('display','block');
					}
					$("#load").hide();
					vidElem.load();
					set_StopInterval(1);
			   }else{
				   if(play_video_count<=500){
				   play_video();
				   }else{
					  $("#load").hide();
					  $('#net_issue_cam1').html('Network Issue. Refresh it and try again');
                     // alert("Network Issue. Refresh it and try again");					  
				   }
			   }
			})
		});
	}
	
	var play_video_count2 = 0;
	//var vidElem = document.getElementById('myvideo');
	function play_video2() { debugger;
        play_video_count2++;
	    var n = 1;
		var dvrip = $('#dvr_ip').val();;
		var channel = 2;
		$.ajax({
			url: "api/get_liveview_videos.php",
			method: 'POST',
            data: {'n': n,'dvrip': dvrip, 'channel': channel},			
			dataType: "json",
			success: (function (result) { debugger;
			   
			   var objCode = result[0].code;
			   if(objCode==200){
				    vidElem2.setAttribute("src", video_array2[0]);
					if(n==1){
						$('#startCamera2').css('display','block');
						$("#stop_camera2").css('display','block');
					}
					$("#load").hide();
					vidElem2.load();
					set_StopInterval(2);
			   }else{
				   if(play_video_count2<=120){
				   play_video2();
				   }else{
					   $("#load").hide();
					  $('#net_issue_cam2').html('Network Issue. Refresh it and try again'); 
				   }
			   }
			})
		});
	}
	
	var play_video_count3 = 0;
	//var vidElem = document.getElementById('myvideo');
	function play_video3() { debugger;
        play_video_count3++;
	    var n = 1;
		var dvrip = $('#dvr_ip').val();;
		var channel = 3;
		$.ajax({
			url: "api/get_liveview_videos.php",
			method: 'POST',
            data: {'n': n,'dvrip': dvrip, 'channel': channel},			
			dataType: "json",
			success: (function (result) { debugger;
			   
			   var objCode = result[0].code;
			   if(objCode==200){
				    vidElem3.setAttribute("src", video_array3[0]);
					if(n==1){
						$('#startCamera3').css('display','block');
						$("#stop_camera3").css('display','block');
					}
					$("#load").hide();
					vidElem3.load();
					set_StopInterval(3);
			   }else{
				   if(play_video_count3<=120){
				   play_video3();
				   }else{
					  $("#load").hide();
					  $('#net_issue_cam3').html('Network Issue. Refresh it and try again');  
				   }
			   }
			})
		});
	}
	
	var play_video_count4 = 0;
	//var vidElem = document.getElementById('myvideo');
	function play_video4() { debugger;
        play_video_count4++;
	    var n = 1;
		var dvrip = $('#dvr_ip').val();;
		var channel = 4;
		$.ajax({
			url: "api/get_liveview_videos.php",
			method: 'POST',
            data: {'n': n,'dvrip': dvrip, 'channel': channel},			
			dataType: "json",
			success: (function (result) { debugger;
			   
			   var objCode = result[0].code;
			   if(objCode==200){
				    vidElem4.setAttribute("src", video_array4[0]);
					if(n==1){
						$('#startCamera4').css('display','block');
						$("#stop_camera4").css('display','block');
					}
					$("#load").hide();
					vidElem4.load();
					set_StopInterval(4);
			   }else{
				   if(play_video_count4<=120){
				     play_video4();
				   }else{
					   $("#load").hide();
					  $('#net_issue_cam4').html('Network Issue. Refresh it and try again'); 
				   }
			   }
			})
		});
	}

	/*
	function play_video() { debugger;
		activeVideo++;
		var dvrip = $('#dvr_ip').val();;
		var channel = 1;
		$.ajax({
			url: "api/get_liveview_videos.php",
			method: 'POST',
            data: {'n': activeVideo,'dvrip': dvrip, 'channel': channel},			
			dataType: "json",
			success: (function (result) { debugger;
			   $("#load").hide();
			   var objCode = result[0].code;
			   if(objCode==200){
				   $("#camera1").html('<video id="myvideo" width="100%" height="300" controls muted autoplay loop playsinline><source src="" type="video/mp4"></video>');
				   
				  video_array.push(result[0].path);
				   var keyval = parseInt(result[0].n);
				   var key =  keyval - 1;
				   changeVid(key);
			   }else{
				   $("#camera1").html('');
			   }
			    
			})
		})
	};  */
</script>
        <script>
		/*
		$('#startCamera1').click(function(){
			var cam = $('#camurl_1').val();
			startCamera(1,cam);
			setStopInterval(1);
			$("#stop_camera1").css("display","block");
			$("#stopCamera1").css("display","block");
			$("#stop_camera1").css("display","block");
		}); */
		
		function startCamera(id){
			var cam = $('#camurl_'+id).val();
			$("#camera"+id).html('');
			$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 33vh;width: 100%;display:block;" scrolling="no"></iframe>');
			setStopInterval(id);
			$("#stop_camera"+id).css("display","block");
			$("#stopCamera"+id).css("display","block");
			$("#stop_camera"+id).css("display","block");
		}
		function stopCamera(id){
			$("#camera"+id).html('');
			$("#stop_camera"+id).css("display","none");
			if(id==1){
			timeleft_1 = 0;
			clearInterval(downloadTimer_1);
			$("#progressBar"+id).html(timeleft_1) ;
			}
			if(id==2){
			timeleft_2 = 0;
			clearInterval(downloadTimer_2);
			$("#progressBar"+id).html(timeleft_2) ;
			}
			if(id==3){
			timeleft_3 = 0;
			clearInterval(downloadTimer_3);
			$("#progressBar"+id).html(timeleft_3) ;
			}
			if(id==4){
			timeleft_4 = 0;
			clearInterval(downloadTimer_4);
			$("#progressBar"+id).html(timeleft_4) ;
			}
		}
		var timeleft_1 = 90;
		var downloadTimer_1 = "";
		var timeleft_2 = 90;
		var downloadTimer_2 = "";
		var timeleft_3 = 90;
		var downloadTimer_3 = "";
		var timeleft_4 = 90;
		var downloadTimer_4 = "";
		
		function set_StopInterval(id){ debugger;
			if(id==1){
				if(timeleft_1>0){
					   clearInterval(downloadTimer_1);
					   timeleft_1 = 90;
					
				}
				downloadTimer_1 = setInterval(function(){
					  if(timeleft_1 <= 0){
						clearInterval(downloadTimer_1);
						timeleft_1 = 90;
					  }
                      
					   timeleft_1 -= 1;
						  if(timeleft_1==0){
							stopCamera(id);
						  }
						   if(timeleft_1>=0){
						   $("#progressBar"+id).html(timeleft_1) ;
						   }
					 
					  console.log(timeleft_1);
					}, 1000);
			}
			
			if(id==2){
				if(timeleft_2>0){
					   clearInterval(downloadTimer_2);
					   timeleft_2 = 90;
					
				}
				downloadTimer_2 = setInterval(function(){
					  if(timeleft_2 <= 0){
						clearInterval(downloadTimer_2);
						timeleft_2 = 90;
					  }
                      
					   timeleft_2 -= 1;
						  if(timeleft_2==0){
							stopCamera(id);
						  }
						   if(timeleft_2>=0){
						   $("#progressBar"+id).html(timeleft_2) ;
						   }
					 
					  console.log(timeleft_2);
					}, 1000);
			}
			
			if(id==3){
				if(timeleft_3>0){
					   clearInterval(downloadTimer_3);
					   timeleft_3 = 90;
					
				}
				downloadTimer_3 = setInterval(function(){
					  if(timeleft_3 <= 0){
						clearInterval(downloadTimer_3);
						timeleft_3 = 90;
					  }
                      
					   timeleft_3 -= 1;
						  if(timeleft_3==0){
							stopCamera(id);
						  }
						   if(timeleft_3>=0){
						   $("#progressBar"+id).html(timeleft_3) ;
						   }
					 
					  console.log(timeleft_3);
					}, 1000);
			}
			
			if(id==4){
				if(timeleft_4>0){
					   clearInterval(downloadTimer_4);
					   timeleft_4 = 90;
					
				}
				downloadTimer_4 = setInterval(function(){
					  if(timeleft_4 <= 0){
						clearInterval(downloadTimer_4);
						timeleft_4 = 90;
					  }
                      
					   timeleft_4 -= 1;
						  if(timeleft_4==0){
							stopCamera(id);
						  }
						   if(timeleft_4>=0){
						   $("#progressBar"+id).html(timeleft_4) ;
						   }
					 
					  console.log(timeleft_4);
					}, 1000);
			}
		}
		
		function setStopInterval(id){
			if(id==1){
				timeleft_1 = 120;
				downloadTimer_1 = setInterval(function(){
					  if(timeleft_1 <= 0){
						clearInterval(downloadTimer_1);
					  }

					  timeleft_1 -= 1;
					  
					  if(timeleft_1==0){
						stopCamera(id);
					  }
					   if(timeleft_1>=0){
					   $("#progressBar"+id).html(timeleft_1) ;
					   }
					  console.log(timeleft_1);
					}, 1000);
			}
			if(id==2){
				timeleft_2 = 120;
				downloadTimer_2 = setInterval(function(){
					  if(timeleft_2 <= 0){
						clearInterval(downloadTimer_2);
					  }

					  timeleft_2 -= 1;
					  
					  if(timeleft_2==0){
						stopCamera(id);
					  }
					   if(timeleft_2>=0){
					   $("#progressBar"+id).html(timeleft_2) ;
					   }
					  console.log(timeleft_2);
					}, 1000);
			}
			if(id==3){
				timeleft_3 = 120;
				downloadTimer_3 = setInterval(function(){
					  if(timeleft_3 <= 0){
						clearInterval(downloadTimer_3);
					  }

					  timeleft_3 -= 1;
					  
					  if(timeleft_3==0){
						stopCamera(id);
					  }
					   if(timeleft_3>=0){
					   $("#progressBar"+id).html(timeleft_3) ;
					   }
					  console.log(timeleft_3);
					}, 1000);
			}
			if(id==4){
				timeleft_4 = 120;
				downloadTimer_4 = setInterval(function(){
					  if(timeleft_4 <= 0){
						clearInterval(downloadTimer_4);
					  }

					  timeleft_4 -= 1;
					  
					  if(timeleft_4==0){
						stopCamera(id);
					  }
					   if(timeleft_4>=0){
					   $("#progressBar"+id).html(timeleft_4) ;
					   }
					  console.log(timeleft_4);
					}, 1000);
			}
		}
		$("#show_detail").click(function(){
			var atmid = $('#AtmID').val();
			if(atmid==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			//setcamera(atmid);
			vidElem.setAttribute("src","");
			video_array = [];
			set_Camera(atmid);
		});
		
		function set_Camera(atmid){
			var Client = 'Hitachi';
			var Bank = 'PNB';
			var AtmID = $("#AtmID").val();
			if(Bank==''){
				swal("Oops!", "Bank Must Required !", "error");
				return false;
			}
			if(AtmID==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			var url_link = $('#url_link').val();
			$("#load").show();
			$.ajax({
				url: "live_view_ajax.php", 
				type: "POST",
				data: {bank:Bank,atmid:AtmID,client:Client},
				success: (function (result) { debugger;
				    console.log(result);
				    var obj = JSON.parse(result);
				    
					var dvrip = obj[0].dvrip;
					$('#dvr_ip').val(dvrip);
					
					var dvr_model_1 = obj[0].cam1;
					var dvr_model_2 = obj[0].cam2;
					var dvr_model_3 = obj[0].cam3;
					var dvr_model_4 = obj[0].cam4;
					
					var username_1 = obj[0].username1;
					var username_2 = obj[0].username2;
					var username_3 = obj[0].username3;
					var username_4 = obj[0].username4;
					
					var password_1 = obj[0].password1;
					var password_2 = obj[0].password2;
					var password_3 = obj[0].password3;
					var password_4 = obj[0].password4;
					
					var port_1 = obj[0].port1;
					var port_2 = obj[0].port2;
					var port_3 = obj[0].port3;
					var port_4 = obj[0].port4;
					
					//var routerip = obj[0].RouterIP;
					//var current_status = obj.live;
					var port = "554";
					var cam_type_1 = "";var cam_type_2 = "";var cam_type_3 = "";var cam_type_4 = "";
					if(dvr_model_1=='uniview'){
						cam_type_1 = "nvr";
					}
					else if(dvr_model_1=='Hikvision_Nvr'){
						cam_type_1 = "nvr";
					}
					else{
						cam_type_1 = "dvr";
					}
					if(dvr_model_2=='uniview'){
						cam_type_2 = "nvr";
					}
					else if(dvr_model_2=='Hikvision_Nvr'){
						cam_type_2 = "nvr";
					}
					else{
						cam_type_2 = "dvr";
					}
					if(dvr_model_3=='uniview'){
						cam_type_3 = "nvr";
					}
					else if(dvr_model_3=='Hikvision_Nvr'){
						cam_type_3 = "nvr";
					}
					else{
						cam_type_3 = "dvr";
					}
					if(dvr_model_4=='uniview'){
						cam_type_4 = "nvr";
					}
					else if(dvr_model_4=='Hikvision_Nvr'){
						cam_type_4 = "nvr";
					}
					else{
						cam_type_4 = "dvr";
					}
					
					
					if(url_link=='http://192.168.100.23'){
						
					}else{
						url_link = "http://103.141.218.26";
					}
					
					var ips = ["10.109.64.25", "10.109.64.23", "10.109.64.21", "10.109.64.24","172.55.20.136","10.109.64.27","10.185.181.126","172.55.23.252","10.109.64.18","10.137.0.60","10.109.64.20"];
                    var is_rtsp_1 = 0;var is_rtsp_2 = 0;var is_rtsp_3 = 0;var is_rtsp_4 = 0;
					if(ips.includes(dvrip)){
						is_rtsp_1 = 1;
						is_rtsp_2 = 1;
						is_rtsp_3 = 1;
						is_rtsp_4 = 1;
					}
					if(dvr_model_1=='CPPLUS_INDIGO' || dvr_model_1=='CPPLUS'){
						is_rtsp_1 = 1;
					}
					if(dvr_model_2=='CPPLUS_INDIGO' || dvr_model_2=='CPPLUS'){
						is_rtsp_2 = 1;
					}
					if(dvr_model_3=='CPPLUS_INDIGO' || dvr_model_3=='CPPLUS'){
						is_rtsp_3 = 1;
					}
					if(dvr_model_4=='CPPLUS_INDIGO' || dvr_model_4=='CPPLUS'){
						is_rtsp_4 = 1;
					}
					
					if(is_rtsp_1==1){
						var cam1 = url_link+":5026/?name="+username_1+"-"+password_1+"-"+dvrip+"-"+port_1+"-"+dvr_model_1+"-"+cam_type_1+"-1";
						
					}else{
					
						var cam1 = url_link+":5022/?name="+username_1+"-"+password_1+"-"+dvrip+"-"+port_1+"-"+dvr_model_1+"-"+cam_type_1+"-1";
						
					}
					
					if(is_rtsp_2==1){
						var cam2 = url_link+":5027/?name="+username_2+"-"+password_2+"-"+dvrip+"-"+port_2+"-"+dvr_model_2+"-"+cam_type_2+"-2";
						
					}else{
					
						var cam2 = url_link+":5023/?name="+username_2+"-"+password_2+"-"+dvrip+"-"+port_2+"-"+dvr_model_2+"-"+cam_type_2+"-2";
						
					}
					
					if(is_rtsp_3==1){
						var cam3 = url_link+":5028/?name="+username_3+"-"+password_3+"-"+dvrip+"-"+port_3+"-"+dvr_model_3+"-"+cam_type_3+"-3";
						
					}else{
					    var cam3 = url_link+":5024/?name="+username_3+"-"+password_3+"-"+dvrip+"-"+port_3+"-"+dvr_model_3+"-"+cam_type_3+"-3";
						
					}
					
					if(is_rtsp_4==1){
						var cam4 = url_link+":5029/?name="+username_4+"-"+password_4+"-"+dvrip+"-"+port_4+"-"+dvr_model_4+"-"+cam_type_4+"-4";
					}else{
					    var cam4 = url_link+":5025/?name="+username_4+"-"+password_4+"-"+dvrip+"-"+port_4+"-"+dvr_model_4+"-"+cam_type_4+"-4";
					}
					
					var new_cam = url_link+":5030/?name="+username_1+"-"+password_1+"-"+dvrip+"-"+port_1+"-"+dvr_model_1+"-"+cam_type_1+"-1";
					console.log(new_cam);
					//hit_url(new_cam);
					$("#camera1_iframe").html('<iframe src="'+ new_cam + '" title="description" style="height: 33vh;width: 100%" scrolling="no"></iframe>');
					//setInterval(play_video,10000);
					//$('#startCamera1').css('display','block');
                    
					$('#net_issue_cam1').html('');
					$('#net_issue_cam2').html('');
					$('#net_issue_cam3').html('');
					$('#net_issue_cam4').html('');
					
					var channel = 1;
                   for(var i=1;i<=18;i++){ 
						//var video_full_url = "test/172.55.24.223_1_"+i+".mp4";
						var video_full_url = "img/"+dvrip+"_"+channel+"_"+i+".mp4";
						video_array.push(video_full_url);
					}
					
					
					var new_cam2 = url_link+":5031/?name="+username_2+"-"+password_2+"-"+dvrip+"-"+port_2+"-"+dvr_model_2+"-"+cam_type_2+"-2";
					$("#camera1_iframe2").html('<iframe src="'+ new_cam2 + '" title="description" style="height: 33vh;width: 100%" scrolling="no"></iframe>');
					
                    var channel2 = 2;
                   for(var i=1;i<=18;i++){ 
						
						var video_full_url2 = "img/"+dvrip+"_"+channel2+"_"+i+".mp4";
						video_array2.push(video_full_url2);
					}
					
					var new_cam3 = url_link+":5032/?name="+username_3+"-"+password_3+"-"+dvrip+"-"+port_3+"-"+dvr_model_3+"-"+cam_type_3+"-3";
					$("#camera1_iframe3").html('<iframe src="'+ new_cam3 + '" title="description" style="height: 33vh;width: 100%" scrolling="no"></iframe>');
					
                    var channel3 = 3;
                   for(var i=1;i<=18;i++){ 
						
						var video_full_url = "img/"+dvrip+"_"+channel3+"_"+i+".mp4";
						video_array3.push(video_full_url);
					}
					
					var new_cam4 = url_link+":5033/?name="+username_4+"-"+password_4+"-"+dvrip+"-"+port_4+"-"+dvr_model_4+"-"+cam_type_4+"-4";
					$("#camera1_iframe4").html('<iframe src="'+ new_cam4 + '" title="description" style="height: 33vh;width: 100%" scrolling="no"></iframe>');
					
                    var channel4 = 4;
                   for(var i=1;i<=18;i++){ 
						
						var video_full_url = "img/"+dvrip+"_"+channel4+"_"+i+".mp4";
						video_array4.push(video_full_url);
					}
                    
					
					var startTime = new Date().getTime();
					var interval = setInterval(function(){
						if(new Date().getTime() - startTime > 5100){
							clearInterval(interval);
							return false;
						}
						play_video();
						play_video2();
						play_video3();
						play_video4();
						
					}, 5000);  
				})
		    });
		}
		
		function hit_url(url){ debugger;
			$.ajax({
				url: url,
				method: 'GET',
				success: (function (result) { 
				
				})
			});
		}
		
		    function setcamera(atmid){
				if(atmid=='P3ENMM09'){
				  var cam1 = "http://103.141.218.26:5020/?name=1";
				  $("#camera1").html('<iframe src="'+ cam1 + '" title="description" style="height: 350px;width: 100%;"></iframe>');
				 
				  $("#camera").html('<option value="">Select Camera</option><option value="http://103.141.218.26:5020/?name=2">Camera 2</option><option value="http://103.141.218.26:5020/?name=3">Camera 3</option><option value="http://103.141.218.26:5020/?name=4">Camera 4</option>');
				  $("#camurl_1").val("http://103.141.218.26:5020/?name=1");
				  $("#camurl_2").val("http://103.141.218.26:5020/?name=2");
				  $("#camurl_3").val("http://103.141.218.26:5020/?name=3");
				  $("#camurl_4").val("http://103.141.218.26:5020/?name=4");
				  setStopInterval(1);
				  $("#stop_camera1").css('display','block');
				  $('#startCamera1').css('display','block');
				  $('#stopCamera1').css('display','block');
				  $('#startCamera2').css('display','block');
				  $('#stopCamera2').css('display','block');
				  $('#startCamera3').css('display','block');
				  $('#stopCamera3').css('display','block');
				  $('#startCamera4').css('display','block');
				  $('#stopCamera4').css('display','block');
				}
			}
			
			function setextracamera(id,cam){
				$("#camera"+id).html('');
				$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 350px;width: 100%;"></iframe>');
			}
			$("#camera").change(function(){ 
				var cam = $("#camera").val();
				
				var cam_heading= $("#camera option:selected").text();
				
				var arr = cam_heading.split(' ');
				var id = arr[1];
				$('#cameraheading-'+id).html('');
				$('#cameraheading-'+id).html(cam_heading);
				$("#camera"+id).html('');
				$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 350px;width: 100%;"></iframe>');
				
			});
		
	
            function chngeSort(Value)
            {

                if (Value==4) 
                {

                $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-6');
                $('.sortblock').removeClass('col-md-12');

                $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort6').removeClass('text-muted');
                $("#sort6").addClass('text-white');
                $('#sort12').removeClass('text-muted');
                $("#sort12").addClass('text-white');


                
                } 

                if (Value==6) 
                {
                     $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-4');
                $('.sortblock').removeClass('col-md-12');

                 $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort4').removeClass('text-muted');
                $("#sort4").addClass('text-white');
                $('#sort12').removeClass('text-muted');
                $("#sort12").addClass('text-white');

                } 

                if (Value==12) 
                {
                       $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-4');
                $('.sortblock').removeClass('col-md-6');

                $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort4').removeClass('text-muted');
                $("#sort4").addClass('text-white');
                $('#sort6').removeClass('text-muted');
                $("#sort6").addClass('text-white');
                }

                
            }
        </script>
		<script>
    function dashboard_panel() {
		$.ajax({
			url: "dashboard_panel.php", 
			success: (function (result) {
				// $("#div1").html(result);
				$("#accordion").html(result);
				atm_panel();
			})
		})
	};
	
	function alerts_panel(panelid) {
		$.ajax({
			type: "POST",
			url: "alerts_panel.php", 
			data: {panelid:panelid},
			success: (function (result) {
				// $("#div1").html(result);
				$("#"+panelid).html(result);
			})
		})
	};
	
	function alerts_panel_refresh(panelid) {
		$.ajax({
			type: "POST",
			url: "alerts_panel_refresh.php", 
			data: {panelid:panelid},
			success: (function (result) {
				// $("#div1").html(result);
				$("#"+panelid).html(result);
			})
		})
	};
	
	function search_panel(panelid) {
		$.ajax({
			type: "POST",
			url: "search_dashboard_panel.php", 
			data: {panelid:panelid},
			success: (function (result) { debugger;
				// $("#div1").html(result);
				$("#accordion").html(result);
				alerts_panel(panelid);
			})
		})
	};
	var countload = 0;
	var atmid_array = [];
	function atm_panel() { debugger;
		$.ajax({
			url: "atm_panel.php", 
			dataType: "json",
			success: (function (result) { 
			    var res = result.atmid;
				if(res.length>atmid_array.length){
					dashboard_panel();
					var data = '<option value="" data-id="all">Select Atm ID</option>';
					for(var i=0;i<res.length;i++){
						var arrdata = res[i].split("_");
						
					  data += '<option value="'+arrdata[0]+'" data-id="'+arrdata[1]+'">'+arrdata[0]+'</option>';
					  if(!atmid_array.includes(arrdata[0])){
						atmid_array.push(arrdata[0]);
						var j = i+1;
						
					  }
					  if(countload==0){
					   alerts_panel(arrdata[1]);
					   countload=1;
				      }else{
					   alerts_panel_refresh(arrdata[1]);	
                      }					   
					}
				   $("#atmid").html(data);
				}else{
					for(var i=0;i<res.length;i++){
						var arrdata = res[i].split("_");
						if(countload==0){
						   alerts_panel(arrdata[1]);
						   countload=1;
						  }else{
						   alerts_panel_refresh(arrdata[1]);	
						  }	
					}
				}
			    var res2 = JSON.stringify(result);
			    
			  // addatm(j,'AZX1233');
				//$("#accordion").html(result);
			})
		})
	};
	function addatm(j,atmid){
		var html = '<div class="card"><div class="card-header" id="heading-'+j+'" role="tab">';
		html += '<h6 class="mb-0"><a aria-controls="collapse-'+j+'" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse-'+j+'">';
		html += j+". "+atmid;
		html += '</a></h6></div>';
	    html += '<div aria-labelledby="heading-'+j+'" class="collapse" data-parent="#accordion" id="collapse-'+j+'" role="tabpanel">';
		html += '<div class="card-body"></div></div>';
		$("#accordion").append(html);
	}

	//dashboard_panel(); // To output when the page loads
	//atm_panel();
	//setInterval(atm_panel, (10000)); // x * 1000 to get it in seconds


   $("#atmid").on("change",function(){
	   var panelid = $(this).children('option:selected').data("id");
	  // alert(panelid);
	  if(panelid=="all"){
		  window.location = "index.php";
	  }
	   search_panel(panelid);
   })

</script>

<?php 


function status($status)
{
    $sql=mysqli_query($con,"select * from sites where status='".$status."'");
    $sql_result = mysqli_fetch_assoc($sql);

    return sql_result['sites'];

}

?>
    </body>
</html>


