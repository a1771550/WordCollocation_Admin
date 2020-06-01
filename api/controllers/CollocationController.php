<?php

namespace api\controllers;

use api\models\Collocation;
use api\models\Word;
use Yii;
use yii\helpers\Json;

class CollocationController extends BaseController
{
	public function actionIndex(){
		$callback = Yii::$app->request->get('callback',null);		
		$jsonlist = [];
		$sql="Select p.Entry as pos, p.EntryZht as posZht, p.EntryZhs as posZhs, p.EntryJap as posJap, w.Entry as word, w
.EntryZht as wordZht, w.EntryZhs as wordZhs, w.EntryJap as wordJap, cp.Entry as colpos, cp.EntryZht as colposZht, cp.EntryZhs as colposZhs, cp.EntryJap as colposJap, cw.Entry as colword, cw.EntryZht as colwordZht, cw.EntryZhs as colwordZhs, cw.EntryJap as colwordJap, c.CollocationPattern, e.Entry as ex, e.EntryZht as exZht, e.EntryZhs as exZhs, e.EntryJap as exJap, e.Source, e.Remark from collocation c inner join word w on c.wordId=w.Id inner join word cw on c.colWordId = cw.Id inner join pos p on w.posId=p.Id inner join pos cp on cw.posId = cp.Id inner join example e on c.Id = e.CollocationId";
		$conn = Yii::$app->getDb();
		$command = $conn->createCommand($sql);
		$collocations = $command->queryAll();
		if (empty($collocations)){
			$this->setHeader(200);
			echo '';
		} 
		else {
			foreach ($collocations as $collocation) {
				array_push($jsonlist, array('pos' => $collocation['pos'], 'posZht' => $collocation['posZht'], 'posZhs' => $collocation['posZhs'], 'posJap' => $collocation['posJap'], 'colpos' => $collocation['colpos'], 'colposZht' => $collocation['colposZht'], 'colposZhs' => $collocation['colposZhs'], 'colposJap' => $collocation['colposJap'], 'word' => $collocation['word'], 'wordZht' => $collocation['wordZht'], 'wordZhs' => $collocation['wordZhs'], 'wordJap' => $collocation['wordJap'], 'colword' => $collocation['colword'], 'colwordZht' => $collocation['colwordZht'], 'colwordZhs' => $collocation['colwordZhs'],
					'colwordJap' => $collocation['colwordJap'], 'colpattern' => $collocation['CollocationPattern'], 'ex' => $collocation['ex'], 'exZht' => $collocation['exZht'], 'exZhs' => $collocation['exZhs'], 'exJap' => $collocation['exJap'], 'source' =>
						$collocation['Source'],
					'remark' =>
						$collocation['Remark']));
			}
			$this->setHeader(200);
			echo $callback!=null? "$callback(" . Json::htmlEncode($jsonlist) . ")":Json::htmlEncode($jsonlist);
		}		
	}

