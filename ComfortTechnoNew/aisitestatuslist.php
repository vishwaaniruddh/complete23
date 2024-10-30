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

<?php include('top-navbar.php');
      
	      $Client = $_GET['client'];
	      $Bank = $_GET['bank'];
		  $AtmID = "";
		  if(isset($_GET['atmid'])){
	      $AtmID = $_GET['atmid'];
		  }
		  $sitestatus = $_GET['status'];
		  $_status = "0";
		  if($sitestatus=='Online'){
			  $_status = "1"; 
		  }
		  $circle = "";
		  if(isset($_GET['circle'])){
			$circle = $_GET['circle'];
		  }
            // echo $_status; die; 
    ?>

<input type="hidden" id="Client" value="<?php echo $Client;?>">
<input type="hidden" id="Bank" value="<?php echo $Bank;?>">
<input type="hidden" id="AtmID" value="<?php echo $AtmID;?>">
<input type="hidden" id="status" value="<?php echo $sitestatus;?>">
<input type="hidden" id="circle" value="<?php echo $circle;?>">
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <?php include('navbar.php');?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12 grid-margin">
                <h6 class="card-title">AI Site Status - <?php echo $Client;?></h6>

            </div>

            <!-- Dashboard Charts -->
            <div class="row form-group">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">AI Site <?php echo $sitestatus; ?></h4>

                            <div class="row form-group">

                                <div class="table-responsive" id="siteonline_percent_table"
                                    style="min-height:300px;overflow-y:scroll;">

                                </div>
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

<script>
onload();

function onload() {
    debugger;
    var Client = $("#Client").val();
    var Bank = $("#Bank").val();
    var AtmID = $("#AtmID").val();
    var status = $("#status").val();
    var circle = $("#circle").val();
    $("#siteonline_percent_table").html('');
    if (Client == '') {
        swal("Oops!", "Client Must Required !", "error");
        return false;
    }


    $("#load").show();
    $.ajax({
        url: "aisitelist_ajax.php",
        type: "GET",
        data: {
            client: Client,
            bank: Bank,
            // atmid: AtmID,
            status: status,
            // circle: circle
        },
        dataType: "html",
        success: (function(result) {
            $("#load").hide();

            $('#order-listing1').dataTable().fnClearTable();
            $('#siteonline_percent_table').html('');
            $("#siteonline_percent_table").html(result);
            $('#order-listing1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "order": [
                    [0, "desc"]
                ]
            });

        })
    });
}
</script>



</body>

</html>