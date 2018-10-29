<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'decembrie', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $address=mysqli_real_escape_string($db, $_POST['adresa']);
  $phone=mysqli_real_escape_string($db, $_POST['telefon']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

   if (empty($address)) { array_push($errors, "Address is required"); }
    if (empty($phone)) { array_push($errors, "Phone is required"); }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password,adresa,telefon) 
  			  VALUES('$username', '$email', '$password', '$address', '$phone')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	
	header('location: index.html');

  }
}


if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
	  if ($username=="admin") 
  	  header('location: index2.html');
  else header('location:index.html');
  	}else {
		
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}



 //log out 
 if (isset ($_GET['Logout'])) {
	 session_destroy();
	 unset($_SESSION['username']);
	
	  foreach ($_SESSION["cart"] as $keys => $value){
               
                    unset($_SESSION["cart"][$keys]);
                    
                
            }
	 header('location:login.php');
	 
	 
 }
 
 
 $db2 = mysqli_connect('localhost', 'root', 'decembrie', 'product_details');
 //add new peoduct 
if (isset($_POST['add_button'])) {
	
  // receive all input values from the form
  $id = mysqli_real_escape_string($db2, $_POST['id']);
  $pname = mysqli_real_escape_string($db2, $_POST['pname']);
  $image = mysqli_real_escape_string($db2, $_POST['image']);
  $price = mysqli_real_escape_string($db2, $_POST['price']);
   $type = mysqli_real_escape_string($db2, $_POST['tip']);
$descriere = mysqli_real_escape_string($db2, $_POST['descriere']);
 $query = "INSERT INTO product (id, pname, image,price,tip,descriere) 
  			  VALUES('$id', '$pname', '$image','$price','$type','$descriere')";
  	mysqli_query($db2, $query);
  	
  	header('location: home.html');
  }
  
  

 //edit product 
if (isset($_POST['edit_button'])) {

	 $id = mysqli_real_escape_string($db2, $_POST['id']);
	 $user_check_query = "SELECT * FROM product WHERE id='$id'  LIMIT 1";
  $result = mysqli_query($db2, $user_check_query);
  $id1 = mysqli_fetch_assoc($result);
  
  if ($id1) { // if user exists
    if ($id1['id'] === $id) {
    
    

	
  // receive all input values from the form
 
  $pname = mysqli_real_escape_string($db2, $_POST['pname']);
  $image = mysqli_real_escape_string($db2, $_POST['image']);
  $price = mysqli_real_escape_string($db2, $_POST['price']);
   $type = mysqli_real_escape_string($db2, $_POST['tip']);
 $descriere = mysqli_real_escape_string($db2, $_POST['descriere']);
 
 $query = "update product set pname='$pname',image='$image',price='$price',tip='$type', descriere='$descriere' where id='$id'";
  	mysqli_query($db2, $query);
  	
  	header('location: home.html');
	}
	else {
  		array_push($errors, "Id not existed");
  	}
  }
}

$db3 = mysqli_connect('localhost', 'root', 'decembrie', 'registration');
//edit_profil

if (isset($_POST['edit_button_profil'])) {
	$username = mysqli_real_escape_string($db3, $_POST['username']);
	 $user_check_query = "SELECT * FROM users WHERE username='$username' ";
  $result = mysqli_query($db3, $user_check_query);
 
  $use = mysqli_fetch_assoc($result);
   
  
    if ($use) { // if user exists
    if ($use['username'] === $username) {
    
    

	
  // receive all input values from the form
 
  $email = mysqli_real_escape_string($db3, $_POST['email']);
  $adresa = mysqli_real_escape_string($db3, $_POST['adresa']);
  $telefon = mysqli_real_escape_string($db3, $_POST['telefon']);
    $pass_1 = mysqli_real_escape_string($db3, $_POST['password_1']);
  $pass_2 = mysqli_real_escape_string($db3, $_POST['password_2']);
  if (empty($pass_1)|empty($pass_2)) {echo "<script>alert('Trebuie completat si campul parola');</script>"; } 
  else {
if ($pass_1 != $pass_2) {
	array_push($errors, "The two passwords do not match");
  }
else {
	$password=md5($pass_1);
 $query = "update users set  username='$username',email='$email',adresa='$adresa',telefon='$telefon',password='$password' where username='$username'";
  	mysqli_query($db3, $query);
  	
  header('location: home.html');
	
}
  }
	}
}
}

  
  
  
  ?>
