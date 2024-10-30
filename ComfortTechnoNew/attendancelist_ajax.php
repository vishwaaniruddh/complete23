<?php //var_dump($_GET); ?>
<?php session_start();include('db_connection.php');  
$_designation = $_SESSION['designation'];
//error_reporting(0);
$con = OpenCon();
$start_date_time = date('Y-m-d', strtotime('-7 days'));
$time = date("H:i:s");
date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
  function lastcommunicationdiff($datetime2){
	    date_default_timezone_set('Asia/Kolkata');
		$datetime1 = new DateTime();
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
?>
<?php 

     //  $client = $_GET['client'];
	   $client = 'Hitachi';
       $banks = explode(",",$_SESSION['bankname']);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		   $_bank = explode("_",$banks[$i]);
		   if($_bank[0]==$client){
			   array_push($_bank_name,$_bank[1]);
		   }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";
		
		$_circle_name = "";
		$_circle_name_array = array();
		if($_SESSION['circlename']!=''){
		   $assign_circle = explode(",",$_SESSION['circlename']);
		   $_circle_name = [];
			for($i=0;$i<count($assign_circle);$i++){
			   $_circle = explode("_",$assign_circle[$i]);
			   array_push($_circle_name,$_circle[1]);
			} 
			//$_circle_name = $_circle_name_array;
			$_circle_name=json_encode($_circle_name);
			$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
			$circlearr=explode(',',$_circle_name);
			$_circle_name = "'" . implode ( "', '", $circlearr )."'";

			$site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
			while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
					$_circle_name_array[] = $site_circlesql_result['ATMID'];
			}		
		}
		
//$bank = $_GET['bank'];
$bank = 'PNB';
$atmid = "";
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
$sitestatus = $_GET['status'];
//$sitestatus = 'qrt';
$circle = "";
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}

$start = $_GET['start'];
$end = $_GET['end'];

//$start ='2023-10-01';
//$end ='2023-10-01';

$totalzone_no_array = array();

if($sitestatus=='hk'){
	/* House Keeping  */
	$housezone_no_array = array();
	$comforthousezone_sql = mysqli_query($con,"select ZONE from comfort where SensorName LIKE 'House%'");
	if(mysqli_num_rows($comforthousezone_sql)>0){
		$comforthouse_zone_data = mysqli_fetch_assoc($comforthousezone_sql);
		$comforthouse_zone_no = $comforthouse_zone_data['ZONE'];
		array_push($housezone_no_array, $comforthouse_zone_no);
		array_push($totalzone_no_array, $comforthouse_zone_no);
	}

	$rasshousezone_sql = mysqli_query($con,"select ZONE from rass_pnb where SensorName LIKE 'House%'");
	if(mysqli_num_rows($rasshousezone_sql)>0){
		$rasshouse_zone_data = mysqli_fetch_assoc($rasshousezone_sql);
		$rasshouse_zone_no = $rasshouse_zone_data['ZONE'];
		array_push($housezone_no_array, $rasshouse_zone_no);
		array_push($totalzone_no_array, $rasshouse_zone_no);
	}

	$smartihousezone_sql = mysqli_query($con,"select ZONE from smarti_pnb where SensorName LIKE 'House%'");
	if(mysqli_num_rows($smartihousezone_sql)>0){
		$smartihouse_zone_data = mysqli_fetch_assoc($smartihousezone_sql);
		$smartihouse_zone_no = $smartihouse_zone_data['ZONE'];
		array_push($housezone_no_array, $smartihouse_zone_no);
		array_push($totalzone_no_array, $smartihouse_zone_no);
	}

	$housekeeping_count = 0;

}

