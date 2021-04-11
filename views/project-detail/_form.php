<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Project;
use app\models\Generator;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(Project::find()->all(), 'id','p_name')) ?>

    <?= $form->field($model, 'generator_id')->dropDownList(ArrayHelper::map(Generator::find()->all(), 'id','g_code')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
