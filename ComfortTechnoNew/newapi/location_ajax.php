<?php include('db_connection.php'); ?>
<?php 
$client = $_POST['client'];
$bank = $_POST['bank'];
$atmid = $_POST['atmid'];
$con = OpenCon();
$sql = mysqli_query($con,"select ATMShortName from sites where Customer='".$client."' and ATMID='".$atmid."' and Bank='".$bank."' and live='Y'");
$sql_result = mysqli_fetch_assoc($sql);
$atmshortname = $sql_result['ATMShortName'];
$data = array();
$latlongsql = mysqli_query($con,"select latitude,longitude from location_latlong where atmid='".$atmid."'");
if(mysqli_num_rows($latlongsql)>0){
$latlongsql_result = mysqli_fetch_assoc($latlongsql);
$code = 200;
$latitude = $latlongsql_result['latitude'];
$longitude = $latlongsql_result['longitude'];
$data['latitude'] = $latitude;
$data['longitude'] = $longitude;
$data['atmid'] = $atmid;
$data['atmshortname'] = $atmshortname;
$map_loc = 'https://maps.google.com/maps?q='.$latitude.','.$longitude.'&z=15';
$data['map_url'] = $map_loc;
}else{
	
	$code = 201;
}
CloseCon($con);
echo json_encode(["res"=>$data,"code"=>$code]);
?>


