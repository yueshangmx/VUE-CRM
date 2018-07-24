<?php
/**
 * Created by PhpStorm.
 * User: valor
 * Date: 2018/7/14
 * Time: 15:15
 */
$result = mysqli_query( $con, $sql );

if($result){
	$res= mysqli_fetch_assoc( $result );
} else {
	$res = array(
		"result" => false
	);
}
