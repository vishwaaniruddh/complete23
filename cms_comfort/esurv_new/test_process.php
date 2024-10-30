<?php
## Database configuration
include 'config.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = "10"; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (atmid like '%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from panel_health");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from panel_health WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from panel_health WHERE 1 ".$searchQuery;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "emp_name"=>$row['atmid'],
      "email"=>$row['date'],
      "gender"=>$row['zon1'],
      "salary"=>$row['zon2'],
      "city"=>$row['zon3']
   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecordwithFilter,
  "iTotalDisplayRecords" => $totalRecords,
  "aaData" => $data
);

echo json_encode($data);
?>