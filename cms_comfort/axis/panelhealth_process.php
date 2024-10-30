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
else*/ if($Atmid!=""){
    $abc_count="select count(*) from panel_health where atmid='".$Atmid."'";
    $abc="select * from panel_health where atmid='".$Atmid."' ";
}
else
{
$abc_count="select count(*) from panel_health";
$abc="select * from panel_health";
}
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
      <td ><div >State&nbsp; </div></td>
      <td ><div >City&nbsp; </div></td>
        <td ><div >Bank&nbsp; </div></td>
      <td ><div >PanelIP&nbsp; </div></td>
      <td ><div >Date_Time&nbsp; </div></td>
        <td ><div style="" id="">LobbyPIR Motion Sensor</div></td>
        <td><div style="" id="">Glass Break Sensor</div></td>
        <td><div style="" id="">Panic Switch</div></td>
        <td><div style="" id="">MainDoor shuttNormal NO type</div></td>
        
        <td><div id="">ATM1 Removal</div></td>
        <td><div id="">ATM 1 Vibration</div></td>
        <!--<td><div style="" id="">ATM2 Removal</div></td>
        <td><div id="">ATM 2 Vibration</div></td>
        <td><div id="">ATM 3 Removal</div></td>
        <td><div id="">ATM 3 Vibration</div></td>-->
        <td><div id="">SmokeDetector 12V IN +</div></td>
        <td><div id="">Videoloss/Video Temper/HDD alarm</div></td>
        <td><div style="" id="">ATM 1 Thermal/Heat</div></td>
        <td><div style="" id="">ATM 2 Thermal/Heat</div></td>
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
       
       <!-- <td><div style="display:none" id="">fake value</div></td>-->
      
        <td><div style="" id="">AC Mains Fail DI</div></td>
        <td><div id="">UPS O/P FailDI</div></td>
        
    <!--<td><div style="display:none" id="">fake value<br/><div class="" id="031"><a onclick="">Zone-031</a></div> </div></td>
        <td><div style="display:none" id="">fake value<br/><div class="" id="032"><a onclick="">Zone-032</a></div> </div></td>
        <td><div style="display:none" id="">fake value<br/><div class="" id="033"><a onclick="">Zone-033</a></div> </div></td>-->
        
        
        
       <td><div style="" id="">Panel Tamper Switch</div></td>
       
       
       
        <td><div style="" id="">Low Battery</div></td>
        <td><div style="" id="">No battery</div></td>
        <td><div id="">Fire TroubleSmoke sense</div></td>
