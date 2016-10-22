<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Word;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Word');
$this->params['breadcrumbs'][] = $this->title;
$entryFilterData = ArrayHelper::map(Word::getEntry(), 'Entry', function ($model, $defaultValue)
{
	return $model->Entry;
});
$entryZhtFilterData = ArrayHelper::map(Word::getEntryZht(), 'EntryZht', function ($model, $defaultValue)
{
	return $model->EntryZht;
});
$entryZhsFilterData = ArrayHelper::map(Word::getEntryZhs(), 'EntryZhs', function ($model, $defaultValue)
{
	return $model->EntryZhs;
});
$entryJapFilterData = ArrayHelper::map(Word::getEntryJap(), 'EntryJap', function ($model, $defaultValue)
{
	return $model->EntryJap;
});
$candelFilterData = ArrayHelper::map(Word::getCanDel(), 'CanDel', function ($model, $defaultValue)
{
	return $model->CanDel == 0 ? Yii::t('yii', 'No') : Yii::t('yii', 'Yes');
});
?>
<div class="word-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php Pjax::begin(); ?>

	<?= GridView::widget([
		'id' => 'defaultList',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn', 'contentOptions' => ['class' => 'serial_column']],

			//'Id',
			[
				'attribute' => 'Entry',
				'filter' => Html::activeDropDownList($searchModel, 'Entry', $entryFilterData, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					$pos = $model->pos->Entry;
					return $model->Entry . " ($pos)";
				},
				'contentOptions' => ['class' => 'entry_column']
			],
			[
				'attribute' => 'EntryZht',
				'filter' => Html::activeDropDownList($searchModel, 'EntryZht', $entryZhtFilterData, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					$pos = $model->pos->EntryZht;
					return $model->EntryZht . " ($pos)";
				},
				'contentOptions' => ['class' => 'entry_column']
			],
			[
				'attribute' => 'EntryZhs',
				'filter' => Html::activeDropDownList($searchModel, 'EntryZhs', $entryZhsFilterData, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					$pos=$model->pos->EntryZhs;
					return $model->EntryZhs." ($pos)";
				},
				'contentOptions' => ['class' => 'entry_column']
			],
			[
				'attribute' => 'EntryJap',
				'filter' => Html::activeDropDownList($searchModel, 'EntryJap', $entryJapFilterData, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					$pos=$model->pos->EntryJap;
					return $model->EntryJap." ($pos)";
				},
				'contentOptions' => ['class' => 'entry_column']
			],
			[
				'attribute' => 'CanDel',
				'filter' => Html::activeDropDownList($searchModel, 'CanDel', $candelFilterData, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					return $model->CanDel == 0 ? Yii::t('yii', 'No') : Yii::t('yii', 'Yes');
				},
				'contentOptions' => ['class' => 'candel_column']
			],

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}&nbsp;{update}&nbsp;{delete}',
				'buttons' => [
					'delete' => function ($url, $model)
					{
						if(\app\models\WcBase::getVisible()){
							return $model->CanDel? (Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->Id], [
								'class' => '',
								'data' => [
									'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
									'method' => 'post',
								],
							])):'';
						}
					},
					'update'=>function($url, $model){
						if(\app\models\WcBase::getVisible()){
							return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' =>
								$model->Id], [
								'class' => '',
								'data' => [
									'method' => 'post',
								],
							]);
						}else{
							return '';
						}
					}
				],
				'contentOptions' => ['class' => 'action_column'],
			],
		],
	]); ?>
	<?php Pjax::end(); ?></div>
