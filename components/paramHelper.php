<?php
/**
 * Created by PhpStorm.
 * User: kevinlau
 * Date: 10/6/16
 * Time: 3:37 AM
 */

namespace app\components;

use Yii;

class paramHelper
{
	public static function getParam($name, $default = null)
	{
		if(isset(Yii::$app->params[$name]))
			return Yii::$app->params[$name];
		else
			return $default;
	}
}