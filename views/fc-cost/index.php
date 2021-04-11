<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Dropdown;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Project;


/* @var $this yii\web\View */
/* @var $searchModel app\models\FcCostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fuel Consumption Costs';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fc-cost-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br/>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--p>
        <?= Html::a('Create Fc Cost', ['create'], ['class' => 'btn btn-success']) ?>
    </p-->

    <div class="row">
        
        <?php 
            echo Html::beginForm(['index'], 'get', [
                'class'=> 'form-inline col-md-8'
                ]);
        ?>

        <?= Html::dropDownList('list', '', ['1'=>'Daily', '2'=>'Monthly'],[
            'class'=>'form-control'
        ]) ?>
        
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            //'monthly_id',
            'p_name',
            'g_code',
            //'person.name',
            //'costType.c_name',
            'running_hr',
            'total_current',
            'fuel_consump',
            'oad',
            'Unit',
            'FuelConsumption',
            'TotalFuelCost',
            'UnitCost'
            
            
        ],
    ]); ?-->

</div>
