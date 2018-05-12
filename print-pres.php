<?php
session_start();
include_once("functions.php");

if(isset($_REQUEST['del_id'])){
	$del_med=exec_query("delete from temp_presc where id=".$_REQUEST['del_id']);
}

$get_doctor_details=exec_query("select * from doctor where doc_id=".$_SESSION['doc_id']);
$doctor_details_result=mysqli_fetch_assoc($get_doctor_details);

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/print-presc.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</head>

<style>


</style>
<body style="background-color:white">
<div class="header">
<h4> Dr. <?php echo  $doctor_details_result['fname']." ".$doctor_details_result['lname'];?></h4>
<h5>Phone: <?php echo $doctor_details_result['phone']?>
<span style="float:right">Date: <?php echo Date('d-m-Y');?> </span>
</h5>
<hr style="background:black; border:0; height:5px" />
</div>

<div class="data">
<table>
<?php
$get_temp_presc=exec_query("select * from temp_presc where session_id='".session_id()."' and patient_id=".$_SESSION['patient_id']);
$i=1;
while($temp_presc_result=mysqli_fetch_assoc($get_temp_presc)){
	$get_med_name=exec_query("select name from medicine where id=".$temp_presc_result['med_id']);
	$med_name_result=mysqli_fetch_assoc($get_med_name);

	echo "<tr><td><div class='data-rows'>
	".$i.")<table><tr><td colspan=2><b>".$med_name_result['name']."</b>
	<td> <a href='?del_id=".$temp_presc_result['id']."'><button class='btn btn-danger pull-right'  >X</button></a>
	<tr><td><td>".$temp_presc_result['pill']." Pill(s)
	<tr><td><td>".$temp_presc_result['time']."<tr>
	";
	if(isset($temp_presc_result['description']))
	echo "
	<td><td style='color:grey'><i>(".$temp_presc_result['description'].")</i></table></div></td></tr>";
	$i++;
	}
?>
</table>
</div>
</body>

</html>