	public function actionSearch()
	{
		$callback = Yii::$app->request->get('callback',null);
		$word = Yii::$app->request->get('word');
		$colposId = Yii::$app->request->get('id');
		$wordIds = Word::find()->where(['Entry' => $word])->asArray();
		$colwords = Word::find()->where(['posId' => $colposId])->asArray();		
		$jsonlist = [];
		$sql = "Select p.Entry as pos, p.EntryZht as posZht, p.EntryZhs as posZhs, p.EntryJap as posJap, w.Entry as word, w
.EntryZht as wordZht, w.EntryZhs as wordZhs, w.EntryJap as wordJap, cp.Entry as colpos, cp.EntryZht as colposZht, cp.EntryZhs as colposZhs, cp.EntryJap as colposJap, cw.Entry as colword, cw.EntryZht as colwordZht, cw.EntryZhs as colwordZhs, cw.EntryJap as colwordJap, c.CollocationPattern, e.Entry as ex, e.EntryZht as exZht, e.EntryZhs as exZhs, e.EntryJap as exJap, e.Source, e.Remark from collocation c inner join word w on c.wordId=w.Id inner join word cw on c.colWordId = cw.Id inner join pos p on w.posId=p.Id inner join pos cp on cw.posId = cp.Id inner join example e on c.Id = e.CollocationId where c.wordId in (select Id from word where Entry = :word) and c.colWordId in (select w.Id from word w inner join pos p on w.posId=p.Id where p.Id=:colposId)";
		$conn = Yii::$app->getDb();
		$command = $conn->createCommand($sql, [':word' => $word, ':colposId' => $colposId]);
		$collocations = $command->queryAll();
		if (empty($collocations)){
			$this->setHeader(200);
			echo '';
		}
		else {
			foreach ($collocations as $collocation) {
				array_push($jsonlist, array('pos' => $collocation['pos'], 'posZht' => $collocation['posZht'], 'posZhs' => $collocation['posZhs'], 'posJap' => $collocation['posJap'], 'colpos' => $collocation['colpos'], 'colposZht' => $collocation['colposZht'], 'colposZhs' => $collocation['colposZhs'], 'colposJap' => $collocation['colposJap'], 'word' => $collocation['word'], 'wordZht' => $collocation['wordZht'], 'wordZhs' => $collocation['wordZhs'], 'wordJap' => $collocation['wordJap'], 'colword' => $collocation['colword'], 'colwordZht' => $collocation['colwordZht'], 'colwordZhs' => $collocation['colwordZhs'],
					'colwordJap' => $collocation['colwordJap'], 'colpattern' => $collocation['CollocationPattern'], 'ex' => $collocation['ex'], 'exZht' => $collocation['exZht'], 'exZhs' => $collocation['exZhs'], 'exJap' => $collocation['exJap'], 'source' =>
						$collocation['Source'],
					'remark' =>
						$collocation['Remark']));
			}
			$this->setHeader(200);
			echo $callback!=null? "$callback(" . Json::htmlEncode($jsonlist) . ")":Json::htmlEncode($jsonlist);
		}
		
	}

