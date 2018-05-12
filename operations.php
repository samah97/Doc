<?php
include_once("functions.php");
session_start(); 


	

if(isset($_REQUEST['action'])){
switch($_REQUEST['action']){
	case 'logout':
				session_start();
				session_unset();
				session_destroy();

				header("location:../Doc");
				break;


	case 'verify': $r=exec_query("uni","update accounts set Active=1 where id=".$_REQUEST['id']);
				   header("location:main.php");
	case 'view-patient':$_SESSION['patient_id']=$_REQUEST['p_id'];
						header("location:patient_info.php");
						
	case 'changeLang':print_r($_REQUEST);
				//header("location:".$_REQUEST['from']);
				break;
				
	

}
}
else {
    header("location:home.php");
}
?>