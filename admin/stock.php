<?php
include("config_2.php");

$stmt=$con->prepare("INSERT INTO stocks(`product_name`,`price`,`quantity`,`image`)VALUES(?,?,?,?)");
$stmt->bind_param('sdis',$name,$price,$quantity,$image);
$target_dir="../productimages/";



if(isset($_POST['product_name'],$_POST['price'],$_POST['quantity'],$_FILES['image'])){

    $name=$_POST['product_name'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];
    $image=$_FILES['image']['name'];
    $uploadprod=$target_dir.basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'],$uploadprod);
    $stmt->execute();


    echo "<script type='text/javascript'>
    alert('Added To Stock')
    window.location='./admin.php'
</script>";

}else{
    echo "<script type='text/javascript'>
            alert('Nothing to Add')
            window.location='./admin.php'
        </script>";
}

?>