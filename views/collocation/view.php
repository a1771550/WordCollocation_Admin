<?php

use app\models\CollocationPattern;
use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Collocation */

$this->title = Yii::t('app','Collocation'). Yii::t('app','Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collocation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$pos = null;
switch(Yii::$app->language){
	case 'zh-TW':
		$pos = $model->word->pos->Entry.' '.$model->word->pos->EntryZht;
		break;
	case 'zh-CN':
		$pos = $model->word->pos->Entry.' '.$model->word->pos->EntryZhs;
		break;
	case 'ja':
		$pos = $model->word->pos->Entry.' '.$model->word->pos->EntryJap;
		break;
}
$word = null;
switch(Yii::$app->language){
	case 'zh-TW':
		$word = $model->word->Entry.' '.$model->word->EntryZht;
		break;
	case 'zh-CN':
		$word = $model->word->Entry.' '.$model->word->EntryZhs;
		break;
	case 'ja':
		$word = $model->word->Entry.' '.$model->word->EntryJap;
		break;
}
$colpos = null;
switch(Yii::$app->language){
	case 'zh-TW':
		$colpos = $model->colWord->pos->Entry.' '.$model->colWord->pos->EntryZht;
		break;
	case 'zh-CN':
		$colpos = $model->colWord->pos->Entry.' '.$model->colWord->pos->EntryZhs;
		break;
	case 'ja':
		$colpos = $model->colWord->pos->Entry.' '.$model->colWord->pos->EntryJap;
		break;
}
$colword=null;
switch(Yii::$app->language){
	case 'zh-TW':
		$colword = $model->colWord->Entry.' '.$model->colWord->EntryZht;
		break;
	case 'zh-CN':
		$colword = $model->colWord->Entry.' '.$model->colWord->EntryZhs;
		break;
	case 'ja':
		$colword = $model->colWord->Entry.' '.$model->colWord->EntryJap;
		break;
}

$pattern=null;
switch ($model->CollocationPattern)
{
	case (CollocationPattern::NOUN_VERB):
		$pattern =  Yii::t('app', 'Noun') . ' + ' . Yii::t('app', 'Verb');break;
	case (CollocationPattern::VERB_NOUN):
		$pattern =  Yii::t('app', 'Verb') . ' + ' . Yii::t('app', 'Noun');break;
	case (CollocationPattern::ADJECTIVE_NOUN):
		$pattern =  Yii::t('app', 'Adjective') . ' + ' . Yii::t('app', 'Noun');break;
	case (CollocationPattern::VERB_PREPOSITION):
		$pattern =  Yii::t('app', 'Verb') . ' + ' . Yii::t('app', 'Preposition');break;
	case (CollocationPattern::PREPOSITION_VERB):
		$pattern =  Yii::t('app', 'Preposition') . ' + ' . Yii::t('app', 'Verb');break;
	case (CollocationPattern::ADVERB_VERB):
		$pattern =  Yii::t('app', 'Adverb') . ' + ' . Yii::t('app', 'Verb');break;
	case (CollocationPattern::PHRASE_NOUN):
		$pattern =  Yii::t('app', 'Phrase') . ' + ' . Yii::t('app', 'Noun');break;
	case (CollocationPattern::PREPOSITION_NOUN):
		$pattern =  Yii::t('app', 'Preposition') . ' + ' . Yii::t('app', 'Noun');break;

}


?>
<div class="collocation-view">

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
			'heading'=>Yii::t('app', 'Collocation').' # ' . $model->Id,
			'type'=>DetailView::TYPE_INFO,
			'headingOptions'=>[
				'template' => '{title}',
			],
		],

		'attributes' => [

			[
				'attribute'=>'wordId',
				'value'=>$word.' ('.$pos.')',
			],
			[
				'attribute'=>'colWordId',
				'value'=>$colword.' ('.$colpos.')',
			],
			[
				'attribute'=>'CollocationPattern',
				'value'=>$pattern,
			],

			[
				'attribute'=>'Examples',
				'format'=>'raw',
				'value'=>function($form, $widget){
					$model = $widget->model;
					$ret=null;
					$i = 0;
					foreach ($model->examples as $example)
					{
						$entry = $example->Entry;
						$entryTrans = null;
						switch (Yii::$app->language)
						{
							case 'zh-TW':
								$entryTrans = ' ('. Yii::t('app', 'Traditional Chinese'). ') '. $example->EntryZht . ' ('. Yii::t('app', 'Simplified Chinese'). ') ' . $example->EntryZhs . ' ('. Yii::t('app', 'Japanese'). ') ' . $example->EntryJap;
								break;
							case 'zh-CN':
								$entryTrans = $example->EntryZhs . ' ' . $example->EntryZht . ' ' . $example->EntryJap;
								break;
							case 'ja':
								$entryTrans = $example->EntryJap . ' ' . $example->EntryZht . ' ' . $example->EntryZhs;
								break;
						}
						$ret .= (count($model->examples)>1)? '<div>'.($i+1).'. '. "$entry $entryTrans</div>": "$entry $entryTrans";
						$i++;
						if (count($model->examples) > $i) $ret .= "";
					}
					return $ret;
				},
			],
			'RowVersion',
		],
	]) ?>

	<button id='btnIndex' class='btn btn-primary'><?= Yii::t('app', 'Index'); ?></button>
</div>
