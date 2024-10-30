<?php date_default_timezone_set('Asia/Kolkata');
include('eazyinfra_functions.php'); 
//$onoff_type = $_POST['onoff_type'];
//$mac_id = $_POST['mac_id'];
//$set_type = $_POST['set_type'];
$onoff_type = 1;
$mac_id = "30001106";
$set_type = 234;
if($set_type=='Hooter'){
	$set_type = 234;
}
if($set_type=='Siren'){
	$set_type = 235;
}

$get_details = json_decode(setHooterSiren($org_id,$mac_id,$onoff_type,$set_type,$access_token,$con),true);
//echo json_encode($get_details);
if($get_details['statusCode']==200){
	echo '<pre>';print_r($get_details);echo '</pre>';
}
else if($get_details['statusCode']==401){
	$login_data = userlogin($email,$password,$con);
	if($login_data==1){
		$ems_login_sql = mysqli_query($con,"select email,password,access_token,org_id,refresh_token from eazyinfra_login_access where id=1");
        $ems_login_access = mysqli_fetch_assoc($ems_login_sql);
		$access_token = $ems_login_access['access_token'];
		$org_id = $ems_login_access['org_id'];
		$refresh_token = $ems_login_access['refresh_token'];

		$email=$ems_login_access['email'];
		$password=$ems_login_access['password']; 
		//$get_details = json_decode(getHooterSirenStatus($org_id,$panel_id,$group_id,$access_token,$con),true);
		//echo '<pre>';print_r($get_details);echo '</pre>';
	}else{
		echo 'Something Wrong check login credentials!';
	}
}else{
	echo '<pre>';print_r($get_details);echo '</pre>';
	echo 'Something Wrong !';
}


