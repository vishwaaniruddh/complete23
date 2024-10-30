<?php 
//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$ip_type = $_REQUEST['ip_type'];
//$file = str_replace("./","",$date);
$file = $ip_type.".jpg";

$path = "D:/testsnaps/$file";
$path = str_replace("/","\\\\",$path);

if(file_exists($path)){
	/*
	$imgData = base64_encode(file_get_contents($path)); 
	$imgsrc = 'data: '.mime_content_type($path).';base64,'.$imgData; 
	$array = array(['code'=>200,'imgsrc'=>$imgsrc]); */
	
	if(filesize($path)>0){

		$imgData = base64_encode(file_get_contents($path)); 
		$imgsrc = 'data: '.mime_content_type($path).';base64,'.$imgData; 
		$array = array(['code'=>200,'imgsrc'=>$imgsrc]);
	}else{
		$array = array(['code'=>202]);
	}
	
}else{
	$array = array(['code'=>201]);
}
echo json_encode($array);
?>


