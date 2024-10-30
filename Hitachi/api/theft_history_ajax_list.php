<?php include('db_connection.php'); ?>
<?php 
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
	
	$status = "all";
//$status = $_POST['Status'];
$con = OpenCon();
//$status = "all";

if($atmid!=''){
	if($status=='all'){
$sql = mysqli_query($con,"select * from theft_ticket_raise where atmid='".$atmid."' order by id desc"); 		
	}else{
//$sql = mysqli_query($con,"select * from footage_request where atmid='".$atmid."' and status='".$status."' order by id desc"); 
	}

}else{
	if($bank!=''){
	  $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	if($status=='all'){
		$onlinetestsql = "SELECT * FROM theft_ticket_raise WHERE atmid IN (".$atmidarray.") order by id desc";
	}else{
	  //  $onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") and status='".$status."' order by id desc";
	}
    $sql = mysqli_query($con,$onlinetestsql);
}

?>


					    <?php $res_data = [];
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){
                                $_status = $sql_result['status'];
								$_id = $sql_result['id'];
								$_pdf = "";
								if($sql_result['file']!=""){
									$_pdf = "http://103.141.218.26:8080/ComfortTechnoNew/".$sql_result['file'];
								}
								
								
								$_newarr = array();
								$_newarr['atmid'] = $sql_result['atmid'];
								$_newarr['incident'] = $sql_result['incident'];
								$_newarr['file'] = $_pdf;
								$_newarr['remarks'] = $sql_result['remarks'];
								
								array_push($res_data,$_newarr);
                        ?>
							  
								
						<?php }
						  }
						?>
                     

<?php
$theft_count = count($res_data);
if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data,'theft_count'=>$theft_count]);
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode($array);
?>

