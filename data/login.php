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
$pwd   = $_POST['pwd'];


if ( $token ) {
	$sql = "SELECT * FROM `users` WHERE user_token='$token' AND user_name='$name' AND user_pwd='$pwd' LIMIT 1";
	require_once "check.php";
	if ( $check_query ) {
		echo json_encode($check_query);
	} else {
		echo '{"result":false}';
	}
} else {
	$sql = "SELECT * FROM `users` WHERE user_name='$name' AND user_pwd='$pwd' LIMIT 1";
	require_once "check.php";

}



if ( $check_query ) {
	echo $check_query['user_token'] ? json_encode($check_query):'{"result": true}';
} else {
	echo '{"result":false}';
}


