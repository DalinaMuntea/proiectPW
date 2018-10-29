<?php
    session_start();
    $database_name = "orders_details";
    $con = mysqli_connect("localhost","root","decembrie",$database_name);?>
	
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
</head>
<body>

    <div class="container" style="width: 65%">
        <h2>Orders</h2>
        <?php
			$username=$_SESSION['username'];
			//echo "New record created successfully. Last inserted ID is: " . $username;
            $query = "SELECT * FROM orders  WHERE username='$username' ";
            $result = mysqli_query($con,$query);
            if((mysqli_num_rows($result)) > 0) {
                                  
               while ($row = mysqli_fetch_array($result)) {   ?>
			     <h3 class="title2">Orders from <?php echo $row['date'];?></h3>
				   <div style="clear: both"></div>
       
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
               
            </tr>
			       <?php   $ordername= $row['ordername'];
					  $query1="SELECT * FROM products  WHERE (comanda='$ordername')";
					  $result1 = mysqli_query($con,$query1);
					   $total = 0;
            if((mysqli_num_rows($result1)) > 0) {
                                  
               while ($row = mysqli_fetch_array($result1)) {   

                    ?>
                

      

                        <tr>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["quantity"]; ?></td>
                            <td>$ <?php echo $row["price"]; ?></td>
                            <td>
                                $ <?php echo number_format($row["quantity"] * $row["price"], 2); ?></td>
                         

                        </tr>
                        <?php
                        $total = $total + ($row["quantity"] * $row["price"]);
                    
                        ?>
                        
                        <?php
                    
                ?>
           
			   <?php } 
			} ?>
			<tr>
                            <td colspan="3" align="right">Total</td>
                            <th align="right">$ <?php echo number_format($total, 2); ?></th>
                            <!--<td></td>-->
                        </tr>
			</table>
        </div>
			<?php } 
			   } else 
				   echo "<script>alert('Nu ati efectuat nici o comanda');</script>";
			   ?>
    </div>


</body>
</html>