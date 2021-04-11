<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mc_cost".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $generator_id
 * @property integer $person_id
 * @property integer $maintenance_id
 * @property integer $quantity
 * @property string $date
 */
class McCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mc_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'generator_id', 'person_id', 'maintenance_id', 'quantity', 'date'], 'required'],
            [['project_id', 'generator_id', 'person_id', 'maintenance_id', 'quantity'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'generator_id' => 'Generator ID',
            'person_id' => 'Person ID',
            'maintenance_id' => 'Maintenance ID',
            'quantity' => 'Quantity',
            'date' => 'Date',
        ];
    }
}
