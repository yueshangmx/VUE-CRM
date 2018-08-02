<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/31
 * Time: 14:52
 */
$result = mysqli_query( $con, $sql );

$res = array(
	"result" => $result
);