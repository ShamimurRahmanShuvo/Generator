<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\FcCost;
use app\models\FcCostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Generator;

/**
 * FcCostController implements the CRUD actions for FcCost model.
 */
class FcCostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all FcCost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FcCostSearch();
        $searchModel->project_id = Yii::$app->request->get('p_id');
        
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->fuelCost();
        // $dataProvider = '';
        // $dataProvider = Generator::find()->select(['g_code'])->where(['id'=>'id'])->one();
        if(Yii::$app->request->get('submit')=='Download'){
            if(Yii::$app->request->get('list')==1){
                $dataProvider = $searchModel->fuelCost();

                return $this->render('daily-excel', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
            elseif (Yii::$app->request->get('list')==2) {
                $dataProvider = $searchModel->monthlyFuelCost();
                
                return $this->render('monthly-excel', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        }        

        if(Yii::$app->request->get('list')==1){
            $dataProvider = $searchModel->fuelCost();

            return $this->render('daily', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        elseif (Yii::$app->request->get('list')==2) {
            $dataProvider = $searchModel->monthlyFuelCost();
            
            return $this->render('monthly', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    // public function actionDaily()
    // {
    //     $searchModel = new FcCostSearch();
    //     //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //     $searchModel->project_id = Yii::$app->request->get('p_id');
    //     $dataProvider = $searchModel->fuelCost();
    //     // $dataProvider = '';
    //     // $dataProvider = Generator::find()->select(['g_code'])->where(['id'=>'id'])->one();

    //     return $this->render('daily', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single FcCost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // public function actionMonthly(){
    //     $searchModel = new FcCostSearch();
    //     //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //     $searchModel->project_id = Yii::$app->request->get('p_id');
    //     $dataProvider = $searchModel->monthlyFuelCost();
    //     // $dataProvider = '';
    //     // $dataProvider = Generator::find()->select(['g_code'])->where(['id'=>'id'])->one();

    //     return $this->render('monthly', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Creates a new FcCost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FcCost();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FcCost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FcCost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FcCost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FcCost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FcCost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
