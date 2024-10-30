<?php include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');
$created_date = date('Y-m-d');

$split_created_at = explode(' ',$created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];

$time_array = ['09:35:10','09:35:20','09:25:15','09:25:25','09:30:18','09:30:28','09:37:10','09:37:40','09:45:50','09:45:35'];

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
	
	$net_qry = "SELECT * from network_report_list WHERE last_action_date='".$today."' AND today_tot_hit<'".$nowtime_hour."'";
    $sql_qry = "select s.live,s.Customer,s.Bank,s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.last_action_date,n.router_tot_count,
	n.router_online_count,n.dvr_tot_count,n.dvr_online_count,n.panel_tot_count,n.panel_online_count,n.id
                 from sites s join (".$net_qry.") n ON s.SN=n.SN where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'";
   // echo $sql_qry;die;
	$sql = mysqli_query($con,$sql_qry); 
    $total_update_cnt = 0;
	$count = 0; 
	 if(mysqli_num_rows($sql)){
		
		while($sql_result = mysqli_fetch_assoc($sql)){
			// echo '<pre>';print_r($sql_result);echo '</pre>';
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
			
			$site_address = $sql_result['SiteAddress'];
			$atm_id = $sql_result['ATMID'];
			$atm_id_2 = $sql_result['ATMID_2'];
			$dvrip = $sql_result['DVRIP'];
			$panelip = $sql_result['PanelIP'];
			$routerip = $sql_result['RouterIp'];
			$sn = $sql_result['SN'];
			
			$tb_last_action_date = $sql_result['last_action_date'];
			$router_status_total = $sql_result['router_tot_count'];
			$router_status_online = $sql_result['router_online_count'];
			$dvr_status_total = $sql_result['dvr_tot_count'];
			$dvr_status_online = $sql_result['dvr_online_count'];
			$panel_status_total = $sql_result['panel_tot_count'];
			$panel_status_online = $sql_result['panel_online_count'];
			
			$tb_id = $sql_result['id'];
				
			$selectdownsiteqry = "select * from daily_downsite_table where SN='".$sn."' AND today_date='".$yesterday."'";
			$select_downsite_sql = mysqli_query($con,$selectdownsiteqry); 
			if(mysqli_num_rows($select_downsite_sql)>0){
				$router_status = 0;
				$panel_status = 0;
				$dvr_status = 0;
			}else{
				$router_status = 1;
				$panel_status = 1;
				$dvr_status = 1;
			}
			$panel_status_total = $panel_status_total + 1; 
			$dvr_status_total = $dvr_status_total + 1; 
			$router_status_total = $router_status_total + 1; 
			if($dvr_status>0){
			    $dvr_online_count = $dvr_online_count + 1;
				$dvr_status_online = $dvr_status_online + 1;
			}else{
			    $dvr_offline_count = $dvr_offline_count + 1;	
			}
			if($router_status>0){
				$router_online_count = $router_online_count + 1;
				$router_status_online = $router_status_online + 1;
			}else{
				$router_offline_count = $router_offline_count + 1;	
			}
			if($panel_status>0){
			    $panel_online_count = $panel_online_count + 1;
				$panel_status_online = $panel_status_online + 1;
			}else{
			    $panel_offline_count = $panel_offline_count + 1;	
			}
			
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
			
			$randomInRange = rand(0, 9);
			$_current_time = $time_array[$randomInRange];
			
			$routerlast_communication = $today." ".$_current_time;
			$dvrlast_communication = $today." ".$_current_time;
			$panellast_communication = $today." ".$_current_time;
			
			$updatesql = "update network_report_list SET SN='".$sn."',ATMID='".$atm_id."',SiteAddress='".$site_address."',router_status='".$router_status."',router_ip='".$routerip."',router_lastcommunication='".$routerlast_communication."',router_online_count='".$router_status_online."',router_tot_count='".$router_status_total."',router_online_percent='".$routeronlinepercent."',
											  dvr_status='".$dvr_status."',dvr_ip='".$dvrip."',dvr_lastcommunication='".$dvrlast_communication."',dvr_online_count='".$dvr_status_online."',dvr_tot_count='".$dvr_status_total."',dvr_online_percent='".$dvronlinepercent."',
											  panel_status='".$panel_status."',panel_ip='".$panelip."',panel_lastcommunication='".$panellast_communication."',panel_online_count='".$panel_status_online."',panel_tot_count='".$panel_status_total."',panel_online_percent='".$panelonlinepercent."',last_action_date='".$today."',`is_update`='1', `today_tot_hit`='".$nowtime_hour."' where id='".$tb_id."'";
							//	echo $updatesql;die;
								$result=mysqli_query($con,$updatesql) ;
								if($result){
									$total_update_cnt = $total_update_cnt + 1;
								}
		}
	 }
	 echo 'Total Update : '.$total_update_cnt;
	  CloseCon($con);
	?>
                      
