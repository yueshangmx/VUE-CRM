<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/8/1
 * Time: 10:20
 */
require "connect.php";

$user_id = $_REQUEST['user_id'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		$sql = "SELECT u.*,d.`dept_name`,g.`group_name` FROM `users` AS u LEFT JOIN `dept` AS d ON d.`dept_id`=u.`user_dept_id` LEFT JOIN `user_group` AS g ON g.`group_id`=u.`user_group_id`
WHERE u.`user_id`=$user_id";
		require_once "mysqli_query.php";
		break;
	case 'POST':
		$sql = "DELETE  FROM `users` WHERE user_id=$user_id";
		require_once "getRes.php";
		break;
}
echo json_encode($res);