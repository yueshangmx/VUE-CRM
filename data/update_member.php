<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/8/1
 * Time: 14:20
 */
require "connect.php";

$user_id = $_POST['user_id'];
$user_sex = $_POST['user_sex'];
$user_dept_id = $_POST['user_dept_id'];
$user_group_id = $_POST['user_group_id'];
$user_currenname = $_POST['user_currenname'];

$sql = "UPDATE `users` AS u SET u.`user_currenname`='$user_currenname',u.`user_sex`=$user_sex,u.`user_dept_id`=$user_dept_id,u.`user_group_id`=$user_group_id WHERE u.`user_id`=$user_id";

require_once "getRes.php";

echo json_encode($res);