<?php 
include 'config.php';
include('db_connection.php'); $con = OpenCon();
   $dvrsql = "SELECT * FROM `dvr_health`";
$insertdata = 0;
$dvrhis_query = mysqli_query($conn,$dvrsql); 
if(mysqli_num_rows($dvrhis_query)){ 
        mysqli_query($con,"TRUNCATE TABLE dvr_health_comfort"); 
		while($sql_result = mysqli_fetch_assoc($dvrhis_query)){ 
		 
				$ip = $sql_result['ip'];$status = $sql_result['status'];$cam1=$sql_result['cam1'];
				$cam2 = $sql_result['cam2'];$cam3 = $sql_result['cam3'];$cam4=$sql_result['cam4'];$hdd = $sql_result['hdd'];
				$latency=$sql_result['latency']	;$cdate=$sql_result['cdate']	;$login_status=$sql_result['login_status']	;if($login_status==''){$login_status=1;}
				$live = $sql_result['live'];$last_communication = $sql_result['last_communication'];$atmid=$sql_result['atmid'];$capacity = $sql_result['capacity'];
				$freespace=$sql_result['freespace'];$recording_from = $sql_result['recording_from'];$recording_to = $sql_result['recording_to'];$SN = $sql_result['SN'];	
				$dvrtype = $sql_result['dvrtype'];
				if(!is_null($cdate) && !is_null($last_communication)){
					$insert_sql="insert into dvr_health_comfort(ip,status,cam1,cam2,cam3,cam4,hdd,latency,cdate,login_status,last_communication,atmid,capacity,freespace,live,recording_from,recording_to,dvrtype,SN)
			   values('".$ip."','".$status."','".$cam1."','".$cam2."','".$cam3."','".$cam4."','".$hdd."','".$latency."','".$cdate."','".$login_status."','".$last_communication."','".$atmid."','".$capacity."','".$freespace."','".$live."','".$recording_from."','".$recording_to."','".$dvrtype."','".$SN."')";
			 
				}elseif(is_null($cdate) && !is_null($last_communication)){
					$insert_sql="insert into dvr_health_comfort(ip,status,cam1,cam2,cam3,cam4,hdd,latency,login_status,last_communication,atmid,capacity,freespace,live,recording_from,recording_to,dvrtype,SN)
			   values('".$ip."','".$status."','".$cam1."','".$cam2."','".$cam3."','".$cam4."','".$hdd."','".$latency."','".$login_status."','".$last_communication."','".$atmid."','".$capacity."','".$freespace."','".$live."','".$recording_from."','".$recording_to."','".$dvrtype."','".$SN."')";
			 
				}elseif(!is_null($cdate) && is_null($last_communication)){
					$insert_sql="insert into dvr_health_comfort(ip,status,cam1,cam2,cam3,cam4,hdd,latency,cdate,login_status,atmid,capacity,freespace,live,recording_from,recording_to,dvrtype,SN)
			   values('".$ip."','".$status."','".$cam1."','".$cam2."','".$cam3."','".$cam4."','".$hdd."','".$latency."','".$cdate."','".$login_status."','".$atmid."','".$capacity."','".$freespace."','".$live."','".$recording_from."','".$recording_to."','".$dvrtype."','".$SN."')";
			 
				}else{
					$insert_sql="insert into dvr_health_comfort(ip,status,cam1,cam2,cam3,cam4,hdd,latency,login_status,atmid,capacity,freespace,live,recording_from,recording_to,dvrtype,SN)
			   values('".$ip."','".$status."','".$cam1."','".$cam2."','".$cam3."','".$cam4."','".$hdd."','".$latency."','".$login_status."','".$atmid."','".$capacity."','".$freespace."','".$live."','".$recording_from."','".$recording_to."','".$dvrtype."','".$SN."')";
			 
				}
				 // echo $insert_sql;die;
			   $result=mysqli_query($con,$insert_sql) ;  
			   if($result==1){
				   $insertdata = $insertdata + 1;
			   }else{
				   echo $insert_sql.'</br>';
				   
			   }
				
		}
}
echo 'dvr health total inserted : '.$insertdata;

CloseCon($con);
?>