<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\McCost;
use app\models\McCostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Generator;

/**
 * McCostController implements the CRUD actions for McCost model.
 */
class McCostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all McCost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new McCostSearch();
        $searchModel->project_id = Yii::$app->request->get('p_id');
        
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->maintenance();
        // $dataProvider = '';
        // $dataProvider = Generator::find()->select(['g_code'])->where(['id'=>'id'])->one();
        if(Yii::$app->request->get('submit')=='Download'){
            
            $dataProvider = $searchModel->maintenance();

            return $this->render('maintenance-excel', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        if(Yii::$app->request->get('p_id')){
            $dataProvider = $searchModel->maintenance();

            return $this->render('maintenance', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }else{
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } 
        
    }

    /**
     * Displays a single McCost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new McCost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new McCost();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing McCost model.
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
     * Deletes an existing McCost model.
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
     * Finds the McCost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return McCost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = McCost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
