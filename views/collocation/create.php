<?php

use app\models\Collocation;
use app\models\ExampleSource;
use app\models\Word;
use kartik\depdrop\DepDrop;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Collocation */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collocation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$wordData = ArrayHelper::map(Collocation::getAllWord(), 'Id', function ($model)
{
	switch (Yii::$app->language)
	{
		case 'zh-CN':
			return $model->WordEntry . " " . $model->WordEntryZhs;
		case 'zh-TW':
			return $model->WordEntry . " " . $model->WordEntryZht;
		case 'ja':
			return $model->WordEntry . " " . $model->WordEntryJap;
		default:
			return $model->WordEntry . " " . $model->WordEntryZnt;
	}
});
$posData = ArrayHelper::map(Word::getAllPos(), 'posId', function ($model)
{
	switch (Yii::$app->language)
	{
		case 'zh-CN':
			return $model->PosEntry . " " . $model->PosEntryZhs;
		case 'zh-TW':
			return $model->PosEntry . " " . $model->PosEntryZht;
		case 'ja':
			return $model->PosEntry . " " . $model->PosEntryJap;
		default:
			return $model->PosEntry . " " . $model->PosEntryZnt;
	}
});

$sourceOptions = [
	['id' => ExampleSource::OXFORD_COLLOCATIONS_DICTIONARY, 'name' => Yii::t('app', 'Oxford Collocations Dictionary')],
	['id' => ExampleSource::NEW_DICTIONARY_OF_ENGLISH_COLLOCATIONS, 'name' => Yii::t('app', 'New Dictionary of English Collocations')],
	['id' => ExampleSource::NEWSPAPER, 'name' => Yii::t('app', 'Newspaper')],
	['id' => ExampleSource::WEB, 'name' => Yii::t('app', 'Web')],
	['id' => ExampleSource::OTHERS, 'name' => Yii::t('app', 'Others')]
];
$sourceData = ArrayHelper::map($sourceOptions, 'id', function($model){
	return $model['name'];
});
?>
<?php
if (!empty($error))
{
	echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => $error]);
}
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="collocation-create col-lg-8">

	<?php $form = ActiveForm::begin(['id' => 'collocation-create-form']); ?>
	<input type="hidden" id="engText" value="<?= Yii::t('app', 'English') ?>">
	<input type="hidden" id="zhtText" value="<?= Yii::t('app', 'Traditional Chinese') ?>">
	<input type="hidden" id="zhsText" value="<?= Yii::t('app', 'Simplified Chinese') ?>">
	<input type="hidden" id="japText" value="<?= Yii::t('app', 'Japanese') ?>">
	<input type="hidden" id="delexText" value="<?= Yii::t('app', 'Delete') . Yii::t('app', 'Example') ?>">
	<input type="hidden" id="selectText" value="<?=Yii::t('app', '-- Select --')?>">
	<input type="hidden" id="oxfordText" value="<?=Yii::t('app', 'Oxford Collocations Dictionary')?>">
	<input type="hidden" id="newDictText" value="<?=Yii::t('app', 'New Dictionary of English Collocations')?>">
	<input type="hidden" id="newsText" value="<?=Yii::t('app', 'Newspaper')?>">
	<input type="hidden" id="webText" value="<?=Yii::t('app', 'Web')?>">
	<input type="hidden" id="otherText" value="<?=Yii::t('app', 'Others')?>">
	<input type="hidden" id="sourceText" value="<?=Yii::t('app', 'Source')?>">
	<input type="hidden" id="remarkText" value="<?=Yii::t('app', 'Remark')?>">


	<!-- TODO: check duplicated entry -->
	<ul class="hulist">
		<li class="col-lg-4"><?= $form->field($model, 'posId')->dropDownList($posData, ['id' => 'posId', 'prompt' => Yii::t('app', '-- Select --'), 'class' => 'form-control wordposDropdown'])->label(Yii::t('app', 'Word') . Yii::t('app', 'Pos')) ?></li>
		<li class="col-lg-4"><?php
			echo $form->field($model, 'wordId')->label(Yii::t('app', 'Word'))->widget(DepDrop::classname(), [
				'options' => ['id' => 'wordId', 'class' => 'form-control wordDropdown'],
				'pluginOptions' => [
					'depends' => ['posId'],
					//'placeholder' => Yii::t('app', '-- Select --'),
					'placeholder' => false,
					'url' => Url::to(['/collocation/get-words-by-pos'])
				]
			]);
			?></li>
	</ul>
	<ul class="clear hulist">
		<li class="col-lg-4"><?php
			echo $form->field($model, 'colPosId')->label(Yii::t('app', 'Colword') . Yii::t('app', 'Pos'))->widget(DepDrop::classname(), [
				'options' => ['id' => 'colPosId', 'class' => 'form-control wordposDropdown'],
				'pluginOptions' => [
					'depends' => ['posId'],
					'placeholder'=>Yii::t('app','-- Select --'),
					//'placeholder' => false,
					'url' => Url::to(['/collocation/get-colposs-by-pos'])
				]
			]);
			?></li>
		<li class="col-lg-4"><?php
			echo $form->field($model, 'colWordId')->label(Yii::t('app', 'Colword'))->widget(DepDrop::classname(), [
				'options' => ['id' => 'colWordId', 'class' => 'form-control wordDropdown'],
				'pluginOptions' => [
					'depends' => ['wordId','colPosId'],
					'placeholder'=>Yii::t('app','-- Select --'),
					//'placeholder' => false,
					'url' => Url::to(['/collocation/get-colwords-by-word-colpos'])
				]
			]);
			?></li>
	</ul>

	<div id="divCreate" class="col-lg-12 form-group clear">
		<a href="#" class="btn btn-success create-ex"><?= Yii::t('app', 'Create') . Yii::t('app', 'Example') ?></a>
	</div>


	<div id="divSubmit" class="form-group col-lg-12">
        <?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>
    </div>
	<?php ActiveForm::end(); ?>

</div>
<?php
$purljs = Yii::getAlias('@web').'/js/purl.js';
$this->registerJsFile($purljs, ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web').'/js/collocation.js', ['depends' => [\yii\web\JqueryAsset::className(), $purljs]]);
?>