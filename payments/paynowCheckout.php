<?php

include('../database/dbcon.php');

// require_once '../vendor/autoload.php';


$preStatement=$con->prepare("INSERT INTO `sold_items`(`full_name`, `email`, `phone`, `item`, `quantity`, `unitprice`, `total_price`) VALUES (?,?,?,?,?,?,?)");
$preStatement->bind_param("ssisidd",$fullName,$email,$phone,$proddb,$quantdb,$u_pricedb,$sum,);

if(isset($_POST['fullName'],$_POST['email'],$_POST['phone'],$_POST['name'],$_POST['quant'],$_POST['unit_price'],$_POST['price'])){
    

    $fullName=$_POST['fullName'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];

    //array of total prices being charged the client 
    $price=$_POST['price'];


    // sum of total price of items being bought
    $sum=array_sum($price);


    echo $sum;
    // item bought details
    $products=$_POST['name'];
    $quantity=$_POST['quant'];
    $unit_price=$_POST['unit_price'];

    $array=array(
        "name"=>$_POST['name'],
        "quantity"=>$_POST['quant'],
        "unit"=>$_POST['unit_price']
    );

    print_r($array['unit']);
    foreach($array as $details){
        $proddb=$array['name'];
        $quantdb=$array['quantity'];
        $u_pricedb=$array['unit'];
    }
  
  
    // $preStatement->execute();

    // echo $sum;

$paynow = new Paynow\Payments\Paynow(
    '12373',
    '17bb299d-ce7e-4a25-a979-03b29e34dec3',
    'http://example.com/gateways/paynow/update',

    // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
    'http://example.com/return?gateway=paynow'
);

$payment = $paynow->createPayment('Solar Accessories', 'maxutra2019@gmail.com');

// Passing in the name of the item and the price of the item
$payment->add('Maxutra Sale', $sum);
// $payment->add('Apples', 3.40);


// Save the response from paynow in a variable
// $response = $paynow->send($payment);
    $response = $paynow->sendMobile($payment, '0779363209', 'ecocash');

    if($response->success()) {
        // Or if you prefer more control, get the link to redirect the user to, then use it as you see fit
        $link = $response->redirectUrl();

        // Get the poll url (used to check the status of a transaction). You might want to save this in your DB
        $pollUrl = $response->pollUrl();
        // Check the status of the transaction with the specified pollUrl
        // Now you see why you need to save that url ;-)
    $status = $paynow->pollTransaction($pollUrl);

    if($status->paid()) {
    echo "Yay! Transaction was paid for";
    } else {
        print("Why you no pay?");
    }

    }



}












?>