<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\McCost;
use yii\data\SqlDataProvider;

/**
 * McCostSearch represents the model behind the search form about `app\models\McCost`.
 */
class McCostSearch extends McCost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'generator_id', 'person_id', 'maintenance_id', 'quantity'], 'integer'],
            [['date'], 'safe'],
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

    public function maintenance(){
        if($this->project_id){
            $query ="SELECT project.p_name project_name,
                                    generator.g_code generator_code,
                                    maintenance_item.item,
                                    mc_cost.quantity,
                                    mc_cost.date 
                                    FROM mc_cost
                                    LEFT JOIN generator on mc_cost.generator_id=generator.id
                                    LEFT JOIN maintenance_item on mc_cost.maintenance_id=maintenance_item.id
                                    LEFT JOIN project on mc_cost.project_id=project.id 
                                    where mc_cost.project_id=".$this->project_id." ORDER BY mc_cost.date desc";
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
        $query = McCost::find();

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
            'maintenance_id' => $this->maintenance_id,
            'quantity' => $this->quantity,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
}
