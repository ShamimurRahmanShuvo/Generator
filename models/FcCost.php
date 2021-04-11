<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fc_cost".
 *
 * @property integer $id
 * @property integer $monthly_id
 * @property integer $project_id
 * @property integer $generator_id
 * @property integer $person_id
 * @property integer $cost_type
 * @property double $running_hr
 * @property string $total_current
 * @property string $fuel_consump
 * @property string $date
 *
 * @property CostType $costType
 * @property Generator $generator
 * @property Person $person
 * @property Project $project
 */
class FcCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fc_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'generator_id', 'person_id', 'cost_type', 'running_hr', 'total_current', 'fuel_consump', 'date'], 'required'],
            [['monthly_id', 'project_id', 'generator_id', 'person_id', 'cost_type'], 'integer'],
            [['running_hr'], 'number'],
            [['date'], 'safe'],
            [['total_current', 'fuel_consump'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'monthly_id' => 'Monthly ID',
            'project_id' => 'Project ID',
            'generator_id' => 'Generator ID',
            'person_id' => 'Person ID',
            'cost_type' => 'Cost Type',
            'running_hr' => 'Running Hr',
            'total_current' => 'Total Current',
            'fuel_consump' => 'Fuel Consump',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostType()
    {
        return $this->hasOne(CostType::className(), ['id' => 'cost_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenerator()
    {
        return $this->hasOne(Generator::className(), ['id' => 'generator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
