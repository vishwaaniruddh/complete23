<?php

 function OpenCon()
 {
 $dbhost = "192.168.100.23";
 $dbuser = "esurv";
 $dbpass = "Esurv123*";
 $db = "esurv";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>