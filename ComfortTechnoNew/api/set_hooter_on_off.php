<?php include('db_connection.php'); 
 date_default_timezone_set('Asia/Kolkata');
 $created_at = date('Y-m-d H:i:s');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
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
	function getAccessToken($refresh_token){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.141.218.138:4510/user/accesstoken',
		  CURLOPT_RETURNTRANSFER => true,  
		  CURLOPT_HEADER => 1,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HTTPHEADER => array(
			'refresh_token: '.$refresh_token
		  ),
		));

		$response = curl_exec($curl);
        if(curl_error($curl)) {  
			print_r( curl_error($curl));  
		} 
		
		//echo $response;
		$headerSize = curl_getinfo( $curl , CURLINFO_HEADER_SIZE );
		$headerStr = substr( $response , 0 , $headerSize );
		$bodyStr = substr( $response , $headerSize );

		// convert headers to array
		$headers = headersToArray( $headerStr );
		if (array_key_exists('access_token', $headers)) {
		  $new_access_token = $headers['access_token'];
		}else{
		  $new_access_token = '';	
		}  
		
		curl_close($curl);
		if($new_access_token!=''){
		return $new_access_token;
		}else{
			return '';
		}
	}
	function setHooter_1($url,$access_token,$org_id,$mac_id,$hooter_status){
		$curl = curl_init();
		$org_id = (int)$org_id;
		//$mac_id = strval($mac_id);
		$mac_id = "30000104";
        
		$postData = array('data' => 0, 'cmd' => 234, 'mac_id' => '30000104', 'org_id' => 1004);

		
		//echo '<pre>';print_r($postData);echo '</pre>';die;
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.141.218.138:4510/diagnostics/cmd_new',
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
		    'Content-Type: application/json',
			'access_token: '.$access_token.''
		  ),
		));

		$response = curl_exec($curl);
        if(curl_error($curl)) {  
			print_r( curl_error($curl));  
		} 
		
		curl_close($curl);
		print_r($response);die;
		return $response;
	}
	function setHooter($url,$access_token,$org_id,$mac_id,$hooter_status){
		$curl = curl_init();
		$hooter_status = (int)$hooter_status;
        $org_id = (int)$org_id;
		//$mac_id = strval($mac_id);
		//$access_string = "access_token: ".;		
		//echo $access_token;die;
		$headers = array();
		$headers[0] = "'Content-Type : application/json'";
		$headers[1] = "'access_token : ".$access_token."'";
		
		//echo '<pre>';print_r($headers);echo '</pre>';die;
		
		$nh = array(
		    "access_token: $access_token",
			'Content-Type: application/json'
		  );
		  
		//  echo '<pre>';print_r((Object)$headers);echo '</pre>';die;
		
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
				"cmd": 234,
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

/* 

   CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'access_token:   eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYzYTJhNjRmYTkxODEwMzU1NDc1YTcxZSIsImVtYWlsIjoicG5iYXBpQHV0b3BpYXRlY2guaW4iLCJvcmdfaWQiOjEwMDQsImdyb3VwX2lkcyI6WyIxMSIsIjAiLCIxMiIsIjEzIiwiMTQiLCIxNSIsIjE2IiwiOCIsIjE3IiwiOSIsIjUiLCIxIiwiNCIsIjIyIiwiMjEiLCIyMCIsIjE4IiwiMjMiLCI3IiwiMyIsIjEwIiwiMTkiLCIyNCIsIjYiLCIyNSIsIjI2IiwiMjciLCIyOCIsIjIiLCIyOSIsIjMwIiwiMzIiLCIzNCIsIjM1IiwiMzYiLCIzNyIsIjM4IiwiMzkiLCI0MCIsIjQxIiwiNDIiLCI0MyIsIjQ0IiwiNDUiLCI0NiIsIjQ3IiwiNDgiLCI0OSIsIjUwIiwiNTEiLCI1MiIsIjUzIiwiNTQiLCI1NSIsIjU2IiwiNTciLCI1OCIsIjU5IiwiNjAiLCI2MSIsIjYyIiwiNjMiLCI2NCIsIjY1IiwiNjYiLCI2NyIsIjY4IiwiNjkiLCI3MCIsIjcxIiwiNzIiLCI3MyIsIjc0Il0sInJlYWQiOjgxODUsIndyaXRlIjo4MTg1LCJyb2xlX2lkIjoxMSwiYWxsb3dlZF9vcmdfaWRzIjpbXSwiaWF0IjoxNzA1MzAxNzIwLCJleHAiOjE3MDUzMDUzMjB9.tZ-JhHWKVJbDVXIWb8ilSiHE0bwZR7QF9X6ycVO3GAA'
		  ),

*/

$con = OpenCon();
$mac_id = $_POST['mac_id'];

$hooter_status = $_POST['current_status'];

//$mac_id = '30000104';
$ems_login_sql = mysqli_query($con,"select access_token,org_id,refresh_token from ems_login_access_panel_health where id=1");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];

//$url = 'http://103.141.218.138:4510/panel/esslist?org_id='.$org_id.'&group_id=0';

$url = 'http://103.141.218.138:4510/diagnostic/cmd_new';

//echo $access_token;die;

$command_type = 'Hooter';

if($hooter_status=='1'){
	$hooter_status = '0';
}else{
	$hooter_status = '1';
}

$response = setHooter($url,$access_token,$org_id,$mac_id,$hooter_status);
$check = json_decode($response,true);

if($check['statusCode']==401){
	$new_access_token = getLogin();
	if($new_access_token!=''){
		mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."',updated_at='".$created_at."' where id=1");
		$response = setHooter($url,$new_access_token,$org_id,$mac_id,$hooter_status);
        $check = json_decode($response,true);
		mysqli_query($con,"insert into hooter_siren_command_status (mac_id,current_status,command_type,created_at) values ('".$mac_id."','".$hooter_status."','".$command_type."','".$created_at."') ");
		$array = array(['Code'=>200,'res_data'=>$check]);
		CloseCon($con);
        echo json_encode($array);
	}else{
		
		$array = array(['Code'=>401]);
		CloseCon($con);
		echo json_encode($array);
	}
}else{
	mysqli_query($con,"insert into hooter_siren_command_status (mac_id,current_status,command_type,created_at) values ('".$mac_id."','".$hooter_status."','".$command_type."','".$created_at."') ");
	$array = array(['Code'=>200,'res_data'=>$check]);
	CloseCon($con);
    echo json_encode($array);
}




//echo $check;
//echo '<pre>';print_r($check);echo '</pre>';die;

   
?>





