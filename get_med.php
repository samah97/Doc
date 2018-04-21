<?php

if(isset($_REQUEST['q']))
{
include_once "functions.php";
$r=exec_query("select Name from medicine where name like '%".$_REQUEST['q']."%'");
$mnames="";
while($row=mysqli_fetch_row($r))
$mnames.="<a href='#' class='list-group-item' onclick='document.getElementById('mname').innerHTML=this.text'>".$row[0]."</a>";	

echo $mnames;
}
?>