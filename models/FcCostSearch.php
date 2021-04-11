<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FcCost;
use yii\data\SqlDataProvider;
/**
 * FcCostSearch represents the model behind the search form about `app\models\FcCost`.
 */
class FcCostSearch extends FcCost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'monthly_id', 'project_id', 'generator_id', 'person_id', 'cost_type'], 'integer'],
            [['running_hr'], 'number'],
            [['total_current', 'fuel_consump', 'date'], 'safe'],
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
    public function fuelCost(){
        if($this->project_id){
            $query = "SELECT tt.*,round((1.73*400*total_current*0.8/1000),2) max_load,
                        round((1.73*400*total_current*0.8/1000)*running_hr,2) Unit,
                        round((fuel_consump/ running_hr),2) FuelConsumption, 
                        round(fuel_consump*68,2) TotalFuelCost,
                        round((fuel_consump*68)/ ((1.73*400*total_current*0.8/1000)*running_hr),2) UnitCost 
                        FROM (SELECT fc_cost.*,project.p_name,generator.g_code FROM `fc_cost`
                            left join project on fc_cost.project_id=project.id
                            LEFT JOIN generator on fc_cost.generator_id = generator.id where fc_cost.project_id = ".$this->project_id.") tt";
        }else{
            $query = "SELECT tt.*,round((1.73*400*total_current*0.8/1000),2) max_load,
                        round((1.73*400*total_current*0.8/1000)*running_hr,2) Unit,
                        round((fuel_consump/ running_hr),2) FuelConsumption, 
                        round(fuel_consump*68,2) TotalFuelCost,
                        round((fuel_consump*68)/ ((1.73*400*total_current*0.8/1000)*running_hr),2) UnitCost 
                        FROM (SELECT fc_cost.*,project.p_name,generator.g_code FROM `fc_cost`
                            left join project on fc_cost.project_id=project.id
                            LEFT JOIN generator on fc_cost.generator_id = generator.id) tt";
        }
        
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
        ]);

      
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
       
    }

    public function monthlyFuelCost(){

        if($this->project_id){
            $query = "SELECT tt.*,CONCAT(MONTHNAME(date),'-',year(date)) month,
                    sum(total_current) total_current,
                    sum(fuel_consump) total_fuel_consumption,
                    max(round((1.73*400*total_current*0.8/1000),2)) max_load,
                    sum(running_hr) total_running_hour,
                    sum(round((1.73*400*total_current*0.8/1000)*running_hr,2)) Total_unit,
                    avg(round((fuel_consump/ running_hr),2)) fuel_consumption_per_hour, 
                    sum(round(fuel_consump*68,2)) Total_Fuel_Cost,
                    avg(round((fuel_consump*68)/ ((1.73*400*total_current*0.8/1000)*running_hr),2)) Unit_Cost 
                    FROM (SELECT fc_cost.*,
                        project.p_name,
                        generator.g_code,
                        round((generator.g_capacity*0.8),2) load_capacity,
                        round(((((1.73*400*fc_cost.total_current*0.8/1000))/(generator.g_capacity*0.8))*100),2) operating_capacity 
                        FROM `fc_cost` left join project on fc_cost.project_id=project.id 
                        LEFT JOIN generator on fc_cost.generator_id = generator.id where fc_cost.project_id = ".$this->project_id.") tt group by tt.generator_id,year(tt.date),month(tt.date)";
        }else{
            $query = "SELECT tt.*,CONCAT(MONTHNAME(date),'-',year(date)) month,
                    sum(total_current) total_current,
                    sum(fuel_consump) total_fuel_consumption,
                    max(round((1.73*400*total_current*0.8/1000),2)) max_load,
                    sum(running_hr) total_running_hour,
                    sum(round((1.73*400*total_current*0.8/1000)*running_hr,2)) Total_unit,
                    avg(round((fuel_consump/ running_hr),2)) fuel_consumption_per_hour, 
                    sum(round(fuel_consump*68,2)) Total_Fuel_Cost,
                    avg(round((fuel_consump*68)/ ((1.73*400*total_current*0.8/1000)*running_hr),2)) Unit_Cost 
                    FROM (SELECT fc_cost.*,
                        project.p_name,
                        generator.g_code,
                        round((generator.g_capacity*0.8),2) load_capacity,
                        round(((((1.73*400*fc_cost.total_current*0.8/1000))/(generator.g_capacity*0.8))*100),2) operating_capacity 
                        FROM `fc_cost` left join project on fc_cost.project_id=project.id 
                        LEFT JOIN generator on fc_cost.generator_id = generator.id ) tt group by year(tt.date),month(tt.date)";
        }
        
        
        
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
        ]);

      
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
       
    }

    public function search($params)
    {
        $query = FcCost::find();
        //$query ="SELECT *,round((1.73*400*total_current*0.8/1000),2) ld, round((1.73*400*total_current*0.8/1000)*running_hr,2) unit, round((fuel_consump/ running_hr),2) fch, round(fuel_consump*68,2) tcost, round((fuel_consump*68)/ ((1.73*400*total_current*0.8/1000)*running_hr),2) ucost FROM fc_cost";
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
            'monthly_id' => $this->monthly_id,
            'project_id' => $this->project_id,
            'generator_id' => $this->generator_id,
            'person_id' => $this->person_id,
            'cost_type' => $this->cost_type,
            'running_hr' => $this->running_hr,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'total_current', $this->total_current])
            ->andFilterWhere(['like', 'fuel_consump', $this->fuel_consump]);

        return $dataProvider;
    }
}
