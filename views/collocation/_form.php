<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Collocation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="collocation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wordId')->textInput() ?>

    <?= $form->field($model, 'colWordId')->textInput() ?>

    <?= $form->field($model, 'CollocationPattern')->textInput() ?>

    <?= $form->field($model, 'RowVersion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
