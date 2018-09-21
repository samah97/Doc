<?php
if(isset($_POST["Token"])){
	$token=$_POST["Token"];
	$con=mysqli_connect("localhost","root","","doctor");
	$query="INSERT INTO users_token(token) VALUES ('".$token."') ON DUPLICATE KEY UPDATE token='".$token."';";
	
	mysqli_query($con,$query);
	mysqli_close($con);
}


?>