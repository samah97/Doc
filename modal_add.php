<?php

if(isset($_REQUEST['add_patient'])){
	
	$ins_patient=exec_query("insert into patients values (null,'".$_REQUEST['p_fname']."','".$_REQUEST['p_mname']."','".$_REQUEST['p_lname']."','".$_REQUEST['p_dob']."','".$_REQUEST['p_land']."','".$_REQUEST['p_cell']."','".$_REQUEST['p_mail']."','".$_REQUEST['p_case']."',".$_SESSION['doc_info'][0].")");
	if($ins_patient)
		echo "Inserted!";
	else
		echo "Not Inserted";
	
}


?>
