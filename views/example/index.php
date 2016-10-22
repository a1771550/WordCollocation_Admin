<?php

use app\models\Example;
use app\models\ExampleSource;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ExampleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Example');
$this->params['breadcrumbs'][] = $this->title;
$colIdFilter = ArrayHelper::map(Example::getCollocationIds(), 'CollocationId', function ($model)
{
	return $model->CollocationId;
});
$sourceFilter = ArrayHelper::map(Example::getSources(), 'Source', function ($model)
{
	switch($model->Source){
		case ExampleSource::OXFORD_COLLOCATIONS_DICTIONARY:
			return Yii::t('app','Oxford Collocations Dictionary');
		case ExampleSource::NEW_DICTIONARY_OF_ENGLISH_COLLOCATIONS:
			return Yii::t('app', 'New Dictionary of English Collocations');
		case ExampleSource::NEWSPAPER:
			return Yii::t('app', 'Newspaper');
		case ExampleSource::WEB:
			return Yii::t('app', 'Web');
		case ExampleSource::FICTION:
			return Yii::t('app', 'Fiction');
		case ExampleSource::OTHERS:
			return Yii::t('app', 'Others');
	}

});
?>
<div class="example-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn', 'contentOptions' => ['class' => 'serial_column']],

            [
            	'attribute'=>'CollocationId',
	            'filter'=>Html::activeDropDownList($searchModel, 'CollocationId', $colIdFilter, ['prompt' => '---', 'class' => 'searchDropdown']),
	            'content' => function ($model)
	            {
		            return $model->CollocationId;
	            },
	            'contentOptions' => ['class' => 'serial_column']
            ],
            [
            	'attribute'=>'Entry',
	            'filter'=>false,
            ],
	        [
		        'attribute'=>'EntryZht',
		        'filter'=>false,
	        ],
	        [
		        'attribute'=>'EntryZhs',
		        'filter'=>false,
	        ],
	        [
		        'attribute'=>'EntryJap',
		        'filter'=>false,
	        ],
	        [
		        'attribute'=>'Source',
		        'filter'=>Html::activeDropDownList($searchModel, 'Source', $sourceFilter, ['prompt' => '---', 'class' => 'searchDropdown']),
		        'content' => function ($model)
		        {
			        switch($model->Source){
				        case ExampleSource::OXFORD_COLLOCATIONS_DICTIONARY:
					        return Yii::t('app','Oxford Collocations Dictionary');
				        case ExampleSource::NEW_DICTIONARY_OF_ENGLISH_COLLOCATIONS:
					        return Yii::t('app', 'New Dictionary of English Collocations');
				        case ExampleSource::NEWSPAPER:
					        return Yii::t('app', 'Newspaper');
				        case ExampleSource::WEB:
					        return Yii::t('app', 'Web');
				        case ExampleSource::FICTION:
					        return Yii::t('app', 'Fiction');
				        case ExampleSource::OTHERS:
					        return Yii::t('app', 'Others');
			        }
		        },
		        //'contentOptions' => ['class' => 'entry_column']
	        ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
