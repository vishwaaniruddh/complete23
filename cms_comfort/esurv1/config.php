<?php 
$host="192.168.0.10";
$user="esurv";
$pass="Esurv123*";
$dbname="esurv";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected succesfull";
}



?>