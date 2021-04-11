<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Generator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="generator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'g_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'g_brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'g_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'g_capacity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
