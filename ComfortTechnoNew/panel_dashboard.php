<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
   // include('config.php');
    ?>
	<!-- Video.j -->
	<!--<link href="vendors/video-js/video-js.css" rel="stylesheet"/>-->
	<!-- /Video.j -->
	  
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
			overflow-y: scroll;*/
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
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                 <div class="main-panel">
                    <div class="content-wrapper">
					    <div class="col-12 grid-margin">
                         <h3 class="card-title">Dashboard As on Date : <?php echo date('d/m/Y');?></h3> 
						 <?php include('filters/sitehealth_filter.php');?>
                          <?php  //include('filters/panel_dashboard_filter.php');
						       //  include('filters/sitehealth_filter.php');
						  ?>
						</div>  
						  <?php // include('panel/panel_dashboard_details.php');?>
						  <?php //include('panel/sensor_alarm_dvr_status.php');?>
						  <?php //include('panel/sensor_remote_panel_status.php');?> 
						  <?php // include('panel/panel_escalation_matrix.php');?>
						  <?php //include('panel/dvr_sensor_alarm_status.php');?>
						   <?php //include('panel/panel_communication_table.php');?>
						   
						   <div class="row form-group" >
						      <div class="col-md-3 grid-margin">
									<div class="card">
										<div class="card-body">
											<h6 class="card-title mb-0">Panel online</h6>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-inline-block pt-3">
													<div class="d-md-flex">
														<h3 class="mb-0" id="panel_online_count">0</h3>
														
													</div>
													<!-- <small class="text-gray">Raised from 89 orders.</small> -->
												</div>
												<div class="d-inline-block">
													<i class="fas fa-solar-panel text-success icon-lg"></i>                                    
												</div>
											</div>
										</div>
									</div>
								</div>
								 
								 <div class="col-md-3 grid-margin">
									<div class="card">
										<div class="card-body">
											<h6 class="card-title mb-0">Panel Offline</h6>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-inline-block pt-3">
													<div class="d-md-flex">
														<h3 class="mb-0" id="panel_offline_count">0</h3>
														
													</div>
													<!-- <small class="text-gray">Raised from 89 orders.</small> -->
												</div>
												<div class="d-inline-block">
													<i class="fas fa-solar-panel text-danger icon-lg"></i>                                    
												</div>
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
            
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
		<!--<script src="js/ai_sites_client_bank_circle_atmid.js"></script>-->
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/data-table.js"></script>
		<script src="js/data-table2.js"></script>
		<script src="js/data-table3.js"></script>
        <script src="js/select2.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
        
        <script src="js/panel_dashboard.js"></script>

<?php 


function status($status)
{
    $sql=mysqli_query($con,"select * from sites where status='".$status."'");
    $sql_result = mysqli_fetch_assoc($sql);

    return sql_result['sites'];

}

?>

<!-- Modal starts -->
                  
                  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Live View</h5>
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
				  
		<script>
             $(document).on("click", ".large-modal", function () { debugger;
					 var Id = $(this).data('id');
					  $.ajax({    
						type: "GET",
						url: "ticket_history_details.php?id="+Id,             
						dataType: "html",   //expect html to be returned                
						success: function(response){            debugger;         
							$(".modal-body #result_status").html(response); 
							//alert(response);
						}
					 });
				});
        </script>		
				  
    </body>
</html>


