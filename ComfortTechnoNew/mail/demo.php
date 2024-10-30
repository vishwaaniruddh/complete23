<? include('../config.php');


$statement = "select a.remarks,a.id AS misid,a.bank,a.customer,a.location,a.zone,a.state,a.city,a.branch,a.created_by,a.bm,b.id,b.mis_id, b.atmid,
b.component,b.subcomponent,b.engineer,b.docket_no,b.status,b.created_at,b.ticket_id,b.close_date,b.call_type,b.case_type, 
IF(b.status = 'schedule',(SELECT CONCAT(name,'_',contact) from mis_loginusers WHERE id= b.engineer),'' ) AS eng_name_contact, 
IF(b.footage_date = '0000-00-00 00:00:00', '', DATE_FORMAT(b.footage_date, '%Y-%m-%d')) AS footage_date, b.fromtime,b.totime,
(SELECT name from mis_loginusers WHERE id= a.created_by) AS createdBy from mis a, mis_details b where 1 and b.mis_id = a.id and
b.status in('open', 'schedule', 'material_requirement', 'material_dispatch', 'permission_require', 'material_delivered', 'MRS', 'cancelled', 'available', 'not_available', 'material_in_process') 
and CAST(b.created_at AS DATE) >= '2023-03-04' and CAST(b.created_at AS DATE) <= '2023-04-29' order by b.id desc
"; 



$content = '';
$content .= "SR \t TicketId \t Customer \t Bank \t Atmid \t Atm Address \t City \t State \t Branch \t Call Type \t Call Receive From \t Component \t Sub Component \t Current Status \t";




			$date = date('Y-m-d');
			$date1 = date_create($date);

			$i = 0;
			//  echo $statement; die;
			$sql = mysqli_query($con, $statement);
			while ($sql_result = mysqli_fetch_assoc($sql)) {
			$id = $sql_result['id'];

			
			$customer = $sql_result['customer'];
			$closed_date = $sql_result['close_date'];

			if ($closed_date != '0000-00-00') {
			    $date1 = date_create($closed_date);
			}

			$date2 = $sql_result['created_at'];
			$cust_date2 = date('Y-m-d', strtotime($date2));

			$cust_date2 = date_create($cust_date2);
			$diff = date_diff($date1, $cust_date2);
			$atmid = $sql_result['atmid'];

			$bm_name = $sql_result['bm'];

			$status = $sql_result['status'];
			$created_by = $sql_result['created_by'];
			$aging_day = $diff->format("%a");

			$mis_his_key = 0;
			$lastactionsql = mysqli_query($con, "select type,created_by,remark,schedule_date,material,material_condition,courier_agency,pod,serial_number,dispatch_date,(SELECT name FROM mis_loginusers WHERE id=mis_history.created_by) AS last_action_by from mis_history where mis_id='" . $id . "' order by id desc");
			while($lastactionsql_result = mysqli_fetch_assoc($lastactionsql)){
			   // echo '<pre>';print_r($lastactionsql_result);echo '</pre>';die;
			    $his_type = $lastactionsql_result['type'];
			    $lastactionuserid = $lastactionsql_result['created_by'];
			    $status_remark = $lastactionsql_result['remark'];
			    
			    if($mis_his_key==0){
			      $last_action_by = $lastactionsql_result['last_action_by'];  
			    }
			    $mis_his_key = $mis_his_key + 1;
			    $schedule_date = "";
			    if($his_type=='schedule'){
			        $schedule_date = $lastactionsql_result['schedule_date'];
			    }
			    
			    
			    $material = "";$material_req_remark = "";
			    if($his_type=='material_requirement'){
			        $material = $lastactionsql_result['material'];
			        $material_req_remark = $lastactionsql_result['remark'];
			        $material_condition = $lastactionsql_result['material_condition'];
			    }
			    $courier_agency = "";$pod = "";$serial_number="";$dispatch_date="";$material_dispatch_remark="";
			    if($his_type=='material_dispatch'){
			        $courier_agency = $lastactionsql_result['courier_agency'];
			        $pod = $lastactionsql_result['pod'];
			        $serial_number = $lastactionsql_result['serial_number'];
			        $dispatch_date = $lastactionsql_result['dispatch_date'];
			        $material_dispatch_remark = $lastactionsql_result['remark'];
			    }
			    $close_type = "";$close_remark = "";$close_created_at = "";$attachment="";
			    if($his_type=='close'){
			        $close_type = $lastactionsql_result['close_type'];
			        $close_remark = $lastactionsql_result['remark'];
			        $close_created_at = $lastactionsql_result['created_at'];
			        $attachment = $lastactionsql_result['attachment'];
			    }
			}


    $contents.="\n".++$i."\t";


    $contents.= $sql_result['ticket_id']."\t";

    $contents.= $customer."\t";
    $contents.= $sql_result['bank']."\t";
    $contents.= $atmid."\t";
    $contents.= $sql_result['location']."\t";
    $contents.= $sql_result['city']."\t";
    $contents.= $sql_result['state']."\t";

    $contents.= $sql_result['branch']."\t";
    $contents.= $sql_result['call_type']."\t";

    $contents.= $sql_result['case_type']."\t";
    $contents.= $sql_result['component']."\t";
    $contents.= $sql_result['subcomponent']."\t";
    $contents.= $status."\t";


    }

    $contents = strip_tags($contents);
    header("Content-Disposition: attachment; filename=rnm.xls");
    header("Content-Type: application/vnd.ms-excel");
    print $contents;
