<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
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

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model_form, 'id_producto')->dropdownList($productos,['prompt'=>'Seleccione un producto']) ?>

<?= $form->field($model_form, 'cantidad')->textInput() ?>


<?= $form->field($model_form, 'precio')->textInput() ?>

<?= $form->field($model_form, 'descuento')->textInput() ?>

<?= $form->field($model_form, 'id_cotizacion')->hiddenInput(['value'=>$model->id])->label(false) ?>

<div class="form-group">
    <?= Html::submitButton('Agregar', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>

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
            
           
           

            ['class' => 'yii\grid\ActionColumn'],
            'template'=>'{delete}',
            'buttons'=>[
                'delete'=>function($url,$model,$key){
                    return Html::a('<span class="gkyphicon-trash></span',
                    ['delete-detalle','id'=>$model->id],
                    ['data'=>['confirm'=>Yii::t('app','Desea eliminar el registro?'),'method'=>'post',],]
                );
                }
            ]
        ],
    ]); ?>

