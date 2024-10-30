<?php include('db_connection.php');?>
<?php 
$con = OpenCon();
function startsWith ($string, $startString){
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

function getPanelName($atmid, $con){
	//global $con;
	//$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	//CloseCon($con);
	return $sql_result['Panel_Make'];
}

function getrass($zone,$paramater,$atmid,$con){
	//global $con;
	//$con = OpenCon();
	$panel_name = getPanelName($atmid, $con);
	$paramater = 'SensorName';
	$sql = "";
	$_change = 0;
	if($panel_name=='comfort'){
		$sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."'");
	}
	if($panel_name=='rass_boi'){
		$sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."'");
	}
	if($panel_name=='rass_pnb'){
		$sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."'");
	}
	if($panel_name=='smarti_boi'){
		$sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."'");
	}
	if($panel_name=='smarti_pnb'){
		$sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."'");
	}
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND status=0");
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
/*
function getrass($zone){
	global $con;

	$sql = mysqli_query($con,"select * from rass_cloudnew where ZONE='".$zone."'");
	$sql_result = mysqli_fetch_assoc($sql);

	return $sql_result['SensorName'];
}
*/
function getrassstatus($paramater,$atmid,$con){
	//global $con;
    //$con = OpenCon();
	$sql = mysqli_query($con,"select $paramater from panel_health where atmid='".$atmid."'");
	if(mysqli_num_rows($sql)){
	    $sql_result = mysqli_fetch_assoc($sql);
	    $return_data = $sql_result[$paramater];
	}else{
		$return_data = '';
	}
   // CloseCon($con);
	return $return_data;
}


$atmid = $_GET['atmid'];

//$panel_qry = "SELECT * FROM `panel_health` AS p INNER JOIN sites s ON s.ATMID=p.atmid WHERE p.atmid='".$atmid."'";
$sql = mysqli_query($con,"select * from panel_health where atmid='".$atmid."'");
//$sql = mysqli_query($con, $panel_qry);

if(!$sql || mysqli_num_rows($sql)==0){ ?>
	<span>No Data Found</span>
<?php }else{
$sql_result = mysqli_fetch_assoc($sql);
$keys = array_keys((array)$sql_result);

$sql_result1 = mysqli_fetch_assoc($sql);

$site_sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."'");
//$sql = mysqli_query($con, $panel_qry);
$panel_make = "";
if(!$site_sql || mysqli_num_rows($site_sql)==1){
	$site_sql_result = mysqli_fetch_assoc($site_sql);
	//echo '<pre>';print_r($site_sql_result);echo '</pre>';die;
	$panel_make = $site_sql_result['Panel_Make'];
	
	if($panel_make == 'comfort'){
		$comfort_sql = mysqli_query($con,"select * from panel_health_api_response where atmid='".$atmid."'");
		if(!$comfort_sql || mysqli_num_rows($comfort_sql)==1){
			$comfort_sql_result = mysqli_fetch_assoc($comfort_sql);
			$zone_config = $comfort_sql_result['zone_config'];
			$zonconfig =  json_decode($zone_config,true);
			$mac_id = $comfort_sql_result['mac_id'];
			$hooter_sql = mysqli_query($con,"select * from hooter_siren_command_status where mac_id='".$mac_id."' AND command_type='Hooter' order by id DESC LIMIT 1");
			$hooter_current_status = "0";
			if(mysqli_num_rows($hooter_sql)>0){
				$hooter_sql_result = mysqli_fetch_assoc($hooter_sql);
				$hooter_current_status = $hooter_sql_result['current_status'];
			}
			
			$siren_sql = mysqli_query($con,"select * from hooter_siren_command_status where mac_id='".$mac_id."' AND command_type='Siren' order by id DESC LIMIT 1");
			$siren_current_status = "0";
			if(mysqli_num_rows($siren_sql)>0){
				$siren_sql_result = mysqli_fetch_assoc($siren_sql);
				$siren_current_status = $siren_sql_result['current_status'];
			}
		}
	}
}

