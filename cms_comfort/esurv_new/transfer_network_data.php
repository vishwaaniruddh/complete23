<?php 
include 'config.php';
include('db_connection.php'); $con = OpenCon();
 
$networksql = "SELECT * FROM `network_report`";
$insertdata = 0;
$networkhis_query = mysqli_query($conn,$networksql); 
if(mysqli_num_rows($networkhis_query)){ 
        mysqli_query($con,"TRUNCATE TABLE network_report_comfort");
		while($sql_result = mysqli_fetch_assoc($networkhis_query)){ 
		    
		    $SN = $sql_result['SN'];
				$router = $sql_result['router'];
				if($router=='0000-00-00 00:00:00'){$router=NULL;}
				$dvr = $sql_result['dvr'];
				if($dvr=='0000-00-00 00:00:00'){$dvr=NULL;}
				$panel=$sql_result['panel'];
				if($panel=='0000-00-00 00:00:00'){$panel=NULL;}
				$latency=$sql_result['latency'];	
			if(!is_null($router) && !is_null($dvr) && !is_null($panel)){	
				$insert_sql="insert into network_report_comfort(SN,router,dvr,panel,latency)
			   values('".$SN."','".$router."','".$dvr."','".$panel."','".$latency."')";
			}elseif(!is_null($router) && !is_null($dvr) && is_null($panel)){
				$insert_sql="insert into network_report_comfort(SN,router,dvr,latency)
			   values('".$SN."','".$router."','".$dvr."','".$latency."')";
			}elseif(!is_null($router) && is_null($dvr) && is_null($panel)){
				$insert_sql="insert into network_report_comfort(SN,router,latency)
			   values('".$SN."','".$router."','".$latency."')";
			}elseif(!is_null($router) && is_null($dvr) && !is_null($panel)){	
				$insert_sql="insert into network_report_comfort(SN,router,panel,latency)
			   values('".$SN."','".$router."','".$panel."','".$latency."')";
			}elseif(is_null($router) && !is_null($dvr) && !is_null($panel)){
				$insert_sql="insert into network_report_comfort(SN,dvr,panel,latency)
			   values('".$SN."','".$dvr."','".$panel."','".$latency."')";
			}elseif(is_null($router) && !is_null($dvr) && is_null($panel)){	
				$insert_sql="insert into network_report_comfort(SN,dvr,latency)
			   values('".$SN."','".$dvr."','".$latency."')";
			}elseif(is_null($router) && is_null($dvr) && !is_null($panel)){	
				$insert_sql="insert into network_report_comfort(SN,panel,latency)
			   values('".$SN."','".$panel."','".$latency."')";
			}else{
				$insert_sql="insert into network_report_comfort(SN,latency)
			   values('".$SN."','".$latency."')";
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
echo 'network report total inserted : '.$insertdata;

CloseCon($con);
?>