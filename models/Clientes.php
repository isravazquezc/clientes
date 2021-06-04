<?php

namespace app\models;
use webvimark\modules\UserManagement\models\User;
use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $rfc
 * @property string|null $calle
 * @property string|null $numero
 * @property string|null $cp
 * @property string|null $ciudad
 * @property string|null $pais
 * @property int $id_usuario
 *
 * @property User $usuario
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['nombre', 'rfc', 'calle', 'numero', 'cp', 'ciudad', 'pais'], 'string', 'max' => 255],
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
            'nombre' => 'Nombre',
            'rfc' => 'Rfc',
            'calle' => 'Calle',
            'numero' => 'Numero',
            'cp' => 'Cp',
            'ciudad' => 'Ciudad',
            'pais' => 'Pais',
            'id_usuario' => 'Id Usuario',
        ];
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
