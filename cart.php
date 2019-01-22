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
<?php cart();

?>
<div id="headlin">
<div id="headlin_content">
<b>welcome Guest!</b>
<b style="color:yellow;">Shopping cart:</b>
<span>- Items: <?php items();?>- Price-<?php total_price();?>-<a href="cart.php" style="color:#ff0"> Go to Cart</a></span>
</div>

</div>

<div id="product_box">
<form action="cart.php" method="post" enctype="multipart/form-data">
<table width="740" align="center" bgcolor="#0099cc">
<tr align="center">
<td>Remove<b><td>
<td>Product(S)<b><td>
<td>Quantity<b><td>
<td>Total Price<b><td>
</tr>
<?php
$ip_add=getRealIpAddr();
	
	$total=0;
	$sel_price="select * from cart where ip_add='$ip_add'";
	$run_prcie=mysqli_query($db, $sel_price);
	while($record=mysqli_fetch_array($run_prcie)){
		$pro_id=$record['p_id'];
		$pro_price="select * from products where product_id=$pro_id";
		$run_pro_price=mysqli_query($con,$pro_price);
		while($p_price=mysqli_fetch_array($run_pro_price)){
			$product_price=array($p_price['product_price']);
			$product_title=$p_price['product_title'];
			$product_image=$p_price['product_img1'];
			$only_price=$p_price['product_price'];
			
			$values=array_sum($product_price);
			$total+=$values;
	
	

?>
<tr>
<td align="center"><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"></td>
<td align="center"><?php echo $product_title;?><br><img src="admin_area/product_images/<?php echo $product_image;?>" height="80" width="80"></td>
<td align="center"><input type="text" name="qty" value=""></td>

<?php
		
if(isset($_POST['update'])){
	$qty=$_POST['qty'];
	$insert_qty="update cart set qty='$qty' where ip_add='ip_add'";
	$run_qty=mysqli_query($con,$insert_qty);
	$total=$total*$qty;
}
		
?>

<td align="center"><?php echo $only_price;?></td>
</tr>
	<?php }}?>
	<tr align="right">
	<td colspan="4" align="right"><b>Sub total</b></td>
	<td><b><?php echo $total;?></b></td>
	</tr>
	<tr>
	<td colspan="2"><input type="submit" name="update" value="Update cart"></td>
	<td><input type="submit" name="continue" value="Continue cart"></td>
	<td><a href="checkout.php">Checkout</a></td>
	</tr>
</table>
</form>
<?php
function updatecart(){
	global $con;
if(isset($_POST['update'])){
	foreach($_POST['remove'] as $remove_id){
		$delete_product="delete from cart where p_id='$remove_id'";
		$run_delete=mysqli_query($con,$delete_product);
		if($run_delete){
			echo "<script>window.open('cart.php','_self')</script>";
		}
	}
	
}

if(isset($_POST['continue'])){
		echo "<script>window.open('index.php','_self')</script>";
	}
}
echo @$up_cart= updatecart();
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