<?php
use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
use \yii\bootstrap\Alert;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if ($error != null)
{
	echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => $error]);
}
?>
<div class="site-login col-lg-offset-1">
	<h2><?= Html::encode($this->title)?></h2>
	<?php if (Yii::$app->user->isGuest)
{ ?>

	<?php $form = ActiveForm::begin([
	'id' => 'login-form',
	'options' => ['class' => 'form-horizontal'],
	'fieldConfig' => [
		'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
		'labelOptions' => ['class' => 'col-lg-1 control-label'],
	],
]); ?>
		<?=Html::hiddenInput('LoginForm[returnUrl]', $model->returnUrl)?>


		<?= $form->field($model, 'username') ?>


		<?= $form->field($model, 'password')->passwordInput() ?>


		<div style="margin-left:1.2em;">
			<?= $form->field($model, 'rememberMe')->checkbox() ?>
		</div>


        <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

	<?php ActiveForm::end(); ?>

<?php } ?>

</div>
