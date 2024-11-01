<?php
session_start();
error_reporting(0);
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	include("config.php");
	include('header.php');
	include('script.php');
/*	$abc_count="select count(*) from panel_health";
$abc="select * from panel_health";
$qrys=mysqli_query($conn,$abc);*/
	?>
                <!-- DataTables -->
        <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
         <!-- Spinkit css -->
        <link href="../plugins/spinkit/spinkit.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
         <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

        <script src="assets/js/modernizr.min.js"></script>
        
<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>-->

 <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<style type="text/css">
    .dt-buttons a{
            border: 1px solid;
    padding: 4px;
    margin: auto 5px;
    }
    .paginate_button{
        margin: auto 5px;
    }
</style>
	
        <body onload="a('','','dvrhealth_process_detail_test.php')">
            <?php include('menu.php');?>

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Health report</a></li>
                                    <li class="breadcrumb-item"><a href="DVRHealthStatus.php">DVR HEALTH </a></li>
                                    
                                </ol>
                            </div>
                            <h4 class="page-title">DVR</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">DVR Health Status</h4>

                            <div class="text-center mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-custom bg-custom text-white" style="padding-bottom: 0px;padding-top: 9px;">
                                            <i class="fi-tag" style="pointer-events: none; cursor: default;">DVR</i>
                                            
                                            <h4 class="m-b-10">Total DVR / 
                                            <?php
                                            
                                             $add="";                     
$add=" and atmid IN (select ATMID from sites where Customer='Diebold' and live='Y')";
      
                                            
                                            $Q1="select count(*) as totalDVR from dvr_health where live='Y'";
                                            $Q1.= $add;
											
                                            $qrydvr=mysqli_query($conn,$Q1);
                                            $fetchDvrQry=mysqli_fetch_array($qrydvr);
											
                                            echo $fetchDvrQry['totalDVR'];
											
                                            ?></h4>

                                            <h3 class="m-b-10"><?php 
                                            $Q2="select count(*) as totalConnect from dvr_health where status='1' and live='Y'";
                                            $Q2.= $add;
                                            $Connectqry=mysqli_query($conn,$Q2);
                                            $fetchConnectQry=mysqli_fetch_array($Connectqry);
                                            
                                            
                                            $Q3="select count(*) as totalNotConnect from dvr_health where (`status`='0' or status IS NULL) and live='Y'";
                                            $Q3.= $add;
                                            $NotConnectqry=mysqli_query($conn,$Q3);
                                            $fetchNotConnectQry=mysqli_fetch_array($NotConnectqry);
                                            
                                            echo  $fetchConnectQry['totalConnect'] . "/" .  $fetchNotConnectQry['totalNotConnect'];
											
                                            ?></h3>
                                         <div>  <p class="text-uppercase m-b-5 font-13 font-600">
										 <a href="#" style="color:white" >Connected</a>  / <a href="#" style="color:white" > Not Connected </a></p>
