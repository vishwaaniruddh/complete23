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

            </div>
            <!-- Dashboard Wighets -->
            <div class="card">
                <div class="card-body">
                    <h3>Sites</h3>
                    <div class="row">
                        <div class="col-lg-6 grid-margin ">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Sites</h4> -->
                                    <figure class="highcharts-figure">
                                        <div id="container"></div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sites</h4>
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <div
                                                class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                                <div class="statistics-item">

                                                    <h2 id="total_site">0</h2>
                                                    <label id="hover"
                                                            class="badge badge-outline-warning badge-pill">Total
                                                            Site</label>
                                                    
                                                </div>
                                                <div class="statistics-item">

                                                    <h2 id="site_working">0</h2>
                                                    <label id="hover" class="badge badge-outline-success badge-pill">Online</label>
                                                   
                                                </div>
                                                <div class="statistics-item">

                                                    <h2 id="site_notworking">0</h2>
                                                     <label id="hover" class="badge badge-outline-danger badge-pill">Offline</label>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h3>AI Sites</h3>
                    <div class="row">
                        <div class="col-lg-6 grid-margin ">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Total AI sites Online & Offline </h4> -->
                                    <div id="c3-pie-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total AI Sites</h4>
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <div
                                                class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                                <div class="statistics-item">

                                                    <h2 id="ai_total_site">0</h2>
                                                    <label id="hover" class="badge badge-outline-warning badge-pill">Total</label>
                                                    
                                                </div>
                                                <div class="statistics-item">

                                                    <h2 id="ai_site_working">0</h2>
                                                    <label id="hover" class="badge badge-outline-success badge-pill">Online</label>
                                                    
                                                </div>
                                                <div class="statistics-item">

                                                    <h2 id="ai_site_notworking">0</h2>
                                                    <label id="hover" class="badge badge-outline-danger badge-pill">Offline</label>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h3>HDD</h3>
                    <div class="row">
                        <div class="col-lg-6 grid-margin ">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">HDD</h4> -->
                                    <!-- <div id="sparkline-pie-chart"></div> -->

                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total HDD</h4>
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <div
                                                class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                                <div class="statistics-item">

                                                    <h2 id="hdd_fault">0</h2>
                                                    <a href=""> <label id="hover"
                                                            class="badge badge-outline-warning badge-pill">Total</label>
                                                    </a>
                                                </div>
                                                <div class="statistics-item">

                                                    <h2 id="hdd_working">0</h2>
                                                    <label id="hover" class="badge badge-outline-success badge-pill">Close</label>
                                                    
                                                </div>
                                                <div class="statistics-item">

                                                    <h2 id="hdd_notworking">0</h2>
                                                    <a href=""> <label id="hover"
                                                            class="badge badge-outline-danger badge-pill">Work In Progress</label>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-6 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h3>Live View </h3>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-inline-block pt-3">
                                    <div class="d-md-flex">
                                        <h2 class="mb-0" id="ai_total_site"><a href="live_view.php">Check live view</a>
                                        </h2>
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