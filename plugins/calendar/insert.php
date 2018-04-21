<?php

//insert.php
$connect = new PDO('mysql:host=localhost;dbname=doctor', 'root', '');
if(!isset($_SESSION['doc_id']))
session_start();


if(isset($_POST["title"]))
{

 $query = "
 INSERT INTO schedule 
 (doctor_id,title, start_event, end_event) 
 VALUES (".$_SESSION['doc_id'].",:title, :start_event, :end_event)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
  )
 );
}
//':doc_id'=>1

?>