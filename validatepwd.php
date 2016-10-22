<?php
/**
 * Created by PhpStorm.
 * User: kevinlau
 * Date: 10/5/16
 * Time: 2:19 AM
 */
/*$options =['cost'=>12];
$hash = password_hash('111111', PASSWORD_BCRYPT, $options);*/
$hash = '$2y$12$BQcLP0j9PbFK5v.OqkOIiOBgN1GhwxADrOYlB/ObWHEeCixoCYT62';
if(password_verify('111111',$hash)){
	echo 'password ok!';
}else{
	echo 'password NG!';
}