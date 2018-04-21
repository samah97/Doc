<?php include_once("functions.php");
session_start();
if(isset($_SESSION['user']))
	header("location:home.php");	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Doctor System</title>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="js/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/index.css">
  </head>
  <body class="bg">
  <div class="container-fluid">
  <div class="row">
	<div class="lang-select">
	</div>
  </div>
  <div CLASS="container">
	
	<div class="col-sm-4 col-md-4 col-lg-4 main">
				<div id="errors">
				<p>Authentication Error: <span class="tip">Username or Password is incorrect!</span></p> 
				</div>
				<form method="POST">
				<div class="form-group">
					<label for="usr">Username:</label>
					<input type="text" class="form-control" placeholder="Enter Username"  name="user" value='<?php if(isset($_COOKIE['user'])) echo $_COOKIE['user'];?>'>
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" name="password" placeholder="Enter Password" id="password" autocomplete=false value='<?php if(isset($_COOKIE['pwd'])) echo $_COOKIE['pwd'];?>'>

				</div>

				<div class="checkbox">
					<label id="rmmbr"><input type="checkbox" name='remember' checked> Remember me</label>
				</div>
				<div class="btns">
					<button type="submit"  class="btn btn-primary" id="login" name="login" style="width:100%;">Login</button>
				</div>
				
				</form>
	</div>
	</div>
	
	
<!-- Prevent User From pasting a password -->
<script>
$('#pwd').bind("paste",function(e) {
     e.preventDefault();
 });
</script>
<!-- End -->


<?php
if(isset($_POST['login'])){

	$login_query=exec_query("select * from users where username='".$_POST['user']."'" );

	
	$login_result=mysqli_fetch_array($login_query);

	if(mysqli_num_rows($login_query)>0 && password_verify($_POST['password'],$login_result['password'])){
	    
		if(isset($_POST['remember'])){
			setcookie('user',$_POST['user'],time()+ (10 * 365 * 24 * 60 * 60));
			setcookie('password',password_hash($_POST['password'],PASSWORD_DEFAULT),time()+ (10 * 365 * 24 * 60 * 60));
		}
		
		else{
					setcookie('user',$_POST['user'],time()-12600);
					setcookie('password',password_hash($_POST['password'],PASSWORD_DEFAULT),time()-12600);
		}
	
	$_SESSION['user']=$login_result['user_id'];
	$_SESSION['role']=$login_result['role'];

	$_SESSION['lang']="en"; //set language

	header("location:home.php");
		
	}
	else
	{		
		echo "<script>$('#errors').css('display', 'block');</script>";
	}
	}

?>
	</div>
  </body>
  
</html>