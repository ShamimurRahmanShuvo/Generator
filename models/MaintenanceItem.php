<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maintenance_item".
 *
 * @property integer $id
 * @property string $item
 * @property string $unit
 */
class MaintenanceItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maintenance_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item', 'unit'], 'required'],
            [['item'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item' => 'Item',
            'unit' => 'Unit',
        ];
    }
}
