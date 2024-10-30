<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	include("config.php");
	include('header.php');
	include('script.php');
	$abc_count="select count(*) from panel_health";
$abc="select * from panel_health";
$qrys=mysqli_query($conn,$abc);
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


        <script src="assets/js/modernizr.min.js"></script>
        
<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
        <body onload="a('','','dvrhealth_process.php')">
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
                                            <?php $qrydvr=mysqli_query($conn,"select count(*) as totalDVR from dvr_health where live='Y'");
                                            $fetchDvrQry=mysqli_fetch_array($qrydvr);
                                            echo $fetchDvrQry['totalDVR'];
                                            ?></h4>

                                            <h3 class="m-b-10"><?php $Connectqry=mysqli_query($conn,"select count(*) as totalConnect from dvr_health where status='1' and live='Y'");
                                            $fetchConnectQry=mysqli_fetch_array($Connectqry);
                                            
                                            $NotConnectqry=mysqli_query($conn,"select count(*) as totalNotConnect from dvr_health where (`status`='0' or status IS NULL) and live='Y'");
                                            $fetchNotConnectQry=mysqli_fetch_array($NotConnectqry);
                                            
                                            echo  $fetchConnectQry['totalConnect'] . "/" .  $fetchNotConnectQry['totalNotConnect'];
                                            ?></h3>
                                         <div>  <p class="text-uppercase m-b-5 font-13 font-600"><a href="DVR_POPup.php?id=1" style="color:white" target="_blank">Connected</a>  / <a href="DVR_POPup.php?id=0" style="color:white" target="_blank"> Not Connected </a></p>
</div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-primary widget-flat border-primary text-white" style="padding-left: 4px;padding-bottom: 0px;">
                                            <i class="fi-archive" style="pointer-events: none; cursor: default;">HDD</i>
                                            <h>HDD Not Working</h> 
                                            <h3 class="m-b-10"><?php $errorqry=mysqli_query($conn,"select count(*) as totalError from dvr_health where hdd='error'");
                                            $fetcherrorQry=mysqli_fetch_array($errorqry);
                                            
                                            $notexistqry=mysqli_query($conn,"select count(*) as totalNotExist from dvr_health where hdd='notexist' or hdd='Not Exist' ");
                                            $fetchNotExistQry=mysqli_fetch_array($notexistqry);
                                            
                                            $smartFailedqry=mysqli_query($conn,"select count(*) as totalSmartFailed from dvr_health where hdd='smartFailed' ");
                                            $fetchsmartFailedQry=mysqli_fetch_array($smartFailedqry);
                                            
                                            $unformattedqry=mysqli_query($conn,"select count(*) as totalUnformatted from dvr_health where hdd='unformatted' ");
                                            $fetchunformattedQry=mysqli_fetch_array($unformattedqry);
                                            
                                            echo $fetcherrorQry['totalError'] . " / " .  $fetchNotExistQry['totalNotExist']. " / " .$fetchsmartFailedQry['totalSmartFailed'] . " / " .  $fetchunformattedQry['totalUnformatted'];
                                            ?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"><a href="DVR_POPup.php?id=error" style="color:white" target="_blank">Error</a>/<a href="DVR_POPup.php?id=notexist" style="color:white" target="_blank">NotExist</a>/<a href="DVR_POPup.php?id=smartFailed" style="color:white" target="_blank">SmartFail</a>/<a href="DVR_POPup.php?id=unformatted" style="color:white" target="_blank">UnFormated</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-success bg-success text-white" style="padding-bottom: 0px;">
                                            <i class="fi-help" style="pointer-events: none; cursor: default;">DVR</i>
                                            <h>DVR Status</h>
                                            <h3 class="m-b-10"><?php $qrydvr=mysqli_query($conn,"select count(*) as totalDVR from dvr_health where status='1' and login_status='1'  and live='y' ");
                                            $fetchDvrQry=mysqli_fetch_array($qrydvr);
                                            echo $fetchDvrQry['totalDVR'];?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"  ><a href="DVR_POPup.php?id=notlogin" style="color:white" target="_blank">DVR Not Login</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-danger widget-flat border-danger text-white" style="padding-bottom: 0px;">
                                            <i class="fi-delete" style="pointer-events: none; cursor: default;">Camera</i>
                                            <h>Camera Not Working</h>
                                            <h3 class="m-b-10">
                                                <?php 
                                            $Notworkingqry1=mysqli_query($conn,"select count(*) as totalNotworking from dvr_health where cam1='not working'  ");
                                            $fetchNotworkingQry1=mysqli_fetch_array($Notworkingqry1);
                                            
                                           
                                            $Notworkingqry2=mysqli_query($conn,"select count(*) as totalNotworking from dvr_health where cam2='not working' ");
                                            $fetchNotworkingQry2=mysqli_fetch_array($Notworkingqry2);
                                            
                                            
                                            $Notworkingqry3=mysqli_query($conn,"select count(*) as totalNotworking from dvr_health where cam3='not working'  ");
                                            $fetchNotworkingQry3=mysqli_fetch_array($Notworkingqry3);
                                            
                                            echo $fetchNotworkingQry1['totalNotworking'] . " / " .  $fetchNotworkingQry2['totalNotworking']. " / " .$fetchNotworkingQry3['totalNotworking'] ;
                                            ?>
                                            </h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"> <a href="DVR_POPup.php?id=Cam1" style="color:white" target="_blank">Camera-1</a> / <a href="DVR_POPup.php?id=Cam2" style="color:white" target="_blank">Camera-2</a> / <a href="DVR_POPup.php?id=Cam3" style="color:white" target="_blank">Camera-3</a></p>
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

                            
                                   <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    
                                </table>
  
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


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
        </script>
       
    </body>
</html><?php
}else
{ 
 header("location: index.php");
}
?>
