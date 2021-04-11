<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MonthlyCost */

$this->title = 'Create Monthly Cost';
$this->params['breadcrumbs'][] = ['label' => 'Monthly Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monthly-cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
