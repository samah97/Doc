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
	<link rel="stylesheet" type="text/css" href="css/patients.css">
	<!--<link rel="stylesheet" type="text/css" href="css/sel_patient.css">-->
	
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


<?php
include_once("header.php");
?>

	<body>
	
		
<div class="container">
  <div class="row">
	<div class="col-sm-12">
	<input type="text" onkeyup="search_patients()" id='search' class="srch-patients" placeholder="Search For Patient">
	</div>
  </div>
  <div class="row">
	<div class="col-sm-12">
  <table class="table table-bordered patients" id="patients-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Case</th>
      </tr>
    </thead>
    <tbody>
	<form method="post">
		<?php
		$get_patients_query=exec_query("select * from patients where Doc_id=".$_SESSION["doc_id"]);
		while($get_patient_result=mysqli_fetch_array($get_patients_query)){
			echo "<tr><td value=".$get_patient_result["patient_id"]."><a href='operations.php?p_id=".$get_patient_result["patient_id"]."&action=view-patient'>".$get_patient_result["Fname"]." ".$get_patient_result["Lname"]."</a><td>".$get_patient_result["case"];
		}
		?>
	</form>
    </tbody>
  </table>
	</div>
   </div>
</div>
<script>
function search_patients() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("patients-table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[0];
    td2=tr[i].getElementsByTagName("td")[1];
    if (td1 || td2) {
      if (td1.innerHTML.toUpperCase().indexOf(filter) > -1){ 
        td1.style.background="yellow";  
        td2.style.background="#ddd";
        tr[i].style.display = "";
      } else 

          if(td2.innerHTML.toUpperCase().indexOf(filter) >-1) {
              td1.style.background="#ddd";
              td2.style.background="yellow";  
              tr[i].style.display = "";
          }
          else
          {
        	  td2.style.background="#ddd";
              td1.style.background="#ddd"; 
      		  tr[i].style.display = "none";

          }
      }
    } 
  }

</script>
	</body>
