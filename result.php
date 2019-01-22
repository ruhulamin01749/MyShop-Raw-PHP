<?php
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
<div id="headlin">
<div id="headlin_content">
<b>welcome Guest!</b>
<b style="color:yellow;">Shopping cart:</b>
<span>- Items:- Price</span>
</div>

</div>
<div id="product_box">

<?php 
if(isset($_GET['search'])){
	$user_keyword=$_GET['user_query'];
$get_products="select * from products where product_keywords like '%$user_keyword%'";
$run_products=mysqli_query($con, $get_products);
while($row_product=mysqli_fetch_array($run_products)){
	$product_id=$row_product['product_id'];
	$product_title=$row_product['product_title'];
	$cat_title=$row_product['cat_id'];	
	$brand_title=$row_product['brand_id'];
	$product_desc=$row_product['product_desc'];
	$product_price=$row_product['product_price'];
	$product_img1=$row_product['product_img1'];
	echo"
	<div id='single_product'>
	<h3>$product_title</h3>
	<img src='admin_area/product_images/$product_img1' width='180' height='180'/><br>
	<p><b>Price-$product_price</b></p>
	<a href='details.php?product_id=$product_id' style='float:left;'>details</a>
	<a href='index.php?add_cart=$product_id'><button style='float:left;'>add to cart</button></a>
	
	</div>
	";
}
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