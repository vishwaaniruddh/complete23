getDVR_Detail();

function getPanel_Detail() {
	var Client = 'Hitachi';
	var Bank = 'PNB';
    var atmid = '';
	var circle = '';
	//$("#load").show();
	$.ajax({
			url: "panelhealth_dashboard_ajax.php", 
			type: "POST",
			data: {client:Client,bank:Bank,atmid:atmid,circle:circle},
			success: (function (result) { debugger;
			  // $("#load").hide();
			   
			   console.log(result);
			   var obj = JSON.parse(result);
			   var panel_online_count = obj[0].panel_online_count;
			   if(panel_online_count>0){
				   var panelcounthtml = '<a target="_blank" href="panelstatuslist.php?client=Hitachi&bank=PNB&status=0">'+panel_online_count+'</a>';
				   $("#panel_online_count").html(panelcounthtml);
			   }else{
				   $("#panel_online_count").html(panel_online_count);
			   }
			   var panel_offline_count = obj[0].panel_offline_count;
			   if(panel_offline_count>0){
				   var offpanelcounthtml = '<a target="_blank" href="panelstatuslist.php?client='+Client+'&bank='+Bank+'&atmid='+atmid+'&circle='+circle+'&status=1">'+panel_offline_count+'</a>';
				   $("#panel_offline_count").html(offpanelcounthtml);
			   }else{
				   $("#panel_offline_count").html(panel_offline_count);
			   }
			   
			   getSite_Detail();
		    })
	});
	
	
}

function getDVR_Detail() { debugger;
	//var Client = 'Hitachi';
	var Client = $('#client_val').val();
	var Bank = $('#bank_val').val();
	//var Bank = 'PNB';
    var atmid = '';
	var circle = $('#circle_val').val();
	$("#load").show();
	$.ajax({
			//url: "dvrhealth_dashboard_ajax.php", 
			url: "networkreport_count_ajax_new.php",
			type: "POST",
			data: {client:Client,bank:Bank,atmid:atmid,circle:circle},
			success: (function (result) { debugger;
			  // $("#load").hide();
			   getSite_Detail();
			   console.log(result);
			   var obj = JSON.parse(result);
			   var dvr_online_count = obj[0].dvr_online_count;
			   if(dvr_online_count>0){
				   var dvrcounthtml = '<a target="_blank" href="dvrstatuslist.php?client='+Client+'&bank='+Bank+'&atmid='+atmid+'&circle='+circle+'&status=0">'+dvr_online_count+'</a>';
				   $("#dvr_online_count").html(dvrcounthtml);
			   }else{
				   $("#dvr_online_count").html(dvr_online_count);
			   }
			   var dvr_offline_count = obj[0].dvr_offline_count;
			   if(dvr_offline_count>0){
				   var offdvrcounthtml = '<a target="_blank" href="dvrstatuslist.php?client='+Client+'&bank='+Bank+'&atmid='+atmid+'&circle='+circle+'&status=1">'+dvr_offline_count+'</a>';
				   $("#dvr_offline_count").html(offdvrcounthtml);
			   }else{
				   $("#dvr_offline_count").html(dvr_offline_count);
			   }
			   
			   var panel_online_count = obj[0].panel_online_count;
			   if(panel_online_count>0){
				   var panelcounthtml = '<a target="_blank" href="panelstatuslist.php?client='+Client+'&bank='+Bank+'&atmid='+atmid+'&circle='+circle+'&status=0">'+panel_online_count+'</a>';
				   $("#panel_online_count").html(panelcounthtml);
			   }else{
				   $("#panel_online_count").html(panel_online_count);
			   }
			   var panel_offline_count = obj[0].panel_offline_count;
			   if(panel_offline_count>0){
				   var offpanelcounthtml = '<a target="_blank" href="panelstatuslist.php?client='+Client+'&bank='+Bank+'&atmid='+atmid+'&circle='+circle+'&status=1">'+panel_offline_count+'</a>';
				   $("#panel_offline_count").html(offpanelcounthtml);
			   }else{
				   $("#panel_offline_count").html(panel_offline_count);
			   }
		    })
	});
}



