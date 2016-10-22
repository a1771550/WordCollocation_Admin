<?php

namespace app\controllers;


use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class BookController extends BaseController
{
	// adjust the model class to match your model
	public $modelClass = 'app\models\Book';

	public function behaviors()
	{
		return
			ArrayHelper::merge(parent::behaviors(), [
				'corsFilter' => [
					'class' => Cors::className(),
				],
			]);
	}
}