<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/23
 * Time: 16:56
 */
require_once "connect.php";

$start = !empty($_REQUEST['start']) ? $_REQUEST['start'] : 0;

$count = 10;

$sql = "SELECT * FROM `kehu` LIMIT 0,10";

$result = mysqli_query($con,$sql);

$res = [];
while (($row = mysqli_fetch_assoc($result))!==NULL){
	$res[] = $row;
};

echo json_encode($res);


