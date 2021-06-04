<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cotizaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<h1> Cotizacion <?= Html::encode($this->title) ?></h1>
   
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fecha:datetime',
            [

                'label'=>'Cliente',
                'value'=>function($model){
                    return $model->cliente->nombre;
                }
            ],

            
            
        ],
    ]) ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [

                'label'=>'Producto',
                'value'=>function($model){
                    return $model->producto->nombre;
                }
            ],
            'cantidad',
            'precio',
            'descuento',
            [
                'label'=>'Subtotal',
                'value'=>function($model){
                    return $model->cantidad * $model->precio-$model->descuento;
                }
            ],
           
           

        //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

 <? Html::a('Editar',['update','id'=>$model->id],['class'=>'btn btn-success']) ?>