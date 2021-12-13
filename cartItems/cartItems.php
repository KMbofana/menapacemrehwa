<?php
    include('../database/dbcon.php');

    $data=array();
    $query=mysqli_query($con,"SELECT * FROM `cart_items` GROUP BY `product_name`");
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="../payments/paynowCheckout.php" method="POST">
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Product Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($result=mysqli_fetch_assoc($query)){
                    $data[]=$result;
            ?>
            <tr>
            <td>
            <input type="text" name="" id="" value="
             <?php
                foreach($data as $key => $det){
                  
                            echo $key;
              
                }
              
                ?>">
                
                </td>
             
               
            </tr>
            <?php  }?>
        </tbody>

    </table></br>

    <input type="submit" value="Checkout">
    </form>
</body>
</html>