function getalerts_Detail() {
	var Client = 'Hitachi';
	var Bank = 'PNB';
    var user_id = $("#current_userid").val();
	//$("#load").show();
	$.ajax({
		url: "api/dvrdashboard_alerts_ajax_new_1.php",
		type: "POST",
		data: { client: Client, bank: Bank,user_id:user_id },
		success: (function (result) {
			console.log(result);
		})
	});
}	

function getSite_Detail() {
	var Client = $('#client_val').val();
	var Bank = $('#bank_val').val();
	//var Bank = 'PNB';
    var atmid = '';
	var Circle = $('#circle_val').val();
	var start = $('#start').val();
	var end = $('#end').val();

	//$("#load").show();
	$.ajax({
		url: "home_dashboard_ajax_new.php",
		type: "POST",
		data: { client: Client, bank: Bank, circle: Circle },
		success: (function (result) {
			$("#load").hide();
			debugger;
            
			console.log(result);
			var obj = JSON.parse(result);
			if (obj[0].code == 200) {
				var total_site = obj[0].total_site;
				
				if(total_site>0){
				  // var total_site_html = "<a href='sitestatuslist.php?status=All&client=Hitachi&bank=PNB'>"+total_site+"</a>";
				    var total_site_html = total_site;
				   $("#total_site").html(total_site_html);
				}
				
				var site_working = obj[0].site_working;
				if(site_working>0){
				//	var site_working_html = "<a target='_new' href='sitestatuslist.php?status=Online&client=Hitachi&bank=PNB'>"+site_working+"</a>";
					var site_working_html = site_working;
					$("#site_working").html(site_working_html);
				}
				
				var site_notworking = obj[0].site_notworking;
				if(site_notworking>0){
					// var site_notworking_html = "<a target='_new' href='sitestatuslist.php?status=Offline&client=Hitachi&bank=PNB'>"+site_notworking+"</a>";
					var site_notworking_html = site_notworking;
					$("#site_notworking").html(site_notworking_html);
				}
				
				var ai_total_site = obj[0].ai_total_site;
				if(ai_total_site>0){
					var ai_total_site_html = "<a target='_new' href='aisitestatuslist.php?status=All&client=Hitachi&bank=PNB'>"+ai_total_site+"</a>";
					$("#ai_total_site").html(ai_total_site_html);
				}
				
				var ai_site_working = obj[0].ai_site_working;
				if(ai_site_working>0){
					var ai_site_working_html = "<a target='_new' href='aisitestatuslist.php?status=Online&client=Hitachi&bank=PNB'>"+ai_site_working+"</a>";
					$("#ai_site_working").html(ai_site_working_html);
				}
				
				var ai_site_notworking = obj[0].ai_site_notworking;
				if(ai_site_notworking>0){
					var ai_site_notworking_html = "<a target='_new' href='aisitestatuslist.php?status=Offline&client=Hitachi&bank=PNB'>"+ai_site_notworking+"</a>";
					$("#ai_site_notworking").html(ai_site_notworking_html);
				}
				
				var hdd_fault = obj[0].hdd_fault;
				if(hdd_fault>0){
					var hdd_fault_html = "<a target='_new' href='hddstatuslist.php?status=All&client=Hitachi&bank=PNB'>"+hdd_fault+"</a>";
					$("#hdd_fault").html(hdd_fault_html);
				}
				
				var hdd_working = obj[0].hdd_working;
				if(hdd_working>0){
					var hdd_working_html = "<a target='_new' href='hddstatuslist.php?status=Close&client=Hitachi&bank=PNB'>"+hdd_working+"</a>";
					$("#hdd_working").html(hdd_working_html);
				}
				
				var hdd_notworking = obj[0].hdd_notworking;
				if(hdd_notworking>0){
					var hdd_notworking_html = "<a target='_new' href='hddstatuslist.php?status=Open&client=Hitachi&bank=PNB'>"+hdd_notworking+"</a>";
					$("#hdd_notworking").html(hdd_notworking_html);
				}
				
				var camera_fault = obj[0].camera_fault;
				if(camera_fault>0){
					var camera_fault_html = "<a target='_new' href='camerastatuslist.php?status=All&client=Hitachi&bank=PNB'>"+camera_fault+"</a>";
					$("#camera_fault").html(camera_fault_html);
				}
				
				var camera_working = obj[0].camera_working;
				if(camera_working>0){
					var camera_working_html = "<a target='_new' href='camerastatuslist.php?status=Close&client=Hitachi&bank=PNB'>"+camera_working+"</a>";
					$("#camera_working").html(camera_working_html);
				}
				
				var camera_notworking = obj[0].camera_notworking;
				if(camera_notworking>0){
					var camera_notworking_html = "<a target='_new' href='camerastatuslist.php?status=Open&client=Hitachi&bank=PNB'>"+camera_notworking+"</a>";
					$("#camera_notworking").html(camera_notworking_html);
				}
				
				var total_hkperson = obj[0].housekeeping_count;
				
				if(total_hkperson>0){
				   var total_hkperson_html = "<a href='attendancelist.php?status=hk&client=Hitachi&bank=PNB&start="+start+"&end="+end+"'>"+total_hkperson+"</a>";
				  //  var total_hkperson_html = total_hkperson;
				   $("#hk_person_count").html(total_hkperson_html);
				}
				
				var it_person_count = obj[0].itperson_count;
				if(it_person_count>0){
					var it_person_count_html = "<a href='attendancelist.php?status=it&client=Hitachi&bank=PNB&start="+start+"&end="+end+"'>"+it_person_count+"</a>";
				  // var it_person_count_html = it_person_count;
					$("#it_person_count").html(it_person_count_html);
				}
				
				var flm_engineer_count = obj[0].flmeng_count;
				if(flm_engineer_count>0){
					var flm_engineer_count_html = "<a href='attendancelist.php?status=eng&client=Hitachi&bank=PNB&start="+start+"&end="+end+"'>"+flm_engineer_count+"</a>";
					// var site_notworking_html = "<a target='_new' href='sitestatuslist.php?status=Offline&client=Hitachi&bank=PNB'>"+site_notworking+"</a>";
					//var flm_engineer_count_html = flm_engineer_count;
					$("#flm_engineer_count").html(flm_engineer_count_html);
				}
				
				var qrt_engineer_count = obj[0].qrteng_count;
				if(qrt_engineer_count>0){
					var qrt_engineer_count_html = "<a href='attendancelist.php?status=qrt&client=Hitachi&bank=PNB&start="+start+"&end="+end+"'>"+qrt_engineer_count+"</a>";
					//var qrt_engineer_count_html = qrt_engineer_count;
					$("#qrt_person_count").html(qrt_engineer_count_html);
				}
				/*
				var panic_engineer_count = obj[0].paniceng_count;
				if(panic_engineer_count>0){
					var panic_engineer_count_html = "<a href='attendancelist.php?status=panic&client=Hitachi&bank=PNB&start="+start+"&end="+end+"'>"+panic_engineer_count+"</a>";
					
					$("#panel_switch_count").html(panic_engineer_count_html);
				} */
				
				var other_engineer_count = obj[0].othereng_count;
				if(other_engineer_count>0){
					var other_engineer_count_html = "<a href='attendancelist.php?status=other&client=Hitachi&bank=PNB&start="+start+"&end="+end+"'>"+other_engineer_count+"</a>";
					//var other_engineer_count_html = other_engineer_count;
					$("#other_person_count").html(other_engineer_count_html);
				}
				
				
				
				
				
			//	createChart(site_working, site_notworking);
			//	createaiChart(ai_site_working, ai_site_notworking);
			//	createhddChart(hdd_working, hdd_notworking);
			}
			
			//sendEmailDVRAlerts();
            insertCallLogDVRAlerts();
            //getalerts_Detail();
			insertCallLogCameraAlerts();
		})
	});
}

