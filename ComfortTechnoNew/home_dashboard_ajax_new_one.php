<?php 
// session_start();
error_reporting(0);
 include('db_connection.php'); 
 $con = OpenCon(); 
 session_start();
//  if($con) { echo "Hello";} else { echo "not hello";} die;
// var_dump($_SESSION);
 ?>
<?php 
 date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
  function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) { 
        return utf8_encode($d);
    }
    return $d;
}

function getPanelName($atmid, $con){
	//global $con;
	//$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	//CloseCon($con);
	return $sql_result['Panel_Make'];
}

function getrass($sensorname,$atmid,$con){
	//global $con;
	//$con = OpenCon();
	$panel_name = getPanelName($atmid, $con);
	$paramater = 'ZONE';
	$sql = "";
	$_change = 0;
	if($panel_name=='comfort'){
		$sql = mysqli_query($con,"select $paramater from comfort where SensorName='".$sensorname."'");
	}
	if($panel_name=='rass_boi'){
		$sql = mysqli_query($con,"select $paramater from rass_boi where SensorName='".$sensorname."'");
	}
	if($panel_name=='rass_pnb'){
		$sql = mysqli_query($con,"select $paramater from rass_pnb where SensorName='".$sensorname."'");
	}
	if($panel_name=='smarti_boi'){
		$sql = mysqli_query($con,"select $paramater from smarti_boi where SensorName='".$sensorname."'");
	}
	if($panel_name=='smarti_pnb'){
		$sql = mysqli_query($con,"select $paramater from smarti_pnb where SensorName='".$sensorname."'");
	}
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where SensorName='".$sensorname."' AND status=0");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where SensorName='".$sensorname."' AND status=0");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where SensorName='".$sensorname."' AND status=0");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where SensorName='".$sensorname."' AND status=0");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where SensorName='".$sensorname."' AND status=0");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where SensorName='".$sensorname."' AND status=0");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where SensorName='".$sensorname."' AND status=0");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where SensorName='".$sensorname."' AND status=0");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where SensorName='".$sensorname."' AND status=0");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where SensorName='".$sensorname."' AND status=0");
	}
	if($sql==""){
		$return = "";
	}else{
		if(mysqli_num_rows($sql)>0){
	        $sql_result = mysqli_fetch_assoc($sql);
	        $return = $sql_result[$paramater];
		}else{
			$return = "";
		}
		
	}
	return $return;
}

$totalzone_no_array = array();
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

//echo '<pre>';print_r($housezone_no_array);echo '</pre>';die;
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

//echo '<pre>';print_r($flmzone_no_array);echo '</pre>';die;
 
//$client = $_POST['client'];
$client = "AGS,Diebold,Euronet,FSS,Hitachi";
$_client_name = explode(",",$client);
if(count($_client_name)>0){
	$_client_name=json_encode($_client_name);
	$_client_name=str_replace( array('[',']','"') , ''  , $_client_name);
	$clientarr=explode(',',$_client_name);
	$_client_name = "'" . implode ( "', '", $clientarr )."'";
}
    $today = date('Y-m-d');
   // $today = '2023-10-31';
    $start = $today;$end=$today;
 //   $client = "Hitachi";
    $banks = explode(",",$_SESSION['bankname']);
    $_bank_name = [];
    for($i=0;$i<count($banks);$i++){
	   $_bank = explode("_",$banks[$i]);
	   if($_bank[0]==$client){
		   array_push($_bank_name,$_bank[1]);
	   }
    } 
	$_bank_name_sent = "";
	if(count($banks)>0){
		$_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name_sent = "'" . implode ( "', '", $bankarr )."'";
	}
	
	//echo $_client_name;die;
	
	$_circle_name = "";
	$_circle_name_array = array();
	$_circle_sql_val = "";
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
        $_circle_sql_val = "select ATMID from site_circle where Circle IN (".$_circle_name.")";
        $site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
        while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
				$_circle_name_array[] = $site_circlesql_result['ATMID'];
		}		
	}

