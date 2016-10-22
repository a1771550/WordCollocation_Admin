<?php

namespace app\controllers;

use app\components\paramHelper;
use app\models\CollocationPattern;
use app\models\Example;
use app\models\ExampleSource;
use app\models\Pos;
use app\models\Word;
use Yii;
use app\models\Collocation;
use app\models\CollocationSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CollocationController implements the CRUD actions for Collocation model.
 */
class CollocationController extends BaseController
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
				'denyCallback' => function ($rule, $data)
				{
					$this->goHome();
				}
			],
		];
	}

	public function actionSearch(){
		$word='abandon';
		$colposId = 4;
		$sql = "Select p.Entry as posEntry, p.EntryZht as posEntryZht, w.Entry as wordEntry, w.EntryZht as wordEntryZht, cp.Entry as colposEntry, cp.EntryZht as colposEntryZht, cw.Entry as colwordEntry, cw.EntryZht as colwordEntryZht, c.CollocationPattern, e.Entry as exEntry, e.EntryZht as exEntryZht from collocation c inner join word w on c.wordId=w.Id inner join word cw on c.colWordId = cw.Id
inner join pos p on w.posId=p.Id inner join pos cp on cw.posId = cp.Id inner join example e on c.Id = e.CollocationId
where c.wordId in (select Id from word where Entry = :word) and c.colWordId in (select w.Id from word w inner join pos p on w.posId=p.Id where p.Id=:colposId)";
		$conn = Yii::$app->getDb();
		$command = $conn->createCommand($sql, [':word'=>$word, ':colposId'=>$colposId]);
		$collocations = $command->queryAll();
		print_r($collocations);
		echo "<br>";
		foreach($collocations as $collocation){
			echo $collocation['posEntry']." ". $collocation['wordEntry']. " " . $collocation['colposEntry']. " " . $collocation['colwordEntry']. " " . $collocation['exEntry']."<br>";
		}
		return;
	}

	/**
	 * Lists all Collocation models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new CollocationSearch();
		$searchModel->scenario = Collocation::SCENARIO_SEARCH;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = paramHelper::getParam('gridview_pagesize');

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Collocation model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Collocation model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Collocation();
		//$model_ex = new Example();
		$model->scenario = Collocation::SCENARIO_CREATE;
		if ($model->load(Yii::$app->request->post()))
		{
			switch ($model->word->posId)
			{
				case 1: // noun
				case 6: //pronoun
					switch ($model->colWord->posId)
					{
						case 2: // verb
							$model->CollocationPattern = CollocationPattern::VERB_NOUN;
							break;
						case 3: // adjective
							$model->CollocationPattern = CollocationPattern::ADJECTIVE_NOUN;
							break;
						case 5: // preposition
							$model->CollocationPattern = CollocationPattern::PREPOSITION_NOUN;
							break;
					}
					break;
				case 2: // verb
					$model->CollocationPattern = CollocationPattern::ADVERB_VERB;
					break;
				case 9: // phrase
					$model->CollocationPattern = CollocationPattern::PREPOSITION_NOUN;
					break;
			}

			$model->save();
			$word = $model->word;
			$word->CanDel = 0;
			$word->save();
			$colword = $model->colWord;
			$colword->CanDel=0;
			$colword->save();


			if (isset($_POST['Collocation']['examples']))
			{
				$examples = $_POST['Collocation']['examples'];
				if(count($examples)===0)return $this->redirect(['index']);
				$exampleList = [];

				foreach($examples as $example){
					$ex = new Example();
					$ex->CollocationId=$model->Id;
					$ex->Entry = $example['Entry'];
					$ex->EntryZht = $example['EntryZht'];
					$ex->EntryZhs = $example['EntryZhs'];
					$ex->EntryJap = $example['EntryJap'];
					$ex->Source = $example['Source'];
					$ex->Remark = $example['Remark'];
					array_push($exampleList, $ex);
				}

				$rows=[];
				$columns = [
					'CollocationId', 'Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'Source', 'Remark'
				];
				foreach($exampleList as $ex){
					$rows[]=[
						'CollocationId'=>$ex->CollocationId,
						'Entry'=>$ex->Entry,
						'EntryZht'=>$ex->EntryZht,
						'EntryZhs'=>$ex->EntryZhs,
						'EntryJap'=>$ex->EntryJap,
						'Source'=>$ex->Source,
						'Remark'=>$ex->Remark,
					];
				}
				//return print_r($rows);
				Yii::$app->db->createCommand()->batchInsert(Example::tableName(), $columns, $rows)->execute();

			}else{
				//echo "empty array";
			}

			return $this->redirect(['view', 'id'=>$model->Id]);
		}
		else
		{
			return $this->render('create', [
				'model' => $model
			]);
		}
	}

	/**
	 * Updates an existing Collocation model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$model->scenario = Collocation::SCENARIO_UPDATE;
		if ($model->load(Yii::$app->request->post()))
		{
			switch ($model->word->posId)
			{
				case 1: // noun
				case 6: //pronoun
					switch ($model->colWord->posId)
					{
						case 2: // verb
							$model->CollocationPattern = CollocationPattern::VERB_NOUN;
							break;
						case 3: // adjective
							$model->CollocationPattern = CollocationPattern::ADJECTIVE_NOUN;
							break;
						case 5: // preposition
							$model->CollocationPattern = CollocationPattern::PREPOSITION_NOUN;
							break;
					}
					break;
				case 2: // verb
					$model->CollocationPattern = CollocationPattern::ADVERB_VERB;
					break;
				case 9: // phrase
					switch($model->colWord->posId){
						case 1:
						case 6:
						$model->CollocationPattern = CollocationPattern::PHRASE_NOUN;
							break;
						case 3:
							$model->CollocationPattern = CollocationPattern::ADJECTIVE_PHRASE;
							break;
					}

					break;
			}

			$examples = $_POST['Collocation']['examples'];
			//return var_dump($examples);
			/*
			 * array(2) { [0]=> array(6) { ["Entry"]=> string(28) "I lost my abandon yesterday." ["EntryZht"]=> string(24) "我昨天失去放縱．" ["EntryZhs"]=> string(24) "我昨天失去放纵．" ["EntryJap"]=> string(0) "" ["Source"]=> string(1) "1" ["Remark"]=> string(0) "" } [1]=> array(6) { ["Entry"]=> string(36) "She lost her abandon three days ago." ["EntryZht"]=> string(27) "她三天前失去放縱．" ["EntryZhs"]=> string(27) "她三天前失去放纵．" ["EntryJap"]=> string(0) "" ["Source"]=> string(1) "4" ["Remark"]=> string(0) "" } }
			 */
			if(count($examples)===0)return $this->redirect(['index']);
			$exampleList = [];

			foreach($examples as $example){
				$ex = new Example();
				$ex->CollocationId=$model->Id;
				$ex->Entry = $example['Entry'];
				$ex->EntryZht = $example['EntryZht'];
				$ex->EntryZhs = $example['EntryZhs'];
				$ex->EntryJap = $example['EntryJap'];
				$ex->Source = $example['Source'];
				$ex->Remark = $example['Remark'];
				array_push($exampleList, $ex);
			}

			$rows=[];
			$columns = [
				'CollocationId', 'Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'Source', 'Remark'
			];
			foreach($exampleList as $ex){
				$rows[]=[
					'CollocationId'=>$ex->CollocationId,
					'Entry'=>$ex->Entry,
					'EntryZht'=>$ex->EntryZht,
					'EntryZhs'=>$ex->EntryZhs,
					'EntryJap'=>$ex->EntryJap,
					'Source'=>$ex->Source,
					'Remark'=>$ex->Remark,
				];
			}
			//return print_r($rows);
			$collocationId=$model->Id;
			Yii::$app->db->createCommand()->delete('example', "CollocationId=$collocationId")->execute();
			Yii::$app->db->createCommand()->batchInsert(Example::tableName(), $columns, $rows)->execute();

			$model->save();
			return $this->redirect(['index']);
		}
		else
		{
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Collocation model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Collocation model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Collocation the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Collocation::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionGetWordsByPos()
	{
		if (isset($_POST['depdrop_parents']))
		{
			$parents = $_POST['depdrop_parents'];
			if ($parents != null)
			{
				$posId = $parents[0];
				$out = Word::getWordsByPos($posId);
				//echo Json::encode(['output' => $out, 'selected' => $out[0]['id']]);
				echo Json::encode(['output' => $out, 'selected' => '']);
				return;
			}
		}
		echo Json::encode(['output' => '', 'selected' => '']);
	}

	public function actionGetColpossByPos()
	{
		if (isset($_POST['depdrop_parents']))
		{
			$parents = $_POST['depdrop_parents'];
			if ($parents != null)
			{
				$posId = $parents[0];
				$out = Pos::getColpossByPos($posId);

				echo Json::encode(['output' => $out, 'selected' => '']);
				return;
			}
		}
		echo Json::encode(['output' => '', 'selected' => '']);
	}

	public function actionGetColwordsByWordColpos()
	{
		if (isset($_POST['depdrop_parents']))
		{
			$ids = $_POST['depdrop_parents'];
			if ($ids != null)
			{
				$wordId = $ids[0];
				$colPosId = $ids[1];
				$out = Word::getColwordsByWordColPos($wordId, $colPosId);
				//echo Json::encode(['output' => $out, 'selected' => $out[0]['id']]);
				echo Json::encode(['output' => $out, 'selected' => '']);
				return;
			}
		}
		echo Json::encode(['output' => '', 'selected' => '']);
	}

	/* for demo only */
	public function actionGetColwordsByWordColposDemo(){
		$out = Word::getColwordsByWordColPos(1,2);
		echo Json::encode(['output'=>$out, 'selected'=>'']);
	}

	/* for demo only */
	/*public function actionGetColwordsByPosDemo()
	{
		$out = Word::getColwordsByPos(1);
		echo Json::encode(['output' => $out, 'selected' => $out[0]['id']]);
	}*/

	/* for demo only */
	public function actionGetWordsByPosDemo()
	{
		$out = Word::getWordsByPos(1);
		echo Json::encode(['output' => $out, 'selected' => $out[0]['id']]);
	}

	/* for demo only */
	/*public function actionGetColPatternDemo()
	{
		$data = Collocation::getColPattern(1, 2);
		echo Json::encode(['output' => $data['out'], 'selected' => $data['selected']]);
		//print_r();
	}*/

	/* for demo only */
	public function actionGetColpossByPosDemo()
	{
		$out = Pos::getColpossByPos(1);
		echo Json::encode(['output' => $out, 'selected' => $out[0]['id']]);
	}

	/* for demo only */
	public function actionPostExamples(){
		/*$example = new Example();
		return $this->render('post-examples', ['model'=>$example]);*/
		$model = $this->findModel(71);
		if ($model->load(Yii::$app->request->post())){
			$examples = $_POST['Collocation']['examples'];
			//return ($examples[0]['Entry']);
			//return count($examples);
			//return var_dump($examples);
			/*
			 * Array ( [0] => Array ( [Entry] => test ) [1] => Array ( [EntryZht] => ) [2] => Array ( [EntryZhs] => ) [3] => Array ( [EntryJap] => ) [4] => Array ( [Source] => 1 ) [5] => Array ( [Remark] => ) ) 1
			 */
			/*
			 * array(12) { [0]=> array(1) { ["Entry"]=> string(2) "t0" } [1]=> array(1) { ["EntryZht"]=> string(0) "" } [2]=> array(1) { ["EntryZhs"]=> string(0) "" } [3]=> array(1) { ["EntryJap"]=> string(0) "" } [4]=> array(1) { ["Source"]=> string(1) "1" } [5]=> array(1) { ["Remark"]=> string(0) "" } [6]=> array(1) { ["Entry"]=> string(2) "t1" } [7]=> array(1) { ["EntryZht"]=> string(0) "" } [8]=> array(1) { ["EntryZhs"]=> string(0) "" } [9]=> array(1) { ["EntryJap"]=> string(0) "" } [10]=> array(1) { ["Source"]=> string(1) "1" } [11]=> array(1) { ["Remark"]=> string(0) "" } }
			 */

			$exampleList = [];
			if(count($examples)===0)return;
			$quo = count($examples)/6;
			if($quo===1){
				$ex = new Example();
				$ex->CollocationId = $model->Id;
				$ex->Entry = $examples[0]['Entry'];
				$ex->EntryZht = $examples[1]['EntryZht'];
				$ex->EntryZhs = $examples[2]['EntryZhs'];
				$ex->EntryJap = $examples[3]['EntryJap'];
				$ex->Source = $examples[4]['Source'];
				$ex->Remark = $examples[5]['Remark'];
				array_push($exampleList, $ex);
			}else{
				for($k=0; $k<$quo;$k++){
					$j=$k*6;
					$ex = new Example();
					$ex->CollocationId = $model->Id;
					$i0=0+$j;$i1=1+$j;$i2=2+$j;$i3=3+$j;$i4=4+$j;$i5=5+$j;
					$ex->Entry = $examples[$i0]['Entry'];
					$ex->EntryZht = $examples[$i1]['EntryZht'];
					$ex->EntryZhs = $examples[$i2]['EntryZhs'];
					$ex->EntryJap = $examples[$i3]['EntryJap'];
					$ex->Source = $examples[$i4]['Source'];
					$ex->Remark = $examples[$i5]['Remark'];
					array_push($exampleList, $ex);
				}
			}

			$rows=[];
			$columns = [
				'CollocationId', 'Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'Source', 'Remark'
			];
			foreach($exampleList as $ex){
				$rows[]=[
					'CollocationId'=>$ex->CollocationId,
					'Entry'=>$ex->Entry,
					'EntryZht'=>$ex->EntryZht,
					'EntryZhs'=>$ex->EntryZhs,
					'EntryJap'=>$ex->EntryJap,
					'Source'=>$ex->Source,
					'Remark'=>$ex->Remark,
				];
			}
			//return print_r($rows);
			Yii::$app->db->createCommand()->batchInsert(Example::tableName(), $columns, $rows)->execute();
			return;
			/*
test



1

key: Entry; value: test
key: EntryZht; value:
key: EntryZhs; value:
key: EntryJap; value:
key: Source; value: 1
key: Remark; value:
			 */


			//return print_r($_POST['Collocation']['examples']);
			// Array ( [0] => Array ( [Entry] => test ) [1] => Array ( [EntryZht] => ) [2] => Array ( [EntryZhs] => ) [3] => Array ( [EntryJap] => ) [4] => Array ( [Source] => 1 ) [5] => Array ( [Remark] => ) ) 1
		}else{
			return $this->render('post-examples',['model'=>$model]);
		}

	}
}
