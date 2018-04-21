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
	<link rel="stylesheet" type="text/css" href="css/schedule.css">
	<link rel="stylesheet" type="text/css" href="css/patients.css">
	<link rel="stylesheet" type="text/css" href="css/sel_patient.css">
	<link rel="stylesheet" type="text/css" href="css/new_presc.css">
	<link rel="stylesheet" type="text/css" href="css/patient_info.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
	<!--For Full Calendar -->
	<link rel="stylesheet" href="css/fullcalendar.css"/>
   <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	
	
	<!--End of Calendar -->
	
<link href="css/select2.min.css" rel="stylesheet" />
<script src="js/select2.min.js"></script>
<script src="js/script.js"></script>
</head>
<body>
<div class="container-fluid">
<div class="row">
	
<?php
include_once("header.php");
?>
</div>
<div class="row">
<?php include_once("plugins/calendar/index.php");?>

  
</div>
</div>
</body>
</html>