<?php 

extract($_POST);

$updateInfo=exec_query("update doctor set fname='".$fname."',lname='".$lname."', email='".$email."', landline='".$landline."', phone='".$phone."',dob= '".$dob."'");

if($updateInfo){
    echo true;
}
else echo false;
?>