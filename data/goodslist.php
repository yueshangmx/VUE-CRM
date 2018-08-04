<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/8/1
 * Time: 16:01
 */
require "connect.php";

$perent_id = $_GET['parent_id'];

$sql = "SELECT g.*,f.`fenlei_name` FROM `goods` AS g LEFT JOIN `goods_fenlei` AS f ON f.`fenlei_id`=g.`goods_fenlei_id` WHERE g.`goods_parent_id`=$perent_id AND g.`goods_name`!='' ORDER BY g.`goods_id`";

$result = mysqli_query( $con, $sql );

if($result->num_rows>0) {
	$res = [];
	while ( ( $row = mysqli_fetch_assoc( $result ) ) != null ) {
		$res[] = $row;
	}
} else {
	$res = array(
		"result" => false
	);
}
echo json_encode($res);
$sql2 = "DELETE FROM `goods` WHERE goods_name=''";
mysqli_query($con,$sql2);
