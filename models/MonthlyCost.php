<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monthly_cost".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $generator_id
 * @property string $diesel_issue
 * @property string $date
 */
class MonthlyCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monthly_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'generator_id', 'diesel_issue', 'date'], 'required'],
            [['project_id', 'generator_id'], 'integer'],
            [['date'], 'safe'],
            [['diesel_issue'], 'string', 'max' => 255]
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
            'diesel_issue' => 'Diesel Issue',
            'date' => 'Date',
        ];
    }
}
