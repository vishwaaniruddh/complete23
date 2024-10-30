<?php //var_dump($_GET); ?>
<?php session_start();include('db_connection.php');  error_reporting(0);
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
$i = 1;
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
			$query1 = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.ATMID IN (".$circleatmidarray.") and a_s.live='Y' ORDER BY aaa.id DESC";
	        
	}else{ 
		$query1 = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.live='Y' ORDER BY aaa.id DESC";
		
	} 

$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;


?>

<table class="table table-striped" id="order-listing1">
    <thead>
        <tr>
            <th>SN</th>
            <th style="width:65%;">Site Name</th>
            <th>ATMID</th>
            <!-- <th>Project</th> -->
            <th>Customer</th>
            <th>Bank</th>
            <th>State</th>
            <th>City</th>
            <th>Zone</th>
           <!-- <th>NewPanelID</th>
            <th>DVRIP</th>
            <th>DVRName</th> -->
           <!-- <th>live</th>
            <th>UserName</th>
            <th>Password</th>
            <th>PanelIP</th> 
            <th>Status</th> -->


        </tr>
    </thead>
    <tbody>
        <?php
		$sql = mysqli_query($con,$query1);
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$_view = 0;
		$ticket_id = $sql_result['ID'];
		if($sitestatus=='All'){
			$_view = 1;
		}else{
			if($sitestatus=='Online'){
			  if($ticket_id){
				  $_view = 1;
			  }
			}else{
				if($ticket_id){
				  
			  }else{
				  $_view = 1;
			  }
			}
		}
		
		$site_address = $sql_result['SiteAddress'];        
        $customer = $sql_result['Customer'];        
		$atm_id = $sql_result['ATMID'];
        $_bank = $sql_result['Bank'];
        $_state = $sql_result['State'];
        $_city = $sql_result['City'];
        $_zone = $sql_result['Zone'];         
        $newpanelid = $sql_result['NewPanelID'];
		$dvrip = $sql_result['DVRIP'];
        $dvrname = $sql_result['DVRName'];
        $panelip = $sql_result['PanelIP'];
        $_live = $sql_result['live'];
        $usrname = $sql_result['UserName'];
        $password = $sql_result['Password'];
        $remark = $sql_result['AlertType'];    
        $project = $sql_result['Project'];  



		$_is_atmid_exist = 0;
        $_SESSION['access']=1;
		if($_SESSION['access']==1){
			$_is_atmid_exist = 1;
		}else{
			if (in_array($atm_id, $_circle_name_array)){
				$_is_atmid_exist = 1;
			}
		}
			
        if($_view==1){			
		?>
        <tr>
            <td><?=$i;?></td>
            <td><?php echo $site_address;?></td>

            <td><?php echo $atm_id;?></td>
            <!-- <td><?=$project;?></td> -->
            <td><?=$customer;?></td>
            <td><?=$_bank;?></td>
            <td><?=$_state;?></td>
            <td><?=$_city;?></td>
            <td><?=$_zone;?></td>
            


        </tr>
        <?php	
					$i++;	}
	    }
		}
	  
	  ?>

    </tbody>
</table>
<?php
CloseCon($con);

?>