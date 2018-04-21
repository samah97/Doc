<?php include_once("../functions.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	.doc_img{
		height:90px;
		float:LEFT;
	}

	</style>
	 </head>

  <body background="bg1.jpg">

		
		<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
		  <?php $r=exec_query("doctor","select * from users where Userid='".$_SESSION['user']."' ");
		$row=mysqli_fetch_array($r);
	  ?>
      <img src='images/<?php echo $row[6];?>.jpg' class="navbar-brand doc_img" align=left/>
	  <p class="navbar-brand" style="color:#E90954;font-weight:bold">
	  Welcome Dr. <?php echo $row[1]; ?> </p>
	  
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
   <?php
   //print_r($_SESSION);
   if(isset($_REQUEST['action'])){
	   switch($_REQUEST['action']){
		   case 'home':
   ?>
  <div class="container dashboard">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="dash">Admin Dashboard</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-4 col-lg-4">
		<p>Total Lectures</p>
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
		<p>Total Registered Students</p>
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
		<p>Total Registered Teacher</p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-4 col-lg-4">
		<p>Total Active Teacher</p>
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
		<p>Total Deactive Teacher</p>
		</div>
	</div>
</div>	
<div class="container dashboard" style="margin-top:3%;">
	<div class="row">
	<div class="col-sm-12 accounts-verf">
		<h3>Accounts to be verified</h2>
	</div>
	</div>
	<div class="row">
	<h4 data-toggle="collapse" style="margin-left:1%;" data-target="#demo"><span class="glyphicon glyphicon-chevron-right"><span class="accounts-head">Teachers</span></h4>
  <div id="demo" class="collapse" >
   <ul class="list-group">
   <?php 
   $r=exec_query("uni","select * from accounts where role=2 and active=0");
   if(mysqli_num_rows($r)==0){
	?>
  <li class="list-group-item">No Teachers waiting for verification</li>
   <?php 
   }
	else {
	while($row=mysqli_fetch_array($r))
	echo "<li class='list-group-item'>". $row[4]." ".$row[5]." <button type='button' onclick=javascript:window.location='../Login/operations.php?action=verify&id=".$row[0]."' class='badge btn btn-sm btn-info'> Verify</button><button data-toggle='modal' data-target='#view-modal' data-id='".$row[0]."' id='getUser' class='badge btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> View</button> </li>";
	}?>
  </ul>
  </div>
	</div>
	
	<div class="row">
	<h4 data-toggle="collapse" style="margin-left:1%;" data-target="#demo1"><span class="glyphicon glyphicon-chevron-right"><span class="accounts-head">Students</span></h4>
  <div id="demo1" class="collapse">
   <ul class="list-group">
   <?php 
   $r=exec_query("uni","select * from accounts where role=3 and active=0");
   if(mysqli_num_rows($r)==0)
   {
	?>
  <li class="list-group-item">No Students waiting for verification</li>
   <?php 
   }
	else {
	while($row=mysqli_fetch_array($r))
	echo "<li class='list-group-item'>". $row[4]." ".$row[5]." <button type='button' onclick=javascript:window.location='../Login/operations.php?action=verify&id=".$row[0]."' class='badge btn btn-sm btn-info'> Verify</button><button data-toggle='modal' data-target='#view-modal' data-id='".$row[0]."' id='getUser' class='badge btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> View</button> </li>";
	}?>
  </ul>
  </div>
	</div>
	
  </div>
   
   <!-- Modal -->
 <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> User Profile
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>
                       
                       	   <div id="dynamic-content">
                                        
                           <div class="row"> 
                                <div class="col-md-12"> 
                            	
                            	<div class="table-responsive">
                            	
                                <table class="table table-striped table-bordered">
                           		<tr>
								<td id="prod_name"></td>
								<td id="prod_quantity"></td>
								<td id="prod_total"></td>
                            	<td id="txt_fname"></td>
                                </tr>
                                     
                                <tr>
                            	<th>Last Name</th>
                            	<td id="txt_lname"></td>
                                </tr>
                                       		
                                <tr>
                                <th>Email ID</th>
                                <td id="txt_email"></td>
                                </tr>

                                       	
                                       		
                                </table>
                                
                                </div>
                                       
                                </div> 
                          </div>
                          
                          </div> 
                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div><!-- /.modal -->    
<!--End of Model -->
   
   <script>
	$(document).ready(function(){

    $(document).on('click', '#getUser', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content').html(''); // leave this div blank
     $('#modal-loader').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'getuser.php',
          type: 'POST',
          data: 'id='+uid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content').html(''); // blank before load.
          $('#dynamic-content').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
     })
     .fail(function(){
          $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });
});

   </script>
   
   
  
  
  
  
  
	<?php
		break;
	case 'course':
	print_r($_REQUEST);
	?>
	<div id="disp_courses">
	<button type='submit' class='btn btn-success' style="float:right;margin:1%;" onclick="hide_table()">Add new Course</button>
	
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

<table id="myTable">
  <tr class="header">
    <th style="width:50%;">Course</th>
    <th style="width:50%;">Action</th>

	
  </tr>
  
  <?php
  $r=exec_query("uni","select * from course");
  while($row=mysqli_fetch_array($r))
	  echo "<tr><td>".$row[1]."<td><div class='btn-group'>
	  <button type='button' class='btn btn-primary' onclick='lecdelete(".$row[0].")'>Delete</button>
  </div>";
 ?>
</table>
</div>
<div id="add_lec" style="display:none" class="container add_lec">
<form method="post" action="operations.php?action=addcourse">
	<div class="row">
	<div class="form-group">
	<div class="col-sm-12">
	<label for="usr">Course Name:</label>
	<input type="text" class="form-control" placeholder="Enter Course Name"  name="name">
	<button type='submit' class='btn btn-success' style="margin-left:40%;margin-top:2%;" >Add </button>
	</div>
	</div>
	</div>
</form>
	</div>

<?php
	break;
   
   case 'teacher':header("location:soon");break;
   case 'student':header("location:soon");break;
   case 'att':header("location:soon");break;
   case 'pwd':header("location:soon");break;
	   }
   }
?>
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

function hide_table(){
		//document.getElementById('disp_courses').style.display=none
		$('#disp_courses').css('display', 'none');
		$('#add_lec').css('display', 'block');
	}
</script>
   </body>
  
