<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExampleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="example-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Entry') ?>

    <?= $form->field($model, 'EntryZht') ?>

    <?= $form->field($model, 'EntryZhs') ?>

    <?= $form->field($model, 'EntryJap') ?>

    <?php // echo $form->field($model, 'Source') ?>

    <?php // echo $form->field($model, 'RemarkZht') ?>

    <?php // echo $form->field($model, 'RemarkZhs') ?>

    <?php // echo $form->field($model, 'RemarkJap') ?>

    <?php // echo $form->field($model, 'CollocationId') ?>

    <?php // echo $form->field($model, 'RowVersion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
