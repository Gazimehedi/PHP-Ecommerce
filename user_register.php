<?php 
require('admin/config.php');

$name = safe($_POST['name']);
$email = safe($_POST['email']);
$mobile = safe($_POST['mobile']);
$password = safe($_POST['password']);
$added_on = date('Y-m-d h:i:s');

$res = query("select * from users where email = '{$email}'");
if(counter($res)>0){
	echo "wrong";
}else{
	query("insert into users (name,email,mobile,password,added_on) value('{$name}','{$email}','{$mobile}','{$password}','{$added_on}')");
	echo "valid";
}
