<?php
if(isset($_POST["Token"])){
	$token=$_POST["Token"];
	echo $token;
	$con=mysqli_connect("localhost","root","","doctor");
	$query="INSERT INTO userstest(token) VALUES ('aaaaaaaaaaaaaaa') ON DUPLICATE KEY UPDATE token='aaaaaaaaaaaa';";
	mysqli_query($con,$query);
	mysqli_close($con);
}
if($_GET['Token']){
    echo $_GET['Token'];
}


?>