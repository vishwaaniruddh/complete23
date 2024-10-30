<?php //var_dump($_GET); ?>
<?php session_start();include('db_connection.php');  error_reporting(0);
$con = OpenCon();
$start_date_time = date('Y-m-d', strtotime('-7 days'));
$time = date("H:i:s");
session_start();
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
$tbl_cnt = 1;
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
$sitestatus = $_GET['status'];
$circle = "";
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}
if($sitestatus=='All'){
	
}else{
	if($sitestatus=='Online'){
		// $_status = 1;
		$live = "and live ='Y'";
	} else {
		$live = "and live !='Y'";
	}
}


if($atmid!=''){
    
	$sql = "select SN,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,Phase,Status,OldPanelID,NewPanelID,DVRIP,DVRName,DVR_Model_num,Router_Model_num,eng_name,Customer,Bank,SiteAddress,State,City,Zone,Panel_Make,live,UserName,Password,site_remark  from sites where atmid='".$atmid."' ";
}else{
	if($bank!=''){ 
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
				$sql = "select SN,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,Phase,Status,OldPanelID,NewPanelID,DVRIP,DVRName,DVR_Model_num,Router_Model_num,eng_name,Customer,Bank,SiteAddress,State,City,Zone,Panel_Make,live,UserName,Password,site_remark  from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") ";
		}else{ 
			$sql = "select SN,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,Phase,Status,OldPanelID,NewPanelID,DVRIP,DVRName,DVR_Model_num,Router_Model_num,eng_name,Customer,Bank,SiteAddress,State,City,Zone,Panel_Make,live,UserName,Password,site_remark  from sites where Customer='".$client."' and Bank='".$bank."' ";	
		} 
	    
	}else{
		$sql = "select SN,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,Phase,Status,OldPanelID,NewPanelID,DVRIP,DVRName,DVR_Model_num,Router_Model_num,eng_name,Customer,Bank,SiteAddress,State,City,Zone,Panel_Make,live,UserName,Password,site_remark  from sites where Customer='".$client."' and Bank IN (".$_bank_name.") ";
	}
    $sql1 = $sql.$live;
    // echo $sql1; die;
	$sql = mysqli_query($con,$sql1);
   
}
$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;


?>

<table class="table table-striped" id="order-listing">
    <thead>
        <tr>
		    <?php if($sitestatus=='Online' || $sitestatus=='All'){ ?>
			<th>Action</th>
			<?php } ?>
            <th>SN</th>
            <th style="width:65%;">Site Name</th>
            <th>ATMID</th>
            <th>ATMID_2</th>
            <th>ATMID_3</th>
            <th>ATMID_4</th>
            <th>TrackerNo</th>
            <th>ATMShortName</th>
            <th>Phase</th>
           <!-- <th>Status</th>
            <th>OldPanelID</th>
            <th>NewPanelID</th>
            <th>DVRIP</th>
            <th>DVRName</th>
            <th>PanelIP</th>
            <th>DVR_Model_num</th>
            <th>Router_Model_num</th> -->
            <th>eng_name</th>
            <th>Customer</th>
            <th>Bank</th>
            <th>State</th>
            <th>City</th>
            <th>Zone</th>
           <!--  <th>Panel_Make</th>
            <th>live</th>
           <th>UserName</th>
            <th>Password</th> 
            <th>site_remark </th> -->
        </tr>
    </thead>
    <tbody>
        <?php
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$_view = 0;
		$site_address = $sql_result['SiteAddress'];
		$atm_id = $sql_result['ATMID'];
        $atm_id2 = $sql_result['ATMID_2'];
        $atm_id3 = $sql_result['ATMID_3'];
        $atm_id4 = $sql_result['ATMID_4'];
        $trackerno = $sql_result['TrackerNo'];
        $atmshortname = $sql_result['ATMShortName'];
        $phase = $sql_result['Phase'];
        $_sitestatus = $sql_result['Status'];
        $oldpanelid = $sql_result['OldPanelID'];
        $newpanelid = $sql_result['NewPanelID'];
		$dvrip = $sql_result['DVRIP'];
        $dvrname = $sql_result['DVRName'];
        $panelip = $sql_result['PanelIP'];
        $dvrmodelno = $sql_result['DVR_Model_num'];
        $routermodelno = $sql_result['Router_Model_num'];
        $engname = $sql_result['eng_name'];
        $customer = $sql_result['Customer'];
        $_bank = $sql_result['Bank'];
        $_state = $sql_result['State'];
        $_city = $sql_result['City'];
        $_zone = $sql_result['Zone']; 
        $panelmake = $sql_result['Panel_Make'];
        $_live = $sql_result['live'];
        $usrname = $sql_result['UserName'];
        $password = $sql_result['Password'];
        $remark = $sql_result['site_remark'];



		$_is_atmid_exist = 0;
        $_SESSION['access']=1;
		if($_SESSION['access']==1){
			$_is_atmid_exist = 1;
		}else{
			if (in_array($atm_id, $_circle_name_array)){
				$_is_atmid_exist = 1;
			}
		}
				
		?>
        <tr>
		<?php if($sitestatus=='Online' || $sitestatus=='All'){ if($_live=='Y'){ ?>
		    <td>
			   <form action="live_view.php" method="POST">
			      <input type="hidden" name="atmid" value="<?php echo $atm_id;?>">
				  <input type="submit" class="btn btn-primary" value="Check Live View">
			   </form>
			</td>
		<?php }else{ ?>
		    <td></td>
		<?php } } ?>
            <td><?=$tbl_cnt;?></td>
            <td><?php echo $site_address;?></td>
            <td><?php echo $atm_id;?></td>
            <td class="pr-0 text-right"><?=$atm_id2;?></td>
            <td class="pr-0 text-right"><?=$atm_id3;?></td>
            <td class="pr-0 text-right"><?=$atm_id4;?></td>
            <td class="pr-0 text-right"><?=$trackerno?></td>
            <td class="pr-0 text-right"><?=$atmshortname;?></td>
            <td class="pr-0 text-right"><?=$phase;?></td>
            
            <td class="pr-0 text-right"><?=$engname;?></td>
            <td class="pr-0 text-right"><?=$customer;?></td>
            <td class="pr-0 text-right"><?=$_bank;?></td>
            <td class="pr-0 text-right"><?=$_state;?></td>
            <td class="pr-0 text-right"><?=$_city;?></td>
            <td class="pr-0 text-right"><?=$_zone;?></td>

        </tr>
        <?php	
					$tbl_cnt++;	}
					}
				  
				  ?>

    </tbody>
</table>
<?php
CloseCon($con);

?>