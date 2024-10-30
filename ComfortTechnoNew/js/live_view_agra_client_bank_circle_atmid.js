   setOnload();

   function setOnload(){
		var client = "Hitachi"; 
		var bank = "PNB"; 
		
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		/*
		$.ajax({
			type: "GET",
			url: "getMasterData.php", 
			data: {clientname:client,bankname:bank},
			dataType: "html",
			success: (function (result) { debugger;
				$("#AtmID").html('');
				$("#AtmID").html(result);
				var selected_atmid = $("#pass_atmid").val();
				if(selected_atmid!=''){
	           
				$("#AtmID").select2("trigger", "select", {
                        data: { id: selected_atmid, text: selected_atmid }
                    });
				}
			})
		}) */
		//setcircleonload();
		onchangeatmid();
	}
	
	function setcircleonload() { 
		var bank = 'PNB';
		//$("#online_percent_table_load").show();
		$("#Circle").html('');
		$("#Circle").html('<option value="">All Circle</option>');
		//$("#AtmID").html('');
		//$("#AtmID").html('<option value="">All Site</option>');
		if(bank=='PNB'){
			
			
			$.ajax({
				type: "GET",
				url: "getMasterData.php", 
				data: {bankcircle:bank},
				dataType: "html",
				success: (function (result) { debugger;
					$("#Circle").html('');
					$("#Circle").html(result);
				//	getPanel_Detail();
					
				})
			})
		}
		
	}

    function setOnload_Prev(){
		
        $("#Client").val('Hitachi');
		var client = "Hitachi"; 
		$("#Bank").html('');
		$("#Bank").html('<option value="">Select</option>');
		$("#Circle").html('');
		$("#Circle").html('<option value="">All Circle</option>');
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		$.ajax({
			type: "GET",
			url: "getMasterData.php", 
			data: {client:client},
			dataType: "html",
			success: (function (result) {
				$("#Bank").html('');
				$("#Bank").html(result);
			//	getPanel_Detail();
	            $("#Bank").val('PNB');
				onchangecircle();
			})
		})
	}
	
    function onchange_atmid() { debugger;
		var bank = $("#Bank").val();
		var client = $("#Client").val();
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		$.ajax({
			type: "GET",
			url: "getMasterData.php", 
			data: {bankname:bank,clientname:client},
			dataType: "html",
			success: (function (result) { debugger;
				$("#AtmID").html('');
				$("#AtmID").html(result);
				//$("#load").show();
			//	getPanel_Detail();
			    
			})
		})
	}
	function onchangeatmid() { debugger;
	    var circle = $("#Circle").val(); //alert(circle);
		var bank = 'PNB';
		
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		$.ajax({
			type: "GET",
			url: "getMasterData.php", 
			data: {circlebankname:bank,circlename:circle},
			dataType: "html",
			success: (function (result) { debugger;
				$("#AtmID").html('');
				$("#AtmID").html(result);
				//$("#load").show();
			//	getPanel_Detail();
	           
			})
		})
	}
function onchangebank() { 
		var client = $("#Client").val();
		//$("#online_percent_table_load").show();
		$("#Bank").html('');
		$("#Bank").html('<option value="">Select</option>');
		$("#Circle").html('');
		$("#Circle").html('<option value="">All Circle</option>');
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		$.ajax({
			type: "GET",
			url: "getMasterData.php", 
			data: {client:client},
			dataType: "html",
			success: (function (result) {
				$("#Bank").html('');
				$("#Bank").html(result);
			//	getPanel_Detail();
	            
			})
		})
	}	
function onchangecircle() { 
		var bank = $("#Bank").val();
		//$("#online_percent_table_load").show();
		$("#Circle").html('');
		$("#Circle").html('<option value="">All Circle</option>');
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		if(bank=='PNB'){
			
			
			$.ajax({
				type: "GET",
				url: "getMasterData.php", 
				data: {bankcircle:bank},
				dataType: "html",
				success: (function (result) { debugger;
					$("#Circle").html('');
					$("#Circle").html(result);
				//	getPanel_Detail();
					
				})
			})
		}
		onchange_atmid();
	}	
	
	function onchangecircleonload() { 
		var bank = $("#Bank").val();
		//$("#online_percent_table_load").show();
		$("#Circle").html('');
		$("#Circle").html('<option value="">All Circle</option>');
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		if(bank=='PNB'){
			
			
			$.ajax({
				type: "GET",
				url: "getMasterData.php", 
				data: {bankcircle:bank},
				dataType: "html",
				success: (function (result) { debugger;
					$("#Circle").html('');
					$("#Circle").html(result);
				//	getPanel_Detail();
					
				})
			})
		}
		onchange_atmid();
	}
	


