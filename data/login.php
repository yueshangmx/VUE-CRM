<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/6/22
 * Time: 11:40
 */
require "connect.php";

$token = $_POST['token'];
$name  = !empty($_POST['name']) ? $_POST['name'] : "";
$pwd   = !empty($_POST['pwd']) ? md5($_POST['pwd']) : "";


if ( $token ) {
	if($name && $pwd){
		$sql = "SELECT * FROM `users` WHERE user_token='$token' AND user_name='$name' AND user_pwd='$pwd' LIMIT 1";
	} else {
		$sql = "SELECT * FROM `users` WHERE user_token='$token' LIMIT 1";
	}
	require_once "mysqli_query.php";
	if ( $res ) {
		echo json_encode($res);
	} else {
		echo '{"result":false}';
	}

} else {
	$sql = "SELECT * FROM `users` WHERE user_name='$name' AND user_pwd='$pwd' LIMIT 1";
	require_once "mysqli_query.php";
	if ( $res ) {
		$user_token = md5("$name-$pwd");
		$user_id = $res['user_id'];
		mysqli_query($con,"UPDATE users SET user_token='$user_token' WHERE user_id=$user_id");
		require_once "mysqli_query.php";
		echo json_encode($res);
	} else {
		echo '{"result":false}';
	}
}






