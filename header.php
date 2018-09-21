<?php
session_start();

//Logout the user if session changed
if(!isset($_SESSION['user'])){
	header("location:./");
    exit();	
}
//End


//Identifies who is logged in:
//------------------------------------------

switch($_SESSION['role']){
//Doctor
case 1:
$user_info_query=exec_query("select * from doctor where user_id=".$_SESSION['user']);
$user_info_result = mysqli_fetch_assoc($user_info_query);
$_SESSION['doc_id']=$user_info_result['doc_id'];
break;
//Secretary
case 2:
$user_info_query=exec_query("select * from secretary where user_id=".$_SESSION['user']);
$user_info_result = mysqli_fetch_array($user_info_query);
break;

//Patient
case 3:
$user_info_query=exec_query("select * from patients where user_id=".$_SESSION['user']);
$user_info_result = mysqli_fetch_array($user_info_query);
break;
}



// End 

?>



<body dir="ltr">

<nav class="navbar navbar-default">
  <div class="container-fluid">
  <div class="row">
  <div class="container">
  
     <div class="navbar-header">

      <img src='images/<?php echo $user_info_result['image'];?>' class="navbar-brand doc_img"/>

	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
    </div>
	<div class="navbar-collapse collapse ">
    <ul class="menu nav navbar-nav list-group">
	  <li><a href="mobile.php"><span class="glyphicon glyphicon-phone tooltip-container"><span id="mobile-tooltip">Mobile App Management</span></span></a></li>
      <li><a href="home.php" class="active">Home</a></li>
	  <li><a href="patients.php">Patients</a></li>
	  <?php if(isset($_SESSION['patient_id'])){?>
	  <li><a href="patient_info.php">Patient Info</a></li>
	  <li class="dropdown">
	  
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Prescription <span class="caret"></span> </a>
	  <ul class="dropdown-menu">
	  	<li><a href="new_presc.php">New Prescription </a></li>
	  	<li><a href="view_prescriptions.php">View Prescriptions</a></li>
	  </ul>
	  <li><a href="measurements.php">Measurement</a></li>
	  <?php } ?>
	</ul>
	<div class="pull-right">
	  <a href="edit_profile.php"><p class="user-name-head" style="color:#E90954;font-weight:bold">
	  Dr. <?php echo $user_info_result['lname']; ?><span class="glyphicon glyphicon-pencil" id="edit-profile"></span></p></a>
      <p><a href="operations.php?action=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></p>
      <form method="post">
      <p>
      <button id="EN" name="lang" class="language" type="submit" value="en">EN</button>
      <button id="AR" name="lang" class="language" type="submit" value="ar">AR</button>
      </p>
      
      </form>
	</div>
	</div>
	</div>
 </div>
  </div>
</nav>
<?php 
if(isset($_REQUEST['lang']))
{
    $_SESSION['lang']=$_REQUEST['lang'];
}
?>