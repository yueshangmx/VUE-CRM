<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/27
 * Time: 14:44
 */
require "connect.php";
$parent_id = $_POST['parent_id'];
$user_id   = $_POST['user_id'];
$litpic    = ! empty( $_POST['imglist'] ) ? json_encode( $_POST['imglist'] ) : null;
$goods_id  = ! empty( $_POST['goods_id'] ) ? $_POST['goods_id'] : null;
if ( $goods_id ) {
	$sql    = "UPDATE	`goods` SET goods_litpic='$litpic' WHERE goods_id=$goods_id";
	$result = mysqli_query( $con, $sql );
	if ( $result ) {
		$res = array(
			"result" => $result
		);
	} else {
		$res = array(
			"result" => $result
		);
	}
} else {
	$sign   = time();
	$sql    = "INSERT INTO `goods` VALUES(NULL,'',1,'','',0,'','$litpic',$parent_id,$user_id,$sign)";
	$result = mysqli_query( $con, $sql );
	if ( $result ) {
		$sql = "SELECT goods_id FROM `goods` WHERE goods_sign=$sign LIMIT 1";
		require_once "mysqli_query.php";
	} else {
		$res = array(
			"result" => false
		);
	}
}
echo json_encode( $res );