function insertCallLogDVRAlerts(){
	$.ajax({
		url: "call_log_email_dvralerts_ajax.php",
		type: "GET",
		success: (function (result) { debugger;
			var obj = JSON.parse(result);
			if (obj[0].code == 200) {
			 // sendEmailDVRAlerts();
			  
			}
		})
	});
}

function insertCallLogCameraAlerts(){
	$.ajax({
		url: "call_log_email_camera_alerts_ajax.php",
		type: "GET",
		success: (function (result) { debugger;
			var obj = JSON.parse(result);
			if (obj[0].code == 200) {
			 // sendEmailDVRAlerts();
			  
			}
		})
	});
}

function sendEmailDVRAlerts(){
	$.ajax({
		url: "mailexcel.php",
		type: "GET",
		success: (function (result) { debugger;
			
		})
	});
}

function createChart(site_working, site_notworking) {

	Highcharts.chart('container', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: true,
			type: 'pie'
		},
		title: {
			text: 'Total Sites Online & Offline',
			align: 'left'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				}
			}
		},
		series: [{
			name: 'Sites',
			colorByPoint: true,
			data: [{
				name: 'Online',
				y: site_working,
				sliced: true,
				color: '#00FF00'

			}, {
				name: 'Offline',
				y: site_notworking,
				color: '#ff0000'
			}]
		}]
	});
}

