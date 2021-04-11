<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cost_type".
 *
 * @property integer $id
 * @property string $c_name
 */
class CostType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cost_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_name'], 'required'],
            [['c_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_name' => 'C Name',
        ];
    }
}
