<?php

namespace app\controllers;

use Yii;
use app\models\FcCost;
use app\models\FcCostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

use yii\filters\auth\QueryParamAuth;
use app\models\LoginForm;
use app\models\SignupForm;
use yii\web\JsonParser;
use app\models\Person;
use app\models\Generator;
use app\models\Project;
use app\models\ProjectDetail;
use app\models\MaintenanceItem;
use app\models\McCost;
use app\models\RcCost;


class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    /*public function init(){
        parent::init();
        Yii::$app->errorHandler->errorAction = 
    }*/

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'token',
            'except'=> ['member-login',
                'fuel-cost',
                'maintenance-cost',
                'repair-cost',
                'item-maintenance',
            ]
        ];

        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'text/html' => \yii\web\Response::FORMAT_JSON,
                'application/json' => \yii\web\Response::FORMAT_JSON,
                'application/xml' => \yii\web\Response::FORMAT_XML,
            ],
        ];

        return $behaviors;
    }

    //Member Login

    public function actionMemberLogin(){
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            $user = $model->getUser();

            return [  
                'message' => 'Successfully Logged in',
                'user_name'=> $user->user_name,
                'token' => $user->token
            ];
        } else {
            Yii::$app->response->statusCode = 400;
            return [
                'status'=> 0,
                'message'=> 'Username & password mismatch',
                'success'=> false,
                'message1'=> $model->getErrors()
                ];
        }
    }

        //Change Password

    public function actionChangePassword(){
        $request = Yii::$app->request;
        if(Yii::$app->user->identity->validatePassword($request->post('currentPassword'))){
            if($request->post('newPassword') === $request->post('r_newPassword')){
                Yii::$app->user->identity->setPassword($request->post('newPassword'));
                Yii::$app->user->identity->save();
                return [
                    'message'=> 'password changed successfully'
                ];
            }else{
                Yii::$app->response->statusCode = 400;
                return [
                    'message'=> 'Repeat password exactly'
                ];
            }
        }else{
            Yii::$app->response->statusCode = 400;
            return [
                'message'=> 'Password not match'
            ];
        }
    }

    //Member Logout

    public function actionLogout(){
        Yii::$app->user->logout();
        return [
            'message'=> 'logout successfully'
        ];
    }

    //Fuel Cost post by Admin

    public function actionFuelCost(){
        $request=[];
        $request = Yii::$app->request->post();
        //return $request;die();
        $contact = $request['sender'];
        $response = Person::find()->where(['contact' => $contact])->one();

        if($response){
            $body = [];
            $body = explode("\n", $request['request']);
            //return $body;die();
            $check = $body['0'];
            if($check === '##dgapp##'){
                $date = $body['1'];
                for($i = 2; $i < count($body); $i++){
                    $gen  = explode(",", $body[$i]);
                    //return $gen;die();
                    $gid  = Generator::find()->where(['g_code' => $gen[0]])->one()['id'];
                    
                    $model = new FcCost();
                    $model->monthly_id      = 1;
                    $model->project_id      = ProjectDetail::find()->where(['generator_id'=> $gid])->one()['project_id'];
                    $model->generator_id    = $gid;
                    $model->person_id       = $response['id'];
                    $model->cost_type       = 1;
                    $model->running_hr      = $gen[1];
                    $model->total_current   = $gen[2];
                    $model->fuel_consump    = $gen[3];
                    $model->date            = $date;
                    if($model->save()){
                        //return "Data saved Successfully";
                    }
                    else{
                        print_r($model->getErrors());
                        die();
                    }      
                }
                return "Fuel Consumption saved successfully";
            }
            elseif ($check === '##dgapp##m') {
                $date = $body['1'];
                for($i = 2; $i < count($body); $i++){
                    $gen  = explode(",", $body[$i]);
                    //return $gen;die();
                    $gid  = Generator::find()->where(['g_code' => $gen[0]])->one()['id'];
                    
                    $model = new McCost();
                    $model->project_id          = ProjectDetail::find()->where(['generator_id'=> $gid])->one()['project_id'];
                    $model->generator_id        = $gid;
                    $model->person_id           = $response['id'];
                    $model->maintenance_id      = $gen[1];
                    $model->quantity            = $gen[2];
                    $model->date                = $date;
                    if($model->save()){
                        //return "Data saved Successfully";
                    }
                    else{
                        print_r($model->getErrors());
                        die();
                    }      
                }
                return "Maintenance Cost saved successfully";
            }
            elseif ($check === '##dgapp##r') {
                $date = $body['1'];
                for($i = 2; $i < count($body); $i++){
                    $gen  = explode("~", $body[$i]);
                    //return $gen;die();
                    $gid  = Generator::find()->where(['g_code' => $gen[0]])->one()['id'];
                    
                    $model = new RcCost();
                    $model->project_id          = ProjectDetail::find()->where(['generator_id'=> $gid])->one()['project_id'];
                    $model->generator_id        = $gid;
                    $model->person_id           = $response['id'];
                    $model->description         = $gen[1];
                    $model->total_cost          = $gen[2];
                    $model->date                = $date;
                    if($model->save()){
                        //return "Data saved Successfully";
                    }
                    else{
                        print_r($model->getErrors());
                        die();
                    }      
                }
                return "Repair Cost saved successfully";
            }
        }
        else{
            return "Contact number not found";
        }

    }

    // Get List of maintenance item

    public function actionItemMaintenance(){
        $item = MaintenanceItem::find()->all();
        return $item;
    }

    // Maintenance Cost posting

    /*public function actionMaintenanceCost(){
        $request=[];
        $request = Yii::$app->request->post();
        //return $request;die();
        $contact = $request['sender'];
        $response = Person::find()->where(['contact' => $contact])->one();

        if($response){
            $body = [];
            $body = explode("\n", $request['request']);
            //return $body;die();
            $date = $body['1'];
            for($i = 2; $i < count($body); $i++){
                $gen  = explode(",", $body[$i]);
                //return $gen;die();
                $gid  = Generator::find()->where(['g_code' => $gen[0]])->one()['id'];
                
                $model = new McCost();
                $model->project_id          = ProjectDetail::find()->where(['generator_id'=> $gid])->one()['project_id'];
                $model->generator_id        = $gid;
                $model->person_id           = $response['id'];
                $model->maintenance_id      = $gen[1];
                $model->quantity            = $gen[2];
                $model->date                = $date;
                if($model->save()){
                    //return "Data saved Successfully";
                }
                else{
                    print_r($model->getErrors());
                    die();
                }      
            }
            return "Maintenance Cost saved successfully";
        }
        else{
            return "Contact number not found";
        }
    }

    // Repair Cost posting

    public function actionRepairCost(){
        $request=[];
        $request = Yii::$app->request->post();
        //return $request;die();
        $contact = $request['sender'];
        $response = Person::find()->where(['contact' => $contact])->one();

        if($response){
            $body = [];
            $body = explode("\n", $request['request']);
            //return $body;die();
            $date = $body['1'];
            for($i = 2; $i < count($body); $i++){
                $gen  = explode(",", $body[$i]);
                //return $gen;die();
                $gid  = Generator::find()->where(['g_code' => $gen[0]])->one()['id'];
                
                $model = new RcCost();
                $model->project_id          = ProjectDetail::find()->where(['generator_id'=> $gid])->one()['project_id'];
                $model->generator_id        = $gid;
                $model->person_id           = $response['id'];
                $model->description         = $gen[1];
                $model->total_cost          = $gen[2];
                $model->date                = $date;
                if($model->save()){
                    //return "Data saved Successfully";
                }
                else{
                    print_r($model->getErrors());
                    die();
                }      
            }
            return "Repair Cost saved successfully";
        }
        else{
            return "Contact number not found";
        }
    }*/

}
