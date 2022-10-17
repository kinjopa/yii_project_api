<?php

namespace frontend\controllers;

use frontend\libraries\Api;
use frontend\models\Comments;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class CommentsController extends Controller
{
    /**
     * @throws \yii\httpclient\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionStatus()
    {
        if (Yii::$app->request->isAjax and !empty(Yii::$app->request->post('id'))) {
            return Json::encode(Api::getInstance()->getData('/comments/status', 'post', ['id' => Yii::$app->request->post('id'), 'updated_at' => Yii::$app->request->post('updated_at')])->toArray());
        }
        return false;
    }

    /**
     * @throws \yii\httpclient\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionDelete()
    {
        if (Yii::$app->request->isAjax and !empty(Yii::$app->request->post('id'))) {
            if (Json::encode(Api::getInstance()->getData('/comments/' . Yii::$app->request->post('id'), 'delete')->toArray()))
                return Json::encode(['id' => Yii::$app->request->post('id')]);
        }
        return false;
    }

    public function actionView()
    {
        $model = new Comments();

        if ($this->request->isPost and $model->load($this->request->post())) {
            Api::getInstance()->getData('/comments', 'post', ['comment' => $model->comment, 'status' => $model->status]);
            $this->redirect('/');
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }
}