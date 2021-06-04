<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CotizacionForm extends Model
{
    public $id_cliente;

    public function rules()
    {
        return [
          
            [['id_cliente'], 'required'],
        ];
    }
      
    public function attributeLabels()
    {
        return [
            'id_cliente' => 'Cliente',
        ];
    }
}