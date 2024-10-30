<?php //include('config.php'); ?>
<?php include('db_connection.php'); 
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
$client = $_POST['client'];
$userid = $_POST['user_id'];
$con = OpenCon();
$usersql = mysqli_query($con,"select cust_id,bank_id,circle_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_bank_ids = $userdata['bank_id'];
    $banks = explode(",",$_bank_ids);
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
	
	
	$_circle_ids = $userdata['circle_id'];
	if($_circle_ids!=''){
        $circles = explode(",",$_circle_ids);
        $_circle_name = [];
        for($i=0;$i<count($circles);$i++){
		   $_circle = explode("_",$circles[$i]);
		   if(count($_circle)>0){
			   array_push($_circle_name,$_circle[1]);
		   }
	    } 
	   
	    $_circle_name=json_encode($_circle_name);
		$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
		$circlearr=explode(',',$_circle_name);
		$_circle_name = "'" . implode ( "', '", $circlearr )."'";
	}

   $bank = "";
   $atmid = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}

$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;


if($atmid!=''){
	$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where ATMID='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
		if($circle!=''){
					$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
					$circleatmidarray = [];
					while($circlesql_result = mysqli_fetch_assoc($circlesql)){
						$circleatmidarray[] = $circlesql_result['ATMID'];
						
					}
					$circleatmidarray=json_encode($circleatmidarray);
					$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
					$circlearr=explode(',',$circleatmidarray);
					$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
					$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{ 
			   if($_circle_ids!=''){
				 $sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (SELECT ATMID FROM site_circle WHERE Circle IN (".$_circle_name.")) and live='Y'");	  
			   }else{
			    $sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");	
			   }
			} 
	}else{
		$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	/*$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM sites WHERE ATMID IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql); */
}
$dvr_online_count = 0;
$dvr_offline_count = 0;
$router_online_count = 0;
$router_offline_count = 0;
$panel_online_count = 0;
$panel_offline_count = 0;

$today = date("Y-m-d H:i");
$_datetime = explode(" ",$today);
$current_date = $_datetime[0];
$current_time = explode(":",$_datetime[1]);
$hh = $current_time[0];
$mm = $current_time[1];


//$camera_working_count = 0;
//$camera_notworking_count = 0;
//$hdd_fail_count = 0;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$site_address = $sql_result['SiteAddress'];
		$atm_id = $sql_result['ATMID'];
		$dvrip = $sql_result['DVRIP'];
		$panelip = $sql_result['PanelIP'];
		$routerip = $sql_result['RouterIp'];
		$sn = $sql_result['SN'];
		$aisql = mysqli_query($con,"select * from network_report_list where SN ='".$sn."'"); 
		if(mysqli_num_rows($aisql)>0){
			$aisql_result = mysqli_fetch_assoc($aisql);
			$router_status = $aisql_result['router_status'];
			$dvr_status = $aisql_result['dvr_status'];
			$panel_status = $aisql_result['panel_status'];
			
			if($dvr_status>0){
			   $dvr_online_count = $dvr_online_count + 1;
			}else{
			   $dvr_offline_count = $dvr_offline_count + 1;	
			}
				
			
		}else{
			$dvr_offline_count = $dvr_offline_count + 1;
		}
	}
}

$array = array(['dvr_online_count'=>$dvr_online_count,'dvr_offline_count'=>$dvr_offline_count]);
CloseCon($con);
echo json_encode($array);
?>


