<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/31
 * Time: 14:52
 */
$result = mysqli_query($con,$sql);
if($result) {
	$res = array(
		"result" => true
	);
} else {
	$res = array(
		"result" => false
	);
}