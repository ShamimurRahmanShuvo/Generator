<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\data\ActiveDataProvider;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;

use app\models\Project;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FcCostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maintenance Costs';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mc-cost-index">

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
        
        <?= Html::dropDownList('p_id', $searchModel->project_id, ArrayHelper::map(Project::find()->all(), 'id','p_name'), [
            'class'=>'form-control'
        ]) ?>

        <div class="form-group" style="margin-top: 10px;">
            <?= Html::submitButton('Show', ['class' => 'btn btn-primary']) ?>
            <p style="float: right; margin-left:10px;">
                <?= Html::submitButton('Download excel', ['class' => 'btn btn-success btn-print', 'name'=>'submit', 'value'=>'Download']) ?>
            </p>
        </div>
        <?php echo Html::endForm(); ?>
        <p style="float: right;">
            <?= Html::a('PDF Convert', [''], ['class' => 'btn btn-success btn-print', 'onclick'=>'window.print()']) ?>
        </p>
    </div>
    <br/>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'project_name',
            'generator_code',
            'repair_item',
            'cost',
            'date'
            
        ],
    ]); ?>

</div>
