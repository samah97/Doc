<?php 
include '../functions.php';

extract($_POST);

$deletequery="delete from patient_vaccine where patient_vacc_id=".$vacc_id;

$execute=exec_query($deletequery);

if($execute)
    echo 1;
else echo 0;
?>