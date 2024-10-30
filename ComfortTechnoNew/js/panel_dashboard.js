
$("#show_detail").click(function(){  debugger;
	getDVR_Detail();
	
})

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
			   $("#load").hide();
			   
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
			   
			  // getSite_Detail();
		    })
	});
	
	
}

function getDVR_Detail() {
	var Client = 'Hitachi';
	var Bank = 'PNB';
    var atmid = $('#AtmID').val();
	var circle = $('#Circle').val();
	$("#load").show();
	$.ajax({
			//url: "dvrhealth_dashboard_ajax.php", 
			url: "networkreport_count_ajax_new.php",
			type: "POST",
			data: {client:Client,bank:Bank,atmid:atmid,circle:circle},
			success: (function (result) { debugger;
			   $("#load").hide();
			 //  getSite_Detail();
			   console.log(result);
			   var obj = JSON.parse(result);
			   
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

function getPanel_Detail(){
			var Client = $("#Client").val();
			var AtmID = $("#AtmID").val();
			$('#dvr_recording_list').html('');
			$('#total_space').html('');
		    $('#free_space').html('');
		    $('#used_space').html('');
			$('#dvr_status').css('display','none');
			$('#dvrlogin_status').css('display','none');
			if(Client==''){
				swal("Oops!", "Client Must Required !", "error");
				return false;
			}
			if(AtmID==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			$.ajax({
				url: "panel_dashboard_dvrdata.php", 
				type: "POST",
				data: {client:Client,atmid:AtmID},
				success: (function (result) { debugger;
				   console.log(result);
				   var obj = JSON.parse(result);
				   var login_status = obj.login_status;
				   var Capacity = obj.capacity;
				   var FreeSpace = obj.freespace;
				   var recording_from = obj.recording_from;
				   var recording_to = obj.last_communication;
				 //  var recording_to = obj.recording_to;
				   if(recording_from!=''){
					  recording_from = recording_from.replace("T", " ");
					  recording_from = recording_from.replace("Z", " ");
				   }
				   if(recording_to!=''){
					  recording_to = recording_to.replace("T", " ");
					  recording_to = recording_to.replace("Z", " ");
					  
				   }
				   
				   if(login_status==0){
					   $('#dvr_status').css('display','block');
					   $('#dvrlogin_status').css('display','none');
				   }else{
					   $('#dvr_status').css('display','none');
					   $('#dvrlogin_status').css('display','block');
				   }
				   
				 //  recording_to = "2021-03-13 12:00:00";
				   if(Capacity!='' && FreeSpace!=''){
					   Capacity = Capacity/1024;
					   FreeSpace = FreeSpace/1024;
					   var UsedSpace = Capacity - FreeSpace;
					   $('#total_space').html('');
					   $('#free_space').html('');
					   $('#used_space').html('');
					   Capacity = Capacity.toFixed(2);
					   Capacity = Capacity+" GB";
					   FreeSpace = FreeSpace.toFixed(2);
					   FreeSpace = FreeSpace+" GB";
					   UsedSpace = UsedSpace.toFixed(2);
					   UsedSpace = UsedSpace+" GB";
					   $('#total_space').html(Capacity);
					   $('#free_space').html(FreeSpace);
					   $('#used_space').html(UsedSpace);
				   }
				   
				   if(recording_from!='' && recording_to!=''){
					    var date1 = new Date(recording_from);
						var date2 = new Date(recording_to);
						  
						// To calculate the time difference of two dates
						var Difference_In_Time = date2.getTime() - date1.getTime();
						  
						// To calculate the no. of days between two dates
						var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
						Difference_In_Days = parseInt(Difference_In_Days);
				   }
				   
				   var html = "<tr>";
				   html += "<td>1</td><td>"+recording_from+"</td><td>"+recording_to+"</td><td>"+Difference_In_Days+"</td></tr>";
				   html += "<tr><td>2</td><td>"+recording_from+"</td><td>"+recording_to+"</td><td>"+Difference_In_Days+"</td></tr>";
				   html += "<tr><td>3</td><td>"+recording_from+"</td><td>"+recording_to+"</td><td>"+Difference_In_Days+"</td></tr>";
				   html += "<tr><td>4</td><td>"+recording_from+"</td><td>"+recording_to+"</td><td>"+Difference_In_Days+"</td>";
				   html += '</tr>';
				   $('#dvr_recording_list').html('');
				   $('#dvr_recording_list').html(html);
				   
				})
		    });
		}

function get_panelcommunication()
{ 
   var Atmid= $("#AtmID").val(); 
   var start= $("#start").val(); 
   var end= $("#end").val(); 
   
	if(Atmid=='')
	{
		//swal("Oops!", "AtmID Must Required !", "error");
		return false;
	}
	$.ajax({
		url: "panel_communication_ajax.php", 
		type: "GET",
		data: {atmid:Atmid,start:start,end:end},
		dataType: "html", 
		success: (function (result) { debugger;
		   console.log(result);
		 
		   $('#order-listing').dataTable().fnClearTable();

			$('#ticketview_tbody').html('');
			$('#ticketview_tbody').html(result); 
			
			
			//$('#order-listing').DataTable().ajax.reload(); 
				
			//    $('#order-listing').dataTable().fnDestroy();
			$('#order-listing').DataTable();
		})
	});
}

