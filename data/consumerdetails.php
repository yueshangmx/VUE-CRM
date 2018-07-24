<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/24
 * Time: 15:15
 */
require "connect.php";

$id = $_POST['id'];

$sql = "SELECT * FROM `kehu` WHERE id=$id";

require_once "mysqli_query.php";


echo json_encode($res);
