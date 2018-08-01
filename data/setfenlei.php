<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/31
 * Time: 11:12
 */
require "connect.php";

$parent_id = $_POST['parent_id'];

if ( ! empty( $_POST['fenlei_id'] ) ) { //更改或删除分类
	$fenlei_id = $_POST['fenlei_id'];
	if (empty($_POST['fenlei_name'])) { //删除
		$sql = "DELETE FROM `goods_fenlei` WHERE fenlei_id=$fenlei_id AND fenlei_parent_id=$parent_id";
		require_once "getRes.php";
	} else {  //更改
		$fenlei_name = $_POST['fenlei_name'];
		$sql = "UPDATE `goods_fenlei` SET fenlei_name='$fenlei_name' WHERE fenlei_id=$fenlei_id AND fenlei_parent_id=$parent_id";
		require_once "getRes.php";
	}
} else {  //更新或添加分类
	if ( empty( $_POST['fenlei_name'] ) ) {  //更新分类
		$sql    = "SELECT * FROM `goods_fenlei` WHERE fenlei_parent_id=$parent_id OR fenlei_parent_id=0";
		$result = mysqli_query( $con, $sql );
		if ( $result->num_rows ) {
			$res = [];
			while ( ( $row = mysqli_fetch_assoc( $result ) ) != null ) {
				$res[] = $row;
			}
		} else {
			$res = '{"result": false}';
		}
	} else {  //添加分类
		$fenlei_name = $_POST['fenlei_name'];
		$sql ="INSERT INTO `goods_fenlei` VALUES(NULL,'$fenlei_name',$parent_id)";
		require_once "getRes.php";
	}
}
echo json_encode( $res );