<?php
define("AUTHORIZE_SERVER_KEY", "AAAAb2-m3OY:APA91bFm3pGOAb3NPBpIHtH26HpDRQXl3o_FP9lF1X7ETOHa4_Xgxj-VhNdz4jbIXocaRwsMvVMrd72vj1D--P7O3ECn-3OsySJukaYMhsRul7s7o7bCTNIPoPHJ3WNnUbHEuiQKv2bB"); //project setting -> cloud messaging tab

function send_notification($tokens,$title,$summary,$pic,$desc) {
    $fcm_url = 'https://fcm.googleapis.com/fcm/send';
	$url="https://localhost/projects/Doc/getnotifications.php";


	
 $fields = array(
		'registration_ids' => $tokens,
		'from'=>"Doctor",
        'notification' => array(
        'title'=>$title,
		'body'=>$summary,
		'icon'=>$pic,
		"click_action"=>"MY_INTENT",
        'vibrate' => 1,
        'sound' => 0),
		'data'=>array('text'=>$desc)
		);
	
    $headers = array(
        'Authorization:key=' . AUTHORIZE_SERVER_KEY,
        'Content-Type: application/json'
		);
			
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $fcm_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
if($result==FALSE){
	die("Curl failed:".curl_errno($ch));
}
    curl_close($ch);
 return $result;
}
if(isset($_POST['btnnotification'])){	
if (isset($_FILES['notify-image'])) {
     $repnot="NOTIFICATIONS";
     if (is_dir($repnot)==FALSE) {
         if (mkdir($repnot)==false) {
           echo "<br>Problem when creating directory " . $repnot;
           exit; }
          }
     if (chdir($repnot)) {
       $rep = str_replace(" ","_",$_POST['notify-title']);
       if (is_dir($rep)==FALSE) {  // repertoire n'existe pas alors creation
         if (mkdir($rep)==false) {
           echo "<br>Problem when creating directory " . $rep;
           exit; }
          }
        if (chdir($rep)) {
            if (strlen($_FILES["notify-image"]["name"])>0) {
              $d2=explode(".",$_FILES["notify-image"]["name"]); 
              echo "<br>Copie du fichier : " .   $_FILES["notify-image"]["name"] . "  bien effectuee";
              copy($_FILES["notify-image"]["tmp_name"], $_FILES["notify-image"]["name"]);
            }
       }
	 }
	 //$filename="https://mubsbaccontacts.000webhostapp.com/fcm/".$repnot."/".$rep."/".$_FILES["picture"]["name"];
	 $filename="https://localhost/projects/Doc/fcm/".$repnot."/".$rep."/".$_FILES["notify-image"]["name"];
}
$con=mysqli_connect("localhost","root","","doctor");
$sql="Select token from users_token";



$result=mysqli_query($con,$sql);
echo 'test';

if(!$result){
    die("Error: ".mysqli_error($con));
}

$tokens=array();
if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_assoc($result)){
		$tokens[]=$row["token"];
	}
}

$title=$_POST['notify-title'];
$summary=$_POST['notify-summary'];
$picture=$filename;
$description=$_POST['notify-description'];
$query="INSERT INTO Notifications (title,summary,picture,description) VALUES ('$title','$summary','$picture','$description');";
//$query="INSERT INTO Notifications (title,summary,description) VALUES ('$title','$summary','$description');";
$insert=mysqli_query($con,$query);
print_r($insert);
mysqli_close($con);

$message_status=send_notification($tokens,$title,$summary,$picture,$description);

echo $message_status;
}

?>
<!--  
<html>
<body>
<form action="" method="post" enctype="multipart/form-data">
<table>
<tr><td>Title</td><td><input type="text" name="title"/></td></tr>
<tr><td>Summary</td><td><input type="text" name="summary"/></td></tr>
<tr><td>Picture</td><td><input type="file" name="picture"/></td></tr>
<tr><td>description</td><td><textarea type="text" name="description"></textarea></td></tr>
<tr><td><input type="submit" name="btnnotification" value="send notification"/></td></tr>
</table>
</form>
</body>
</html>
-->