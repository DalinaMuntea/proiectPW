
 <?php
   
    session_start();
	
	$total=0;
    $database_name = "Product_details";
    $con = mysqli_connect("localhost","root","decembrie",$database_name);
	

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
			
                    unset($_SESSION["cart"][$keys]);
                    
                }
            }
        }
    }

	if (isset($_GET["comanda"])){  
	     
	     if(!empty($_SESSION["cart"])){
			 $db = mysqli_connect('localhost', 'root', 'decembrie', 'orders_details');
			 
			 $result = mysqli_query($db,"SELECT max(id) FROM orders");
			 $row = mysqli_fetch_array($result);
			 $id = $row['max(id)'];
			//echo "New record created successfully. Last inserted ID is: " . $id;
			$data=date("Y-m-d");
			//echo "New record created successfully. Last inserted ID is: " . $data;
			 $username=$_SESSION['username'];
			  
		 mysqli_query($db,"INSERT INTO orders ( ordername,username,date) VALUES ('$id','$username','$data')");

			 foreach ($_SESSION["cart"] as $keys => $value) { 

        $name    =$value["item_name"];
        $quantity =$value["item_quantity"];
        $price    =$value["product_price"];
		
       

        mysqli_query($db,"INSERT INTO products (comanda,name,quantity, price) VALUES ('$id','$name','$quantity','$price')");
		
			 }
			 
		 foreach ($_SESSION["cart"] as $keys => $value){
			
               
                    unset($_SESSION["cart"][$keys]);
				
                    
                
            }
			echo "<script>alert('Comanda dvs a fost trimisa. O sa fiti contactati pentru detalii. Va multumim!');</script>";
		
		
	}

else {
	
	echo "<script>alert('Cosul este gol, nu poate fi trimisa comanda');</script>";
	
}
	}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        }
        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
    </style>
<style>
.button {
  
  padding: 15px 25px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #294E79;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;

  display: block;
  margin-right: auto;
  margin-left: auto;
}

.button:hover {background-color: #295E79}

.button:active {
  background-color: #CACACA;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
</head>
<body>
  
  <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="17%">Remove Item</th>
            </tr>

            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td> <?php echo $value["product_price"];?>Ron</td>
                            <td>
                                 <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?> Ron</td>
                            <td><a href="cart2.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="text-danger">Remove Item</span></a></td>

                        </tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <th align="right"> <?php echo number_format($total, 2); ?> Ron</th>
                            <td></td>
                        </tr>
                        <?php
                    }
                ?>
				

				
            </table>
        </div>
		</div> 
	
					<form action="cart2.php" >
    <input type="submit" class="button"  name = "comanda" value="Send" align="center" />
</form> 

		</body>
		</html>
		