if($sitestatus=='it'){
	/* IT  */

	$itzone_no_array = array();
	$comfortitzone_sql = mysqli_query($con,"select ZONE from comfort where SensorName LIKE 'IT%'");
	if(mysqli_num_rows($comfortitzone_sql)>0){
		$comfortit_zone_data = mysqli_fetch_assoc($comfortitzone_sql);
		$comfortit_zone_no = $comfortit_zone_data['ZONE'];
		array_push($itzone_no_array, $comfortit_zone_no);
		array_push($totalzone_no_array, $comfortit_zone_no);
	}

	$rassitzone_sql = mysqli_query($con,"select ZONE from rass_pnb where SensorName LIKE 'IT%'");
	if(mysqli_num_rows($rassitzone_sql)>0){
		$rassit_zone_data = mysqli_fetch_assoc($rassitzone_sql);
		$rassit_zone_no = $rassit_zone_data['ZONE'];
		array_push($itzone_no_array, $rassit_zone_no);
		array_push($totalzone_no_array, $rassit_zone_no);
	}

	$smarti_itzone_sql = mysqli_query($con,"select ZONE from smarti_pnb where SensorName LIKE 'IT%'");
	if(mysqli_num_rows($smarti_itzone_sql)>0){
		$smarti_it_zone_data = mysqli_fetch_assoc($smarti_itzone_sql);
		$smarti_it_zone_no = $smarti_it_zone_data['ZONE'];
		array_push($itzone_no_array, $smarti_it_zone_no);
		array_push($totalzone_no_array, $smarti_it_zone_no);
	}

	$itperson_count = 0;
}

if($sitestatus=='eng'){
	/* Engineer */

	$flmzone_no_array = array();
	$comfortflmzone_sql = mysqli_query($con,"select ZONE from comfort where SensorName LIKE '%Engineer%'");
	if(mysqli_num_rows($comfortflmzone_sql)>0){
		$comfortflm_zone_data = mysqli_fetch_assoc($comfortflmzone_sql);
		$comfortflm_zone_no = $comfortflm_zone_data['ZONE'];
		array_push($flmzone_no_array, $comfortflm_zone_no);
		array_push($totalzone_no_array, $comfortflm_zone_no);
	}

	$rassflmzone_sql = mysqli_query($con,"select ZONE from rass_pnb where SensorName LIKE 'FLM%'");
	if(mysqli_num_rows($rassflmzone_sql)>0){
		$rassflm_zone_data = mysqli_fetch_assoc($rassflmzone_sql);
		$rassflm_zone_no = $rassflm_zone_data['ZONE'];
		array_push($flmzone_no_array, $rassflm_zone_no);
		array_push($totalzone_no_array, $rassflm_zone_no);
	}

	$smarti_flmzone_sql = mysqli_query($con,"select ZONE from smarti_pnb where SensorName LIKE 'FLM%'");
	if(mysqli_num_rows($smarti_flmzone_sql)>0){
		$smarti_flm_zone_data = mysqli_fetch_assoc($smarti_flmzone_sql);
		$smarti_flm_zone_no = $smarti_flm_zone_data['ZONE'];
		array_push($flmzone_no_array, $smarti_flm_zone_no);
		array_push($totalzone_no_array, $smarti_flm_zone_no);
	}

	$flmeng_count = 0;
}


if($sitestatus=='qrt'){
	/* QRT */

	$qrtzone_no_array = array();
	/*
	$comfortflmzone_sql = mysqli_query($con,"select ZONE from comfort where SensorName LIKE '%Engineer%'");
	if(mysqli_num_rows($comfortflmzone_sql)>0){
		$comfortflm_zone_data = mysqli_fetch_assoc($comfortflmzone_sql);
		$comfortflm_zone_no = $comfortflm_zone_data['ZONE'];
		array_push($flmzone_no_array, $comfortflm_zone_no);
		array_push($totalzone_no_array, $comfortflm_zone_no);
	}
	*/

	$rassqrtzone_sql = mysqli_query($con,"select ZONE from rass_pnb where SensorName LIKE 'QRT%'");
	if(mysqli_num_rows($rassqrtzone_sql)>0){
		$rassqrt_zone_data = mysqli_fetch_assoc($rassqrtzone_sql);
		$rassqrt_zone_no = $rassqrt_zone_data['ZONE'];
		array_push($qrtzone_no_array, $rassqrt_zone_no);
		array_push($totalzone_no_array, $rassqrt_zone_no);
	}

	$smarti_qrtzone_sql = mysqli_query($con,"select ZONE from smarti_pnb where SensorName LIKE 'QRT%'");
	if(mysqli_num_rows($smarti_qrtzone_sql)>0){
		$smarti_qrt_zone_data = mysqli_fetch_assoc($smarti_qrtzone_sql);
		$smarti_qrt_zone_no = $smarti_qrt_zone_data['ZONE'];
		array_push($qrtzone_no_array, $smarti_qrt_zone_no);
		array_push($totalzone_no_array, $smarti_qrt_zone_no);
	}

	$qrteng_count = 0;

}


