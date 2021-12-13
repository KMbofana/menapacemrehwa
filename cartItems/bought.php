<?php

include('../database/dbcon.php');

session_start();

$token=$_SESSION["token"];



$json=file_get_contents('php://input');
$data=json_decode($json,true);



$pName=$data['name'];
$quantity=$data['quantity'];
$price=$data['price'];


if(isset($pName,$quantity,$price)){


        $query=mysqli_query($con,"SELECT * FROM `cart_items` WHERE `product_name`='$pName'");
        $result=mysqli_fetch_assoc($query);
        $count=mysqli_num_rows($query);

        // get stock quantities
        $getStocks=mysqli_query($con,"SELECT `quantity`,`product_name` FROM stocks WHERE `product_name`='$pName'");
        $stockresult=mysqli_fetch_assoc($getStocks);

        
        if($count <= 0){
           $stockquant=$stockresult['quantity'];
           $stockquant -= 1;

            $query1=mysqli_query($con,"INSERT INTO `cart_items`(`product_name`,`product_quantity`,`product_price`,`cart_id`) VALUES('$pName','$quantity','$price',$token)");

            $update=mysqli_query($con,"UPDATE `stocks` SET `quantity`=$stockquant WHERE `product_name`='$pName'");


        }elseif($count >= 0){
            $quant = $result['product_quantity'];
            $quant +=1;

            $stockquant=$stockresult['quantity'];
            $stockquant -= 1;
            $query2=mysqli_query($con,"UPDATE `cart_items` SET `product_quantity`='$quant' WHERE `product_name`='$pName' AND `cart_id`=$token");
            $update=mysqli_query($con,"UPDATE `stocks` SET `quantity`=$stockquant WHERE `product_name`='$pName'");
        }else{
            echo "Cannot Add Items";
        }
        $response = "saved";
        
        echo $response;

}else{
    echo 
    "
        <script type='text/javascript'>
            alert('No Items to Add to Cart')
            window.location='../index.html'
        </script>
    ";
}


?>