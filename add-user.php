<?php 
include 'functions.php';

$username="samah";
$password=password_hash("samah", PASSWORD_DEFAULT);

$result=exec_query("insert into users(user_id,username,password,email,role,is_active) values (1,'".$username."','".$password."','samah_daou@hotmail.com',1,1) ");

print_r( $result);

?>