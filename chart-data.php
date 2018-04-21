<?php
include_once "functions.php";
session_start();
$getData=exec_query("select Height,weight from measurements where Patient_id=".$_SESSION['patient-id']);
$data=array();

while($row=mysqli_fetch_assoc($getData)){
	$data['datass'][]=$row;
}
$result='"cols": [
        {"id":"","label":"Topping","pattern":"","type":"string"},
        {"id":"","label":"Slices","pattern":"","type":"number"}
      ],';
$result.=json_encode($data);
echo $result;


?>