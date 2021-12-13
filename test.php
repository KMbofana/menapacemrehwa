<?php session_start();
#cart.php - A simple shopping cart with add to cart, and remove links
 //---------------------------
 //initialize sessions
 $con=mysqli_connect("localhost","root","","max_shop");

 $query=mysqli_query($con,"SELECT `product_name`,`price`,`image` FROM `stocks`");


while($result=mysqli_fetch_assoc($query)){
    //Define the products and cost
    $products[]=$result['product_name'];
    $amounts[]=$result['price'];
    $image[]=$result['image'];
    }


//Load up session
 if ( !isset($_SESSION["total"]) ) {
   $_SESSION["total"] = 0;
   for ($i=0; $i< count($products); $i++) {
   $_SESSION["qty"][$i] = 0;
   $_SESSION["amounts"][$i] = 0;
   $_SESSION["image"][$i] = 0;
  }
 }

 //---------------------------
 //Reset
 if ( isset($_GET['reset']) )
 {
 if ($_GET["reset"] == 'true')
   {
   unset($_SESSION["qty"]); //The quantity for each product
   unset($_SESSION["amounts"]); //The amount from each product
   unset($_SESSION["image"]); //The image for each product
   unset($_SESSION["total"]); //The total cost
   unset($_SESSION["cart"]); //Which item has been chosen
   }
 }

 //---------------------------
 //Add
 if ( isset($_GET["add"]) )
   {
   $i = $_GET["add"];
   $qty = $_SESSION["qty"][$i] + 1;
   $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
   $_SESSION["cart"][$i] = $i;
   $_SESSION["qty"][$i] = $qty;
   echo "<script type='text/javascript'>
   alert('Item Added to Cart. Scroll down to see Cart Items')
   </script>";
   
 }

  //---------------------------
  //Delete
  if ( isset($_GET["delete"]) )
   {
   $i = $_GET["delete"];
   $qty = $_SESSION["qty"][$i];
   $qty--;
   $_SESSION["qty"][$i] = $qty;
   //remove item if quantity is zero
   if ($qty == 0) {
    $_SESSION["amounts"][$i] = 0;
    unset($_SESSION["cart"][$i]);
  }
 else
  {
   $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
  }
 }
 
 ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Maxutra Template">
    <meta name="keywords" content="Maxutra, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maxutra</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
 <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_cart"></span>
                    <div class="tip">5</div>
                </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                    <div class="tip">2</div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./shop.html"><img src="" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header" style="background-color:#F5F5F5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="shop.html"><img src="./img/icon.jpg" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                    <ul>
                            <li class="active"><a href="test.php">Shop</a></li>
                            <!-- <li><a href="#">Home</a></li> -->
                            <!-- <li><a href="#">Blog</a></li> -->
                            <li><a href="https://www.maxutraenergy.co.zw">Home</a></li>

                            <li><a href="#">Cart</a></li>
                            <!-- <li><a href="./blog.html">Blog</a></li> -->
                            <li><a href="https://www.maxutraenergy.co.zw/contact.php">Contact</a></li>
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
                            <li><a href="checkout.php"><span class="icon_cart"></span>
                                    <div class="tip" id="cart_items">0</div>
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

<!-- Jumbotron -->
<div class="container">
  <div class="jumbotron" style="background-color:#ffc107;">
    <h2 style="color:#fff">Maxutra Reliable Energy Solutions</h2>      
    <p style="color:#fff">Your Service Provider in Solar installations and Solar Equipment</p>
  </div>
   
</div>
<!-- Jumpotron -->


