<?php

namespace api\models;
use Yii;
use yii\db\ActiveRecord;

class WcBase extends ActiveRecord
{
	//public $Visible;

	public static function getVisible(){
		return Yii::$app->user->identity->username == 'a1771550';
		//return $this->Visible;
	}
}