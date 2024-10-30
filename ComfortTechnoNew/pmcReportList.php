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
                        
                        
						<div class="card">
                            <div class="card-body">
								<div class="row">
									<div class="col-12" id="ticketview_tbody">
									  <div class="table-responsive">
										<table id="order-listing" class="table">
										  <thead>
											<tr>
												<th>S.N</th>
												<th>ATM-ID</th>
												<th>Site Address</th>
												<th>Customer</th>
												<th>Bank</th>
												<th>State</th>
												<th>City</th>
												<th>Zone</th>
												<th>Check PMC</th>
											</tr>
										  </thead>
										  <tbody>
											 
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
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/pmcreportlist.js"></script>
		<script src="js/data-table.js"></script>
        <!-- video.js -->
         <script src="js/select2.js"></script>
    </body>
</html>
