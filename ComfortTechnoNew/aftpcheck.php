<?php 
    session_start();
     include('db_connection.php');
	  if(isset($_SESSION['client'])){
		//  echo $_SESSION['client'];
		  $clients = explode(",",$_SESSION['client']);
		  $clientarray=json_encode($clients); 
		  $clientarray=str_replace( array('[',']','"') , ''  , $clientarray);
		  $arr=explode(',',$clientarray);
		  $clientarray = "'" . implode ( "', '", $arr )."'";
		  $con = OpenCon();
	      $sites_sql = "select ATMID from sites where Customer IN (".$clientarray.")";
		  
		  $atmidlist = mysqli_query($con,$sites_sql);
		  $atmidlistarr = array();
		  if(mysqli_num_rows($atmidlist)>0){
			  while($atmid_data=mysqli_fetch_assoc($atmidlist)){
				 $clientatmid = $atmid_data['ATMID']; 
				 array_push($atmidlistarr,$clientatmid);
			  }
		  }
		  //echo '<pre>';print_r($atmidlistarr);echo '</pre>';
	  }

  $month_array = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
  $mon = date("m");
  $mon = (int) $mon;
  $year = date("Y");
  
  $first_folder = $month_array[$mon - 1]."_".$year;
  
  $ftp_server = "192.168.100.26"; 
	//$ftp_server = "192.168.100.18";
	$ftp_username = "comfort_cloud";
	$ftp_userpass = "cam@12345";
	$ftp_port = "7555";
	$timeout = "90";
	$ftp_conn_1 = ftp_connect($ftp_server,$ftp_port,$timeout) or die("Could not connect to $ftp_server");
	$login = ftp_login($ftp_conn_1, $ftp_username, $ftp_userpass);
	
   // $ftp_conn_1 = OpenFTPCon();
	$ftp_pasv_1 = ftp_pasv($ftp_conn_1,true);
    $file_list_share = ftp_nlist($ftp_conn_1, "./".$first_folder."/AI_Feed");
	
	$all_atm = [];
	if(count($file_list_share)>0){
		for($j=0;$j<count($file_list_share);$j++){
			$atm = explode('/',$file_list_share[$j]); 
			for($p=0;$p<count($atmidlistarr);$p++){
				if($atm[3]==$atmidlistarr[$p]){
					$all_atm[]=$atm[3];
				}
			}
		}	
	}
	
	echo '<pre>';print_r($all_atm);echo '</pre>';die;
?>