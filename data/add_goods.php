<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/30
 * Time: 14:55
 */
require "connect.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		$parent_id = $_GET['parent_id'];
		$sql = "INSERT INTO `goods` VALUES(NULL,'','','','',0,'','',$parent_id)";
		$result = mysqli_query($con,$sql);
		echo json_encode($result);
		break;
	case 'POST':
		break;
}

//echo json_encode($res);