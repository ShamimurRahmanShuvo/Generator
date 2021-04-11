<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Project;
use app\models\Generator;
use app\models\Person;
use app\models\CostType;
use app\models\MaintenanceItem;

/* @var $this yii\web\View */
/* @var $model app\models\RcCost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rc-cost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(Project::find()->all(), 'id','p_name')) ?>

    <?= $form->field($model, 'generator_id')->dropDownList(ArrayHelper::map(Generator::find()->all(), 'id','g_code')) ?>

    <?= $form->field($model, 'person_id')->dropDownList(ArrayHelper::map(Person::find()->all(), 'id','name')) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'total_cost')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
