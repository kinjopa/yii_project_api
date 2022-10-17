<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' =>
        [
            'log'
        ],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ]
        ],
        'user' => [
            'identityClass' => 'api\models\Users',
            'enableAutoLogin' => false,
            'enableSession' => false,
//            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'cities',
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['users'],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'GET data' => 'data',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'comments',
                    'extraPatterns' => [
                        'POST status' => 'status',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'cities',
//                    'pluralize' => false
                ],
            ],
        ],

    ],
    'params' => $params,
];
