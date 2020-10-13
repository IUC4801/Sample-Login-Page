<?php

  require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#DAE0E2">

<div id="main-wrapper">
<center><h2>Registration Form</h2>
<img src="images/woman-icon-digital-purple-vector-26625677.jpg" class="avatar"/>
</center>
 
<form class="myform" action="register.php" method="post">
<label><b>Username:</label><br>
<input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>
<label><b>Password:</label><br>
<input name="password" type="password" class="inputvalues" placeholder="Your password" required/><br>
<label><b>Confirm Password:</label><br>
<input name="cpassword" type="password" class="inputvalues" placeholder="Confirm password" required/><br>
<input name="submit_btn" type="submit" id="signup_btn" value="Sign up"/><br>
<a href="index.php"><input type="button" id="back_btn" value="Go to Login"/></a>
</form>

<?php
 if(isset($_POST['submit_btn'])) 
 {
	 //echo '<script type="text/javascript"> alert("Sign Up button clicked")</script>';
     $username=$_POST['username'];
	 $password=$_POST['password'];
	 $cpassword=$_POST['cpassword'];
	 
	 if($password==$cpassword)
	 {
		 $query="select * from userinfo WHERE  username='$username'";
		 $query_run=mysqli_query($con,$query);
		 
		 if($query_run)
		 {
			 
		     if(mysqli_num_rows($query_run)>0)
		 {
			 //there is already a user with same user name
			echo '<script type="text/javascript"> alert("User name already exists.")</script>';  
		 }
		 else 
		 {
			 $query="insert into userinfo values('$username','$password')";
			 $query_run=mysqli_query($con,$query);
			 
			 if($query_run)
			 {
				 echo '<script type="text/javascript"> alert("User Registered.Go to Login Page for login.")</script>'; 
			 }	
			 else
			 {
				 echo '<script type="text/javascript"> alert("Error.")</script>';
			 }
		 }
		 
		 }
	 }
	 else{
			 echo '<script type="text/javascript"> alert("Password and confirm password do not match!")</script>';
		 }
	 

 } 
?>


</div>

</body>
</html>