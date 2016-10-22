<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('app', $name);
$trMessage = Yii::t('app', $message);
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($trMessage)) ?>
    </div>

    <p>
        <?php echo Yii::t('app', 'The above error occurred while the Web server was processing your request.'); ?>
    </p>
    <p>
        <?php echo Yii::t('app', 'Please contact us if you think this is a server error. Thank you.'); ?>
    </p>

</div>
