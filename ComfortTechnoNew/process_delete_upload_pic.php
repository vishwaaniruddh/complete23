<html>
    <head>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>        
    </head>
    <body>
        
<?php
session_start();
include('db_connection.php');
$con = OpenCon();
$id = $_GET['id'];
$link = $_GET['link'];
$atmid = $_GET['atmid'];

$path = $_SERVER['DOCUMENT_ROOT'].'/ComfortTechnoNew/'.$link;
unlink($path);

$sql = "delete from atm_upload_images where id='".$id."'" ; 
mysqli_query($con,$sql);
$err = 1;
CloseCon($con);
if($err==1){  //viewsitenew   window.location.href="viewatmuploadimages.php?atmid="+atmid;
?>
 <script>
 
       swal("Great!", "Image Deleted Successfully !", "success");

           setTimeout(function(){ 
               window.location.href="viewsitenew.php";
           }, 3000);

       </script> 
<?php }else{ ?>	   
 <script>
       swal("", "Sorry, there was an error uploading your file !", "error");
           swal('error','','Login Error');
           setTimeout(function(){ 
		     window.location.href="viewsitenew.php";
             // window.history.back();
           }, 3000);

       </script>

<?php }?>
 
</body>
</html>