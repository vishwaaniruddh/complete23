<?php
return ; 
include('db_connection.php');
$conn = OpenCon();
$sql = mysqli_query($conn, "Select * from gpssites");
while ($sql_result = mysqli_fetch_assoc($sql)) {

    $atmid = $sql_result['ATMID'];
    $username = $sql_result['UserName'];
    $password = $sql_result['Password'];
    $dvrname = $sql_result['dvrname'];
    $ip = $sql_result['IPAddress'];
    $port = '80';
    $customer = $sql_result['customer'];
    $live = 'Y';
    $sn = $sql_result['id'];
    $project = 'gpssites';



    $insert = "insert into all_dvr_live(UserName, Password, dvrname, IPAddress, port, customer, live, atmid, SN, project)
    VALUES('".$username."','".$password."','".$dvrname."', '".$ip."', '".$port."','".$customer."','Y','".$atmid."','".$sn."','".$project."')
    " ; 

    if(mysqli_query($conn,$insert)){
echo 'ATMID ' .$atmid .  ' Added to all_dvr_live' ; 
echo '<br />';
    }



    echo '<br />';
}


?>