function createaiChart(ai_site_working, ai_site_notworking) {
	var c3PieChart = c3.generate({
		bindto: '#c3-pie-chart',
		data: {
			// iris data from R
			columns: [
				['Online', ai_site_working],
				['Offline', ai_site_notworking],
			],
			type: 'pie',
			onclick: function (d, i) {
				console.log("onclick", d, i);
			},
			onmouseover: function (d, i) {
				console.log("onmouseover", d, i);
			},
			onmouseout: function (d, i) {
				console.log("onmouseout", d, i);
			}
		},
		color: {
			pattern: ['#00FF00', '#FF0000']
		},
		padding: {
			top: 0,
			right: 0,
			bottom: 30,
			left: 0,
		},
		title: {
			text: 'Total AI Sites Online & Offline', // Specify the chart title
			position: 'top-center',
			// fontSize: 16,
			style: {
				'font-weight': 'bold', // Make the title bold
				'font-size': '20px' // Set the font size as needed
			}
		},
	});

	// setTimeout(function () {
	// 	c3PieChart.load({
	// 		columns: [
	// 			['Online', ai_site_working],
	// 			['Offline', ai_site_notworking],
	// 			// ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
	// 		]
	// 	});
	// }, 600000);

	setTimeout(function () {
		c3PieChart.unload({
			ids: 'Online'
		});
		c3PieChart.unload({
			ids: 'Offline'
		});
	}, 720000);
}
function createhddChart(hdd_working, hdd_notworking) {


	var PieData = {
		datasets: [{
			data: [0, 0],
			backgroundColor: [
				'rgba(0, 255, 0, 0.5)',
				'rgba(255, 0, 0, 0.5)',
			],
			borderColor: [
				'rgba(0, 255, 0, 1)',
				'rgba(255,0,0,1)',
			],
		}],

		// These labels appear in the legend and in the tooltips when hovering different arcs
		labels: [
			'Work in Progress',
			'Close',

		]
	};
	var PieOptions = {
		responsive: true,
		title: {
			display: true,
			text: 'HDD Online & Offline',
			fontSize: 20, // You can adjust the font size as needed
			// position: 'top-center',

		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	};
	// Use Chart.js to create/update the chart using chartData
	// Example code for creating a Chart.js chart:
	var ctx = document.getElementById('pieChart').getContext('2d');

	var chart = new Chart(ctx, {
		// Configure the chart type, data, and options based on chartData
		type: 'pie',
		data: PieData,
		options: PieOptions
	});


}

