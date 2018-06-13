<?php
include 'functions.php';

extract($_POST);
//print_r($_POST);

$login_query=exec_query("select * from users where username='".$username."' and role=2 and is_active=1" );

$array=array();

$login_result=mysqli_fetch_array($login_query);

if(mysqli_num_rows($login_query)>0 && password_verify($password,$login_result['password'])){
    
    $get_data=exec_query("select * from patients where user_id=".$login_result['user_id']);
    $row=mysqli_fetch_assoc($get_data);
    $array["info"]=array($row)  ;
    $array["result"]="true";
    $array["message"]="Login Successful";
}

else {
    $array["result"]="false";
    $array["message"]="Wrong username or password";
}
    
echo json_encode($array);

?>