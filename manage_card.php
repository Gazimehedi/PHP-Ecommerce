<?php 
require('add_to_card.inc.php');

$pid = safe($_POST['pid']);
$qty = safe($_POST['qty']);
$type = safe($_POST['type']);

$obj = new add_to_card();

if($type=="add"){
	$obj->addProduct($pid,$qty);
}
if($type=="update"){
	$obj->updateProduct($pid,$qty);
}
if($type=="remove"){
	$obj->removeProduct($pid);
}
echo $obj->totalProduct();
