<?php

use app\models\Word;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Word */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Word'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
if (!empty($error)) {
	echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => $error]);
}
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="word-create col-lg-6">

	<?php $form = ActiveForm::begin(['id' => 'word-create-form']); ?>
	<?= $form->field($model, 'Entry')->textInput(); ?>
	<?= $form->field($model, 'EntryZht')->textInput(); ?>
	<?= $form->field($model, 'EntryZhs')->textInput(); ?>
	<?= $form->field($model, 'EntryJap')->textInput(); ?>
	<?= $form->field($model, 'posId')->dropDownList($posFilter, ['id' => 'posId', 'prompt' => '---', 'class' => 'form-control posDropdown'])->label(Yii::t('app', 'Pos')); ?>
	<div class = "form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>
    </div>
	<?php ActiveForm::end(); ?>

</div>
