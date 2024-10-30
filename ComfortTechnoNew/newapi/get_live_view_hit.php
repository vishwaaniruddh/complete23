<?php include('db_connection.php'); 
 date_default_timezone_set('Asia/Kolkata');
 
	function getDevice($url){
					
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
			  
			));

			$response = curl_exec($curl);
			
			if(curl_error($curl)) {  
				print_r( curl_error($curl));  
			}  

			curl_close($curl);
			return $response;
	}

$url = $_POST['new_url'];
/*	
$response = getDevice($url);
$check = json_decode($response,true);
echo $check;
 */
 $iframe_src = "<iframe src='".$url."' title='description' style='height: 33vh;width: 100%' scrolling='no'></iframe>";
 $array = array(['code'=>200,'iframe_src'=>$iframe_src]);
 echo json_encode($array);
?>






