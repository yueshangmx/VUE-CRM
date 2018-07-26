<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/26
 * Time: 11:38
 */
require "connect.php";

$user_id = $_POST['user_id'];

if ( ! empty( $_POST['dept_id'] ) ) { //删除部门
	$dept_id = $_POST['dept_id'];

} else { //更新部门列表
	$sql    = "SELECT * FROM `dept` WHERE dept_user_id=$user_id";
	$result = mysqli_query( $con, $sql );
	$res = [];
	while ( ( $row = mysqli_fetch_assoc( $result ) ) !== null ) {
		$res[] = $row;
	}
	echo json_encode($res);
}