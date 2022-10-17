<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name', ['inputOptions' => ['class' => 'form-control mt-2 mb-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortname', ['inputOptions' => ['class' => 'form-control mt-2 mb-3']])->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
