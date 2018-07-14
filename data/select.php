<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/14
 * Time: 15:15
 */
$result = mysqli_query( $con, $sql );

$check_query = mysqli_fetch_array( $result );

sleep(1);