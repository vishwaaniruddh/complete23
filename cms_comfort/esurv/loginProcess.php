<?php session_start();?>
<html>
    <head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 
<body>


<?php
include 'config.php';

$Email=$_POST['email'];
$pass=$_POST['pass'];
$sql="select * from loginusers where uname='".$Email."' and pwd='".$pass."'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
$fetchresult=mysqli_fetch_array($result);

	if($Email==$fetchresult['uname'] && $pass==$fetchresult['pwd'])
	{


$_SESSION['name']= $fetchresult['name'];
$_SESSION['login_user']= $fetchresult['uname'];
$_SESSION['id']= $fetchresult['id'];
$_SESSION['designation'] = $fetchresult['designation'];
$_SESSION['permission'] = $fetchresult['permission'];

}
?>


<script>
<?php
if($num!=""){
?>
swal({
  title: "Login Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});

<?php if($_SESSION['designation']=="2"){ ?>
window.open("PanelHealthStatus.php","_self");
<?php } else{ 
           if($_SESSION['designation']=="4"){
?>
           window.open("network_report.php","_self");
<?php } else{  ?>
           window.open("dashboard.php","_self");

//window.open("Mamaintenance.php","_self");
<?php }
}}
else
{?>


  swal({
  title: "Invalid!",
  text: "oops!",
  icon: "error",
  button: "not done",
});  



window.open("index.php","_self");
<?php
}
?>

</script> 

</body>
</html>