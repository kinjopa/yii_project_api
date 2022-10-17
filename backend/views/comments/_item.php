<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/**
 * @var \common\models\Comments $model
 * */
?>
<div class="post">
    <div class="row mt-2 mb-2">
        <div class="col-2">
            <?= $model->id ?>
        </div>
        <div class="col-2">
            <a href="/users/view?id=<?= $model->user->id ?>"><?= $model->user->name ?> <?= $model->user->surname ?></a>
        </div>
        <div class="col-4">
            <?= $model->comment ?>
        </div>
        <div class="col-2">
            <?= $model->status ? 'Опубликован' : 'Не опубликован' ?>
        </div>
        <div class="col-2">
            <?= Html::a(Html::encode('Перейти'), ['view', 'id' => $model->id]) ?>
        </div>
    </div>
</div>