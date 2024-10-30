<?php //var_dump($_GET); ?>
<?php session_start();include('db_connection.php');  
$_designation = $_SESSION['designation'];
//error_reporting(0);
$con = OpenCon();
$start_date_time = date('Y-m-d', strtotime('-7 days'));
$time = date("H:i:s");
date_default_timezone_set('Asia/Kolkata');
 $created_at = date('Y-m-d H:i:s');
 $created_date = date('Y-m-d');
 //$created_by = $_SESSION['userid'];
 
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
		$is_month = 0;
		if($elapsedyear>0){$not=$not+1;}
		if($elapsedmon>0){$not=$not+1;$is_month=1;}
		//if($elapsed_day>0){$not=$not+1;}
		//if($elapsedhr>0){$not=$not+1;}
		$min = $elapsedmin;
		$hour = $elapsedhr;
		
		if($not>0){
			if($is_month==1){
			   $return  = $elapsed_day;
			}else{
			   $return = 0;
			}
		}else{
			$return  = $elapsed_day;
		/*	if($elapsed_day>3){
				$return = 1;
			}else{
				$return = 0;
			} */
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
$atmid = "";
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
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
			$query1 = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id,c.created_at,c.current_status  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.ATMID IN (".$circleatmidarray."))";
			
	}else{ 
		$query1 = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id,c.created_at,c.current_status FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID"; 
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
            <th>SN</th>
            <th style="width:65%;">Site Name</th>
            <th>ATMID</th>
            <!-- <th>Project</th> -->
            <th>Customer</th>
            <th>Bank</th>
            <th>State</th>
            <th>City</th>
            <th>Zone</th>
			<th>Ticket ID</th>
			<th>Created</th>
			<th>Aging</th>
			<th>Action</th>
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
        <?php $i = 1;
		$make_status = 1;
        $hdd = 'Closed';
		
		$sql = mysqli_query($con,$query1);
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$_view = 0;
		$current_status = $sql_result['current_status'];
		if($sitestatus=='All'){
			$_view = 1;
		}else{
			if($sitestatus=='Open'){
			  if($current_status==0){
				  $_view = 1;
			  }
			}else{
			  if($current_status==1){
				  $_view = 1;
			  }else{
				  
			  }
			}
		}
		
		$id = $sql_result['cl_id'];
										  
		
		$ticket_id = $sql_result['ticket_id'];
		$created_days = lastcommunicationdiff($sql_result['created_at']);
		$site_address = $sql_result['SiteAddress'];        
        $customer = $sql_result['Customer'];        
		$atm_id = $sql_result['ATMID'];
        $_bank = $sql_result['Bank'];
        $_state = $sql_result['State'];
        $_city = $sql_result['City'];
        $_zone = $sql_result['Zone'];  
/*
        if($created_days>3){
			if($current_status==0){
				$_view = 0;
				$updatesql = "update call_log_dvr_alerts SET current_status=1,autoclose=1,current_remark='".$hdd."',updated_by='".$created_by."',updated_at='".$created_at."' WHERE id='".$id."'";
				if(mysqli_query($con,$updatesql)){
					$insertcallhissql = "insert into call_log_dvr_alerts_history (call_log_id,current_status,current_remark,updated_by,updated_at)
													  values('".$id."','".$make_status."','".$hdd."','".$created_by."','".$created_at."')";
					mysqli_query($con,$insertcallhissql);	
				}				
			}
		} 		
*/        
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
            <td><?php echo $i;?></td>
            <td><?php echo $site_address;?></td>

            <td><?php echo $atm_id;?></td>
           
            <td><?php echo $customer;?></td>
            <td><?php echo $_bank;?></td>
            <td><?php echo $_state;?></td>
            <td><?php echo $_city;?></td>
            <td><?php echo $_zone;?></td>
			<td><?php echo $ticket_id;?></td>
			<td><?php echo $sql_result['created_at'];?></td>
			<td><?php echo $created_days." Days";?></td>
            <td>
			<?php if($current_status=='0'){ if($_designation=='1'){?>
			<button type="button" class="btn btn-primary btn-sm small-modal" data-id="<?php echo $id;?>" data-alert_type="A" data-toggle="modal" data-target="#smallModal">Update<i class="fa fa-play-circle ml-1"></i></button>
			<?php }}?>
			<button type="button" class="btn btn-primary btn-sm large-modal" data-id="<?php echo $id;?>" data-toggle="modal" data-target="#largeModal">View Ticket History<i class="fa fa-play-circle ml-1"></i></button>
			</td>


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