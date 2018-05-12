<?php 
include '../functions.php';
include '../class/Measurements.php';

if(isset($_REQUEST['m'])){
    
   echo $_REQUEST['m']();
    
}

function addVacination(){
    $msg="Hello World!";
    $vaccine=$_REQUEST['vacc_name'];
    $vaccineDate=$_REQUEST['vacc_date'];
     
    $measurement=new Measurements();
    
   $inserted=$measurement->insertVaccination($vaccine, $vaccineDate);
    
   if($inserted)
       $msg="Vaccination Added";
   else 
       $msg="Error Occured";
   
   return $msg;
    
}



?>