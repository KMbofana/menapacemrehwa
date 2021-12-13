<?php 
include('./config_2.php');
$json=file_get_contents("php://input");
$posted=json_decode($json);

//converting object to an array; 
$data=(array)$posted;

$id=$data["id"];
$pname=$data["name"];
$price=$data["price"];
$quantity=$data["quantity"];

$query=mysqli_query($con,"UPDATE `stocks` SET `product_name`='$pname',`price`=$price,`quantity`=$quantity WHERE `stock_id`=$id");
$json=array(
    "status"=>"1",
    "msg"=>"updated"
);

$json=json_encode($json);
echo $json;
?>