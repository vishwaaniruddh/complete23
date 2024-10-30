<?php
// Database connection settings
include('db_connection.php');


// Fetch data from the database
$query = "SELECT s.ATMID,s.Customer,s.Bank FROM sites s JOIN `call_log_dvr_alerts` c ON s.ATMID=c.ATMID"; 
$con = OpenCon();
$result = mysqli_query($con,$query);
CloseCon($con);

require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

if (mysqli_num_rows($result) > 0) {
    
    // Save the Excel file
   // $excelFileName = 'call_log_excel/data.xls';
     $excelFileName = 'PHPExcel/Test.xlsx';
    // Email configuration
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'otp@comforttechno.com';
    $mail->Password = 'Css@ctop321';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('otp@comforttechno.com','comforttechno');
    $mail->addAddress('prabir.d06@gmail.com', 'Prabir');

    // Email subject and body
    $mail->Subject = 'Excel Data';
    $mail->Body = 'Please find attached the Excel file with data.';

    // Attach the Excel file
   // $mail->addAttachment($excelFileName);

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
