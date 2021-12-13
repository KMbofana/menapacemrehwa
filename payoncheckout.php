<?php
session_start();
    include('./database/dbcon.php');
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    require_once './vendor/autoload.php';
    $goods_session='';
    $quantity_session='';
    $goodsBought='';
    $quantitiesBought='';
    $total='';


// getting details of the products details
if(isset($_POST['products'],$_POST['quantity'],$_POST['amounts'],$_POST['total'])){

    $customerOder=array(
        "products"=>$_POST['products'],
        "quantity"=>$_POST['quantity'],
        "amounts"=>$_POST['amounts']
    );
$total=$_POST['total'];
    // imploding the products and quantities into a string
for($i=0; $i<count($customerOder['products']); $i++){
    $bought[]=$customerOder['products'][$i];
    $implodngString=" and ";
    $goodsBought=implode($implodngString,$bought);
    $_SESSION['goods']=$goodsBought;
}
for($q=0; $q<count($customerOder['quantity']); $q++){
    $implodeQuantity=" and ";
    $quantityOrdered[]=$customerOder['quantity'][$q];
    $quantitiesBought=implode($implodeQuantity,$quantityOrdered);
    $_SESSION['quantities']=$quantitiesBought;
}
$goods_session=$_SESSION['goods'];
$quantity_session=$_SESSION['quantities'];


} 
// echo $total;
$message= $goods_session."in quantities"." ".$quantity_session." "."respectively";

$record_sale=$con->prepare("INSERT INTO `paid_for_items`(`full_name`,`email`,`home_address`,`phone`,`good_details`,`total`,`status`,`payment_method`) VALUES(?,?,?,?,?,?,?,?)");
$record_sale->bind_param("sssisdss",$name,$email,$home,$phone,$goods,$total,$status,$payment_method);

