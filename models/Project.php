<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $p_name
 * @property string $p_address
 * @property integer $detail_id
 *
 * @property FcCost[] $fcCosts
 * @property ProjectDetail[] $projectDetails
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_name', 'p_address'], 'required'],
            [['p_address'], 'string'],
            [['p_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_name' => 'Project Name',
            'p_address' => 'Project Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFcCosts()
    {
        return $this->hasMany(FcCost::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectDetails()
    {
        return $this->hasMany(ProjectDetail::className(), ['project_id' => 'id']);
    }
}
