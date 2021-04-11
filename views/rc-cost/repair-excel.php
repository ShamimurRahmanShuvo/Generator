<?= \app\components\ExcelGrid::widget([
        'dataProvider' => $dataProvider,
        'properties'=>[],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'project_name',
            'generator_code',
            'repair_item',
            'cost',
            'date'
            
        ],
    ]); 
?>