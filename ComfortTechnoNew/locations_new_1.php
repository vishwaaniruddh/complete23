<!DOCTYPE html>
<html lang="en">
<?php 
    include('head.php');
    //include('config.php');
   
    ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.bt {
    border-top: 1px solid #1e1f33;
}

.br {
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
    text-align: justify;
}
</style>
<style>
.menu-icon {
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
                <h3 class="card-title">Locations</h3>
                <div class="card">
                    <div class="card-body">


                        <?php include('filters/sitehealth_filter.php');?>
                        <div class="card">
                            <div class="card-body">

                                <div class="map-container">
                                    <div id="map-with-marker" class="google-map">



                                    </div>
                                </div>
								
								<div class="row" id="share_location" style="display:none;">
									<!--<a href="mailto"> <button id="shareLocation" class="btn btn-primary">Share
											Location</button> </a> -->
									<!-- <button id="copy-location-button">Copy Location</button>
									<div id="copied-location"></div> -->
									<input type="hidden" id="selected_lat">
									<input type="hidden" id="selected_lng">
									<button id="copy-location-button" class="btn btn-warning" onclick="copytodashboard()">Copy Location</button>
									<button type="button" class="btn btn-success" id="whatsapp"><i class="fa fa-whatsapp">
											Whatsapp</i></button>
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
</div>
</div>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/js/vendor.bundle.addons.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/misc.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<script src="js/client_bank_circle_atmid.js"></script>
<script src="js/dashboard.js"></script>
<script src="vendors/video-js/video.min.js"></script>
<script src="js/select2.js"></script>
<!-- <script src="js/copylocation.js"></script> -->

<script>
function initMap(lat, lng, atmid, atmshortname) {
    console.log(lat);
    console.log(lng);
    if (lat == undefined) {
        lat = 28.616318966813253;
    }
    if (lng == undefined) {
        lng = 77.20948395138142;
    }
    if (atmid == undefined) {
        atmid = "-";
    } else {
        atmid = "ATMID : " + atmid;
    }
    if (atmshortname == undefined) {
        atmshortname = "-";
    }
    const uluru = {
        lat: lat,
        lng: lng
    };
    const map = new google.maps.Map(document.getElementById("map-with-marker"), {
        zoom: 14,
        center: uluru,
    });
    const contentString =
        '<div id="content">' +
        '<div id="siteNotice">' +
        "</div>" +
        '<h3 id="firstHeading" class="firstHeading">' + atmid + '</h3>' +
        '<div id="bodyContent">' +
        "<p><b>" + atmshortname + "</b></p>" +
        "</div>" +
        "</div>";
    const infowindow = new google.maps.InfoWindow({
        content: contentString,
    });
    const marker = new google.maps.Marker({
        position: uluru,
        map,
        title: atmid,
    });

    marker.addListener("click", () => {
        infowindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
        });
    });
    //copytodashboard(lat, lng); //on load copying data

}

function set_Location(atmid) {
    debugger;
    var client = $("#Client").val();
    var bank = $("#Bank").val();
    var AtmID = $("#AtmID").val();
    if (AtmID == '') {
        swal("Oops!", "AtmID Must Required !", "error");
        return false;
    }
    $.ajax({
        url: "location_ajax.php",
        type: "POST",
        data: {
            atmid: AtmID,
            bank: bank,
            client: client
        },
        success: (function(result) {
            debugger;
            console.log(result);
            var objt = JSON.parse(result);
            if (objt.code == 200) {
				$('#share_location').css('display','block');
                var obj = objt.res;
                var lat = obj.latitude;
                var lng = obj.longitude;
				$('#selected_lat').val(lat);
				$('#selected_lng').val(lng);
                var atmid = obj.atmid;
                var atmshortname = obj.atmshortname;
                lat = parseFloat(lat);
                lng = parseFloat(lng);
                initMap(lat, lng, atmid, atmshortname);
               // copytodashboard(lat, lng); // after getting location on submit
            }
        })
    });
}

