<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaintenanceItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maintenance Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Maintenance Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'item',
            'unit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
