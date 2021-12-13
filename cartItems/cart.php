<?php
include('../database/dbcon.php');


if(isset($_POST['productName'],$_POST['Quantity'],$_POST['Price'],$_POST['token'])){


        $pName=$_POST['productName'];
        $quantity=$_POST['Quantity'];
        $price=$_POST['Price'];
        $token=$_POST['token'];

        $query=mysqli_query($con,"SELECT * FROM `cart_items` WHERE `product_name`='$pName'");
        $count=mysqli_num_rows($query);


        if($count <= 0){
            // $cartId=rand();

            $query1=mysqli_query($con,"INSERT INTO `cart_items`(`product_name`,`product_quantity`,`product_price`,`cart_id`) VALUES('$pName','$quantity','$price',$token)");

        }elseif($count >= 0){
            
            $query2=mysqli_query($con,"UPDATE `cart_items` SET `product_quantity`='$quantity' WHERE `product_name`='$pName'");

        }else{
            echo "Cannot Add Items";
        }
        echo "saved";

}else{
    echo 
    "
        <script type='text/javascript'>
            alert('No Items to Add to Cart')
            window.location='../index.html'
        </script>
    ";
}

// new different product
if(isset($_POST['prodSyn'],$_POST['synQuant'],$_POST['synPrice'])){


    $prodSyn=$_POST['prodSyn'];
    $synQuant=$_POST['synQuant'];
    $synPrice=$_POST['synPrice'];
    $token=$_POST['token'];


    $qSyn=mysqli_query($con,"SELECT * FROM `cart_items` WHERE `product_name`='$prodSyn'");
    $count=mysqli_num_rows($qSyn);


    if($count <= 0){
        // $synId=rand();

        $qSyn1=mysqli_query($con,"INSERT INTO `cart_items`(`product_name`,`product_quantity`,`product_price`,`cart_id`) VALUES('$prodSyn','$synQuant','$synPrice',$token)");

    }elseif($count >= 0){
        
        $qSyn2=mysqli_query($con,"UPDATE `cart_items` SET `product_quantity`='$synQuant' WHERE `product_name`='$prodSyn'");

    }else{
        echo "Cannot Add Items";
    }
    echo "saved";

}else{
echo 
"
    <script type='text/javascript'>
        alert('No Items to Add to Cart')
        window.location='../index.html'
    </script>
";
}

// new different product
if(isset($_POST['chargeProd'],$_POST['chargeQuant'],$_POST['chargePrice'],$_POST['token'])){


    $chargeProd=$_POST['chargeProd'];
    $chargeQuant=$_POST['chargeQuant'];
    $chargePrice=$_POST['chargePrice'];
    $token=$_POST['token'];

    $qCharge=mysqli_query($con,"SELECT * FROM `cart_items` WHERE `product_name`='$chargeProd'");
    $count=mysqli_num_rows($qCharge);


    if($count <= 0){
        // $chargeId=rand();

        $qCharge1=mysqli_query($con,"INSERT INTO `cart_items`(`product_name`,`product_quantity`,`product_price`,`cart_id`) VALUES('$chargeProd','$chargeQuant','$chargePrice',$token)");

    }elseif($count >= 0){
        
        $qCharge2=mysqli_query($con,"UPDATE `cart_items` SET `product_quantity`='$chargeQuant' WHERE `product_name`='$chargeProd'");

    }else{
        echo "Cannot Add Items";
    }
    echo "saved";

}else{
echo 
"
    <script type='text/javascript'>
        alert('No Items to Add to Cart')
        window.location='../index.html'
    </script>
";
}

// new different product
if(isset($_POST['solarProd'],$_POST['solarQuant'],$_POST['solarPrice'],$_POST['token'])){


    $solarProd=$_POST['solarProd'];
    $solarQuant=$_POST['solarQuant'];
    $solarPrice=$_POST['solarPrice'];
    $token=$_POST['token'];


    $qSolar=mysqli_query($con,"SELECT * FROM `cart_items` WHERE `product_name`='$solarProd'");
    $count=mysqli_num_rows($qSolar);


    if($count <= 0){
        // $solarId=rand();

        $qSolar1=mysqli_query($con,"INSERT INTO `cart_items`(`product_name`,`product_quantity`,`product_price`,`cart_id`) VALUES('$solarProd','$solarQuant','$solarPrice',$token)");

    }elseif($count >= 0){
        
        $qSolar2=mysqli_query($con,"UPDATE `cart_items` SET `product_quantity`='$solarQuant' WHERE `product_name`='$solarProd'");

    }else{
        echo "Cannot Add Items";
    }
    echo "saved";

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