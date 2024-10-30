<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	
	<style>
    .table thead th, .jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: bold;
    font-size: .9rem;
    padding: 0.4375rem;
}
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
				border-right: 1px solid #282844;
		  }
		  #accordion div.card-body {
		/*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px;  */
			height: 210px;
			overflow-x: hidden;
			overflow-y: scroll;
			text-align:justify;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
	</style>
     <?php include('top-navbar.php');?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
					
					    <div class="col-12 grid-margin">
                         <h6 class="card-title">Dashboard As on Date : <?php echo date('d/m/Y');?></h6> 
                         
						</div> 
                        <!-- Dashboard Wighets -->
						
						<div class="row">
							<div class="col-md-6 grid-margin">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title mb-0">Total Sites</h4>
										<div class="d-flex justify-content-between align-items-center">
											<div class="d-inline-block pt-3">
												<div class="d-md-flex">
													<a href="viewsitenew.php"><h2 class="mb-0" id="total_site">0</h2></a>
												</div>
												<div class="d-md-flex">
													<h4 class="card-title mb-0">Working : <span id="site_working">0</span></h4>
												</div>
												<div class="d-md-flex">
													<h4 class="card-title mb-0">Not Working : <span id="site_notworking">0</span></h4>
												</div>
											</div>
											<!--<div class="d-inline-block">
												<i class="fas fa-chart-pie text-info icon-lg"></i>                                    
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 grid-margin">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title mb-0">Total AI </h4>
										<div class="d-flex justify-content-between align-items-center">
											<div class="d-inline-block pt-3">
												<div class="d-md-flex">
													<h2 class="mb-0" id="ai_total_site">0</h2>
												</div>
												<div class="d-md-flex">
													<h4 class="card-title mb-0">Working : <span id="ai_site_working">0</span></h4>
												</div>
												<div class="d-md-flex">
													<h4 class="card-title mb-0">Not Working : <span id="ai_site_notworking">0</span></h4>
												</div>
											</div>
											<!--<div class="d-inline-block">
												<i class="fas fa-chart-pie text-info icon-lg"></i>                                    
											</div> -->
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6 grid-margin">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title mb-0">HDD</h4>
										<div class="d-flex justify-content-between align-items-center">
											<div class="d-inline-block pt-3">
												<div class="d-md-flex">
													<h2 class="mb-0" id="hdd_fault">0</h2>
												</div>
												<div class="d-md-flex">
													<h4 class="card-title mb-0">Working : <span id="site_working">0</span></h4>
												</div>
												<div class="d-md-flex">
													<h4 class="card-title mb-0">Not Working : <span id="site_notworking">0</span></h4>
												</div>
											</div>
											<!--<div class="d-inline-block">
												<i class="fas fa-chart-pie text-info icon-lg"></i>                                    
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 grid-margin">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title mb-0">Live View </h4>
										<div class="d-flex justify-content-between align-items-center">
											<div class="d-inline-block pt-3">
												<div class="d-md-flex">
													<h2 class="mb-0" id="ai_total_site"><a href="live_view.php">Check live view</a></h2>
												</div>
												
											</div>
											<!--<div class="d-inline-block">
												<i class="fas fa-chart-pie text-info icon-lg"></i>                                    
											</div> -->
										</div>
									</div>
								</div>
							</div>
						</div>
                        
                        <!-- Dashboard Charts -->
                       
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
        <script src="js/home_dashboard.js"></script>
        
        <!-- End custom js for this page-->
        

    
    </body>
</html>