//$bank = $_POST['bank'];
 //   $bank = "PNB";
$bank = "";
    if(count($_circle_name_array)>0){
			$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
			$circleatmidarray = [];
			while($circlesql_result = mysqli_fetch_assoc($circlesql)){
				$circleatmidarray[] = $circlesql_result['ATMID'];
				
			}
			$circleatmidarray=json_encode($_circle_name_array);
			$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
			$circlearr=explode(',',$circleatmidarray);
			$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
			$query = "SELECT * FROM network_report_list WHERE Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.")";
			$query1 = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.ATMID IN (".$circleatmidarray.") and a_s.live='Y' ORDER BY aaa.id DESC";
	        $dvr_qry = "SELECT * FROM `dvr_health` WHERE SN IN (SELECT SN FROM network_report_list WHERE Customer='".$client."' AND Bank='".$bank."' AND ATMID IN (".$circleatmidarray.") AND live='Y') AND status=0 AND hdd IS NOT NULL AND hdd!='ok' AND hdd!='OK'";
	        $dvr_fault_qry = "SELECT * FROM call_log_dvr_alerts WHERE ATMID IN (".$circleatmidarray.")";
			$camera_fault_qry = "SELECT * FROM call_log_camera_alerts WHERE ATMID IN (".$circleatmidarray.")";
	}else{ 
		$query = "SELECT * FROM network_report_list WHERE Customer='".$client."' and Bank='".$bank."'";
		$query1 = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.live='Y' ORDER BY aaa.id DESC";
		$dvr_qry = "SELECT * FROM `dvr_health` WHERE SN IN (SELECT SN FROM network_report_list WHERE Customer='".$client."' AND Bank='".$bank."' AND live='Y') AND status=0 AND hdd IS NOT NULL AND hdd!='ok' AND hdd!='OK'";	
	    $dvr_fault_qry = 'SELECT * FROM call_log_dvr_alerts';
		$camera_fault_qry = 'SELECT * FROM call_log_camera_alerts';

		if(count($totalzone_no_array)>0){
			$totalzone_no_array=json_encode($totalzone_no_array);
			$totalzone_no_array=str_replace( array('[',']','"') , ''  , $totalzone_no_array);
			$totalzone_no_arrayarr=explode(',',$totalzone_no_array);
			$totalzone_no_array = "'" . implode ( "', '", $totalzone_no_arrayarr )."'";
			$zone_query = "SELECT id,zone FROM alerts_home_dashboard WHERE zone IN (".$totalzone_no_array.") AND CAST(createtime AS DATE)>='".$start."' AND CAST(createtime AS DATE)<='".$end."' AND panelid IN (SELECT NewPanelID FROM sites WHERE Customer='".$client."' and Bank='".$bank."' AND live='Y')";
			//echo $housequery;die;
			$zone_query_exec = mysqli_query($con,$zone_query);
			if(mysqli_num_rows($zone_query_exec)>0){
                while($zone_query_exec_data = mysqli_fetch_assoc($zone_query_exec)){
                   if (in_array($zone_query_exec_data['zone'], $housezone_no_array)){
                        $housekeeping_count = $housekeeping_count + 1;
				   }
				   if (in_array($zone_query_exec_data['zone'], $itzone_no_array)){
                        $itperson_count = $itperson_count + 1;
				   }
				   if (in_array($zone_query_exec_data['zone'], $flmzone_no_array)){
                        $flmeng_count = $flmeng_count + 1;
				   }
				   if (in_array($zone_query_exec_data['zone'], $qrtzone_no_array)){
                        $qrteng_count = $qrteng_count + 1;
				   }
				   /*
				   if (in_array($zone_query_exec_data['zone'], $paniczone_no_array)){
                        $paniceng_count = $paniceng_count + 1;
				   } */
				   if (in_array($zone_query_exec_data['zone'], $otherzone_no_array)){
                        $othereng_count = $othereng_count + 1;
				   }
				   
			    }
			}
			//$housekeeping_count = mysqli_num_rows($zone_query_exec);
			
		}

	} 
	//echo $query;die;
	$sql = mysqli_query($con,$query);
	// echo mysqli_num_rows($sql);
    $count = 1 ; $site_working = 0; $site_notworking=0;$total_site=0; 
	$_data = [];
	$code = 201;
	$totalsite = mysqli_num_rows($sql); 
    if($totalsite>0){
	   
		while($sql_result = mysqli_fetch_assoc($sql)){
			$total_site = $total_site + 1;
         /*   $live = $sql_result['live'];
			if($live=='Y'){
				$site_working = $site_working + 1;
			}else{
				$site_notworking=$site_notworking+1;
			}
		   	*/
			
			$is_live = $sql_result['router_status'];
			if($is_live=='1'){
				$site_working = $site_working + 1;
			}else{
				$site_notworking=$site_notworking+1;
			}
		}
		$code = 200;
	}
	
	//$aisql = mysqli_query($con,$query1);
	// 
    $count = 1 ; $camera_notworking_count = 0; $camera_working_count=0;
	$_data = [];
	/*
	$ai_total_site = mysqli_num_rows($aisql); 
    if($ai_total_site>0){
	    while($ai_sql_result = mysqli_fetch_assoc($aisql)){
			$ticket_id = $ai_sql_result['ID'];
	        if($ticket_id){
				$camera_working_count = $camera_working_count + 1;
			}else{
			   $camera_notworking_count = $camera_notworking_count + 1;
		    }
		}
		
	}
     */
	$dvr_sql = mysqli_query($con,$dvr_qry);
	$hdd_fault = mysqli_num_rows($dvr_sql);
	
    $hdd_status_qry = mysqli_query($con,$dvr_fault_qry);
	
	$hdd_fault_status = mysqli_num_rows($hdd_status_qry);

	$count=1; $hdd_fault_open=0; $hdd_fault_close=0;

	if($hdd_fault_status>0){
		while($hdd_sql_result = mysqli_fetch_assoc($hdd_status_qry)){
			$curr_status = $hdd_sql_result['current_status'];
			if($curr_status==1){
				$hdd_fault_close = $hdd_fault_close + 1; 
			} else {
				$hdd_fault_open = $hdd_fault_open + 1;
			}
		}
	}
	
	$camera_status_qry = mysqli_query($con,$camera_fault_qry);
	
	$camera_fault_status = mysqli_num_rows($camera_status_qry);

	$count=1; $camera_fault_open=0; $camera_fault_close=0;

	if($camera_fault_status>0){
		while($camera_sql_result = mysqli_fetch_assoc($camera_status_qry)){
			$camcurr_status = $camera_sql_result['current_status'];
			if($camcurr_status==1){
				$camera_fault_close = $camera_fault_close + 1; 
			} else {
				$camera_fault_open = $camera_fault_open + 1;
			}
		}
	}
	
$array = array(['code'=>$code,'total_site'=>$total_site,'site_working'=>$site_working,'site_notworking'=>$site_notworking
,'ai_total_site'=>$ai_total_site,'ai_site_working'=>$camera_working_count,'ai_site_notworking'=>$camera_notworking_count,
'hdd_fault'=>$hdd_fault_status,'hdd_working'=>$hdd_fault_close,'hdd_notworking'=>$hdd_fault_open,
'camera_fault'=>$camera_fault_status,'camera_working'=>$camera_fault_close,'camera_notworking'=>$camera_fault_open,
'housekeeping_count'=>$housekeeping_count,'itperson_count'=>$itperson_count,'flmeng_count'=>$flmeng_count,'qrteng_count'=>$qrteng_count,
'paniceng_count'=>$paniceng_count,'othereng_count'=>$othereng_count,'circleName'=>$_circle_sql_val]);

CloseCon($con);
echo json_encode(utf8ize($array));
//echo json_encode($array);
?>