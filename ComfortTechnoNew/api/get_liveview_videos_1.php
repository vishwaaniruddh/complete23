<?php 
//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
//$ip = $_REQUEST['dvrip'];
//$n = $_REQUEST['n'];
//$channel = $_REQUEST['channel'];

$ip = '172.55.24.223';
$n = 1;
$channel = 1;

$file = $ip.'_'.$channel.'_'.$n.'.mp4';
$newpath = "test/$file";
$path = "C:/wamp64/www/Hitachi/test/$file";
$path = str_replace("/","\\",$path);

if(file_exists($path)){
	$array = array(['code'=>200,'path'=>$newpath,'n'=>$n]);
}else{
	$array = array(['code'=>201]);
}
echo json_encode($array);
?>


