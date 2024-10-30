<?php include('db_connection.php'); 
$con = OpenCon();
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$ticket_id = $_REQUEST['ticket_id'];
$sql = mysqli_query($con,"select File_loc from ai_alerts_alive where id='".$ticket_id."'");
if(mysqli_num_rows($sql)>0){
	$sql_result = mysqli_fetch_assoc($sql);
	$file = $sql_result['File_loc'];
//$path = str_replace("./","",$date);
$src = 'data: image/jpeg;base64,'.$file; 
}else{
	$src="";
}
CloseCon($con);
$array = array(['code'=>200,'res_data'=>$file]);
echo json_encode(utf8ize($array));
		 ?>

