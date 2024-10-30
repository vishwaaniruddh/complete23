<?php include 'config.php';
$abc="select * from dvr_health where  live='y'";

$qrys=mysqli_query($conn,$abc);
 while($row = mysqli_fetch_array($qrys)) { 
  
if($row[11]!="0000-00-00 00:00:00" && $row[11]!=''){
	if(is_null($row[11])){
		$datedif_cnt="NA";
	}else{
    $currdat=date("Y-m-d");
$date1=date_create($currdat);
$date2=date_create($row[11]);
$diff=date_diff($date1,$date2);
$datedif_cnt=$diff->format("%a days");
	}

}else{$datedif_cnt="NA";}
echo $datedif_cnt;die;
 }
