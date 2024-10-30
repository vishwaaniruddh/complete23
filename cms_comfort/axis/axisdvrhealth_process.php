<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';
error_reporting(0);

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
            //$newDate = date_format($date,"y/m/d H:i:s");
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
  /*
if($state!=''){
$abc_count="select count(*) from panel_health b,sites a WHERE a.atmid=b.atmid and a.state like '%".$state."%'";
$abc="select * from panel_health b,sites a WHERE a.atmid=b.atmid and a.state like '%".$state."%'";
}
else if($Atmid!=""){
    $abc_count="select count(*) from panel_health where atmid='".$Atmid."'";
    $abc="select * from panel_health where atmid='".$Atmid."' ";
}
else
{*/
$abc_count="select count(*) from axisdvr_health where dvrtype='Hikvision' and live='y'";
$abc="select * from axisdvr_health where dvrtype='Hikvision' and live='y'";
//}
//$result=mysqli_query($conn,$abc);

?>
<?php
/*if($panelid!=""){
$abc.=" and b.panelid='".$panelid."'";
}

if($ATMID!=""){
$abc.=" and a.ATMID='".$ATMID."'";
}

if($DVRIP!=""){
$abc.=" and a.DVRIP='".$DVRIP."'";
}


if($SensorDDL!=""){
$abc.=" and b.zone='".$SensorDDL."'";
}


if($compy!=""){
$abc.=" and a.Customer='".$compy."'";
}


if($fromdt!="" && $todt!==""){
$abc.=" and b.alarm!='BR'  and b.createtime between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by createtime desc;";
//echo $abc;
}
else if($fromdt!="")
{
    $abc.=" and b.createtime='".$fromdt."'";
}
else if($todt!="")
{
$abc.=" and createtime='".$todt."'";
}
else
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$abc.=" and b.createtime between '".$fromdt."' and '".$todt."'";
//echo $abc;
}
*/

//echo $abc;
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
$abc.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$abc);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	 //   echo $Page_Start."-".$Page."-".$Page_Start;
	   $sr=($Per_Page* ($Page-1))+1;
	   
	   //$sr=$sr+1;
	}

?>

<!--<html>

<div align="center">total records:<?php echo $Num_Rows?>&nbsp;&nbsp;&nbsp;&nbsp;per page:<select id="pp" name="pp" onchange="a('',this.value)" >
                                                                                         <option value="50" <?php if($Per_Page=="50"){ ?> selected="selected" <?php } ?> >50</option>
                                                                                         <option value="100" <?php if($Per_Page=="100"){ ?> selected="selected" <?php } ?> >100</option>
                                                                                         <option value="150" <?php if($Per_Page=="150"){ ?> selected="selected" <?php } ?> >150</option>
                                                                                         <option value="200" <?php if($Per_Page=="200"){ ?> selected="selected" <?php } ?> >200</option>
                                                                                         <option value="250" <?php if($Per_Page=="250"){ ?> selected="selected" <?php } ?> >250</option>
                                                                                         <option value="300" <?php if($Per_Page=="300"){ ?> selected="selected" <?php } ?> >300</option>
                                                                                         <option value="all" <?php if($Per_Page=="all"){ ?> selected="selected" <?php } ?> >All</option>
                                                                                         </select></div>

<input type="hidden" name="expqry" id="expqry" value="<?php echo $abc;?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>

