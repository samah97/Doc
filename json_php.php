<?php
include_once("functions.php");

$data=file_get_contents("test.json");
$array=json_decode($data,true);


print_r($array);
?>