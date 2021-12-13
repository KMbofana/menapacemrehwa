<?php
include('../database/dbcon.php');

$drop=$_POST['drop'];
// $drop='5KVA 48V 80a MPPT';

echo $drop;

$q=mysqli_query($con,"SELECT `product_quantity` FROM `cart_items` WHERE `product_name`='$drop'");
$r=mysqli_fetch_assoc($q);

$qunt=(int)$r['product_quantity'];

$qunt -=1;

$query=mysqli_query($con,"UPDATE `cart_items` SET `product_quantity`='$qunt'");


?>