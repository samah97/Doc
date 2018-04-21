<?php
if(isset($_GET['q'])){
$q=$_GET['q'];
include_once("functions.php");
$type=$_GET['t'];
if($type=="name"){
$inp_id="inp1";
$r=exec_query("select Fname,Lname from patients where Fname like '%".$q."%' or Lname like '%".$q."%'");
}
else{
$inp_id="inp2";
$r=exec_query("select landline,cell from patients where landline like '%".$q."%' or cell like '%".$q."%'");	
}
$sugg="";
while($row=mysqli_fetch_array($r)){
$sugg.="<a href='#' class='list-group-item' onclick=Fill(this.text,'".$inp_id."')>".$row[0]." ".$row[1]."</a>";	
}
echo $sugg;
}
else
	// echo "hii";


?>