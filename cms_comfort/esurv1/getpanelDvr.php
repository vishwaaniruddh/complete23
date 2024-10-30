<?php
include ('config.php');

$data=array();

      $sql1="SELECT COUNT(*)  as cnt  from sites WHERE Panel_Make='Rass' and live='Y'";
      $result1=mysqli_query($conn,$sql1);
      $row1=mysqli_fetch_array($result1);
      
      $sql2="SELECT COUNT(*) as cnt FROM `sites` where Panel_Make='SMART -I' and live='Y'";
      $result2=mysqli_query($conn,$sql2);
      $row2=mysqli_fetch_array($result2);
      
      $sql3="SELECT COUNT(*) as cnt FROM `sites` where Panel_Make='SEC' and live='Y' ";
      $result3=mysqli_query($conn,$sql3);
      $row3=mysqli_fetch_array($result3);
      
      $sql4="SELECT COUNT(*) as cnt FROM `sites` where DVRName='Hikvision' and live='Y' ";
      $result4=mysqli_query($conn,$sql4);
      $row4=mysqli_fetch_array($result4);
      
       $sql5="SELECT COUNT(*) as cnt FROM `sites` where DVRName='CPPLUS' and live='Y' ";
      $result5=mysqli_query($conn,$sql5);
      $row5=mysqli_fetch_array($result5);
      
      $sql6="SELECT COUNT(*) as cnt FROM `sites` where DVRName='Dahuva' and live='Y' ";
      $result6=mysqli_query($conn,$sql6);
      $row6=mysqli_fetch_array($result6);
       
        
    $data[]=['Rass'=>$row1[0],'SMART'=>$row2[0],'SEC'=>$row3[0],'Hikvision'=>$row4[0],'CPPLUS'=>$row5[0],'Dahuva'=>$row6[0]];

    

echo json_encode($data);
?>