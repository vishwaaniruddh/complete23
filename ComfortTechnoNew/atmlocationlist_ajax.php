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

$circle = "";
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}


$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;


$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type,s.NewPanelID from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y' GROUP BY s.SN";
	                            
$site_sql_query = mysqli_query($con,$sql_qry);


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
							<th>Latitude</th>
							<th>Longitude</th>						
                        </tr>
                      </thead>
                      <tbody>
				<?php   $yesterday = date('Y-m-d',strtotime("-1 days"));
						$today = date('Y-m-d');
						$_circle_name_array = array();
					// $start_date = $_first_date_month;
						
						//$last_date =  date("Y-m-t", strtotime($_first_date_month));
						// $end_date = $last_date;
                        $count = 0; $tot_daycnt = 0;
						
						 if(mysqli_num_rows($site_sql_query)){
							while($sql_result = mysqli_fetch_assoc($site_sql_query)){
								$atm_id = $sql_result['ATMID'];
								$lat = "";$lng = "";
								$locsql_qry = "select latitude,longitude from location_latlong where atmid='".$atm_id."'";
	                            $loc_sql_query = mysqli_query($con,$locsql_qry);
								if(mysqli_num_rows($loc_sql_query)>0){
									$locsql_result = mysqli_fetch_assoc($loc_sql_query);
									
									$lat = $locsql_result['latitude'];
									$lng = $locsql_result['longitude'];
								}
								$live_dt = $sql_result['live_date'];
								$site_type = $sql_result['site_type'];
								
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
									
									
									
									?>
									   <tr>
									       <td><?php echo $count;?></td>
										   <td><?php echo $atm_id;?></td>
										   <td><?php echo $_circleName;?></td>
										   <td><?php echo $_Zone;?></td>
										   <td><?php echo $sql_result['State'];?></td>
										   <td><?php echo $site_address;?></td>
						                   <td><?php echo $site_type;?></td>
										   <td><?php echo $lat;?></td>
										   <td><?php echo $lng;?></td>
										   
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