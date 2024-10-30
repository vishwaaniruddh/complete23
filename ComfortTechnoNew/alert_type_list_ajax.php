<?php include('db_connection.php');  

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

  function getZoneData($sitestatus,$con,$_site_panel_make){
    $totalzone_no_array = array();    
	if($sitestatus=='hk'){
		/* House Keeping  */
		$housezone_no_array = array();
		if($_site_panel_make=='comfort'){
			$comforthousezone_sql = mysqli_query($con,"select ZONE from comfort where SensorName LIKE 'House%'");
			if(mysqli_num_rows($comforthousezone_sql)>0){
				$comforthouse_zone_data = mysqli_fetch_assoc($comforthousezone_sql);
				$comforthouse_zone_no = $comforthouse_zone_data['ZONE'];
				array_push($housezone_no_array, $comforthouse_zone_no);
				array_push($totalzone_no_array, $comforthouse_zone_no);
			}
		}

        if($_site_panel_make=='RASS' || $_site_panel_make=='rass_pnb'){
			$rasshousezone_sql = mysqli_query($con,"select ZONE from rass_pnb where SensorName LIKE 'House%'");
			if(mysqli_num_rows($rasshousezone_sql)>0){
				$rasshouse_zone_data = mysqli_fetch_assoc($rasshousezone_sql);
				$rasshouse_zone_no = $rasshouse_zone_data['ZONE'];
				array_push($housezone_no_array, $rasshouse_zone_no);
				array_push($totalzone_no_array, $rasshouse_zone_no);
			}
		}

        if($_site_panel_make=='SMART -I' || $_site_panel_make=='smarti_pnb'){
			$smartihousezone_sql = mysqli_query($con,"select ZONE from smarti_pnb where SensorName LIKE 'House%'");
			if(mysqli_num_rows($smartihousezone_sql)>0){
				$smartihouse_zone_data = mysqli_fetch_assoc($smartihousezone_sql);
				$smartihouse_zone_no = $smartihouse_zone_data['ZONE'];
				array_push($housezone_no_array, $smartihouse_zone_no);
				array_push($totalzone_no_array, $smartihouse_zone_no);
			}
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

	if(count($totalzone_no_array)>0){
		$totalzone_no_array=json_encode($totalzone_no_array);
		$totalzone_no_array=str_replace( array('[',']','"') , ''  , $totalzone_no_array);
		$totalzone_no_arrayarr=explode(',',$totalzone_no_array);
		$totalzone_no_array = "'" . implode ( "', '", $totalzone_no_arrayarr )."'";
	}else{
		$totalzone_no_array = "";
	}
    return $totalzone_no_array;
  }
?>
<?php 
     //  $client = $_GET['client'];
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
//$start = $_GET['start'];
//$end = $_GET['end'];
$status = 0;
$mon_dt = '2023-11-03';
$alert_type_sql = mysqli_query($con,"select * from alert_type_month_date where month_date='".$mon_dt."' AND status='".$status."' limit 1");
if(mysqli_num_rows($alert_type_sql)>0){
	$alert_type_data = mysqli_fetch_assoc($alert_type_sql);
	$alert_month_date = $alert_type_data['month_date'];
	$alert_type_status = $alert_type_data['alert_type'];
	$alert_type_id = $alert_type_data['id'];
	
	$start = $alert_month_date;
    $end = $alert_month_date;
    $sitestatus = $alert_type_status; 
	
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
	}else{ 
		$site_qry = "SELECT NewPanelID,Panel_Make FROM sites WHERE Customer='".$client."' and Bank='".$bank."' AND live='Y'";
		$site_data = mysqli_query($con, $site_qry);
	} 

	$dvr_online_count = 0;
	$dvr_offline_count = 0;

	$camera_working_count = 0;
	$camera_notworking_count = 0;
	$hdd_fail_count = 0;

	if(mysqli_num_rows($site_data)>0){
		$total_inserted = 0;
		
		while($site_row = mysqli_fetch_assoc($site_data)){
			$_site_panel_id = $site_row['NewPanelID'];
			$_site_panel_make = $site_row['Panel_Make'];
			$zone_no_data = getZoneData($sitestatus,$con,$_site_panel_make);
			//echo $_site_panel_id.'</br>';
			//echo strlen($_site_panel_id);
			if($zone_no_data!=''){
				if(strlen($_site_panel_id)==6){
												
						$zone_query = "SELECT * FROM alerts WHERE zone IN (".$zone_no_data.") AND CAST(createtime AS DATE)>='".$start."' AND CAST(createtime AS DATE)<='".$end."' AND panelid ='".$_site_panel_id."'";
						//echo $zone_query.'</br>';
						$check_data = mysqli_query($con, $zone_query);
						
						if(mysqli_num_rows($check_data)>0){
							$_insert = "INSERT INTO alerts_home_dashboard (ticket_id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus,level,sip2,c_status,auto_alert) ";
							$_insert_qry = $_insert.$zone_query;
							//echo $_insert_qry;die;
							$zone_query_exec = mysqli_query($con,$_insert_qry);
							if($zone_query_exec){
								$total_inserted = $total_inserted + 1;
							}
						}
				}  
			}
		}
	}
	
	
	if($total_inserted>0){
		$update_qry = mysqli_query($con,"UPDATE alert_type_month_date SET status=1 WHERE id='".$alert_type_id."'");
		echo "Inserted Alert Dashboard For Date : ".$start." & Alert Type : ".$sitestatus;
	}
}


//die;

//echo '<pre>';print_r($totalzone_no_array);echo '</pre>';die;

?>
