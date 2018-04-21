<?php
include_once("../functions.php"); 
session_start();

if(!isset($_SESSION["role"])||$_SESSION['role'] !=2){ 
	die ("Access Denied");
}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	.dashboard{
		background-color:grey;
		border-radius:10px;
		
	}
	
	.dash{
		color:#2359BF;
		text-align:center;
		text-shadow: 5px 2px 15px #FFFFFF;
	}
	.navbar-header {
		margin-right:30%;
		border-right:solid 2px #E90954;	
	}
	.dashboard p{
		padding:10px;
		background-color:#93C904;
		border-radius:8px;
		text-align:center;
		margin:5%;
	}
	@media(min-width:992px){
	.dashboard .row{
		border-bottom:solid 2px black;
	}
	}
	#myInput {
    background-image: url('/css/searchicon.png'); /* Add a search icon to input */
    background-position: 10px 12px; /* Position the search icon */
    background-repeat: no-repeat; /* Do not repeat the icon image */
    width: 100%; /* Full-width */
    font-size: 16px; /* Increase font-size */
    padding: 12px 20px 12px 40px; /* Add some padding */
    border: 1px solid #ddd; /* Add a grey border */
    margin-bottom: 12px; /* Add some space below the input */
}
#myTable {
    border-collapse: collapse; /* Collapse borders */
    width: 100%; /* Full-width */
    border: 1px solid #ddd; /* Add a grey border */
    font-size: 18px; /* Increase font-size */
	background-color:grey;
	
}

#myTable th, #myTable td {
    text-align: center; /* Left-align text */
    padding: 8px; /* Add padding */
}

#myTable tr {
    /* Add a bottom border to all table rows */
    border-bottom: 1px solid #ddd; 
}

#myTable tr.header, #myTable tr:hover {
    /* Add a grey background color to the table header and on hover */
    background-color: #f1f1f1;
}




	</style>

	</head>
	<body background="bg.jpg">

	<!-- Navigation -->
		<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <p class="navbar-brand" style="color:#E90954;font-weight:bold">
	  Welcome
		<?php
		$r=exec_query("uni","select Fname from accounts where username='".$_SESSION['usr']."'");
		$row=mysqli_fetch_array($r);
		echo $row[0];
		?>
	  </p>
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
    </div>
	<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
	
      <li ><a href="?action=home">Home</a></li>
      <li><a href="?action=course">Courses</a></li>
      <li><a href="?action=teacher">Teacher</a></li>
      <li><a href="?action=student">Student</a></li>
      <li><a href="?action=att">View Attendance</a></li>
      <li><a href="?action=pwd">Update Password</a></li>
	
	</ul>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="operations.php?action=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	  
    </ul>
  </div>
  </div>
</nav>
<!-- End of Navigation -->
<?php
if(isset($_REQUEST['action'])){
	switch($_REQUEST['action']){
case 'home': break;
case 'course':
?>
<div id="disp_courses" style="display:block">
<!--Table To Display Courses -->
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for courses...">
<table id="myTable" >
  <tr class="header">
    <th style="width:50%;">Course</th>
    <th style="width:50%;">Action</th>
  </tr>


  <?php
//print_r($_SESSION);
  $r=exec_query("uni","select * from course,teacher_course where course.id=teacher_course.course and teacher=".$_SESSION['id']);
  while($row=mysqli_fetch_array($r))
	  echo "<tr><td>".$row[1]."<td>
	  <a href='?action=course&cid=".$row[2]."'><button type='button' class='btn btn-primary' onclick='viewlec()'>View</button></a>
	  <button type='button' class='btn btn-primary' onclick='addlec()'>Add</button>
  </div>";
 ?>
</table>
</div>
<!-- End of display courses table -->
<!-- Begining of display lectures table-->
<div id="disp_lecs" style="display:none">

<a href="?action=course"><button type='button' class='btn btn-danger' style="margin-bottom:2%;" onclick='viewcourses()'><<</button></a>
<button type="button" class="btn btn-success" style="float:right;margin:1%;" data-toggle="modal" data-target="#myModal">Add new Lecture</button>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Lecture</h4>
        </div>
		<?php
		$_SESSION['cid']=$_REQUEST['cid'];
		?>
		<form id="insert_form" method="post" action="operations.php?action=addlec"> 
        <div class="modal-body">
			<div class="form-group">
					<label for="pwd">Date</label>
					<input type="date" class="form-control" name="lec_date">
			</div>
        </div>
		
        <div class="modal-footer">
          <button type='button' class="btn btn-default" data-dismiss="modal" name="add_lec" onclick="form_submit();">Add</button>
        </div>
      </div>
	  <script>
	  function form_submit(){
	document.getElementById("insert_form").submit();
	  }	  
	  </script>
      </form>
    </div>
  </div>

<!-- End of Modal-->

<table id="myTable">
  <tr class="header">
    <th style="width:50%;">Date</th>
    <th style="width:25%;">Students Attended</th>
	<th style="width:25%;">Action</th>
  </tr>

  <?php
//print_r($_SESSION);
  $r=exec_query("uni","select * from lectures where   teacher=".$_SESSION['id']." and course=".$_REQUEST['cid']);
  while($row=mysqli_fetch_array($r))
	  echo "<tr><td>".$row[3]."<td><td><div class='btn-group'>
	  <button type='button' class='btn btn-primary'>View</button>
	  <button type='button' class='btn btn-primary'>View</button>
	  
  </div>";
 ?>
</table>
  <script>
	$(document).ready(function() {
		$(#insert_form).on('submit',function(event){
			event.preventDefault();
			
	$.ajax({  
    url:"insert.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
  
    success:function(data){  
     $('#insert_form')[0].reset();  
     $('#add_data_Modal').modal('hide');  
     $('#employee_table').html(data);  
    }  
   });  
		
		
	});
	}
  </script>
<!-- End of display lectures table-->
	  	  <script>
function viewlec(){
		$('#disp_courses').css('display', 'none');
		$('#disp_lecs').css('display', 'block');
		event.preventDefault();
	}
function viewcourses(){ 
		$('#disp_courses').css('display', 'block');
		$('#disp_lecs').css('display', 'none');
}
</script>

</div>


<?php

	break;
	}}
	else $_REQUEST['action']='home';
