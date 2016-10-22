<?php

use app\models\Word;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Word */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
		'modelClass' => Yii::t('app', 'Word'),
	]) . $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Word'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$candelOptions = [
	['id' => '0', 'name' => Yii::t('yii', 'No')],
	['id' => '1', 'name' => Yii::t('yii', 'Yes')]
];
$candelData = ArrayHelper::map($candelOptions, 'id', function ($model, $defaultValue)
{
	return $model['name'];
});
$posFilter = ArrayHelper::map(Word::getAllPos(), 'posId', function ($model, $defaultValue)
{
	switch (Yii::$app->language)
	{
		case 'en-US':
			return $model->PosEntry;
			break;
		case 'zh-TW':
			return $model->PosEntryZht;
			break;
		case 'zh-CN':
			return $model->PosEntryZhs;
			break;
		case 'ja':
			return $model->PosEntryJap;
			break;
	}
});
?>
<?php
if (!empty($error))
{
	echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => $error]);
}
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="word-update col-lg-6">

	<?php $form = ActiveForm::begin(['id' => 'word-update-form']); ?>
	<?= $form->field($model, 'Entry')->textInput(); ?>
	<?= $form->field($model, 'EntryZht')->textInput(); ?>
	<?= $form->field($model, 'EntryZhs')->textInput(); ?>
	<?= $form->field($model, 'EntryJap')->textInput(); ?>
	<?= $form->field($model, 'posId')->dropDownList($posFilter, ['options'=>[$model->posId=>['Selected'=>'selected']],'id' => 'posId', 'prompt' => '---', 'class' => 'form-control posDropdown'])->label(Yii::t('app', 'Pos')); ?>
	<?= $form->field($model, 'CanDel')->dropDownList($candelData, ['options' => [$model->CanDel => ['Selected' => 'selected']],'class'=>'form-control boolDropdown']) ?>
	<div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>
    </div>
	<?php ActiveForm::end(); ?>

</div>
