<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_detail".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $generator_id
 *
 * @property Project $project
 */
class ProjectDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'generator_id'], 'required'],
            [['project_id', 'generator_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id.p_name' => 'Project Name',
            'generator_id' => 'Generator Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    public function getGenerator()
    {
        return $this->hasOne(Generator::className(), ['id' => 'generator_id']);
    }
}
