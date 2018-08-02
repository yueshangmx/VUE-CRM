<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/23
 * Time: 16:56
 */
require "connect.php";

$parent_id = $_POST['parent_id'];

if(isset($_POST['start'])) {
	$start = $_POST['start'];
	$count = $_POST['count'];
	$sql = "SELECT id,kehu_name,kehu_phone,kehu_vip_id FROM `kehu` WHERE kehu_parent_id='$parent_id' ORDER BY id LIMIT $start,$count";
	$result = mysqli_query($con,$sql);

	$res = [];
	while (($row = mysqli_fetch_assoc($result))!==NULL){
		$res[] = $row;
	};
	echo json_encode($res);
} else {
	$sql = "SELECT id FROM `kehu` WHERE kehu_parent_id='$parent_id'";
	$result = mysqli_query($con,$sql);
	$total = mysqli_num_rows($result);
	echo '{"total":'.$total.'}';
}




