<?php include ('server.php');?>

<!DOCTYPE html>
<html>
<head>
<title> Add new product  </title>
<link rel="stylesheet" type ="text/css" href="style.css">

</head>
<body>
<div class="header">
<h2>Add new product</h2>
</div>
 <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Id</label>
  	  <input type="number" name="id">
  	</div>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="pname" >
  	</div>
  	<div class="input-group">
  	  <label>Image</label>
  	  <input type="file" name="image">
  	</div>
  	<div class="input-group">
  	  <label>price</label>
  	  <input type="number" name="price">
  	</div>
	
		<div class="input-group">
  	  <label>Type</label>
  	  <input type="text" name="tip">
  	</div>
		<div class="input-group">
  	  <label>Description</label>
  	  <input type="text" name="descriere">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="add_button">Add</button>
  	</div>
  	
  </form>
</body>
</html>