if($sitestatus=='panic'){
	/* Panic Switch */

	$paniczone_no_array = array();

	$comfortpaniczone_sql = mysqli_query($con,"select ZONE from comfort where SensorName LIKE '%Panic%'");
	if(mysqli_num_rows($comfortpaniczone_sql)>0){
		$comfortpanic_zone_data = mysqli_fetch_assoc($comfortpaniczone_sql);
		$comfortpanic_zone_no = $comfortpanic_zone_data['ZONE'];
		array_push($paniczone_no_array, $comfortpanic_zone_no);
		array_push($totalzone_no_array, $comfortpanic_zone_no);
	}

	$rasspaniczone_sql = mysqli_query($con,"select ZONE from rass_pnb where SensorName LIKE 'Panic%'");
	if(mysqli_num_rows($rasspaniczone_sql)>0){
		$rasspanic_zone_data = mysqli_fetch_assoc($rasspaniczone_sql);
		$rasspanic_zone_no = $rasspanic_zone_data['ZONE'];
		array_push($paniczone_no_array, $rasspanic_zone_no);
		array_push($totalzone_no_array, $rasspanic_zone_no);
	}

	$smarti_paniczone_sql = mysqli_query($con,"select ZONE from smarti_pnb where SensorName LIKE 'Panic%'");
	if(mysqli_num_rows($smarti_paniczone_sql)>0){
		$smarti_panic_zone_data = mysqli_fetch_assoc($smarti_paniczone_sql);
		$smarti_panic_zone_no = $smarti_panic_zone_data['ZONE'];
		array_push($paniczone_no_array, $smarti_panic_zone_no);
		array_push($totalzone_no_array, $smarti_panic_zone_no);
	}

	$paniceng_count = 0;
}

if($sitestatus=='other'){
	/* Other Switch */

	$otherzone_no_array = array();

	$comfortotherzone_sql = mysqli_query($con,"select ZONE from comfort where SensorName LIKE '%Other%'");
	if(mysqli_num_rows($comfortotherzone_sql)>0){
		$comfortother_zone_data = mysqli_fetch_assoc($comfortotherzone_sql);
		$comfortother_zone_no = $comfortother_zone_data['ZONE'];
		array_push($otherzone_no_array, $comfortother_zone_no);
		array_push($totalzone_no_array, $comfortother_zone_no);
	}

	$othereng_count = 0;
}


    if(count($_circle_name_array)>0){
			$circlesql = mysqli_query($con,"select NewPanelID from site_circle where Circle='".$circle."'");
			$circleatmidarray = [];
			while($circlesql_result = mysqli_fetch_assoc($circlesql)){
				$circleatmidarray[] = $circlesql_result['NewPanelID'];
				
			}
			$circleatmidarray=json_encode($_circle_name_array);
			$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
			$circlearr=explode(',',$circleatmidarray);
			$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";

			if(count($totalzone_no_array)>0){
				$totalzone_no_array=json_encode($totalzone_no_array);
				$totalzone_no_array=str_replace( array('[',']','"') , ''  , $totalzone_no_array);
				$totalzone_no_arrayarr=explode(',',$totalzone_no_array);
				$totalzone_no_array = "'" . implode ( "', '", $totalzone_no_arrayarr )."'";
				$zone_query = "SELECT id,zone,panelid,createtime FROM alerts WHERE zone IN (".$totalzone_no_array.") AND CAST(createtime AS DATE)>='".$start."' AND CAST(createtime AS DATE)<='".$end."' AND panelid IN (".$circleatmidarray.")";
				//echo $housequery;die;
				
				
			}
			
	}else{ 
		
		if(count($totalzone_no_array)>0){
			$totalzone_no_array=json_encode($totalzone_no_array);
			$totalzone_no_array=str_replace( array('[',']','"') , ''  , $totalzone_no_array);
			$totalzone_no_arrayarr=explode(',',$totalzone_no_array);
			$totalzone_no_array = "'" . implode ( "', '", $totalzone_no_arrayarr )."'";
			$zone_query = "SELECT id,zone,panelid,createtime FROM alerts_home_dashboard WHERE zone IN (".$totalzone_no_array.") AND CAST(createtime AS DATE)>='".$start."' AND CAST(createtime AS DATE)<='".$end."' AND panelid IN (SELECT NewPanelID FROM sites WHERE Customer='".$client."' and Bank='".$bank."' AND live='Y')";
			//echo $housequery;die;
			
			
		}

	} 

