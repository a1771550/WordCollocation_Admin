<?php

use app\models\ExampleSource;
use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Example */

$this->title = Yii::t('app','Example'). Yii::t('app','Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Example'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
	    'condensed'=>false,
	    'hover'=>true,
	    'mode'=>DetailView::MODE_VIEW,
	    'panel'=>[
		    'heading'=>Yii::t('app', 'Example').' # ' . $model->Id,
		    'type'=>DetailView::TYPE_INFO,
		    'headingOptions'=>[
			    'template' => '{title}',
		    ],
	    ],
        'attributes' => [
            'Entry',
            'EntryZht',
            'EntryZhs',
            'EntryJap',
            [
                'attribute'=>'Source',
	            'value'=>function($form,$widget){
		    	    $model=$widget->model;
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
            ],
            'Remark',
            'CollocationId',
            'RowVersion',
        ],
    ]) ?>
	<button id='btnIndex' class='btn btn-primary'><?= Yii::t('app', 'Index'); ?></button>
</div>
