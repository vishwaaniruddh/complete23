<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
  //  include('config.php');
    ?>
	
	<style>
    .table thead th, .jsgrid .jsgrid-table thead th {
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
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
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
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
		
		  #online_percent_table_load{
    min-width: 200px;
    min-height: 200px;
    position:relative;
    z-index:9999;
    background:url("image/Circle.svg") no-repeat center center;
	margin-left: auto;
	margin-right: auto;
}
		
	</style>
    <?php include('top-navbar.php');?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
					    <div class="col-12 grid-margin">
                         <h6 class="card-title">DVR Health Dashboard As on Date : <?php echo date('d/m/Y');?></h6> 
                          <?php include('filters/sitehealth_filter.php');?>
						</div>  
                        <!-- Dashboard Widgets -->
						<?php $test = 1;
						   if($test==1){ ?>
                        <div class="row form-group" >
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">DVR online</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_online_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-laptop-code text-success icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">DVR Offline</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_offline_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-laptop text-danger icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">Camera Online</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="camera_online_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-camera text-success icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body" style="padding: 1rem 1em;">
                                        <h6 class="card-title mb-0 ">Camera Offline</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="camera_offline_count">0</h3>
                                                    
                                                </div>
                                               <!--  <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-camera text-danger icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!--  <div class="col-md-2 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 ">Hdd fail</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="hdd_fail_count">0</h3>
                                                    
                                                </div>
                                               
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-hdd text-danger icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  -->
                             
                        </div>
                        <!-- Dashboard Charts -->
						   <?php }else{ ?>
						       <div class="row form-group" >
                             
								 <div class="col-md-12 grid-margin">
									<div class="card">
										<div class="card-body">
											<h6 class="card-title mb-0"><b>Please Keep Patience. Work in Progress.</b></h6>
											
										</div>
									</div>
								</div>
							</div>
							  
						  <?php }?>
						  
						   <?php //include('panel/dvr_sensor_alarm_status.php');?>
						   
						   <div class="card">
                            <div class="card-body">
								<div class="row">
									<div class="col-12" id="ticketview_tbody">
									  <div class="table-responsive">
										<table id="example" class="table">
										  <thead>
											<tr>
												<th>S.N</th>
												<th>ATM-ID</th>
												<!--<th>IP</th> -->
												<th>Lobby Camera</th>
												<th>Backroom Camera</th>
												<th>Outdoor Camera</th>
												<th>Pinhole Camera</th>
												<th>Last Communication</th>
												<th>Current Communication</th>
												<th>Capacity</th> 
												<th>Free Space</th> 
												<th>Recording From</th> 
												<th>Recording To</th> 
																		  
											</tr>
										  </thead>
										  <tbody >
											
										  </tbody>
										</table>
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
        <!--<script src="js/dashboard.js"></script>-->
        <!-- End custom js for this page-->
        <!-- video.js -->
		<script src="js/client_bank_circle_atmid_new.js"></script>
        <script src="js/dvrhealthdashboard.js"></script>
		<script src="js/data-table.js"></script>
        <!-- video.js -->
         <script src="js/select2.js"></script>
       <!--
	   <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart',
            data: {
              // iris data from R
              columns: [
                ['offline', 30],
                ['online', 120],
              ],
              type: 'pie',
              onclick: function(d, i) {
                console.log("onclick", d, i);
              },
              onmouseover: function(d, i) {
                console.log("onmouseover", d, i);
              },
              onmouseout: function(d, i) {
                console.log("onmouseout", d, i);
              }
            },
            color: {
              pattern: ['#6153F9', '#8E97FC', '#A7B3FD']
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 30,
              left: 0,
            }
          });

          setTimeout(function() {
            c3PieChart.load({
              columns: [
                ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
              ]
            });
          }, 1500);

          setTimeout(function() {
            c3PieChart.unload({
              ids: 'data1'
            });
            c3PieChart.unload({
              ids: 'data2'
            });
          }, 2500);
        </script>

         <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart1',
            data: {
              // iris data from R
              columns: [
                ['o', 30],
                ['data2', 120],
              ],
              type: 'pie',
              onclick: function(d, i) {
                console.log("onclick", d, i);
              },
              onmouseover: function(d, i) {
                console.log("onmouseover", d, i);
              },
              onmouseout: function(d, i) {
                console.log("onmouseout", d, i);
              }
            },
            color: {
              pattern: ['#6153F9', '#8E97FC', '#A7B3FD']
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 30,
              left: 0,
            }
          });

          setTimeout(function() {
            c3PieChart.load({
              columns: [
                ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
              ]
            });
          }, 1500);

          setTimeout(function() {
            c3PieChart.unload({
              ids: 'data1'
            });
            c3PieChart.unload({
              ids: 'data2'
            });
          }, 2500);
        </script> 
        <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart2',
            data: {
              // iris data from R
              columns: [
                ['offline', 0],
                ['online', 0],
              ],
              type: 'pie',
              onclick: function(d, i) {
                console.log("onclick", d, i);
              },
              onmouseover: function(d, i) {
                console.log("onmouseover", d, i);
              },
              onmouseout: function(d, i) {
                console.log("onmouseout", d, i);
              }
            },
            color: {
              pattern: ['#6153F9', '#FF5E6D', '#A7B3FD']
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 30,
              left: 0,
            }
          });

          setTimeout(function() {
            c3PieChart.load({
              columns: [
                ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
              ]
            });
          }, 1500);

          setTimeout(function() {
            c3PieChart.unload({
              ids: 'offline'
            });
            c3PieChart.unload({
              ids: 'online'
            });
          }, 2500);
        </script>
        <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart3',
            data: {
              // iris data from R
              columns: [
                ['data1', 30],
                ['data2', 120],
              ],
              type: 'pie',
              onclick: function(d, i) {
                console.log("onclick", d, i);
              },
              onmouseover: function(d, i) {
                console.log("onmouseover", d, i);
              },
              onmouseout: function(d, i) {
                console.log("onmouseout", d, i);
              }
            },
            color: {
              pattern: ['#6153F9', '#8E97FC', '#A7B3FD']
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 30,
              left: 0,
            }
          });

          setTimeout(function() {
            c3PieChart.load({
              columns: [
                ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
              ]
            });
          }, 1500);

          setTimeout(function() {
            c3PieChart.unload({
              ids: 'data1'
            });
            c3PieChart.unload({
              ids: 'data2'
            });
          }, 2500);
        </script>
        -->
        
		
		
    
    </body>
</html>
