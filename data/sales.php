<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/8/4
 * Time: 13:48
 */
require "connect.php";

$parent_id = $_GET['parent_id'];

$sql = "SELECT s.`id`,g.`goods_name`,s.`sales_number`,s.`sales_time`,s.`sales_price`,g.`goods_price`,k.`kehu_name`,k.`kehu_vip_id`,g.`goods_litpic` FROM `sales` AS s LEFT JOIN `kehu` AS k ON k.`id`=s.`sales_kehu_id` LEFT JOIN `goods` AS g ON g.`goods_id`=s.`sales_goods_id`
WHERE s.`sales_parent_id`=$parent_id ORDER BY s.`id`";

$result = mysqli_query($con,$sql);
$res = [];
while (($row = mysqli_fetch_assoc($result))!=null) {
	$res[] = $row;
}

echo json_encode($res);