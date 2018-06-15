<?php 
include '../functions.php';
extract($_POST);

$update=exec_query("update doctor set fname='".$fname."',lname='".$lname."', email='".$email."', landline='".$landline."', phone='".$phone."',dob= '".$dob."'");

if($update){
    echo 'Profile Updated';
}
else echo 'Error Updating Profile';
?>