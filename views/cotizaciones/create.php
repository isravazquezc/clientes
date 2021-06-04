<?php

use app\models\Clientes;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>


<?= $form->field($model, 'id_cliente')->dropdownList($clientes,['prompt'=>'Seleccione un cliente']) ?>


<div class="form-group">
    <?= Html::submitButton('Crear', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
