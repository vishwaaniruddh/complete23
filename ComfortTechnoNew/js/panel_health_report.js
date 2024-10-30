function onload()
{
  //  get_ticketview();
}
$("#portal").change(function(){ debugger;
	get_ticketview();
});
$("#show_detail").click(function(){

    get_ticketview();
});

/*
function get_ticketview()
{  debugger;
   var Atmid= $("#AtmID").val(); 
   var Client= $("#Client").val();
    var Bank= $("#Bank").val(); 
	var Circle = $('#Circle').val();
	$('#ticketview_tbody').html('');
    
	
    $.ajax({
        url: "panel_health_data_report.php", 
        type: "GET",
        data: {atmid:Atmid,bank:Bank,client:Client,circle:Circle},
        dataType: "html", 
        success: (function (result) { debugger;
           console.log(result);
         
            $('#order-listing').dataTable().fnClearTable();

            $('#ticketview_tbody').html('');
            $('#ticketview_tbody').html(result); 
            
            $('#order-listing').DataTable(
			    {
					"order": [[ 0, "desc" ]]
				}
			);
			$("#load").hide();
        })
    });
}
*/

function get_ticketview()
{  debugger;
   var Atmid= $("#AtmID").val(); 
   var Client= $("#Client").val();
    var Bank= $("#Bank").val(); 
	var Circle = $('#Circle').val();
	$('#ticketview_tbody').html('');
    
	
    $.ajax({
        url: "panel_health_data_report.php", 
        type: "GET",
        data: {atmid:Atmid,bank:Bank,client:Client,circle:Circle},
        dataType: "html", 
        success: (function (result) { debugger;
           console.log(result);
         
            $('#order-listing').dataTable().fnClearTable();
		    $('#siteonline_percent_table').html('');
		    $("#siteonline_percent_table").html(result);
		    $('#order-listing').DataTable(
				{
					dom: 'Bfrtip',
					buttons: [
						'excel'
					],
					"order": [[ 0, "desc" ]]
				}
			);
			$("#load").hide();
        })
    });
}

						   
						  
