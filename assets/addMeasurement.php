<?php


include '../class/Measurements.php';

session_start();

if( $_POST['weight'] !=="" && $_POST['height']!==""){
$weight=$_POST['weight'];
$height=$_POST['height'];
if(isset($_POST['head-diameter']))
    $headDiameter=$_POST['head-diameter'];
else 
    $headDiameter=null;

$today=date('Y-m-d');
$patientId=$_SESSION['patient_id'];


$measurement=new Measurements();

$insert=$measurement->insertMeasurement($patientId, $height, $weight, $headDiameter);

if($insert){
    echo "Inserted!!!";
}
else
    echo "Something Went Wrong";
}
else
    echo "Something Went Wrong";
?>