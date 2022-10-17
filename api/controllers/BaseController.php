<?php

namespace api\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\helpers\Json;
use yii\rest\ActiveController;

class BaseController extends ActiveController
{
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formatParam' => 'format',
            'formats' => [
//                'application/xml' => \yii\web\Response::FORMAT_XML,
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
            'languages' => [
                'en',
                'ru',
            ],
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['login'],
        ];

        return $behaviors;
    }

}