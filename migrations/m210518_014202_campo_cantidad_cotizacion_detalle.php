<?php

use yii\db\Migration;

/**
 * Class m210518_014202_campo_cantidad_cotizacion_detalle
 */
class m210518_014202_campo_cantidad_cotizacion_detalle extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cotizacion_detalle','cantidad',$this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cotizacion_detalle','cantidad');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210518_014202_campo_cantidad_cotizacion_detalle cannot be reverted.\n";

        return false;
    }
    */
}
