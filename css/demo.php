<?php
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = $conn;







 
$sql = mysqli_query($con, "select * from sites where atmid not in(select atmid from all_dvr_live where project='sites') and live in ('Y','T')");
while ($sqlResult = mysqli_fetch_assoc($sql)) {

echo    $atmid = $sqlResult['ATMID'];
echo '<br />';
    $ip = $sqlResult['DVRIP'];
    $sn = $sqlResult['SN'];
    $customer = $sqlResult['Customer'];
    
    $uname = $sqlResult['UserName'];
    $password = $sqlResult['Password'];
    $DVRName = $sqlResult['DVRName'];
    $port = $sqlResult['dvr_port'];
    $live = $sqlResult['live'];
    $project ='sites';


    $dvrinsert = "insert into all_dvr_live(UserName,Password,dvrname,IPAddress,port,customer,live,atmid,SN,project,ipcamport) 
    VALUES('".$uname."','".$password."','".$DVRName."','".$ip."','".$port."','".$customer."','".$live."','".$atmid."','".$sn."','sites','81')
    ";

    mysqli_query($con,$dvrinsert);


}





return;
"select * from sites where atmid not in(select atmid from all_dvr_live where project='sites') and live in ('Y','T')" ; 
$sql = mysqli_query($con, "select * from sites where atmid not in(select atmid from all_dvr_live where project='sites') and live in ('Y','T')");
while ($sqlResult = mysqli_fetch_assoc($sql)) {

echo    $atmid = $sqlResult['ATMID'];
echo '<br />';
    $ip = $sqlResult['DVRIP'];
    $sn = $sqlResult['SN'];



}










































return;
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
        echo "<td>$dc_date</td>"; // Use the actual dc_date here
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


return;

$sql = mysqli_query($conn, "select ATMID, NewPanelID from sites where server_ip=23");
while ($sql_result = mysqli_fetch_assoc($sql)) {

    $atmid = $sql_result['ATMID'];
    $panelid = $sql_result['NewPanelID'];

    mysqli_query($conn, "INSERT INTO down_communication(atm_id,panel_id) VALUES('" . $atmid . "','" . $panelid . "')");

}


return;
$sql = mysqli_query($conn, "select  * from sites21table");
while ($sql_result = mysqli_fetch_assoc($sql)) {

    $server_ip = $sql_result['server_ip'];
    $panelid = $sql_result['NewPanelID'];


    mysqli_query($conn, "update sites set server_ip='" . $server_ip . "' where NewPanelID='" . $panelid . "'");



}





return;


$sql = mysqli_query($conn, "select * from site_circle");
while ($sql_result = mysqli_fetch_assoc($sql)) {


    $atmid = $sql_result['ATMID'];
    $id = $sql_result['id'];


    $sn = mysqli_fetch_assoc(mysqli_query($conn, "select SN from sites where ATMID='" . $atmid . "'"))['SN'];

    mysqli_query($conn, "update site_circle set sn='" . $sn . "' where id='" . $id . "'");


}





return;
set_time_limit(-1); // Disable the script execution time limit

session_start();
include('config.php');
error_reporting(1);

require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$batchSize = 110000; // Set the batch size

// Get the current batch number from the session
$currentBatch = isset($_SESSION['currentBatch']) ? $_SESSION['currentBatch'] : 1;

// Calculate the offset based on the current batch
$offset = ($currentBatch - 1) * $batchSize;


// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// SQL Query
$statement = "SELECT a.Customer AS 'Client Name', b.id AS 'Incident Number', a.Zone AS Region, a.ATMID,
 a.SiteAddress AS Address, a.City, a.State, b.createtime AS 'Incident Date Time',
 b.receivedtime AS 'Alarm Received Date Time', b.receivedtime AS 'Close Date Time', a.DVRIP, b.panelid, a.Bank,
(CASE WHEN LOWER(RIGHT(b.alarm,1))='R' THEN 'Non-Reactive' ELSE 'Reactive' END) AS `Reactive`,
b.closedBy AS 'Closed By', b.closedtime AS 'Closed Date', 
CONCAT(b.closedtime, '*', b.comment, '*', b.closedBy) AS Remark,
b.zone, b.alarm,
a.Panel_Make,
'' AS  `Incident Category`,
(CASE WHEN LOWER(RIGHT(b.alarm,1))='R' THEN 'Restoral' END) AS `Alarm Message`
FROM alerts b 
INNER JOIN sites a ON b.panelid = a.NewPanelID
LEFT JOIN sites c ON b.panelid = c.OldPanelID
WHERE 1 ";

