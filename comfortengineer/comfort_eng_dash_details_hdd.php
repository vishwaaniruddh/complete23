<?php include('db_connection.php');
   // $conn = OpenCon();
	$newcon = OpenConNewServer();
	$value=$_POST['id'];
	$atmdataarray = $_POST['atm_id_list'];
	/*$dataarray = ['P1ENCI39', 'P3ENTN11', 'P3ENCI23', 'P3ENCO13', 'P1ENSL03', 'P3ENCO14', 'MC001003', 'P3ECAU01', 'P3ECAC01', 'MN005006', 'P3ENKD03', 'P3ECKG01', 'P3ENAT01', 'P3ENCB03', 'P3ENKI05', 'P3ENTH01', 'P3ENKL01', 'P3ENPC05', 'CECN79703', 'SPCPM978', 'P3ECPO01', 'S1B2000913009', 'S1B2000913001', 'S1B2000913008', 'S1B2000913006', 'S1B2000832043', 'S1B2000913011', 'S1B2000918037', 'P3ENBU04', 'P3ENVL18', 'P3ENVL19', 'P3ENVL20', 'P3ENKI07', 'P3ENMD26', 'P3ENTU01', 'P3ENAU03', 'P3ENVY01', 'P3ENDP05', 'P3ENAU04', 'P3ENMD37', 'P3ENMD38', 'P3ENMD56', 'P3ENMD51', 'S1B2000913108', 'P3ENCX24', 'S1B2000837015', 'S1B2000832044', 'ZCE8123', 'ZCE8110', 'ZCB8040', 'ZCE8107', 'ZCB8047', 'ZCB8058', 'MC005002', 'ZCB8048', 'ZKE8039', 'ZKE8055', 'ZKE8058', 'ZKE8038', 'ZCB8059', 'ZKE8085', 'ZKE8043', 'ZCB8056', 'MN014402', 'ZMD8075', 'P3ENCX77', 'ZCB8052', 'ZKE8072', 'ZCB8050', 'ZKE8053', 'ZCE8125', 'ZKE8063', 'ZKE8079', 'ZCE8108', 'ZKE8094', 'ZKE8105', 'ZCB8046', 'ZKE8099', 'P3ENCR09', 'SPCNF062', 'P3ENCX94', 'N3298100', 'P3ENCR27', 'P3ENCR08', 'ZCE8105', 'P3ENCR34', 'N1970400', 'N2016500', 'B1139510', 'ZMD8064', 'ZCB8054', 'B1361600', 'N3623400', 'P3ENMD96', 'N3292800', 'N2292800', 'B1084810', 'N2048800', 'N2608000', 'N3792500', 'N2664100', 'B1071510', 'N1927100', 'N5623400', 'DKL12313', 'DKL12246', 'ZKE8104', 'ZKE8103', 'B1194210', 'Dkl12013', 'DKL12196', 'DKL12361', 'MN005005', 'P3ENCR79', 'N2598400', 'N4593000', 'P3ENCR94', 'EN805341', 'EN807922', 'P3ENCS04', 'N2028300', 'B1589300', 'N7044900', 'N3598200', 'N2598100', 'N2598300', 'N3361600', 'CECN53419', 'CECN53435', 'CECN48323', 'CECN53432', 'DECN209713', 'B1169810', 'B1956100', 'P3ENPO28', 'CECN79909', 'P3ENHD10', 'CECN53526', 'CECN88907', 'CECN20941', 'CECN79809', 'CECN79813', 'DECN269402', 'CECN17034', 'CECN17035', 'DECN174202', 'P3ENCS13', 'DKL12277', 'CPRH11803', 'APCN11830', 'BPCN364702', 'APCN10927', 'APCN10926', 'B1034500', 
'BPCN185914']; */
	$_data = [];
	if(count($atmdataarray)>0){
		$dataarray=json_encode($atmdataarray);
		$dataarray=str_replace( array('[',']','"') , ''  , $dataarray);
		$atmarr=explode(',',$dataarray);
		$dataarray = "'" . implode ( "', '", $atmarr )."'";
		
		if($value=="hdd"){
			$qrys=mysqli_query($newcon,"select * from all_dvr_live where hdd IN ('error','notexist','Not Exist','smartFailed','unformatted','No Disk','No disk/idle','abnormal') AND atmid IN (".$dataarray.")");
		}
		 
		 else if($value=="notlogin"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where status='1' and login_status='1'  and live='y'  AND atmid IN (".$dataarray.") ");
		 }
		 else if($value=="Cam1"){
			 $new_qry = "select * from all_dvr_live where cam1='not working'  AND atmid IN (".$dataarray.") ";
			// $qrys=mysqli_query($newcon,"select * from all_dvr_live where cam1='not working'  AND atmid IN (".$dataarray.") ");
		    $qrys=mysqli_query($newcon, $new_qry);
		 }
		 else if($value=="Cam2"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where cam2='not working'  AND atmid IN (".$dataarray.")  ");
		 }
		 else if($value=="Cam3"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where cam3='not working'  AND atmid IN (".$dataarray.") ");
		 }
		 else if($value=="Cam4"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where cam4='not working'  AND atmid IN (".$dataarray.") ");
		 }
		 
		 $_cnt = mysqli_num_rows($qrys);
		
		if($_cnt>0){ 
		 
		 
		 while($row = mysqli_fetch_assoc($qrys)) { 
            $_tbl_atmid = $row['atmid'];
		$StateQry= mysqli_query($conn,"select State,PanelIP,City,SiteAddress,Bank,Customer from sites where ATMID='".$_tbl_atmid."'");
			$fetchState=mysqli_fetch_assoc($StateQry);

			//$numQry= mysqli_query($conn,"select id from dvr_health_comfort where status='1' and login_status='1' and id='".$row['id']."' ");
			//$num=mysqli_num_rows($numQry);

			
				$data_arr = [];
				$data_arr['site_address'] = htmlspecialchars($fetchState['SiteAddress']);
				$data_arr['bank'] = $fetchState['Bank'];
				$data_arr['customer'] = $fetchState['Customer'];
				$data_arr['city'] = $fetchState['City'];
				$data_arr['state'] = $fetchState['State'];
				$data_arr['atm_id'] = $row['atmid'];
				$data_arr['hdd'] = $row['hdd'];
				array_push($_data,$data_arr);

				$code = 200;
			}
		}
	   $code = 200;
	    
	}else{
		$code = 201;
	}
	$array = array(['new_qry'=>$_cnt,'res_data'=>$_data,'code'=>$code]);
	CloseCon($conn);
	CloseCon($newcon);
	echo json_encode($array);
	
?>