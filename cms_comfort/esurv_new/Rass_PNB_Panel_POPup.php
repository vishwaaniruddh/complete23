<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{    $value=$_GET['id'];
	include("config.php");
	include('header.php');
	include('script.php');
//	$abc_count="select count(*) from panel_health";
//$abc="select * from panel_health";
//$qrys=mysqli_query($conn,$abc);
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
                                    
                                    <?php  if($value=="ConnRassPNB" || $value=="NotConnRassPNB"){  ?>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-danger widget-flat border-danger text-white" style="padding-bottom: 0px;">
                                            <i class="fi-delete" style="pointer-events: none; cursor: default;">RASS PNB</i>
                                             <h>RASS PNB</h>
                                           <h3 class="m-b-10"><?php $Connectqry=mysqli_query($conn,"select count(*) as totalConnect from panel_health where status='0' and panelName ='rass_pnb' ");
                                            $fetchConnectQry=mysqli_fetch_array($Connectqry);
                                            
                                            $NotConnectqry=mysqli_query($conn,"select count(*) as totalNotConnect from panel_health where status='1' and panelName ='rass_pnb'");
                                            $fetchNotConnectQry=mysqli_fetch_array($NotConnectqry);
                                            
                                            echo $fetchConnectQry['totalConnect'] . "/" .  $fetchNotConnectQry['totalNotConnect'];
                                            ?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"  ><a href="RASS_PNB_Panel_POPup.php?id=ConnRassPNB" style="color:white" target="_blank">Connected</a> / <a href="Rass_PNB_Panel_POPup.php?id=NotConnRassPNB" style="color:white" target="_blank">Not Connected</a></p>
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
      <td ><div >State&nbsp; </div></td>
      <td ><div >City&nbsp; </div></td>
        <td ><div >Bank&nbsp; </div></td>
      <td ><div >PanelIP&nbsp; </div></td>
      <td ><div >Panel Name&nbsp; </div></td>
      <td ><div >Date_Time&nbsp; </div></td>
        <td ><div style="" id="">Lobby PIR Motion sensor </div></td>
        <td><div style="" id="">ATM1 Removal</div></td>
        <td><div style="" id="">ATM 1 Vibration</div></td>
        <td><div style="" id="">ATM 1 Thermal</div></td>
        
        <td><div id="">ATM1 Chest door</div></td>
        <td><div id="">Backroom</div></td>
        <td><div style="" id="">Panic Button</div></td>
        <td><div id="">House Keeping</div></td>
        <td><div id="">QRT</div></td>
        <td><div id="">FLM Engineer</div></td>
        <td><div id="">Smoke Detector 12V IN +</div></td>
      
        <td><div id="">Glass Break Sensor</div></td>
        <td><div id="">ATM2 Removal</div></td>
        <td><div id="">ATM2 Vibration</div></td>
        <td><div style="" id="">ATM2  Thermal</div></td>
        <td><div style="" id="">ATM2 Chest Door</div></td>
        <td><div id="">Lobby PIR</div></td>
        <td><div style="" id="">ATM3 Removal</div></td>
        <td><div style="" id="">ATM3 Vibration</div></td>
        <td><div style="" id="">ATM3  Thermal</div></td>
      
        <td><div style="" id="">ATM3 Chest Door</div></td>
        <td><div id="">Speaker and MIC removal</div></td>
        <td><div style="" id="">Camera Removal</div></td>
        <td><div id="">ATM Shutter Sensor</div></td>
        <td><div style="" id="">IT Official</div></td>
        <td><div id="">Other Technician</div></td>
        <td><div id="">AC Removal</div></td>
        <td><div style=""  id="">ATM Hood door</div></td>
         <td><div style=""  id="">System Disarm for Backroom</div></td>
          <td><div style=""  id="">System Disarm for AC Maintenance</div></td>
           <td><div style=""  id="">System Arm for AC Maintenance</div></td>
            <td><div style=""  id="">System Initialized with default settings.</div></td>
             <td><div style=""  id="">System Restarted (Power On)</div></td>
        
        
        <td ><div >SiteAddress&nbsp; </div></td>
       </tr>
       
       </thead>

       <tbody>
                                
                                    

                                   
 <?php
 $sr=1;
 
 if($value=="ConnRassPNB" ){
 $qrys=mysqli_query($conn,"select * from panel_health where status='0' and panelName='rass_pnb' ");
 }else if($value=="NotConnSmarti"){
 $qrys=mysqli_query($conn,"select * from panel_health where status='1' and panelName='rass_pnb' ");
 }
 while($row=mysqli_fetch_array($qrys)) { 
$StateQry= mysqli_query($conn,"select State,PanelIP,City,SiteAddress,Bank from sites where ATMID='".$row[68]."'");
$fetchState=mysqli_fetch_array($StateQry);
?>
 <tr <?php if($row[67]==1){ ?>style="background-color:#FF0000" <?php } ?> >
    <td><?php echo $sr;?></td>
    <td><?php  echo $row[68]; ?></td>
    <td><?php echo $fetchState['State'];?></td>
     <td><?php echo $fetchState['City'];?></td>
     <td><?php echo $fetchState['Bank'];?></td>
     
    <td><?php echo $fetchState['PanelIP'];?></td>
     <td><?php echo $row['panelName'];?></td>
    <td ><?php echo $row[0];?></td>
    <td align="center"><div id=""><?php if($row[4]==0){echo "Normal";}else if($row[4]==1){echo "Alert";}else if($row[4]==2){echo "Disconnect";}else if($row[4]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[5]==0){echo "Normal";}else if($row[5]==1){echo "Alert";}else if($row[5]==2){echo "Disconnect";}else if($row[5]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[6]==0){echo "Normal";}else if($row[6]==1){echo "Alert";}else if($row[6]==2){echo "Disconnect";}else if($row[6]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[7]==0){echo "Normal";}else if($row[7]==1){echo "Alert";}else if($row[7]==2){echo "Disconnect";}else if($row[7]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[8]==0){echo "Normal";}else if($row[8]==1){echo "Alert";}else if($row[8]==2){echo "Disconnect";}else if($row[8]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[9]==0){echo "Normal";}else if($row[9]==1){echo "Alert";}else if($row[9]==2){echo "Disconnect";}else if($row[9]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[10]==0){echo "Normal";}else if($row[10]==1){echo "Alert";}else if($row[10]==2){echo "Disconnect";}else if($row[10]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[11]==0){echo "Normal";}else if($row[11]==1){echo "Alert";}else if($row[11]==2){echo "Disconnect";}else if($row[11]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[12]==0){echo "Normal";}else if($row[12]==1){echo "Alert";}else if($row[12]==2){echo "Disconnect";}else if($row[12]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[13]==0){echo "Normal";}else if($row[13]==1){echo "Alert";}else if($row[13]==2){echo "Disconnect";}else if($row[13]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[14]==0){echo "Normal";}else if($row[14]==1){echo "Alert";}else if($row[14]==2){echo "Disconnect";}else if($row[14]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[15]==0){echo "Normal";}else if($row[15]==1){echo "Alert";}else if($row[15]==2){echo "Disconnect";}else if($row[15]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[16]==0){echo "Normal";}else if($row[16]==1){echo "Alert";}else if($row[16]==2){echo "Disconnect";}else if($row[16]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[17]==0){echo "Normal";}else if($row[17]==1){echo "Alert";}else if($row[17]==2){echo "Disconnect";}else if($row[17]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[18]==0){echo "Normal";}else if($row[18]==1){echo "Alert";}else if($row[18]==2){echo "Disconnect";}else if($row[18]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[19]==0){echo "Normal";}else if($row[19]==1){echo "Alert";}else if($row[19]==2){echo "Disconnect";}else if($row[19]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[20]==0){echo "Normal";}else if($row[20]==1){echo "Alert";}else if($row[20]==2){echo "Disconnect";}else if($row[20]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[21]==0){echo "Normal";}else if($row[21]==1){echo "Alert";}else if($row[21]==2){echo "Disconnect";}else if($row[21]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[22]==0){echo "Normal";}else if($row[22]==1){echo "Alert";}else if($row[22]==2){echo "Disconnect";}else if($row[22]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[23]==0){echo "Normal";}else if($row[23]==1){echo "Alert";}else if($row[23]==2){echo "Disconnect";}else if($row[23]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[24]==0){echo "Normal";}else if($row[24]==1){echo "Alert";}else if($row[24]==2){echo "Disconnect";}else if($row[24]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[25]==0){echo "Normal";}else if($row[25]==1){echo "Alert";}else if($row[25]==2){echo "Disconnect";}else if($row[24]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[26]==0){echo "Normal";}else if($row[26]==1){echo "Alert";}else if($row[26]==2){echo "Disconnect";}else if($row[26]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[27]==0){echo "Normal";}else if($row[27]==1){echo "Alert";}else if($row[27]==2){echo "Disconnect";}else if($row[27]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[28]==0){echo "Normal";}else if($row[28]==1){echo "Alert";}else if($row[28]==2){echo "Disconnect";}else if($row[28]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[29]==0){echo "Normal";}else if($row[29]==1){echo "Alert";}else if($row[29]==2){echo "Disconnect";}else if($row[29]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[30]==0){echo "Normal";}else if($row[30]==1){echo "Alert";}else if($row[30]==2){echo "Disconnect";}else if($row[30]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[31]==0){echo "Normal";}else if($row[31]==1){echo "Alert";}else if($row[31]==2){echo "Disconnect";}else if($row[31]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[32]==0){echo "Normal";}else if($row[32]==1){echo "Alert";}else if($row[32]==2){echo "Disconnect";}else if($row[32]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[33]==0){echo "Normal";}else if($row[33]==1){echo "Alert";}else if($row[33]==2){echo "Disconnect";}else if($row[33]==9){echo "By Passed";} ?></div></td>
          <td align="center"><div id=""><?php if($row[34]==0){echo "Normal";}else if($row[34]==1){echo "Alert";}else if($row[34]==2){echo "Disconnect";}else if($row[34]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[35]==0){echo "Normal";}else if($row[35]==1){echo "Alert";}else if($row[35]==2){echo "Disconnect";}else if($row[35]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[36]==0){echo "Normal";}else if($row[36]==1){echo "Alert";}else if($row[36]==2){echo "Disconnect";}else if($row[36]==9){echo "By Passed";} ?></div></td>
        <!--<td align="center"><div id=""><?php if($row[37]==0){echo "Normal";}else if($row[37]==1){echo "Alert";}else if($row[37]==2){echo "Disconnect";}else if($row[37]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[64]==0){echo "Normal";}else if($row[64]==1){echo "Alert";}else if($row[64]==2){echo "Disconnect";}else if($row[64]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[65]==0){echo "Normal";}else if($row[65]==1){echo "Alert";}else if($row[65]==2){echo "Disconnect";}else if($row[65]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[66]==0){echo "Normal";}else if($row[66]==1){echo "Alert";}else if($row[66]==2){echo "Disconnect";}else if($row[66]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[67]==0){echo "Normal";}else if($row[67]==1){echo "Alert";}else if($row[67]==2){echo "Disconnect";}else if($row[67]==9){echo "By Passed";} ?></div></td>
   --> <td><?php echo $fetchState['SiteAddress'];?></td>
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
      