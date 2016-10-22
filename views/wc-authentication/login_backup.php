<?php
/**
 * Created by PhpStorm.
 * User: kevinlau
 * Date: 10/5/16
 * Time: 2:03 AM
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Alert;
?>
<?php
if($error!=null){
	echo Alert::widget(['options'=>['class'=>'alert-danager'],'body'=>$error]);}

?>
<?php if(Yii::$app->user->isGuest){ ?>
	<?php ActiveForm::begin(); ?>
	<div class="form-group">
<?php echo Html::label(Yii::t('app', 'Username'), 'username'); ?>
<?php echo Html::textInput('username', '', ['class' => 'form-control']); ?>
</div>
	<div class="form-group">
	<?php echo Html::label(Yii::t('app','Password'), 'password'); ?>
	<?php echo Html::passwordInput('password', '', ['class' => 'form-control']); ?>

	<input type="checkbox" name="rememberMe"><?=Yii::t('app','Remember Me')?>

	</div><?php echo Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary']); ?>
	<?php ActiveForm::end(); ?>
<?php }else{ ?>

<?php } ?>
