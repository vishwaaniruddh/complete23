<?php
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

// SQL query to get individual DVR counts
$sql = "SELECT dvrname, COUNT(1) AS count FROM all_dvr_live WHERE DATE(cdate) <> CURDATE() GROUP BY dvrname";

// Execute SQL query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an array to hold DVR data
    $dvr_data = array();
    $total_count = 0;

    // Fetch results and calculate total count
    while ($row = $result->fetch_assoc()) {
        $dvr_data[] = array(
            'dvrname' => $row['dvrname'],
            'count' => $row['count']
        );
        $total_count += intval($row['count']);
    }

    // Close MySQL connection
    $conn->close();

    // Construct HTML email body with a table
    $email_body = '<html><body>';
    $email_body .= '<h2>Daily DVR Count Report</h2>';
    $email_body .= '<table border="1" cellspacing="0" cellpadding="10">';
    $email_body .= '<tr><th>DVR Name</th><th>Count</th></tr>';
    
    foreach ($dvr_data as $dvr) {
        $email_body .= '<tr>';
        $email_body .= '<td>' . $dvr['dvrname'] . '</td>';
        $email_body .= '<td>' . $dvr['count'] . '</td>';
        $email_body .= '</tr>';
    }
    
    // Add total count row
    $email_body .= '<tr><td><strong>Total</strong></td><td><strong>' . $total_count . '</strong></td></tr>';
    
    $email_body .= '</table>';
    $email_body .= '</body></html>';

    // Encode email body for URL
    $email_body_encoded = urlencode($email_body);

    // Append email_body as a GET parameter to the API URL
    $api_url .= '?email_body=' . $email_body_encoded;

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPGET => true, // Use HTTP GET method
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
