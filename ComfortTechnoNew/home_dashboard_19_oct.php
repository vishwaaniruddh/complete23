<!DOCTYPE html>
<html lang="en">
<?php include('head.php');?>

<style>
.table thead th,
.jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: bold;
    font-size: .9rem;
    padding: 0.4375rem;
}

.bt {
    border-top: 1px solid #1e1f33;
}

.br {
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
    text-align: justify;
}
</style>
<style>
.menu-icon {
    width: 33px;
    margin-right: 7%;
}
</style>

<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

input[type="number"] {
    min-width: 50px;
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
                <input type="hidden" id="current_userid" value="<?php echo $_SESSION['userid'];?>">
            </div>
            <!-- Dashboard Wighets -->
			
						<div class="row">
							<div class="col-12">
							  <div class="card">
								<div class="card-body">
								  <div class="d-md-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-cash-register" style='color: blue'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Total Sites</h5>
										<p class="mb-0" id="total_site">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-cash-register" style='color: green'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Total Online Site</h5>
										<p class="mb-0" id="site_working">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-cash-register" style='color: red'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Total Offline Site</h5>
										<p class="mb-0" id="site_notworking">0</p>
									  </div>
									</div>
									<!--<div class="d-flex align-items-center">
									  <button class="btn btn-social-icon btn-linkedin btn-rounded">
										<i class="fab fa-linkedin-in"></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Linkedin</h5>
										<p class="mb-0">1090 connections</p>
									  </div>
									</div> -->
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						  <!--
						  <div class="row" style="padding-top:1.5em;">
							<div class="col-12">
							  <div class="card">
								<div class="card-body">
								  <div class="d-md-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-brain" style='color: blue'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Total AI</h5>
										<p class="mb-0" id="ai_total_site">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-brain" style='color: green'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Total Online AI</h5>
										<p class="mb-0" id="ai_site_working">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-brain" style='color: red'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Total Offline AI</h5>
										<p class="mb-0" id="ai_site_notworking">0</p>
									  </div>
									</div>
									
								  </div>
								</div>
							  </div>
							</div>
						  </div>  -->
						  
						   
					      <div class="row" style="padding-top:1.5em;">
							<div class="col-12">
							  <div class="card">
								<div class="card-body">
								  <div class="d-md-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-hdd" style='color: blue'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">HDD Fault</h5>
										<p class="mb-0" id="hdd_fault">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-hdd" style='color: green'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Total Close</h5>
										<p class="mb-0" id="hdd_working">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-hdd" style='color: red'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Work In Progress</h5>
										<p class="mb-0" id="hdd_notworking">0</p>
									  </div>
									</div>
									<!--<div class="d-flex align-items-center">
									  <button class="btn btn-social-icon btn-linkedin btn-rounded">
										<i class="fab fa-linkedin-in"></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Linkedin</h5>
										<p class="mb-0">1090 connections</p>
									  </div>
									</div> -->
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						  
						  <div class="row" style="padding-top:1.5em;">
							<div class="col-12">
							  <div class="card">
								<div class="card-body">
								  <div class="d-md-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-camera" style='color: blue'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Camera Fault</h5>
										<p class="mb-0" id="camera_fault">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-camera" style='color: green'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Total Close</h5>
										<p class="mb-0" id="camera_working">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-4 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-camera" style='color: red'></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Work In Progress</h5>
										<p class="mb-0" id="camera_notworking">0</p>
									  </div>
									</div>
									<!--<div class="d-flex align-items-center">
									  <button class="btn btn-social-icon btn-linkedin btn-rounded">
										<i class="fab fa-linkedin-in"></i>
									  </button>
									  <div class="ml-4">
										<h5 class="mb-0">Linkedin</h5>
										<p class="mb-0">1090 connections</p>
									  </div>
									</div> -->
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						  
						  <div class="row" style="padding-top:1.5em;">
							<div class="col-12">
							  <div class="card">
								<div class="card-body">
								  <div class="d-md-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center mb-3 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-tv" style='color: green'></i>
									  </button>
									  <div class="ml-3">
										<h5 class="mb-0">DVR Online</h5>
										<p class="mb-0" id="dvr_online_count">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-3 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-tv" style='color: red'></i>
									  </button>
									  <div class="ml-3">
										<h5 class="mb-0">DVR Offline</h5>
										<p class="mb-0" id="dvr_offline_count">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-3 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-solar-panel" style='color: green'></i>
									  </button>
									  <div class="ml-3">
										<h5 class="mb-0">Panel Online</h5>
										<p class="mb-0" id="panel_online_count">0</p>
									  </div>
									</div>
									<div class="d-flex align-items-center mb-3 mb-md-0">
									  <button class="btn btn-social-icon btn-rounded">
										<i class="fa fa-solar-panel" style='color: red'></i>
									  </button>
									  <div class="ml-3">
										<h5 class="mb-0">Panel Offline</h5>
										<p class="mb-0" id="panel_offline_count">0</p>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
            
                           <div class="row" style="padding-top:1.5em;">
								<div class="col-12 grid-margin">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-4">
													<div class="card" style="text-align: center;">
														<img class="mx-auto" src="images/homedashboard/cleaner-icon.svg" alt=""
															style="width:20%;">
														<!-- <label class="col-sm-6 col-form-label">HK Person</label> -->
														<div class="ml-3">
															<h5>HK Person</h5>
															<p class="mb-0" id="hk_person_count">0</p>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="card" style="text-align: center;">
														<img class="mx-auto" src="images/homedashboard/it.svg" alt="" style="width:20%;">
														<!-- <label class="col-sm-6 col-form-label">HK Person</label> -->
														<div class="ml-3">
															<h5>IT Person</h5>
															<p class="mb-0" id="it_person_count">0</p>
														</div>
													</div>
												</div>
												<div class="col-md-4">

													<div class="card" style="text-align: center;">
														<img class="mx-auto" src="images/homedashboard/engg.svg" alt="" style="width:20%;">
														<!-- <label class="col-sm-6 col-form-label">HK Person</label> -->
														<div class="ml-3">
															<h5>FLM/ENGINEER</h5>
															<p class="mb-0" id="flm_engineer_count">0</p>
														</div>
													</div>
												</div>
											</div> <br>
											<div class="row">
												<div class="col-md-4">
													<div class="card" style="text-align: center;">
														<img class="mx-auto" src="images/homedashboard/hk1.svg" alt="" style="width:20%;">
														<!-- <label class="col-sm-6 col-form-label">HK Person</label> -->
														<div class="ml-3">
															<h5>QRT Person</h5>
															<p class="mb-0" id="qrt_person_count">0</p>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="card" style="text-align: center;">
														<img class="mx-auto" src="images/homedashboard/business-team-icon.svg" alt=""
															style="width:30%;">
														<!-- <label class="col-sm-6 col-form-label">HK Person</label> -->
														<div class="ml-3">
															<h5>Other Person</h5>
															<p class="mb-0" id="other_person_count">0</p>
														</div>
													</div>
												</div>
												<div class="col-md-4">

													<div class="card" style="text-align: center;">
														<img class="mx-auto" src="images/homedashboard/sos.svg" alt="" style="width:20%;">
														<!-- <label class="col-sm-6 col-form-label">HK Person</label> -->
														<div class="ml-3">
															<h5>Panic Switch</h5>
															<p class="mb-0" id="panel_switch_count">0</p>
														</div>
													</div>
												</div>
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
<!-- <script src="js/chart.js"></script> -->
<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/home_dashboard.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script> -->
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- <script src="js/c3.js"></script> -->
<!-- <script src="js/sparkline.js"></script> -->

<!-- End custom js for this page-->
<script>
// Get all elements with the class "hover-element"
var elements = document.querySelectorAll('.badge');

// Add a mouseover event listener to each element
elements.forEach(function(element) {
    element.addEventListener('mouseover', function() {
        // Change the cursor style to 'pointer' on hover
        this.style.cursor = 'pointer';
    });

    // Add a mouseout event listener to reset the cursor style when the mouse leaves the element
    element.addEventListener('mouseout', function() {
        // Reset the cursor style to its default
        this.style.cursor = 'auto';
    });
});
</script>


</body>

</html>