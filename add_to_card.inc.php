<?php 
require('admin/config.php');

class add_to_card{
	function addProduct($pid,$qty){
		$_SESSION['card'][$pid]['qty'] = $qty;
	}
	function updateProduct($pid,$qty){
		if(isset($_SESSION['card'][$pid])){
			$_SESSION['card'][$pid]['qty'] = $qty;
		}
	}
	function removeProduct($pid){
		if(isset($_SESSION['card'][$pid])){
			unset($_SESSION['card'][$pid]);
		}
	}
	function emptyProduct(){
		unset($_SESSION['card']);
	}
	function totalProduct(){
		if(isset($_SESSION['card'])){
			return count($_SESSION['card']);
		}else{
			return 0;
		}
	}
}