<center>-->
 <?php 
 /*
if($Prev_Page) 
{
	echo "<a href=\"JavaScript:a('$Prev_Page','$Per_Page')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"JavaScript:a('$Next_Page','$Per_Page')\">Next >></a> ";
}
*/
?>
</center>

  <table id="datatable-buttons"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
 <thead>
    <tr >
  <td>SN</td>
      <td ><div >ATM-ID</div></td>
      <td ><div >Date_Time&nbsp; </div></td>
      <td ><div >Bank&nbsp; </div></td>
     <!-- <td ><div >Down Since</div></td>-->
        <td ><div style="" id="">Last Communication</div></td>
        <td><div style="" id="">IP Address</div></td>
        <td><div style="" id="">DVR Type</div></td>
        <td><div style="" id="">NetworkStatus</div></td>
        
        <td><div id="">Latency</div></td>
        <td><div id="">DVRLogin</div></td>
        <td><div style="" id="">HDD_status</div></td>
        <td><div id="">HDD_capacity</div></td>
        <td><div id="">HDD_freespace</div></td>
        <td><div id="">Recording_from</div></td>
        <td><div id="">Camera1</div></td>
        <td><div id="">Camera2</div></td>
        <td><div style="" id="">Camera3</div></td>
        <td><div style="" id="">Camera4</div></td>
    <!-- <td><div style="" id="">ATM 2 Thermal/Heat</div></td>
        <td><div id="">ChestDoor Open ATM1</div></td>
        <td><div style="" id="">ChestDoor Open ATM2</div></td>
        <td><div style="" id="">ChestDoor Open ATM3</div></td>
        <td><div style="" id="">AC /UPS removal</div></td>
      
        <td><div style="" id="">Cheque dropbox removal</div></td>
        <td><div id="">Chequedrop box open</div></td>
        <td><div style="" id="">CCTV 1+2+3 Removal</div></td>
        <td><div id="">ATM 3 Thermal/ Heat</div></td>
        <td><div style="" id="">Backroom Door Open</div></td>
        <td><div id="">Lobby Temprature SensorHigh</div></td>
        <td><div id="">ATM 1/2 HoodDoor Sensor</div></td>
        <td><div style=""  id="">LobbyTemprature Sensor Low</div></td>
        <td><div id="">Silence Key</div></td>
      
        <td><div style="" id="">AC Mains Fail DI</div></td>
        <td><div id="">UPS O/P FailDI</div></td>
        
       <td><div style="" id="">Panel Tamper Switch</div></td>
       
       
       
        <td><div style="" id="">Low Battery</div></td>
        <td><div style="" id="">No battery</div></td>
        <td><div id="">Fire TroubleSmoke sense</div></td>
<td><div id="">CURRENT STATUS</div></td>-->
  </tr>
 </thead>

       <tbody>
                 
  <?php  while($row = mysqli_fetch_array($qrys)) { 

$StateQry= mysqli_query($conn,"select State,PanelIP,Bank from axissite where atmid='".$row[12]."'");
$fetchState=mysqli_fetch_array($StateQry);


if($row[11]!="0000-00-00 00:00:00"){
  //  date_default_timezone_set('Asia/Kolkata');
    $currdat=date("Y-m-d");
   
    
$date1=date_create($currdat);
$date2=date_create($row[11]);
$diff=date_diff($date1,$date2);
$datedif_cnt=$diff->format("%a days");

}else{$datedif_cnt="NA";}

?>
  <tr <?php if($row[2]==0 || $row[10]==1){ ?>style="background-color:#FF0000" <?php } ?> >
    <td><?php echo $sr;?></td>
    <td><?php echo $row[12];?></td>
    <td ><?php echo $row[9];?></td>
        <td ><?php echo $fetchState['Bank'];?></td>
         <!-- <td align="center"><div id=""><?php echo $datedif_cnt ; ?></div></td>-->
    <td align="center"><div id=""><?php echo $row[11]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[1]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[17]; ?></div></td>
        <td align="center"><div id=""><?php if($row[2]==1)echo 'good'; else echo 'bad'; ?></div></td>
        <td align="center"><div id=""><?php echo $row[8]; ?></div></td>
        <td align="center"><div id=""><?php if($row[2]==1 && $row[10]==0)echo 'yes'; else echo 'No'; ?></div></td>
        <td align="center"><div id=""><?php echo $row[7]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[13]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[14]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[15]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[3]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[4]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[5]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[6]; ?></div></td>
     <!--    
        <td align="center"><div id=""><?php echo $row[17]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[18]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[19]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[20]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[21]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[22]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[23]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[24]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[25]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[26]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[27]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[28]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[29]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[30]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[32]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[33]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[37]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[64]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[65]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[66]; ?></div></td>
        <td align="center"><div id=""><?php echo $row[67]; ?></div></td>-->
    </tr>
   <?php
$sr++;
  ?>
<?php 
}
?>
  </tbody>
</table>

 </form>
 
 
       

 
<center>
 <?php 
/* 
if($Prev_Page) 
{
	echo "<a href=\"JavaScript:a('$Prev_Page','$Per_Page')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"JavaScript:a('$Next_Page','$Per_Page')\">Next >></a> ";
}
*/
?>
</center>
	</div >

</body>
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>