</div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-primary widget-flat border-primary text-white" style="padding-left: 4px;padding-bottom: 0px;">
                                            <i class="fi-archive" style="pointer-events: none; cursor: default;">HDD</i>
                                            <h>HDD Not Working</h> 
                                            <h3 class="m-b-10"><?php 
                                            $Q4="select count(*) as totalError from dvr_health where hdd='error'";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q4.= $add;}
											if($_SESSION['designation']=="4"){$Q4.= $add;}
                                            $errorqry=mysqli_query($conn,$Q4);
                                            $fetcherrorQry=mysqli_fetch_array($errorqry);
                                            
                                            
                                            $Q5="select count(*) as totalNotExist from dvr_health where hdd='notexist' or hdd='Not Exist' ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q5.= $add;}
											if($_SESSION['designation']=="4"){$Q5.= $add;}
                                            $notexistqry=mysqli_query($conn,$Q5);
                                            $fetchNotExistQry=mysqli_fetch_array($notexistqry);
                                            
                                            
                                              $Q6="select count(*) as totalSmartFailed from dvr_health where hdd='smartFailed' ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q6.= $add;}
											if($_SESSION['designation']=="4"){$Q6.= $add;}
                                            $smartFailedqry=mysqli_query($conn,$Q6);
                                            $fetchsmartFailedQry=mysqli_fetch_array($smartFailedqry);
											
											 $Q61="select count(*) as totalAbNormal from dvr_health where hdd='abnormal' ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q61.= $add;}
											if($_SESSION['designation']=="4"){$Q61.= $add;}
                                            $abnormalqry=mysqli_query($conn,$Q61);
                                            $fetchabNormalQry=mysqli_fetch_array($abnormalqry);
											
											 $Q62="select count(*) as totalNoDisk from dvr_health where hdd='No Disk' or hdd='No disk/idle' ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q62.= $add;}
											if($_SESSION['designation']=="4"){$Q62.= $add;}
                                            $noDiskqry=mysqli_query($conn,$Q62);
                                            $fetchnoDiskQry=mysqli_fetch_array($noDiskqry);
                                            
                                            
                                            $Q7="select count(*) as totalUnformatted from dvr_health where hdd='unformatted' ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q7.= $add;}
											if($_SESSION['designation']=="4"){$Q7.= $add;}
                                            $unformattedqry=mysqli_query($conn,$Q7);
                                            $fetchunformattedQry=mysqli_fetch_array($unformattedqry);
                                            if($_SESSION['designation']=="4"){
												echo "0/0/0/3";
											}else{
                                            echo $fetcherrorQry['totalError'] . " / " .  $fetchNotExistQry['totalNotExist']. " / " .$fetchsmartFailedQry['totalSmartFailed'] . " / " .  $fetchunformattedQry['totalUnformatted'] ."</br> / " . $fetchabNormalQry['totalAbNormal'] ." / " . $fetchnoDiskQry['totalNoDisk'];
                                            } 
											?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"><a href="#" style="color:white" >Error</a>/<a href="#" style="color:white" >NotExist</a>/<a href="#" style="color:white">SmartFail</a>/<a href="#" style="color:white" >UnFormated</a></br>/<a href="#" style="color:white" >AbNormal</a>/<a href="#" style="color:white" >No Disk</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-success bg-success text-white" style="padding-bottom: 0px;">
                                            <i class="fi-help" style="pointer-events: none; cursor: default;">DVR</i>
                                            <h>DVR Status</h>
                                            <h3 class="m-b-10"><?php $today = date('Y-m-d');
                                            $Q8="select count(*) as totalDVR from dvr_health where status='1' and login_status='1'  and live='y' ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q8.= $add;}
											if($_SESSION['designation']=="4"){$Q8.= $add;}
                                            $qrydvr=mysqli_query($conn,$Q8);
                                            $fetchDvrQry=mysqli_fetch_array($qrydvr);
											$dvr_his = "select id from dvr_history where CAST(last_communication AS DATE)='".$today."' AND login_status='0' AND atmid IN (SELECT atmid FROM `dvr_health` WHERE status='1' AND  login_status='1' AND live='y' and atmid IN (select ATMID from sites where Customer='Diebold' and live='Y')) GROUP BY atmid";
                                            $qrydvrhis=mysqli_query($conn,$dvr_his);
											$fetchDvrHisQry=mysqli_num_rows($qrydvrhis); 
											$dvrnotlogin = $fetchDvrQry['totalDVR'] - $fetchDvrHisQry;
											echo $dvrnotlogin;?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"  ><a href="#" style="color:white">DVR Not Login</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-danger widget-flat border-danger text-white" style="padding-bottom: 0px;">
                                            <i class="fi-delete" style="pointer-events: none; cursor: default;">Camera</i>
                                            <h>Camera Not Working</h>
                                            <h3 class="m-b-10">
                                                <?php 
                                                $Q9="select count(*) as totalNotworking from dvr_health where cam1='not working'  ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q9.= $add;}
											if($_SESSION['designation']=="4"){$Q9.= $add;}
                                                
                                            $Notworkingqry1=mysqli_query($conn,$Q9);
                                            $fetchNotworkingQry1=mysqli_fetch_array($Notworkingqry1);
                                            
                                           
                                            $Q10="select count(*) as totalNotworking from dvr_health where cam2='not working' ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q10.= $add;}
											if($_SESSION['designation']=="4"){$Q10.= $add;}
                                            $Notworkingqry2=mysqli_query($conn,$Q10);
                                            $fetchNotworkingQry2=mysqli_fetch_array($Notworkingqry2);
                                            
                                            
                                            $Q11="select count(*) as totalNotworking from dvr_health where cam3='not working'  ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q11.= $add;}
											if($_SESSION['designation']=="4"){$Q11.= $add;}
                                            $Notworkingqry3=mysqli_query($conn,$Q11);
                                            $fetchNotworkingQry3=mysqli_fetch_array($Notworkingqry3);
                                            
                                            $Q12="select count(*) as totalNotworking from dvr_health where cam4='not working'  ";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q12.= $add;}
											if($_SESSION['designation']=="4"){$Q12.= $add;}
                                            $Notworkingqry4=mysqli_query($conn,$Q12);
                                            $fetchNotworkingQry4=mysqli_fetch_array($Notworkingqry4);
                                            
											if($_SESSION['designation']!="4"){
											echo $fetchNotworkingQry1['totalNotworking'] . " / " .  $fetchNotworkingQry2['totalNotworking'];
											}else{
                                            echo $fetchNotworkingQry1['totalNotworking'] . " / " .  $fetchNotworkingQry2['totalNotworking']. " / " .$fetchNotworkingQry3['totalNotworking']. " / " .$fetchNotworkingQry4['totalNotworking'] ;
                                            }
											?>
                                            </h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"> <a href="#" style="color:white" >Cam-1</a> / <a href="#" style="color:white" >Cam-2</a> 
											<?php  if($_SESSION['designation']=="4"){ ?>
											/ <a href="#" style="color:white" >Cam-3</a>/ <a href="#" style="color:white">Cam-4</a></p>
                                            <?php }?>
										</div>
                                    </div>
                                </div>
                            </div>



          




