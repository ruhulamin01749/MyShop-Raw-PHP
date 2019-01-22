<html>
<head>
<title></title>
</head>
<body>
<?php

@session_start();
include("includes/db.php");

?>
<div>
<h2>Login Or Register</h2>
<form action="checkout.php" method="post">
<b>Your Email:<input type="text" name="c_email"><br>
<b>Your Password:<input type="password" name="c_pass"><br>
<tr align="center"><td colspan="4"><a href="forgot_pass.php">Forgot Password</a></td></tr>
<input type="submit" name="c_login" value="Login">

</form>
<h2 style="float:right; padding:10px;"><a href="customer_register.php">New Register</a></h2>


</div>
<?php 
if(isset($_POST['c_login'])){
	$customer_email=$_POST['c_email'];
	$customer_pass=$_POST['c_pass'];
	
	$sel_customer="select * from customer where customer_email='$customer_email' AND customer_pass='$customer_pass'";
	$run_customer=mysqli_query($con, $sel_customer);
	if(mysqli_num_rows($run_customer)>0){
		$_SESSION['customer_email']=$customer_email;
		echo "<script>window.open('index.php','_self')</script>";
	}
	else{
		echo "<script>alert('Email or Password is Wrong try again')</script>";
	}
}
?>
</body>

</html>
