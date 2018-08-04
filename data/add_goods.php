<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/30
 * Time: 14:55
 */
require "connect.php";
$goods_id = $_POST['id'];
$goods_name = $_POST['name'];
$goods_fenlei_id = $_POST['fenlei'];
$goods_jinjia = $_POST['jinjia'];
$goods_price = $_POST['price'];
$goods_beizhu = $_POST['beizhu'];
$goods_litpic = json_encode($_POST['imgarr']);
$goods_inventory = $_POST['inventory'];

$sql = "UPDATE `goods` AS g SET g.`goods_name`='$goods_name',g.`goods_fenlei_id`=$goods_fenlei_id,g.`goods_jinjia`=$goods_jinjia,g.`goods_price`=$goods_price,g.`goods_inventory`=$goods_inventory,g.`goods_beizhu`='$goods_beizhu',g.`goods_litpic`='$goods_litpic' WHERE g.`goods_id`=$goods_id";

require_once "getRes.php";

echo json_encode($res);

$sql2 = "DELETE FROM `goods` WHERE goods_name=''";

mysqli_query($con,$sql2);