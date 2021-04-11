<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Generator;

/**
 * GeneratorSearch represents the model behind the search form about `app\models\Generator`.
 */
class GeneratorSearch extends Generator
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['g_code', 'g_brand', 'g_model', 'g_capacity', 'remark'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Generator::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'g_code', $this->g_code])
            ->andFilterWhere(['like', 'g_brand', $this->g_brand])
            ->andFilterWhere(['like', 'g_model', $this->g_model])
            ->andFilterWhere(['like', 'g_capacity', $this->g_capacity])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
