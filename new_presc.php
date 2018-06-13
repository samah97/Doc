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
	<link rel="stylesheet" type="text/css" href="css/patients.css">-->
	<link rel="stylesheet" type="text/css" href="css/sel_patient.css">
	<link rel="stylesheet" type="text/css" href="css/new_presc.css">
	<!--<link rel="stylesheet" type="text/css" href="css/patient_info.css">-->
	
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

	
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
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

function print_frame() {
  window.frames["print-prev"].focus();
  window.frames["print-prev"].print();
  window.frames["print-prev"].button.style.visibility='hidden';
}
</script>
</head>
<body>
<div class="container-fluid">
<div class="row">

<div class="container" id="presc">
<div class="row">

<div class="col-sm-12">
	<form method="post">
	<button type="submit" class="btn" name="btn-back" ><i class="fa fa-arrow-left"></i> Choose Another </button>
	</form>
</div>

<div class="col-sm-12 patient-name">
	<h3>Patient: <span style="font-family:cursive;color:green;"><?php echo $row_res_patient['Fname']." ".$row_res_patient['Mname']." ".$row_res_patient['Lname']; ?></span>
	</h3>
</div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-6 col-lg-6">
	<iframe src="print-pres.php" name="print-prev" width=100%></iframe>
  </div>
  
  <div class="col-sm-12 col-md-6 col-lg-6">
	
     <form method="post">
	 <table class="table tab-presc">
		<tr>
			<td><label for="inp_med">Medicine:</label><td>
			<select class="js-example-basic-single" name="mnames" style="width:200px;">
			<?php
			$get_meds=exec_query("select * from medicine order by Name asc");
			while($row_get_meds=mysqli_fetch_array($get_meds))
				echo "<option value=".$row_get_meds['id'].">".$row_get_meds['name']."</option>";
			
			?>
			</select>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#new_med"><i class="fa fa-plus"></i></button>
			
		<tr>
			<td><label for="nbr_pill">Number of Pills:</label><td><input type="number" required class="form-control input-sm" min=1 value=1 name="nbr_pills" id="nbr_pill">
		<tr>
			<td><label style="text-align:center;">Time of Day:</label>
			<td>
			
			<label>
			<input type="checkbox" name="check_list[]" value="morning" checked>
			<img src="icons/morning.jpeg">
			</label>
			
			<label>
			<input type="checkbox" name="check_list[]" value="day">
			<img src="icons/day.jpg">
			</label>
			
			<label>
			<input type="checkbox" name="check_list[]" value="night">
			<img src="icons/night.jpg">
			</label>
			</td>
		<tr>
		<td colspan=3><textarea class="form-control" rows=4 name="desc"></textarea>
		<tr>
		<td>
		<button class="btn" name="add" type="submit" onclick="Add();">Add</button>
		<button class="btn" name="reset">Reset</button>
		<tr>
		<td style="display:inline-block;"><button class="btn btn-success" name="printf" id="printf"  onclick="print_frame()">Print Preview</button></td>
		<td ><button class="btn btn-success " name="save">Save</button>
	</table>
	</form>
 </div>
  </div>

</div>
<!--Modal-->  
 <div id="new_med" class="modal fade" data-backdrop="false" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Medicine</h4>
</div>
	 <div class="modal-body">
        
		<div class="form-group">
			<div class="row">
				<div class="col-sm-4">
					<label for="mname">Medicine Name:</label>
				</div>
				<div class="col-sm-8">
					<input class="form-control" name="med_name" required>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="standard">Standard:</label>
				</div>
				<div class="col-sm-8">
					<input type="number" class="form-control" name="standard" required>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Medicine Type:</label>
				</div>
				<div class="col-sm-8">
					<select name="medicine_type" class="form-control">
					<?php $get_types=exec_query("select * from types");
					      while($row=mysqli_fetch_assoc($get_types))
					      echo "<option value=".$row["type_id"].">".$row["type_name"]."</option>";
					?>
							
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<label for="med_desc">Description</label>
				</div>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="med_desc" required>
				</div>
			</div>

		</div>
		
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="add_med" >Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
	</div>
  </div>
</div>
<!--End Of Modal-->	  
 
</div>
<script defer src="js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
<script defer src="js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>

<?php
if(isset($_REQUEST['add'])){

	$checked="";
	foreach($_REQUEST['check_list'] as $check)
	$checked.=$check." / ";
	 $ins_pres=exec_query("insert into temp_presc(session_id,patient_id,med_id,pill,time,description) values ('".session_id()."',".$_SESSION['patient_id'].",".$_REQUEST['mnames'].",".$_REQUEST['nbr_pills'].",'".substr($checked, 0, -3)."','".$_REQUEST['desc']."')");		
	}
	if(isset($_REQUEST['save'])){
	    
	    
	    $query="select * from temp_presc where session_id='".session_id()."'";
	    $getPrescriptions=exec_query($query);
	    $query="insert into prescription(doc_id,patient_id,med_id,pill,time,description,prescription_date) values ";
	    while($row=mysqli_fetch_assoc($getPrescriptions)){
	        $query.="(".$_SESSION['doc_id'].",".$_SESSION['patient_id'].",".$row['med_id'].",".$row['pill'].",'".$row['time']."','".$row['description']."','".date('Y-m-d')."'),";
	    }
	    $query=substr($query,0,-1);
	    $insert=exec_query($query);
        $delete=exec_query("delete from temp_presc where session_id='".session_id()."'");
	    
	    
	}
	
if(isset($_REQUEST['reset'])){
	$reset=exec_query("delete from temp_presc where session_id='".$_SESSION['patient_id']."'");
}
 if(isset($_REQUEST['add_med'])){
	 $row=exec_query("insert into medicine(Name,Standard,type_id,Description) values('".$_REQUEST['med_name']."','".$_REQUEST['standard']."',".$_REQUEST['medicine_type'].",'".$_REQUEST['med_desc']."')");
 }



