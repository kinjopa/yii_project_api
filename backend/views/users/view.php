<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Users $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--         Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) -->
<!--        Html::a('Delete', ['delete', 'id' => $model->id], [-->
<!--            'class' => 'btn btn-danger',-->
<!--            'data' => [-->
<!--                'confirm' => 'Are you sure you want to delete this item?',-->
<!--                'method' => 'post',-->
<!--            ],-->
<!--        ]) -->
<!--    </p>-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'patronymic',
            'surname',
            'email:email',
            [
                'attribute' => 'city',
                'value' => function ($model) {
                    return $model->city->name;
                }
            ],
            'phone',
            [
                'attribute' => 'avatar',
                'value' => Yii::getAlias('@images') . $model->avatar->url,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
