<?php 
require("stripe.init.php");

$Publishable ="pk_test_51IzON5FEmyZHeexJ51Sy1k8SYXVCd5gdXLi8yjdOfoh9iXrK4nSyGbypLM3xhT2hS5ZYjYob3LmlCgqlfx5uUtTZ00qJ6npMX8";
$Secret = "sk_test_51IzON5FEmyZHeexJIUPehqH5xZKNPX9bQVwSWPXIm5xadZ2COvxJMP4hsUGPwjKoLGZrXv1myeGY6cwKxQISqv6l00Agmf9TQp";
\stripe\stripe::setApiKey($Secret);



?>