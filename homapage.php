<?php
    session_start();
	require_once('dbconfig/config.php');
?>

<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#DAE0E2">

<div id="main-wrapper">
<center>
<h2>Home Page</h2>
<h3>Welcome <?php echo $_SESSION['username']; ?></h3>
<img src="images/woman-icon-digital-purple-vector-26625677.jpg" class="avatar"/>
</center>
 
 <form class="myform" action="homapage.php" method="post">
<a href="index.php"><input name="logout" type="submit" id="logout_btn" value="Log Out"/><br></a>

</form>
<?php
if(isset($_POST['logout']))
{
session_destroy();
header('location:http://localhost/Sampleloginpage');
}
?>


</div>

</body>
</html>
