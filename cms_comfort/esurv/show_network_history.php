<?php
    
include 'config.php';
error_reporting(0);
$sn = $_GET['id'];

?>

	<link rel="stylesheet" type="text/css" href="plugins/datatables/dataTables.bootstrap4.min.css">
	<table class="table table-bordered table-striped table-hover dataTable js-exportable no-footer" style="width:100%">
		<thead>
			<tr>
				<th>S.No</th>
				<td>ATM ID</td>
				<td>Working Last Communication</td>
				<td>Not Working Last Communication</td>
				
			</tr>
		</thead>
		<tbody>
			<?php   $dvr_statement = "select * from dvr_health where SN=".$sn." order by id desc" ;
			        $dvrhealth_sql = mysqli_query($conn,$dvr_statement); 
                    $sql_result = mysqli_fetch_assoc($dvrhealth_sql);   
                    $query_nc = "SELECT * FROM `network_history` WHERE site_id='".$sn."' AND device='D' AND status='NC' ORDER BY id DESC LIMIT 1";  
                    $query_ok = "SELECT * FROM `network_history` WHERE site_id='".$sn."' AND device='D' AND status='OK' ORDER BY id DESC LIMIT 1"; 					
                    $nc_sql = mysqli_query($conn,$query_nc); 
                    $ok_sql = mysqli_query($conn,$query_ok); 
                    $ok_sql_result = mysqli_fetch_assoc($ok_sql); 	
                    $nc_sql_result = mysqli_fetch_assoc($nc_sql); 					
    ?>
				
						<tr>
							<td>
								<?php echo ++$i; ?>
							</td>
							<td>
								<?php echo $sql_result['atmid']; ?>
							</td>
							<td>
								<?php echo $ok_sql_result['rectime']; ?>
							</td>
							<td>
								<?php echo $nc_sql_result['rectime']; ?>
							</td>
							
						</tr>
						
		</tbody>
	</table>
