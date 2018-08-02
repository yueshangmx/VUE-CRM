<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/24
 * Time: 15:15
 */
require "connect.php";

$id    = $_POST['id'];
$state = $_POST['state'];
switch ( $state ) {
	case 0:
		$sql = "SELECT * FROM `kehu` WHERE id=$id";
		require_once "mysqli_query.php";
		break;
	case 1:
		$sql = "DELETE FROM `kehu` WHERE id=$id";
		require "getRes.php";
}
echo json_encode( $res );
