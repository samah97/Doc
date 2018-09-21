<?php 
include '../functions.php';
session_start();

extract($_POST);


//echo mysqli_insert_id()

$password=password_hash(strtolower($patient_name),PASSWORD_DEFAULT);
$username=strtolower($patient_name."_".$patient_lname);
$addUser=exec_query("insert into users(username,password,email,role,is_active) values ('".$username."','".$password."','".$patient_email."',2,1)");

$getMax=exec_query("select MAX(user_id) as user_id from users");
$getMax=mysqli_fetch_assoc($getMax);

$result="insert into patients(Fname,Mname,Lname,dob,gender,building,street,city,country,landline,cell,mail,date_first_visit,patient_case,Doc_id,other_details,user_id) values";
$result.="('".$patient_name."','".$patient_mname."','".$patient_lname."','".$patient_dob."','".$patient_gender."','".$patient_building."','".$patient_street."','".$patient_city."','".$patient_country."','".$patient_landline."','".$patient_phone."','".$patient_email."','".$patient_first_visit."','".$patient_case."',".$_SESSION['doc_id'].",'".$patient_other_details."',".$getMax["user_id"].")";



$insert=exec_query($result);



if($insert) echo 1;
else echo 0;

?>


