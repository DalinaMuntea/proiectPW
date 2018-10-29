<?php include ('server.php');
$db = mysqli_connect('localhost', 'root', 'decembrie', 'product_details');
$id=$_GET['id'];
$sql="SELECT * FROM product WHERE '$id'=id";
$records=mysqli_query($db, $sql);
$product=mysqli_fetch_assoc($records);



?>
<!DOCTYPE html>
<html>
<head>
<title> Edit product </title>
<link rel="stylesheet" type ="text/css" href="style.css">

</head>
<body>
<div class="header">
<h2>Edit product</h2>
</div>

<?php  $id=$_GET['id'];
	
	
	echo "<script>console.log( 'Debug Objects: " . $id . "' );</script>"; ?>
 <form method="post" action="edit.php">

  	<?php include('errors.php'); 
	
	?>
  	<div class="input-group">
  	  <label> ID</label>
	  <input id="id" name="id" value="<?php echo $_GET['id'];?>" readonly="readonly">
  	  
  	</div>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="pname" value="<?php echo $product['pname'];?>" >
  	</div>
  	<div class="input-group">
  	  <label>Image</label>
  	  <input type="file" name="image"  value="<?php echo $product['image'];?>">
  	</div>
  	<div class="input-group">
  	  <label>Price</label>
  	  <input type="number" name="price" value="<?php echo $product['price'];?>">
  	</div>
	
		<div class="input-group">
  	  <label>Type</label>
  	  <input type="text" name="tip" value="<?php echo $product['tip'];?>">
  	</div>
	<div class="input-group">
	
	 <label>Description</label>
  	  <input type="text" name="descriere" value="<?php echo $product['descriere'];?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="edit_button" >Edit</button>
  	</div>
  	
  </form>
</body>
</html>