<td><div id="">CURRENT STATUS</div></td>
<td ><div >SiteAddress&nbsp; </div></td>
  </tr>
 </thead>

       <tbody>
                 
  <?php  while($row = mysqli_fetch_array($qrys)) { 

$StateQry= mysqli_query($conn,"select State,PanelIP,City,SiteAddress,Bank from sites where ATMID='".$row[68]."'");

$fetchState=mysqli_fetch_array($StateQry);
?>
 <tr <?php if($row[67]==1){ ?>style="background-color:#FF0000" <?php } ?> >
    <td><?php echo $sr;?></td>
    <td><?php  echo $row[68]; ?></td>
    <td><?php echo $fetchState['State'];?></td>
     <td><?php echo $fetchState['City'];?></td>
     <td><?php echo $fetchState['Bank'];?></td>
     
    <td><?php echo $fetchState['PanelIP'];?></td>
    <td ><?php echo $row[0];?></td>
    <td align="center"><div id=""><?php if($row[4]==0){echo "Normal";}else if($row[4]==1){echo "Alert";}else if($row[4]==2){echo "Disconnect";}else if($row[4]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[5]==0){echo "Normal";}else if($row[5]==1){echo "Alert";}else if($row[5]==2){echo "Disconnect";}else if($row[5]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[6]==0){echo "Normal";}else if($row[6]==1){echo "Alert";}else if($row[6]==2){echo "Disconnect";}else if($row[6]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[7]==0){echo "Normal";}else if($row[7]==1){echo "Alert";}else if($row[7]==2){echo "Disconnect";}else if($row[7]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[8]==0){echo "Normal";}else if($row[8]==1){echo "Alert";}else if($row[8]==2){echo "Disconnect";}else if($row[8]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[9]==0){echo "Normal";}else if($row[9]==1){echo "Alert";}else if($row[9]==2){echo "Disconnect";}else if($row[9]==9){echo "By Passed";} ?></div></td>
        <!--<td align="center"><div id=""><?php if($row[10]==0){echo "Normal";}else if($row[10]==1){echo "Alert";}else if($row[10]==2){echo "Disconnect";}else if($row[10]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[11]==0){echo "Normal";}else if($row[11]==1){echo "Alert";}else if($row[11]==2){echo "Disconnect";}else if($row[11]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[12]==0){echo "Normal";}else if($row[12]==1){echo "Alert";}else if($row[12]==2){echo "Disconnect";}else if($row[12]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[13]==0){echo "Normal";}else if($row[13]==1){echo "Alert";}else if($row[13]==2){echo "Disconnect";}else if($row[13]==9){echo "By Passed";} ?></div></td>
       --> <td align="center"><div id=""><?php if($row[14]==0){echo "Normal";}else if($row[14]==1){echo "Alert";}else if($row[14]==2){echo "Disconnect";}else if($row[14]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[15]==0){echo "Normal";}else if($row[15]==1){echo "Alert";}else if($row[15]==2){echo "Disconnect";}else if($row[15]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[16]==0){echo "Normal";}else if($row[16]==1){echo "Alert";}else if($row[16]==2){echo "Disconnect";}else if($row[16]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[17]==0){echo "Normal";}else if($row[17]==1){echo "Alert";}else if($row[17]==2){echo "Disconnect";}else if($row[17]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[18]==0){echo "Normal";}else if($row[18]==1){echo "Alert";}else if($row[18]==2){echo "Disconnect";}else if($row[18]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[19]==0){echo "Normal";}else if($row[19]==1){echo "Alert";}else if($row[19]==2){echo "Disconnect";}else if($row[19]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[20]==0){echo "Normal";}else if($row[20]==1){echo "Alert";}else if($row[20]==2){echo "Disconnect";}else if($row[20]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[21]==0){echo "Normal";}else if($row[21]==1){echo "Alert";}else if($row[21]==2){echo "Disconnect";}else if($row[21]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[22]==0){echo "Normal";}else if($row[22]==1){echo "Alert";}else if($row[22]==2){echo "Disconnect";}else if($row[22]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[23]==0){echo "Normal";}else if($row[23]==1){echo "Alert";}else if($row[23]==2){echo "Disconnect";}else if($row[23]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[24]==0){echo "Normal";}else if($row[24]==1){echo "Alert";}else if($row[24]==2){echo "Disconnect";}else if($row[24]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[25]==0){echo "Normal";}else if($row[25]==1){echo "Alert";}else if($row[25]==2){echo "Disconnect";}else if($row[24]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[26]==0){echo "Normal";}else if($row[26]==1){echo "Alert";}else if($row[26]==2){echo "Disconnect";}else if($row[26]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[27]==0){echo "Normal";}else if($row[27]==1){echo "Alert";}else if($row[27]==2){echo "Disconnect";}else if($row[27]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[28]==0){echo "Normal";}else if($row[28]==1){echo "Alert";}else if($row[28]==2){echo "Disconnect";}else if($row[28]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[29]==0){echo "Normal";}else if($row[29]==1){echo "Alert";}else if($row[29]==2){echo "Disconnect";}else if($row[29]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[30]==0){echo "Normal";}else if($row[30]==1){echo "Alert";}else if($row[30]==2){echo "Disconnect";}else if($row[30]==9){echo "By Passed";} ?></div></td>
    <!--<td align="center"><div id=""><?php if($row[31]==0){echo "Normal";}else if($row[31]==1){echo "Alert";}else if($row[31]==2){echo "Disconnect";}else if($row[31]==9){echo "By Passed";} ?></div></td>-->
        <td align="center"><div id=""><?php if($row[32]==0){echo "Normal";}else if($row[32]==1){echo "Alert";}else if($row[32]==2){echo "Disconnect";}else if($row[32]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[33]==0){echo "Normal";}else if($row[33]==1){echo "Alert";}else if($row[33]==2){echo "Disconnect";}else if($row[33]==9){echo "By Passed";} ?></div></td>
    <!--<td align="center"><div id=""><?php if($row[34]==0){echo "Normal";}else if($row[34]==1){echo "Alert";}else if($row[34]==2){echo "Disconnect";}else if($row[34]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[35]==0){echo "Normal";}else if($row[35]==1){echo "Alert";}else if($row[35]==2){echo "Disconnect";}else if($row[35]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[36]==0){echo "Normal";}else if($row[36]==1){echo "Alert";}else if($row[36]==2){echo "Disconnect";}else if($row[36]==9){echo "By Passed";} ?></div></td>-->
        <td align="center"><div id=""><?php if($row[37]==0){echo "Normal";}else if($row[37]==1){echo "Alert";}else if($row[37]==2){echo "Disconnect";}else if($row[37]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[64]==0){echo "Normal";}else if($row[64]==1){echo "Alert";}else if($row[64]==2){echo "Disconnect";}else if($row[64]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[65]==0){echo "Normal";}else if($row[65]==1){echo "Alert";}else if($row[65]==2){echo "Disconnect";}else if($row[65]==9){echo "By Passed";}?></div></td>
        <td align="center"><div id=""><?php if($row[66]==0){echo "Normal";}else if($row[66]==1){echo "Alert";}else if($row[66]==2){echo "Disconnect";}else if($row[66]==9){echo "By Passed";} ?></div></td>
        <td align="center"><div id=""><?php if($row[67]==0){echo "Normal";}else if($row[67]==1){echo "Alert";}else if($row[67]==2){echo "Disconnect";}else if($row[67]==9){echo "By Passed";} ?></div></td>
    <td><?php echo $fetchState['SiteAddress'];?></td>
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






