<?php
$host='localhost';
$user='root';
$pass='';
$database='doctor';

$con=mysqli_connect($host,$user,$pass,$database);
if(!$con)
	die('Could not connect: ' . mysql_error());
else
{
	$response=array();
	$sql="SELECT * FROM Notifications";
	$result=mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_array($result))
		{
			array_push($response,array("NotifID"=>$row[0],"Title"=>$row[1],"Summary"=>$row[2],"Picture"=>$row[3],"Description"=>$row[4]));
		}
		echo json_encode(array("server_response"=>$response));
	}
	else
	{
		echo json_encode(array("server_response"=>"empty"));
	}
	mysqli_close($con);
}
?>