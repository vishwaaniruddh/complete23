<?php session_start();
include 'config.php';
error_reporting(0);

if(1==1){
    


$sql = mysqli_query($conn,"select max(id), ip,status,cam1,cam2,cam3,cam4,hdd,latency,cdate,login_status,last_communication,atmid,capacity,freespace,recording_from,recording_to from dvr_history
group by atmid limit 0,10");

$sql_result = mysqli_fetch_assoc($sql);




?>

<table border="1">
 <thead>
    <tr >
        <td>SN</td>
        <td ><div >ATM-ID</div></td>
        <td ><div id="">Last Communication</div></td>
        <td ><div id="">Latest Date_Time &nbsp; </div></td>
        <td ><div id="">Down Since</div></td>
        <td><div id="">IP Address</div></td>
        <td><div id="">NetworkStatus</div></td>
        <td><div id="">DVR Type</div></td>
        <td><div id="">DVRLogin</div></td>
        <td><div id="">Camera1</div></td>
        <td><div id="">Camera2</div></td>

        <td><div id="">Camera3</div></td>
        <td><div id="">Camera4</div></td>
        <td><div id="">HDD_status</div></td>
        <td><div id="">Recording_from</div></td>
		<td><div id="">Recording_to</div></td>
        <td><div id="">HDD_capacity</div></td>
        <td><div id="">HDD_freespace</div></td>
        <td><div id="">Latency</div></td>

        <td ><div >Bank</div></td>
        <td ><div >Customer</div></td>
        <td ><div >Zone</div></td>
        <td ><div >BM</div></td>
        <td ><div >City</div></td>
        <td ><div >State</div></td>
        <td><div  id="">site Address</div></td>
    </tr>
 </thead>

       <tbody>
                 
  <?php  $today=date('Y-m-d'); 
  $sr=1;
  while($row = mysqli_fetch_array($sql)) { 

$StateQry= mysqli_query($conn,"select State,PanelIP,City,SiteAddress,Bank,Customer,Zone from sites where ATMID='".$row['atmid']."'");
$fetchState=mysqli_fetch_array($StateQry);

if($row['login_status']=='1' && $row['status']=='1'){
	$dvr_his = "select id from dvr_history where CAST(last_communication AS DATE)='".$today."' AND login_status='0' AND atmid ='".$row['atmid']."'";
    $qrydvrhis=mysqli_query($conn,$dvr_his);
	if(mysqli_num_rows($qrydvrhis)>0){
		$dvrlogin_text = 'yes';
	}else{
		$dvrlogin_text = 'No';
	}
}else{
	$dvrlogin_text = 'yes';
}

$BMnameQry= mysqli_query($conn,"select CSSBM from esurvsites where ATM_ID='".$row['atmid']."' ");
$fetchBM=mysqli_fetch_array($BMnameQry);

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
$SN =$row['SN'];$ATMID = $row['atmid'];
?>
  <tr <?php if($row[2]==0 || $row[10]==1){ ?>style="background-color:#FF0000" <?php } ?> >
       <td><?php echo $sr;?></td>
       <td><?php echo $row[12];?></td>
        
       <td ><?php echo $row[9];?></td>
       <td align="center"><div id=""><?php echo $row[11]; ?></div></td>
       <td align="center"><div id=""><?php echo $datedif_cnt ; ?></div></td>
       <td align="center"><div id=""><?php echo $row[1]; ?></div></td>
       <td align="center"><div id=""><?php if($row[2]==1)echo 'good'; else echo 'bad'; ?></div></td>
       <td align="center"><div id=""><?php echo $row[17]; ?></div></td>
       <td align="center"><div id=""><?php echo $dvrlogin_text; ?></div></td>
       <td align="center"><div id=""><?php echo $row[3]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[4]; ?></div></td>

       <td align="center"><div id=""><?php echo $row[5]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[6]; ?></div></td>

       <td align="center"><div id=""><?php echo $row[7]; ?><?php if($row[7] != 'OK' && $row[7]!='ok'){ ?><a this data-toggle="modal" data-status="" data-id="<?php echo $ATMID; ?>" class="open-DetailDialog_2 btn btn-danger" href="#myModalDetail_2">Details</a><?php }?></div></td>
       <td align="center"><div id=""><?php echo $row[15]; ?></div></td>
	   <td align="center"><div id=""><?php echo $row[16]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[13]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[14]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[8]; ?></div></td>
      <!-- <td align="center"><div id=""><?php if($num>0){ echo "Not Working"; }  ?></div></td>-->
       <td><?php echo $fetchState['Bank'];?></td>
       <td><?php echo $fetchState['Customer'];?></td>
        <td><?php echo $fetchState['Zone'];?></td>
        <td><?php echo $fetchBM['CSSBM'];?></td>
       <td ><?php echo $fetchState['City'];?></td>
       <td ><?php echo $fetchState['State'];?></td>
       
       <td ><?php echo $fetchState['SiteAddress'];?></td> 
    </tr>
   <?php
$sr++;
 
}
?>
  </tbody>



<?php
}else
{ 
 header("location: index.php");
}
?>