$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;

//echo $zone_query;die;
$zone_query_exec = mysqli_query($con,$zone_query);

//echo '<pre>';print_r($totalzone_no_array);echo '</pre>';die;

?>

<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>S.No</th><th>ATMID</th>
							<th>Circle</th><th>ZO</th>
							<th>State</th>
							<th>Location</th>
							<th>Site Type</th>
							<th>On Date</th>
							<th><?php echo strtoupper($sitestatus);?> (hh:mm)</th>
													
                        </tr>
                      </thead>
                      <tbody>
				<?php   $yesterday = date('Y-m-d',strtotime("-1 days"));
						$today = date('Y-m-d');
					// $start_date = $_first_date_month;
						
						//$last_date =  date("Y-m-t", strtotime($_first_date_month));
						// $end_date = $last_date;
                        $count = 0; $tot_daycnt = 0;
						
						 if(mysqli_num_rows($zone_query_exec)){
							while($zonesql_result = mysqli_fetch_assoc($zone_query_exec)){
								$sitepanel_id = $zonesql_result['panelid'];
								
								$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type,s.NewPanelID from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.NewPanelID='".$sitepanel_id."' and live='Y' GROUP BY s.SN";
	                            $site_sql_query = mysqli_query($con,$sql_qry);
								$sql_result = mysqli_fetch_assoc($site_sql_query);
								$_panelid = $sql_result['NewPanelID'];
								$atm_id = $sql_result['ATMID'];
								$live_dt = $sql_result['live_date'];
								$site_type = $sql_result['site_type'];
								$live_dt_arr = explode("-",$live_dt);
								$live_dt_year = "";$live_dt_month = "";
								if(count($live_dt_arr)==3){
								  $live_dt_year = $live_dt_arr[0];
								  $live_dt_month = $live_dt_arr[1];
								}
								$_view = 0;
								if(count($_circle_name_array)==0){
									$_view = 1;
								}else{
									if(in_array($atm_id,$_circle_name_array)){
									   $_view = 1;
									}
								}
								
								if($_view == 1){
									$site_address = $sql_result['SiteAddress'];
									
									$_Zone = $sql_result['Zone'];
									$_circleName = $sql_result['Circle'];
									$sn = $sql_result['SN'];
									$site_live_date = $sql_result['live_date'];
									$_State = $sql_result['State'];
									
									$count++;
									
									$total_uptime = 0;$total_downtime = 0;
									$tot_cnt = 0; $is_lies = 0;
									
									
									$qrt = '';
									//$total_net_his = mysqli_num_rows($net_sql_res);
									$custodian = '';
									$housekeeper = '';
									$technician = '';
									$bankdata = '';
									$on_date = '';
									$create_time = $zonesql_result['createtime'];
									
									$create_time_explode = explode(" ",$create_time);
									$on_date = $create_time_explode[0];
									$housekeeper = $create_time_explode[1];
									
									?>
									   <tr>
									       <td><?php echo $count;?></td>
										   <td><?php echo $atm_id;?></td>
										   <td><?php echo $_circleName;?></td>
										   <td><?php echo $_Zone;?></td>
										   <td><?php echo $sql_result['State'];?></td>
										   <td><?php echo $site_address;?></td>
						                   <td><?php echo $site_type;?></td>
										   <td><?php echo $on_date;?></td>
										   <td><?php echo $housekeeper;?></td>
										   
										</tr>
								
								<?php   //}
									  }
								   }
								 }
								  CloseCon($con);
								?>
                      </tbody>
                    </table>
                  </div>