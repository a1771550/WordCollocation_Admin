<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="word-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Entry') ?>

    <?= $form->field($model, 'EntryZht') ?>

    <?= $form->field($model, 'EntryZhs') ?>

    <?= $form->field($model, 'EntryJap') ?>

    <?php // echo $form->field($model, 'RowVersion') ?>

    <?php // echo $form->field($model, 'CanDel') ?>

    <?php // echo $form->field($model, 'posId') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
