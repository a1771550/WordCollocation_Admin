<?php

namespace app\controllers;

use app\components\paramHelper;
use Yii;
use app\models\Word;
use app\models\WordSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * WordController implements the CRUD actions for Word model.
 */
class WordController extends BaseController
{
    /**
     * @inheritdoc
     */
	public function behaviors() {
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
					/*[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],*/
				],
				'denyCallback' => function($rule, $data) {
					$this->goHome();
				}
			],
		];
	}

	/**
	 * Lists all Word models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new WordSearch();
		$searchModel->scenario = Word::SCENARIO_SEARCH;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = paramHelper::getParam('gridview_pagesize');

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Word model.
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
	 * Creates a new Word model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Word();
		$model->scenario = Word::SCENARIO_CREATE;
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$pos = $model->pos;
			$pos->CanDel=0;
			$pos->save();
			return $this->redirect(['view', 'id' => $model->Id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Word model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$model->scenario = Word::SCENARIO_UPDATE;
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index', 'id' => $model->Id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

    /**
     * Deletes an existing Word model.
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
     * Finds the Word model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Word the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Word::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEntry(){
	    $entry=Word::getEntry();
	    print_r($entry);
    }
}
