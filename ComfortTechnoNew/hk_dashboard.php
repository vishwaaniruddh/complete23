<!DOCTYPE html>
<html lang="en">
<?php include('head.php');
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
<style>
.new {
    display: grid;
    place-items: center;
    width: 10%;
}
</style>
<?php include('top-navbar.php');?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="icons/feather/css/feather.css">
    <?php include('navbar.php');
	
	  $month_date = date('Y-m-d');
	  $con = OpenCon();
      $qry = mysqli_query($con,"select * from alert_type_month_date where month_date='".$month_date."'");
	  
	  CloseCon($con);
	  $today_total_data = mysqli_num_rows($qry);
	  $total_alert_inserted = 0;
	  if($today_total_data>0){
		while($total_result_data = mysqli_fetch_assoc($qry)){
			if($total_result_data['status']==1){
				$total_alert_inserted = $total_alert_inserted + 1;
			}
		}  
	  }
	?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-12 grid-margin">
                <h6 class="card-title">Dashboard As on Date : <?php date('d/m/Y');?></h6>
                <input type="hidden" id="current_userid" value="<?php echo $_SESSION['userid'];?>">
            </div>
            <!-- Dashboard Wighets -->

            <div class="row" style="padding-top:1.5em;">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" style="text-align: center;">
                                        <!-- <img class="mx-auto" src="images/sitemap-blue.svg" alt="" style="width:20%;"> -->
                                        <!-- <label class="col-sm-6 col-form-label">HK Person</label> -->
										<?php if($today_total_data==0){ ?>
                                        <button class="btn btn-primary" type="button" name="insert" id="insert"
                                            onclick="increaseCounter()" >Insert</button>
										<?php }?>
                                        <div class="ml-3">
                                            <h5>Total Inserted Alert Type : </h5>
                                            <p class="mb-0" id="total_site"><?php echo $today_total_data;?></p>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="card" style="text-align: center;">
                                        <!-- <img class="mx-auto" src="images/sitemap-blue.svg" alt="" style="width:20%;"> -->
                                        <!-- <label class="col-sm-6 col-form-label">HK Person</label> -->
										<?php if($today_total_data==6){ ?>
                                        <button class="btn btn-primary" type="button" name="insert" id="insert_data"
                                            onclick="increaseCounter_data()">Insert Data</button>
										<?php } ?>	
                                        <div class="ml-3">
                                            <h5>Total Inserted Data</h5>
                                            <p class="mb-0" id="total_site_data"><?php echo $total_alert_inserted;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row" style="padding-top:1.5em;">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" style="text-align: center;">
                                        <button class="btn btn-primary" type="button" name="hk" id="hk">hk</button>
                                        <div class="ml-3">
                                            <h5>Total hk</h5>
                                            <p class="mb-0" id="total_site">0</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card" style="text-align: center;">
                                        <button class="btn btn-warning" type="button" name="it" id="it">it</button>
                                        <div class="ml-3">
                                            <h5>Total it</h5>
                                            <p class="mb-0" id="total_site">0</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card" style="text-align: center;">
                                        <button class="btn btn-danger" type="button" name="eng" id="eng">eng</button>
                                        <div class="ml-3">
                                            <h5>Total eng</h5>
                                            <p class="mb-0" id="total_site">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" style="text-align: center;">
                                        <button class="btn btn-success" type="button" name="qrt" id="qrt">qrt</button>
                                        <div class="ml-3">
                                            <h5>Total qrt</h5>
                                            <p class="mb-0" id="total_site">0</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card" style="text-align: center;">
                                        <button class="btn btn-secondary" type="button" name="panic"
                                            id="panic">panic</button>
                                        <div class="ml-3">
                                            <h5>Total panic</h5>
                                            <p class="mb-0" id="total_site">0</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card" style="text-align: center;">
                                        <button class="btn btn-warning" type="button" name="other"
                                            id="other">other</button>
                                        <div class="ml-3">
                                            <h5>Total other</h5>
                                            <p class="mb-0" id="total_site">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

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

<script>
function increaseCounter() {
    var currentValue = parseInt(document.getElementById("total_site").innerHTML);
   if(currentValue>=6){
	   alert("All Data Inserted Successfully.");
   }else{
		// Increase the value by 1
		var newValue = currentValue + 1;
		
		

		if (newValue >= 8) {
			// Reset the counter value
			newValue = 0;
			alert("Counter value has reached the threshold. Resetting to 0.");
		}

		// Update the display
		document.getElementById("total_site").innerHTML = newValue;

		// Send the value to another PHP page using Fetch API
		fetch('get_alert_type.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'total_site=' + newValue,
			})
			.then(response => response.text())
			.then(data => {
				console.log('Response from server:', data);
				// data.html(total_site);
				// Handle the response if needed
				location.reload();
			})
			.catch(error => {
				console.error('Error sending request:', error);
			});
   }

}

async function increaseCounter_data_1() {
	
    var currentValue = parseInt(document.getElementById("total_site_data").innerHTML);

    // Increase the value by 1
    var newValue = currentValue + 1;

    if (newValue >= 8) {
        // Reset the counter value
        newValue = 0;
        alert("Counter value has reached the threshold. Resetting to 0.");
    } 	
  const response = await fetch('/movies');
  const movies = await response.json();
  return movies;
}

 async function increaseCounter_data() {
	 
    var currentValue = parseInt(document.getElementById("total_site_data").innerHTML);
	
    if(currentValue>=6){
	     alert("All Data Inserted Successfully.");
    }else{
        $("#load").show();
		// Increase the value by 1
		var newValue = currentValue + 1;

		if (newValue >= 8) {
			// Reset the counter value
			newValue = 0;
			alert("Counter value has reached the threshold. Resetting to 0.");
		}

		// Update the display
		document.getElementById("total_site_data").innerHTML = newValue;

		// Send the value to another PHP page using Fetch API
		await fetch('get_alert_type_data.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'total_site=' + newValue,
			})
			.then(response => response.text())
			.then(data => { debugger;
				$("#load").hide();
				alert('Response from server:'+ data);
				// data.html(total_site);
				// Handle the response if needed
			})
			.catch(error => {
				console.error('Error sending request:', error);
			});
    }
}
</script>


</body>

</html>