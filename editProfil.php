<?php include ('server.php');
$db = mysqli_connect('localhost', 'root', 'decembrie', 'registration');
$username=$_SESSION['username'];
$sql="SELECT * FROM users WHERE '$username'=username";
$records=mysqli_query($db, $sql);
$users=mysqli_fetch_assoc($records);



?>

<!DOCTYPE html>
<html>
<head>
<title>  </title>
<link rel="stylesheet" type ="text/css" href="style.css">

</head>
<body>
<div class="header">
<h2>Edit Profil</h2>
</div>




 <form method="post" action="editProfil.php">

  	<?php include('errors.php'); 
	
	
	?>
  	<div class="input-group">
  	  <label> Username</label>
	  <input id="username" name="username" value="<?php echo $_SESSION['username'];?>" readonly="readonly">
  	  
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="text" name="email" value="<?php echo $users['email'];?>" >
  	</div>
  
  	<div class="input-group">
  	  <label>Address</label>
  	  <input type="text" name="adresa" value="<?php echo $users['adresa'];?>">
  	</div>
	
		<div class="input-group">
  	  <label>Phone</label>
  	  <input type="text" name="telefon" value="<?php echo $users['telefon'];?>">
  	</div>
	
	
     <div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
	
  	<div class="input-group">
	
  	  <button type="submit" class="btn" name="edit_button_profil" >Edit</button>
  	</div>
  	
  </form>
  

</body>
</html>
