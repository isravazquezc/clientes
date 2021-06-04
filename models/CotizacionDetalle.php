<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotizacion_detalle".
 *
 * @property int $id
 * @property string $precio
 * @property int|null $descuento
 * @property int $id_producto
 * @property int $id_cotizacion
 * @property int $cantidad
 * 
 * @property Cotizaciones $cotizacion
 * @property Productos $producto
 */
class CotizacionDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cotizacion_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['precio', 'id_producto', 'id_cotizacion','cantidad'], 'required'],
            [['descuento', 'id_producto', 'id_cotizacion','cantidad'], 'integer'],
            [['precio'], 'string', 'max' => 10],
            [['id_cotizacion'], 'exist', 'skipOnError' => true, 'targetClass' => Cotizaciones::className(), 'targetAttribute' => ['id_cotizacion' => 'id']],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['id_producto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'precio' => 'Precio',
            'descuento' => 'Descuento',
            'id_producto' => ' Producto',
            'id_cotizacion' => ' Cotizacion',
            'cantidad'=> 'Cantidad',
        ];
    }

    /**
     * Gets query for [[Cotizacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacion()
    {
        return $this->hasOne(Cotizaciones::className(), ['id' => 'id_cotizacion']);
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::className(), ['id' => 'id_producto']);
    }
}