function set_Location_1(atmid) {
    debugger;
    var AtmID = $("#AtmID").val();
    if (AtmID == '') {
        swal("Oops!", "AtmID Must Required !", "error");
        return false;
    }
    $.ajax({
        url: "location_ajax.php",
        type: "POST",
        data: {
            atmid: AtmID
        },
        success: (function(result) {
            debugger;
            console.log(result);
            var objt = JSON.parse(result);
            if (objt.code == 200) {
                var obj = objt.res;
                var lat = obj.latitude;
                var lng = obj.longitude;
                var title = "ATMID : B1009500";
                var url_link = 'http://maps.google.com/maps?q=' + lat + ',' + lng +
                    '&z=15&output=embed';
                //	var url_link ='https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Malet%20St,%20London%20WC1E%207HU,%20United%20Kingdom+(Your%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed';
                var src = '<iframe src="' + url_link +
                    '" height="750" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>';
                $("#map-with-marker").html(src);

                //  <div style="width: 100%"><iframe width="100%" height="600"  src=""></iframe></div>							
            }

        })
    });
}

function copytodashboard() {
	var lat = $('#selected_lat').val();
	var lng = $('#selected_lng').val();
    const location = `https://www.google.com/maps?q=${lat},${lng}`;

    // const location = `Latitude: ${latitude}, Longitude: ${longitude}`;

    // Create a textarea element to temporarily hold the location text
    const tempTextarea = document.createElement("textarea");
    tempTextarea.value = location;
    document.body.appendChild(tempTextarea);

    // Select the text inside the textarea
    tempTextarea.select();
    tempTextarea.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text to the clipboard
    document.execCommand("copy");

    // Remove the temporary textarea
    document.body.removeChild(tempTextarea);

    // Provide feedback to the user (you can customize this part)
    alert("Dynamic location copied to clipboard: " + location);
}

/*const copyButton = document.getElementById("copy-location-button");
if (copyButton) {
    copyButton.addEventListener("click", copytodashboard);
}
*/

$("#show_detail").click(function() {
    var atmid = $('#AtmID').val();
    /*if(atmid=='P3ENMM09'){
					var src = '<iframe src="http://maps.google.com/maps?q=18.9968965,72.8116118&z=16&output=embed" height="750" width="950" style="width:100%;"></iframe>';
                   $("#map-with-marker").html(src);   
                     				   
				}*/
    set_Location(atmid);



});


document.getElementById('shareLocation').addEventListener('click', () => {
	var lat = $('#selected_lat').val();
	var lng = $('#selected_lng').val();
    const shareURL = `https://www.google.com/maps?q=${lat},${lng}`;
    // You can use this URL to share the location or open a map application
    // For example, you can open a new window/tab with the location on Google Maps:
    window.open(shareURL);

    // Send the location via an AJAX request to your PHP server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'send_location.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`latitude=${lat}&longitude=${lng}`);
});

// Whatsapp js start

document.getElementById('whatsapp').addEventListener('click', function() {
    // Specify the latitude and longitude of the location you want to share
   // const lati = 21.219671014609286; // Replace with your latitude
   // const long = 81.45101559595126; // Replace with your longitude
    var lati = $('#selected_lat').val();
	var long = $('#selected_lng').val();

    // Specify a message to be sent along with the location (optional)

    const wlink = `https://www.google.com/maps/search/?api=1&query=${lati},${long}`;


    const message = 'Check out this location! \n' + wlink;


    // Generate the WhatsApp link
    const whatsappLink = `https://wa.me/?text=${encodeURIComponent(message)}&location=${lati},${long}`;

    // Open WhatsApp in a new window or tab
    window.open(whatsappLink);
});

// Whatsapp js end
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYJLYaSvIyWhvHv4Jxu2z5vbXM_Ys0nck&callback=initMap&v=weekly&channel=2"
    async></script>
</body>

</html>