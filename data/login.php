<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/6/22
 * Time: 11:40
 */
require "connect.php";

$name  = ! empty( $_POST['name'] ) ? $_POST['name'] : "";
$pwd   = ! empty( $_POST['pwd'] ) ? md5( $_POST['pwd'] ) : "";
$token = ! empty( $_POST['token'] ) ? $_POST['token'] : md5( "$name-$pwd" );


if ( $name && $pwd ) {
	$sql = "SELECT * FROM `users` WHERE user_token='$token' AND user_name='$name' AND user_pwd='$pwd' LIMIT 1";
} else {
	$sql = "SELECT * FROM `users` WHERE user_token='$token' LIMIT 1";
}
require_once "mysqli_query.php";

echo json_encode($res);







