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
		
	<!-- Alertify Plugin -->
	<script src="plugins/alertify/alertify.js"></script>

	<link rel="stylesheet" href="plugins/alertify/css/alertify.min.css" />

	<link rel="stylesheet" href="plugins/alertify/css/themes/default.min.css" />
	<link rel="stylesheet" href="plugins/alertify/css/themes/semantic.css" />
	<link rel="stylesheet" href="plugins/alertify/css/themes/bootstrap.css" />
	<!-- End -->
<link href="css/select2.min.css" rel="stylesheet" />
<script src="js/select2.min.js"></script>
<script src="js/script.js"></script>
</head>
<body>


<?php
include_once("header.php");
?>

	<body>
	
		
<div class="container" <?php if($_SESSION['lang']=='ar') echo "dir='rtl'"; ?>>
  <div class="row">
	<div class="col-sm-10 ">
	<i class="fa fa-search search-icon"></i>
	<input type="text" onkeyup="search_patients()" id='search' class="srch-patients" <?php if($_SESSION['lang']=='ar') echo "placeholder='بحث'"; else?>placeholder="Search For Patient">
	</div>
	<div class="col-md-2">
	<button class="btn btn-success pull-right" id="add-name"><?php if($_SESSION['lang']=='ar') echo "اضف اسما"; else echo "Add Patient";?></button>
	</div>
  </div>
  <div class="row">
	<div class="col-sm-12">
  <table class="table table-bordered patients" id="patients-table"  >
    <thead>
      <tr>
      	<?php if($_SESSION['lang']=='en'){?>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Middle Name</th>
        <th>Phone Number</th>
        <th>Landline</th>
        <?php }
        else{
        ?>
        <th>الاسم</th>
        <th>شهرة</th>
        <th>اسم الأب</th>
        <th>الخليوي</th>
        <th>هاتف</th>
        <?php }?>        
      </tr>
    </thead>
    <tbody>
	<form method="post">
		<?php
		$get_patients_query=exec_query("select * from patients where Doc_id=".$_SESSION["doc_id"]);
		while($get_patient_result=mysqli_fetch_array($get_patients_query)){
			echo "<tr onclick=goTo(".$get_patient_result["patient_id"].")><td value=".$get_patient_result["patient_id"].">".$get_patient_result["Fname"]."</td><td>".$get_patient_result["Lname"]."<td>".$get_patient_result['Mname']."<td>".$get_patient_result["cell"]."<td>".$get_patient_result['landline']."</tr>";
		}
		?>
	</form>
    </tbody>
  </table>
	</div>

   </div>
</div>
<!-- Trigger/Open The Modal -->


<!-- The Modal -->
<div id="myModal" class="modal">
	<?php 
    if($_SESSION['lang']=='en'){
    ?>


  <!-- Modal content -->
  <div class="modal-content">
  <form method="post" id="patient-form" onsubmit="submitPatientForm()">
    <span class="close">&times;</span>
    <div class="modal-header">
    <h2>Add Patient</h2>
  	</div>
  	<div class="modal-body">
    
    <label>First Name:</label><input type="text" class="form-control" name="patient_name" />
    <label>Last Name:</label><input type="text" class="form-control" name="patient_lname" /> 
    <label>Middle Name:</label><input type="text" class="form-control" name="patient_mname" />
    <label>Gender:</label><select name="patient_gender" class="form-control">
    					<option value="M">Male</option>
    					<option value="F">Female</option>
    					</select>
    <label>Date of Birth:</label><input type="date" class="form-control" name="patient_dob" />
    <label>Email:</label><input type="email" class="form-control" name="patient_email" >					
	<label>Landline:</label><input type="phone" class="form-control" name="patient_landline" />		 
    <label>Phone Number:</label><input type="phone" class="form-control" name="patient_phone" />
    <label>Country</label><input type="text" class="form-control" name="patient_country">
    <label>City</label><input type="text" class="form-control" name="patient_city">
    <label>Street</label><input type="text" class="form-control" name="patient_street">
    <label>Building</label><input type="text" class="form-control" name="patient_building">		
    <label>Case: </label><textarea name="patient_case" class="form-control"></textarea>
    <label>First Visit</label><input type="date" class="form-control" name="patient_first_visit" id="first-visit-date"> 
    <label>Other Details: </label><textarea name="patient_other_details" class="form-control"></textarea>
    
    
    </div>
    <div class="modal-footer">
    <button class="btn btn-warning pull-right">Add</button>
    </div>
    </form>
  </div>
	
<?php }?>
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

function goTo(id){
	window.location.href="operations.php?p_id="+id+"&action=view-patient";
}

//Modal OPen
//Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("add-name");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.getElementById("first-visit-date").valueAsDate = new Date();

   
//override defaults

alertify.defaults.transition = "zoom";
alertify.defaults.theme.ok = "ui positive button";
alertify.defaults.theme.cancel = "ui black button";
function submitPatientForm(){
	event.preventDefault();
	var form=$("#patient-form").serializeArray();
	console.log(form);

    $.ajax({
        type: 'POST',
        url: 'assets/addPatient.php',
        data: form,


        success: function(msg){
            //console.log(msg);
			if(msg==1){
			
			alertify.confirm("Patient Added",function(){location.reload();});
				}
			else 
				alertify.alert("Something went wrong");
		     
        },
    error: function(msg){
		alertify.alert(msg);
        }
    });
	
}


</script>
	</body>
