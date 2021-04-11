<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FcCost */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fc Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fc-cost-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'monthly_id',
            'project_id',
            'generator_id',
            'person_id',
            'cost_type',
            'running_hr',
            'total_current',
            'fuel_consump',
            'date',
        ],
    ]) ?>

</div>
