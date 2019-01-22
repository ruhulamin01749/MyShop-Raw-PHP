<?php
$db=mysqli_connect("localhost","root","","myshop");
//function for getting the ip address
function getRealIpAddr(){
if(!empty($_SERVER['HTTP_CLIENT_IP']))
	//Check ip from share internet
	{
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		//to check ip is pass from proxxxy
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
	
	
	}
	//creatin the script for cart
	function cart(){
		if(isset($_GET['add_cart'])){
			$ip_add=getRealIpAddr();
			global $db;
			
			$p_id=$_GET['add_cart'];
			$ip_add=getRealIpAddr();
			$check_pro="select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
			$run_check=mysqli_query($db,$check_pro);
			if(mysqli_num_rows($run_check)>0){
				echo "<script>window.open('index.php','_self')</script>";
			}else{
				$q="insert into cart (p_id,ip_add) values ('$p_id','$ip_add')";
				$run_q=mysqli_query($db,$q);
			}
		}
	}
// getting the number of items from the cart
function items(){
	if(isset($_GET['add_cart'])){
	
	global $db;
	$ip_add=getRealIpAddr();
	
	
	$get_items="select * from cart where ip_add='$ip_add'";
	$run_items=mysqli_query($db,$get_items);
	$count_items=mysqli_num_rows($run_items);
}else{
	$ip_add=getRealIpAddr();
	global $db;
	$get_items="select * from cart where ip_add='$ip_add'";
	$run_items=mysqli_query($db,$get_items);
	$count_items=mysqli_num_rows($run_items);
}
echo $count_items;
}

//getting the price
function total_price(){
	$ip_add=getRealIpAddr();
	global $db;
	$total=0;
	$sel_price="select * from cart where ip_add='$ip_add'";
	$run_prcie=mysqli_query($db, $sel_price);
	while($record=mysqli_fetch_array($run_prcie)){
		$pro_id=$record['p_id'];
		$pro_price="select * from products where product_id=$pro_id";
		$run_pro_price=mysqli_query($db,$pro_price);
		while($p_price=mysqli_fetch_array($run_pro_price)){
			$product_price=array($p_price['product_price']);
			$values=array_sum($product_price);
			$total+=$values;
		}
		
	}
	echo $total;
	
}

function getPro(){
global $db;
if(!isset($_GET['cat'])){
	if(!isset($_GET['brand'])){
$get_products="select * from products order by rand() LIMIT 0,6";
$run_products=mysqli_query($db, $get_products);
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
}
}
function getCatPro(){
global $db;
if(isset($_GET['cat'])){
	$cat_id=$_GET['cat'];
	
$get_cat_pro="select * from products where cat_id='$cat_id'";
$run_cat_pro=mysqli_query($db, $get_cat_pro);
$count=mysqli_num_rows($run_cat_pro);
if($count==0){
	echo "<h2>No Product found in this Categories</h2>";
}
while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
	$product_id=$row_cat_pro['product_id'];
	$product_title=$row_cat_pro['product_title'];
	$cat_title=$row_cat_pro['cat_id'];
	$brand_title=$row_cat_pro['brand_id'];
	$product_desc=$row_cat_pro['product_desc'];
	$product_price=$row_cat_pro['product_price'];
	$product_img1=$row_cat_pro['product_img1'];
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

}
function getBrandPro(){
global $db;
if(isset($_GET['brand'])){
	$brand_id=$_GET['brand'];
	
$get_brand_pro="select * from products where brand_id='$brand_id'";
$run_brand_pro=mysqli_query($db, $get_brand_pro);
$count=mysqli_num_rows($run_brand_pro);
if($count==0){
	echo "<h2>No Product found in this Brand</h2>";
}
while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
	$product_id=$row_brand_pro['product_id'];
	$product_title=$row_brand_pro['product_title'];
	$cat_title=$row_brand_pro['cat_id'];
	$brand_title=$row_brand_pro['brand_id'];
	$product_desc=$row_brand_pro['product_desc'];
	$product_price=$row_brand_pro['product_price'];
	$product_img1=$row_brand_pro['product_img1'];
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

}

function getCat(){
	global $db;
$get_cat="select * from categories";
$run_cat=mysqli_query($db, $get_cat);
while($row_cats=mysqli_fetch_array($run_cat)){
	$cat_id=$row_cats['cat_id'];
	$cat_title=$row_cats['cat_title'];
	echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	
}


}
function getBrand(){
	global $db;
$get_brand="select * from brands";
$run_brand=mysqli_query($db, $get_brand);
while($row_brand=mysqli_fetch_array($run_brand)){
	$brand_id=$row_brand['brand_id'];
	$brand_title=$row_brand['brand_title'];
	echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	
}

}
?>