<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Word */

$this->title = Yii::t('app','Word Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Word'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$pos=null;
switch(Yii::$app->language){
	case 'en-US':
		$pos = $model->pos->Entry;
		break;
	case 'zh-CN':
		$pos = $model->pos->EntryZhs;
		break;
	case 'zh-TW':
		$pos = $model->pos->EntryZht;
		break;
	case 'ja':
		$pos = $model->pos->EntryJap;
		break;
}

?>
<div class="word-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
	    <?php
	    if(\app\models\WcBase::getVisible()){
		    echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']);
	    }
	    ?>
	    <?php
	    if($model->CanDel && \app\models\WcBase::getVisible()){
		    echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->Id], [
			    'class' => 'btn btn-danger',
			    'data' => [
				    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				    'method' => 'post',
			    ],
		    ]);
	    }
	    ?>
    </p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'Id',
			'Entry',
			'EntryZht',
			'EntryZhs',
			'EntryJap',
			[
				'attribute'=>'posId',
				'value'=>$pos,
			],
			[
				'attribute'=>'CanDel',
				'value'=>$model->CanDel==0?Yii::t('yii','No'):Yii::t('yii','Yes'),
			],
			'RowVersion',
		],
	]) ?>

	<button id='btnIndex' class='btn btn-primary'><?= Yii::t('app', 'Index'); ?></button>
</div>
