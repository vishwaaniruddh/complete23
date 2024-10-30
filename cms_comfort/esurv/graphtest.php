<html>
<head>
<script src="graph/apexchart/apexcharts.min.js"></script>
</head>
<body>
<div class="card-body">


                            <div id="chart" width="500"    style="height: 340px;"></div>
                        </div>

<script>
   var options = {
            chart: {
                type: 'donut',
            },
            series: [44, 55, 41, 17, 15],
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
</script>


</body>
</html>