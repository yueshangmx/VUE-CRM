<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/6/22
 * Time: 11:40
 */
require_once "connect.php";
$token = $_POST['token'];
$name  = $_POST['name'];
$pwd   = md5($_POST['pwd']);


if ( $token ) {
	if($name && $pwd){
		$sql = "SELECT * FROM `users` WHERE user_token='$token' AND user_name='$name' AND user_pwd='$pwd' LIMIT 1";
	} else {
		$sql = "SELECT * FROM `users` WHERE user_token='$token' LIMIT 1";
	}
	require_once "select.php";
	if ( $check_query ) {
		echo json_encode($check_query);
	} else {
		echo '{"result":false}';
	}

} else {
	$sql = "SELECT * FROM `users` WHERE user_name='$name' AND user_pwd='$pwd' LIMIT 1";
	require_once "select.php";
	if ( $check_query ) {
		$user_token = md5("$name-$pwd");
		$user_id = $check_query['user_id'];
		mysqli_query($con,"UPDATE users SET user_token='$user_token' WHERE user_id=$user_id");
		require_once "select.php";
		echo json_encode($check_query);
	} else {
		echo '{"result":false}';
	}
}






