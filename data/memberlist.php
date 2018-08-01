<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/26
 * Time: 9:05
 */

require "connect.php";

if ( ! empty( $_POST['parent_id'] ) ) {
	$parent_id = $_POST['parent_id'];
	$sql       = "SELECT u.`user_id`,u.`user_currenname`,u.`user_dept_id`,u.`user_group_id`,d.`dept_name` FROM `users` AS u LEFT JOIN `dept` AS d ON d.`dept_id`=u.`user_dept_id` WHERE u.`user_parent_id`=$parent_id";
	$result    = mysqli_query( $con, $sql );
	$res       = [];
	while ( ( $row = mysqli_fetch_assoc( $result ) ) !== null ) {
		$res[] = $row;
	}
	echo json_encode( $res );
} else {
	echo 'false';
}

