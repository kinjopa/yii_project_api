<?php

namespace api\controllers;

use api\models\Comments;
use common\models\CommentsSearch;
use Yii;
use yii\data\ActiveDataProvider;

class CommentsController extends BaseController
{
    public $modelClass = Comments::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['update'], $actions['index'], $actions['view'], $actions['create']);

        return $actions;
    }

    public function actionView()
    {
        return Comments::findOne(['id' => Yii::$app->request->getQueryParams()['id'], 'user' => Yii::$app->user->getId()]);
    }

    public function actionIndex()
    {
        return Comments::find()->where(['user' => Yii::$app->user->getId()])->all();
    }

    public function actionDelete()
    {
        return Comments::deleteAll(['id' => Yii::$app->request->getQueryParams()['id'], 'user' => Yii::$app->user->getId()]);
    }

    public function actionUpdate()
    {
        $fields = Yii::$app->request->post();
        $query_params = Yii::$app->request->getQueryParams();
        $comment = Comments::findOne(['id' => $query_params['id'], 'user' => Yii::$app->user->identity->getId()]);

        if ($comment) {
            $comment->status = isset($fields['status']) ? $fields['status'] : $comment->status;
            $comment->comment = $fields['comment'] ?? $comment->comment;
            $comment->updated_at = time();
            $comment->update(true, ['status', 'comment', 'updated_at']);
            return true;
        }
        return false;
    }

    /**
     * @throws \yii\db\StaleObjectException
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     */
    public function actionStatus()
    {
        if (!empty(Yii::$app->request->post('id'))) {
            $comment = Comments::findOne(['id' => Yii::$app->request->post('id'), 'user' => Yii::$app->user->getId()]);
            if ($comment) {
                $comment->status = !$comment->status;
                $comment->updated_at = time();
                $comment->update(false, ['status', 'updated_at']);
                return ['status' => $comment->status, 'updated_at' => Yii::$app->formatter->asDatetime($comment->updated_at, 'd.M.Y H:m'),'id' => Yii::$app->request->post('id')];
            }
        }
        return [];
    }

    public function actionCreate()
    {
        $model = new \common\models\Comments();
        if ($model->load(Yii::$app->request->post(), '')) {
            $model->user = Yii::$app->user->identity->getId();

            if ($model->validate()) {
                $model->save();
                return true;
            }
        }

        return $model->errors;
    }

}