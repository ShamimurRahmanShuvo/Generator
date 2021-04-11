<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Project;
use app\models\Generator;
use app\models\Person;
use app\models\CostType;

/* @var $this yii\web\View */
/* @var $model app\models\FcCost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fc-cost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'monthly_id')->dropDownList(
                                                ['1' => 'January', 
                                                 '2' => 'February',
                                                 '3' => 'March',
                                                 '4' => 'April', 
                                                 '5' => 'May',
                                                 '6' => 'June',
                                                 '7' => 'July', 
                                                 '8' => 'August',
                                                 '9' => 'September',
                                                 '10' => 'October', 
                                                 '11' => 'November',
                                                 '12' => 'December']) ?>

    <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(Project::find()->all(), 'id','p_name')) ?>

    <?= $form->field($model, 'generator_id')->dropDownList(ArrayHelper::map(Generator::find()->all(), 'id','g_code')) ?>

    <?= $form->field($model, 'person_id')->dropDownList(ArrayHelper::map(Person::find()->all(), 'id','name')) ?>

    <?= $form->field($model, 'cost_type')->dropDownList(ArrayHelper::map(CostType::find()->all(), 'id','c_name')) ?>

    <?= $form->field($model, 'running_hr')->textInput() ?>

    <?= $form->field($model, 'total_current')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fuel_consump')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
