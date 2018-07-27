<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/6/22
 * Time: 11:38
 */

header( 'Content-type: application/json; charset=utf-8' );
header( 'Access-Control-Allow-Credentials:true' );
header( "Access-Control-Allow-Origin:*" );
header( 'Access-Control-Allow-Headers:x-requested-with,content-type' );

$PHP_SELF=$_SERVER['PHP_SELF'];

$dir='http://'.$_SERVER['HTTP_HOST'].substr($PHP_SELF,0,strrpos($PHP_SELF,'/')+1);

$con = mysqli_connect( '127.0.0.1', 'vipcool', 'yhy214', 'db_crm', '3306' ) or die( '数据库连接异常!<br>' );

$con->query( "SET NAMES utf8" );

