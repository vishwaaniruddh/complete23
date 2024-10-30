<?php
include ('config.php');

$data=array();

      $sql1="select count(*) as totalConnect from panel_health where status='0' and panelName='Rass' ";
      $result1=mysqli_query($conn,$sql1);
      $row1=mysqli_fetch_array($result1);
      
      $sql2="select count(*) as totalNotConnect from panel_health where status='1' and panelName='Rass' ";
      $result2=mysqli_query($conn,$sql2);
      $row2=mysqli_fetch_array($result2);
      
      
      
      $sql3="select count(*) as totalConnect from panel_health where status='0' and panelName='Smart-I' ";
      $result3=mysqli_query($conn,$sql3);
      $row3=mysqli_fetch_array($result3);
      
      $sql4="select count(*) as totalNotConnect from panel_health where status='1' and panelName='Smart-I' ";
      $result4=mysqli_query($conn,$sql4);
      $row4=mysqli_fetch_array($result4);
      
      
      $sql5="select count(*) as totalConnect from panel_health where status='0' and panelName='Sec' ";
      $result5=mysqli_query($conn,$sql5);
      $row5=mysqli_fetch_array($result5);
      
      $sql6="select count(*) as totalNotConnect from panel_health where status='1' and panelName='Sec' ";
      $result6=mysqli_query($conn,$sql6);
      $row6=mysqli_fetch_array($result6);
      
     
       
        
    $data[]=['RassConnected'=>$row1[0],'RassDisconnected'=>$row2[0],'SmartConn'=>$row3[0],'SmartDis'=>$row4[0],'SecConn'=>$row5[0],'SecDis'=>$row6[0]];

    

echo json_encode($data);
?>