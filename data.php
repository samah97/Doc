<?php

function exec_query($sql){
	
	$con=mysqli_connect("localhost","root","","doctor");
	if(!$con)
		die ("Error while connecting".mysqli_error($con));
	$r=mysqli_query($con,$sql);
	
	if(!$r)
		die("Error in query: ".$sql." Error: ".mysqli_error($con));
	
	mysqli_close($con);
	return $r;
	
}

session_start();
$result=exec_query('select date_of_meas,Height from measurements where Patient_id='.$_SESSION['patient-id']);
$data=array();

while($row=mysqli_fetch_array($result)){
$data[]=array($row[0],$row[1]);	
}
print_r($data);
?>

<br>
<br>
<br>
<br>
<br>
<br>
 <?php

// $line_chart_data=array(
				// array(
					// array("Jan",48.25),
					// array("Feb",238.75),
					// array("Mar",95.50),
					// array("Apr",300.50),
					// array("May",286.80),
					// array("Jun",400)),
				// array(
					// array("Jan",300.25),
					// array("Feb",225.75),
					// array("Mar",44.50),
					// array("Apr",259.50),
					// array("May",250.80),
					// array("Jun",300)),
				// array(
					// array("Jan",148.25),
					// array("Feb",248.75),
					// array("Mar",195.50),
					// array("Apr",230.50),
					// array("May",260.80),
					// array("Jun",365)),
				// array(
					// array("Jan",256.25),
					// array("Feb",125.75),
					// array("Mar",344.50),
					// array("Apr",299.50),
					// array("May",150.80),
					// array("Jun",370))
					// );
					
// print_r($line_chart_data);