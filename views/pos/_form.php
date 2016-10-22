<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Entry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EntryZht')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EntryZhs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EntryJap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RowVersion')->textInput() ?>

    <?= $form->field($model, 'CanDel')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
