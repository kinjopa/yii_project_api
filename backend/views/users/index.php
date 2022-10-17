<?php

use common\models\Cities;
use common\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\UsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'patronymic',
            'surname',
//            'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            ['attribute' => 'city', 'value' => function ($model) {
                return $model->city->name;
            }],
            'phone',
            [
                'attribute' => 'avatar',
                'format' => 'image',
                'value' => function ($model) {
                    return Yii::getAlias('@images') . $model->avatar->url;
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:m']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:m']
            ],
            //'verification_token',
//            [
//                'class' => ActionColumn::class,
//                'urlCreator' => function ($action, Users $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                }
//            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
