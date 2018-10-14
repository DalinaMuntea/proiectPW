<?php include ('server.php');?>

<!DOCTYPE html>
<html>
<head>
<title> User registration system  </title>
<link rel="stylesheet" type ="text/css" href="style.css">

</head>
<body>
<div class="header">
<h2>Log in</h2>
</div>
<form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	
  	<div class="input-group">
  	  <button type="submit" class="btn" name="login">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>