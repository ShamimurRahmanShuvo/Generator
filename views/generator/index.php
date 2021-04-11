<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GeneratorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Generators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="generator-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Generator', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'g_code',
            'g_brand',
            'g_model',
            'g_capacity',
            //'status',
            'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
