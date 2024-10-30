<?php include('db_connection.php'); $con = OpenCon();

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

$client = $_POST['client'];
$userid = $_POST['user_id'];

    $usersql = mysqli_query($con,"select cust_id,bank_id,circle_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_bank_ids = $userdata['bank_id'];
    $banks = explode(",",$_bank_ids);
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
	
	$_circle_ids = $userdata['circle_id'];
	$_circle_name = "";
	$_circle_name_array = array();
	if($_circle_ids!=''){
		$assign_circle = explode(",",$_circle_ids);
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
		if(count($_circle_name_array)>0){
			$_circle_name_array1=json_encode($_circle_name_array);
			$_circle_name_array1=str_replace( array('[',']','"') , ''  , $_circle_name_array1);
			$circlearr_atm=explode(',',$_circle_name_array1);
			$_circle_name_array1 = "'" . implode ( "', '", $circlearr_atm )."'";
		}	
	}

    $bank = "";
    $atmid = "";
	$circle = "";
	if(isset($_POST['bank'])){
	   $bank = $_POST['bank'];
	}
	if(isset($_POST['circle'])){
	   $circle = $_POST['circle'];
	}
	if(isset($_POST['atmid'])){
	   $atmid = $_POST['atmid'];
	}

     /*
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
    */
   
if($atmid!=''){
        $sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."' and Bank='".$bank."' and live='Y'");
}else{
	if($bank!=''){
	    if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
				while($circlesql_result = mysqli_fetch_assoc($circlesql)){
					$circleatmidarray[] = $circlesql_result['ATMID'];
					
				}
				$circleatmidarray=json_encode($circleatmidarray);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
				if(count($_circle_name_array)>0){
					$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$_circle_name_array1.") and live='Y'");
				}else{
		           $sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
				}
			}  
    }else{
		$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
}
        $_data = []; $count = 0;
                        $i=1;
				if(mysqli_num_rows($sql)>0){
                      while($sql_result=mysqli_fetch_assoc($sql)) {
						$atm_id = $sql_result['ATMID'];
						$data_arr = [];
						$data_arr['sr_no'] = $i; 
						$data_arr['atmid'] = $sql_result['ATMID'];
						$data_arr['atmid2'] = $sql_result['ATMID_2'];
						$data_arr['atmid3'] = $sql_result['ATMID_3'];
						$data_arr['atmid4'] = $sql_result['ATMID_4'];
						$data_arr['trackerno'] = $sql_result['TrackerNo'];
						$data_arr['atmshortname'] = $sql_result['ATMShortName'];
						
						$data_arr['Phase'] = $sql_result['Phase'];
						$data_arr['Status'] = $sql_result['Status'];
						$data_arr['OldPanelID'] = $sql_result['OldPanelID'];
						$data_arr['NewPanelID'] = $sql_result['NewPanelID'];
						$data_arr['DVRIP'] = $sql_result['DVRIP'];
						$data_arr['PanelIP'] = $sql_result['PanelIP'];
						
						$data_arr['eng_name'] = $sql_result['eng_name'];
						$data_arr['Customer'] = $sql_result['Customer'];
						$data_arr['Bank'] = $sql_result['Bank'];
						$data_arr['SiteAddress'] = htmlspecialchars($sql_result['SiteAddress']);
						$data_arr['State'] = $sql_result['State'];
						$data_arr['City'] = $sql_result['City'];
						
						$data_arr['Zone'] = $sql_result['Zone'];
						$data_arr['live'] = $sql_result['live'];
						$data_arr['live_date'] = $sql_result['live_date'];
						$data_arr['UserName'] = $sql_result['UserName'];
						$data_arr['Password'] = $sql_result['Password'];
						$count++;
						$key_status = 0;
						if($count%10==0){
							$key_status = 1;
						}
						$data_arr['key_status'] = $key_status;
						array_push($_data,$data_arr);
						$i++;
					  }
					  $code = 200;
				}else{
					$code = 201;
				}
            if($code==200){         
                 $array = array(['code'=>$code,'count'=>$count,'res_data'=>$_data]);
			}else{
			   $array = array(['code'=>$code]);	
			}

CloseCon($con);
echo json_encode(utf8ize($array));
//echo json_encode($array);

 ?>
                            