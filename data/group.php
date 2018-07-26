<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/26
 * Time: 11:38
 */
require "connect.php";

$user_id = $_POST['user_id'];

if ( !empty( $_POST['dept_id'] ) ) {
	$dept_id = $_POST['dept_id'];
	if (!empty($_POST['new_dept_name'])) { //修改部门
		$new_dept_name = $_POST['new_dept_name'];
		$sql ="UPDATE `dept` SET dept_name='$new_dept_name' WHERE dept_id=$dept_id AND dept_user_id=$user_id";
		$result= mysqli_query($con,$sql);
		echo $sql;
		echo json_encode($result);
	} else {  //删除当前部门
		$sql ="DELETE FROM `dept` WHERE dept_id=$dept_id AND dept_user_id=$user_id";
		$result = mysqli_query($con, $sql);
		echo json_encode($result);
	}
} else { //更新或增加部门
	if (!empty($_POST['new_dept_name'])) { //增加部门
		$new_dept_name = $_POST['new_dept_name'];
		$sql           = "INSERT INTO `dept` VALUES(NULL,'$new_dept_name','','',$user_id)";
		$result        = mysqli_query( $con, $sql );
		echo json_encode( $result);
	} else {
		$sql    = "SELECT * FROM `dept` WHERE dept_user_id=$user_id ORDER BY dept_id";
		$result = mysqli_query( $con, $sql );
		$res = [];
		while ( ( $row = mysqli_fetch_assoc( $result ) ) !== null ) {
			$res[] = $row;
		}
		echo json_encode($res);
	}

}