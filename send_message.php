<?php 
require('admin/config.php');

$name = safe($_POST['name']);
$email = safe($_POST['email']);
$mobile = safe($_POST['mobile']);
$comment = safe($_POST['message']);
$added_on = date('Y-m-d h:i:s');

query("insert into contact_us (name,email,mobile,comment,added_on) value('{$name}','{$email}','{$mobile}','{$comment}','{$added_on}')");
echo "Thank you";
