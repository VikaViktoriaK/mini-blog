<?php
/** @var \yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php $this->registerCssFile('@web/css/styles.css'); ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="site-header">
    <a class="site-brand" href="<?= Url::to(['site/index']) ?>">Mini Blog</a>

    <div class="header-actions">

        <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::a('Login', ['site/login'], ['class' => 'btn btn-primary']) ?>
        <?php else: ?>
            <?= Html::a('My posts', ['post/my'], ['class' => 'btn btn-secondary']) ?>
            <?php
            echo Html::beginForm(['site/logout'], 'post', ['class' => 'd-inline']);
            echo Html::submitButton('Logout', ['class' => 'btn btn-primary']);
            echo Html::endForm();
            ?>
        <?php endif; ?>
    </div>
</header>

<main class="container">
    <?= $content ?>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
