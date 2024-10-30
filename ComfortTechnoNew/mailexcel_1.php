<?php
// Database connection settings
include('db_connection.php');
/*
set_include_path(implode(PATH_SEPARATOR, [
    realpath(__DIR__ . '/PHPExcel/PHPExcel-1.8/Classes'), // assuming Classes is in the same directory as this script
    get_include_path()
]));

require_once 'PHPExcel.php';
require_once 'PHPExcel/IOFactory.php';
*/

require('PHPExcel.php');
include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

// require_once 'Classes/PHPExcel.php';
// require_once "Classes/PHPExcel/IOFactory.php";
// include_once 'Classes/PHPExcel/Writer/Excel5.php';

require 'mail/PHPMailer/src/PHPMailer.php';
require 'mail/PHPMailer/src/SMTP.php';
require 'mail/PHPMailer/src/Exception.php';

// Fetch data from the database
$query = "SELECT s.ATMID,s.Customer,s.Bank FROM sites s JOIN `call_log_dvr_alerts` c ON s.ATMID=c.ATMID"; 
$con = OpenCon();
$result = mysqli_query($con,$query);
CloseCon($con);
if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    // Create a new PHPExcel object
    $objPHPExcel = new PHPExcel();
    $objSheet = $objPHPExcel->getActiveSheet();

    // Fetch column names from the database result 
    $columns = array_keys(mysqli_fetch_assoc($result));

    // Set the headers (column names) in the Excel file
    $col = 'A';
    foreach ($columns as $columnName) {
        $objSheet->setCellValue($col . '1', $columnName);
        $col++;
    }

    $row = 2; 

    mysqli_data_seek($result, 0); 

    while ($rowdata = mysqli_fetch_assoc($result)) {
        $col = 'A';
        foreach ($rowdata as $value) {
            $objSheet->setCellValue($col . $row, $value);
            $col++;
        }
        $row++;
    }

    // Save the Excel file
    $excelFileName = 'call_log_excel/data.xls';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save($excelFileName);

    // Email configuration
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'mail.sarmicrosystems.in';
    $mail->SMTPAuth = true;
    $mail->Username = 'rajeshbiswas@sarmicrosystems.in';
    $mail->Password = 'rajesh.biswas@12345';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('rajeshbiswas@sarmicrosystems.in', 'Tester');
    $mail->addAddress('prabir.d06@gmail.com', 'Prabir');

    // Email subject and body
    $mail->Subject = 'Excel Data';
    $mail->Body = 'Please find attached the Excel file with data.';

    // Attach the Excel file
    $mail->addAttachment($excelFileName);

    // Send the email
    if ($mail->send()) {
        echo 'Email sent successfully';
    } else {
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
} else {
    echo 'No data found in the database.';
}

// Close the database connection
//mysqli_close($con);

?>
