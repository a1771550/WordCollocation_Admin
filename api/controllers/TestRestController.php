<?php

namespace api\controllers;
use yii\rest\Controller;

class TestRestController extends Controller
{
	private function dataList(){
		return [
			[ 'id' => 1, 'name' => 'Albert', 'surname' => 'Einstein' ],
			[ 'id' => 2, 'name' => 'Enzo', 'surname' => 'Ferrari' ],
			[ 'id' => 4, 'name' => 'Mario', 'surname' => 'Bros' ]
		];
	}

	public function actionIndex(){
		return $this->dataList();
	}
}