<?php
include("includes/db.php");

?>
<html>
<head>
<title>

</title>

</head>
<body>
<form method="post" action="insert.php" enctype="multipart/form-data">
<table width="700" align="center" border="1">
<tr align="center">
<td colspan="2"><h2>Insert New Product:</h2></td>
</tr>
<tr>
<td>Product Title</td>
<td><input type="text" name="product_title"/></td>
</tr>
<tr>
<td>Product Category</td>
<td>
<select name="cat_title">
<option>Select a Category</option>
<?php
$get_cat="select * from categories";
$run_cat=mysqli_query($con, $get_cat);
while($row_cats=mysqli_fetch_array($run_cat)){
	$cat_id=$row_cats['cat_id'];
	$cat_title=$row_cats['cat_title'];
	echo "<option value='$cat_id'>$cat_title</option>";
}

?>
</select>
</td>
</tr>

<tr>
<td>Product Brand</td>
<td>
<select name="brand_title">
<option>Select a Brand</option>
<?php
$get_brand="select * from brands";
$run_brand=mysqli_query($con, $get_brand);
while($row_brand=mysqli_fetch_array($run_brand)){
	$brand_id=$row_brand['brand_id'];
	$brand_title=$row_brand['brand_title'];
	echo "<option value='$brand_id'>$brand_title</option>";
	
}

?>
</select>
</td>
</tr>

<tr>
<td>Product image1</td>
<td><input type="file" name="product_img1"/></td>
</tr>

<tr>
<td>Product image2</td>
<td><input type="file" name="product_img2"/></td>
</tr>
<tr>
<td>Product image3</td>
<td><input type="file" name="product_img3"/></td>
</tr>
<tr>
<td>Product Price</td>
<td><input type="text" name="product_price"/></td>
</tr>
<tr>
<td>Product Desc</td>
<td><textarea name="product_desc" cols="35" rows="10"></textarea></td>
</tr>
<tr>
<td><b>Product Keywords</b></td>

<td><input type="text" name="product_keywords" /></td>
</tr>

<tr align="center">
<td colspan="2"><input type="submit" name="insert_product" value="Insert"/></td>
</tr>
</table>
</form>
</body>
</html>
<?php
if(isset($_POST['insert_product'])){
	// text data variable
	
	$product_title=$_POST['product_title'];
	$cat_title=$_POST['cat_title'];
	$brand_title=$_POST['brand_title'];
	$product_price=$_POST['product_price'];
	$product_desc=$_POST['product_desc'];
	$status='on';


	
	//image name
$product_img1 = $_FILES['product_img1']['name'];
$product_img2 = $_FILES['product_img2']['name'];
$product_img3 = $_FILES['product_img3']['name'] ;

//image temp names
$temp_name1 = $_FILES['product_img1']['tmp_name'];
$temp_name2 = $_FILES['product_img2']['tmp_name'];
$temp_name3 = $_FILES['product_img3']['tmp_name'];
	
	

	//uploading image
    move_uploaded_file($temp_name1,"product_images/$product_img1");
	move_uploaded_file($temp_name2,"product_images/$product_img2");
	move_uploaded_file($temp_name3,"product_images/$product_img3");
	$insert_product = "insert into products (cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_desc,status) values ('$cat_title','$brand_title',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc',
	'$status')";
$run_product=mysqli_query($con, $insert_product);
if($run_product){
	echo "<script>alert('Product Insert SuccessfullY')</script>";

}
	
	
}
?>