<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RcCost;
use yii\data\SqlDataProvider;

/**
 * RcCostSearch represents the model behind the search form about `app\models\RcCost`.
 */
class RcCostSearch extends RcCost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'generator_id', 'person_id'], 'integer'],
            [['description', 'date'], 'safe'],
            [['total_cost'], 'number'],
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

    public function repair(){
        if($this->project_id){
            $query ="SELECT project.p_name project_name,
                                    generator.g_code generator_code,
                                    rc_cost.description repair_item,
                                    rc_cost.total_cost cost,
                                    rc_cost.date 
                                    FROM rc_cost
                                    LEFT JOIN generator on rc_cost.generator_id=generator.id
                                    LEFT JOIN project on rc_cost.project_id=project.id 
                                    where rc_cost.project_id=".$this->project_id." ORDER_BY rc_cost.date";
            $dataProvider = new SqlDataProvider([
            'sql' => $query,
        ]);

      
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
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
        $query = RcCost::find();

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
            'project_id' => $this->project_id,
            'generator_id' => $this->generator_id,
            'person_id' => $this->person_id,
            'total_cost' => $this->total_cost,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
