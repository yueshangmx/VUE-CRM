<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/14
 * Time: 15:15
 */
$result = mysqli_query( $con, $sql );

$res= mysqli_fetch_assoc( $result );

sleep(1);