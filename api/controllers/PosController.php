<?php

namespace api\controllers;

use api\models\Pos;
use yii\helpers\Json;
use Yii;

class PosController extends BaseController
{
	public function actionIndex()
	{
		$callback = Yii::$app->request->get('callback', null);
		$jsonlist = [];
		$sql = "select Id, Entry, EntryZht, EntryZhs, EntryJap from pos order by Id";
		$poslist = Pos::findBySql($sql)->all();
		foreach ($poslist as $pos) {
			/*array_push($jsonlist, array('Id' => $pos->Id, 'pos' => $pos->Entry, 'posZht' => $pos->EntryZht, 'posZhs'=>$pos->EntryZhs,
				'posJap'=>$pos->EntryJap));*/
			array_push($jsonlist, array('Id' => $pos->Id, 'Entry' => $pos->Entry, 'EntryZht' => $pos->EntryZht, 'EntryZhs'=>$pos->EntryZhs,
				'EntryJap'=>$pos->EntryJap));
		}
		$this->setHeader(200);
		echo $callback != null ? "$callback(" . Json::htmlEncode($jsonlist) . ")" : Json::htmlEncode($jsonlist);
	}

	public function actionList_bak1()
	{
		$callback = Yii::$app->request->get('callback', null);
		$jsonlist = [];
		$sql = "select Id, Entry, EntryZht, EntryZhs, EntryJap from pos order by Id";
		$poslist = Pos::findBySql($sql)->all();
		foreach ($poslist as $pos) {
			/*array_push($jsonlist, array('Id' => $pos->Id, 'pos' => $pos->Entry, 'posZht' => $pos->EntryZht, 'posZhs'=>$pos->EntryZhs,
				'posJap'=>$pos->EntryJap));*/
			array_push($jsonlist, array('Id' => $pos->Id, 'Entry' => $pos->Entry, 'EntryZht' => $pos->EntryZht, 'EntryZhs'=>$pos->EntryZhs,
				'EntryJap'=>$pos->EntryJap));
		}
		$this->setHeader(200);
		echo $callback != null ? "$callback(" . Json::htmlEncode($jsonlist) . ")" : Json::htmlEncode($jsonlist);
	}

	public function actionList_bak()
	{
		$lang = Yii::$app->request->get('lang');
		$callback = Yii::$app->request->get('callback');
		$sql = null;
		$jsonlist = [];
		switch (strtolower($lang)) {
			case 'tw':
				$sql = "select Id, Entry, EntryZht from pos order by Id";
				$poslist = Pos::findBySql($sql)->all();
				foreach ($poslist as $pos) {
					array_push($jsonlist, array('Id' => $pos->Id, 'Entry' => $pos->Entry, 'EntryZht' => $pos->EntryZht));
				}
				break;
			case 'cn':
				$sql = "select Id, Entry, EntryZhs from pos order by Id";
				$poslist = Pos::findBySql($sql)->all();
				foreach ($poslist as $pos) {
					array_push($jsonlist, array('Id' => $pos->Id, 'Entry' => $pos->Entry, 'EntryZhs' => $pos->EntryZhs));
				}
				break;
			case 'ja':
				$sql = "select Id, Entry, EntryJap from pos order by Id";
				$poslist = Pos::findBySql($sql)->all();
				foreach ($poslist as $pos) {
					array_push($jsonlist, array('Id' => $pos->Id, 'Entry' => $pos->Entry, 'EntryJap' => $pos->EntryJap));
				}
				break;
		}
		$this->setHeader(200);
		echo $callback != null ? "$callback(" . json_encode($jsonlist, JSON_PRETTY_PRINT) . ")" : json_encode($jsonlist,
			JSON_PRETTY_PRINT);
	}



}