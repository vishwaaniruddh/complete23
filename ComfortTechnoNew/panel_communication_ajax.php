<?php include('db_connection.php'); ?>
<?php 

function getsitedetail($paramater,$panelid,$con){
	//global $con;
   // $con = OpenCon();
	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result[$paramater];
}


function getPanelName($panelid,$con){
//	global $con;
//	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panelid,$con,$alarm)
{
    $panel_name = getPanelName($panelid,$con);
	$paramater = 'SensorName';
	$sql = "";
	$_change = 0;
	if($panel_name=='comfort'){
		if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_hdfc32'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_hdfc32 where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_hdfc32 where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."' AND status=0");
	}
	if($sql==""){
		$return = "";
	}else{
		if(mysqli_num_rows($sql)>0){
	        $sql_result = mysqli_fetch_assoc($sql);
	        if($_change == 1){
				if($panel_name=='comfort'){
		            if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
						$return = $sql_result[$paramater]." Restoral";
					}
				}
				else{	
				   if(substr($alarm, -1)=='R'){
					$return = $sql_result[$paramater]." Restoral";
				   }
				}
				
		    } else{
		        $return = $sql_result[$paramater];
			}
		}else{
			$return = "";
		}
		
	}
	return $return;
  
}

function getPanelIDByAtmid($atmid,$con){
	//global $con;
	//$con = OpenCon();
    $sql = mysqli_query($con,"select * from sites where ATMID like '%".$atmid."%' "); 
    $sql_resultneo = mysqli_fetch_assoc($sql);
	//CloseCon($con);
	return $sql_resultneo['NewPanelID'];
}
$con = OpenCon();
$atmid = $_GET['atmid'];
$start = $_GET['start'];
$end = $_GET['end'];
$panelid = getPanelIDByAtmid($atmid,$con);

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
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}

$circle = "";
if(isset($_GET['circle'])){
  $circle = $_GET['circle'];
}



if($atmid!=''){   // and login_status='".$dvrstatus."'
	$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where atmid='".$atmid."' and live='Y'");
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
		   if(count($_circle_name_array)>0){
			   $sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$_circle_name_array.") and live='Y'");
		   }else{
			   $sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");	
		   }
		} 
	    
	}else{
		$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	



$sql = mysqli_query($con,"select * from alerts where panelid ='".$panelid."' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC limit 50"); 
?>

                <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
						<th>SrNo</th><th>Msg From</th><th>Type</th>
						<th>Zone</th><th>Mac ID</th><th>Panel IP</th>
						<th>Msg Received Date</th><th>Message</th><th>Panel Model</th>
						<th>Msg DateTime</th><th>Alarm Code</th><th>Alarm Desc</th><th>Receive Port</th>
					</tr>
                      </thead>
                      <tbody>
					    <?php  
                       
                        $count = 0 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ 
							    $count = $count + 1;
								$zone = $sql_result['zone'];
								$alarm = $sql_result['alarm'];
							  ?>
							   <tr>
							    <td><?php echo $count;?></td><td><?php echo getsitedetail('PanelIP',$panelid,$con);?></td><td><?php echo $sql_result['alerttype'];?></td>
                                <td><?php echo $zone;?></td><td></td><td><?php echo getsitedetail('PanelIP',$panelid,$con);?></td>
								<td><?php echo $sql_result['receivedtime'];?></td><td><?php echo $sql_result['comment'];?></td><td><?php echo getsitedetail('Panel_Make',$panelid,$con);?></td>
								<td><?php echo $sql_result['createtime'];?></td><td><?php echo $sql_result['alarm'];?></td><td><?php echo get_sensor_name($zone,$panelid,$con,$alarm);?></td>
								<td><?php echo $sql_result['sendip'];?></td>
                                </tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con);?>
