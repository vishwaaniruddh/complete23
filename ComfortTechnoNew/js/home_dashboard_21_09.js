
getPanel_Detail()
        function getPanel_Detail(){
	        var Client = 'Hitachi';
			var Bank = 'PNB';
			
			$("#load").show();
			$.ajax({
				url: "home_dashboard_ajax.php", 
				type: "POST",
				data: {client:Client,bank:Bank},
				success: (function (result) { 
				   $("#load").hide();
				   debugger;
				
				   console.log(result);
				   var obj = JSON.parse(result);
				   if(obj[0].code==200){
					   var total_site = obj[0].total_site;
					   $("#total_site").html(total_site);
					   var site_working = obj[0].site_working;
					   $("#site_working").html(site_working);
					   var site_notworking = obj[0].site_notworking;
					   $("#site_notworking").html(site_notworking);
					   
					   var ai_total_site = obj[0].ai_total_site;
					   $("#ai_total_site").html(ai_total_site);
					   var ai_site_working = obj[0].ai_site_working;
					   $("#ai_site_working").html(ai_site_working);
					   var ai_site_notworking = obj[0].ai_site_notworking;
					   $("#ai_site_notworking").html(ai_site_notworking);
					   
					   var hdd_fault = obj[0].hdd_fault;
					   $("#hdd_fault").html(hdd_fault);
					   
				   }
				})
		    });
		}  
		