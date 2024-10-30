<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Database connection settings
$host = '192.168.100.24';
$username = 'dvrhealth';
$password = 'dvrhealth';
$database = 'esurv';

// API endpoint
$api_url = 'https://srishringarr.com/dvr_mail.php';

// Connect to MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get individual DVR counts for specified intervals
$sql = "
    SELECT dvrname,
        SUM(CASE WHEN TIMESTAMPDIFF(HOUR, cdate, NOW()) > 4 THEN 1 ELSE 0 END) AS not_updated_4h,
        SUM(CASE WHEN TIMESTAMPDIFF(HOUR, cdate, NOW()) > 8 THEN 1 ELSE 0 END) AS not_updated_8h,
        SUM(CASE WHEN TIMESTAMPDIFF(HOUR, cdate, NOW()) > 12 THEN 1 ELSE 0 END) AS not_updated_12h,
        SUM(CASE WHEN TIMESTAMPDIFF(HOUR, cdate, NOW()) > 24 THEN 1 ELSE 0 END) AS not_updated_24h
    FROM all_dvr_live
    WHERE DATE(cdate) <> CURDATE()
    GROUP BY dvrname
";

// Execute SQL query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an array to hold DVR data
    $dvr_data = array();
    $total_counts = array(
        'not_updated_4h' => 0,
        'not_updated_8h' => 0,
        'not_updated_12h' => 0,
        'not_updated_24h' => 0
    );

    // Fetch results and calculate total counts
    while ($row = $result->fetch_assoc()) {
        $dvr_data[] = array(
            'dvrname' => $row['dvrname'],
            'not_updated_4h' => $row['not_updated_4h'],
            'not_updated_8h' => $row['not_updated_8h'],
            'not_updated_12h' => $row['not_updated_12h'],
            'not_updated_24h' => $row['not_updated_24h']
        );
        $total_counts['not_updated_4h'] += intval($row['not_updated_4h']);
        $total_counts['not_updated_8h'] += intval($row['not_updated_8h']);
        $total_counts['not_updated_12h'] += intval($row['not_updated_12h']);
        $total_counts['not_updated_24h'] += intval($row['not_updated_24h']);
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('DVR Count Report');
// Set header row
$sheet->setCellValue('A1', 'Sr No')
    ->setCellValue('B1', 'Username')
    ->setCellValue('C1', 'Password') // 'password' corrected to 'Password'
    ->setCellValue('D1', 'dvr name') // 'dvr name' corrected to 'dvrname'
    ->setCellValue('E1', 'IP')
    ->setCellValue('F1', 'port')
    ->setCellValue('G1', 'customer')
    ->setCellValue('H1', 'cdate')
    ->setCellValue('I1', 'last_communication')
    ->setCellValue('J1', 'status')
    ->setCellValue('K1', 'login_status')
    ->setCellValue('L1', 'aging');

$rowNumber = 2; // Start from row 2 to avoid overwriting the header row

$datasql = mysqli_query($conn, "SELECT 
    Username,
    Password,
    dvrname,
    IPAddress,
    port,
    customer,
    cdate,
    last_communication,
    status,
    login_status,
    CASE
        WHEN TIMESTAMPDIFF(HOUR, cdate, NOW()) > 24 THEN '24+ hours'
        WHEN TIMESTAMPDIFF(HOUR, cdate, NOW()) > 12 THEN '12-24 hours'
        WHEN TIMESTAMPDIFF(HOUR, cdate, NOW()) > 8 THEN '8-12 hours'
        WHEN TIMESTAMPDIFF(HOUR, cdate, NOW()) > 4 THEN '4-8 hours'
        ELSE '0-4 hours'
    END AS aging
FROM 
    all_dvr_live
WHERE 
    DATE(cdate) <> CURDATE()");

while ($datasql_result = mysqli_fetch_assoc($datasql)) {
    $sheet->setCellValue('A' . $rowNumber, $rowNumber - 1) // Adjust row number to start from 2
        ->setCellValue('B' . $rowNumber, $datasql_result['Username'])
        ->setCellValue('C' . $rowNumber, $datasql_result['Password'])
        ->setCellValue('D' . $rowNumber, $datasql_result['dvrname'])
        ->setCellValue('E' . $rowNumber, $datasql_result['IPAddress'])
        ->setCellValue('F' . $rowNumber, $datasql_result['port'])
        ->setCellValue('G' . $rowNumber, $datasql_result['customer'])
        ->setCellValue('H' . $rowNumber, $datasql_result['cdate'])
        ->setCellValue('I' . $rowNumber, $datasql_result['last_communication'])
        ->setCellValue('J' . $rowNumber, $datasql_result['status'])
        ->setCellValue('K' . $rowNumber, $datasql_result['login_status'])
        ->setCellValue('L' . $rowNumber, $datasql_result['aging']);
    $rowNumber++;
}

// Save Excel file
$filename = 'DVR_Count_Report_' . date('Ymd_His') . '.xlsx';

$filePath = './' . $filename;
$writer = new Xlsx($spreadsheet);
$writer->save($filePath);


    echo "Excel report generated: " . $filePath;

    // Read the file content
    $file_content = file_get_contents($filePath);
    $file_content_encoded = base64_encode($file_content);

    // Construct HTML email body with a table
    $email_body = '<html><body>';
    $email_body .= '<h2>Daily DVR Count Report</h2>';
    $email_body .= '<table border="1" cellspacing="0" cellpadding="10">';
    $email_body .= '<tr><th>DVR Name</th><th>4h</th><th>8h</th><th>12h</th><th>24h</th></tr>';

    foreach ($dvr_data as $dvr) {
        $email_body .= '<tr>';
        $email_body .= '<td>' . $dvr['dvrname'] . '</td>';
        $email_body .= '<td>' . $dvr['not_updated_4h'] . '</td>';
        $email_body .= '<td>' . $dvr['not_updated_8h'] . '</td>';
        $email_body .= '<td>' . $dvr['not_updated_12h'] . '</td>';
        $email_body .= '<td>' . $dvr['not_updated_24h'] . '</td>';
        $email_body .= '</tr>';
    }

    $email_body .= '<tr><td><strong>Total</strong></td><td><strong>' . $total_counts['not_updated_4h'] . '</strong></td><td><strong>' . $total_counts['not_updated_8h'] . '</strong></td><td><strong>' . $total_counts['not_updated_12h'] . '</strong></td><td><strong>' . $total_counts['not_updated_24h'] . '</strong></td></tr>';

    $email_body .= '</table>';
    $email_body .= '</body></html>';

    // Prepare POST fields
    $post_fields = array(
        'email_body' => $email_body,
        'file_name' => $filename,
        'file_content' => $file_content_encoded
    );

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true, // Use HTTP POST method
        CURLOPT_POSTFIELDS => http_build_query($post_fields),
        CURLOPT_SSL_VERIFYPEER => false // Ignore SSL verification (consider improving security)
    ));

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        echo "Error: " . curl_error($curl);
    } else {
        // Display response from the API
        echo "API Response: " . $response;
    }

    // Close cURL session
    curl_close($curl);

} else {
    echo "No results found";
}
?>
