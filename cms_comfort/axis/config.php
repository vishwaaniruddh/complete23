<?php 
$host="localhost";
$user="sarmicro_esurvwb";
$pass="esurv123*";
$dbname="sarmicro_esurvweb";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected succesfull";
}
?>