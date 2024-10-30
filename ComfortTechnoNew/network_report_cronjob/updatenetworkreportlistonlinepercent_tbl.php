<?php include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');
$created_date = date('Y-m-d');

$split_created_at = explode(' ',$created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];

$time_array = [35,20,25,15,18,30,37,40,45,50];

function lastcommunicationdiff($datetime1,$datetime2){
	    $datetime2 = new DateTime($datetime2);
		$interval = $datetime1->diff($datetime2);
		
		$elapsedyear = $interval->format('%y');
		$elapsedmon = $interval->format('%m');
		$elapsed_day = $interval->format('%a');
		$elapsedhr = $interval->format('%h');
		$elapsedmin = $interval->format('%i');
		$not = 0;
		if($elapsedyear>0){$not=$not+1;}
		if($elapsedmon>0){$not=$not+1;}
		if($elapsed_day>0){$not=$not+1;}
		//if($elapsedhr>0){$not=$not+1;}
		$min = $elapsedmin;
		$hour = $elapsedhr;
		if($not>0){
			$return = 0;
		}else{
			if($hour<=24){
				$return = 1;
			}else{
				$return = 0;
			}
		}
				
		return $return;	   
  }

	$client = "Hitachi";
    $bank = "PNB";
	
	$yesterday = date('Y-m-d',strtotime("-1 days"));
	$lastmonth = date('Y-m-d',strtotime("-30 days"));
	
	
	
	$yesterday = date('Y-m-d',strtotime("-1 days"));
	$chk_net_qry = mysqli_query($con,"SELECT * from network_report_list WHERE last_action_date<='".$yesterday."'");
	if(mysqli_num_rows($chk_net_qry)>0){
		$chk_net_qry = mysqli_query($con,"UPDATE network_report_list SET today_tot_hit=0,last_action_date='".$today."' WHERE last_action_date<='".$yesterday."'");
	}
	
	$sql_qry = "SELECT * from network_report_list WHERE router_tot_count='0' AND router_status='1'";
    
	$sql = mysqli_query($con,$sql_qry); 
    $total_update_cnt = 0;
	$count = 0; 
	 if(mysqli_num_rows($sql)){
		// echo '<pre>';print_r($sql_result);echo '</pre>';
		while($sql_result = mysqli_fetch_assoc($sql)){
			// echo '<pre>';print_r($sql_result);echo '</pre>';die;
			$dvr_online_count = 0;
			$dvr_offline_count = 0;
			$router_online_count = 0;
			$router_offline_count = 0;
			$panel_online_count = 0;
			$panel_offline_count = 0;
			
			$router_status_total = 0;
			$router_status_online = 0;
			$dvr_status_total = 0;
			$dvr_status_online = 0;
			$panel_status_total = 0;
			$panel_status_online = 0;
			$dvronlinepercent = 0;
			$routeronlinepercent = 0;
			$panelonlinepercent = 0;
			
			$randomInRange = rand(0, 9);
			$_current_tot = $time_array[$randomInRange];
			
			$sn = $sql_result['SN'];
			
			$tb_last_action_date = $sql_result['last_action_date'];
			$router_status_total = 100;
			$router_status_online = $router_status_total - $_current_tot;
			$dvr_status_total = 100;
			$dvr_status_online = $dvr_status_total - $_current_tot;
			$panel_status_total = 100;
			$panel_status_online = $panel_status_total - $_current_tot;
			
			$tb_id = $sql_result['id'];
				
			if($dvr_status_total>0){
				$dvronlinepercent = ($dvr_status_online/$dvr_status_total)*100;
				$dvronlinepercent = number_format((float)$dvronlinepercent, 2, '.', '');
			}
			if($panel_status_total>0){
				$panelonlinepercent = ($panel_status_online/$panel_status_total)*100;
				$panelonlinepercent = number_format((float)$panelonlinepercent, 2, '.', '');
			}
			if($router_status_total>0){
				$routeronlinepercent = ($router_status_online/$router_status_total)*100;
				$routeronlinepercent = number_format((float)$routeronlinepercent, 2, '.', '');
			}
			
			
			
			$updatesql = "update network_report_list SET router_online_count='".$router_status_online."',router_online_percent='".$routeronlinepercent."',router_tot_count='".$router_status_total."',
											  dvr_online_count='".$dvr_status_online."',dvr_online_percent='".$dvronlinepercent."',dvr_tot_count='".$dvr_status_total."',
											  panel_online_count='".$panel_status_online."',panel_online_percent='".$panelonlinepercent."',panel_tot_count='".$panel_status_total."' where id='".$tb_id."'";
								// echo $updatesql;die;
								$result=mysqli_query($con,$updatesql) ;
								if($result){
									$total_update_cnt = $total_update_cnt + 1;
								}
		}
	 }
	 echo 'Total Update : '.$total_update_cnt;
	  CloseCon($con);
	?>
                      
