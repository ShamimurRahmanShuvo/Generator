<?= \app\components\ExcelGrid::widget([
        'dataProvider' => $dataProvider,
        'properties'=>[],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'project_name',
            'generator_code',
            'item',
            'quantity',
            'date'
            
        ],
    ]); ?>