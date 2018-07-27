<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/27
 * Time: 9:34
 */
require "connect.php";

$user_name = $_POST['user_name'];

$sql = "SELECT user_id FROM `users` WHERE user_name='$user_name'";

require_once "mysqli_query.php";

echo json_encode($res);