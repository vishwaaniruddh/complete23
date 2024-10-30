<?php
$startTime = microtime(true);


ob_start();
    
echo 'Alarm Email' ; 


date_default_timezone_set("Asia/Calcutta"); // India time (GMT+5:30)
// error_reporting(E_ALL); // Enable error reporting for debugging
set_time_limit(0);

$username = 'alarms@advantagesb.com';
$password = 'Adv@1234#';
$emailServer = 'server1.advantagesb.com';

// $emailServer = 'webmail-b21.web-hosting.com';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$inbox = imap_open("{{$emailServer}:993/imap/ssl}INBOX", $username, $password);

$nodes = 'http://clarify.advantagesb.com/generateAutoCallFromEmailReceived21.php';

if ($inbox) {
    $emails = imap_search($inbox, 'UNSEEN');

    if ($emails) {
        rsort($emails);

        foreach ($emails as $email_number) {




   $header = imap_fetchheader($inbox, $email_number);

            // Fetch the email body
            

                $message_id = getMessageID($header);

                $structure = imap_fetchstructure($inbox, $email_number);


                imap_setflag_full($inbox, $email_number, '\\Seen');


                preg_match('/From:\s*([^<]+)<([^>]+)>/i', $header, $from_matches);
                $from_name = isset ($from_matches[1]) ? trim($from_matches[1]) : '';
                $from_email = isset ($from_matches[2]) ? trim($from_matches[2]) : '';



                preg_match('/^To:\s*(.*?)\r?\n/m', $header, $matches_to);
                preg_match('/^Cc:\s*(.*?)\r?\n/m', $header, $matches_cc);

                // Extracted To and Cc values
                $to = isset ($matches_to[1]) ? $matches_to[1] : '';
                $cc = isset ($matches_cc[1]) ? $matches_cc[1] : '';

                // Remove names from email addresses
                $to_emails = preg_replace('/[^<\s]*<([^>]*)>/', '$1', $to);
                $cc_emails = preg_replace('/[^<\s]*<([^>]*)>/', '$1', $cc);

                // Split multiple email addresses by comma
              echo  '$to_list = ' . $to_list = implode(', ', explode(',', $to_emails));
                echo '<br />';
                echo '$cc_list = '.$cc_list = implode(', ', explode(',', $cc_emails));
                

            // preg_match('/From:\s*([^<]+)<([^>]+)>/i', $header, $from_matches);
            // $from_name = isset($from_matches[1]) ? trim($from_matches[1]) : '';
            // $from_email = isset($from_matches[2]) ? trim($from_matches[2]) : '';

            
            //   // Extract To
            //   preg_match_all('/To:\s*([^<]+)<([^>]+)>/i', $header, $to_matches);
            //   $to_names = isset($to_matches[1]) ? array_map('trim', $to_matches[1]) : [];
            //   $to_emails = isset($to_matches[2]) ? array_map('trim', $to_matches[2]) : [];
            //   $to_list = implode(', ', array_map(function($name, $email) {
            //       return $name ? $name . ' <' . $email . '>' : $email;
            //   }, $to_names, $to_emails));
  
            //   // Extract Cc
            //   preg_match_all('/Cc:\s*([^<]+)<([^>]+)>/i', $header, $cc_matches);
            //   $cc_names = isset($cc_matches[1]) ? array_map('trim', $cc_matches[1]) : [];
            //   $cc_emails = isset($cc_matches[2]) ? array_map('trim', $cc_matches[2]) : [];
            //   $cc_list = implode(', ', array_map(function($name, $email) {
            //       return $name ? $name . ' <' . $email . '>' : $email;
            //   }, $cc_names, $cc_emails));
  




            

            $message = imap_fetchbody($inbox, $email_number, 1);

            $overview = imap_fetch_overview($inbox, $email_number, 0);
            $subject = $overview[0]->subject;

            if (strpos($subject, 'Device management platform alarm information') !== false) {


                $matches = [];

                // Use regex to extract the number of devices
                if (preg_match('/The VPN of (\d+) devices in the platform is offline/i', $message, $matches)) {
                    $vpn = (int) $matches[1];
                } else {
                    $vpn = 0;
                }



                $dom = new DOMDocument;
                libxml_use_internal_errors(true);

                $dom->loadHTML(mb_convert_encoding($message, 'HTML-ENTITIES', 'UTF-8'));

                libxml_use_internal_errors(false);

                $tables = $dom->getElementsByTagName('table');
                $table = $tables->item(0);

                if ($table) {
                    $snValues = [];
                    $deviceIDValues = [];
                    $descriptionValues = [];
                    $message_id = getMessageID($header);


                    foreach ($table->getElementsByTagName('tr') as $row) {
                        $cells = $row->getElementsByTagName('td');

                        if ($cells->length >= 3) {
                            $sn = trim(html_entity_decode(strip_tags($cells->item(0)->nodeValue)));
                            $deviceID = trim(html_entity_decode(strip_tags($cells->item(1)->nodeValue)));
                            $description = trim(html_entity_decode(strip_tags($cells->item(2)->nodeValue)));


                            $description = explode("/", $description);

                            $description = trim($description[0]);

                            $data = array(
                                'atmid' => $description,
                                'message' => $message,
                                'vpn' => $vpn,
                                'message_id'=>$message_id,
                                'fromEmail'=>$from_email,
                                'toEmail'=>$to_list,
                                'ccEmail'=>$cc_list,
                                'subject'=>$subject,
                            );




                            $options = array(
                                'http' => array(
                                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                                    'method' => 'POST',
                                    'content' => http_build_query($data)
                                )
                            );

                            $context = stream_context_create($options);
                            $result = file_get_contents($nodes, false, $context);


                            $snValues[] = $sn;
                            $deviceIDValues[] = $deviceID;
                            $descriptionValues[] = $description;

                var_dump($result);

                        }
                    }

                    // var_dump($snValues, $deviceIDValues, $descriptionValues);

                    // echo '<br/>';

                }
            }
        }
    }
}
imap_close($inbox);


    
function getMessageID($header) {
    preg_match('/Message-ID:\s*<([^>]+)>/i', $header, $matches);
    if (isset($matches[1])) {
        return $matches[1];
    } else {
        return null;
    }
}

$logFile = './AlarmLog.log';

$endTime = microtime(true);
$executionTime = $endTime - $startTime;
$output = ob_get_clean();
$currentDateTime = date('Y-m-d H:i:s');
// Construct the log message with date and time
$logMessage = "$currentDateTime: Script completed in $executionTime seconds. Output: $output";

// Append the log message to the log file
file_put_contents($logFile, $logMessage . PHP_EOL, FILE_APPEND);