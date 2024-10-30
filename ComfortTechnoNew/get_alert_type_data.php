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
$sitestatus = 0;
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

	$alert_type_sql = mysqli_query($con,"select * from alert_type_month_date where month_date='".$today_date."' AND status='".$status."' limit 1");
			if(mysqli_num_rows($alert_type_sql)>0){
				$alert_type_data = mysqli_fetch_assoc($alert_type_sql);
				$alert_month_date = $alert_type_data['month_date'];
				//echo $alert_month_date;die;
				$alert_type_status = $alert_type_data['alert_type'];
				$alert_type_id = $alert_type_data['id'];
				
				$start = $alert_month_date;
				$end = $alert_month_date;
				$sitestatus = $alert_type_status; 
				
				if($alert_type_status == 'hk'){ $alert_type_no = 1;}
				if($alert_type_status == 'it'){ $alert_type_no = 2;}
				if($alert_type_status == 'eng'){ $alert_type_no = 3;}
				if($alert_type_status == 'qrt'){ $alert_type_no = 4;}
				if($alert_type_status == 'panic'){ $alert_type_no = 5;}
				if($alert_type_status == 'other'){ $alert_type_no = 6;}
				//echo $start;die;
				$totalzone_no_array = array();

				if($alert_type_no == 1){
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

				if($alert_type_no==2){
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

				if($alert_type_no==3){
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

				if($alert_type_no==4){
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

				if($alert_type_no==5){
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

				if($alert_type_no==6){
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
						
					}
					
			}else{ 
				
				if(count($totalzone_no_array)>0){
					$totalzone_no_array=json_encode($totalzone_no_array);
					$totalzone_no_array=str_replace( array('[',']','"') , ''  , $totalzone_no_array);
					$totalzone_no_arrayarr=explode(',',$totalzone_no_array);
					$totalzone_no_array = "'" . implode ( "', '", $totalzone_no_arrayarr )."'";
					$zone_query = "SELECT * FROM alerts WHERE zone IN (".$totalzone_no_array.") AND CAST(createtime AS DATE)>='".$start."' AND CAST(createtime AS DATE)<='".$end."' AND panelid IN (SELECT NewPanelID FROM sites WHERE Customer='".$client."' and Bank='".$bank."' AND live='Y')";
								
				}

			}  
			
			$_insert = "INSERT INTO alerts_home_dashboard (ticket_id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus,level,sip2,c_status,auto_alert) ";
			$_insert_qry = $_insert.$zone_query;
			//echo $_insert_qry;die;
			$zone_query_exec = mysqli_query($con,$_insert_qry);
			if($zone_query_exec){
				$update_qry = mysqli_query($con,"UPDATE alert_type_month_date SET status=1 WHERE id='".$alert_type_id."'");
				echo "Inserted Alert Dashboard For Date : ".$start." & Alert Type : ".$sitestatus;
			}
		}
		
   
}else {
        echo "Counter value not received.";
}

CloseCon($con);
?>