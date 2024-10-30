<!DOCTYPE html>
<html lang="en">
<?php 
    include('head.php');
  //  include('config.php');
//   var_dump($_GET); die;
    ?>

<style>
.table thead th,
.jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: bold;
    font-size: .9rem;
    padding: 0.4375rem;
}

.card .card-body {
    padding: 1rem 1rem;
}

.card .card-title {
    color: #000000;
    font-weight: normal;
    margin-bottom: 1.25rem;
    text-transform: capitalize;
    font-size: 1rem;
}
</style>

<style>
.bt {
    border-top: 1px solid #1e1f33;
}

.br {
    border-right: 1px solid #282844;
}

div.card-body {
    /*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px;  
			height: 210px; 
			overflow-x: hidden;
			overflow-y: scroll; 
			text-align:justify; */
}
</style>
<style>
.menu-icon {
    width: 33px;
    margin-right: 7%;
}
</style>

<?php include('top-navbar.php');  ?>

<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include('navbar.php');?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12 grid-margin">
                <h6 class="card-title">List</h6>

            </div>

            <!-- Dashboard Charts -->
            <div class="row form-group">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php //echo strtoupper($sitestatus); ?></h4>

                            <div class="card-block">

                                <div class="two_end">
                                    <h5>Downsite Excel <span style="font-size:12px; color:red;">(Bulk Upload)</span></h5>
                                    <a class="btn btn-success" href="PNBDownCallsReport.xlsx" download>EXCEL UPLOAD FORMAT</a>
                                </div>

                                <?php
                                if (isset($_POST['submit'])) {
									$con = OpenCon();
									$downsite_tot = 0;
                                    $userid = $_SESSION['userid'];
                                    date_default_timezone_set('Asia/Kolkata');
                                    $date = date('Y-m-d h:i:s a', time());
                                    $only_date = date('Y-m-d');
									$yesterday = date('Y-m-d',strtotime("-1 days"));
                                    $target_dir = 'PHPExcel/';
                                    $file_name = $_FILES["images"]["name"];
                                    $file_tmp = $_FILES["images"]["tmp_name"];
                                    $file =  $target_dir . '/' . $file_name;

                                    $status = 'open';
                                    $created_by = $_SESSION['userid'];
                                    $created_at = date('Y-m-d H:i:s');

                                    move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"], $target_dir . '/' . $file_name);
                                    include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
                                    $inputFileName = $file;

                                    try {
                                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                                        $objPHPExcel = $objReader->load($inputFileName);
                                    } catch (Exception $e) {
                                        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                                            $e->getMessage());
                                    }

                                    $sheet = $objPHPExcel->getSheet(2);
                                    $highestRow = $sheet->getHighestRow();
                                    $highestColumn = $sheet->getHighestColumn();

                                    for ($row = 1; $row <= $highestRow; $row++) {
                                        $rowData[] = $sheet->rangeToArray(
                                            'A' . $row . ':' . $highestColumn . $row,
                                            null,
                                            true,
                                            false
                                        );
                                    }

                                    $row = $row - 2;
                                    $error = '0';
                                    $contents = '';
                                    
								//	echo '<pre>';print_r($rowData);echo '</pre>';
									
                                    for ($i = 1; $i <= $row; $i++) {

                                        $atmid = $rowData[$i][0][1];
                                       // echo $atmid;die;
                                        if($atmid){
											$last_comm = $rowData[$i][0][5];
											
											if($last_comm!=''){
											    $last_communication = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($last_comm)); 
											}else{
												$last_communication = $only_date;
											}
											// echo $last_communication;die;                                      
                                        // echo "select * from mis_newsite where atmid = '" . $atmid . "'" ; 
                                            $sql = mysqli_query($con, "select * from sites where ATMID = '" . $atmid . "'");
                                            $sql_result = mysqli_fetch_assoc($sql);
                                            $num_rows = mysqli_num_rows($sql);
                                            // $_atmid = $sql_result['atmid'];mis_newsite
                                            
                                            // echo $num_rows; 
                                           if($num_rows>0) {
                                            if(isset($atmid) && $atmid!='' ){
                                            // if(isset($atmid) && $atmid!='' && isset($docket_number) && $docket_number!='' ){
											//	$customer = strtoupper($sql_result['customer']);
												
											//	$bank = $sql_result['bank'];
												$SN = $sql_result['SN'];
												
												$checkdownsite_exist = "select * from daily_downsite_table where today_date='".$yesterday."' AND SN='".$SN."'";
												$checkdownsite_exist_sql = mysqli_query($con, $checkdownsite_exist);
												if(mysqli_num_rows($checkdownsite_exist_sql)>0){
													
												}else{
												
													$statement = "insert into daily_downsite_table (ATMID,last_communication,SN,today_date) values('" . $atmid . "','" . $last_communication . "','" . $SN . "','" . $yesterday . "')";
										// echo $statement;die;
													if (mysqli_query($con, $statement)) {

														$downsite_tot = $downsite_tot + 1;

													}else{
														echo "Error: " . $con->error;

													}
												}
											} else {
												echo "ATMID ".$atmid. " Not Found</br>";
											}
                                           }
                                            
                                        }
    
                                    }
									echo "Total Number of Downsite : ".$downsite_tot;
									
                                }
                                ?>
                                <form action="atm_downsite_excel_upload.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">

                                        <div class="col-sm-4">
                                            <input type="file" name="images" class="form-control" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="submit" name="submit" value="upload" class="btn btn-danger">
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include('footer.php');?>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js">
</script>
<script src="vendors/js/vendor.bundle.addons.js">
</script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="js/off-canvas.js">
</script>
<script src="js/hoverable-collapse.js">
</script>
<script src="js/misc.js">
</script>
<script src="js/settings.js">
</script>
<script src="js/todolist.js"></script>
<script src="js/chart.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/dashboard.js">
</script>
<!-- End custom js for this page-->
<!-- video.js -->
<script src="js/dvrhealthdashboard.js"></script>
<script src="js/data-table.js"></script>

<!-- video.js -->
<script src="js/select2.js"></script>


<!-- Modal starts -->
                  
                  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ticket History</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" id="result_status">
                           <h6>Ticket Details</h6>
							  <div class="card">
								<div class="card-block" id="result_status" style=" overflow: auto;">
								  
								</div>
							</div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
				  
				   <!-- Modal starts -->
                  
                  <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Update Remarks</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
						<form>
                        <div class="modal-body" >
                            
										<div class="row">
											<input type="hidden" id="Id" name="id">
											<input type="hidden" id="alert_type" name="alert_type">
											<div class="col-sm-12">
											    <select class="form-control" name="ticket_status">
												   <option value="0">Work In Progress</option>
												   <option value="1">Close</option>
												</select>
											</div>
											<div class="col-sm-12">
												<br>
												<label>Remarks</label>
												<input type="text" name="remarks" class="form-control" id="remarks">
											</div>
											
										</div>
									
								
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Submit</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
						</form>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
				  
			
</body>

</html>