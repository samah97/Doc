<?php
include_once("functions.php");
include_once("header.php");

unset($_SESSION['patient-id']);
?>

<script>
function Fill(val,id){
	document.getElementById(id).value=val;	
	$("#srchP").hide();
	$("#srchN").hide();
}
</script>



<div class="container sel_patient" id="sel">
<div class="row">
<div class="col-sm-12">
  <h2>Select Patient</h2>
 </div>
 </div>
 <div class="row">
  <div class="col-sm-12">
  <button class="btn" id="new_p" style="float:right;background-color:#ff0000;color:white" data-toggle="modal" data-target="#new_patient">Add New Patient</button>
  </div>
 </div>
<div class="row">
<div class="col-sm-12">
  <form method="post">
	  <div class="form-group">
      <label for="inp1">Patient Name:</label>
      <input type="text" class="form-control" autocomplete=off id="inp1"  name="pname" onkeyup="search('name',this.value,'srchN')">
	  
	<div class="list-group" id="srchN"></div>
	  <label for="inp2">Patient Phone Number</label>
	  <input type="text" class="form-control" id="inp2" autocomplete=off name="phone" value="" onkeyup="search('phone',this.value,'srchP')">
		<div class="list-group" id="srchP"></div><br>
	  <button type="submit" class="btn btn-success" name="select">Select</button> 
	</div>
  </form>
  </div>
  </div>
</div>





<?php
if(isset($_REQUEST['select'])){
	if(isset($_REQUEST['pname']) || isset($_REQUEST['phone'])){
		if(isset($_REQUEST['pname']) && $_REQUEST['pname'] !==""){
			$name=preg_split('/\s+/', $_REQUEST['pname'],2);
	
			$res_patient=exec_query("select * from patients where Fname='".$name[0]."' and Lname='".$name[1]."'");
			}
	
		else {
			$phone=preg_split('/\s+/', $_REQUEST['phone'],2);
			$res_patient=exec_query("select * from patients where landline='".$phone[0]."' and cell='".$phone[1]."'");			
			
			
		}
			if(mysqli_num_rows($res_patient)==0)
				echo "<script>alert('No Patients found!\nAdd new Patient?');</script>";
			else{
				$row_res_patient=mysqli_fetch_array($res_patient);
				$_SESSION['patient-id']=$row_res_patient[0];
				
	
			header("location:".$_REQUEST['goto']);
		}
}
}

if(isset($_REQUEST['add_patient'])){
	
	$ins_patient=exec_query("insert into patients values (null,'".$_REQUEST['p_fname']."','".$_REQUEST['p_mname']."','".$_REQUEST['p_lname']."','".$_REQUEST['p_dob']."','".$_REQUEST['p_land']."','".$_REQUEST['p_cell']."','".$_REQUEST['p_mail']."','".$_REQUEST['p_case']."',".$_SESSION['doc_info'][0].")");
	if($ins_patient)
		echo "Inserted!";
	else
		echo "Not Inserted";
	
}

?>

<div id="new_patient" class="modal fade" data-backdrop="false" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Patient</h4>
     </div>
	 <div class="modal-body">
        <form method="post">
		<div class="form-group">
			<div class="row">
				<div class="col-sm-4">
					<label for="fname">First Name:</label>
				</div>
				<div class="col-sm-8">
					<input class="form-control" name="p_fname" required>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="fname">Middle Name:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="p_mname" required>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="fname">Last Name:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="p_lname" required>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="fname">Date Of Birth:</label>
				</div>
				<div class="col-sm-8">
					<input type="date" class="form-control" name="p_dob" required>
				</div>
			</div>			

			<div class="row">
				<div class="col-sm-4">
					<label for="fname">Landline:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="p_land" required>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4">
					<label for="fname">Cell Phone:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="p_cell" required>
				</div>
			</div>			
			<div class="row">
				<div class="col-sm-4">
					<label for="fname">E-Mail:</label>
				</div>
				<div class="col-sm-8">
					<input type="mail" class="form-control" name="p_mail" >
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="fname">Case:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="p_case" required>
				</div>
			</div>

		</div>
		  
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="add_patient" >Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	</form>
	</div>
  </div>
</div>


<?php



?>



</body>