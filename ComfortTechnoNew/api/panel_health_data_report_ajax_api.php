<?php include('db_connection.php'); ?>
<?php 
$con = OpenCon();
function startsWith ($string, $startString){
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
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
	$sql = mysqli_query($con,"select $paramater from panel_health_api_response where atmid='".$atmid."'");
	if(mysqli_num_rows($sql)){
	    $sql_result = mysqli_fetch_assoc($sql);
	    $return_data = $sql_result[$paramater];
	}else{
		$return_data = '';
	}
   // CloseCon($con);
	return $return_data;
}

    $sql_qry = "SELECT * FROM `panel_health_api_response`";
	$sql = mysqli_query($con, $sql_qry);

$sql_new = mysqli_query($con, $sql_qry);

//$sql_result = mysqli_fetch_assoc($sql);
//$zone_config_thead = json_decode($sql_result['zone_config']);
//echo '<pre>';print_r($zone_config);echo '</pre>';die;
//$keys = array_keys((array)$sql_result);
//$keys_thead = $zone_config_thead;
//$sql_result1 = mysqli_fetch_assoc($sql);
?>

									    <?php $cnt = 0; $res_data = [];
										     while($sql_result_new = mysqli_fetch_assoc($sql_new)){
												 $cnt++;
											    $zone_config = json_decode($sql_result_new['zone_config']);
												$atmid = $sql_result_new['atmid'];
												$keys = $zone_config;
												
												$_newarr = array();
								
												$_newarr['id'] = $sql_result_new['id'];
												$_newarr['mac_id'] = $sql_result_new['mac_id'];
												$_newarr['atmid'] = $sql_result_new['atmid'];
												$_newarr['group_id'] = $sql_result_new['group_id'];
												$_newarr['panel_name'] = $sql_result_new['panel_name'];
												$_newarr['zone_config'] = $sql_result_new['zone_config'];
												array_push($res_data,$_newarr);
											
											 } ?>
									 

					<?php 
					
					
if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data]);
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode(utf8ize($array));
?>
					