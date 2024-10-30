<?php include('db_connection.php'); 
session_start();
date_default_timezone_set('Asia/Kolkata');
 $created_at = date('Y-m-d H:i:s');
 $created_date = date('Y-m-d');
 $created_by = $_SESSION['userid'];
 
$con = OpenCon();
$id = $_POST['id'];
$current_status = $_POST['ticket_status'];
$hdd = $_POST['remarks'];

	if($current_status==1){
		$updatesql = "update call_log_dvr_alerts SET current_status=1,current_remark='".$hdd."',updated_by='".$created_by."',updated_at='".$created_at."' WHERE id='".$id."'";
		mysqli_query($con,$updatesql);				
	}
	
	$sql = "insert into call_log_dvr_alerts_history (call_log_id,current_status,current_remark,updated_by,updated_at)
											  values('".$id."','".$current_status."','".$hdd."','".$created_by."','".$created_at."')";
							
				
	if(mysqli_query($con,$sql)){ 
      
   		CloseCon($con);
    echo '1';
	}else{
		CloseCon($con);
		echo '0';
	}
 ?>
 