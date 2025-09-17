<?php
use yii\helpers\Url;
/** @var yii\web\View $this */
$this->registerCssFile('@web/css/styles.css');

$this->title = 'Posts';

$posts = [
    [
        'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt',
        'content' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry...'
    ],
    [
        'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt',
        'content' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry...'
    ],
    [
        'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt',
        'content' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry...'
    ],
];
?>
<div class="blog-page">
    <main class="posts">
        <?php foreach ($posts as $post): ?>
            <article class="post-card">
                <h2 class="post-title"><?= htmlspecialchars($post['title']) ?></h2>
                <p class="post-text"><?= htmlspecialchars($post['content']) ?></p>
            </article>
        <?php endforeach; ?>
    </main>
</div>
