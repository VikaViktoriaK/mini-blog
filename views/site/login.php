<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\models\LoginForm $model */

$this->title = 'Login to Account';
$this->registerCssFile('@web/css/login.css');
?>
<div class="auth-page">
    <div class="auth-bg"></div>

    <div class="auth-card" role="dialog" aria-labelledby="auth-title">
        <h1 id="auth-title"><?= Html::encode($this->title) ?></h1>
        <p class="auth-sub">Please enter your email and password to continue</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'action' => ['site/login'],
            'method' => 'post',
            'options' => ['novalidate' => true, 'class' => 'auth-form'],
            'fieldConfig' => [
                'template' => "<label class=\"field\">\n<span class=\"label\">{label}</span>\n{input}\n{error}\n</label>",
                'labelOptions' => ['class' => ''],
                'errorOptions' => ['class' => 'error'],
            ],
        ]); ?>

        <?= $form->errorSummary($model, ['class' => 'form-errors']) ?>

        <?= $form->field($model, 'email')
            ->input('email', ['placeholder' => 'you@example.com', 'autocomplete' => 'email'])
            ->label('Email address:') ?>

        <?= $form->field($model, 'password')
            ->passwordInput(['placeholder' => 'Password', 'autocomplete' => 'current-password'])
            ->label('Password') ?>

        <div class="form-actions">
            <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Back to Home', ['site/index'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
