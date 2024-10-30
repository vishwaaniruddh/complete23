<?php session_start();
     if(!isset($_SESSION['username'])){  ?>
	      
<?php	 }

include("db_connection.php");
?>
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
                <title>
                    Comfort Techno Services Pvt Ltd - <?=$_SESSION['username']?>
                </title>
                <!-- plugins:css -->
                <link href="vendors/iconfonts/font-awesome/css/all.min.css" rel="stylesheet">
                    <link href="vendors/css/vendor.bundle.base.css" rel="stylesheet">
                        <link href="vendors/css/vendor.bundle.addons.css" rel="stylesheet">
                            <!-- endinject -->
                            <!-- plugin css for this page -->
                            <!-- End plugin css for this page -->
                            <!-- inject:css -->
							<link rel="stylesheet" href="vendors/lightgallery/css/lightgallery.css">
                            <link href="css/style.css" rel="stylesheet">
                                <!-- endinject -->
                               <!-- <link href="media/comfort.ico" rel="shortcut icon"/>-->
                                <link rel="shortcut icon" href="images/favicon.png">
                            </link>
                        </link>
                    </link>
                </link>
				<style>
				.content-wrapper{padding: 5.5rem 1.7rem !important;}
				</style>
				<!--<link href="sweetalert/sweetalert.css" rel="stylesheet">-->
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>      
            </meta>
        </meta>
    </head>