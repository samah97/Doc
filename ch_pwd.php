<?php
include "functions.php";
include "header.php";


if(isset($_REQUEST['update']))
{
	$get_cpwd=exec_query("select password from users where Userid=".$_SESSION['user']);
	$res=mysqli_fetch_array($get_cpwd);

	if(password_verify($_REQUEST['cpwd'],$res['password']))
	{
		if(!strcmp($_REQUEST['npwd'],$_REQUEST['confpwd']))
		{
			if(strcmp($_REQUEST['cpwd'],$_REQUEST['npwd'])!=0)
			{
				
				$update=exec_query("update users set password='".password_hash($_REQUEST['npwd'],PASSWORD_DEFAULT)."'  where userid=".$_SESSION['user']);
				echo "<script>alert('Updated!');</script>";
				
			}
			else
			echo "<script>alert('Old and new are the same!');</script>";
	
		}
		else{
			echo "<script>alert('Passwords don't match!');</script>";
		}
		
	}
	else{
		echo "<script>alert('Incorrect Password!');</script>";;
	}
}

?>


<div class="container main">
<div class="col-sm-6 col-md-6">
<form method="post">
<div class="form-group">
<div id="errors"></div>

<table class="table">
	<tr>
		<td><label for="cpwd">Current Password:</label>
		<td><input type="password" class="form-control input-sm" name="cpwd" required>
	<tr>
		<td><label for="cpwd">New Password:</label>
		<td><input type="password" class="form-control input-sm" name="npwd" required>
	<tr>
		<td><label for="cpwd">Confirm Password:</label>
		<td><input type="password" class="form-control input-sm" name="confpwd" required>
	<tr>
		<td colspan=2><button type="submit" class="btn" name="update"  style="float:right;">Update</button>
</table>
</div>
</form>
</div>
</div>
