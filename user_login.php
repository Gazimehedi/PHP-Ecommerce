<?php 
require('admin/config.php');

$email = safe($_POST['email']);
$password = safe($_POST['password']);

$res = query("select * from users where email = '{$email}' and password = '{$password}'");
$row = f_array($res);
if(counter($res)>0){
	$_SESSION['LOGIN'] = "yes";
	$_SESSION['USER_ID'] = $row['id'];
	$_SESSION['USER_NAME'] = $row['name'];
	echo "valid";
}else{
	echo "wrong";
}