?>

                                <div class="table-responsive">
									<table id="order-listing" class="table">
									  <thead>
										<tr>
											<th>ATMID</th><th>Action</th>
											<?php if($panel_make == 'comfort'){ ?>
											<th>Hooter Status</th>
											<th>Siren Status</th>
											<?php } ?>
											<?php
											if($panel_make == 'comfort'){
												$count = 1 ; 
												foreach($zonconfig as $conval=>$conkey){ ?>
													<th id="thid<?php echo $count;?>" ><?php echo $conkey['zone_name']; ?></th>
														 
											<?php $count++; }
											}else{
												$count = 1 ; 
												//for($i=0;$i<count($sql_result);$i++){
												//	$key = $sql_result[$i];
												foreach($keys as $val=>$key){
													if(startsWith ($key, 'zon')){ 
																preg_match_all('!\d+!', $key, $matches);
																$intkey = $matches[0][0];
																if($intkey < 10 ){
																	$intkey = '00'.$intkey ;
																}else if($intkey < 100){
																	$intkey = '0'.$intkey ;
																}
																//echo $intkey."</br>";
																//if($intkey!='997' || $intkey!='998'){
														?>
														 <th id="thid<?php echo $count;?>" onclick="getrass(<?php echo $intkey;?>,'SensorName',<?php echo $atmid;?>)"><?php echo getrass($intkey,'SensorName',$atmid,$con); ?></th>
														 
													<?php	$count++; } 
												}
											}
                                            ?>
										</tr>
									  </thead>
									  <tbody>
										<tr>
											<td><?php echo $atmid;?></td><td><a href="add_ticket.php?alarmtype=0&atmid=<?php echo $atmid;?>" target="_blank">Ticket Raise</a></td>
											<?php if($panel_make == 'comfort'){ ?>
											
											<td><button id="hooter_<?php echo $mac_id;?>" type="button" class="btn <?php if($hooter_current_status=='1'){ echo 'btn-success';}else{ echo 'btn-danger';}?> btn-rounded btn-fw" onclick="setHooter('<?php echo $mac_id;?>','<?php echo $hooter_current_status;?>')"><?php if($hooter_current_status=='1'){ echo 'Hooter ON';}else{ echo 'Hooter OFF';}?></button></td>
											
											<td><button id="siren_<?php echo $mac_id;?>" type="button" class="btn <?php if($siren_current_status=='1'){ echo 'btn-success';}else{ echo 'btn-danger';}?> btn-rounded btn-fw" onclick="setSiren('<?php echo $mac_id;?>','<?php echo $siren_current_status;?>')"><?php if($siren_current_status=='1'){ echo 'SIREN ON';}else{ echo 'SIREN OFF';}?></button></td>
											
											<?php } ?>
											<?php 
											if($panel_make == 'comfort'){
												$count = 1 ; 
												foreach($zonconfig as $conval=>$conkey){ ?>
													<td id="tdid<?php echo $count;?>">
															<p style="text-align:center;"><?php //echo $key; ?></p>  
															<div 
															<?php if($conkey['arm_status']=='1'){ echo "class='badge badge-success badge-pill mb-2'" ; }
																	elseif($conkey['arm_status']=='0'){ echo "class='badge badge-danger badge-pill mb-2'"; }
																	elseif($conkey['arm_status']=='2'){ echo "class='badge badge-warning badge-pill mb-2'"; }
																	elseif($conkey['arm_status']=='9'){ echo "class='badge badge-info badge-pill mb-2'"; }?> >
															<?php if($conkey['status']=='0'){ echo 'Working';}else{ echo 'Not Working'; }?>
															</div>
															
														 </td>
														 
											<?php $count++; }
											}else{
												$count = 1 ; 
												//echo '<pre>';print_r($sql_result);echo '';die;
												foreach($keys as $value=>$key){
													if(startsWith ($key, 'zon')){ ?>
														 <td id="tdid<?php echo $count;?>">
															<p style="text-align:center;"><?php //echo $key; ?></p>  
															<div 
															<?php if(getrassstatus($key,$atmid,$con)=='0'){ echo "class='badge badge-success badge-pill mb-2'" ; }
																	elseif(getrassstatus($key,$atmid,$con)=='1'){ echo "class='badge badge-danger badge-pill mb-2'"; }
																	elseif(getrassstatus($key,$atmid,$con)=='2'){ echo "class='badge badge-warning badge-pill mb-2'"; }
																	elseif(getrassstatus($key,$atmid,$con)=='9'){ echo "class='badge badge-info badge-pill mb-2'"; }?> >
															<?php if(getrassstatus($key,$atmid,$con)=='0'){ echo 'Working';}else{ echo 'Not Working'; }?>
															</div>
															<!--
															<p 
															<?php /* if(getrassstatus($key,$atmid,$con)=='0'){ echo "class='paneltime green'" ; }
																	elseif(getrassstatus($key,$atmid,$con)=='1'){ echo 'class="paneltime red"'; }
																	elseif(getrassstatus($key,$atmid,$con)=='2'){ echo 'class="paneltime white"'; }
																	elseif(getrassstatus($key,$atmid,$con)=='9'){ echo 'class="paneltime orchid"' ; }
																	*/
															 ?>>
															 <?php //if(getrassstatus($key,$atmid,$con)=='0'){ echo 'Working';}else{ echo 'Not Working'; }?>
																<?php //echo getrassstatus($key,$atmid,$con); ?></p> -->
														 </td>
												<?php $count++;	}
												}
                                            }

											 ?>
										</tr>
									  </tbody>
									</table>
								  </div>

											 <?php } CloseCon($con);?>
