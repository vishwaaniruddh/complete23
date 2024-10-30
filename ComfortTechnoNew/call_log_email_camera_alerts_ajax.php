<?php session_start();include('db_connection.php'); $con = OpenCon(); ?>
<?php 
 date_default_timezone_set('Asia/Kolkata');
 $created_at = date('Y-m-d H:i:s');
 $created_date = date('Y-m-d');
 $date_pattern = date('Ymd'); 
 
 $created_by = $_SESSION['userid'];
 
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%a');
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
		//if($elapsed_day>0){$not=$not+1;}
		//if($elapsedhr>0){$not=$not+1;}
		$min = $elapsedmin;
		$hour = $elapsedhr;
		if($not>0){
			$return = 0;
		}else{
			$return = $elapsed_day;
		/*	if($elapsed_day>3){
				$return = 1;
			}else{
				$return = 0;
			} */
		}
				
		return $return;	   
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
 
  $check_call_log_emailsql = mysqli_query($con,"select * from call_log_camera_alerts_email where action_date = '".$created_date."'");
  //echo mysqli_num_rows($check_call_log_emailsql);die;
  if(mysqli_num_rows($check_call_log_emailsql)==0){
	//$client = $_POST['client'];
    $client = "Hitachi";
    //echo $_SESSION['access'];
    //echo $_SESSION['userid'];die;
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
	//echo $_SESSION['circlename'];die;
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
  
    $bank = "PNB";

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
			$dvr_qry = "SELECT * FROM `network_report_list` WHERE SN IN (SELECT SN FROM sites WHERE Customer='".$client."' AND Bank='".$bank."' AND ATMID IN (".$circleatmidarray.") AND live='Y') AND router_status=0";
	}else{ 
		$dvr_qry = "SELECT * FROM `network_report_list` WHERE SN IN (SELECT SN FROM sites WHERE Customer='".$client."' AND Bank='".$bank."' AND live='Y') AND router_status=0";	
	} 
	
	$sql = mysqli_query($con,$dvr_qry);
	
	
	$totalsite = mysqli_num_rows($sql); 
	$n = 0;
    if($totalsite>0){
	    while($sql_result = mysqli_fetch_assoc($sql)){
			$n++;
			$n2 = str_pad($n + 1, 3, 0, STR_PAD_LEFT);
			$atmid = $sql_result['ATMID'];
			$hdd = 'Not Working';
			$current_status = 0;
			$ticket_id = $date_pattern.$n2;
			$select_qry = "select * from call_log_camera_alerts where ATMID='".$atmid."' AND current_status=0 AND call_log_aging<=3";
			$select_data = mysqli_query($con,$select_qry);
			if(mysqli_num_rows($select_data)==0){
				$insert_sql = "insert into call_log_camera_alerts (ticket_id,ATMID,current_status,autoclose,current_remark,created_by,created_at,updated_by,updated_at,action_date)
											  values('".$ticket_id."','".$atmid."','".$current_status."','".$current_status."','".$hdd."','".$created_by."','".$created_at."','".$created_by."','".$created_at."','".$created_date."')";
				//echo $insert_sql;die;				
				$result=mysqli_query($con,$insert_sql) ;
				if($result) {
				  $last_id = $con->insert_id;
				  $insert_sql_history = "insert into call_log_camera_alerts_history (call_log_id,current_status,current_remark,updated_by,updated_at)
											  values('".$last_id."','".$current_status."','".$hdd."','".$created_by."','".$created_at."')";
							
				  $result_his=mysqli_query($con,$insert_sql_history) ;
				}
			}else{
				$res_data = mysqli_fetch_assoc($select_data);
				$id = $res_data['id']; //echo $id;
				$created_at_dt_time = $res_data['created_at']; //echo $created_at_dt_time.' .. ';
				$call_log_aging = lastcommunicationdiff($created_at_dt_time);
				
				$update_sql = "update call_log_camera_alerts SET call_log_aging='".$call_log_aging."' where id='".$id."'";
				$update_sql_qry = mysqli_query($con, $update_sql);
				//$update_sql_qry = mysqli_query($con, $update_sql);
				if($call_log_aging>3){
					$make_status = 1;
					$hdd = 'Close';
					$updatesql = "update call_log_camera_alerts SET current_status=1,autoclose=1,current_remark='".$hdd."',updated_by='".$created_by."',updated_at='".$created_at."' WHERE id='".$id."'";
					if(mysqli_query($con,$updatesql)){
						$insertcallhissql = "insert into call_log_camera_alerts_history (call_log_id,current_status,current_remark,updated_by,updated_at)
														  values('".$id."','".$make_status."','".$hdd."','".$created_by."','".$created_at."')";
						mysqli_query($con,$insertcallhissql);	
					}	
				}
			}
			
			
		}
		
		    $call_log_select_qry = "select * from call_log_camera_alerts where current_status=0";
			//echo $call_log_select_qry;die;
			$call_log_select_data = mysqli_query($con,$call_log_select_qry);
			if(mysqli_num_rows($call_log_select_data)>0){
				while($call_log_res_data = mysqli_fetch_assoc($call_log_select_data)){
					$call_log_id = $call_log_res_data['id'];
					$call_log_created_at_dt_time = $call_log_res_data['created_at'];
					$call_log_call_log_aging = lastcommunicationdiff($call_log_created_at_dt_time);
					$call_log_update_sql = "update call_log_camera_alerts SET call_log_aging='".$call_log_call_log_aging."' where id='".$call_log_id."'";
					$call_log_update_sql_qry = mysqli_query($con, $call_log_update_sql);
					//echo $call_log_call_log_aging.'..';
					//$update_sql_qry = mysqli_query($con, $update_sql);
					if($call_log_call_log_aging>3){
						$call_log_make_status = 1;
						$call_log_hdd = 'Close';
						$call_log_updatesql = "update call_log_camera_alerts SET current_status=1,autoclose=1,current_remark='".$call_log_hdd."',updated_by='".$created_by."',updated_at='".$created_at."' WHERE id='".$call_log_id."'";
						if(mysqli_query($con,$call_log_updatesql)){
							$call_log_insertcallhissql = "insert into call_log_camera_alerts_history (call_log_id,current_status,current_remark,updated_by,updated_at)
															  values('".$call_log_id."','".$call_log_make_status."','".$call_log_hdd."','".$created_by."','".$created_at."')";
							mysqli_query($con,$call_log_insertcallhissql);	
						}	
					}
			    }
			}
		
		$code = 200;
	    $array = array(['code'=>$code,'tot_sites'=>$totalsite]);
	    $insertemail_sql = "insert into call_log_camera_alerts_email (action_date,action_datetime)
											  values('".$created_date."','".$created_at."')";
								
		$result_email=mysqli_query($con,$insertemail_sql) ;
	}
	
  }else{
	$code = 201;
	$array = array(['code'=>$code]);
  }
	


CloseCon($con);

echo json_encode($array);
?>