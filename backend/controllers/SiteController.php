<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $items = [];
        for ($index = 1; $index < 6; $index++)
            $items[] = [
                'content' => Html::img("@web/images/kotan$index.jpg"),
                'options' => ['style' => 'max-height:500px;']
            ];

        return $this->render('index', ['items' => $items]);
    }

    public function actionStart()
    {
        $items = [];
        for ($index = 1; $index < 6; $index++)
            $items[] = [
                'content' => Html::img("@web/images/kotan$index.jpg"),
                'options' => ['style' => 'max-height:500px; text-align: center;']
            ];

        return $this->render('index', ['items' => $items]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
