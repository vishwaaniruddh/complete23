<?php
session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
    include 'config.php';
    $comm = $_POST['comm'];

    $alt = "select createtime from alerts order by id asc limit 1";
    $runalt = mysqli_query($conn, $alt);
    $altfetch = mysqli_fetch_array($runalt);
    //echo $altfetch[0];
    $altlast = "select createtime from alerts order by id desc limit 1";
    $runaltlast = mysqli_query($conn, $altlast);
    $altlastfetch = mysqli_fetch_array($runaltlast);

    $helth = "select rtime from wsites order by id asc limit 1";
    $runhelth = mysqli_query($conn, $helth);
    $healthfetch = mysqli_fetch_array($runhelth);


    $blanck_date = date('Y-m-d', strtotime($healthfetch[0] . ' -1 day'));
    $sr = 0;

    date_default_timezone_set('Asia/Kolkata');
    $currtime = date('Y-m-d');
    $pre_date = date('Y-m-d', strtotime($currtime . ' -1 day'));
    $pre_date2 = date('Y-m-d', strtotime($currtime . ' -2 day'));
    $pre_date7 = date('Y-m-d', strtotime($currtime . ' -7 day'));
    $pre_date15 = date('Y-m-d', strtotime($currtime . ' -15 day'));

    ?>

    <html>

    <style>
        table {
            width: 100%;
        }

        td {
            padding: 10px;
            font-size: 12px;
            font-weight: bold;
            color: #000;
        }

        tr:hover {
            background-color: #eee !important;
        }

        tr,
        th {
            padding: 10px;
            background-color: #8cb77e;
            color: #fff;
            font-size: 12px;
        }
    </style>

    <table border=1 style="margin-top:30px">
        <tr>
            <th>sr</th>
            <th>Customer</th>
            <th>Bank</th>
            <th>Atm Id</th>
            <th>ATM Short Name</th>
            <th>City</th>
            <th>state</th>
            <th>panel_make</th>
            <th>OLD Panel id</th>
            <th>New panel id</th>
            <th>dvr ip</th>
            <th>dvr name</th>
            <th>Last alert Receive</th>
            <th>Bm Name</th>
            <th>Bm Number</th>
            <th>Zone</th>
        </tr>

        <?php

        if ($comm == "1") {


            $sp = "select OLDPanelid,NewPanelID,Customer,atmid,ATMShortName,City,state,panel_make,dvrip,dvrname,username,password,Zone,Bank from sites where live='Y'";
            ;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>
            <div align="center">total records:<?php echo $Num_Rows ?></div>
            <?php
            if (mysqli_num_rows($rst) > 0) {
                while ($fetch = mysqli_fetch_array($rst)) {
                    $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "')  and rtime between '" . $currtime . " 00:00:00" . "' and '" . $currtime . " 23:59:59" . "'";
                    //echo $sq;
                    $runsq = mysqli_query($conn, $sq);
                    if (mysqli_num_rows($runsq) > 0) {
                        $fetch3 = mysqli_fetch_array($runsq);
                        $s = substr($fetch3[0], 1);
                        $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Zone,Bank from sites where live='Y'  and DVRIP='" . $s . "'";

                        $runab = mysqli_query($conn, $ab);
                        $numrow = mysqli_num_rows($runab);
                        $fetch2 = mysqli_fetch_array($runab);

                        $bmname = "select CSSBM,CSSBMNumber from esurvsites where ATM_ID='" . $fetch2[1] . "'";
                        $runbmname = mysqli_query($conn, $bmname);
                        $bmfetch = mysqli_fetch_array($runbmname);
                        ?>

                        <tr style="background-color:#cfe8c7">
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $fetch['Customer']; ?></td>
                            <td><?php echo $fetch['Bank']; ?></td>
                            <td><?php echo $fetch2[2]; ?></td>
                            <td><?php echo $fetch2[3];
                            ; ?></td>
                            <td><?php echo $fetch2[4]; ?></td>
                            <td><?php echo $fetch2[5]; ?></td>
                            <td><?php echo $fetch2[6]; ?></td>
                            <td><?php echo $fetch2[11]; ?></td>
                            <td><?php echo $fetch2[7]; ?></td>
                            <td><?php echo $fetch2[8]; ?></td>
                            <td><?php echo $fetch3[1]; ?></td>
                            <td><?php echo $bmfetch[0]; ?></td>
                            <td><?php echo $bmfetch[1]; ?></td>
                            <td><?php echo $fetch2[12]; ?></td>
                        </tr>
                        <?php

                        $sr++;
                    }
                }
            }
        } elseif ($comm == "2") {

            $todayDate = date('Y-m-d');  // Format for comparison with `dc_date`
    
            // SQL query to fetch records from `sites` table
            $thissql = mysqli_query($conn, "SELECT * FROM sites WHERE live='Y' AND server_ip=23");

            // Check if query was successful
            if ($thissql === false) {
                die("Query failed: " . mysqli_error($conn));
            }

            $sr = 1; // Initialize the serial number for the HTML table rows
            $workingCount = 0;
            $notWorkingCount = 0;

            // Process each record from `sites`
            while ($thissql_result = mysqli_fetch_assoc($thissql)) {
                $Customer = $thissql_result['Customer'];
                $Bank = $thissql_result['Bank'];
                $ATMID = $thissql_result['ATMID'];
                $ATMShortName = $thissql_result['ATMShortName'];
                $City = $thissql_result['City'];
                $state = $thissql_result['State'];
                $panel_make = $thissql_result['Panel_Make'];
                $OLDPanelid = $thissql_result['OldPanelID'];
                $NewPanelID = $thissql_result['NewPanelID'];
                $dvrip = $thissql_result['DVRIP'];
                $dvrname = $thissql_result['DVRName'];
                $Zone = $thissql_result['Zone'];

                // Fetch the `dc_date` from `down_communication` for the current `NewPanelID`
                $dcQuery = mysqli_prepare($conn, "SELECT dc_date FROM down_communication WHERE panel_id = ?");
                mysqli_stmt_bind_param($dcQuery, 's', $NewPanelID);
                mysqli_stmt_execute($dcQuery);
                $dcResult = mysqli_stmt_get_result($dcQuery);

                $dc_date = null;
                if ($dc_row = mysqli_fetch_assoc($dcResult)) {
                    $dc_date = $dc_row['dc_date'];
                }

                // Extract the date part from the `DATETIME` value
                $dc_date_only = is_null($dc_date) ? null : date('Y-m-d', strtotime($dc_date));

                // Determine if it's working or not
                $isNotWorking = ($dc_date_only !== $todayDate);

                if ($isNotWorking) {
                    $notWorkingCount++;
                    $rowColor = "#f8d7da"; // Red for not working
    
                    $bmname = mysqli_prepare($conn, "SELECT CSSBM, CSSBMNumber FROM esurvsites WHERE ATM_ID = ?");
                    mysqli_stmt_bind_param($bmname, 's', $ATMID);
                    mysqli_stmt_execute($bmname);
                    $runbmname = mysqli_stmt_get_result($bmname);

                    if ($runbmname === false) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    $bmfetch = mysqli_fetch_array($runbmname);

                    // echo $dc_date;
                    // echo '<br />';
                    // Output HTML table row
                    echo '<tr>';
                    echo "<td>$sr</td>";
                    echo "<td>$Customer</td>";
                    echo "<td>$Bank</td>";
                    echo "<td>$ATMID</td>";
                    echo "<td>$ATMShortName</td>";
                    echo "<td>$City</td>";
                    echo "<td>$state</td>";
                    echo "<td>$panel_make</td>";
                    echo "<td>$OLDPanelid</td>";
                    echo "<td>$NewPanelID</td>";
                    echo "<td>$dvrip</td>";
                    echo "<td>$dvrname</td>";
                    echo "<td style='white-space:nowrap;'>".($dc_date ?: '-')."</td>";
                    // echo "<td>$dc_date</td>"; // Use the actual dc_date here
                    echo "<td>{$bmfetch[0]}</td>";
                    echo "<td>{$bmfetch[1]}</td>";
                    echo "<td>$Zone</td>";
                    echo '</tr>';

                    $sr++; // Increment the serial number
    
                } else {
                    $workingCount++;
                    $rowColor = "#d4edda"; // Green for working
                }
            }

            ?>
            <div align="center">
                <strong>Total records: <?php echo $workingCount + $notWorkingCount; ?></strong>
                <hr>
                <span style="color:green;">Working ATMs: <?php echo $workingCount; ?></span>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span style="color:red;">Not Working ATMs: <?php echo $notWorkingCount; ?></span>
            </div>

        <?php

        } else if ($comm == "0") {
            $sp = "select OLDPanelid,NewPanelID,Customer,atmid,ATMShortName,City,state,panel_make,dvrip,dvrname,username,password,Bank from sites where live='Y'  and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";
            ;
            //echo $sp;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>
                <!--<div align="center">total records:<?php echo $Num_Rows ?></div>-->
                <?php
                while ($fetch = mysqli_fetch_array($rst)) {

                    $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "') and rtime between '" . $altfetch[0] . "' and '" . $altlastfetch[0] . "'  and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";

                    $runsq = mysqli_query($conn, $sq);
                    //if(mysqli_num_rows($runsq)>0){ continue; }
                    // $fetch3=mysqli_fetch_array($runsq);
                    //$s= substr($fetch3[0], 1);
        
                    $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='" . $fetch[0] . "' and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";
                    //echo $ab;
        
                    $runab = mysqli_query($conn, $ab);
                    $numrow = mysqli_num_rows($runab);



                    $fetch2 = mysqli_fetch_array($runab);
                    $q = "select max(rtime) from wsites where ip='/" . $fetch[0] . "'";
                    //echo $sq;
                    $runq = mysqli_query($conn, $q);

                    $fet2 = mysqli_fetch_array($runq);



                    ?>

                    <tr style="background-color:#cfe8c7">
                        <td><?php echo $sr; ?></td>
                        <td><?php echo $fetch['Customer']; ?></td>
                        <td><?php echo $fetch['Bank']; ?></td>
                        <td><?php echo $fetch['atmid']; ?></td>
                        <td><?php echo $fetch['ATMShortName']; ?></td>
                        <td><?php echo $fetch['City']; ?></td>
                        <td><?php echo $fetch['state']; ?></td>
                        <td><?php echo $fetch['panel_make']; ?></td>
                        <td><?php echo $fetch['OLDPanelid']; ?></td>
                        <td><?php echo $fetch['NewPanelID']; ?></td>
                        <td><?php echo $fetch['dvrip']; ?></td>
                        <td><?php echo $fetch['dvrname']; ?></td>
                    <?php if ($fet2[0] != "") { ?>
                            <td><?php echo $fet2[0]; ?></td>
                    <?php } else { ?>
                            <td><?php echo $blanck_date; ?></td>
                    <?php } ?>

                    </tr>
                    <?php

                    $sr++;

                }
                $abs = $sr++;
                $absf = $abs - 1;
                ?>
                <div align="center">total records:<?php echo $absf; ?></div> <?php
        } elseif ($comm == "3") {
            $sp = "select oldpanelid,newpanelid from sites where live='Y'  and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";
            ;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>

                <?php
                while ($fetch = mysqli_fetch_array($rst)) {

                    $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "') and rtime between '" . $pre_date2 . " 00:00:00" . "' and '" . $currtime . " 23:59:59" . "' and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";

                    $runsq = mysqli_query($conn, $sq);
                    if (mysqli_num_rows($runsq) > 0) {
                        continue;
                    }

                    $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='" . $fetch[0] . "' and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";

                    $runab = mysqli_query($conn, $ab);
                    $numrow = mysqli_num_rows($runab);



                    $fetch2 = mysqli_fetch_array($runab);
                    $q = "select max(rtime) from wsites where ip='/" . $fetch[0] . "'";

                    $runq = mysqli_query($conn, $q);

                    $fet2 = mysqli_fetch_array($runq);



                    ?>

                    <tr style="background-color:#cfe8c7">
                        <td><?php echo $sr; ?></td>
                        <td><?php echo $fetch2[0]; ?></td>
                        <td><?php echo $fetch2[1]; ?></td>
                        <td><?php echo $fetch2[2]; ?></td>
                        <td><?php echo $fetch2[3];
                        ; ?></td>
                        <td><?php echo $fetch2[4]; ?></td>
                        <td><?php echo $fetch2[5]; ?></td>
                        <td><?php echo $fetch2[6]; ?></td>
                        <td><?php echo $fetch2[11]; ?></td>
                        <td><?php echo $fetch2[7]; ?></td>
                        <td><?php echo $fetch2[8]; ?></td>
                        <td><?php echo $fet2[0]; ?></td>

                    </tr>
                    <?php

                    $sr++;

                }
                $abs = $sr++;
                $absf = $abs - 1;
                ?>
                <div align="center">total records:<?php echo $absf; ?></div> <?php
        } elseif ($comm == "4") {
            $sp = "select oldpanelid,newpanelid from sites where live='Y'";
            ;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>

                <?php
                while ($fetch = mysqli_fetch_array($rst)) {

                    $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "') and rtime between '" . $pre_date7 . " 00:00:00" . "' and '" . $currtime . " 23:59:59" . "'";

                    $runsq = mysqli_query($conn, $sq);
                    if (mysqli_num_rows($runsq) > 0) {
                        continue;
                    }

                    $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='" . $fetch[0] . "'";

                    $runab = mysqli_query($conn, $ab);
                    $numrow = mysqli_num_rows($runab);



                    $fetch2 = mysqli_fetch_array($runab);
                    $q = "select max(rtime) from wsites where ip='/" . $fetch[0] . "'";

                    $runq = mysqli_query($conn, $q);

                    $fet2 = mysqli_fetch_array($runq);



                    ?>

                    <tr style="background-color:#cfe8c7">
                        <td><?php echo $sr; ?></td>
                        <td><?php echo $fetch2[0]; ?></td>
                        <td><?php echo $fetch2[1]; ?></td>
                        <td><?php echo $fetch2[2]; ?></td>
                        <td><?php echo $fetch2[3];
                        ; ?></td>
                        <td><?php echo $fetch2[4]; ?></td>
                        <td><?php echo $fetch2[5]; ?></td>
                        <td><?php echo $fetch2[6]; ?></td>
                        <td><?php echo $fetch2[11]; ?></td>
                        <td><?php echo $fetch2[7]; ?></td>
                        <td><?php echo $fetch2[8]; ?></td>
                        <td><?php echo $fet2[0]; ?></td>

                    </tr>
                    <?php

                    $sr++;

                }
                $abs = $sr++;
                $absf = $abs - 1;
                ?>
                <div align="center">total records:<?php echo $absf; ?></div> <?php
        } elseif ($comm == "5") {
            $sp = "select oldpanelid,newpanelid from sites where live='Y'";
            ;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>

                <?php
                while ($fetch = mysqli_fetch_array($rst)) {

                    $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "') and rtime between '" . $pre_date15 . " 00:00:00" . "' and '" . $currtime . " 23:59:59" . "'";

                    $runsq = mysqli_query($conn, $sq);
                    if (mysqli_num_rows($runsq) > 0) {
                        continue;
                    }

                    $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID from sites where live='Y'  and DVRIP='" . $fetch[0] . "'";

                    $runab = mysqli_query($conn, $ab);
                    $numrow = mysqli_num_rows($runab);



                    $fetch2 = mysqli_fetch_array($runab);
                    $q = "select max(rtime) from wsites where ip='/" . $fetch[0] . "'";

                    $runq = mysqli_query($conn, $q);

                    $fet2 = mysqli_fetch_array($runq);



                    ?>

                    <tr style="background-color:#cfe8c7">
                        <td><?php echo $sr; ?></td>
                        <td><?php echo $fetch2[0]; ?></td>
                        <td><?php echo $fetch2[1]; ?></td>
                        <td><?php echo $fetch2[2]; ?></td>
                        <td><?php echo $fetch2[3];
                        ; ?></td>
                        <td><?php echo $fetch2[4]; ?></td>
                        <td><?php echo $fetch2[5]; ?></td>
                        <td><?php echo $fetch2[6]; ?></td>
                        <td><?php echo $fetch2[11]; ?></td>
                        <td><?php echo $fetch2[7]; ?></td>
                        <td><?php echo $fetch2[8]; ?></td>
                        <td><?php echo $fet2[0]; ?></td>

                    </tr>
                    <?php

                    $sr++;

                }
                $abs = $sr++;
                $absf = $abs - 1;
                ?>
                <div align="center">total records:<?php echo $absf; ?></div> <?php
        }

        ?>

    </table>

    </form>


    </div>

    </body>

    </html>
    <?php
} else {
    header("location: index.php");
}
?>