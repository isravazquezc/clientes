<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CotizacionForm;
use app\models\Clientes;

use app\models\Cotizaciones;
use app\models\CotizacionDetalle;
use app\models\Productos;
use DateTime;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class CotizacionesController extends Controller
{
    //public $freeAccess = true;
   // public $freeAccessActions = ['index', 'about'];
    /**
     * {@inheritdoc}
     */
   
public function behaviors()
{
	return [
		'ghost-access'=> [
			'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
		],
	];
}
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
           
            
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query'=> Cotizaciones::find(),
            'pagination'=>[
                'pagesize'=>20,
            ],
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model= new CotizacionForm();

        $lista= Clientes::find()->where(['id_usuario'=>Yii::$app->user->id])->asArray()->all();
        $clientes=ArrayHelper::map($lista,'id','nombre');

        if(Yii::$app->request->isPost)
        {
            
            $datos=Yii::$app->request->post('CotizacionForm') ;
            $cotizacion= new Cotizaciones();
            $cotizacion->id_usuario = Yii::$app->user->id;
            $cotizacion->id_cliente= $datos['id_cliente'];

            $fecha= new \DateTime('NOW');
            $cotizacion->fecha = $fecha->format('Y-m-d H:i:s');
            if($cotizacion->save())
            {
                return $this->redirect(['index']);
            }

        }

        return $this->render('create',[
            'model'=>$model,
            'clientes'=>$clientes
        ]);

    }
    
    public function actionView($id)
    {
        
        $dataProvider = new ActiveDataProvider([
            'query'=> CotizacionDetalle::find()->where(['id_cotizacion'=>$id]),
            'pagination'=>[
                'pagesize'=>20,
            ],
        ]);
        return $this->render('view',[
            'model' => $this->findModel($id),
            'dataProvider'=>$dataProvider,
        ]);
    }
    public function actionUpdate($id){

        if(Yii::$app->request->isPost)
        {
          
             $datos=Yii::$app->request->post('CotizacionDetalle') ;

             $detalle = new CotizacionDetalle();
             $detalle->cantidad=$datos['cantidad'];
             $detalle->precio=$datos['precio'];
             $detalle->descuento=$datos['descuento'];
             $detalle->id_cotizacion=$datos['id_cotizacion'];
             $detalle->id_producto=$datos['id_producto'];
             $detalle->save();
        }

        $model_form = new CotizacionDetalle();

        
        $lista= Productos::find()->where(['id_usuario'=>Yii::$app->user->id])->asArray()->all();
        $productos=ArrayHelper::map($lista,'id','nombre');

        $dataProvider = new ActiveDataProvider([
            'query'=> CotizacionDetalle::find()->where(['id_cotizacion'=>$id]),
            'pagination'=>[
                'pagesize'=>20,
            ],
        ]);

        return $this->render('update',[
            'model' => $this->findModel($id),
            'model_form'=>$model_form,
            'productos'=>$productos,
            'dataProvider'=>$dataProvider,
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Cotizaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteDetalle($id)
    {
        $model = CotizacionDetalle::findOne($id);

        $id_cotizacion =$model->cotizacion->id;

        $model->delete();
        return $this->redirect(['update','id'=>$id_cotizacion]);

    }

  
  
}
