 
<?php include_once("functions.php");?>
<?php 

$result=exec_query("select * from doctor where doc_id=1");
$row=mysqli_fetch_assoc($result);

return print_r(json_encode($row));
?>