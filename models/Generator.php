<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "generator".
 *
 * @property integer $id
 * @property string $g_code
 * @property string $g_brand
 * @property string $g_model
 * @property string $g_capacity
 * @property integer $status
 * @property string $remark
 */
class Generator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'generator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['g_code', 'g_brand', 'g_model', 'g_capacity', 'status', 'remark'], 'required'],
            [['status'], 'integer'],
            [['g_code', 'g_brand', 'g_model', 'g_capacity', 'remark'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'g_code' => 'Generator Code',
            'g_brand' => 'Generator Brand',
            'g_model' => 'Generator Model',
            'g_capacity' => 'Generator Capacity',
            'status' => 'Status',
            'remark' => 'Remark',
        ];
    }
}
