<?php include('db_connection.php'); 
 date_default_timezone_set('Asia/Kolkata');
 $created_at = date('Y-m-d H:i:s');
 
  function headersToArray( $str )
	{
		$headers = array();
		$headersTmpArray = explode( "\r\n" , $str );
		for ( $i = 0 ; $i < count( $headersTmpArray ) ; ++$i )
		{
			// we dont care about the two \r\n lines at the end of the headers
			if ( strlen( $headersTmpArray[$i] ) > 0 )
			{
				// the headers start with HTTP status codes, which do not contain a colon so we can filter them out too
				if ( strpos( $headersTmpArray[$i] , ":" ) )
				{
					$headerName = substr( $headersTmpArray[$i] , 0 , strpos( $headersTmpArray[$i] , ":" ) );
					$headerValue = substr( $headersTmpArray[$i] , strpos( $headersTmpArray[$i] , ":" )+1 );
					$headers[$headerName] = $headerValue;
				}
			}
		}
		return $headers;
	}
	
	function getDevice($url,$access_token){
					
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_SSL_VERIFYPEER => false,
			  CURLOPT_HTTPHEADER => array(
				'access_token: '.$access_token
			  ),
			));

			$response = curl_exec($curl);
			if(curl_error($curl)) {  
				print_r( curl_error($curl));  
			}  

			curl_close($curl);
			return $response;
	}
	
	function setHooter($url,$access_token,$org_id,$mac_id,$hooter_status){
		$curl = curl_init();
		$hooter_status = (int)$hooter_status;
        $org_id = (int)$org_id;
		$headers = array();
		$headers[0] = "'Content-Type : application/json'";
		$headers[1] = "'access_token : ".$access_token."'";
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.141.218.138:4510/diagnostics/cmd_new',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
				"data": '.$hooter_status.',
				"cmd": 235,
				"mac_id": "'.$mac_id.'",
				"org_id": 1004
		  }',
		  CURLOPT_HTTPHEADER => $headers,
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'access_token: '.$access_token
		  ),
		  
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}
	function getLogin(){
		$curl = curl_init();
        $postData = [
			'email' => 'pnbapi@utopiatech.in',
			'password' => 'api@123'
		];
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.141.218.138:4510/user/login',
		  CURLOPT_RETURNTRANSFER => true,  
		  CURLOPT_HEADER => 1,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_POSTFIELDS => json_encode($postData),   
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		  ), 
		));

		$response = curl_exec($curl);
        if(curl_error($curl)) {  
			print_r( curl_error($curl));  
		} 
		
		//echo $response;die;
		$headerSize = curl_getinfo( $curl , CURLINFO_HEADER_SIZE );
		$headerStr = substr( $response , 0 , $headerSize );
		$bodyStr = substr( $response , $headerSize );

		// convert headers to array
		$headers = headersToArray( $headerStr );
		$new_access_token = $headers['access_token'];
		curl_close($curl);
		if($new_access_token!=''){
		    return $new_access_token;
		}else{
			return '';
		}
	}
?>
<?php 

$con = OpenCon();
$atm_id = $_POST['atmid'];

$hooter_status = $_POST['status'];

$ems_login_sql = mysqli_query($con,"select access_token,org_id,refresh_token from ems_login_access_panel_health where id=1");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];

$url = 'http://103.141.218.138:4510/diagnostic/cmd_new';

$panel_response_sql = mysqli_query($con,"select * from panel_health_api_response where atmid='".$atm_id."'");

$is_mac_id = 0;
if(mysqli_num_rows($panel_response_sql)>0){
	$is_mac_id = 1;
	$panel_response_sql_data = mysqli_fetch_assoc($panel_response_sql);
	$mac_id = $panel_response_sql_data['mac_id'];
}

/*
if($hooter_status=='1'){
	$hooter_status = '0';
}else{
	$hooter_status = '1';
}
*/

if($is_mac_id==0){
	$array = array(['Code'=>201,'msg'=>'This atmid must have macid']);
				CloseCon($con);
				echo json_encode($array);
}else{
		$response = setHooter($url,$access_token,$org_id,$mac_id,$hooter_status);
		$check = json_decode($response,true);

		if($check['statusCode']==401){
			$new_access_token = getLogin();
			if($new_access_token!=''){
				mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."',updated_at='".$created_at."' where id=1");
				$response = setHooter($url,$new_access_token,$org_id,$mac_id,$hooter_status);
				$check = json_decode($response,true);
				//mysqli_query($con,"insert into hooter_command_status (mac_id,current_status,created_at) values ('".$mac_id."','".$hooter_status."','".$created_at."') ");
				$array = array(['Code'=>200,'res_data'=>$check]);
				CloseCon($con);
				echo json_encode($array);
			}else{
				
				$array = array(['Code'=>401]);
				CloseCon($con);
				echo json_encode($array);
			}
		}else{
			//mysqli_query($con,"insert into hooter_command_status (mac_id,current_status,created_at) values ('".$mac_id."','".$hooter_status."','".$created_at."') ");
			$array = array(['Code'=>200,'res_data'=>$check]);
			CloseCon($con);
			echo json_encode($array);
		}
}
   
?>





