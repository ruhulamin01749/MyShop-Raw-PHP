<?php
session_start();
include("includes/db.php");
include("function/function.php");
?>

<html>
<head>
<title>
My Fist Ecommarce
</title>
<link rel="stylesheet" href="styles/styles.css" media="all">
</head>
<body>
<!--Main Content Start--->

<div class="main_wrapper">
<div class="header_wrapper">
<a href="index.php"><img src="images/dd.png" style="float:left" height="100" width="250"></a>
<img src="images/s.gif" style="float:right" height="100" width="750">

</div>
<div id="navbar">
<ul id="menu">
<li><a href="#">Home</a></li>
<li><a href="all_product.php">All Product</a></li>
<li><a href="my_account.php">My Account</a></li>
<li><a href="user_register.php">Sign Up</a></li>
<li><a href="cart.php">Shopping Cart</a></li>
<li><a href="contact.php">Contact Us</a></li>
</ul>
<div id="form">
<form method="get" action="result.php" enctype="multipart/form-data">
<input type="text" name="user_query" placeholder="Search a Product"/>
<input type="submit" name="search" value="Search">
</form>
</div>


</div>
<div class="content_wraper">

<div id="left_sidebar">
<div id="sidebar_title">Categories</div>
<ul id="cats">
<?php 
getCat();


?>


</ul>
<div id="sidebar_title">Brand</div>
<ul id="cats">
<?php getBrand();?>
</ul>
</div>
<div id="right_content">
<?php cart();

?>
<div id="headlin">
<div id="headlin_content">
<b>welcome Guest!</b>
<b style="color:yellow;">Shopping cart:</b>
<span>- Items: <?php items();?>- Price-<?php total_price();?>-<a href="cart.php" style="color:#ff0"> Go to Cart</a></span>
</div>

</div>

<div>

<?php
if(!isset($_SESSION['customer_email'])){
	
	
	include("customer/customer_login.php");
}
else{
	include("payment_option.php");
}

 ?>


</div>

</div>
<div class="footer">
<h1 style="color:#000; padding-top:30px; text-align:center;">&copy; 2018 by www.myshop.com.bd</h1>
</div>


</div>


<!--Main Content end--->
</body>


</html>