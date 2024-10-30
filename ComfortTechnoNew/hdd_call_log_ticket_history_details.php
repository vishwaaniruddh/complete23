<?php 
include('config.php');

$id = $_GET['id'];

$is_autoclose = 0;
$camera_alert_sql = mysqli_query($con,"select * from call_log_camera_alerts where id='".$id."'");
$camera_alert_sql_result = mysqli_fetch_assoc($camera_alert_sql);
if($camera_alert_sql_result['autoclose']==1){
	$is_autoclose = 1;
	$call_log_atmid = $camera_alert_sql_result['ATMID'];
	$sites_sql = mysqli_query($con,"select * from sites where ATMID='".$call_log_atmid."'");
    $sites_sql_result = mysqli_fetch_assoc($sites_sql);
	if($sites_sql_result['Zone']=='East' || $sites_sql_result['Zone']=='North'){
		$auto_created_name = "Ashish Mourya";
	}
	if($sites_sql_result['Zone']=='West' || $sites_sql_result['Zone']=='South'){
		$auto_created_name = "Kariyappa Maitri";
	}
}


$sql = mysqli_query($con,"select * from call_log_dvr_alerts_history where call_log_id='".$id."'");
?>

							  <div class="row">
								<div class="col-12">
								  <div class="table-responsive">
									<table id="order-listing" class="table">
									  <thead>
										<tr>
											<th>Status</th><th>Created DateTime</th><th>Created By</th><th>Close Date</th>
											<th>Closed By</th><th>Remarks</th>
											
										</tr>
									  </thead>
									  <tbody>
									  <?php  
									   if(mysqli_num_rows($sql)>0){
									     while($sql_result = mysqli_fetch_assoc($sql)){
                                           $id = $sql_result['id'];											 
									       if($sql_result['current_status']==0){
											   $ticket_status = "Work In Progress";
										   }
										   if($sql_result['current_status']==1){
											   $ticket_status = "Close";
										   }
										   $created_by = $sql_result['updated_by'];
										   $created_name = "";
										   $usersql = mysqli_query($con,"select name from loginusers where id='".$created_by."'");
										   if(mysqli_num_rows($usersql)>0){
											   $user_res = mysqli_fetch_assoc($usersql);
											   $created_name = $user_res['name'];
										   }
									  ?>
										<tr>
										    <td><?php echo $ticket_status;?></td>
											<td><?php echo $sql_result['updated_at'];?></td>
											<td><?php if($ticket_status=='Work In Progress'){ echo $created_name; }?></td>
											<td><?php if($ticket_status=='Close'){ echo $sql_result['updated_at']; }?></td>
											<td><?php if($ticket_status=='Close'){ if($is_autoclose==1){ echo $auto_created_name; }else{ echo $created_name; } }?></td>
											<td><?php echo $sql_result['current_remark'];?></td>
											
										</tr>
										
									   <?php }} ?>
									  </tbody>
									</table>
								  </div>
								</div>
							  </div>
							
