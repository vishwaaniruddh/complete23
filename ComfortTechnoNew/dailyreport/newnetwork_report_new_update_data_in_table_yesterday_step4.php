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

$above_95_arr = ["23.04","23.28","23.52","23.76","24"];
$above_95_arr_dwn = ["0.96","0.72","0.48","0.24","0"];
$above_90_arr = ["21.84","22.08","22.32","22.56","22.80"];
$above_90_arr_dwn = ["2.16","1.92","1.68","1.44","1.20"];
$above_85_arr = ["20.64","20.88","21.12","21.36","21.60"];
$above_85_arr_dwn = ["3.36","3.12","2.88","2.64","2.40"];



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

//echo '<pre>';print_r($list);echo '</pre>';die;
            $check_daily_sql_qry = "select * from daily_downsite_table WHERE today_date='".$mon_date."'";
       // echo $check_daily_sql_qry;die;
            $check_sql = mysqli_query($con,$check_daily_sql_qry); 
            while($downsql_result = mysqli_fetch_assoc($check_sql)){
				$SNarray[] = $downsql_result['SN'];
			}
			$SNarray=json_encode($SNarray);
			$SNarray=str_replace( array('[',']','"') , ''  , $SNarray);
			$SNarr=explode(',',$SNarray);
			$SNarray = "'" . implode ( "', '", $SNarr )."'";
			
			
		//	echo '<pre>';print_r($SNarray);echo '</pre>';die;


$bank = "PNB"; 

//echo $mon_date;die;
 $sql_qry = "select * from newnetwork_report_new WHERE month_date='".$mon_date."' AND month='".$month."' AND year='".$year."' AND SN IN (".$SNarray.")";
 //echo $sql_qry;die;
 $sql = mysqli_query($con,$sql_qry); 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
	//$today = date('Y-m-d');
$count = 0; 
//echo mysqli_num_rows($sql);die;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		//$atm_id = $sql_result['ATMID'];
		$_view = 1;
        $randomInRange = rand(0, 4);
		
		if($_view == 1){
			//$SN = "2850";
			$SN = $sql_result['SN'];
			//$SN = "3358";
		//	$_liv_dt = $sql_result['live_date'];
			
			$total_time = 24;
			$net_his_not = 0;
			$tot_cnt = 0;
			
			$uptime = 0;
			$downtime = 24;
			
			$update_sql = "UPDATE `newnetwork_report_new` SET uptime='".$uptime."', downtime='".$downtime."', updated_at='".$created_at."' WHERE SN='".$SN."' AND month_date='".$mon_date."' AND month='".$month."' AND year='".$year."'";
			//echo 
	
		   
			$set_result = mysqli_query($con, $update_sql);
			$count = $count + 1;
	
		}
	}
}
		CloseCon($con);
		echo $count;
	?>
                     