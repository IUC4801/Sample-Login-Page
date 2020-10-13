<?php
session_start();
require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#DAE0E2"> 

<div id="main-wrapper">
<center><h2>Login Form</h2>
<img src="images/woman-icon-digital-purple-vector-26625677.jpg" class="avatar"/>
</center>
 
<form class="myform" action="index.php" method="post">
<label><b>Username:</label><br>
<input name="username" type="text" class="inputvalues" placeholder="Type your username"required/><br>
<label><b>Password:</label><br>
<input name="password" type="password" class="inputvalues" placeholder="Type your password"required/><br>
 <input name=" login" type="submit" id="login_btn" value="Login"/><br>
<a href="register.php"><input type="button" id="register_btn" value="Register New User Here"/></a>
</form>
<?php
if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$query="select * from userinfo WHERE username='$username' AND password='$password'";
	
	$query_run=mysqli_query($con,$query);
	if(mysqli_num_rows($query_run)>0)
	{
		
		//valid
		$_SESSION['username']=$username;
		echo $_SESSION['username'];
		header('location:http://localhost/Sampleloginpage/homapage.php');
		
	}
	else
	{
		//valid
		 echo '<script type="text/javascript"> alert("Invalid credentials!")</script>';
	}
}	
?>


<?php

// The version number (9_5_0) should match version of the Chilkat extension used, omitting the micro-version number.
// For example, if using Chilkat v9.5.0.48, then include as shown here:
include("chilkat_9_5_0.php");

//  This example requires the Chilkat API to have been previously unlocked.
//  See Global Unlock Sample for sample code.

//  This example includes both client-side and server-side code.
//  Each code segment is marked as client-side or server-side.
//  Imagine these segments are running on separate computers...

//  -----------------------------------------------------------------
//  (Client-Side) Generate an ECC key, save the public part to a file.
//  -----------------------------------------------------------------
$prngClient = new CkPrng();
$eccClient = new CkEcc();
// privKeyClient is a CkPrivateKey
$privKeyClient = $eccClient->GenEccKey('secp256r1',$prngClient);
if ($eccClient->get_LastMethodSuccess() != true) {
    print $eccClient->lastErrorText() . "\n";
    exit;
}

// pubKeyClient is a CkPublicKey
$pubKeyClient = $privKeyClient->GetPublicKey();
$pubKeyClient->SavePemFile(false,'qa_output/eccClientPub.pem');

//  -----------------------------------------------------------------
//  (Server-Side) Generate an ECC key, save the public part to a file.
//  -----------------------------------------------------------------
$prngServer = new CkPrng();
$eccServer = new CkEcc();
// privKeyServer is a CkPrivateKey
$privKeyServer = $eccServer->GenEccKey('secp256r1',$prngServer);
if ($eccServer->get_LastMethodSuccess() != true) {
    print $eccServer->lastErrorText() . "\n";
    exit;
}

// pubKeyServer is a CkPublicKey
$pubKeyServer = $privKeyServer->GetPublicKey();
$pubKeyServer->SavePemFile(false,'qa_output/eccServerPub.pem');

//  -----------------------------------------------------------------
//  (Client-Side) Generate the shared secret using our private key, and the other's public key.
//  -----------------------------------------------------------------

//  Imagine that the server sent the public key PEM to the client.
//  (This is simulated by loading the server's public key from the file.
$pubKeyFromServer = new CkPublicKey();
$pubKeyFromServer->LoadFromFile('qa_output/eccServerPub.pem');
$sharedSecret1 = $eccClient->sharedSecretENC($privKeyClient,$pubKeyFromServer,'base64');

//  -----------------------------------------------------------------
//  (Server-Side) Generate the shared secret using our private key, and the other's public key.
//  -----------------------------------------------------------------

//  Imagine that the client sent the public key PEM to the server.
//  (This is simulated by loading the client's public key from the file.
$pubKeyFromClient = new CkPublicKey();
$pubKeyFromClient->LoadFromFile('qa_output/eccClientPub.pem');
$sharedSecret2 = $eccServer->sharedSecretENC($privKeyServer,$pubKeyFromClient,'base64');

//  ---------------------------------------------------------
//  Examine the shared secrets.  They should be the same.
//  Both sides now have a secret that only they know.
//  ---------------------------------------------------------
print $sharedSecret1 . "\n";
print $sharedSecret2 . "\n";

?>





</div>

</body>
</html>

