<?php
/* Database connection start */
include('config_2.php');
/* Database connection end */
session_start();


$stmt=$con->prepare("UPDATE `paid_for_items` SET `status`=? WHERE `paid_id`=? AND `phone`=?");
$stmt->bind_param("sii",$status,$i,$p);

$json=file_get_contents('php://input');

$data=json_decode($json,true);

if(isset($data)){
	$i=(int)$data['id'];
	$p=(int)$data['phone'];

	
	$status="items in transit";
	$stmt->execute();
	$msg=array(
		"msg"=>"processed"
	);
	echo "order with id ".$i."and phone ".$p." is processed";
}else{
	$msg=array(
		"msg"=>"No orders received for processesing"
	);

}












?>
