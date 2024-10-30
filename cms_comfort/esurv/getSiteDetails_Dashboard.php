<?php
include ('config.php');

$data=array();

      $sql1="SELECT COUNT(*) as cnt FROM `dvr_health` where latency>1000 ";
      $result1=mysqli_query($conn,$sql1);
      $row1=mysqli_fetch_array($result1);
      
      $sql2="SELECT COUNT(*) as cnt FROM `dvr_health` where status='1' and login_status='1' ";
      $result2=mysqli_query($conn,$sql2);
      $row2=mysqli_fetch_array($result2);
      
      $sql3="SELECT COUNT(*) as cnt FROM `dvr_health` where status='1' and login_status='0' ";
      $result3=mysqli_query($conn,$sql3);
      $row3=mysqli_fetch_array($result3);
       
        
    $data[]=['CountLetency'=>$row1[0],'DvrNotLogin'=>$row2[0],'DvrStatusOk'=>$row3[0]];

    

echo json_encode($data);
?>