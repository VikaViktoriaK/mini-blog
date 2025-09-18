<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Post;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['my', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['my', 'create', 'update', 'delete'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionMy()
    {
        $createModel = new Post();
        $posts = Post::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('@app/views/site/my-posts', [
            'posts' => $posts,
            'createModel' => $createModel,
        ]);
    }

    public function actionCreate()
    {
        $model = new Post();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', 'Failed to create the post.');
            }
        }
        return $this->redirect(['post/my']);
    }

    public function actionUpdate($id)
    {
        $model = Post::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        if (!$model) {
            throw new NotFoundHttpException('Post not found.');
        }
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', 'Failed to save the post.');
            }
        }
        return $this->redirect(['post/my']);
    }

    public function actionDelete($id)
    {
        $model = Post::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        if (!$model) {
            throw new NotFoundHttpException('Post not found.');
        }
        $model->delete();
        return $this->redirect(['post/my']);
    }

    public function actionIndex()
    {
        return $this->renderFile('@app/views/index.php');
    }

}
