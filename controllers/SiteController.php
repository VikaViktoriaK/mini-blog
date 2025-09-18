<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => ['class' => 'yii\web\ErrorAction'],
        ];
    }

    /** Главная */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /** Логин */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'auth';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /** Простой чек БД без стилей */
    public function actionDbCheck()
    {
        Yii::$app->response->format = Response::FORMAT_HTML;

        try {
            $db = Yii::$app->db;
            $db->open();
            $mysqlVersion = $db->createCommand('SELECT VERSION()')->queryScalar();

            $schema = $db->schema;
            $tables = $schema->getTableNames();
            $hasUsers = in_array('users', $tables, true);
            $hasPosts = in_array('posts', $tables, true);

            if (!$hasUsers || !$hasPosts) {
                $missing = [];
                if (!$hasUsers) $missing[] = 'users';
                if (!$hasPosts) $missing[] = 'posts';
                $missingList = implode(', ', $missing);
                return $this->renderContent(
                    "<h1>DB CHECK</h1>
                     <p>MySQL: <b>{$mysqlVersion}</b></p>
                     <p><b>Отсутствуют таблицы:</b> {$missingList}</p>
                     <p>Существующие таблицы: <code>" . htmlspecialchars(implode(', ', $tables)) . "</code></p>"
                );
            }

            $usersCount = (int)$db->createCommand('SELECT COUNT(*) FROM `users`')->queryScalar();
            $postsCount = (int)$db->createCommand('SELECT COUNT(*) FROM `posts`')->queryScalar();

            $usersSample = $db->createCommand('SELECT `id`, `email` FROM `users` ORDER BY `id` DESC LIMIT 5')->queryAll();
            $postsSample = $db->createCommand('SELECT `id`, `user_id`, `title` FROM `posts` ORDER BY `id` DESC LIMIT 5')->queryAll();

            $usersRows = '';
            foreach ($usersSample as $row) {
                $usersRows .= '<tr><td>'.(int)$row['id'].'</td><td>'.htmlspecialchars($row['email']).'</td></tr>';
            }
            if ($usersRows === '') $usersRows = '<tr><td colspan="2">— no rows —</td></tr>';

            $postsRows = '';
            foreach ($postsSample as $row) {
                $postsRows .= '<tr><td>'.(int)$row['id'].'</td><td>'.(int)$row['user_id'].'</td><td>'.htmlspecialchars($row['title']).'</td></tr>';
            }
            if ($postsRows === '') $postsRows = '<tr><td colspan="3">— no rows —</td></tr>';

            return $this->renderContent(
                "<h1>DB CHECK</h1>
                 <p>MySQL: <b>{$mysqlVersion}</b></p>
                 <h2>users (count: {$usersCount})</h2>
                 <table border=\"1\" cellspacing=\"0\" cellpadding=\"6\">
                    <thead><tr><th>ID</th><th>Email</th></tr></thead>
                    <tbody>{$usersRows}</tbody>
                 </table>
                 <h2>posts (count: {$postsCount})</h2>
                 <table border=\"1\" cellspacing=\"0\" cellpadding=\"6\">
                    <thead><tr><th>ID</th><th>User ID</th><th>Title</th></tr></thead>
                    <tbody>{$postsRows}</tbody>
                 </table>"
            );
        } catch (\Throwable $e) {
            return $this->renderContent(
                "<h1>DB CHECK</h1>
                 <p><b>Ошибка:</b> ".htmlspecialchars($e->getMessage())."</p>
                 <pre>".htmlspecialchars($e->getTraceAsString())."</pre>"
            );
        }
    }
}
