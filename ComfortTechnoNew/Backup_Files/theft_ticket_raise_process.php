<html>
    <head>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>        
    </head>
    <body>
        
<?php
session_start();
include('db_connection.php');
$con = OpenCon();
function compressImage($source,$destination,$quality){
    // getimagesize
    $imgInfo = getimagesize($source);
    $mime = $imgInfo['mime'];
    
    //Create new image from file
    switch($mime){
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;
        default :
            $image = imagecreatefromjpeg($source);
           
    }
    // save image
    imagejpeg($image,$destination,$quality);
    
    return $destination;
}
//echo '<pre>';print_r($_FILES);echo '</pre>';die;
$customer = $_POST['client'];
$bank = $_POST['Bank'];
$atmid = $_POST['atmid'];
//$no_of_incident = $_POST['no_of_incident'];
$incident = $_POST['incident'];
$remark = $_POST['remarks'];
$datetime = date('Y-m-d h:i:s');
$sql = "insert into theft_ticket_raise(atmid,bank,customer,incident,remarks,created_at) values('".$atmid."','".$bank."','".$customer."','".$incident."','".$remark."','".$datetime."')";
$err=0;
if(mysqli_query($con,$sql)){ 
     $totalrow = count($_FILES);     


        if(count($_FILES)>0){ 
			foreach($_FILES as $k => $v){
				$name = $k ;
				$target_dir = "theftuploadfile/".$atmid.'/';
					if (!file_exists($target_dir)) {
						mkdir($target_dir, 0777, true);
					}
				for($i=0;$i<$totalrow;$i++){	
				        if($_FILES[$name]["name"][$i]!=""){
							$target_file = $target_dir . basename($_FILES[$name]["name"][$i]);    
							$imageTmp = $_FILES[$name]["tmp_name"][$i];
							
							if (move_uploaded_file($_FILES[$name]["tmp_name"][$i], $target_file)) {
								//if ($compressedImageSize) {
								//echo "The file  has been uploaded.";
								$link = $target_dir. htmlspecialchars( basename( $_FILES[$name]["name"][$i])) ; 
								$updatesql = "update theft_ticket_raise set file='".$link."' where atmid='".$atmid."'" ; 
								mysqli_query($con,$updatesql);
								$err = 0;
							} else {
								//echo "Sorry, there was an error uploading your file.";
								$err = 1;
							}
						}
					}
				}
		}
}else{
	$err==1;
}
CloseCon($con);
if($err==0){
?>
 <script>
       swal("Great!", "Ticket Raise Successfully !", "success");

           setTimeout(function(){ 
               window.location.href="add_theft_history.php";
           }, 3000);

       </script> 
<?php }else{ ?>	   
 <script>
       swal("", "Sorry, there was an error !", "error");
           swal('error','','Login Error');
           setTimeout(function(){ 
		     window.location.href="add_theft_history.php";
             // window.history.back();
           }, 3000);

       </script>

<?php }?>
 
</body>
</html>