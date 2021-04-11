<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Dropdown;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Project;
/* @var $this yii\web\View */
/* @var $searchModel app\models\McCostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maintenance Costs';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mc-cost-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--p>
        <?= Html::a('Create Mc Cost', ['create'], ['class' => 'btn btn-success']) ?>
    </p-->
    <div class="row">
        
        <?php 
            echo Html::beginForm(['index'], 'get', [
                'class'=> 'form-inline col-md-8'
                ]);
        ?>
        
        <?= Html::dropDownList('p_id', $searchModel->project_id, ArrayHelper::map(Project::find()->all(), 'id','p_name'), [
            'class'=>'form-control'
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Show', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php echo Html::endForm(); ?>
        
    </div>

    <!--?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'project_id',
            'generator_id',
            'person_id',
            'maintenance_id',
            'quantity',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?-->

</div>
