<?php

use app\models\Collocation;
use app\models\CollocationPattern;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CollocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Collocation');
$this->params['breadcrumbs'][] = $this->title;

$wordFilter = ArrayHelper::map(Collocation::getWords(), 'wordId', function ($model)
{
	switch (Yii::$app->language)
	{
		case 'en-US':
			return $model->WordEntry;
			break;
		case 'zh-TW':
			return $model->WordEntryZht;
			break;
		case 'zh-CN':
			return $model->WordEntryZhs;
			break;
		case 'ja':
			return $model->WordEntryJap;
			break;
	}
});

$colWordFilter = ArrayHelper::map(Collocation::getColWords(), 'colWordId', function ($model)
{
	switch (Yii::$app->language)
	{
		case 'en-US':
			return $model->ColWordEntry;
			break;
		case 'zh-TW':
			return $model->ColWordEntryZht;
			break;
		case 'zh-CN':
			return $model->ColWordEntryZhs;
			break;
		case 'ja':
			return $model->ColWordEntryJap;
			break;
	}
});


$patternFilter = ArrayHelper::map(Collocation::getPatterns(), 'CollocationPattern', function ($model)
{
	switch ($model->CollocationPattern)
	{
		case (CollocationPattern::NOUN_VERB):
			return Yii::t('app', 'Noun') . ' + ' . Yii::t('app', 'Verb');
		case (CollocationPattern::VERB_NOUN):
			return Yii::t('app', 'Verb') . ' + ' . Yii::t('app', 'Noun');
		case (CollocationPattern::ADJECTIVE_NOUN):
			return Yii::t('app', 'Adjective') . ' + ' . Yii::t('app', 'Noun');
		case (CollocationPattern::VERB_PREPOSITION):
			return Yii::t('app', 'Verb') . ' + ' . Yii::t('app', 'Preposition');
		case (CollocationPattern::PREPOSITION_VERB):
			return Yii::t('app', 'Preposition') . ' + ' . Yii::t('app', 'Verb');
		case (CollocationPattern::ADVERB_VERB):
			return Yii::t('app', 'Adverb') . ' + ' . Yii::t('app', 'Verb');
		case (CollocationPattern::PHRASE_NOUN):
			return Yii::t('app', 'Phrase') . ' + ' . Yii::t('app', 'Noun');
		case (CollocationPattern::PREPOSITION_NOUN):
			return Yii::t('app', 'Preposition') . ' + ' . Yii::t('app', 'Noun');

	}
});
?>
<div class="collocation-index">
	<input type="hidden" id="showCharNum" value="<?= \app\components\paramHelper::getParam('show_char_num') ?>">
	<input type="hidden" id="showMoreText" value="<?= Yii::t('app', 'Show more >') ?>">
	<input type="hidden" id="showLessText" value="<?= Yii::t('app', 'Show less') ?>">
	<input type="hidden" id="enableShowMore" value="<?= \app\components\paramHelper::getParam('enableShowMore') ?>">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php Pjax::begin(); ?>

	<?= GridView::widget([
		'id' => 'collocationList',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn', 'contentOptions' => ['class' => 'serial_column']],
			'Id',
			[
				'attribute' => 'wordId',
				'filter' => Html::activeDropDownList($searchModel, 'wordId', $wordFilter, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					switch (Yii::$app->language)
					{
						case 'en-US':
							return $model->word->Entry;
							break;
						case 'zh-TW':
							return $model->word->Entry . " " . ($model->word->EntryZht);
							break;
						case 'zh-CN':
							return $model->word->Entry . " " . ($model->word->EntryZhs);
							break;
						case 'ja':
							return $model->word->Entry . " " . ($model->word->EntryJap);
							break;
					}
				},
				'contentOptions' => ['class' => 'word_column'],
			],
			[
				'attribute' => 'colWordId',
				'filter' => Html::activeDropDownList($searchModel, 'colWordId', $colWordFilter, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					switch (Yii::$app->language)
					{
						case 'en-US':
							return $model->colWord->Entry;
							break;
						case 'zh-TW':
							return $model->colWord->Entry . " " . ($model->colWord->EntryZht);
							break;
						case 'zh-CN':
							return $model->colWord->Entry . " " . ($model->colWord->EntryZhs);
							break;
						case 'ja':
							return $model->colWord->Entry . " " . ($model->colWord->EntryJap);
							break;
					}
				},
				'contentOptions' => ['class' => 'word_column'],
			],
			[
				'attribute' => 'CollocationPattern',
				'filter' => Html::activeDropDownList($searchModel, 'CollocationPattern', $patternFilter, ['prompt' => '---', 'class' => 'searchDropdown']),
				'content' => function ($model)
				{
					switch ($model->CollocationPattern)
					{
						case (CollocationPattern::NOUN_VERB):
							return Yii::t('app', 'Noun') . ' + ' . Yii::t('app', 'Verb');
						case (CollocationPattern::VERB_NOUN):
							return Yii::t('app', 'Verb') . ' + ' . Yii::t('app', 'Noun');
						case (CollocationPattern::ADJECTIVE_NOUN):
							return Yii::t('app', 'Adjective') . ' + ' . Yii::t('app', 'Noun');
						case (CollocationPattern::VERB_PREPOSITION):
							return Yii::t('app', 'Verb') . ' + ' . Yii::t('app', 'Preposition');
						case (CollocationPattern::PREPOSITION_VERB):
							return Yii::t('app', 'Preposition') . ' + ' . Yii::t('app', 'Verb');
						case (CollocationPattern::ADVERB_VERB):
							return Yii::t('app', 'Adverb') . ' + ' . Yii::t('app', 'Verb');
						case (CollocationPattern::PHRASE_NOUN):
							return Yii::t('app', 'Phrase') . ' + ' . Yii::t('app', 'Noun');
						case (CollocationPattern::PREPOSITION_NOUN):
							return Yii::t('app', 'Preposition') . ' + ' . Yii::t('app', 'Noun');

					}
				},
				'contentOptions' => ['class' => 'pattern_column'],
			],

			[
				'attribute' => Yii::t('app', 'Example'),
				'filter' => false,
				'content' => function ($model)
				{
					$ret = null;
					$examples = $model->examples;
					/*if(count($examples)>1){
						$ret .= "<div id='accordion'>";
						$i = 1;
						foreach ($examples as $example)
						{
							$ret .= "<h5>$i</h5>";
							$ret .= "<div>";
							$entry = $example->Entry;
							$ret .= "<p>$entry</p>";
							$ret .= "</div>";
							$i++;
						}
						$ret .= "</div>";
						return $ret;
					}else{*/
					$i = 0;
					foreach ($examples as $example)
					{
						$entry = $example->Entry;
						$entryTrans = null;
						switch (Yii::$app->language)
						{
							case 'zh-TW':
								$entryTrans = $example->EntryZht.'<br>'.$example->EntryZhs.'<br>'.$example->EntryJap;
								break;
							case 'zh-CN':
								$entryTrans = $example->EntryZhs.'<br>'.$example->EntryZht.'<br>'.$example->EntryJap;
								break;
							case 'ja':
								$entryTrans = $example->EntryJap.'<br>'.$example->EntryZht.'<br>'.$example->EntryZhs;
								break;
						}
						$ret .= "<p class='more'>$entry<br>$entryTrans</p>";
						$i++;
						if (count($examples)>$i) $ret .= "<hr>";
					}
					return $ret;
					/*		}*/

				},
				'contentOptions' => ['class' => 'example_column'],
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<?php Pjax::end(); ?></div>
<?php
/*$this->registerJsFile(Yii::getAlias('@web') . '/js/jquery-ui/jquery-ui.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs("$( function() {
    $( \"#accordion\" ).accordion({
      heightStyle: \"content\"
    });
  } );", \yii\web\View::POS_END);*/
?>
