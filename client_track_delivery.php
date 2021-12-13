<?php 
session_start();
include("./database/dbcon.php");

// print_r($_SESSION['client']);

if(isset($_SESSION['client'],$_SESSION['phone'])){

// $_SESSION['buyer_id']; assigned when buyer pays for the goods or choose to pay on delivery
$email=$_SESSION['client'];
$phone=$_SESSION['phone'];

$query=mysqli_query($con,"SELECT `status` FROM `paid_for_items` WHERE `email`='$email' AND `phone`=$phone");
$check=mysqli_num_rows($query);
$result=mysqli_fetch_assoc($query);


if($check > 0){
    $status=$result['status'];
    
?>





<h2 style="text-align:center; color:#fff;">Thank You: <?php echo $_SESSION['client'];?></h2></br>


    <?php 
    if(isset($status) && $status=="pending"){
        include('./timliner/newtime.php');
    
        }
 
    elseif(isset($status) && $status=="items in transit")
    {
    include('./timliner/second.php');
    } elseif(isset($status)&& $status=="items delivered"){
        include('./timliner/third.php');
     ?>
   
      <h6 style="text-align:center; color:#fff;">Contact Maxtraenergy Solution @:</h6>
      <p style="text-align:center; color:#fff;">WhatsApp: 0779 363 209</p>
      <p style="text-align:center; color:#fff;">Facebook: Maxutrae Energy</p>
      <p style="text-align:center; color:#fff;">Twitter: Maxutrae Energy</p>
      <p style="text-align:center; color:#fff;">Instagram: Maxutrae Energy</p>
      <p style="text-align:center; color:#fff;">Email: sales@maxutraenergy.co.zw </p>
      <div style="display:flex; justify-content:center; margin-top:50px;">
      
      <form method="post" action="acknowledge.php">
          <input type="text" name="ack" id="" value="<?php echo $_SESSION['client']; ?>" hidden>
        <input type="submit" value="Acknowledge Reception">
      </form>
     
      </div>
      
  <?php   }
  else{
      ?>
<h4>No Items send for delivery, Order Items</h4>
  <?php
  }
  ?>
</div>

<?php include('./admin/footer.php')?>



<?php } 
}
// else{
//    echo "<script type='text/javascript'> 
//    alert('Session Expired Please Login to track your order')
               
//     window.location='login_client.php'
//     </script>";
// }
?>