<div align="center" style="display:none"><input type="text" id="Atmid" name="Atmid" placeholder="Search Atm-ID"  /><input type="button" value="search" onClick="a('','50')" /></div>

                          <div class="sk-fading-circle" id="spinner">
                                <div class="sk-circle1 sk-circle"></div>
                                <div class="sk-circle2 sk-circle"></div>
                                <div class="sk-circle3 sk-circle"></div>
                                <div class="sk-circle4 sk-circle"></div>
                                <div class="sk-circle5 sk-circle"></div>
                                <div class="sk-circle6 sk-circle"></div>
                                <div class="sk-circle7 sk-circle"></div>
                                <div class="sk-circle8 sk-circle"></div>
                                <div class="sk-circle9 sk-circle"></div>
                                <div class="sk-circle10 sk-circle"></div>
                                <div class="sk-circle11 sk-circle"></div>
                                <div class="sk-circle12 sk-circle"></div>
                            </div>

                            
                                  <!-- <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    -->
								
								
								<table id="datatable-buttons"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">	
                                </table>
  
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
        
        <!-- large modal -->
        <!-- large modal -->
		<div class="modal fade" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">History Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<h6>Network</h6>
				  <div class="card">
					<div class="card-block" id="result_status" style=" overflow: auto;">
					  
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--<button type="button" class="btn btn-primary">Save changes</button>-->
			  </div>
			</div>
		  </div>
		</div>
				
        <div class="modal fade" id="myModalDetail_1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">History Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body dvrlogin">
				<h6>DVR Login</h6>
				  <div class="card">
					<div class="card-block" id="result_status_1" style=" overflow: auto;">
					  
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--<button type="button" class="btn btn-primary">Save changes</button>-->
			  </div>
			</div>
		  </div>
		</div>
		
		<div class="modal fade" id="myModalDetail_2" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">History Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body hdd">
				<h6>HDD</h6>
				  <div class="card">
					<div class="card-block" id="result_status_2" style=" overflow: auto;">
					  
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--<button type="button" class="btn btn-primary">Save changes</button>-->
			  </div>
			</div>
		  </div>
		</div>
         <?php include('footer.php'); ?>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>


        <!-- Required datatable js -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/datatables/jszip.min.js"></script>
        <script src="../plugins/datatables/pdfmake.min.js"></script>
        <script src="../plugins/datatables/vfs_fonts.js"></script>
        <script src="../plugins/datatables/buttons.html5.min.js"></script>
        <script src="../plugins/datatables/buttons.print.min.js"></script>

  <!-- Counter Up  -->
        <script src="../plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

 <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
		
	<!--	
    <script src="custome_assets/jquery.dataTables.js"></script>
    <script src="custome_assets/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="custome_assets/extensions/export/dataTables.buttons.min.js"></script>
    <script src="custome_assets/extensions/export/buttons.flash.min.js"></script>
    <script src="custome_assets/extensions/export/jszip.min.js"></script>
    <script src="custome_assets/extensions/export/pdfmake.min.js"></script>
    <script src="custome_assets/extensions/export/vfs_fonts.js"></script>
    <script src="custome_assets/extensions/export/buttons.html5.min.js"></script>
    <script src="custome_assets/extensions/export/buttons.print.min.js"></script> -->

    <!-- Custom Js -->
    <!-- <script src="../js/admin.js"></script> -->
   <!-- <script src="custome_assets/jquery-datatable.js"></script>-->
    
      <script type="text/javascript">

               function callfn(){
				  
                   
                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false, 
                    scrollX: true,
                    buttons: ['copy', 'excel']
                  
                });

               table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
              
                 
               }
			   
			    $(document).on("click", ".open-DetailDialog", function () {
					 var reqId = $(this).data('id');
					// var reqStatus = $(this).data('status');
					$(".modal-body #result_status").html(''); 
					 $.ajax({    
						type: "GET",
						url: "show_network_history.php?id="+reqId,             
						dataType: "html",              
						success: function(response){                    
							$(".modal-body #result_status").html(response); 
							
						}
					 }); 
					
				});
				
				$(document).on("click", ".open-DetailDialog_1", function () {
					 var reqId = $(this).data('id');
					// var reqStatus = $(this).data('status');
					$(".dvrlogin #result_status_1").html(''); 
					 $.ajax({    
						type: "GET",
						url: "show_dvr_history.php?id="+reqId,             
						dataType: "html",              
						success: function(response){                    
							$(".dvrlogin #result_status_1").html(response); 
							
						}
					 }); 
					
				});
				
				$(document).on("click", ".open-DetailDialog_2", function () {
					 var reqId = $(this).data('id');
					// var reqStatus = $(this).data('status');
					$(".hdd #result_status_2").html('');
					 $.ajax({    
						type: "GET",
						url: "show_hdd_history.php?id="+reqId,             
						dataType: "html",              
						success: function(response){                    
							$(".hdd #result_status_2").html(response); 
							
						}
					 }); 
					
				});
        </script> 
       
    </body>
</html><?php
}else
{ 
 header("location: index.php");
}
?>
