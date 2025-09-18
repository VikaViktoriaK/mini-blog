<?php
/** @var \yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;

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
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="header-actions">
        <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::a('Login', ['site/login'], ['class' => 'btn btn-primary']) ?>
        <?php else: ?>
            <?php
            $route = Yii::$app->controller->route;

            if ($route === 'post/my') {
                echo Html::a('All posts', ['site/index'], ['class' => 'btn btn-secondary']);
            } else {
                echo Html::a('My posts', ['post/my'], ['class' => 'btn btn-secondary']);
            }
            ?>

            <?= Html::beginForm(['site/logout'], 'post', ['class' => 'd-inline']) ?>
            <?= Html::submitButton('Logout', ['class' => 'btn btn-primary']) ?>
            <?= Html::endForm() ?>
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
