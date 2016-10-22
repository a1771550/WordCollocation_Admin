<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Pos */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if (!empty($error)) {
	echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => $error]);
}
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="pos-create col-lg-6">

	<?php $form = ActiveForm::begin(['id' => 'pos-create-form']); ?>
	<?= $form->field($model, 'Entry')->textInput(); ?>
	<?= $form->field($model, 'EntryZht')->textInput(); ?>
	<?= $form->field($model, 'EntryZhs')->textInput(); ?>
	<?= $form->field($model, 'EntryJap')->textInput(); ?>
	<div class = "form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>
    </div>
	<?php ActiveForm::end(); ?>

</div>
