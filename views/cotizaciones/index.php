<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Cotizaciones';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= Html::a('Crear cotizacion', ['create'], ['class' => 'btn btn-success']) ?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha:datetime', 
           
            [

                'label'=>'Cliente',
                'value'=>function($model){
                    return $model->cliente->nombre;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>