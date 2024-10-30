<!DOCTYPE html>
<html lang="en">
<?php 
    include('head.php');
    //include('config.php');
    ?>

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
			overflow-y: scroll;*/
    text-align: justify;
}
</style>
<style>
.menu-icon {
    width: 33px;
    margin-right: 7%;
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
                <h3 class="card-title">PMC Excel List</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">

                                <ul>
                                    <?php
                                $folderPath = 'excelfiles/'; 
                                 if (is_dir($folderPath)) {
                                    $files = scandir($folderPath);
                                    foreach ($files as $file) {
                                        // Check if the file is a .xlsx or .xls file
                                        if (pathinfo($file, PATHINFO_EXTENSION) === 'xlsx' || pathinfo($file, PATHINFO_EXTENSION) === 'xls') {
                                            echo '<li><h5>' . $file . '</h5><a href="downloadexcel.php?file=' . urlencode($file) . '">  <button type="button" class="btn btn-warning"><i class="fa fa-download" > Download </i></a></li>';
                                        }
                                    }
                                } else {
                                    echo '<li>Files not found</li>';
                                }
                                ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include('footer.php');?>
</div>
</div>
</div>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/js/vendor.bundle.addons.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/misc.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<script src="js/client_bank_circle_atmid.js"></script>
<script src="js/dashboard.js"></script>
<script src="vendors/video-js/video.min.js"></script>
<script src="js/select2.js"></script>
<!-- <script src="js/copylocation.js"></script> -->


</body>

</html>