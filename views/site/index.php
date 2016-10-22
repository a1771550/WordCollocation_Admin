<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'WordCollocation Backend Administration';
$this->params['breadcrumbs'][] = '';

$posPath = Url::to(['/pos/index']);
$colPosPath = Url::to(['/colpos/index']);
$wordPath = Url::to(['/word/index']);
$colWordPath = Url::to(['/colword/index']);
$collocationPath = Url::to(['/collocation/index']);
$examplePath = Url::to(['/example/index']);
?>

<div class="site-index">


    <div class="body-content">

        <h2><?=Yii::t('app','Modules')?></h2>
		<ul id="moduleList" class="hulist">
			<li><a href="<?=$posPath?>"><?=Yii::t('app','Pos')?></a></li>
			<li><a href="<?=$wordPath?>"><?=Yii::t('app','Word')?></a></li>
			<li><a href="<?=$collocationPath?>"><?=Yii::t('app','Collocation')?></a></li>
			<li><a href="<?=$examplePath?>"><?=Yii::t('app','Example')?></a></li>
		</ul>

    </div>
</div>
