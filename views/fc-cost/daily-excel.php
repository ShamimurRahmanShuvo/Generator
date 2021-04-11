<?= \app\components\ExcelGrid::widget([
        'dataProvider' => $dataProvider,
        'properties'=>[],
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
            'max_load',
            'Unit',
            'FuelConsumption',
            'TotalFuelCost',
            'UnitCost'
            
            
        ],
    ]); ?>