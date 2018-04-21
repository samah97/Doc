<?php include_once("../functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	
	<body background="bg.jpg">
	<style>
	
.select{
	font-size:15px;
	
}
	
	.body{
		background-repeat:no-repeat;
	}
	label{
		font-family:Times New Roman;
		font-size:20px;
		color:black;
	}
	#rmmbr{
		font-size:15px;
		color:#102BC1;
		font-family:sans-serif;
		font-weight:bold;
	}
	
	.main{
		background:grey;
		padding:10px;
		border-radius:10px;
		}
		
	@media(max-width:767px){
		.main{
			margin-top:8%;
			margin-left:3%;
			margin-right:10%;
			width:95%;
			font-size:20px;
		}
		.select{
			font-size:13px;
			width:200px;
			align:center;
		}
		#login{
		margin-left:-35px;	
		margin-right:30px;
}
	}
@media(min-width:992px){
		.main{
		margin-top:7%;
		margin-left:25%;
		}
	#login{
margin-left:5%;
margin-right:;
}
}
@media(min-width:1200px){

}
.err{
	color:#D62614;
	margin:10px;
	font-size:15px;	
	display:none;
}
.btn{
	font-weight:bold;
	}


	</style>
  </head>
  <body background="bg.jpg">
  <div CLASS="container">
	<div class="col-sm-6 col-md-6 col-lg-6 main">
					<form method="post">
				<div class="form-group">
					<label for="usr">Username:</label>
					<input type="text" class="form-control" placeholder="Enter Username"  name="usr" value="<?php if(isset($_REQUEST['usr'])) echo $_REQUEST['usr']; ?>" required>
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" name="pwd" placeholder="Enter Password" id="pwd" required>
					<span class="err">Incorrect Password!</span>
				</div>
				<div class="form-group">
					<label for="confpwd">Confirm Password:</label>
					<input type="password" class="form-control" name="confpwd" placeholder="Enter Password again" id="confpwd" required >
					
				</div>
				<div class="form-group">
					<label for="fname">First Name:</label>
					<input type="text" class="form-control" name="fname" placeholder="Enter First Name" id="fname" required value="<?php if(isset($_REQUEST['fname'])) echo $_REQUEST['fname']; ?>">
					
				</div>
				<div class="form-group">
					<label for="lname">Last Name:</label>
					<input type="text" class="form-control" name="lname" placeholder="Enter Last Name" id="lname" required value="<?php if(isset($_REQUEST['lname'])) echo $_REQUEST['lname']; ?>">
					
				</div>
				<div class="form-group">
					<label for="mail">E-mail:</label>
					<input type="email" class="form-control" name="mail" placeholder="Enter E-mail" id="mail" required value="<?php if(isset($_REQUEST['mail'])) echo $_REQUEST['mail']; ?>">
					
				</div>
				
				<div class="form-group">
					<label>Role:
					<select name="role" class="form-control" id="sel1">
						<option value="2" <?php if(isset($_REQUEST['role']) and $_REQUEST['role']==2 ) echo "selected"; ?>>Teacher</option>
						<option value="3" <?php if(isset($_REQUEST['role']) and $_REQUEST['role']==3 ) echo "selected"; ?>>Student</option>
					</select>
				</div>
				<div class="form-group">
					<label>Course:
					<select name="course" class="form-control" id="sel1">
						<?php
						$r=exec_query("uni","select * from course");
						$row=mysqli_fetch_array($r);
						while($row=mysqli_fetch_array($r))
							echo "<option value=".$row[0]." ".(isset($_REQUEST['course']) && $_REQUEST['course']==$row[0]? "selected":"").">".$row[1]."</option>";
						
						?>
					</select>
				</div>


					<button type="submit" style="position:relative;left:35%;" class="btn btn-primary" name="reg" id="reg" >Register</button>
				</form>
	</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location='127.0.0.1/Projects/Login'">&times;</button>
        <h4 class="modal-title">Registration Successful</h4>
      </div>
      <div class="modal-body">
        <p>Thank you <span style="color:red"><?php echo $_REQUEST['fname']; ?></span> for submitting the required info for registration.You can login when your account is verified by an admin.<br> <sub><u>Note:</u> In case of any errors, you will be mailed to: <span style="color:red"><?php echo $_REQUEST['mail']; ?></span> :)</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="javascript:window.location='../Projects/Login'" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
$('#pass').bind("cut copy paste",function(e) {
     e.preventDefault();
 });
</script>
<?php
if(isset($_REQUEST['reg']))
{
$check=exec_query("uni","select * from accounts where username='".$_REQUEST['usr']."' or Email='".$_REQUEST['mail']."'");
if(mysqli_num_rows($check)>0)
	die("<script>alert('username or email already exists');</script>");
if($_REQUEST['pwd']!=$_REQUEST['confpwd'])
	die("<script>alert('Passwords do not match!');</script>");	

$query=exec_query("uni","INSERT INTO accounts(username, password, Role, Fname, Lname, Email, Active) VALUES ('".$_REQUEST['usr']."','".md5($_REQUEST['pwd'])."',".$_REQUEST['role'].",'".$_REQUEST['fname']."','".$_REQUEST['lname']."','".$_REQUEST['mail']."',0)");
if($query){
	echo "<script>$('#myModal').modal('show');</script>";
	}
}

?>
	