<?php include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');
//echo $created_at;die;
$split_created_at = explode(' ',$created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];
$total_hour_time = 0;
$lower_limit_arr = [0,3,6,9,12,15,18,21];
for($i=0;$i<count($lower_limit_arr);$i++){
	if($split_time[0]>=$lower_limit_arr[$i]){
		$total_hour_time = $total_hour_time + 1;
	}
}
//echo $total_hour_time;die;
$client = "Hitachi";

 $bank = "";$circle="";
 
$list=array();$list1=array();
$month = date('m');
$month = (int)$month;
$year = date('Y');
//echo (int)$month.'-'.$year;die;
//$year = 2023;

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		$list1[]=date('Y-m-d', $time);
	}
}

$yesterday = date('Y-m-d',strtotime("-1 days"));

$yester_date_split = explode("-",$yesterday);

$yester_date_month = $yester_date_split[1];

$bank = "PNB"; 
$mon_date = $yesterday;
$month= (int)$yester_date_month;
$year=$yester_date_split[0];

//echo $year;die;
//echo $mon_date;die;
$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y' AND live_date<='".$mon_date."' AND SN NOT IN (SELECT SN from `newnetwork_report_new_26092024` WHERE month_date='".$mon_date."' AND month='".$month."' AND year='".$year."')";
 //echo $sql_qry;die;
 $sql = mysqli_query($con,$sql_qry); 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
	//$today = date('Y-m-d');
$count = 0; 
//echo mysqli_num_rows($sql);die;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$atm_id = $sql_result['ATMID'];
		$_view = 1;

		if($_view == 1){
			//$SN = "2850";
			$SN = $sql_result['SN'];
			//$SN = "3358";
			$_liv_dt = $sql_result['live_date'];
			
			$total_time = 24;$net_his_not = 0;
			$tot_cnt = 0;
	        
			$check_data_sql = "SELECT * from newnetwork_report_new WHERE SN='".$SN."' AND month_date='".$mon_date."'";
			$get_result = mysqli_query($con, $check_data_sql);
			if(mysqli_num_rows($get_result)==0){
			  //  echo '1';die;
				$set_sql = "INSERT INTO `newnetwork_report_new`( `SN`, `month_date`, `month`, `year`, `uptime`, `downtime`, `created_at`) VALUES ('" . $SN . "','" . $mon_date . "','" . $month . "','" . $year . "','" . $total_time . "','" . $net_his_not . "','" . $created_at . "') ";
			//	echo $set_sql;die;
				$set_result = mysqli_query($con, $set_sql);
				$count = $count + 1;
			}
			//echo mysqli_num_rows($get_result);die;
	
		}
	}
}
		CloseCon($con);
		echo $count;
	?>
                     