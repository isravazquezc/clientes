<?php

use yii\db\Migration;

/**
 * Class m210510_222503_tabla_cotizacion_detalle
 */
class m210510_222503_tabla_cotizacion_detalle extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cotizacion_detalle', [
            'id' => $this->primaryKey(),
            'precio' => $this->string(10,2)->notNull(),
            'descuento' => $this->integer(),
            'id_producto'=>$this->integer()->notNull(),
            'id_cotizacion' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey(
            'fk-cotizacion_detalle-id_producto',
            'cotizacion_detalle',
            'id_producto',
            'productos',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cotizacion_detalle-id_cotizacion',
            'cotizacion_detalle',
            'id_cotizacion',
            'cotizaciones',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-cotizacion_detalle-id_producto',
            'cotizacion_detalle'
        );
        $this->dropForeignKey(
            'fk-cotizacion_detalle-id_cotizacion',
            'cotizacion_detalle'
        );
        $this->dropTable('cotizacion_detalle');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210510_222503_tabla_cotizacion_detalle cannot be reverted.\n";

        return false;
    }
    */
}
