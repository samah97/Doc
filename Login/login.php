<div CLASS="container">
	<div class="col-sm-4 col-md-4 col-lg-4 main">
				<div id="errors">
				<p>Authentication Error: <span class="tip">Username or Password is incorrect!</span></p> 
				</div>
					<form method="post">
				<div class="form-group">
					<label for="usr">Username:</label>
					<input type="text" class="form-control" placeholder="Enter Username"  name="usr">
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" name="pwd" placeholder="Enter Password" id="pwd">

				</div>
				<div class="form-group">
					<label>Role:
					<select name="role" class="select">
						<option value="1" selected>Admin</option>
						<option value="2">Teacher</option>
						<option value="3">Student</option>
					</select>
				</div>
				<div class="checkbox">
					<label id="rmmbr"><input type="checkbox"> Remember me</label>
				</div>
				<div class="btns">
					<button type="submit"  class="btn btn-default" id="login" name="login" >Login</button>
					<button type="submit" class="btn btn-primary" name="reg" id="reg" >Register</button>
				</div>
				
				</form>
	</div>