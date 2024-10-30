<?php include('db_connection.php'); ?>
<?php 

function getsitedetail($paramater,$atmid,$con){
	//global $con;

	$sql = mysqli_query($con,"select $paramater from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
$client = $_POST['client'];
$userid = $_POST['user_id'];
$con = OpenCon();
$usersql = mysqli_query($con,"select cust_id,bank_id from loginusers where id='".$userid."'");
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

$bank = "";
$atmid = "";
if(isset($_POST['bank'])){
    $bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
    $atmid = $_POST['atmid'];
}
$start = $_POST['start'];
$end = $_POST['end'];
$portal = $_POST['portal'];
$con = OpenCon();


if($atmid!=''){
	$sitesql = mysqli_query($con,"select ATMID from sites where atmid='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
	  $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	
}

    $atmidarray = [];
	if(mysqli_num_rows($sitesql)>0){
		while($sitesql_result = mysqli_fetch_assoc($sitesql)){
			$atmidarray[] = $sitesql_result['ATMID'];
			
		}
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	


if($portal=="all"){
$sql = mysqli_query($con,"select * from ticket_raise where atmid IN (".$atmidarray.") AND CAST(created_date AS DATE)>='".$start."' 
                          AND CAST(created_date AS DATE)<='".$end."' ORDER BY id DESC"); 
}else{
	$sql = mysqli_query($con,"select * from ticket_raise where atmid IN (".$atmidarray.") AND ticket_status='".$portal."' AND CAST(created_date AS DATE)>='".$start."' 
                          AND CAST(created_date AS DATE)<='".$end."' ORDER BY id DESC"); 
}

//echo json_encode($sql_result);
?>

					    <?php  
                        $res_data = [];
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ 
							    
								$_status = 'Closed';
								if($sql_result['ticket_status']=='1'){
									$_status = 'Pending';
								}
								/*
								$sitesql = mysqli_query($con,"select SiteAddress,DVRIP from sites where ATMID='".$atmid."'");
								$siteaddress = "";$dvrip = "";
								if(mysqli_num_rows($sitesql)>0){
	                            $site_sql_result = mysqli_fetch_assoc($sitesql);
								$siteaddress = $site_sql_result['SiteAddress'];
								$dvrip = $site_sql_result['DVRIP'];
								}
								*/
								$_newarr = array();
								
								$_newarr['ticketid'] = $sql_result['ticket_id'];
								$_newarr['alarm_type'] = $sql_result['alarm_type'];
								$_newarr['atmid'] = $sql_result['atmid'];
								$_newarr['location'] = $sql_result['location'];
								$_newarr['alerttype'] = $sql_result['alert_type'];
								$_newarr['created_time'] = $sql_result['created_date'];
								$_newarr['close_date'] = $sql_result['close_date'];
								$_newarr['status'] = $_status;
								$_newarr['remarks'] = $sql_result['remarks'];
								array_push($res_data,$_newarr);
							  ?>
							  
						<?php }
						  }
						?>
                      

<?php 


if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data]);
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode($array);
?>
