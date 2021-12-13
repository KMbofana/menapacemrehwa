<?php
/* Database connection start */
include('config_2.php');
/* Database connection end */
session_start();


$stmt=$con->prepare("UPDATE `paid_for_items` SET `status`=? WHERE `paid_id`=? AND `phone`=? AND `status`=?");
$stmt->bind_param("siis",$status,$i,$p,$s);

$json=file_get_contents('php://input');

$data=json_decode($json,true);

if(isset($data)){
	$i=(int)$data['id'];
	$p=(int)$data['phone'];
	$s=(string)$data['status'];

	
	$status="Order Cancelled";
	$stmt->execute();
	$msg=array(
		"msg"=>"order cancelled"
	);
	echo "orders with id ".$i."and phone ".$p." has been cancelled";

	// Notify through email and sms


}else{
	$msg=array(
		"msg"=>"Failed to cancell order"
	);

}












?>
