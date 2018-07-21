<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/21
 * Time: 16:34
 */
require_once "connect.php";

$sql = "SELECT `kehu_number` FROM `kehu` ORDER BY `kehu_number` DESC LIMIT 1";

require_once "mysqli_query.php";

if($res){
	echo json_encode($res);
}else{
	echo '{"result":false}';
}