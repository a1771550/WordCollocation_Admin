<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$form = ActiveForm::begin(['id' => 'example-create-form']); ?>
<input type="hidden" name="Collocation[Id]" value="<?= $model->Id ?>">
<input type="hidden" name="Collocation[wordId]" value="<?= $model->wordId ?>">
<input type="hidden" name="Collocation[colWordId]" value="<?= $model->colWordId ?>">
<input type="hidden" name="Collocation[CollocationPattern]" value="<?= $model->CollocationPattern ?>">
<input type="hidden" id="engText" value="<?= Yii::t('app', 'English') ?>">
	<input type="hidden" id="zhtText" value="<?= Yii::t('app', 'Traditional Chinese') ?>">
	<input type="hidden" id="zhsText" value="<?= Yii::t('app', 'Simplified Chinese') ?>">
	<input type="hidden" id="japText" value="<?= Yii::t('app', 'Japanese') ?>">
	<input type="hidden" id="delexText" value="<?= Yii::t('app', 'Delete') . Yii::t('app', 'Example') ?>">
	<input type="hidden" id="selectText" value="<?= Yii::t('app', '-- Select --') ?>">
	<input type="hidden" id="oxfordText" value="<?= Yii::t('app', 'Oxford Collocations Dictionary') ?>">
	<input type="hidden" id="newDictText" value="<?= Yii::t('app', 'New Dictionary of English Collocations') ?>">
	<input type="hidden" id="newsText" value="<?= Yii::t('app', 'Newspaper') ?>">
	<input type="hidden" id="webText" value="<?= Yii::t('app', 'Web') ?>">
	<input type="hidden" id="otherText" value="<?= Yii::t('app', 'Others') ?>">
	<input type="hidden" id="sourceText" value="<?= Yii::t('app', 'Source') ?>">
	<input type="hidden" id="remarkText" value="<?= Yii::t('app', 'Remark') ?>">

<div id="divCreate" class="col-lg-10 form-group clear">
		<a href="#" class="btn btn-success create-ex"><?= Yii::t('app', 'Create') . Yii::t('app', 'Example') ?></a>
	</div>
<div id="divSubmit" class="form-group col-lg-12">
        <?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>
    </div>
<?php ActiveForm::end(); ?>
