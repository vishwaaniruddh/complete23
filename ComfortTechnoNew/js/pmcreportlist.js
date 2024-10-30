var table = $('#example').DataTable();
function onload()
{
   // get_ai_ticket();
}

$("#show_detail").click(function(){ 
	getPanel_Detail();
	
})

function getPanel_Detail()
{
	var Client = 'Hitachi';
	var Bank = 'PNB';
	var AtmID = $("#AtmID").val();
	var Circle = $('#Circle').val();
	if(Client==''){
		swal("Oops!", "Bank Must Required !", "error");
		return false;
	}
	$('#ticketview_tbody').html('');
	$.ajax({
		url: "pmc_report_table_ajax.php", 
		type: "GET",
		data: {client:Client,bank:Bank,atmid:AtmID,circle:Circle},
		dataType: "html", 
		success: (function (result) { debugger;
		   console.log(result);
		 
		    $('#order-listing').dataTable().fnClearTable();
			$('#ticketview_tbody').html(result); 
			$('#order-listing').DataTable(
				{
				//	"order": [[ 0, "desc" ]]
					dom: 'Bfrtip',
					buttons: [
						  'excelHtml5'
					]
				}
			);
			 $("#load").hide();
		})
	});
}
