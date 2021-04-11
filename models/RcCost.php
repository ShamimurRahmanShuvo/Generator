<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rc_cost".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $generator_id
 * @property integer $person_id
 * @property string $description
 * @property double $total_cost
 * @property string $date
 */
class RcCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rc_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'generator_id', 'person_id', 'description', 'total_cost', 'date'], 'required'],
            [['project_id', 'generator_id', 'person_id'], 'integer'],
            [['description'], 'string'],
            [['total_cost'], 'number'],
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
            'description' => 'Description',
            'total_cost' => 'Total Cost',
            'date' => 'Date',
        ];
    }
}