if(isset($_POST['fullName'],$_POST['email'],$_POST['home_address'],$_POST['phone'], $_POST['goods_details'], $_POST['total'],$_POST['payment_method']) && $_POST['payment_method']=="paynow"){

    $name=$_POST['fullName'];
    $email=$_POST['email'];
    $home=$_POST['home_address'];
    $phone=$_POST['phone'];
    $goods=$_POST['goods_details'];
    $total=$_POST['total'];
    $status="pending";
    $payment_method=$_POST['payment_method'];
    // echo $name." and ".$email." and ".$phone." and ".$goods." and ".$total;
           //set to true if you want to clear cache
           echo "<script type='text/javascript'>
               alert('Thank you for trusting Maxutra, your order has been sent for processing')
               </script>";

    $_SESSION['client']=$name;



// //    firt process payments
// commentent to allow development 14 July 2021
$paynow = new Paynow\Payments\Paynow(
    '11038',
    '9e79fc04-d4fd-4227-9bbc-e9eefa3fea74',
    'http://example.com/gateways/paynow/update',

    // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
    'http://example.com/return?gateway=paynow'
);

$payment = $paynow->createPayment('Solar Accessories', 'maxutra2019@gmail.com');

// Passing in the name of the item and the price of the item
$payment->add('Maxutra Sale', $total);
// $payment->add('Apples', 3.40);


// Save the response from paynow in a variable
// $response = $paynow->send($payment);
$response = $paynow->sendMobile($payment, $phone, 'ecocash');

if($response->success()) {
    // Or if you prefer more control, get the link to redirect the user to, then use it as you see fit
    $link = $response->redirectUrl();

    // Get the poll url (used to check the status of a transaction). You might want to save this in your DB
    $pollUrl = $response->pollUrl();
    // Check the status of the transaction with the specified pollUrl
// Now you see why you need to save that url ;-)
$status = $paynow->pollTransaction($pollUrl);

// Sending Email if payment is successful
if($status->paid()) {
// Record Sale upon Payment
    $record_sale->execute();
    
   echo "<script type='text/javascript'>alert('Yay! Transaction was paid for')</script>";

//    send an SMS to Maxutra

        $messagebird = new MessageBird\Client('efFSy6JvvrrR4sbJQfX6DiwOI');
        $message = new MessageBird\Objects\Message;
        $message->originator = '+263779363209'; 
        $message->recipients = [ '+263779363209' ]; //Can only be changed on paid plan
        $message->body = $name."(".$phone.")"."has bought".$goodsBought."in".$quantities."payment has been through paynow";
        $response = $messagebird->messages->create($message);
        print_r(json_encode($response)); //Change here to manage json response


// SMS ends
   
   $mail = new PHPMailer();

   $mail->SMTPOptions = array(
       'ssl' => array(
       'verify_peer' => false,
       'verify_peer_name' => false,
       'allow_self_signed' => true
       )
       );
   $message=$goodsBought." with quantities ".$quantitiesBought;
   $mail->isSMTP();
   $mail->SMTPDebug=0;
   $mail->Host = 'smtp.gmail.com';
   $mail->Port = 587;
   $mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;
   $mail->SMTPAuth = true;
   $mail->Username = 'test@maxutraenergy.co.zw'; //set from vc this time
   $mail->Password = '123456]['; //paste one generated by Mailtrap
   $mail->setFrom($email);
   $mail->Subject = 'MAXUTRAE ONLINE SALES';
   $mailContent = $message;
   $mail->Body = $mailContent;
   // $mail->addReplyTo($email, 'Mailtrap');
   $mail->addAddress('procsystemtest@gmail.com', 'TTLCC'); 
   
   $mail->isHTML(true);
   
   
   
   if($mail->send()){
       echo "<script type='text/javascript'>
               alert('Maxutrae Sales Team will call for deliveries!!')
               window.location='test.php'
               </script>";
      
   }else{
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
   }
   




} 
// else {
//     echo "<script type='text/javascript'>alert('Please Reload Page')</script>";
// }

// Uncomment this for email and paynow 14 July 2021}




// Record Sale to Database and send Notification via SMS to the Sales Team at Maxutra




}

}
elseif(isset($_POST['fullName'],$_POST['email'],$_POST['home_address'],$_POST['phone'], $_POST['goods_details'], $_POST['total'],$_POST['payment_method']) && $_POST['payment_method']=="cash"){

    echo "<script type='text/javascript'>
            alert('Your Payment Method Is Cash')          
         </script>";

    $name=$_POST['fullName'];
    $email=$_POST['email'];
    $home=$_POST['home_address'];
    $phone=$_POST['phone'];
    $goods=$_POST['goods_details'];
    $total=$_POST['total'];
    $status="pending";
    $payment_method=$_POST['payment_method'];
    // echo $name." and ".$email." and ".$phone." and ".$goods." and ".$total;
    $record_sale->execute();
    $_SESSION['client']=$email;
    $_SESSION['phone']=$phone;

    // Send SMS to Maxtra Sales Teams
    // $messagebird = new MessageBird\Client('efFSy6JvvrrR4sbJQfX6DiwOI');
    // $message = new MessageBird\Objects\Message;
    // $message->originator = '+263779363209'; 
    // $message->recipients = [ '+263779363209' ]; //Can only be changed on paid plan
    // $message->body = $name."(".$phone.") has bought".$goods." payment wil be made upon delivery";
    // $response = $messagebird->messages->create($message);
    // // print_r(json_encode($response)); //Change here to manage json response

    // $responseJSON=json_encode($response);

    // if($responseJSON.status=="sent"){
          
    //        echo "<script type='text/javascript'>
    //            alert('Thank you for trusting Maxutra, your order has been sent for processing, You can now track your items')
               
    //            window.location='client_track_delivery.php'
    //            </script>";
    // }
    // SMS ends
    echo "<script type='text/javascript'>
    alert('Thank you for trusting Maxutra, your order has been sent for processing, You can now track your items')
    
    window.location='client_track_delivery.php'
    </script>";

    // Sends Email
    // $mail = new PHPMailer();

    // $mail->SMTPOptions = array(
    //     'ssl' => array(
    //     'verify_peer' => false,
    //     'verify_peer_name' => false,
    //     'allow_self_signed' => true
    //     )
    //     );
    // $message=$goodsBought." with quantities ".$quantitiesBought;
    // $mail->isSMTP();
    // $mail->SMTPDebug= 4;
    // $mail->Host = 'maxutraenergy.co.zw'; 
    // $mail->Port = 465;
    // $mail->SMTPSecure =  'ssl';
    // $mail->SMTPAuth = false;
    // $mail->Username = 'test@maxutraenergy.co.zw'; //set from vc this time
    // $mail->Password = '123456]['; //paste one generated by Mailtrap
    // $mail->setFrom($email);
    // $mail->Subject = 'MAXUTRAE ONLINE SALES';
    // $mailContent = $message;
    // $mail->Body = $mailContent;
    // // $mail->addReplyTo($email, 'Mailtrap');
    // $mail->addAddress('test@maxutraenergy.co.zw', 'MAXUTRA'); 
    
    // $mail->isHTML(true);
    
    
    
    // if($mail->send()){
    //     echo "<script type='text/javascript'>
    //             alert('Maxutrae Sales Team will call for deliveries!!')
    //             window.location='test.php'
    //             </script>";
       
    // }else{
    //     echo 'Message could not be sent.';
    //     echo 'Mailer Error: ' . $mail->ErrorInfo;
    // }
    
// sends email ends

}
// else{
//     echo "No Payment Method Selected";
// }

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div> -->
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                    <ul>
                            <li><a href="test.php">Shop</a></li>
                            <!-- <li><a href="#">Home</a></li> -->
                            <!-- <li><a href="#">Blog</a></li> -->
                            <li><a href="https://maxutraenergy.co.zw">Home</a></li>

                            <li class="active"><a href="#">Cart</a></li>
                            <!-- <li><a href="./blog.html">Blog</a></li> -->
                            <li><a href="https://maxutraenergy.co.zw/contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <!-- <div class="header__right">
                        <div class="header__right__auth">
                            <a href="#">Login</a>
                            <a href="#">Register</a>
                        </div>
                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                            <li><a href="#"><span class="icon_heart_alt"></span>
                                <div class="tip">2</div>
                            </a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span>
                                <div class="tip">2</div>
                            </a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section>
        
            <form method="POST" action='<?php $_SERVER['PHP_SELF'] ?>'>
        <div class="row">
                
        <div class="col-lg-4"></div>
           
            <div class="col-lg-4">
            <div class="checkout__order">
        <h5>Your Details</h5>
        <div class="checkout__order__product">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Full Name <span>*</span></p>
                        <input type="text" name="fullName">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Email Address <span>*</span></p>
                        <input type="text" name="email">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Home Address<span>*</span></p>
                        <input type="text" name="home_address">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Phone<span>*</span></p>
                        <input type="text" name="phone">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <!-- <p>Goods<span>*</span></p> -->
                        <input type="hidden" value="<?php echo $message; ?>" name="goods_details">
                        <input type="hidden" value="<?php echo $total; ?>" name="total">
                    </div>
                </div>
        </div>
        <div class="checkout__order__total">
            <ul>
                
                <li>Total <span id="total" style="color:black; text-decoration:none;"><?php echo $total ?></span></li>
            </ul>
        </div>
        <div style="display:flex; flex-direction:row; justify-content:space-between; margin:10px">
        <h6>Select Payment Method</h6>
          <select name="payment_method" id="payment_method" style="">
            <option value="paynow">Paynow</option>
            <option value="cash">Cash</option>
         </select>
        </div>


        <button type="submit" style="background:#006600; color:#fff;" class="site-btn">Pay</button>
    </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
         </form>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./shop.html"><img src="" alt=""></a>
                        </div>
                        <p>Shop with us </p>
                        <div class="footer__payment">
                            <a href="#"><img src="img/payment/payment-1.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-2.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-3.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-4.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-5.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Quick links</h6>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Account</h6>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Orders Tracking</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8">
                    <div class="footer__newslatter">
                        <h6>NEWSLETTER</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" style="background:#006600; color:#fff;" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__social">
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-facebook"></i></a>
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-twitter"></i></a>
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-youtube-play"></i></a>
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-instagram"></i></a>
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="footer__copyright__text">
                        <p>Maxutra
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->


        <!-- Search Begin -->
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search End -->

        <!-- Js Plugins -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/dropcart.js"></script>
        
    </body>

    </html>