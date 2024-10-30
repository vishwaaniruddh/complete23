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
	
        <body onload="a('','','panelhealth_process.php')">
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
                                    <li class="breadcrumb-item"><a href="PanelHealthStatus.php">PANEL HEALTH </a></li>
                                    
                                </ol>
                            </div>
                            <h4 class="page-title">Panel</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Panel Health Status</h4>

                            <div class="text-center mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-custom bg-custom text-white">
                                            <i class="fi-tag">Sites</i>
                                            <h3 class="m-b-10">
                                            <?php $qry=mysqli_query($conn,"select count(*) as totalSites from panel_health");
                                            $fetchQry=mysqli_fetch_array($qry);
                                            echo $fetchQry['totalSites'];
                                            ?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600">Total Sites</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-primary widget-flat border-primary text-white" style="padding-bottom: 0px;">
                                            <i class="fi-archive">RASS</i>
                                            <h>RASS</h>
                                            <h3 class="m-b-10"><?php $Connectqry=mysqli_query($conn,"select count(*) as totalConnect from panel_health where status='0'");
                                            $fetchConnectQry=mysqli_fetch_array($Connectqry);
                                            
                                            $NotConnectqry=mysqli_query($conn,"select count(*) as totalNotConnect from panel_health where status='1'");
                                            $fetchNotConnectQry=mysqli_fetch_array($NotConnectqry);
                                            
                                            echo $fetchConnectQry['totalConnect'] . "/" .  $fetchNotConnectQry['totalNotConnect'];
                                            ?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600">Connected / Not Connected</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-success bg-success text-white" style="padding-bottom: 0px;">
                                            <i class="fi-help">Smart-I</i>
                                            <h>Smart-I</h>
                                            <h3 class="m-b-10">0 / 0</h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"  >Connected / Not Connected</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-danger widget-flat border-danger text-white" style="padding-bottom: 0px;">
                                            <i class="fi-delete">Securico</i>
                                            <h></h> Securico</h>
                                            <h3 class="m-b-10">0/0</h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"> Connected / Not Connected</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                <div class="row">
                    <div class="col-12">
                        <div class="card-box" style="padding-left: 320px;">
                            <h4 class="header-title"><b>Alert Color</b></h4>
                            
                            <div class="button-list">
                               
                               <button type="button" class="btn btn-youtube waves-effect waves-light">
                                    <i class="fa fa-youtube m-r-5"></i> 1 - Alert
                                </button>
                                
                                <button type="button" style="background-color:green" class="btn btn-dribbble waves-effect waves-light">
                                    <i class="fa fa-dribbble m-r-5"></i> 0 - Normal
                                </button>

                               <button type="button" style="background-color:orchid;" class="btn btn-youtube waves-effect waves-light">
                                    <i class="fa fa-youtube m-r-5"></i> 9 - ByPassed
                                </button>

                                <button type="button" style="background-color:white;color:black;border: 2px solid black" color="red" class="btn  waves-effect waves-light">
                                    <i class="fa fa-github m-r-5"></i> 2 - Disconnect
                                </button>
                            </div>

                        </div>
                    </div><!-- end col -->

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
                            
        <!--<table  id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
        <td>SN</td>
        <td ><div >ATM-ID</div></td>
        <td ><div >Date_Time&nbsp; </div></td>
        <td ><div style="" id="">LobbyPIR Motion Sensor</div></td>
        <td><div style="" id="">Glass Break Sensor</div></td>
        <td><div style="" id="">Panic Switch</div></td>
        <td><div style="" id="">MainDoor shuttNormal NO type</div></td>
        
        <td><div id="">ATM1 Removal</div></td>
        <td><div id="">ATM 1 Vibration</div></td>
        <td><div style="" id="">ATM2 Removal</div></td>
        <td><div id="">ATM 2 Vibration</div></td>
        <td><div id="">ATM 3 Removal</div></td>
        <td><div id="">ATM 3 Vibration</div></td>
        <td><div id="">SmokeDetector 12V IN +</div></td>
        <td><div id="">Videoloss/Video Temper/HDD alarm</div></td>
        <td><div style="" id="">ATM 1 Thermal/Heat</div></td>
        <td><div style="" id="">ATM 2 Thermal/Heat</div></td>
        <td><div id="">ChestDoor Open ATM1</div></td>
        <td><div style="" id="">ChestDoor Open ATM2</div></td>
        <td><div style="" id="">ChestDoor Open ATM3</div></td>
        <td><div style="" id="">AC /UPS removal</div></td>
      
        <td><div style="" id="">Cheque dropbox removal</div></td>
        <td><div id="">Chequedrop box open</div></td>
        <td><div style="" id="">CCTV 1+2+3 Removal</div></td>
        <td><div id="">ATM 3 Thermal/ Heat</div></td>
        <td><div style="" id="">Backroom Door Open</div></td>
        <td><div id="">Lobby Temprature SensorHigh</div></td>
        <td><div id="">ATM 1/2 HoodDoor Sensor</div></td>
        <td><div style=""  id="">LobbyTemprature Sensor Low</div></td>
        <td><div id="">Silence Key</div></td>
       
      
        <td><div style="" id="">AC Mains Fail DI</div></td>
        <td><div id="">UPS O/P FailDI</div></td>
        
         <td><div style="" id="">Panel Tamper Switch</div></td>
        <td><div style="" id="">Low Battery</div></td>
        <td><div style="" id="">No battery</div></td>
        <td><div id="">Fire TroubleSmoke sense</div></td>
        <td><div id="">CURRENT STATUS</div></td>
  
       </tr>
       </thead>

       <tbody>
                                
                                    

                                   
 <?php
 $sr=1;
 while($row = mysqli_fetch_array($qrys)) { ?>

 <tr <?php if($row[67]==1){ ?>style="background-color:#FF0000" <?php } ?> >
    <td><?php echo $sr;?></td>
    <td><?php echo $row[68];?></td>
    <td ><?php echo $row[0];?></td>
    <td align="center"><div id=""><?php echo $row[4]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[5]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[6]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[7]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[8]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[9]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[10]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[11]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[12]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[13]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[14]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[15]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[16]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[17]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[18]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[19]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[20]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[21]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[22]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[23]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[24]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[25]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[26]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[27]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[28]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[29]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[30]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[32]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[33]; ?></div></td>
         <td align="center"><div id=""><?php echo $row[37]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[64]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[65]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[66]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[67]; ?></div></td>
    </tr>
   <?php
$sr++;
  ?>
<?php 
}
?>

                               

                                </tbody>
                            </table>-->
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

      <script type="text/javascript">
           /* $(document).ready(function() {
                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false, 
                    scrollX: true,
                    buttons: ['copy', 'excel']
                  
                });

               table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
               } );
               */
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
