<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/8/3
 * Time: 11:32
 */
require "connect.php";
$parent_id = $_GET['parent_id'];

$state = $_GET['state'];

switch ($state) {
	case "0":
		$sql       = "SELECT user_id FROM `users` WHERE user_parent_id=$parent_id";
		break;
	case "1":
		$sql       = "SELECT id FROM `kehu` WHERE kehu_parent_id=$parent_id";
		break;
}
$result = mysqli_query( $con, $sql );
if ( $result) {
	$res = [];
	while ( ( $row = mysqli_fetch_assoc( $result ) ) != null ) {
		$res[] = $row;
	}
} else {
	$res =array(
		"result" => false
	);
}
echo json_encode($res);
