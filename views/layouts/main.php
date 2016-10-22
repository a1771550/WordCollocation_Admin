<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

$cssPath = Yii::getAlias('@web') . '/css/';
$jsPath = Yii::getAlias('@web').'/js/';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<?php $title = isset($this->title) ? " : " . $this->title : null; ?>
	<title><?php echo Yii::t('app', 'WordCollocation Backend Administration') . $title; ?></title>
	<?php $this->head() ?>	
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
	    'brandLabel' => Yii::t('app', 'WordCollocation Backend Administration'),
	    'brandUrl' => Yii::$app->homeUrl,
	    'options' => [
		    'class' => 'navbar-inverse navbar-fixed-top',
	    ],
    ]);

    $imgPath = Yii::getAlias('@web') . '/images/';
    $siteLangUrl = '/site/language';
    $returnUrl = Yii::$app->request->url;
    //$enPath = Url::to([$siteLangUrl, 'language' => 'en-US', 'returnUrl'=>$returnUrl]);
    $twPath = Url::to([$siteLangUrl, 'language' => 'zh-TW', 'returnUrl'=>$returnUrl]);
    $cnPath = Url::to([$siteLangUrl, 'language' => 'zh-CN', 'returnUrl'=>$returnUrl]);
    $jaPath = Url::to([$siteLangUrl, 'language'=>'ja', 'returnUrl'=>$returnUrl]);

    $langDropdown = "<li><div id='lang_sel' class=\"dropdown\">
  <a class=\"btn btn-secondary dropdown-toggle\" href=\"#\" id=\"dropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">".
    "<span class='lang_text'>".Yii::t('app', 'Language')."</span>".
  "</a>
  <ul class=\"dropdown-menu\">  
    <li><a href=\"" . $twPath . "\" class='dropdown-item'>繁中<img class=\"flag \" src=\"" . $imgPath . "flags/tw.png\" alt=\"\" /><span class=\"value\">繁中</span></a></li>
    <li><a href=\"" . $cnPath . "\" class='dropdown-item'>简中<img class=\"flag \" src=\"" . $imgPath . "flags/cn.png\" alt=\"\" /><span class=\"value\">简中</span></a></li>
    <li><a href=\"" . $jaPath . "\" class='dropdown-item'>日本語<img class=\"flag \" src=\"" . $imgPath . "flags/jp.png\" alt=\"\" /><span class=\"value\">日本語</span></a></li>
  </ul>
</div></li>";

    $posPath = Url::to(['/pos/index']);
    $wordPath = Url::to(['/word/index']);
    $collocationPath = Url::to(['/collocation/index']);
    $examplePath = Url::to(['/example/index']);

    $moduleDropdown = "<li><div id='module_sel' class=\"dropdown\">
  <a class=\"btn btn-secondary dropdown-toggle\" href=\"#\" id=\"dropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">".
	    "<span class='module_text'>".Yii::t('app', 'Modules')."</span>".
	    "</a>
  <ul class=\"dropdown-menu\">
    <li><a href=\"" . $posPath . "\" class='dropdown-item'>".Yii::t('app','Pos')."</a></li>    
    <li><a href=\"" . $wordPath . "\" class='dropdown-item'>". Yii::t('app','Word')."</a></li>    
    <li><a href=\"" . $collocationPath . "\" class='dropdown-item'>".Yii::t('app','Collocation'). "</a></li>
    <li><a href=\"" . $examplePath . "\" class='dropdown-item'>".Yii::t('app','Example')."</a></li>
  </ul>
</div></li>";

    $navItems = [
	    ['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
	    Yii::$app->user->isGuest ? (
	    ['label' => false]
	    ) : (
		    '<li>'
		    . Html::beginForm(['/wc-authentication/logout'], 'post', ['class' => 'navbar-form'])
		    . Html::submitButton(
			    Yii::t('app','Logout').' (' . Yii::$app->user->identity->username . ')',
			    ['class' => 'btn btn-link']
		    )
		    . Html::endForm()
		    . '</li>'
	    )
    ];

    array_push($navItems, $moduleDropdown);
    array_push($navItems, $langDropdown);

    echo Nav::widget([
	    'options' => ['class' => 'navbar-nav navbar-right'],
	    'items' => $navItems,
    ]);
    NavBar::end();
    ?>

	<div class="container">
        <?= Breadcrumbs::widget([
	        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

		<?= $content ?>
    </div>
</div>
<p class="hide">User name: <?php if(!Yii::$app->user->isGuest) echo Yii::$app->user->identity->username?></p>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', 'WordCollocation Backend Administration') ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
