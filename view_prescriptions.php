
<?php include_once("functions.php");?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/view_prescriptions.css">
	<!-- jQuery library -->
	<script src="js/jquery-3.3.1.min.js"></script>
		
	<!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/measurements.css">

	<script type="text/javascript" href="js/main.js"></script>
	
	<!--Slick-->
	<link rel="stylesheet" type="text/css" href="plugins/slick/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="plugins/slick/slick/slick-theme.css"/>

	<script type="text/javascript" src="plugins/slick/slick/slick.min.js"></script>
	<!--End -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
	
	<!-- Alertify Plugin -->
	<script src="plugins/alertify/alertify.js"></script>

	<link rel="stylesheet" href="plugins/alertify/css/alertify.min.css" />
	
	<link rel="stylesheet" href="plugins/alertify/css/themes/default.min.css" />
	<!-- End -->
	
	<!-- DataTable plugin -->
	<link rel="stylesheet" href="plugins/DataTables/dataTables.bootstrap.min.css" />
	<script src="plugins/DataTables/jquery.dataTables.min.js" ></script>
	<script src="plugins/DataTables/dataTables.bootstrap.min.js"> </script>
	<!-- End of DataTable -->
	
	<!-- Zoom Plugin -->
<script src="plugins/jquery.elevatezoom.js" type="text/javascript"></script>
	<!-- End of Zoom -->
	
	<!--Custom Select box--> 
<link href="css/select2.min.css" rel="stylesheet" />
<script src="js/select2.min.js"></script>
<!-- End -->

<?php
include_once "header.php";


if(isset($_REQUEST['btn-back'])){
	 $reset=exec_query("delete from temp_presc where session_id='".session_id()."' and patient_id=".$_SESSION['patient_id']);
	 unset($_SESSION['patient_id']);
	 }

if(!isset($_SESSION['patient_id']))
	header("location:patients.php");

$get_patient=exec_query("select * from patients where patient_id=".$_SESSION['patient_id']);
$row_res_patient=mysqli_fetch_array($get_patient);
?>
<script>	</script>
</head>
<body>
<div class="container-fluid">
<div class="row">

<div class="container">

	<div class="row">
	<div class="col-sm-12">
	<form method="post">
	<button type="submit" class="btn" name="btn-back" ><i class="fa fa-arrow-left"></i> Choose Another </button>
	</form>
	</div>
	</div>
	
	<div class="row">
	<div class="col-md-12">
	<?php
	$query="select * from prescription p,medicine m,types t where p.med_id=m.id and m.type_id=t.type_id and doc_id=".$_SESSION['doc_id']." and patient_id=".$_SESSION['patient_id']." order by prescription_date desc";
	$getPrescriptions=exec_query($query);
	if(mysqli_num_rows($getPrescriptions)<1){
	    ?>
	    <div align=center>
	    <h3 align=center>No Prescriptions Found</h3>
	    <button type="button" class="btn btn-success" onclick="window.location.href='new_presc.php'">Add New Prescription</button>
	    </div>
	    <?php  
	}
	else{
	    ?>
	    <table id="prescriptions-table" class="table table-bordered prescriptions-table">
	    <thead>
	    <tr><th>Date<th>Medicine Name<th>Standard<th>Pills<th>Type<th>Time<th>Description</th></tr>
	    </thead>
	    <tbody>
	    <?php 
	    while($row=mysqli_fetch_array($getPrescriptions)){
	    ?>
	    <tr>
	    <?php 
	    echo "<td>".$row["prescription_date"]."<td>".$row["name"]."<td>".$row["standard"]."<td>".$row["pill"]."<td>".$row["type_name"]."<td>".$row['time']."<td>".$row["description"];
	    ?>
	    </tr>
	    <?php }?>
	    </tbody>
	    </table>
	    <?php 
	}
	?>
	</div>
	</div>
	
</div>
</div>
</div>

<script>
$('#prescriptions-table').DataTable();
</script>

</body>

<?php 

if(isset($_REQUEST['btn-back'])){
    $reset=exec_query("delete from temp_presc where session_id='".session_id()."' and patient_id=".$_SESSION['patient_id']);
    unset($_SESSION['patient_id']);
}
?>