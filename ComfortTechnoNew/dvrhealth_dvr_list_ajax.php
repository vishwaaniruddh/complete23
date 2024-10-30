<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); 
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
       $client = $_GET['client'];
	   
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
		
$bank = $_GET['bank'];
$atmid = $_GET['atmid'];
$dvrstatus = $_GET['status'];
$circle = "";
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}



if($atmid!=''){   // and login_status='".$dvrstatus."'
	$sql = mysqli_query($con,"select * from network_report_list where atmid='".$atmid."' and live='Y'");
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
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
		}else{ 
		   if(count($_circle_name_array)>0){
			   $_circle_name_array=json_encode($_circle_name_array);
				$_circle_name_array=str_replace( array('[',']','"') , ''  , $_circle_name_array);
				$_circle_name_array=explode(',',$_circle_name_array);
				$_circle_name_array = "'" . implode ( "', '", $_circle_name_array )."'";
			   $sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$_circle_name_array.") and live='Y'");
		   }else{
			   $sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and live='Y'");	
		   }
		} 
	    
	}else{
		$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	
}
$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
?>

        <table class="table table-striped" id="order-listing" >
		  <thead>
			<tr>
			  <th style="width:65%;">Site Name</th>
			  <th>ATMID</th>
			  <!--<th>Last Communication</th> -->
			  
			</tr>
		  </thead>
		  <tbody>
<?php
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$_view = 0;
		$site_address = $sql_result['SiteAddress'];
		$atm_id = $sql_result['ATMID'];
		$_is_atmid_exist = 0;
		if($_SESSION['access']==1){
			$_is_atmid_exist = 1;
		}else{
			if (in_array($atm_id, $_circle_name_array)){
				$_is_atmid_exist = 1;
			}
		}
		if($_is_atmid_exist == 1){
			
			$sn = $sql_result['SN'];
			$router_status = $sql_result['router_status'];
			$dvr_status = $sql_result['dvr_status'];
			$panel_status = $sql_result['panel_status'];
			$datetime1 = new DateTime();
			$dvrlast_communication = $sql_result['dvr_lastcommunication'];
			if($dvr_status>0){
				if($dvrstatus==0)
					$_view = 1;
			}else{
				if($dvrstatus==1)
					$_view = 1;	
			}
		}
		if($_view==1){
		     if($dvrlast_communication=='0000-00-00 00:00:00'){
				 $dvrlast_communication = $start_date_time." 14:16:00";
			 }
		?>
	            <tr>
				  <td><?php echo $site_address;?></td><td><?php echo $atm_id;?></td>
				  <!--<td class="pr-0 text-right"><div class="badge badge-pill <?php //if($dvrstatus==0){ echo 'badge-success';}else{ echo 'badge-danger';}?>"><?php //echo $dvrlast_communication;?></div></td> -->
				  
				</tr>
		<?php	}
						}
					}
				  
				  ?>
				
			  </tbody>
			</table>
<?php
CloseCon($con);

?>


