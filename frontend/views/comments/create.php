<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comments */

$this->title = 'Создание комментария ';
?>
<div class="cities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="comments-form mt-4">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'comment', ['inputOptions' => ['class' => 'form-control mt-2 mb-3']])->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'status')->dropDownList([1 => 'Да', 0 => 'Нет']) ?>

        <div class="form-group mt-4">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>