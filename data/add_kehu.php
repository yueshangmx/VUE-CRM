<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/21
 * Time: 16:34
 */

$method = $_SERVER['REQUEST_METHOD'];
require "connect.php";

switch ($method) {
	case "GET":
		$sql = "SELECT `kehu_number` FROM `kehu` ORDER BY `kehu_number` DESC LIMIT 1";
		require_once "mysqli_query.php";
		break;
	case "POST":
		$user_id = $_POST['user_id'];
		$kehu_number = $_POST['kehu_number'];
		$kehu_name = !empty($_POST['kehu_name']) ? $_POST['kehu_name'] : "";
		$kehu_phone = !empty($_POST['kehu_phone']) ? $_POST['kehu_phone'] : "";
		$kehu_sex = !empty($_POST['kehu_sex']) ? $_POST['kehu_sex'] : 0;
		$kehu_birthday = !empty($_POST['kehu_birthday']) ? $_POST['kehu_birthday'] : "";
		$kehu_address = !empty($_POST['kehu_birthday']) ? $_POST['kehu_address'] : "";
		$kehu_guhua = !empty($_POST['kehu_guhua']) ? $_POST['kehu_guhua'] : "";
		$kehu_qq = !empty($_POST['kehu_qq']) ? $_POST['kehu_qq'] : 0;
		$kehu_weixin = !empty($_POST['kehu_weixin']) ? $_POST['kehu_weixin'] : "";
		$kehu_email = !empty($_POST['kehu_email']) ? $_POST['kehu_email'] : "";
		$kehu_beizhu = !empty($_POST['kehu_beizhu']) ? $_POST['kehu_beizhu'] : "";
		$kehu_vip_id = !empty($_POST['kehu_vip']) ? "1": "0";

		if(!($kehu_name && $kehu_phone)) {
			echo '{"result": false,"msg": "添加失败！姓名或电话为空" }';
		} else {
			$sql = "INSERT INTO `kehu` VALUES(NULL,'$user_id','$kehu_number','$kehu_name','$kehu_phone',$kehu_sex,'$kehu_birthday','$kehu_address','$kehu_beizhu','$kehu_guhua','$kehu_qq','$kehu_weixin','$kehu_email','$kehu_vip_id')";

			$result = mysqli_query( $con, $sql );

			$res = array(
				"result" => $result
			);
		}
		break;
}
echo json_encode($res);




