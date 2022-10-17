<?php

namespace frontend\controllers;

use frontend\libraries\Api;
use frontend\libraries\Auth;
use frontend\models\LoginForm;
use frontend\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if ($action->id !== 'login' and $action->id !== 'error' and empty(Auth::getInstance()->getUser())) {
            $this->redirect(['/login']);
            return false;
        }
        return $action;
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ]
        ];
    }

    /**
     * @throws \yii\httpclient\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $comments = Api::getInstance()->getData('/comments')->toArray();
        $user = new Users();
        $user->setAttributes(Auth::getInstance()->getUser());
        $user->id = Auth::getInstance()->getUser()['id'];

        return $this->render('index', [
            'user' => $user,
            'comments' => $comments
        ]);
    }

    public function actionLogin()
    {
        if (Auth::getInstance()->getUser())
            return $this->redirect('/');

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Auth::deleteToken();
        return $this->redirect('/login');
    }

}
