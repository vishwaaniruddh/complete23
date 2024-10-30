<?php 
//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$ip = $_REQUEST['dvrip'];
//$n = $_REQUEST['n'];
$channel = $_REQUEST['channel'];
$n = 1;
$file = $ip.'_'.$channel.'_'.$n.'.mp4';
$newpath = "img/$file";
$path = "C:/wamp64/www/Hitachi/img/$file";
$path = str_replace("/","\\",$path);

$video_array = array();
for($i=1;$i<=18;$i++){
	$video_file = $ip.'_'.$channel.'_'.$i.'.mp4';
	$video_path = "http://103.141.218.26:8080/Hitachi/img/".$video_file;
	array_push($video_array, $video_path);
}

if(file_exists($path)){
	if(filesize($path)>0){
	    $array = array(['code'=>200,'video_files'=>$video_array]);
	}else{
		$array = array(['code'=>202]);
	}
}else{
	$array = array(['code'=>201]);
}
echo json_encode($array);
?>


