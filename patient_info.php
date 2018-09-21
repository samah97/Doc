<?php include_once("functions.php");?>
<html>
<head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="js/jquery-3.3.1.min.js"></script>
		
	<!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<!--<link rel="stylesheet" type="text/css" href="css/schedule.css">
	<link rel="stylesheet" type="text/css" href="css/patients.css">
	<link rel="stylesheet" type="text/css" href="css/sel_patient.css">
	<link rel="stylesheet" type="text/css" href="css/new_presc.css">-->
	<link rel="stylesheet" type="text/css" href="css/patient_info.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="conainer-fluid">
<div class="row">
<?php
include_once("header.php");
?>
</div>
<?php
$patient_info_query=exec_query("select * from patients where patient_id=".$_SESSION['patient_id']);

$patient_info_result=mysqli_fetch_assoc($patient_info_query);

/* if($patient_info_result["address_id"]!==null){
$address=exec_query("select * from addresses where address_id=".$patient_info_result["address_id"]);
$address_row=mysqli_fetch_array($address);
} */

function get_age($dob){
	
	$date1=new DateTime($dob);
	$curDate=new DateTime(date('Y-m-d'));
	$interval = $date1->diff($curDate);
	if($interval->y >0)
		return $interval->y;
	else{
		return $interval->m." months and ".$interval->d." days";
	}
}
if(isset($_REQUEST['btn-back'])){	
	 header("location:patients.php");
	 }
?>

<div class="container">

	<div class="row" style="margin-bottom:30px;">
		<div class="col-md-12">
		<form method="post">
			<button class="btn btn-choose-pat pull-left" name="btn-back" type="submit"><i class="fa fa-arrow-left"></i> Choose Another </button> 
		</form>
		</div>
	</div>
	
	<div class="row about">
	<div class="col-md-12">
	<div class="about-patient">
	<h2>About patient</h2>
	
	<div class="pull-left">
	<table>
	<tr><td>Patient Number:<td><?php echo $patient_info_result["patient_id"];?></td></tr>
	<tr><td>Full Name:<td><?php echo $patient_info_result["Fname"]." ".$patient_info_result["Mname"]." ".$patient_info_result["Lname"]; ?></td></tr>
	<tr><td>Age:<td><?php echo get_age($patient_info_result["dob"]); ?></td></tr>
	<tr><td>Gender:<td><?php echo $patient_info_result["gender"]; ?></td></tr>
	</table>
	</div>
	<div class="pull-right">
	<table>
	<tr><td>Address:<td><?php
		    echo $patient_info_result["building"].", ".$patient_info_result["street"].", ".$patient_info_result["city"].", ".$patient_info_result["country"];
		?>
	</td></tr>
	<tr><td>Landline:<td><?php echo $patient_info_result["landline"]; ?></td></tr>
	<tr><td>Cell Phone:<td><?php echo $patient_info_result["cell"]; ?></td></tr>
	</table>
	</div>
	</div>
	</div>
	</div>
	
	<div class="row">
	<div class="col-md-12">
	<?php include("highchart.php"); ?>
	</div>
	</div>

	
</div>