<?php
 session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>        
</head>
<body>
    <?php
	
	session_destroy();
	?>
</body>
<script>
 swal("", "Logout Successfully !", "success");
                  setTimeout(function(){ 
               window.location.href="login.php";
           }, 3000);  
</script>  
</html>
        

