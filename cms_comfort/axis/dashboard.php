<?php include ('header.php');
if(isset($_SESSION['login_user']) && isset($_SESSION['id'])){
   

?>

<script src="graph/apexchart/apexcharts.min.js"></script>
<body>
    <?php include('menu.php');?>
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title --->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Highdmin</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Report</h4>

                            <div class="row">
                                <div class="col-md-6  col-xl-3">
                                    <div class="card-box mb-0 widget-flat border-custom bg-custom text-white" style="padding-bottom: 0px;">
                                        <div class="float-right">
                                            <?php 
                                            $Tcnt=mysqli_query($conn,"select count(*) as Tcnt from panel_health ");
                                            $fetchTcnt=mysqli_fetch_array($Tcnt);
                                            
                                            $cnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon3='0' and panelName='Rass' and status='0' ");
                                            $fetchCnt=mysqli_fetch_array($cnt);
                                            
                                            $Notcnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon3='1' and panelName='Rass' and status='0' ");
                                            $fetchNotCnt=mysqli_fetch_array($Notcnt);
                                            
                                            $Discnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon3='2' and panelName='Rass' and status='0' ");
                                            $fetchDisCnt=mysqli_fetch_array($Discnt);
                                            
                                            $ByPasscnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon3='9' and panelName='Rass' and status='0' ");
                                            $fetchByPassCnt=mysqli_fetch_array($ByPasscnt);
                                            
                                            $percnt= ($fetchCnt['cnt'] / $fetchTcnt['Tcnt']) * 100;
                                            ?>
                                           <!-- <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#027320" value="<?php echo round($percnt);?>" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>-->
                                        </div>
                                        <div class="widget-chart-two-content ">
                                            <p class="text-white mb-0 mt-2">Panic </p>
                                            <h3 class=""><?php echo $fetchCnt['cnt']; ?> / <?php echo $fetchNotCnt['cnt']; ?> / <?php echo $fetchDisCnt['cnt']; ?> / <?php echo $fetchByPassCnt['cnt']; ?></h3>
                                            <p class="text-white mb-0 mt-2">Conn / NotConn / DisConn / ByPass</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6  col-xl-3">
                                    <div class="card-box mb-0 bg-primary widget-flat border-primary text-white" style="padding-bottom: 0px;">
                                        <div class="float-right">
                                             <?php 
                                            $Tcnt=mysqli_query($conn,"select count(*) as Tcnt from panel_health ");
                                            $fetchTcnt=mysqli_fetch_array($Tcnt);
                                            
                                            $cnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon2='0' and panelName='Rass' and status='0' ");
                                            $fetchCnt=mysqli_fetch_array($cnt);
                                            
                                            $Notcnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon2='1' and panelName='Rass' and status='0' ");
                                            $fetchNotCnt=mysqli_fetch_array($Notcnt);
                                            
                                            $Discnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon2='2' and panelName='Rass' and status='0' ");
                                            $fetchDisCnt=mysqli_fetch_array($Discnt);
                                            
                                            $ByPasscnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon2='9' and panelName='Rass' and status='0' ");
                                            $fetchByPassCnt=mysqli_fetch_array($ByPasscnt);
                                            
                                            $percnt= ($fetchCnt['cnt'] / $fetchTcnt['Tcnt']) * 100;
                                            ?>
                                           <!-- <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#f9bc0b" value="<?php echo round($percnt);?>" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>-->
                                        </div>
                                        <div class="widget-chart-two-content">
                                            <p class="text-white mb-0 mt-2">Glass Break</p>
                                            <h3 class=""><?php echo $fetchCnt['cnt']; ?> / <?php echo $fetchNotCnt['cnt']; ?> / <?php echo $fetchDisCnt['cnt']; ?> / <?php echo $fetchByPassCnt['cnt']; ?></h3>
                                            <p class="text-white mb-0 mt-2">Conn / NotConn / DisConn / ByPass</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6  col-xl-3">
                                    <div class="card-box mb-0 widget-flat border-success bg-success text-white" style="padding-bottom: 0px;">
                                        <div class="float-right">
                                             <?php 
                                            $Tcnt=mysqli_query($conn,"select count(*) as Tcnt from panel_health ");
                                            $fetchTcnt=mysqli_fetch_array($Tcnt);
                                            
                                            $cnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon1='0' and panelName='Rass' and status='0'");
                                            $fetchCnt=mysqli_fetch_array($cnt);
                                            
                                            $Notcnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon1='9' and panelName='Rass' and status='0'");
                                            $fetchNotCnt=mysqli_fetch_array($Notcnt);
                                            
                                            $Discnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon1='2' and panelName='Rass' and status='0'");
                                            $fetchDisCnt=mysqli_fetch_array($Discnt);
                                            
                                            
                                            
                                            $percnt= ($fetchCnt['cnt'] / $fetchTcnt['Tcnt']) * 100;
                                            ?>
                                           <!-- <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#f1556c" value="<?php echo round($percnt);?>" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>-->
                                        </div>
                                        <div class="widget-chart-two-content">
                                            <p class="text-white mb-0 mt-2">Motion</p>
                                            <h3 class=""><?php echo $fetchCnt['cnt']; ?> / <?php echo $fetchDisCnt['cnt']; ?> / <?php echo $fetchNotCnt['cnt']; ?></h3>
                                            <p class="text-white mb-0 mt-2">Conn / DisConn / ByPass</p>                                    
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6  col-xl-3">
                                    <div class="card-box mb-0 bg-danger widget-flat border-danger text-white" style="padding-bottom: 0px;">
                                        <div class="float-right">
                                            <?php 
                                            $Tcnt=mysqli_query($conn,"select count(*) as Tcnt from panel_health ");
                                            $fetchTcnt=mysqli_fetch_array($Tcnt);
                                            
                                            $cnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon25='0' and panelName='Rass' and status='0'");
                                            $fetchCnt=mysqli_fetch_array($cnt);
                                            
                                            $Notcnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon25='1' and panelName='Rass' and status='0'");
                                            $fetchNotCnt=mysqli_fetch_array($Notcnt);
                                            
                                            $Discnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon25='2' and panelName='Rass' and status='0'");
                                            $fetchDisCnt=mysqli_fetch_array($Discnt);
                                            
                                            $ByPasscnt=mysqli_query($conn,"select count(*) as cnt from panel_health WHERE zon25='9' and panelName='Rass' and status='0'");
                                            $fetchByPassCnt=mysqli_fetch_array($ByPasscnt);
                                            
                                            $percnt= ($fetchCnt['cnt'] / $fetchTcnt['Tcnt']) * 100;
                                            ?>
                                           <!-- <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#2d7bf4" value="<?php echo round($percnt);?>" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>-->
                                        </div>
                                        <div class="widget-chart-two-content">
                                            <p class="text-white mb-0 mt-2">Back Room</p>
                                            <h3 class=""><?php echo $fetchCnt['cnt']; ?> / <?php echo $fetchNotCnt['cnt']; ?> / <?php echo $fetchDisCnt['cnt']; ?> / <?php echo $fetchByPassCnt['cnt']; ?></h3>
                                            <p class="text-white mb-0 mt-2">Conn / NotConn / DisConn / ByPass</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
                <!-- end row -->



                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-box">
                            <h4 class="header-title">Panel / DVR</h4>

                          <!--  <div id="website-stats" style="height: 350px;" class="flot-chart mt-5"></div>-->
                            <div id="bar01-chart">
                                 <div id="chart-bar01" width="300"    style="height: 340px;"></div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card-box">
                          <div class="row"><div class="col-md-2"><h4 class="header-title" id="totL">  Live :</h4></div><div class="col-md-3"> <h4 class="header-title" id="totP"> Pending :</h4></div><div class="col-md-3"> <h4 class="header-title" id="totD"> Dismental :</h4></div><div class="col-md-4"> <h4 class="header-title" id="tot">Total Sites:</h4>  </div></div>
                            <!--<div id="combine-chart">
                                <div id="combine-chart-container" class="flot-chart mt-5" style="height: 350px;">
                                </div>
                            </div>-->
                            
                            <div id="bar02-chart">
                                 <div id="chart-bar02" width="300"    style="height: 340px;"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-xl-8">
                        <div class="card-box">
                            <h4 class="header-title mb-3">Panel sites</h4>


                             <div id="bar03-chart">
                                 <div id="chart-bar03" width="300"    style="height: 340px;"></div>
                            </div>

                           
                        </div>

                    </div>

                    <div class="col-xl-4">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">DVR Sites </h4>


                            <div id="donut-chart">
                                <!--<div id="donut-chart-container" class="flot-chart mt-5" style="height: 340px;">
                                </div>-->
                                 <div id="chart" width="300"    style="height: 340px;"></div>
                            </div>
                           <!-- <div id="donut-chart">
                                <div id="chartaxis" width="300"    ></div>
                            </div>-->

                        </div>

                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


      <?php include('footer.php'); ?>


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>

        <!-- Flot chart -->
        <script src="../plugins/flot-chart/jquery.flot.min.js"></script>
        <script src="../plugins/flot-chart/jquery.flot.time.js"></script>
        <script src="../plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="../plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="../plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="../plugins/flot-chart/jquery.flot.crosshair.js"></script>
        <script src="../plugins/flot-chart/curvedLines.js"></script>
        <script src="../plugins/flot-chart/jquery.flot.axislabels.js"></script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="../plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="../plugins/jquery-knob/jquery.knob.js"></script>

        <!-- Dashboard Init -->
        <script src="assets/pages/jquery.dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


<script>

graph();
          function graph(){
                  
                    $.ajax({
                    type:'POST',
                    url:'getSiteDetails_Dashboard.php',
                     data:'',
                     
                    success:function(msg){
                      var SiteCnt=[];
                      
                       var jsr=JSON.parse(msg);
                     
                          SiteCnt.push(parseInt(jsr[0]["CountLetency"]));
                          SiteCnt.push(parseInt(jsr[0]["DvrNotLogin"]));
                          SiteCnt.push(parseInt(jsr[0]["DvrStatusOk"]));
                           
                      
   


   var options = {
            chart: {
                type: 'donut',
                width: 390,
            },
            series: SiteCnt,
           labels: ['Latency Very High', 'DVR  Not Login', 'DVR Status OK'],
           fill: {
                type: 'gradient' 
     
            },
           legend: {
                formatter: function(val, opts) {
                    return val + " - " + opts.w.globals.series[opts.seriesIndex]
                }
            },
    
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 10
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }



       var chart = new ApexCharts(
            document.querySelector("#chart"),
            options
        );
       

        chart.render();
                    }
           });
          }
          
          
          
          
graphaxis();
          function graphaxis(){
                  
                    $.ajax({
                    type:'POST',
                    url:'getSiteDetails_Dashboard.php',
                     data:'',
                     
                    success:function(msg){
                      var SiteCnt=[];
                      
                       var jsr=JSON.parse(msg);
                     
                          SiteCnt.push(parseInt(jsr[0]["CountLetency"]));
                          SiteCnt.push(parseInt(jsr[0]["DvrNotLogin"]));
                          SiteCnt.push(parseInt(jsr[0]["DvrStatusOk"]));
                           
                      
   


   var options = {
            chart: {
                type: 'donut',
                width: 390,
            },
            series: SiteCnt,
           labels: ['Latency Very High', 'DVR  Not Login', 'DVR Status OK'],
           fill: {
                type: 'gradient' 
     
            },
           legend: {
                formatter: function(val, opts) {
                    return val + " - " + opts.w.globals.series[opts.seriesIndex]
                }
            },
    
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 10
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }



       var chart = new ApexCharts(
            document.querySelector("#chartaxis"),
            options
        );
       

        chart.render();
                    }
           });
          }
</script>

<script>
graph2();
            function graph2(){
                  
                    $.ajax({
                    type:'POST',
                    url:'getSiteDetails_Dashboard2.php',
                     data:'',
                     
                    success:function(msg){
                       // alert(msg);
                     
                      
                      
                       var SiteDate=[];
                       var LiveSiteCnt=[];
                       var PendingSiteCnt=[];
                       var DismentalSiteCnt=[];
                       var TotalSiteCnt=[];
                       
                       
                       var jsr=JSON.parse(msg);
                    $('#tot').append(' '+jsr[0]["T"]);
                    $('#totL').append(' '+jsr[0]["LiveSiteCount"]);
                    $('#totP').append(' '+jsr[0]["PendingSiteCount"]);
                    $('#totD').append(' '+jsr[0]["TotalDismentalCount"]);
                     
                      
                      for(var i=0;i<jsr.length;i++){
                            
                            SiteDate.push(jsr[i]["sitedate"]);
                            LiveSiteCnt.push(parseInt(jsr[i]["LiveSiteCount"]));
                            PendingSiteCnt.push(parseInt(jsr[i]["PendingSiteCount"]));
                            DismentalSiteCnt.push(parseInt(jsr[i]["TotalDismentalCount"]));
                            TotalSiteCnt.push(parseInt(jsr[i]["TotalSiteCount"]));
                        
                       }
                     
                     
                        
                           

    var options = {
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '100%',
                    endingShape: 'rounded'	
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Total Live',
                data: LiveSiteCnt
            }, {
                name: 'Total Pending',
                data: PendingSiteCnt
            }, {
                name: 'Total Dismental',
                data: DismentalSiteCnt
            }, {
                name: 'Total Site',
                data: TotalSiteCnt
                
            }],
            
            xaxis: {
                categories: SiteDate,
            },
            yaxis: {
                title: {
                   // text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1

            },
             tooltip: {
                y: {
                    formatter: function (val) {
                     //   return "$ " + val + " thousands"
                     return  val 
                 }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-bar02"),
            options
        );

        chart.render();
        
        
                    }
           });
          }
</script>


<script>
 graph3();
function graph3(){
                  
                    $.ajax({
                    type:'POST',
                    url:'getpanelDvr.php',
                     data:'',
                     
                    success:function(msg){
                     //  alert(msg);
                     var datavalue=[];
                      var jsr=JSON.parse(msg);
                   
                           datavalue.push(parseInt(jsr[0]["Rass"]));
                            datavalue.push(parseInt(jsr[0]["SMART"]));
                            datavalue.push(parseInt(jsr[0]["SEC"]));
                            datavalue.push(parseInt(jsr[0]["Hikvision"]));
                            datavalue.push(parseInt(jsr[0]["CPPLUS"]));
                             datavalue.push(parseInt(jsr[0]["Dahuva"]));
                      
                     
                     
                        

    var options = {
      annotations: {
        points: [{
          x: 'Smart-I',
          seriesIndex: 0,
          label: {
            borderColor: '#775DD0',
            offsetY: 0,
            style: {
              color: '#fff',
              background: '#775DD0',
            },
            //text: 'Bananas are good',
          }
        }]
      },
      chart: {
        height: 350,
        type: 'bar',
      },
      plotOptions: {
        bar: {
          columnWidth: '40%',
          endingShape: 'rounded'	
        }
      },
      dataLabels: {
        enabled: true
      },
      stroke: {
        width: 2
      },
      series: [{
        name: 'Total',
       data: datavalue
      }],
      grid: {
        row: {
          colors: ['#fff', '#f2f2f2']
        }
      },
      xaxis: {
        labels: {
          rotate: -45
        },
        categories: ['Rass', 'Smart-I', 'Securico', 'Hikvision', 'CPPLUS', 'Dahuva'],
          
        
      },
      yaxis: {
        title: {
          text: 'Total',
        },

      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: "horizontal",
          shadeIntensity: 0.25,
          gradientToColors: undefined,
          inverseColors: true,
          opacityFrom: 0.85,
          opacityTo: 0.85,
          stops: [50, 0, 100]
        },
      },

    }

    var chart = new ApexCharts(
      document.querySelector("#chart-bar01"),
      options
    );

    chart.render();
    
                    }
           });
          }
  
</script>


<script>
graph4();
            function graph4(){
                  
                    $.ajax({
                    type:'POST',
                    url:'getpanelDetails_Dashboard2.php',
                     data:'',
                     
                    success:function(msg){
                       // alert(msg);
                     
                      
                      
                       var RassPanelconn=[];
                       var RassPanelNotconn=[];
                       
                       
                       var jsr=JSON.parse(msg);
                   
                      
                      for(var i=0;i<jsr.length;i++){
                            
                            RassPanelconn.push(parseInt(jsr[i]["RassConnected"]));
                            RassPanelNotconn.push(parseInt(jsr[i]["RassDisconnected"]));
                            RassPanelconn.push(parseInt(jsr[i]["SmartConn"]));
                            RassPanelNotconn.push(parseInt(jsr[i]["SmartDis"]));
                            RassPanelconn.push(parseInt(jsr[i]["SecConn"]));
                            RassPanelNotconn.push(parseInt(jsr[i]["SecDis"]));
                           
                        
                       }
                     
                     
                        
                     

     var options = {
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
                stackType: '100%'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            series: [{
                name: 'Connected',
                data: RassPanelconn
           
            },{
                name: 'Disconnected',
                data: RassPanelNotconn
            }],
            xaxis: {
                categories: ['RASS', 'Smart-I', 'Securico'],
            },
            fill: {
                opacity: 1
            },
            
            legend: {
                position: 'right',
                offsetX: 0,
                offsetY: 50
            },
        }

       var chart = new ApexCharts(
            document.querySelector("#chart-bar03"),
            options
        );
        
        chart.render();
                    }
           });
          }
</script>

    </body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>

