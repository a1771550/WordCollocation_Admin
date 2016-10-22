<?php

namespace app\controllers;
use yii\web\Controller;
use Yii;
//use yii\web\Cookie;

class BaseController extends Controller
{
	public $enableCsrfValidation = true;

	public function beforeAction($action){
		$cookies = Yii::$app->request->cookies;
		$language = null;
		if($cookies->has('language')){
			$language = $cookies->getValue('language', 'zh-TW');
		}else{
			$language = 'zh-TW';
		}
		Yii::$app->language = $language;
		return parent::beforeAction($action);
	}
}