<!-- Shop Section Begin -->
<section class="shop spad">
   
        <div class="container">
        <div class="row">
        <div class="col-lg-3 col-md-3" style="background-color:#F5F5F5">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Services</h4>
                            </div>
                            <div class="categories__accordion" >
                                <div class="accordion" id="accordionExample" >
                                    <div class="card" style="background-color:#F5F5F5">
                                        <div class="card-heading active">
                                            <a data-toggle="collapse" data-target="#collapseOne">Installation</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li>Site Preparation
                                                    <li>Mounting System development and erection
                                                    <li>PV modules, Inverter and Battery installation
                                                    <li> Offline system pre commissioning tests, parameter settings for
                                                        performance optimization and
                                                    <li> safety inspections

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseTwo">Resouce Assessment</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li>Site Irradiance profile measurements
                                                    <li>Irradiance analysis
                                                    <li>Orientation and space requirements Evaluations
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseThree">System Design</a>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li>Preliminary System sizing and options development
                                                    <li>Final system sizing
                                                    <li>Selection of major system components( Solar PV modules,
                                                        Inverters, and Batteries
                                                    <li>Selection of Protection mechanisms and wiring diagram
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseFour">Maintenance and
                                                repairs</a>
                                        </div>
                                        <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li> Invertor system maintenance and repairs
                                                    <li> PV modules checks and routine cleaning
                                                    <li> Cable inspections
                                                    <li> Battery Inspections
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseFive">Energy Audit</a>
                                        </div>
                                        <div id="collapseFive" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li>Energy Audit onsite or from remote using appliances and time of
                                                        use
                                                    <li>Onsite power measurements
                                                    <li> Desktop energy requirements evaluations
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseFive">Consultancy</a>
                                        </div>
                                        <div id="collapseFive" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li>Sustainable Energy management solutions
                                                    <li> The best solar system selection
                                                    <li> Upgrade to the existing systems
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

         <div class="col-lg-9 col-md-9">
                                <h2>Available Products</h2>
                            <form method="POST" action="payoncheckout.php">
                                
                                <table class="table">
                                <!-- <caption>List of users</caption> -->
                                    <thead class="table-dark" style="background:#000">
                                <tr>
                                <th>Product</th>
                                <th width="10px">&nbsp;</th>
                                <th>Price</th>
                                <th width="10px">&nbsp;</th>
                                <th>Image</th>
                                <th width="10px">&nbsp;</th>
                                <th>Action</th>
                                </tr>
                                </thead>
                                <?php
                                for ($i=0; $i< count($products); $i++) {
                                ?>
                                <tr>
                                <td><?php echo($products[$i]); ?></td>
                                <td width="10px">&nbsp;</td>
                                <td><?php echo($amounts[$i]); ?></td>
                                <td width="10px">&nbsp;</td>
                                <td><a href="productimages/<?php echo($image[$i]); ?>"><image src="productimages/<?php echo($image[$i]); ?>" id="product_image" height="100" width="100" alt="product_image"/></a></td>
                                <td width="10px">&nbsp;</td>
                                <!-- href="?add= -->
                                <?php 
                                // echo($i);
                                 ?>
                                <!-- " -->
                                <td><a id="resetURL_<?php echo $i?>"><input type="button"style="background:#006600; color:#fff; border-style:none; border-radius:5px" onclick="addtocart(<?php echo($i); ?>)" id="addToCart" value="Add to cart"></a></td>
                                </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                <td colspan="5"></td>
                                </tr>
                                <tr>
                                <td colspan="5"><a href="?reset=true"> <input type="button" style="background:#006600; color:#fff;" value="Empty Cart" class="site-btn"></a></td>
                                </tr>
                                </table>
                                <?php
                                if ( isset($_SESSION["cart"]) ) {
                                ?>
                                <br/><br/><br/>
                                <h2>Cart</h2>
                                <table>
                                <tr>
                                <th>Product</th>
                                <th width="10px">&nbsp;</th>
                                <th>Qty</th>
                                <th width="10px">&nbsp;</th>
                                <th>Amount</th>
                                <th width="10px">&nbsp;</th>
                                <th>Action</th>
                                </tr>
                                <?php
                                $total = 0;
                                foreach ( $_SESSION["cart"] as $i ) {
                                ?>
                                <tr>
                                <td> <input type="text" style="border-style:none;" name="products[]" id="" value="<?php echo( $products[$_SESSION["cart"][$i]] ); ?>"></td>
                                <td width="10px">&nbsp;</td>
                                <td><input type="text" style="border-style:none;" name="quantity[]" value="<?php echo( $_SESSION["qty"][$i] ); ?>"></td>
                                <td width="10px">&nbsp;</td>
                                <td><input type="text" style="border-style:none;" name="amounts[]" id="" value="<?php echo( $_SESSION["amounts"][$i] ); ?>"></td>
                                <td width="10px">&nbsp;</td>
                                <td><a href="?delete=<?php echo($i); ?>"><input type="button" type="button"style="background:#006600; color:#fff; border-style:none; border-radius:5px" value="Delete from cart"></a></td>
                                </tr>
                                <?php
                                $total = $total + $_SESSION["amounts"][$i];
                                }
                                $_SESSION["total"] = $total;
                                ?>
                                <tr>
                                <td colspan="7"><input type="hidden" style="border-style:none;" name="total" value="<?php echo($total); ?>" readonly> Total : <?php echo($total); ?></td>
                                </tr>
                                </table>
                                <input type="submit" class="site-btn" style="background:#006600; color:#fff;" value="Checkout">
                                </form>
                                <?php } ?>

                </div>
        </div>
        </div>
    </section>
    <!--Shop Section End -->


    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./shop.html"><img src="" alt=""></a>
                        </div>
                        <p style="color:#fff">Coming Soon</p>
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
                        <h6 style="color:#fff">NEWSLETTER</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" class="site-btn" style="background:#006600; color:#fff;">Subscribe</button>
                        </form>
                        <div class="footer__social">
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-facebook"></i></a>
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-twitter"></i></a>
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-youtube-play"></i></a>
                            <a href="#" style="background:#006600; color:#fff;"><i class="fa fa-instagram"></i></a>
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
    <script src="js/shop.js"></script>
    
    <script>
        try{
            function addtocart(id){
            var reset=document.getElementById("resetURL_"+id);
            var getId="?add="+id;
            reset.setAttribute("href",getId)

        }
        }
       catch(err){
        console.log(err)
        }
    </script>

 </body>
 </html>