	public function actionSearch_bak()
	{
		$lang = Yii::$app->request->get('lang');
		$word = Yii::$app->request->get('word');
		$colposId = Yii::$app->request->get('id');
		$wordIds = Word::find()->where(['Entry' => $word])->asArray();
		$colwords = Word::find()->where(['posId' => $colposId])->asArray();
		$sql = null;
		$collocations = null;
		$jsonlist = [];

		switch (strtolower($lang)) {
			case 'tw':
				$sql = "Select p.Entry as pos, p.EntryZht as posZht, w.Entry as word, w.EntryZht as wordZht, cp.Entry as colpos, cp.EntryZht as colposZht, cw.Entry as colword, cw.EntryZht as colwordZht, c.CollocationPattern, e.Entry as exEntry, e.EntryZht as exEntryZht, e.Source, e.Remark from collocation c inner join word w on c.wordId=w.Id inner join word cw on c.colWordId = cw.Id
inner join pos p on w.posId=p.Id inner join pos cp on cw.posId = cp.Id inner join example e on c.Id = e.CollocationId
where c.wordId in (select Id from word where Entry = :word) and c.colWordId in (select w.Id from word w inner join pos p on w.posId=p.Id where p.Id=:colposId)";
				$conn = Yii::$app->getDb();
				$command = $conn->createCommand($sql, [':word' => $word, ':colposId' => $colposId]);
				$collocations = $command->queryAll();
				if (empty($collocations)) $jsonlist = null;
				else {
					foreach ($collocations as $collocation) {
						array_push($jsonlist, array('pos' => $collocation['pos'], 'posTran' => $collocation['posZht'], 'colpos' => $collocation['colpos'], 'colposTran' => $collocation['colposZht'], 'word' => $collocation['word'], 'wordTran' => $collocation['wordZht'], 'colword' => $collocation['colword'], 'colwordTran' => $collocation['colwordZht'], 'colpattern' => $collocation['CollocationPattern'], 'entry' => $collocation['exEntry'], 'entryTran' => $collocation['exEntryZht'], 'source' => $collocation['Source'], 'remark' => $collocation['Remark']));
					}
				}

				break;
			case 'cn':
				$sql = "Select p.Entry as pos, p.EntryZhs as posZhs, w.Entry as word, w.EntryZhs as wordZhs, cp.Entry as colpos, cp.EntryZhs as colposZhs, cw.Entry as colword, cw.EntryZhs as colwordZhs, c.CollocationPattern, e.Entry as exEntry, e.EntryZhs as exEntryZhs, e.Source, e.Remark from collocation c inner join word w on c.wordId=w.Id inner join word cw on c.colWordId = cw.Id
inner join pos p on w.posId=p.Id inner join pos cp on cw.posId = cp.Id inner join example e on c.Id = e.CollocationId
where c.wordId in (select Id from word where Entry = :word) and c.colWordId in (select w.Id from word w inner join pos p on w.posId=p.Id where p.Id=:colposId)";
				$conn = Yii::$app->getDb();
				$command = $conn->createCommand($sql, [':word' => $word, ':colposId' => $colposId]);
				$collocations = $command->queryAll();
				if (empty($collocations)) $jsonlist = null;
				else {
					foreach ($collocations as $collocation) {
						array_push($jsonlist, array('pos' => $collocation['pos'], 'posTran' => $collocation['posZhs'], 'colpos' => $collocation['colpos'], 'colposTran' => $collocation['colposZhs'], 'word' => $collocation['word'], 'wordTran' => $collocation['wordZhs'], 'colword' => $collocation['colword'], 'colwordTran' => $collocation['colwordZhs'], 'colpattern' => $collocation['CollocationPattern'], 'entry' => $collocation['exEntry'], 'entryTran' => $collocation['exEntryZhs'], 'source' => $collocation['Source'], 'remark' => $collocation['Remark']));
					}
				}
				break;
			case 'ja':
				$sql = "Select p.Entry as pos, p.EntryJap as posJap, w.Entry as word, w.EntryJap as wordJap, cp.Entry as colpos, cp.EntryJap as colposJap, cw.Entry as colword, cw.EntryJap as colwordJap, c.CollocationPattern, e.Entry as exEntry, e.EntryJap as exEntryJap, e.Source, e.Remark from collocation c inner join word w on c.wordId=w.Id inner join word cw on c.colWordId = cw.Id
inner join pos p on w.posId=p.Id inner join pos cp on cw.posId = cp.Id inner join example e on c.Id = e.CollocationId
where c.wordId in (select Id from word where Entry = :word) and c.colWordId in (select w.Id from word w inner join pos p on w.posId=p.Id where p.Id=:colposId)";
				$conn = Yii::$app->getDb();
				$command = $conn->createCommand($sql, [':word' => $word, ':colposId' => $colposId]);
				$collocations = $command->queryAll();
				if (empty($collocations)) $jsonlist = null;
				else {
					foreach ($collocations as $collocation) {
						array_push($jsonlist, array('pos' => $collocation['pos'], 'posTran' => $collocation['posJap'], 'colpos' => $collocation['colpos'], 'colposTran' => $collocation['colposJap'], 'word' => $collocation['word'], 'wordTran' => $collocation['wordJap'], 'colword' => $collocation['colword'], 'colwordTran' => $collocation['colwordJap'], 'colpattern' => $collocation['CollocationPattern'], 'entry' => $collocation['exEntry'], 'entryTran' => $collocation['exEntryJap'], 'source' => $collocation['Source'], 'remark' => $collocation['Remark']));
					}
				}
				break;
		}
		$this->setHeader(200);
		echo 'SearchResult(' . json_encode($jsonlist, JSON_PRETTY_PRINT) . ')';
	}
}