// Modify the SQL query to include LIMIT and OFFSET
$statement .= " LIMIT $batchSize OFFSET $offset";

// Execute the modified SQL query
$sql = mysqli_query($conn, $statement);

$headerRow = [
    'Sr No',
    'Client Name',
    'Incident Number',
    'Region',
    'ATMID',
    'Address',
    'City',
    'State',
    'Incident Category',
    'Alarm Message',
    'Incident Date Time',
    'Alarm Received Date Time',
    'Close Date Time',
    'DVRIP',
    'Panel_make',
    'panelid',
    'Bank',
    'Reactive',
    'Closed By',
    'Closed Date',
    'Remark',
    'Zone',
    'alarm'
];


$columnIndex = 1;
foreach ($headerRow as $header) {
    $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
    $columnIndex++;
}


$rowIndex = 2;
$srno = 1;

$rowIndex = 2; // Start from the second row (after headers)
$srno = 1; // Reset Sr No for each batch

while ($row = mysqli_fetch_assoc($sql)) {
    $columnIndex = 1; // Reset column index for each row


    $_panel_make = $row['Panel_Make'];
    $_zone = $row['zone'];


    if ($_panel_make == 'RASS') {
        $_b_sql = mysqli_query($conn, "select SensorName from rass WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    } elseif ($_panel_make == 'rass_sbi') {
        $_b_sql = mysqli_query($conn, "select SensorName from rass_sbi WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    } elseif ($_panel_make == 'rass_cloud') {
        $_b_sql = mysqli_query($conn, "select SensorName from rass_cloud WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    } elseif ($_panel_make == 'rass_boi') {
        $_b_sql = mysqli_query($conn, "select SensorName from rass_boi WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    } elseif ($_panel_make == 'Raxx') {
        $_b_sql = mysqli_query($conn, "select SensorsName from Raxx WHERE ZoneNumber like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorsName'];
    } elseif ($_panel_make == 'sec_sbi') {
        $_b_sql = mysqli_query($conn, "select sensorname from sec_sbi WHERE zone like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['sensorname'];
    } elseif ($_panel_make == 'securico_gx4816') {
        $_b_sql = mysqli_query($conn, "select sensorname from securico_gx4816 WHERE zone like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['sensorname'];
    } elseif ($_panel_make == 'smarti_hdfc32') {
        $_b_sql = mysqli_query($conn, "select SensorName from smarti_hdfc32 WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    } elseif ($_panel_make == 'SMART-IN') {
        $_b_sql = mysqli_query($conn, "select SensorName from smartinew WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    } elseif ($_panel_make == 'SMART -I') {
        $_b_sql = mysqli_query($conn, "select SensorName from smartinew WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    } elseif ($_panel_make == 'smarti_boi') {
        $_b_sql = mysqli_query($conn, "select SensorName from smarti_boi WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    } elseif ($_panel_make == 'smarti_pnb') {
        $_b_sql = mysqli_query($conn, "select SensorName from smarti_pnb WHERE ZONE like '" . $_zone . "'");
        $_b_sql_result = mysqli_fetch_assoc($_b_sql);
        $sensorname = $_b_sql_result['SensorName'];
    }


    if (strtolower(substr($row['alarm'], -1)) == 'r') {
        $alarm_msg = $sensorname . ' Restoral';
    } else {
        $alarm_msg = $sensorname;
    }


    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $srno);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['ATMID']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Client Name']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Incident Number']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Region']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['ATMID']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Address']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['City']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['State']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $sensorname);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $alarm_msg);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Incident Date Time']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Alarm Received Date Time']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Close Date Time']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['DVRIP']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $_panel_make);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['panelid']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Bank']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Reactive']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Closed By']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Closed Date']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['Remark']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['zone']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $row['alarm']);

    $rowIndex++;
    $srno++;
}



if (mysqli_num_rows($sql) == 0) {
    unset($_SESSION['currentBatch']);
}

$writer = new Xlsx($spreadsheet);

$tempFile = tempnam(sys_get_temp_dir(), 'Inventory');
$writer->save($tempFile);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ExportedRecords.xlsx"');
header('Cache-Control: max-age=0');
readfile($tempFile);

mysqli_close($con);

unlink($tempFile);

