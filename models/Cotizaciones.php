<?php

namespace app\models;

use Yii;
use webvimark\modules\UserManagement\models\User;


/**
 * This is the model class for table "cotizaciones".
 *
 * @property int $id
 * @property string $fecha
 * @property int $id_cliente
 * @property int $id_usuario
 *
 * @property CotizacionDetalle[] $cotizacionDetalles
 * @property Clientes $cliente
 * @property User $usuario
 */
class Cotizaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cotizaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'id_cliente', 'id_usuario'], 'required'],
            [['fecha'], 'safe'],
            [['id_cliente', 'id_usuario'], 'integer'],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['id_cliente' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'id_cliente' => ' Cliente',
            'id_usuario' => ' Usuario',
        ];
    }

    /**
     * Gets query for [[CotizacionDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacionDetalles()
    {
        return $this->hasMany(CotizacionDetale::className(), ['id_cotizacion' => 'id']);
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'id_cliente']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }
}
