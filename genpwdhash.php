<?php
/**
 * Created by PhpStorm.
 * User: kevinlau
 * Date: 10/5/16
 * Time: 1:34 AM
 */
$options =['cost'=>12];
$hash = password_hash('111111', PASSWORD_BCRYPT, $options);
echo $hash;