<?php
/** @var \yii\web\View $this */
/** @var \app\models\Post[] $posts */
/** @var \app\models\Post $createModel */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My posts';
$this->registerCssFile('@web/css/my-posts.css');
?>
<div class="card">
    <?php $form = ActiveForm::begin([
        'action' => ['post/create'],
        'options' => ['class' => 'card-form'],
    ]); ?>

    <?= $form->field($createModel, 'title')
        ->textInput(['placeholder' => 'Title', 'class' => 'input input-title'])
        ->label(false) ?>

    <?= $form->field($createModel, 'content')
        ->textarea(['rows' => 4, 'placeholder' => 'Description', 'class' => 'input input-content'])
        ->label(false) ?>

    <div class="card-actions">
        <?= Html::submitButton('Add', ['class' => 'btn btn-primary btn-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php foreach ($posts as $post): ?>
    <div class="card">
        <?php $form = ActiveForm::begin([
            'action' => ['post/update', 'id' => $post->id],
            'options' => ['class' => 'card-form'],
        ]); ?>

        <?= $form->field($post, 'title')
            ->textInput(['class' => 'input input-title'])
            ->label(false) ?>

        <?= $form->field($post, 'content')
            ->textarea(['rows' => 4, 'class' => 'input input-content'])
            ->label(false) ?>

        <div class="card-actions">
            <?= Html::a('Delete', ['post/delete', 'id' => $post->id], [
                'class' => 'btn btn-secondary',
                'data'  => ['method' => 'post', 'csrf' => true],
            ]) ?>

            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
<?php endforeach; ?>
