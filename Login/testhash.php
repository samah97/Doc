<?php
include("../functions.php");

$r=exec_query("doctor","insert into users (userid,password) values ('Samah','".password_hash('samah123',PASSWORD_DEFAULT)."')");
?>
