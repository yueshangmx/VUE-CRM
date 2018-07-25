<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/25
 * Time: 13:41
 */
require "connect.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case "GET":
		$user_id = $_GET['user_id'];
		$sql = "SELECT dept_id,dept_name FROM `dept` WHERE dept_user_id=$user_id";
		$result = mysqli_query( $con, $sql );
		$res = [];
		while (($row = mysqli_fetch_assoc($result))!==NULL){
			$res[] = $row;
		};
		echo json_encode($res);
		break;
	case "POST":
		$parent_id = $_POST['parent_id'];
		$user_currenname = $_POST['currenname'];
		$user_name = $_POST['username'];
		$user_pwd = md5($_POST['password']);
		$user_dept_id = $_POST['dept'];
		$user_group_id = $_POST['group'];
		$user_sex = $_POST['sex'];
		$user_token = md5("$user_name-$user_pwd");

		$sql = "SELECT user_store_name FROM `users` WHERE user_id=$parent_id LIMIT 1";
		$result = mysqli_query($con, $sql);
		if ($result){
			$user_store_name = mysqli_fetch_assoc($result)['user_store_name'];

			$sql = "INSERT INTO `users` VALUES(NULL,'$user_name','$user_pwd',$user_sex,'$user_store_name',$user_dept_id,$user_group_id,'$user_token','$user_currenname',$parent_id);";

			$result = mysqli_query($con, $sql);

			if($result){
				echo '{"result": true}';
			} else{
				echo '{"result": false}';
			}
		} else {
			echo '{"result": false}';
		}
}


