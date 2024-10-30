<?php
include('db_connection.php');  

//error_reporting(0);
$con = OpenCon();

$client = 'Hitachi';
       
		
//$bank = $_GET['bank'];
$bank = 'PNB';
$atmid = "";
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
//$sitestatus = $_GET['status'];
$sitestatus = 'other';
$circle = "";
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}

$_circle_name_array = array();
$status = 0;
$today_date = date('Y-m-d');

$_tot_sit = $_POST['total_site'];
if($_tot_sit>0){
     $counterValue = $_tot_sit;
//if (isset($_POST['total_site'])) {
   // $counterValue = $_POST['total_site'];
  

    if($counterValue == 1){

        $selectsql = mysqli_query($con,"select month_date from alert_type_month_date where month_date = '".$today_date."' ");
        $selectsql_row = mysqli_num_rows($selectsql);
        if($selectsql_row>0){
            echo "Month Date already Exist!!";
        }else {
            $sql = "insert into alert_type_month_date(month_date,alert_type,status) values ";
            $ins = "('".$today_date."','hk',0),('".$today_date."','it',0),('".$today_date."','eng',0),('".$today_date."','qrt',0),('".$today_date."','panic',0),('".$today_date."','other',0)";

            $sql1 = $sql . $ins;
            
            $sql_insert = mysqli_query($con,$sql1);
        }   
    } 
    
}else {
        echo "Counter value not received.";
}

CloseCon($con);
?>