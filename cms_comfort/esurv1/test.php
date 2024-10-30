<!doctype html>
<html>
    <head>
        <title>Datatable AJAX pagination with PHP and PDO</title>
        <!-- Datatable CSS -->
 <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
        
        <!-- jQuery Library -->
      
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
       <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
    </head>
    <body >

        <div >
            <!-- Table -->
            <table id='empTable' class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                <tr>
                    <th>Employee name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Salary</th>
                    <th>City</th>
                </tr>
                </thead>
                
            </table>
        </div>
        
        <!-- Script -->
        <script>
        $(document).ready(function(){
            $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'test_process.php',
                    "dataType": "json", // The type of data that you're expecting back from the server.
                     "dataSrc": ""
                },
                'columns': [
                    { data: 'emp_name' },
                    { data: 'email' },
                    { data: 'gender' },
                    { data: 'salary' },
                    { data: 'city' },
                ]
            });
        });
        </script>
    </body>

</html>
