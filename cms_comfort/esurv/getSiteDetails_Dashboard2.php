<?php
include ('config.php');
$currentmonth=date('M');
//$last9Month=date("M",strtotime("-8 month"));
$LMonth=date("M",strtotime("-8 month"));
$fdate3=date('Y-'.$LMonth.'-01');
   $fdate2=date('Y-m-01');
   $toDate2=date('Y-m-t');

$data=array();

$data2=array();

      $sql2="SELECT count(*) FROM sites where current_dt between  '".$fdate2.' 00:00:00'."' and '".$toDate2.' 23:59:59'."' and live='Y'";
      $result2=mysqli_query($conn,$sql2);
      $row2=mysqli_fetch_array($result2);
      
      $sql3="SELECT count(*) FROM sites where live='Y'";
      $result3=mysqli_query($conn,$sql3);
      $row3=mysqli_fetch_array($result3);
     
     

     // $sqlpending2="SELECT count(*) FROM sites where current_dt between  '".$fdate2.' 00:00:00'."' and '".$toDate2.' 23:59:59'."' and live='P'";
       $sqlpending2="SELECT count(*) FROM sites where date(current_dt) <= '".$toDate2."' and live='P' ";
      
      $resultPending2=mysqli_query($conn,$sqlpending2);
      $fetchPending2=mysqli_fetch_array($resultPending2);
      
     
      
      
      $sqlDismental2=" SELECT DISTINCT ATMID FROM `sites_log` WHERE `live` = 'N' AND `current_dt` BETWEEN '".$fdate2.' 00:00:00'."' AND '".$toDate2.' 23:59:59'."' ORDER BY id DESC ";
      $resultDismental2=mysqli_query($conn,$sqlDismental2);
      $numrow=mysqli_num_rows($resultDismental2);
      $fetchDismental2=mysqli_fetch_array($resultDismental2);
      
      $sqlTotal2="SELECT count(*) FROM sites where date(current_dt) <= '".$toDate2."' and live='Y' ";
      $resultTotal2=mysqli_query($conn,$sqlTotal2);
      $fetchTotal2=mysqli_fetch_array($resultTotal2);
      
      
      
      

 $data2[]=['sitedate'=>$currentmonth,'T'=>$row3[0],'LiveSiteCount'=>$row2[0],'PendingSiteCount'=>$fetchPending2[0],'TotalDismentalCount'=>$numrow,'TotalSiteCount'=>$fetchTotal2[0] ];

for($i=1;$i<=8;$i++){
   $last9Month=date("Y-m",strtotime("-$i month")); 
    $lastMonth=date("M",strtotime("-$i month"));
   
   $fdate=date($last9Month.'-01');
   $toDate=date($last9Month.'-t');

      $sql1="SELECT count(*) FROM sites where current_dt between  '".$fdate.' 00:00:00'."' and '".$toDate.' 23:59:59'."' and live='Y'";
      $result1=mysqli_query($conn,$sql1);
      $row1=mysqli_fetch_array($result1);
     
      //$sqlpending="SELECT count(*) FROM sites where current_dt between  '".$fdate.' 00:00:00'."' and '".$toDate.' 23:59:59'."' and live='P'";
     $sqlpending="SELECT count(*) FROM sites where date(current_dt) <= '".$toDate."' and live='P'";
     $resultPending=mysqli_query($conn,$sqlpending);
      $fetchPending=mysqli_fetch_array($resultPending);
      
       $sqlDismental="SELECT DISTINCT ATMID FROM sites_log where  `live` = 'N' and current_dt between  '".$fdate .' 00:00:00'."' and '".$toDate.' 23:59:59'."'  ORDER BY id DESC";
      $resultDismental=mysqli_query($conn,$sqlDismental);
       $numrow2=mysqli_num_rows($resultDismental);
      $fetchDismental=mysqli_fetch_array($resultDismental);
      
       $sqlTotal="SELECT count(*) FROM sites where date(current_dt) <= '".$toDate."' and live='Y' ";
      $resultTotal=mysqli_query($conn,$sqlTotal);
      $fetchTotal=mysqli_fetch_array($resultTotal);
      
     
 
    $data2[]=['sitedate'=>$lastMonth,'T'=>$row3[0],'LiveSiteCount'=>$row1[0],'PendingSiteCount'=>$fetchPending[0],'TotalDismentalCount'=>$numrow2,'TotalSiteCount'=>$fetchTotal[0] ];
}


    
echo json_encode($data2);
?>