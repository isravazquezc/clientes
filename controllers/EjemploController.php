<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
class EjemploController extends Controller
{
public function actionIndex()
{
    $data=array(
        'nombre'=>'Alvaro'
    );

    return $this->render("index",$data);
}
public function actionMostrar()
{
    return "Ejemplo Mostrar";
}
}
?>