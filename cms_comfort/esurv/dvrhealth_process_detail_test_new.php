<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';
error_reporting(0);

ini_set('max_execution_time', '0');

$Atmid=$_POST['Atmid'];

$strPage=$_POST['Page'];
$per_Page=$_POST['perpg'];
function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}

            if($from!="")
            {
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt="";
            }
                if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=""; 
                }

 $sr=1;

$abc_count="select count(*) from all_dvr_live where  live='y'";
$abc="select * from all_dvr_live where  live='y'";


if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){
    
    $Id=$_SESSION['permission'];
    $perm=array();
    
    $IDsplit=explode(',',$Id);
    
    
    foreach($IDsplit as  $element){
        $perm[]=$element;
    }
    $per= "'".implode("','",$perm)."'";
    
   $abc_count.=" and atmid IN (select ATMID from sites where CTS_LocalBranch IN($per) and live='Y')";
   $abc.=" and atmid IN (select ATMID from sites where CTS_LocalBranch IN($per) and live='Y')";
}
if($_SESSION['designation']=="4"){
    
   $abc_count.=" and atmid IN (select ATMID from sites where Customer='Hitachi' and live='Y')";
   $abc.=" and atmid IN (select ATMID from sites where Customer='Hitachi' and live='Y')";
}




    $result=mysqli_query($conn,$abc_count);
    
     $Num_Rows=mysqli_fetch_row($result)[0];
  
    //$Per_Page =$_POST['perpg'];   // Records Per Page
$Per_Page =$Num_Rows;
$Page = $strPage;

if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
if($Per_Page!="all")
// $abc.=" LIMIT $Page_Start , $Per_Page";


// echo $abc ; 
	
$qrys=mysqli_query($conn,$abc);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	   $sr=($Per_Page* ($Page-1))+1;
	   
	}

?>

 <!-- <table id="datatable-buttons"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> -->
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
		<?php if($_SESSION['designation']!="4"){ ?>
        <td><div id="">Camera3</div></td>
        <td><div id="">Camera4</div></td>
		<?php }?>
        <td><div id="">HDD_status</div></td>
        <td><div id="">Recording_from</div></td>
		<td><div id="">Recording_to</div></td>
        <td><div id="">HDD_capacity</div></td>
        <td><div id="">HDD_freespace</div></td>
        <td><div id="">Latency</div></td>
        <!--<td><div  id="">DVR Not Login</div></td>-->
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
  while($row = mysqli_fetch_array($qrys)) {  
    $ATMID = $row['atmid'];
    $StateQry= mysqli_query($conn,"select State,PanelIP,City,SiteAddress,Bank,Customer,Zone from sites where ATMID='".$row['atmid']."'");
    $fetchState=mysqli_fetch_array($StateQry);
    // echo '<pre>';print_r($fetchState);echo '</pre>';

    if($row['login_status']=='1' && $row['status']=='1'){
        $dvrlogin_text = 'No';
    }else{
        $dvrlogin_text = 'yes';
    }

    ?>
  <tr <?php if($row[2]==0 || $row[10]==1){ ?>style="background-color:#FF0000" <?php } ?> >
  <td><?php echo $sr;?></td>
  <td><?php echo $row['atmid'];?></td>
  <td><?php echo $row['last_communication'];?></td>
  <td><?php echo $row['cdate'];?></td>
  <td></td>
  <td><?php echo $row['IPAddress'];?></td>
  <td align="center"><div id=""><?php if($row['status']==1)echo 'good'; else echo 'bad'; ?><?php if($row['status']!=1){ ?><a this data-toggle="modal" data-status="" data-id="<?php echo $row['SN']; ?>" class="open-DetailDialog btn btn-danger" href="#myModalDetail">Details</a><?php }?></div></td>
  <td align="center"><div id=""><?php echo $row['ipcamtype']; ?></div></td>
  <td align="center"><div id=""><?php echo $dvrlogin_text; ?><?php if($dvrlogin_text == 'No'){ ?><a this data-toggle="modal" data-status="" data-id="<?php echo $ATMID; ?>" class="open-DetailDialog_1 btn btn-danger" href="#myModalDetail_1">Details</a><?php }?></div></td>
  <td align="center"><div id="Camera1">
        
<?php 
  echo $row['cam1'];
 ?>
</div>
</td>
<td align="center"><div>
        
        <?php 
          echo $row['cam2'];
         ?>
        </div>
        <?php if($_SESSION['designation']!="4"){ ?>
       <td align="center"><div id=""><?php echo $row['cam3']; ?></div></td>
       <td align="center"><div id=""><?php echo $row['cam4']; ?></div></td>
	   <?php }?>
       <td align="center"><div id=""><?php echo $row['hdd']; ?><?php if($row['hdd'] != 'OK' && $row['hdd']!='ok'){ ?><a this data-toggle="modal" data-status="" data-id="<?php echo $ATMID; ?>" class="open-DetailDialog_2 btn btn-danger" href="#myModalDetail_2">Details</a><?php }?></div></td>
       <td align="center"><div id=""><?php echo $row['recording_from']; ?></div></td>
	   <td align="center"><div id=""><?php echo $row['recording_to']; ?></div></td>
       <td align="center"><div id=""><?php echo $row['capacity']; ?></div></td>
       <td align="center"><div id=""><?php echo $row['freespace']; ?></div></td>
       <td align="center"><div id=""><?php echo $row['latency']; ?></div></td>
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






