<?php

use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
		'modelClass' => Yii::t('app', 'Pos'),
	]) . $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pos'), 'url' => ['index']];
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
?>
<?php
if (!empty($error))
{
	echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => $error]);
}
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="pos-update col-lg-6">

	<?php $form = ActiveForm::begin(['id' => 'pos-update-form']); ?>
	<?= $form->field($model, 'Entry')->textInput(); ?>
	<?= $form->field($model, 'EntryZht')->textInput(); ?>
	<?= $form->field($model, 'EntryZhs')->textInput(); ?>
	<?= $form->field($model, 'EntryJap')->textInput(); ?>
	<?= $form->field($model, 'CanDel')->dropDownList($candelData, ['options' => [$model->CanDel => ['Selected' => 'selected']],'class'=>'form-control boolDropdown']) ?>
	<div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>
    </div>
	<?php ActiveForm::end(); ?>

</div>
