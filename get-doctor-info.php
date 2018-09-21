 
<?php include_once("functions.php");?>
<?php 

$result=exec_query("select * from doctor where doc_id=".$_POST['doctor_id']);
$row=mysqli_fetch_assoc($result);

$query="select * FROM health_tips WHERE doctor_id=".$_POST['doctor_id'];
$getTips=exec_query($query);
//$array=array($row,$getTips);

$arrayTips=array();
while($rowTips=mysqli_fetch_assoc($getTips))
{
    $arrayTips[]=$rowTips;
}

$array = array(
    "array1" => array($row),
    "array2" => $arrayTips,
);


return print_r(json_encode($array));
?>