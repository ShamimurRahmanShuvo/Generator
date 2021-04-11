<?= \app\components\ExcelGrid::widget([
        'dataProvider' => $dataProvider,
        'properties'=>[],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'date',
            'month',
            'p_name',
            'g_code',
            'total_running_hour',
            'total_current',
            'total_fuel_consumption',
            'max_load',
            'Total_unit',
            'fuel_consumption_per_hour',
            'Total_Fuel_Cost',
            'Unit_Cost',
            'load_capacity',
            'operating_capacity'         
        ],
    ]); ?>