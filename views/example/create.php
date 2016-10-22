<?php

use app\models\Example;
use app\models\ExampleSource;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Example */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Example'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$colIdData = ArrayHelper::map(Example::getAllCollocationIds(), 'Id', function ($model)
{
	return $model->Id;
});
$sourceOptions = [
	['id'=>ExampleSource::OXFORD_COLLOCATIONS_DICTIONARY, 'name'=>Yii::t('app','Oxford Collocations Dictionary')],
	['id'=>ExampleSource::NEW_DICTIONARY_OF_ENGLISH_COLLOCATIONS, 'name'=>Yii::t('app', 'New Dictionary of English Collocations')],
	['id'=>ExampleSource::NEWSPAPER, 'name'=>Yii::t('app', 'Newspaper')],
	['id'=>ExampleSource::WEB, 'name'=>Yii::t('app','Web')],
	['id'=>ExampleSource::FICTION, 'name'=>Yii::t('app', 'Fiction')],
	['id'=>ExampleSource::OTHERS, 'name'=>Yii::t('app','Others')],
];
$sourceData = ArrayHelper::map($sourceOptions, 'id', function ($model)
{
	return $model['name'];
});
?>
<?php
if (!empty($error)) {
	echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => $error]);
}
?>
<div class="example-create col-lg-8">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin(['id' => 'example-create-form']); ?>
	<?= $form->field($model, 'CollocationId')->dropDownList($colIdData, ['prompt' => Yii::t('app','-- Select --'), 'class' => 'form-control'])->label(Yii::t('app', 'Collocation').Yii::t('app','ID')); ?>
	<?php echo $form->field($model, 'Entry')->textarea(['class'=>'form-control']);?>
	<?php echo $form->field($model, 'EntryZht')->textarea(['class'=>'form-control']);?>
	<?php echo $form->field($model, 'EntryZhs')->textarea(['class'=>'form-control']);?>
	<?php echo $form->field($model, 'EntryJap')->textarea(['class'=>'form-control']);?>
	<?= $form->field($model, 'Source')->dropDownList($sourceData, ['prompt' => Yii::t('app','-- Select --'), 'class' => 'form-control']) ?>
	<?= $form->field($model, 'Remark')->textarea(['class'=>'form-control'])?>
	<div class = "form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>
    </div>
	<?php ActiveForm::end(); ?>

</div>
