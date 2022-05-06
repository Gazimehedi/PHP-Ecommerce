<?php
function pr($arr){
	echo "<pre>";
	print_r($arr);
}
function prx($arr){
	echo "<pre>";
	print_r($arr);
	die();
}
function safe($str){
	global $connection;
	trim($str);
	if($str != ""){
	return mysqli_real_escape_string($connection,$str);
}
}
function query($sql){
	global $connection;
	return mysqli_query($connection,$sql);
}
function confirm($res){
	global $connection;
	if(!$res){
		die("Query Failed".mysqli_error($connection));
	}
}
function f_array($res){
	return mysqli_fetch_array($res);
}
function counter($res){
	return mysqli_num_rows($res);
}

//FRONT END FUNCTIONS
function get_product($type='',$limit='',$cat_id='',$id='',$search_str='',$sort_order=''){
	$sql="select products.*,categoris.category_name from products join categoris on products.category_id = categoris.category_id where products.status=1 ";
	if($cat_id!=''){
		$sql.=" and products.category_id = $cat_id";
	}
	if($id!=''){
		$sql.=" and products.id=$id";
	}
	if($search_str!=''){
		$sql.=" and (products.name like '%$search_str%' or products.description like '%$search_str%') ";
	}
	if($sort_order != ''){
		$sql.= $sort_order;
	}
	if($type=='latest'){
		$sql.=" order by products.id desc";
	}
	if($limit!=''){
		$sql.=" limit $limit";
	}
	$res = query($sql);
	$product_data = array();
	while($row = f_array($res)){
		$product_data[] = $row;
	}
	return $product_data;
}
