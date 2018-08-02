<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/8/2
 * Time: 13:41
 */
require "connect.php";
$goods_id = $_REQUEST['goods_id'];

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		$sql = "SELECT g.*,f.`fenlei_name` FROM `goods` AS g LEFT JOIN `goods_fenlei` AS f ON f.`fenlei_id`=g.`goods_fenlei_id` WHERE g.`goods_id`=$goods_id";
		require_once "mysqli_query.php";
		break;
	case 'POST':
		$sql = "DELETE FROM `goods` WHERE goods_id=$goods_id";
		require_once "getRes.php";
		break;
}
echo json_encode($res);