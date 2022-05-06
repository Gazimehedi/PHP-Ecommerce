<?php 
require('admin/config.php');
unset($_SESSION['LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
header("location: index.php");
