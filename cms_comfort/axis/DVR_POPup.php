<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{ 
    $value=$_GET['id'];
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
   
              <body >
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
                                    <?php if($value=="1" || $value=="0"){?>
                                    
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
                                         <div>  <p class="text-uppercase m-b-5 font-13 font-600"><a href="DVR_POPup.php?id=Y" style="color:white" target="_blank">Connected</a>  / Not Connected</p>
                                        </div>
                                        </div> 
                                    </div>
                                    <?php }else if($value=="error"||$value=="notexist"||$value=="smartFailed"||$value=="unformatted"){  ?>
                                    <div class="col-md-6 col-xl-3" >
                                        <div class="card-box bg-primary widget-flat border-primary text-white" style="padding-left: 4px;padding-bottom: 0px;">
                                            <i class="fi-archive">HDD</i>
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
                                            <p class="text-uppercase m-b-5 font-13 font-600">Error/NotExist/SmartFail/UnFormated</p>
                                        </div>
                                    </div><?php }else if($value=="notlogin"){ ?>
                                    <div class="col-md-6 col-xl-3" >
                                        <div class="card-box widget-flat border-success bg-success text-white" style="padding-bottom: 0px;">
                                            <i class="fi-help">DVR</i>
                                            <h>DVR Status</h>
                                            <h3 class="m-b-10"><?php $qrydvr=mysqli_query($conn,"select count(*) as totalDVR from dvr_health where status='1' and login_status='1'  and live='y' ");
                                            $fetchDvrQry=mysqli_fetch_array($qrydvr);
                                            echo $fetchDvrQry['totalDVR'];?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"  >DVR Not Login</p>
                                        </div>
                                    </div><?php }else if($value=="Cam1" || $value=="Cam2" || $value=="Cam3"){  ?>
                                    <div class="col-md-6 col-xl-3" >
                                        <div class="card-box bg-danger widget-flat border-danger text-white" style="padding-bottom: 0px;">
                                            <i class="fi-delete">Camera</i>
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
                                            <p class="text-uppercase m-b-5 font-13 font-600"> Camera-1 / Camera-2 / Camera-3</p>
                                        </div>
                                    </div><?php } ?>
                                </div>
                            </div>



          




<div align="center" style="display:none"><input type="text" id="Atmid" name="Atmid" placeholder="Search Atm-ID"  /><input type="button" value="search" onClick="a('','50')" /></div>

                        

              
        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
        <td>SN</td>
      <td ><div >ATM-ID</div></td>
      <td ><div >State</div></td>
      <td ><div >City</div></td>
      <td ><div >Bank</div></td>
      <td ><div >Date_Time&nbsp; </div></td>
      <td ><div style="" id="">Last Communication</div></td>
      <td ><div style="" id="">Down Since</div></td>
        
        <td><div style="" id="">IP Address</div></td>
        <td><div style="" id="">DVR Type</div></td>
        <td><div style="" id="">NetworkStatus</div></td>
        
        <td><div id="">Latency</div></td>
        <td><div id="">DVRLogin</div></td>
        <td><div style="" id="">HDD_status</div></td>
        <td><div id="">HDD_capacity</div></td>
        <td><div id="">HDD_freespace</div></td>
        <td><div id="">Recording_from</div></td>
        <td><div id="">Camera1</div></td>
        <td><div id="">Camera2</div></td>
        <td><div style="" id="">Camera3</div></td>
        <td><div style="" id="">DVR Not Login</div></td>
                <td><div style="" id="">site Address</div></td>
  
       </tr>
       </thead>

       <tbody>
                                
                                    

                                   
 <?php
 $sr=1;
 
 if($value=="1" || $value=="0"){
 $qrys=mysqli_query($conn,"select * from dvr_health where status='".$value."' and live='Y' ");
 }else if($value=="error"){
 $qrys=mysqli_query($conn,"select * from dvr_health where hdd='error' ");
 }
 else if($value=="notexist"){
 $qrys=mysqli_query($conn,"select * from dvr_health where hdd='notexist' or hdd='Not Exist' ");
 }
 else if($value=="smartFailed"){
 $qrys=mysqli_query($conn,"select * from dvr_health where hdd='smartFailed' ");
 }
 else if($value=="unformatted"){
 $qrys=mysqli_query($conn,"select * from dvr_health where hdd='unformatted'  ");
 }
 else if($value=="notlogin"){
 $qrys=mysqli_query($conn,"select * from dvr_health where status='1' and login_status='1'  and live='y'   ");
 }
 else if($value=="Cam1"){
 $qrys=mysqli_query($conn,"select * from dvr_health where cam1='not working'   ");
 }
 else if($value=="Cam2"){
 $qrys=mysqli_query($conn,"select * from dvr_health where cam2='not working'    ");
 }
 else if($value=="Cam3"){
 $qrys=mysqli_query($conn,"select * from dvr_health where cam3='not working'   ");
 }
 
 
 
 
 while($row = mysqli_fetch_array($qrys)) { 

$StateQry= mysqli_query($conn,"select State,PanelIP,City,SiteAddress,Bank from sites where ATMID='".$row['atmid']."'");
$fetchState=mysqli_fetch_array($StateQry);

$numQry= mysqli_query($conn,"select id from dvr_health where status='1' and login_status='1' and id='".$row['id']."' ");
$num=mysqli_num_rows($numQry);


if($row[11]!="0000-00-00 00:00:00"){
    $currdat=date("Y-m-d");
$date1=date_create($currdat);
$date2=date_create($row[11]);
$diff=date_diff($date1,$date2);
$datedif_cnt=$diff->format("%a days");

}else{$datedif_cnt="NA";}
?>
  <tr <?php if($row[2]==0 || $row[10]==1){ ?>style="background-color:#FF0000" <?php } ?> >
    <td><?php echo $sr;?></td>
    <td><?php echo $row[12];?></td>
    <td ><?php echo $fetchState['State'];?></td>
    <td ><?php echo $fetchState['City'];?></td>
    <td ><?php echo $fetchState['Bank'];?></td>
       
    <td ><?php echo $row[9];?></td>
       <td align="center"><div id=""><?php echo $row[11]; ?></div></td>
       <td align="center"><div id=""><?php echo $datedif_cnt ; ?></div></td>
        <td align="center"><div id=""><?php echo $row[1]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[17]; ?></div></td>
        <td align="center"><div id=""><?php if($row[2]==1)echo 'good'; else echo 'bad'; ?></div></td>
        <td align="center"><div id=""><?php echo $row[8]; ?></div></td>
        <td align="center"><div id=""><?php if($row[2]==1 && $row[10]==0)echo 'yes'; else echo 'No'; ?></div></td>
        <td align="center"><div id=""><?php echo $row[7]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[13]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[14]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[15]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[3]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[4]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[5]; ?></div></td>
          <td align="center"><div id=""><?php if($num>0){ echo "Not Working"; }  ?></div></td>
         <td ><?php echo $fetchState['SiteAddress'];?></td> 
    </tr>
   <?php
$sr++;
 
}
?>


 </tbody>
</table>


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
               callfn();
        </script>
       
    </body>
</html><?php
}else
{ 
 header("location: index.php");
}
?>
      