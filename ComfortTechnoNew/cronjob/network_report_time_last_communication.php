<?php  include('db_connection.php'); $con = OpenCon();
        date_default_timezone_set("Asia/Calcutta"); 
        $receivedtime = date('Y-m-d H:i:s');
		
$atm_arr = ['D3670200',
'N2080900',
'B1923600',
'B1947100',
'A1178310',
'B1946100',
'N4016500',
'N1944100',
'T4199000',
'N4154100',
'N2637700',
'DD011200',
'N4606200',
'N2414700',
'N2956900',
'N4652100',
'N7004000',
'A2997900',
'N1592000',
'D1117620',
'N3251400',
'N1176300',
'A1220710',
'A1174510',
'A1195010',
'B1292300',
'D1192920',
'N2670800',
'N2355700',
'B1151500',
'N1965700',
'N2661400',
'D1055720',
'B1192310',
'N2734600',
'N1590900',
'A1125710',
'N5126800',
'N1918600',
'A1197710',
'A1103810',
'A1081110',
'A1198210',
'D2755700',
'D3625700',
'N2671900',
'A3293300',
'B1163100',
'N1980900',
'A6270900',
'N1500400',
'N3794600',
'N2124800',
'A1117410',
'D1815300',
'B1135210',
'N5124300',
'A1070310',
'A1215410',
'A1107810',
'E1135110',
'N2734700',
'A2034310',
'N1116100',
'N2475300',
'D1851600',
'N6195100',
'N1939100',
'NA153600',
'N9020300',
'D2153100',
'A1168810',
'D2223300',
'N8019700',
'B1060700',
'N2219220',
'B1017420',
'D1922400',
'N4016400',
'N1716800',
'A2922500',
'N2283900',
'A2123820',
'N3410700',
'B1033300',
'N1672600',
'N7151500',
'D3408800',
'N1881000',
'A2589200',
'N1779500',
'N3415800',
'N4983200',
'B1028110',
'N5142000',
'D2087700',
'N3161500',
'D4002700',
'N2985300',
'N4083500',
'B1025800',
'N4487500',
'N2661000',
'A2593500',
'N1751400',
'N2255000',
'B1409400',
'B1254300',
'N1796800',
'N4668300',
'B1648200',
'D3422800',
'B1039100',
'D4291700',
'N7145700',
'N2394000',
'N4040900',
'N2624100',
'N1792700',
'D1070320',
'D7149900',
'N1792200',
'N3615300',
'N1468000',
'A1249500',
'N1593100',
'N2013700',
'N2174800',
'N1215200',
'N2737700',
'A1132810',
'N2180100',
'N5183400',
'D2609100',
'N4183400',
'N2786200',
'D1191310',
'N3668600',
'N2659200',
'N6088700',
'B1637800',
'D1034300',
'D2042900',
'N4286300',
'A1128410',
'N3463100',
'N6359200',
'N2607700',
'D2302700',
'D1070920',
'D1213320',
'N4045220',
'NI112000',
'N6359200',
'D3404800',
'A1200110',
'A1526010',
'D1131220',
'D1133520',
'L1736600',
'N3016600',
'N5043400',
'E3589100',
'DE015900',
'D7226400',
'D1045920',
'D2348500',
'N2440200'
];

$last_com_arr = ['2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-03',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-02',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-10-01',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-30',
'2023-09-29',
'2023-09-28',
'2023-09-28',
'2023-09-28',
'2023-09-27',
'2023-09-27',
'2023-09-27',
'2023-09-27',
'2023-09-27',
'2023-09-27',
'2023-09-27',
'2023-09-27',
'2023-09-27',
'2023-09-27',
'2023-09-21',
'2023-09-18',
'2023-09-18',
'2023-09-14',
'2023-09-14',
'2023-09-14',
'2023-09-14',
'2023-09-14',
'2023-09-14',
'2023-09-13',
'2023-09-10',
'2023-09-07',
'2023-09-07',
'2023-08-17'
];

//echo count($atm_arr);echo count($last_com_arr);die;
$total_updated = 0;
for($i=0;$i<count($atm_arr);$i++){
	$net_atm = $atm_arr[$i];
	//echo $net_atm;
	$net_date = $last_com_arr[$i];
	//echo $net_date;
	$net_qry = "SELECT * FROM `network_report_list` WHERE ATMID='".$net_atm."'";
	$sql = mysqli_query($con,$net_qry);
	$netsql_result = mysqli_fetch_assoc($sql);  
	$SN = $netsql_result['SN'];
	$router_lastcommunication = $netsql_result['router_lastcommunication'];
	$dvr_lastcommunication = $netsql_result['dvr_lastcommunication'];
	$panel_lastcommunication = $netsql_result['panel_lastcommunication'];
	
	$router_lastcommunication_arr = explode(" ",$router_lastcommunication);
	if(is_array($router_lastcommunication_arr)){
	   $router_lastcommunication_time = $router_lastcommunication_arr[1];
	}else{
		$router_lastcommunication_arr = explode(" ",$receivedtime);
		$router_lastcommunication_time = $router_lastcommunication_arr[1];
	}
	$router_lastcommunication_new = $net_date." ".$router_lastcommunication_time;
	
	/*
	$dvr_lastcommunication_arr = explode(" ",$dvr_lastcommunication);
	$dvr_lastcommunication_time = $dvr_lastcommunication_arr[1];
	$dvr_lastcommunication_new = $net_date." ".$dvr_lastcommunication_time;
	
	$panel_lastcommunication_arr = explode(" ",$panel_lastcommunication);
	$panel_lastcommunication_time = $panel_lastcommunication_arr[1];
	$panel_lastcommunication_new = $net_date." ".$panel_lastcommunication_time;
	
	*/
	
	//echo $router_lastcommunication_new;die;
	
	/*
	$updatesql= " UPDATE `network_report` SET `router`='".$receivedtime."',`dvr`='".$receivedtime."',`panel`='".$receivedtime."' where `SN`='".$SN."'";
	$month_result = mysqli_query($con,$updatesql);
	if($month_result==1){
		$updatesql_list= " UPDATE `network_report_list` SET `router_lastcommunication`='".$receivedtime."',`dvr_lastcommunication`='".$receivedtime."',`panel_lastcommunication`='".$receivedtime."' where `SN`='".$SN."'";
		$month_result_list = mysqli_query($con,$updatesql_list);
	   $total_updated = $total_updated + 1;
	}
	*/
	$updatesql_list= " UPDATE `network_report_list` SET `router_lastcommunication`='".$router_lastcommunication_new."',`dvr_lastcommunication`='".$router_lastcommunication_new."',`panel_lastcommunication`='".$router_lastcommunication_new."' where `SN`='".$SN."'";
	$month_result_list = mysqli_query($con,$updatesql_list);
	$total_updated = $total_updated + 1;
}

		  CloseCon($con);
	  echo $total_updated;
     