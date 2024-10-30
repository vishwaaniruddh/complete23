
<script>
function autoSensor(){
 $.ajax({
           type:'POST',    
           url:'autoRass_Sensorsfun.php',
           data:'',

           success: function(msg){
          //alert(msg);
            var arr=msg.split("@#");
     
            //alert(arr[5])
            var i=0;
             
            for(i==0;i<35;i++){
                
               var zon= i+1;
                if(zon<10){
                    zon="00"+zon;
                }
                else if(zon<100){
                    zon="0"+zon;
                }
            
               // alert("zone"+zon)
                
               if(arr[i]==0){document.getElementById(zon).className = "sensorgreen";}
else if(arr[i]==1){document.getElementById(zon).className = "sensorred";}
else if(arr[i]==2){document.getElementById(zon).className = "sensorwhite";}
else if(arr[i]==4){document.getElementById(zon).className = "sensoryellow";}
else if(arr[i]==6){document.getElementById(zon).className = "sensorBlue";}
else if(arr[i]==9){document.getElementById(zon).className = "sensorOrchid";}
else if(arr[i]=='a'){document.getElementById(zon).className = "sensorOrange";}
else{}

            }
            
            
      } })
   }
   
   function a(strPage,perpg,urlPage){
     // alert("hii")
          var Atmid=document.getElementById("Atmid").value;
          $('#spinner').show();  // show the loading message.
          perp=perpg;

var Page="";
if(strPage!="")
{
Page=strPage;
}
     
             
             $.ajax({
               
            type:'POST',    
   //url:'panelhealth_process.php',
   url:urlPage,
   data:'Page='+Page+'&perpg='+perp+'&Atmid='+Atmid,
 //  data:'panelid='+panelid+'&ATMID='+ATMID+'&DVRIP='+DVRIP+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp+'&compy='+compy+'&viewalert='+viewalert+'&SensorDDL='+SensorDDL,

   success: function(msg){
  // alert(msg);
   /*var table = $('#myTable').DataTable();
    table.destroy();
    $('#datatable-buttons').empty();*/
    $('#spinner').hide(); // hide the loading message
   document.getElementById("datatable-buttons").innerHTML=msg;
   
    callfn();
   
   
} })
            }


 function autoRun(){
     
    $.ajax({
           type:'POST',    
           url:'autoRunfun.php',
           data:'',

           success: function(msg){
        //  alert(msg);
           var str_array = msg.split(',');

for(var i = 0; i < str_array.length; i++) {
   // Trim the excess whitespace.
   str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
  // alert(str_array[i]);
   
   
   document.getElementById(str_array[i]).className = "sensorRed";
   
   
}

      } })
   }
   
   
   
     function zon(id){
       
       $.ajax({
           type:'POST',    
           url:'Rass_showpriviousdata.php',
           data:'id='+id,
           success: function(msg){
          // alert(msg)
            var arr=msg.split("@#");
            
            var i=0;
            for(i==0;i<42;i++){
          
if(arr[0]==0){ $("#opener").click();  document.getElementById("printPriviousData").innerHTML= "Closed"; document.getElementById("printPriviousData").className = "sensorgreen";}
else if(arr[0]==1){ $("#opener").click(); document.getElementById("printPriviousData").innerHTML= "Opened"; document.getElementById("printPriviousData").className = "sensorred";}
else if(arr[0]==2){$("#opener").click(); document.getElementById("printPriviousData").innerHTML= "Disconnect"; document.getElementById(zon).className = "sensorwhite";}
else if(arr[0]==4){ $("#opener").click(); document.getElementById("printPriviousData").innerHTML= "Sounder ACK"; document.getElementById("printPriviousData").className = "sensoryellow";}
else if(arr[0]==6){ $("#opener").click(); document.getElementById("printPriviousData").innerHTML= "Sounder Reset"; document.getElementById("printPriviousData").className = "sensorBlue";}
else if(arr[0]==9){$("#opener").click(); document.getElementById("printPriviousData").innerHTML= "ByPass-NotConnect"; document.getElementById("printPriviousData").className = "sensorOrchid";}
else if(arr[0]=='a'){ $("#opener").click(); document.getElementById("printPriviousData").innerHTML= "Long Open"; document.getElementById("printPriviousData").className = "sensorOrange";}
else{}
 document.getElementById("dt").innerHTML=arr['1'];  
            }

           
           
           
           
           
           
           }
       });
       
       
       
   }
   
   
 </script>

<script type="text/javascript">
function load()
{
 setTimeout("window.open(self.location, '_self');", 10000);
 // setTimeout("autoRun();", 10000);
}
</script>


