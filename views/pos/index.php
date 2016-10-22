<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Pos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pos');
$this->params['breadcrumbs'][] = $this->title;

$entryFilterData = ArrayHelper::map(Pos::getEntry(), 'Entry', function ($model, $defaultValue)
{
	return $model->Entry;
});
$entryZhtFilterData = ArrayHelper::map(Pos::getEntryZht(), 'EntryZht', function ($model, $defaultValue)
{
	return $model->EntryZht;
});
$entryZhsFilterData = ArrayHelper::map(Pos::getEntryZhs(), 'EntryZhs', function ($model, $defaultValue)
{
	return $model->EntryZhs;
});
$candelFilterData = ArrayHelper::map(Pos::getCanDel(), 'CanDel', function ($model, $defaultValue)
{
	return $model->CanDel == 0 ? Yii::t('yii', 'No') : Yii::t('yii', 'Yes');
});
?>
<div class="pos-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
		'id'=>'defaultList',
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
					return $model->Entry;
				},
				'contentOptions' => ['class' => 'entry_column']
			],
			[
				'attribute' => 'EntryZht',
				'filter' => Html::activeDropDownList($searchModel, 'EntryZht', $entryZhtFilterData, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					return $model->EntryZht;
				},
				'contentOptions' => ['class' => 'entry_column']
			],
			[
				'attribute' => 'EntryZhs',
				'filter' => Html::activeDropDownList($searchModel, 'EntryZhs', $entryZhsFilterData, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					return $model->EntryZhs;
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
						if(!\app\models\WcBase::getVisible()){
							return '';
						}
					}
				],
				'contentOptions' => ['class' => 'action_column'],
			],
		],
	]); ?>
	<?php Pjax::end(); ?></div>
