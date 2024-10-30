<?php 
//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$ip = $_REQUEST['dvrip'];
$n = $_REQUEST['n'];
$channel = $_REQUEST['channel'];

$file = $ip.'_'.$channel.'_'.$n.'.mp4';
$newpath = "img/$file";
$path = "C:/wamp64/www/Hitachi/img/$file";
$path = str_replace("/","\\",$path);

if(file_exists($path)){
	if(filesize($path)>0){
		$filesize = filesize($path);
	    $array = array(['code'=>200,'path'=>$newpath,'n'=>$n,'filesize'=>$filesize]);
	}else{
		$array = array(['code'=>202]);
	}
}else{
	$array = array(['code'=>201]);
}
echo json_encode($array);
?>


