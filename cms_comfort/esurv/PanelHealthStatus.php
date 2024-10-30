<?php
session_start();
error_reporting(0);
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
    include ("config.php");
    include ('header.php');
    include ('script.php');
    $abc_count = "select count(*) from panel_health";
    $abc = "select * from panel_health";
    $qrys = mysqli_query($conn, $abc);
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
        <?php include ('menu.php'); ?>

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
                                            <i class="fi-tag" style="pointer-events: none; cursor: default;">Sites</i>
                                            <h3 class="m-b-10">
                                                <?php

                                                $add = "";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {

                                                    $Id = $_SESSION['permission'];
                                                    $perm = array();

                                                    $IDsplit = explode(',', $Id);


                                                    foreach ($IDsplit as $element) {
                                                        $perm[] = $element;
                                                    }
                                                    $per = "'" . implode("','", $perm) . "'";


                                                    $add = " and atmid IN (select ATMID from sites where CTS_LocalBranch IN($per) and live='Y')";
                                                }
                                                if ($_SESSION['designation'] == "4") {


                                                    $add = " and atmid IN (select ATMID from sites where Customer='Hitachi' and live='Y')";
                                                }




                                                $Q1 = "select count(*) as totalSites from panel_health where 1";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q1 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q1 .= $add;
                                                }
                                                $qry = mysqli_query($conn, $Q1);
                                                $fetchQry = mysqli_fetch_array($qry);
                                                if ($_SESSION['designation'] == "4") {
                                                    echo "461";
                                                } else {
                                                    echo $fetchQry['totalSites'];
                                                }
                                                ?>
                                            </h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"><a href="PanelHealthStatus.php"
                                                    style="color:white" target="_blank">Total Sites</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-primary widget-flat border-primary text-white"
                                            style="padding-bottom: 0px;">
                                            <i class="fi-archive" style="pointer-events: none; cursor: default;">RASS</i>
                                            <h>RASS</h>
                                            <h3 class="m-b-10"><?php
                                            $Q2 = "select count(*) as totalConnect from panel_health where status='0' and panelName='Rass'";
                                            if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                $Q2 .= $add;
                                            }
                                            if ($_SESSION['designation'] == "4") {
                                                $Q2 .= $add;
                                            }
                                            $Connectqry = mysqli_query($conn, $Q2);
                                            $fetchConnectQry = mysqli_fetch_array($Connectqry);

                                            $Q3 = "select count(*) as totalNotConnect from panel_health where status='1' and panelName='Rass'";
                                            if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                $Q3 .= $add;
                                            }
                                            if ($_SESSION['designation'] == "4") {
                                                $Q3 .= $add;
                                            }

                                            $NotConnectqry = mysqli_query($conn, $Q3);
                                            $fetchNotConnectQry = mysqli_fetch_array($NotConnectqry);
                                            if ($_SESSION['designation'] == "4") {
                                                echo "376/8";
                                            } else {
                                                echo $fetchConnectQry['totalConnect'] . "/" . $fetchNotConnectQry['totalNotConnect'];
                                            }
                                            ?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"><a
                                                    href="Panel_POPup.php?id=ConnRass" style="color:white"
                                                    target="_blank">Connected</a> / <a href="Panel_POPup.php?id=NotConnRass"
                                                    style="color:white" target="_blank">Not Connected</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-success bg-success text-white"
                                            style="padding-bottom: 0px;">
                                            <i class="fi-help" style="pointer-events: none; cursor: default;">Smart </i>
                                            <h>Smart-I // Smart-IN</h>
                                            <h3 class="m-b-10">
                                                <?php

                                                $Q4 = "select count(*) as totalConnect from panel_health where status='0' and panelName ='SMART -I' ";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q4 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q4 .= $add;
                                                }

                                                $Connectqry = mysqli_query($conn, $Q4);
                                                $fetchConnectQry = mysqli_fetch_array($Connectqry);

                                                $Q5 = "select count(*) as totalNotConnect from panel_health where status='1' and panelName ='SMART -I'";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q5 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q5 .= $add;
                                                }

                                                $NotConnectqry = mysqli_query($conn, $Q5);
                                                $fetchNotConnectQry = mysqli_fetch_array($NotConnectqry);


                                                $Q6 = "select count(*) as totalConnect from panel_health where status='0' and panelName ='SMART-IN' ";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q6 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q6 .= $add;
                                                }

                                                $Connectqry2 = mysqli_query($conn, $Q6);
                                                $fetchConnectQry2 = mysqli_fetch_array($Connectqry2);


                                                $Q7 = "select count(*) as totalNotConnect from panel_health where status='1' and panelName ='SMART-IN'";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q7 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q7 .= $add;
                                                }

                                                $NotConnectqry2 = mysqli_query($conn, $Q7);
                                                $fetchNotConnectQry2 = mysqli_fetch_array($NotConnectqry2);
                                                if ($_SESSION['designation'] == "4") {
                                                    echo "18/3 // 28/3";
                                                } else {
                                                    echo $fetchConnectQry['totalConnect'] . "/" . $fetchNotConnectQry['totalNotConnect'] . " // " . $fetchConnectQry2['totalConnect'] . "/" . $fetchNotConnectQry2['totalNotConnect'];
                                                }
                                                ?>
                                            </h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"><a
                                                    href="Smart_I_Panel_POPup.php?id=ConnSmarti" style="color:white"
                                                    target="_blank">Conn</a> / <a
                                                    href="Smart_I_Panel_POPup.php?id=NotConnSmarti" style="color:white"
                                                    target="_blank">NotConn</a> // <a
                                                    href="Smart_IN_Panel_POPup.php?id=ConnSmartIN" style="color:white"
                                                    target="_blank">Conn</a> / <a
                                                    href="Smart_IN_Panel_POPup.php?id=NotConnSmartIN" style="color:white"
                                                    target="_blank">NotConn</a></p>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-success bg-success text-white"
                                            style="padding-bottom: 0px;">
                                            <i class="fi-help" style="pointer-events: none; cursor: default;">Smart </i>
                                            <h>RASS PNB // RASS BOI</h>
                                            <h3 class="m-b-10">
                                                <?php

                                                $Q8 = "select count(*) as totalConnect from panel_health where status='0' and panelName ='rass_pnb' ";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q8 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q8 .= $add;
                                                }

                                                $Connectqry = mysqli_query($conn, $Q8);
                                                $fetchConnectQry = mysqli_fetch_array($Connectqry);

                                                $Q9 = "select count(*) as totalNotConnect from panel_health where status='1' and panelName ='rass_pnb'";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q9 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q9 .= $add;
                                                }

                                                $NotConnectqry = mysqli_query($conn, $Q9);
                                                $fetchNotConnectQry = mysqli_fetch_array($NotConnectqry);


                                                $Q10 = "select count(*) as totalConnect from panel_health where status='0' and panelName ='rass_boi' ";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q10 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q10 .= $add;
                                                }

                                                $Connectqry2 = mysqli_query($conn, $Q10);
                                                $fetchConnectQry2 = mysqli_fetch_array($Connectqry2);


                                                $Q11 = "select count(*) as totalNotConnect from panel_health where status='1' and panelName ='rass_boi'";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q11 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q11 .= $add;
                                                }

                                                $NotConnectqry2 = mysqli_query($conn, $Q11);
                                                $fetchNotConnectQry2 = mysqli_fetch_array($NotConnectqry2);
                                                if ($_SESSION['designation'] == "4") {
                                                    echo "18/3 // 28/3";
                                                } else {
                                                    echo $fetchConnectQry['totalConnect'] . "/" . $fetchNotConnectQry['totalNotConnect'] . " // " . $fetchConnectQry2['totalConnect'] . "/" . $fetchNotConnectQry2['totalNotConnect'];
                                                }
                                                ?>
                                            </h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"><a
                                                    href="Rass_PNB_Panel_POPup.php?id=ConnRassPNB" style="color:white"
                                                    target="_blank">Conn</a> / <a
                                                    href="Rass_PNB_Panel_POPup.php?id=NotConnRassPNB" style="color:white"
                                                    target="_blank">NotConn</a> // <a
                                                    href="Rass_BOI_Panel_POPup.php?id=ConnRassBOI" style="color:white"
                                                    target="_blank">Conn</a> / <a
                                                    href="Rass_BOI_Panel_POPup.php?id=NotConnRassBOI" style="color:white"
                                                    target="_blank">NotConn</a></p>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-success bg-success text-white"
                                            style="padding-bottom: 0px;">
                                            <i class="fi-help" style="pointer-events: none; cursor: default;">Smart </i>
                                            <h>SMART-I HDFC32 // SMART-I BOI // SMART-I PNB</h>
                                            <h3 class="m-b-10">
                                                <?php

                                                $Q12 = "select count(*) as totalConnect from panel_health where status='0' and panelName ='smarti_hdfc32' ";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q12 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q12 .= $add;
                                                }

                                                $Connectqry = mysqli_query($conn, $Q12);
                                                $fetchConnectQry = mysqli_fetch_array($Connectqry);

                                                $Q13 = "select count(*) as totalNotConnect from panel_health where status='1' and panelName ='smarti_hdfc32'";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q13 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q13 .= $add;
                                                }

                                                $NotConnectqry = mysqli_query($conn, $Q13);
                                                $fetchNotConnectQry = mysqli_fetch_array($NotConnectqry);


                                                $Q14 = "select count(*) as totalConnect from panel_health where status='0' and panelName ='smarti_boi' ";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q14 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q14 .= $add;
                                                }

                                                $Connectqry2 = mysqli_query($conn, $Q14);
                                                $fetchConnectQry2 = mysqli_fetch_array($Connectqry2);


                                                $Q15 = "select count(*) as totalNotConnect from panel_health where status='1' and panelName ='smarti_boi'";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q15 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q15 .= $add;
                                                }

                                                $NotConnectqry2 = mysqli_query($conn, $Q15);
                                                $fetchNotConnectQry2 = mysqli_fetch_array($NotConnectqry2);

                                                $Q16 = "select count(*) as totalConnect from panel_health where status='0' and panelName ='smarti_pnb' ";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q16 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q16 .= $add;
                                                }

                                                $Connectqry3 = mysqli_query($conn, $Q16);
                                                $fetchConnectQry3 = mysqli_fetch_array($Connectqry3);


                                                $Q17 = "select count(*) as totalNotConnect from panel_health where status='1' and panelName ='smarti_pnb'";
                                                if ($_SESSION['permission'] != "" && $_SESSION['designation'] == "2") {
                                                    $Q17 .= $add;
                                                }
                                                if ($_SESSION['designation'] == "4") {
                                                    $Q17 .= $add;
                                                }

                                                $NotConnectqry3 = mysqli_query($conn, $Q17);
                                                $fetchNotConnectQry3 = mysqli_fetch_array($NotConnectqry3);

                                                if ($_SESSION['designation'] == "4") {
                                                    echo "18/3 // 28/3";
                                                } else {
                                                    echo $fetchConnectQry['totalConnect'] . "/" . $fetchNotConnectQry['totalNotConnect'] . " // " . $fetchConnectQry2['totalConnect'] . "/" . $fetchNotConnectQry2['totalNotConnect'] . " // " . $fetchConnectQry3['totalConnect'] . "/" . $fetchNotConnectQry3['totalNotConnect'];
                                                }
                                                ?>
                                            </h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"><a
                                                    href="Smarti_HDFC_Panel_POPup.php?id=ConnSmartiHDFC" style="color:white"
                                                    target="_blank">Conn</a> / <a
                                                    href="Smarti_HDFC_Panel_POPup.php?id=NotConnSmartiHDFC"
                                                    style="color:white" target="_blank">NotConn</a> // <a
                                                    href="Smarti_BOI_Panel_POPup.php?id=ConnSmartiBOI" style="color:white"
                                                    target="_blank">Conn</a> / <a
                                                    href="Smarti_BOI_Panel_POPup.php?id=NotConnSmartiBOI"
                                                    style="color:white" target="_blank">NotConn</a>// <a
                                                    href="Smarti_PNB_Panel_POPup.php?id=ConnSmartiPNB" style="color:white"
                                                    target="_blank">Conn</a> / <a
                                                    href="Smarti_PNB_Panel_POPup.php?id=NotConnSmartiPNB"
                                                    style="color:white" target="_blank">NotConn</a></p>
                                        </div>
                                    </div>

                                    <!--
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-danger widget-flat border-danger text-white" style="padding-bottom: 0px;">
                                            <i class="fi-delete" style="pointer-events: none; cursor: default;">Securico</i>
                                            <h></h> Securico</h>
                                           <h3 class="m-b-10"><?php
                                           /*   $Q8="select count(*) as totalConnect from panel_health where status='0' and panelName='SEC'";
                                               if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q8.= $add;}
                                               if($_SESSION['designation']=="4"){$Q8.= $add;}
                                             
                                             $Connectqry=mysqli_query($conn,$Q8);
                                              $fetchConnectQry=mysqli_fetch_array($Connectqry);
                                              
                                              
                                              $Q9="select count(*) as totalNotConnect from panel_health where status='1' and panelName='SEC'";
                                               if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q9.= $add;}
                                               if($_SESSION['designation']=="4"){$Q9.= $add;}
                                               
                                              $NotConnectqry=mysqli_query($conn,$Q9);
                                              $fetchNotConnectQry=mysqli_fetch_array($NotConnectqry);
                                              
                                              echo $fetchConnectQry['totalConnect'] . "/" .  $fetchNotConnectQry['totalNotConnect'];
                                              */
                                           ?></h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"> <a href="SEC_Panel_POPup.php?id=ConnSEC" style="color:white" target="_blank">Connected</a> / <a href="SEC_Panel_POPup.php?id=NotConnSEC" style="color:white" target="_blank">Not Connected</a></p>
                                        </div>
                                    </div>  -->
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box" style="padding-left: 320px;">
                                        <h4 class="header-title"><b>Alert Color</b></h4>

                                        <div class="button-list">

                                            <button type="button" class="btn btn-youtube waves-effect waves-light">
                                                <i class="fa fa-frown-o"
                                                    style="font-size: 16px;border-radius: 25px;background-color: #ffb907;color: black;"
                                                    aria-hidden="true"></i> 1 - Alert
                                            </button>

                                            <button type="button" style="background-color:green"
                                                class="btn btn-dribbble waves-effect waves-light">
                                                <i class="fa fa-smile-o"
                                                    style="font-size: 16px;border-radius: 25px;background-color: #ffb907;color: black;"
                                                    aria-hidden="true"></i> 0 - Normal
                                            </button>

                                            <button type="button" style="background-color:orchid;"
                                                class="btn btn-youtube waves-effect waves-light">
                                                <i class="fa fa-thumbs-up m-r-5"></i> 9 - ByPassed
                                            </button>

                                            <button type="button"
                                                style="background-color:white;color:black;border: 2px solid black"
                                                color="red" class="btn  waves-effect waves-light">
                                                <i class="fa fa-thumbs-o-down m-r-5"></i> 2 - Disconnect
                                            </button>
                                        </div>

                                    </div>
                                </div><!-- end col -->

                            </div>




                            <div align="center" style="display:none"><input type="text" id="Atmid" name="Atmid"
                                    placeholder="Search Atm-ID" /><input type="button" value="search"
                                    onClick="a('','50')" /></div>

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


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

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
       $sr = 1;
       while ($row = mysqli_fetch_array($qrys)) { ?>

 <tr <?php if ($row[67] == 1) { ?>style="background-color:#FF0000" <?php } ?> >
    <td><?php echo $sr; ?></td>
    <td><?php echo $row[68]; ?></td>
    <td ><?php echo $row[0]; ?></td>
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


        <?php include ('footer.php'); ?>


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
            function callfn() {

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

    </html>
    <?php
} else {
    header("location: index.php");
}
?>