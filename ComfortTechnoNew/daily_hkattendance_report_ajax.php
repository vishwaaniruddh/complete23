<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');

//$month = $_GET['month'];
//$year = $_GET['year'];

function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange = [];

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo) {
            $iDateFrom += 86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
	//	$start_date = '2023-10-03';
	//	$end_date = '2023-10-03';

		$_dt_range = createDateRangeArray($start_date,$end_date);

		$today = date('Y-m-d');
		$today_split = explode("-",$today);
		$this_year = $today_split[0];
		$this_month = $today_split[1];
		$created_at = date('Y-m-d H:i:s');

		$split_created_at = explode(' ',$created_at);
		$split_time = explode(":", $split_created_at[1]);
		$nowtime_hour = $split_time[0];

		$current_mon = date('m');

		$site_monitoring_charges = "3550";

		//$client = "Hitachi";
		$client = $_GET['client'];
		$banks = explode(",",$_SESSION['bankname']);
        $_bank_name = [];
        for($i=0;$i<count($banks);$i++){
		    $_bank = explode("_",$banks[$i]);
		    if($client=='All'){
			    array_push($_bank_name,$_bank[1]);
		    }else{
			   if($_bank[0]==$client){
				   array_push($_bank_name,$_bank[1]);
			   }
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
			if(count($_circle_name_array)>0){
				$_circle_name_array1=json_encode($_circle_name_array);
				$_circle_name_array1=str_replace( array('[',']','"') , ''  , $_circle_name_array1);
				$circlearr_atm=explode(',',$_circle_name_array1);
				$_circle_name_array1 = "'" . implode ( "', '", $circlearr_atm )."'";
			}	
		}

 $bank = "";$circle="";
   $atmid = "";
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}

//$bank = "PNB";

$list=array();$list1=array();

$month = date('m');
$year = date('Y');

$uptime_arr = array();
	$downtime_arr = array();
for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		if($d==1){
			$_first_date_month = date('Y-m-d', $time);
		}
		$list1[]=date('Y-m-d', $time);
		$uptime_arr[] = 0;
		$downtime_arr[] = 0;
	}
}

if($atmid!=''){
	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type,s.NewPanelID from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.ATMID='".$atmid."' and live='Y' GROUP BY s.SN";
	
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
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type,s.NewPanelID from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y' GROUP BY s.SN";	
			   
			}else{
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type,s.NewPanelID from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y' GROUP BY s.SN";	
		    } 
	  
	}else{
		if($client=='All'){
			
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type,s.NewPanelID from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.live='Y' GROUP BY s.SN";	
		}else{
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type,s.NewPanelID from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y' GROUP BY s.SN";
	    }
	}
	
}

 //echo $sql_qry;die;
 $sql = mysqli_query($con,$sql_qry); 
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
							<th>Custodian (hh:mm)</th>
							<th>Housekeeper (hh:mm)</th>
                            <th>QRT (hh:mm)</th>
							<th>Technician (hh:mm)</th> 	
                            <th>Bank (hh:mm)</th>							
                        </tr>
                      </thead>
                      <tbody>
					    <?php $yesterday = date('Y-m-d',strtotime("-1 days"));
						      $today = date('Y-m-d');
							// $start_date = $_first_date_month;
							  
                              $last_date =  date("Y-m-t", strtotime($_first_date_month));
							 // $end_date = $last_date;
                        $count = 0; $tot_daycnt = 0;
						$tot_daycnt = count($_dt_range);
						if($end_date==$today){
							$total_timemonth = ($tot_daycnt - 1) * 24;
							$total_timemonth = $total_timemonth + $nowtime_hour;
							
						}else{
							$total_timemonth = $tot_daycnt * 24;
						}
						 if(mysqli_num_rows($sql)){
							while($sql_result = mysqli_fetch_assoc($sql)){
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
									
									$net_qry_sql = "SELECT createtime FROM `alerts` WHERE panelid='".$_panelid."' AND alerttype LIKE '%HK' AND CAST(createtime AS DATE)>='".$start_date."' AND CAST(createtime AS DATE)<='".$end_date."'";
									$net_sql_res = mysqli_query($con,$net_qry_sql);
									$qrt = '';
									$total_net_his = mysqli_num_rows($net_sql_res);
									$custodian = '';
									$housekeeper = '';
									$technician = '';
									$bankdata = '';
									$on_date = '';
									if($total_net_his>0){
										while($net_his_sql_result = mysqli_fetch_assoc($net_sql_res)){
											$create_time = $net_his_sql_result['createtime'];
											$create_time_explode = explode(" ",$create_time);
											$on_date = $create_time_explode[0];
											$housekeeper = $create_time_explode[1];
										}
									}
									
									?>
									   <tr>
									       <td><?php echo $count;?></td>
										   <td><?php echo $atm_id;?></td>
										   <td><?php echo $_circleName;?></td>
										   <td><?php echo $_Zone;?></td>
										   <td><?php echo $sql_result['State'];?></td>
										   <td><?php echo $site_address;?></td>
						                   <td><?php echo $site_type;?></td>
										   <td><?php echo $on_date;?></td><td></td>
										   <td><?php echo $housekeeper;?></td><td></td><td></td><td></td>
										   
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

